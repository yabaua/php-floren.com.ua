<?
//================
//================

// Script to connect CRM Orders. Just to have a link from our site 

//================
//================
header('Content-Type: application/json;charset=utf-8');
header('Accept: application/json');

	$DB_HOST="floren.mysql.ukraine.com.ua";
	$DB_CHARSET='UTF8';
	// main base
	$DB_USER='floren_utf2025';
	$DB_PASS='i4d4XB48bV';
	$DB_NAME='floren_utf2025';

require("../include/db_mysql.php");

$db=new DB2();
$db->connect();



$postData = file_get_contents('php://input');
$income_data = json_decode($postData, true);

//	print_r($income_data);
// =============GET DATA FROM CRM============
	$url = 'https://api.keepincrm.com/v1/tasks/'.$income_data['id'];
//	$url = 'https://api.keepincrm.com/v1/tasks/20439249';
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
$custom_fields_description = '';
foreach($data->custom_fields_detailed AS $cf=>$det){
	if($det->name == 'opis_zadachi_317'){
		$custom_fields_description = $det->value;
	}
}


$crmID=$data->id;
$crmTaskTitle=$data->title;
$crmTaskOverdue = $data->overdue;
$crmResultStatus=$data->archive_status->name;
$crmTaskCreated = date("U",strtotime($data->created_at));
$crmTaskDeadline=date("U",strtotime($data->deadline_at));
$crmTaskCompleted=date("U",strtotime($data->completed_at)) ?? 0;
$crmCreatorID=$data->creator->id;
$crmMainResponsibleID=$data->main_responsible->id;
$keepInCrmClientData=$data->client->person;
$keepInCrmClientID=$data->client->id;
$keepInCrmAgreementID=$data->agreement->id;
$keepInCrmAgreementTitle=$data->agreement->title;


//$SQLstr=$crmID."=>".$total."=>".$result."=>".$stage_name."=>".$stage_id."=>".$status_name."=>".$status_id."<=";
//$jsondata=var_dump($data);

//$db->query("UPDATE ordersCrm2logist SET
//				orderTitle='".$jsondata."'");
$db->query("SELECT keepInCrmTaskID FROM crm_tasks WHERE keepInCrmTaskID='".$crmID."'");
if($db->num_rows()){
			$query="UPDATE crm_tasks SET
			  title 				= '".$crmTaskTitle."',
			  creatorID 			= '".$crmCreatorID."',
			  responsibleID 		= '".$crmMainResponsibleID."',
			  agreementID 			= '".$keepInCrmAgreementID."',
			  agreementTitle		= '".$keepInCrmAgreementTitle."',
			  clientID	 			= '".$keepInCrmClientID."',
			  clientData 			= '".$keepInCrmClientData."',
			  created_at			= '".$crmTaskCreated."',
			  deadline_at 			= '".$crmTaskDeadline."',
			  completed_at 			= '".$crmTaskCompleted."',
			  overdue 				= '".$crmTaskOverdue."',
			  description 			= '".$custom_fields_description."'
			WHERE keepInCrmTaskID='".$crmID."'";
			echo $query;
			$db->query($query);
			//mail('info@floren.com.ua','order'.$order_id,$query);
}


?>