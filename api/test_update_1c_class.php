<?php


error_reporting(E_ALL);
header("content-type: text/html;charset=utf-8 \r\n");
	$DB_HOST="floren.mysql.ukraine.com.ua";
	$DB_CHARSET='utf8';
	// main base
	$DB_USER='floren_utf2025';
	$DB_PASS='i4d4XB48bV';
	$DB_NAME='floren_utf2025';

require("../include/db_mysql.php");
require("../include/resize.php");

$db = new DB2();
$db->connect();

$db->query("SELECT * FROM goods_1c_class LIMIT 3000, 1000");
while($rs=$db->fetch()){
	$db->query("SELECT * FROM report_goods WHERE barcode='".$rs['barcode']."' AND className!='".$rs['className']."'", 1);
	if($db->num_rows(1)){
		echo "UPDATE report_goods SET className='".$rs['className']."' WHERE barcode='".$rs['barcode']."'<br>";	
	}

}