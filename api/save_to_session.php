<?
header("content-type: text/html;charset=utf-8 \r\n");
include("../database.php");
session_start();
if(isset($_REQUEST['gaClientId']) && $_REQUEST['gaClientId']!='') $_SESSION['gaClientId']=$_REQUEST['gaClientId'];

/*
	$html_header = "MIME-Version: 1.0\r\n";
	$html_header .= "Content-type: text/html; charset=utf-8\r\n";
	$html_header .= "From: <info@floren.com.ua>\r\n";
	$db->query("INSERT INTO admins SET login='".rand().time()."', name='".$_REQUEST['gaClientId']."'");
	@mail('info@floren.com.ua', 'test', '=='.$_REQUEST['gaClientId'].'++', $html_header);
*/
?>