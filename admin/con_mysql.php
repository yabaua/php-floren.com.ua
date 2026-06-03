<?php
if ($_SERVER["SERVER_NAME"]=="floren.com.ua"){
	$DB_HOST="floren.mysql.ukraine.com.ua";
	$DB_CHARSET='utf8';
	// main base
	$DB_USER='floren_utf2025';
	$DB_PASS='i4d4XB48bV';
	$DB_NAME='floren_utf2025';
}else{
	$DB_CHARSET='WIN1251';
	$DB_HOST="localhost";
	//// main base
	$DB_USER='root';
	$DB_PASS='root';
	$DB_NAME='floren';
}

require("../include/db_mysql.php");

$db=new DB();
$db->connect($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS,$DB_CHARSET);
$db->query("SET NAMES '".$DB_CHARSET."'");
?>