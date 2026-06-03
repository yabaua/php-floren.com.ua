<?
error_reporting(E_ALL);
header("content-type: text/html;charset=utf-8 \r\n");
	$DB_HOST="floren.mysql.ukraine.com.ua";
	$DB_CHARSET='utf8';
	// main base
	$DB_USER='floren_utf2025';
	$DB_PASS='i4d4XB48bV';
	$DB_NAME='floren_utf2025';

require("../include/db_mysql.php");
$db=new DB();
$db->connect($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS,$DB_CHARSET);

$db->query("set names utf8");

if(isset($_REQUEST['action']) && $_REQUEST['action']=='cancel'){
	$db->query("UPDATE crm_goods4order SET canceled='1' WHERE ID='".$_REQUEST['ID']."'");
}

?>