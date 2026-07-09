<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	header("content-type: text/html;charset=utf-8 \r\n");
	include("../database.php");
	session_start();
	global $_SESSION;
	
	$url='';
	isset($_REQUEST['url'])	?	$url=$_REQUEST['url']:'';
	
	if(isset($_REQUEST['src'])){
		$db->query("INSERT INTO orders_vb_tg_conv SET
			src			=	'".$_REQUEST['src']."',
			url			=	'".$url."',
			utm_source	=	'".@$_SESSION['utm_source']."',
			utm_medium	=	'".@$_SESSION['utm_medium']."',
			utm_campaign=	'".@$_SESSION['utm_campaign']."',
			ga_clientID	=	'".@$_SESSION['gaClientId']."',
			date_add	=	UNIX_TIMESTAMP()
			
		");
		
	}
?>