<?php
	$db->query("SELECT * FROM orders WHERE id='".$order_id."'");
	$rs = $db->fetch();
	$order_items = unserialize(base64_decode($rs['basket']));
	$order_data = unserialize(base64_decode($rs['post']));
	
	//print_r($order_items);
	//print_r($order_data);
	
	$items2comment='';
	$items2products=array();
	
	
	if(is_array($order_items)){
		foreach($order_items AS $k=>$v){
			if(isset($v['barcode']) && $v['barcode']!=''){			
				$db->query("SELECT name FROM goods_1c WHERE barcode='".$v['barcode']."'");
				$bb=$db->fetch();
				$name1c=$bb['name'];
				
				$items2products[]=array(
					"amount"	=>	$v['cnt'],
		      		"title"		=>	$name1c,
		     		"product_attributes"	=>	array(
		       			"sku"	=>	$v['barcode'],
		        		"title"	=>	$name1c,
		        		"price"	=>	$v['price'],
		        		"currency"	=>	"UAH"
		        	)
				);
			}
			/*
			$items2comment.=@$v['barcode'].'	'.$v['name'].' '.($v['dia']?$v['dia'].'/':'').($v['wdt']?$v['wdt'].'/':'').$v['hgt'].($v['color']?' '.$v['color']:'').'		Кіл-ть: '.$v['cnt'].'шт.		Ціна: '.$v['price'].'
			';
			*/
		}// foreach
	}//if
	
	$json_string=array(
		"title"		=>	date("y/md-").$rs['id'],
		"total"		=>	intval($rs['total']),
		"currency"	=>	"UAH",
		"stage_id"	=>	22,	// Ne obroleni
		"source_id"	=>	1,
		"funnel_id"	=>	4, // Florystyka (If change – then change stageID)
		"custom_fields"	=>	 array(
			    [
			      "name"	=>	"gaa_utm_source_4449395",
			      "value"	=>	isset($_SESSION['utm_source'])?$_SESSION['utm_source']:""
			    ],
			    [
			      "name"	=>	"gaa_utm_medium_4449399",
			      "value"	=>	isset($_SESSION['utm_medium'])?$_SESSION['utm_medium']:""
			    ],
			    [
			      "name"	=>	"gaa_utm_campaign_4449398",
			      "value"	=>	isset($_SESSION['utm_campaign'])?$_SESSION['utm_campaign']:""
			    ],
/*			    [
			      "name"	=>	"gaa_utm_content_4449397",
			      "value"	=>	$_SESSION['utm_content']
			    ],
			    [
			      "name"	=>	"gaa_utm_term_4449396",
			      "value"	=>	$_SESSION['utm_term']
			    ],
*/			    [
			      "name"	=>	"gaclientid_291",
			      "value"	=>	isset($_SESSION['gaClientId'])?$_SESSION['gaClientId']:""
			    ],
			    [
			      "name"	=>	"nomier_na_saiti_314",
			      "value"	=>	$rs['id']
			    ]
			    
	  	),
		"client_attributes"	=>	array(
							"person"	=>	$order_data['fio'],
							"email"		=>	$order_data['email'],
							"status_id"	=>	1,
							"lead"		=>	false,
							"phones"	=>	[$order_data['phone']]
							),
							
		"jobs_attributes"	=>	$items2products
							
	//	,		
	//	"comment"	=>	"Товари:\r\n".$items2comment."\r\nhttps://floren.com.ua/admin/order_info.php?id=".md5($rs['id'])
		
	
	);
	
	$dataString = json_encode($json_string, JSON_UNESCAPED_UNICODE);
	
	//echo $dataString;			//====================TEST CODE LOOK IN /bsk/test_json.php
	//print_r(json_decode($dataString, true));
	//exit();
	
	$url = 'https://api.keepincrm.com/v1/agreements?office_hash_id=fPPFEZWKL1Xu';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
	    'accept: application/json',
	    'X-Auth-Token: AhEhan8p9ksPnpi6JU1wCXiH',
	    'Content-Type: application/json; charset=utf-8',
	    'Content-Length: ' . strlen($dataString)
	]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
	
	$response = curl_exec($ch);
	// PUT keepInCrmId to DB
	$response_data=json_decode($response, true);
	$keepInCrmID=$response_data['id'];
	$db->query("UPDATE orders SET keepInCrmID='".$keepInCrmID."' WHERE id='".$order_id."'");
	
	//mail('info@floren.com.ua','Новый заказ №'.$order_id,$response);
	curl_close($ch);
	?>