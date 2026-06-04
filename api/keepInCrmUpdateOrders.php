<?php
error_reporting(E_ALL);
//================
//================

// Script to connect CRM Orders. Just to have a link from our site 

//================
//================
header('Content-Type: application/json;charset=utf-8');
header('Accept: application/json');

require("../database.php");

$postData = file_get_contents('php://input');
$income_data = json_decode($postData, true);

//	print_r($income_data);
// =============GET DATA FROM CRM============
		$url = 'https://api.keepincrm.com/v1/agreements/'.$income_data['id'];
//	$url = 'https://api.keepincrm.com/v1/agreements/33122661';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
	    'accept: application/json',
	    'X-Auth-Token: AhEhan8p9ksPnpi6JU1wCXiH',
	    'Content-Type: application/json; charset=utf-8'
	]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$data=json_decode($response);
//	print_r($data);	
//====CUSTOM-FIELDS======
foreach($data->custom_fields_detailed AS $cf=>$det){
	if($det->name == 'tip_oplati_6124995'){
		$custom_fields_tip_oplaty = $det->value;
	}
	if($det->name == 'adriesa_4658058'){
		$custom_fields_address = str_replace("'", "", $det->value);
	}
	if($det->name == 'gaa_utm_source_4449395'){
		$custom_fields_utm_source = $det->value;
	}
	if($det->name == 'gaa_utm_campaign_4449398'){
		$custom_fields_utm_campaign = str_replace("'", "", str_replace("%20", " ", $det->value));
	}
	if($det->name == 'gaa_utm_medium_4449399'){
		$custom_fields_utm_medium = $det->value;
	}
	if($det->name == 'dostavka_4656739'){
		$custom_fields_deliveryWay = $det->value;
	}
	if($det->name == 'data_vidghruzki_307'){
		$custom_fields_deliveryDate = $det->value;
	}
}
//lets take Last ttn
foreach($data->deliveries AS $dID=>$dVal){
	$last_ttn = $dVal->ttn;
}





$crmID=$data->id;
$crmOrderTitle=$data->title;
$crmOrderFunnel=$data->funnel->id;
$crmOrderResult=$data->result;
$crmOrderStage=$data->stage->name;
$crmResultStatus=$data->archive_status->name	 ?? '';
$crmOrderTotal=$data->total	 ?? '';
$crmOrderPaid=$data->paid	 ?? '';
$crmOrderToPay=$data->credit	 ?? '';
$crmOrderPayWay=$custom_fields_tip_oplaty	 ?? '';
$crmOrderDate=date("U",strtotime($data->created_at));
$crmMainResponsibleID=$data->main_responsible->id	 ?? '';
$crmOrderSource=$data->source->name	 ?? '';
$utm_source=$custom_fields_utm_source	 ?? '';
$utm_medium=$custom_fields_utm_medium	 ?? '';
$utm_campaign=mb_strtolower($custom_fields_utm_campaign	 ?? '', 'UTF-8');
$deliveryWay=$custom_fields_deliveryWay	 ?? '';
$deliveryDate=$custom_fields_deliveryDate	 ?? '';
$address = $custom_fields_address	 ?? '';
$ttn=$last_ttn	 ?? '';

//$SQLstr=$crmID."=>".$total."=>".$result."=>".$stage_name."=>".$stage_id."=>".$status_name."=>".$status_id."<=";
//$jsondata=var_dump($data);

//$db->query("UPDATE ordersCrm2logist SET
//				orderTitle='".$jsondata."'");
$db->query("SELECT * FROM orders_crm WHERE keepInCrmID='".$crmID."'");
if($db->num_rows()){
			$query="UPDATE orders_crm SET
				orderTitle='".$crmOrderTitle."',
				orderFunnel='".$crmOrderFunnel."',
				orderResult='".$crmOrderResult."',
				orderStage='".$crmOrderStage."',
				resultStatus='".$crmResultStatus."',
				orderTotal='".$crmOrderTotal."',
				orderPaid='".$crmOrderPaid."',
				orderToPay='".$crmOrderToPay."',
				orderPayWay='".$crmOrderPayWay."',
				orderDate='".$crmOrderDate."',
				mainResponsibleID='".$crmMainResponsibleID."',
				orderSource='".$crmOrderSource."',
				utm_source='".$utm_source."',
				utm_medium='".$utm_medium."',
				utm_campaign='".$utm_campaign."',
				deliveryWay='".$deliveryWay."',
				deliveryDate='".$deliveryDate."',
				address='".$address."',
				ttn='".$ttn."'		
			WHERE keepInCrmID='".$crmID."'";
		//	echo $query;
			$db->query($query);
			echo "Floren Updated Agreements:". $db->affected_rows(); ;
			//mail('info@floren.com.ua','order'.$order_id,$query);
}


//========================= INSERT INTO pid zamovlennya =======================
if($data->stage->name == 'Під замовлення'){
	$db->query("SELECT * FROM crm_goods4order WHERE keepInCrmAgreementID='".$crmID."'");
	if($db->num_rows()){
		$db->query("DELETE FROM crm_goods4order WHERE keepInCrmAgreementID='".$crmID."'");
	}
	foreach($data->jobs AS $j=>$jj){
		$title		=	$jj->title;
		$amount		=	$jj->amount;
		$barcode	=	$jj->sku;
		$price		=	$jj->price;
		
		$query = "INSERT INTO crm_goods4order SET
					keepInCrmAgreementID	=	'".$crmID."',
					keepInCrmAgreementTitle	=	'".$crmOrderTitle."',
					orderDate				=	'".$crmOrderDate."',
					who_ordered				=	'".$crmMainResponsibleID."',
					barcode					=	'".$barcode."',
					title					=	'".$title."',
					amount					=	'".$amount."',
					price					=	'".$price."'
				";
		$db->query($query);
		
	}
}

?>