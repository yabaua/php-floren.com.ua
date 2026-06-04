<?php
header('Content-Type: application/json;charset=utf-8');
header('Accept: application/json');

require("../database.php");

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$crmID=$data['id'];
$total=$data['total'];
$result=$data['result'];
$stage_name=$data['stage_name'];
$stage_id=$data['stage_id'];
$status_name=$data['status_name'];
$status_id=$data['status_id'];

//$SQLstr=$crmID."=>".$total."=>".$result."=>".$stage_name."=>".$stage_id."=>".$status_name."=>".$status_id."<=";

//$jsondata=var_dump($data);

$db->query("UPDATE orders SET
			keepInCrmResult='".$result."',
			keepInCrmStatus='".$status_name."',
			keepInCrmStatusID='".$status_id."',
			keepInCrmStage='".$stage_name."',
			keepInCrmStageID='".$stage_id."',
			keepInCrmTotal='".$total."'
			WHERE keepInCrmId='".$crmID."'
");
echo $response="Updated agreements: ".$db->affected_rows();
//mysql_query("INSERT INTO orders_testjson (jsondata) VALUES ('".$SQLstr."')");
//mail('info@floren.com.ua','order'.$order_id,$json_string); // test for generated query

?>