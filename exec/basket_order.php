<?php
//error_reporting(E_ALL);
if(isset($_POST['send_bsk']) && count($_SESSION['basket'])){
 	
	$smarty->assign("CONTENT_TPL",'basket_tnx.tpl');
	$smarty->assign("POST", $_POST);
	$smarty->assign("PAYMENT", "no");
	$error=array();

	//Save data if errors

	$dIDs=implode(",", array_keys($_SESSION['basket']));

	$query="SELECT g.ID, g.classID, g.image, g.name, g.link, gfs.ID AS formID, gf1c.barcode, gfs.hgt, gfs.wdt, gfs.depth, gfs.dia, gfs.price, gfs.color, gfs.img, gfs.measure_qt, gmg.unit, gmg.name_ru AS mg_name_ru, gmg.name_ua AS mg_name_ua, gfc.name_ru AS color_name_ru, gfc.name_ua AS color_name_ua
		FROM goods g
		LEFT JOIN goods_forms gfs ON g.ID=gfs.goodID
		LEFT JOIN goods_colors gfc ON gfs.color=gfc.alias
		LEFT JOIN goods_measures gmg ON gmg.ID=gfs.measure_id
		LEFT JOIN goods_forms2_1c gf1c ON gfs.ID=gf1c.fID
		WHERE gfs.ID IN (".$dIDs.")";


	
	$ttl=0;
	$db->query($query);

	while($f=$db->fetch()){

		$cnt=0;

		if(in_array($f['classID'], array('78', '79', '80'))){
			$bsk[$f['formID']]['href']=$lang_url.'/buket/'.$f['ID'].'/';
		}elseif($f['classID']=='49') {
			$bsk[$f['formID']]['href']=$lang_url.'/compositions/'.$f['link'].'/';
		}else{
			$bsk[$f['formID']]['href']=$lang_url.'/product/'.$f['ID'].'_'.$f['link'].'/';
		}

		$bsk[$f['formID']]['image']=$f['image'];
		$bsk[$f['formID']]['img']=$f['img'];
		$bsk[$f['formID']]['formID']=$f['formID'];
		$bsk[$f['formID']]['barcode']=$f['barcode'];
		$bsk[$f['formID']]['link']=$f['link'];
		$bsk[$f['formID']]['classID']=$f['classID'];
		$bsk[$f['formID']]['dia']=$f['dia'];
		$bsk[$f['formID']]['wdt']=$f['wdt'];
		$bsk[$f['formID']]['hgt']=$f['hgt'];
		$bsk[$f['formID']]['depth']=$f['depth'];
		$bsk[$f['formID']]['name']=$f['name'];
		$bsk[$f['formID']]['color']=$f['color'];
		$bsk[$f['formID']]['color_name_ru']=$f['color_name_ru'];
		$bsk[$f['formID']]['color_name_ua']=$f['color_name_ua'];
		$bsk[$f['formID']]['price']=$f['price'];
		$bsk[$f['formID']]['measure_qt']=$f['measure_qt'];
		$bsk[$f['formID']]['unit']=$f['unit'];
		$bsk[$f['formID']]['mg_name_ru']=$f['mg_name_ru'];
		$bsk[$f['formID']]['mg_name_ua']=addslashes($f['mg_name_ua']);
		

		$cnt	=	$bsk[$f['formID']]['cnt']	=	$_SESSION['basket'][$f['formID']];
		
	//		$_SESSION['basket'][$f['formID']]=$_SESSION['basket'][$f['formID']]; //save quantity if resend
		$bsk[$f['formID']]['sttl']=$floren->MakePrice($f['price']*$cnt);
			
		 $ttl+=$floren->MakePrice($f['price']*$cnt);
		// $ttl+=intval($_POST['to_pay']);
		
		$google_ga4_script_items[]='{
				        item_name: "'.$f['name'].' '.($f['dia']?$f['dia'].'/':'').($f['wdt']?$f['wdt'].'/':'').$f['hgt'].($f['color']?' '.$f['color']:'').'",
				        item_id: "'.$f['formID'].'",
				        price: "'.$f['price'].'",
				        item_brand: "Флорен",
				        item_category: "Товари",
				        item_variant: "'.$f['color'].'",
				        quantity: '.$_SESSION['basket'][$f['formID']].'
				      }';
				           
		
	}//while

	//отправляем заказ
	if(isset($_SESSION['user']['ID']) && $_SESSION['user']['ID']>0){
		$userID=$_SESSION['user']['ID'];
	}else{
		if(isset($_REQUEST['email']) && $_REQUEST['email']!=''){
			$tmpUserEmail=preg_replace('/[^0-9a-zA-Z_@.]/','',$_REQUEST['email']);
			
			$db->query("SELECT * FROM users WHERE email='".$tmpUserEmail."'");
			if($db->num_rows()){
				$ff=$db->fetch();
				$userID=$ff['ID'];
			}else{
				$db->query("INSERT INTO users SET
						email='".$tmpUserEmail."',
						pass='".md5(time())."',
						fio='".str_replace("'", "", $_POST['fio'])."',
						phone='".str_replace("'", "", $_POST['phone'])."',
						date_add='".time()."'
						");
				$userID=$db->insert_id();
			}
		}
		else{
			$userID=0;
		}
	}
	$my_post=array();
	foreach($_POST AS $kk=>$vv){
		$my_post[$kk]=str_replace("'", "", $vv);
	}
	$my_basket=array();
	foreach($bsk AS $kk=>$vv){
		$my_basket[$kk]=str_replace("'", "", $vv);
	}

		
		
	$db->query("INSERT INTO orders SET
		client_id=".$userID.",
		fio='".str_replace("'", "", $_POST['fio'])."',
		email='".str_replace("'", "", $_POST['email'])."',
		phone='".str_replace("'", "", $_POST['phone'])."',
		address='".str_replace("'", "", $_POST['courier_address'])."',
		paymentWay='".$_POST['payment_way']."',
		comment='".str_replace("'", "", $_POST['comment'])."',
		order_date=UNIX_TIMESTAMP(),
		basket='".base64_encode(serialize($my_basket))."',
		post='".base64_encode(serialize($my_post))."',
		total='".$ttl."',
		utm_source='".(isset($_SESSION['utm_source'])			?$_SESSION['utm_source']	:"")."',
		utm_medium='".(isset($_SESSION['utm_medium'])			?$_SESSION['utm_medium']	:"")."',
		utm_campaign='".(isset($_SESSION['utm_campaign'])	?$_SESSION['utm_campaign']:"")."',
		gaClientID='".(isset($_SESSION['gaClientId'])			?$_SESSION['gaClientId']	:"")."'
	");
	
	$order_id=$db->insert_id();
	$db->query("UPDATE orders SET hash='".md5($order_id)."' WHERE ID='".$order_id."'");

	$smarty->assign("ORDER_ID", $order_id);

	$sm = new \Smarty\Smarty;
	
	$sm->setCompileDir($_SERVER['DOCUMENT_ROOT'] . '/smarty5/templates_c/');

	$sm->assign('ID', $order_id);
	$sm->assign('POST', $POST);
	$sm->assign('BASKET', $bsk);
	$sm->assign('SERVER', $_SERVER);
	$sm->assign('IP2', @$_SERVER['HTTP_X_FORWARDED_FOR']);
	$sm->assign('HTTP_REFERER', @$_SESSION['HTTP_REFERER']);

	$letter=$sm->fetch('mail/order.htm');		
	$floren->send_email('info@floren.com.ua','Новый заказ №'.$order_id,$letter);
	$floren->send_email('sales@floren.com.ua','Новый заказ №'.$order_id,$letter);
//	$floren->send_email('goncharova@floren.com.ua','Новый заказ №'.$order_id,$letter);

//===============GOOGLE GA4

	$google_ga4_script='dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
				dataLayer.push({
				  event: "purchase",
				  ecommerce: {
				      transaction_id: "'.$order_id.'",
				      affiliation: "Online Store",
				      value: "'.$ttl.'",
				      tax: "0",
				      shipping: "200",
				      currency: "UAH",
				      items: [';
	$google_ga4_script.=implode(",", $google_ga4_script_items);			      
	$google_ga4_script.=']
				  }
				});
			';
	
	$fb_purchase="fbq('track', 'Purchase', {value: ".$ttl.", currency: 'UAH'});";
	
	$smarty->assign("FB_SCRIPT_PURCHASE",$fb_purchase);
	$smarty->assign("GA4_SCRIPT_PURCHASE",$google_ga4_script);


//================END GOOGLE GA4


//TELEGRAM


	$florist_cats=array('77');
		$db->query("SELECT * FROM goods_class WHERE motherID='77'");

	while($rs=$db->fetch()){
		$florist_cats[]=$rs['ID'];
	}

	$group_name = 'plants';
	$products = array();

	foreach($bsk as $b) {

		if (in_array($b['classID'], $florist_cats)) {
			$group_name = 'florist';
		};

		$products[] =  $b['name'];
	}

	$all_products = implode(', ', $products);

	$smarty->assign('order', $order_id);
	$smarty->assign('phone', $_POST['phone']);
	$smarty->assign('link', 'https://floren.com.ua/admin/order_info.php?id='.md5($order_id));
	$smarty->assign('text', 'Новый заказ №'.$order_id);
	$smarty->assign('count', $_POST['to_pay']);
	$smarty->assign('goods', $all_products);
	$smarty->assign('payment', $_POST['payment_way']);
	$smarty->assign('delivery', $_POST['delivery_way']);
	
//	$telegram->send($group_name, $smarty->fetch('telegram/order.tpl'));

//END TELEGRAM
		
	if ($_POST['email']!=''){
		$letter_to_client=$sm->fetch('mail/order_to_client.htm');
//		$floren->send_email(trim($_POST['email']),'Флорен – ваше замовлення №'.$order_id,$letter_to_client);
	}

			
		
//		header("location:/bsk/basket_to_megaplan.php");
//============================================================KEEP_IN_CRM=================
				
//	include($_SERVER['DOCUMENT_ROOT'] . "/exec/basket_order_to_keep_in_crm.php");
	
//============================================================END_KEEP_IN_CRM=============


	//=================== LIQPAY ======================
	if	($POST['payment_way']=="visa" && $POST['allow_payment'] != '0'){
		
		$bsk_ttl=intval($_POST['to_pay']); //============ $basket_total + delivery
		if($bsk_ttl==0){
			header("location: ".$lang_url."/basket/?error");
			exit();
		}
		
		include( $_SERVER['DOCUMENT_ROOT'].'/exec/basket_order_liqpay.php');
			
	}		
	//=================== /LIQPAY======================
	
	$_SESSION['basket']=array();

}
elseif (isset($_POST['data']) && isset($_POST['signature'])){
 	echo "YYY";
	exit();
	$smarty->assign("CONTENT_TPL",'basket_order.tpl');
	$smarty->assign("POST", $POST);
	$smarty->assign("PAYMENT", "yes");
	$smarty->assign("PAYMENT_TRY", "first_try");

	$json_pb = base64_decode($_POST['data']);
	$json_pb_array = json_decode($json_pb,  true);
	
	$order_id=$json_pb_array['order_id'];
	$payment_status=$json_pb_array['status'];
	
	if($payment_status=='success'){
		$liqpayID=$json_pb_array['payment_id'];
		$liqpayEndDate=date("d-m-Y H:i:s", substr($json_pb_array['end_date'], 0, 10));
		$paid_amount=$json_pb_array['amount'];
	}else{
		$liqpayID='';
		$liqpayEndDate='';
		$paid_amount='';
		$smarty->assign("PAYMENT_TRY", "second_try");
	}
	//=========FOR not to double up payment in CRM
	if($liqpayID!=''){
		$db->query("SELECT * FROM orders WHERE liqpayID='".$liqpayID."'");
		if($db->num_rows()){
			header("location:".$lang_url."/basket/");
		}
	}
	//=========FOR not to double up payment in CRM
	
	$smarty->assign("PAYMENT_STATUS", $payment_status);
	$smarty->assign("ORDER_ID", $order_id);

	$db->query("SELECT * FROM orders WHERE id='".$order_id."'");
	$f=$db->fetch();
	$keepInCrmID=$f['keepInCrmID'];
	
	$db->query("UPDATE orders SET payment_status='".$payment_status."', paid_amount='".$paid_amount."', liqpayID='".$liqpayID."' WHERE id='".$order_id."'");
	
	
//========================== KEEP IN CRM SENDING DATA ================================		
	//update keepInCRM payment value. Put paymen to Finances + Attach agreement
	if($payment_status=="success"){
				$json_paymentString=array(
					"at"		=>	date("Y-m-d", time()),
					"amount"	=>	floatval($paid_amount),
					"currency"	=> "UAH",
  					"kind"		=> "debit",
  					"purse_id"	=> "3",
  					"category_id"	=> "1",
  					"parent_id"	=> $keepInCrmID
  				);

				$paymentString = json_encode($json_paymentString, JSON_UNESCAPED_UNICODE);
			//	print_r($paymentString);
				$url = 'https://api.keepincrm.com/v1/payments?office_hash_id=fPPFEZWKL1Xu';
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, [
				    'accept: application/json',
				    'X-Auth-Token: AhEhan8p9ksPnpi6JU1wCXiH',
				    'Content-Type: application/json; charset=utf-8',
				    'Content-Length: ' . strlen($paymentString)
				]);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $paymentString);
				$responsePayment = curl_exec($ch);
		//==== UPDATE keepInCRM agreement with note with date and time of liqpay operation
				
				$tmpNote="<br>========<br><br><b>liqpay No: ".$liqpayID." від ".$liqpayEndDate."</b><br><br>========<br>";
				$json_noteString=array("note"	=>	$tmpNote);

				$noteString = json_encode($json_noteString, JSON_UNESCAPED_UNICODE);
		
				$url = 'https://api.keepincrm.com/v1/agreements/'.$keepInCrmID.'/comments';
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, [
				    'accept: application/json',
				    'X-Auth-Token: AhEhan8p9ksPnpi6JU1wCXiH',
				    'Content-Type: application/json; charset=utf-8',
				    'Content-Length: ' . strlen($noteString)
				]);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $noteString);
				$responseNote = curl_exec($ch);
		
		//====END  UPDATE keepInCRM agreement with note with date and time of liqpay operation
		//==== UPDATE liqpayId (almost the same as previous) but at independent field
				$json_lipayid_String=array(
					"custom_fields"	=>	 array(

						[
					      "name"	=>	"tip_oplati_6124995",
					      "value"	=>	"ЛікПей"
					    ],
					    [
					      "name"	=>	"liqpayid_313",
					      "value"	=>	$liqpayID
					    ]
					)
				);
				$lipayid_String = json_encode($json_lipayid_String, JSON_UNESCAPED_UNICODE);
				$url = 'https://api.keepincrm.com/v1/agreements/'.$keepInCrmID;
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, [
				    'accept: application/json',
				    'X-Auth-Token: AhEhan8p9ksPnpi6JU1wCXiH',
				    'X-HTTP-Method-Override: PATCH',
				    'Content-Type: application/json; charset=utf-8',
				    'Content-Length: ' . strlen($lipayid_String)
				]);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $lipayid_String);
				$response_lipayid_String = curl_exec($ch);
			//	print_r($response_lipayid_String);
			//====END  UPDATE keepInCRM agreement liqpayId (almost the same as previous) but at independent field
	}
	//==========END OF update keepInCRM payment value
//==========================END OF KEEP IN CRM SENDING DATA ================================

}	elseif (isset($_POST['oneMoreTry']) && isset($_POST['order_id'])){
 	echo "CCC";
	exit();
	//============== LETS GIVE another TRY to client
	$db->query("SELECT * FROM orders WHERE id='".$_POST['order_id']."'");
	echo "SELECT * FROM orders WHERE id='".$_POST['order_id']."'";
	if(!$db->num_rows()){
		header("location:".$lang_url."/basket/");	
	}else{
		$f=$db->fetch();
		$order_id=$f['id'];
		$bsk_ttl=$f['total'];
		include( $_SERVER['DOCUMENT_ROOT'].'/exec/basket_order_liqpay.php');
	}
}else{//if send but
 	echo "UUU";
	exit();
	header("location:".$lang_url."/basket/");
}


$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/order/" />');
?>