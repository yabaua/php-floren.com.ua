<?
//================
//================

// Script to connect CRM Orders. Just to have a link from our site 

//================
//================
header('Content-Type: application/json;charset=utf-8');
header('Accept: application/json');

require("../database.php");

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);
if($data){
	$crmID=$data['id'];
	$hash=md5($crmID);
	
	//$SQLstr=$crmID."=>".$total."=>".$result."=>".$stage_name."=>".$stage_id."=>".$status_name."=>".$status_id."<=";
	//$jsondata=var_dump($data);
	
	$db->query("INSERT INTO crm_tasks (keepInCrmTaskID, hash) VALUES ('".$crmID."', '".$hash."')");
	//echo $response="Updated agreements: ".mysql_affected_rows();
	
	$json_string=array("link"=>"https://floren.com.ua/crm/task.php?hash=".$hash);
	$dataString = json_encode($json_string, JSON_UNESCAPED_UNICODE);
	echo $dataString;
	//echo $hash;
	//mysql_query("INSERT INTO orders_testjson (jsondata) VALUES ('".$SQLstr."')");
	//mail('info@floren.com.ua','order'.$order_id,$json_string); // test for generated query
}else{
	echo "go Away";
}
?>