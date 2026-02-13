<?php
//setlocale(LC_ALL, 'ru_RU');
if(isset($_POST) && count($_POST)){
	function send_mail($to,$subject,$body) {
		$nn="\r\n";
		$from='noreply@floren.ua';
		mail($to,$subject,$body,
			'Date: '.date('r').$nn.
			'From: '.$from.$nn.
			'Reply-To: '.$from.$nn.
			'X-Priority: 3 (Normal)'.$nn.
			//'To: '.$e_mail.$nn.
			'MIME-Version: 1.0'.$nn.
			'Content-Type: text/html; charset=utf-8'.$nn
		);
	}

	
            $topic		=	str_replace("'", "`", $_REQUEST['cb_topic']);
            $subject	=	$_REQUEST['cb_topic'];
            $name		= base64_encode($_REQUEST['cb_name']);
            $cb_phone		=	strtolower($_REQUEST['cb_phone']);
            $cb_txt		=	base64_encode($_REQUEST['cb_txt']);
            $cb_page		=	str_replace('https://floren.com.ua','',$_SERVER['HTTP_REFERER']);

            /* SPAM Filter */
    
            $is_spam = false;
            $spam_worlds = array('http', 'profile', 'guys', 'free', 'here', 'click', 'seo', 'ceo', 'sex', 'domain', 'test', 'продвижение');
			$spam_worlds_name = array();
			$spam_worlds_topic = array('unable');
            
      foreach ($spam_worlds as $sw) {
                if (strpos($_REQUEST['cb_txt'], $sw) !== false) {
                    $is_spam = true;
                }
      }
			foreach($spam_worlds_name as $sn) {
                if (strpos($_REQUEST['cb_phone'], $sn) !== false) {
                    $is_spam = true;
                }
			}
			foreach($spam_worlds_topic as $st) {
                if (strpos($_REQUEST['cb_topic'], $st) !== false) {
                    $is_spam = true;
                }
      }
            
            if ($_REQUEST['cb_topic']=='') $is_spam = true;

      if (!$is_spam) {

	        $db->query("INSERT INTO callback (cb_topic,cb_name,cb_phone,cb_txt,cb_page,cb_date) VALUES ('".$topic."', '".$name."', '".$cb_phone."', '".$cb_txt."', '".$cb_page."', '".time()."')" );
	    }
			
			$body='<p>'.$topic.' (thankyoupage)'.mb_detect_encoding($topic).'</p>';
			$body.='<table>';
			$body.='<tr><td>ФИО:</td>		<td>'.base64_decode($name).'</td></tr>';
			$body.='<tr><td>Телефон / e-mail:</td>	<td>'.$cb_phone.'</td></tr>';
			$body.='<tr><td>Текст:</td>		<td>'.base64_decode($cb_txt).'</td></tr>';
			$body.='<tr><td>Страница:</td>		<td><a href="https://floren.com.ua'.$cb_page.'">'.$cb_page.'</td></tr>';
			$body.='</table>';

            /* END: SPAM Filter */

            if (!$is_spam) {
			
				send_mail('info@floren.com.ua',$subject,$body);
				send_mail('Dmitriy.Zhinzhikov@gmail.com',$subject,$body);
				send_mail('sales@floren.com.ua',$subject,$body);

            }
			
			//TELEGRAM
			$smarty->assign('topic', $topic);
			$smarty->assign('name', base64_decode($name));
			$smarty->assign('phone', $cb_phone);
			$smarty->assign('link', "https://floren.com.ua".$cb_page);
			$smarty->assign('text', base64_decode($cb_txt));

			$group_name = 'plants';

/* 			if (strpos($cb_page, 'florist')>0 || strpos($cb_page, 'florist')>0 ){
				$group_name = 'florist';
			} */

            if (strpos($cb_page, 'buket')) {
                $group_name = 'florist';
            }

            if (!$is_spam) {
			
			$telegram->send($group_name, $smarty->fetch('telegram/lid.tpl'));

            }

			//END TELEGRAM
			
			
		$smarty->assign("CONTENT_TPL",'thankyou.tpl');
		
		//==========================================================================KEEP_IN_CRM=============

		
		
		
		if (!$is_spam) {
		
			$json_string=array(
				"title"		=>	date("y/md-")."lead",
				"total"		=>	1,
				"currency"	=>	"UAH",
				"stage_id"	=>	2,
				"source_id"	=>	1,
				"funnel_id"	=>	1,
				"custom_fields"	=>	 array(
						    [
								"name"	=>	"gaa_utm_source_4449395",
								"value"	=>	$_SESSION['utm_source'] ?? ''
						    ],
						    [
								"name"	=>	"gaa_utm_medium_4449399",
								"value"	=>	$_SESSION['utm_medium'] ?? ''
						    ],
						    [
								"name"	=>	"gaa_utm_campaign_4449398",
								"value"	=>	$_SESSION['utm_campaign'] ?? ''
						    ],
						    /*
						    [
								"name"	=>	"gaa_utm_content_4449397",
								"value"	=>	$_SESSION['utm_content']
						    ],
						    [
								"name"	=>	"gaa_utm_term_4449396",
								"value"	=>	$_SESSION['utm_term']
						    ],
						    */
			    			[
								"name"	=>	"gaclientid_291",
								"value"	=>	$_SESSION['gaClientId'] ?? ''
							]
							
				  	),
				"client_attributes"	=>	array(
									"person"	=>	base64_decode($name),
									"email"		=>	$order_data['email'] ?? '',
									"status_id"	=>	1,
									"lead"		=>	false,
									"phones"	=>	[$cb_phone]
									),		
				"comment"	=>	"Лід з сайту:\r\n".$topic."\r\nПІБ: ".base64_decode($name)."\r\nКонтакт: ".$cb_phone."\r\n".base64_decode($cb_txt)."\r\nСторінка: https://floren.com.ua".$cb_page
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
			//mail('info@floren.com.ua','Новый заказ №'.$order_id,$response);
			curl_close($ch);
		} //if !is_spam
		//============================================================END_KEEP_IN_CRM=============

}else{
	header("HTTP/1.0 301 Moved Permanently"); 
	header("location:/");
	exit();

}
	
	
?>