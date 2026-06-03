<?php
	error_reporting(E_ALL);
	header("content-type: text/html;charset=utf-8 \r\n");
	include("../database.php");
	session_start();
	global $_SESSION;
	

	$roas=		'';
	$campName=	'';
	$cpcCost=	'';
	$gross=	'';
	
	$roas=$_REQUEST['roas'];
	$campName=$_REQUEST['campName'];
	$cpcCost=$_REQUEST['cpcCost'];
	$cpcGross=$_REQUEST['gross'];
	
	$qr=mysql_query("SELECT * FROM orders_crm_roas WHERE campName='".$campName."' AND date_add='".strtotime("today")."'");
	if(mysql_num_rows($qr)){
		mysql_query("UPDATE orders_crm_roas SET
			roasOnDate='".$roas."',
			cpcCost='".$cpcCost."',
			cpcGross='".$cpcGross."'
			WHERE campName='".$campName."' AND	date_add='".strtotime("today")."'");
	}else{
		mysql_query("INSERT INTO orders_crm_roas SET
			campName='".$campName."',
			roasOnDate='".$roas."',
			cpcCost='".$cpcCost."',
			cpcGross='".$cpcGross."',
			date_add='".strtotime("today")."'");
	}
?>