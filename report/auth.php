<?
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("content-type: text/html;charset=utf-8 \r\n");
error_reporting(E_ALL);
require("../database.php");
session_start();
setlocale(LC_ALL, "ru_RU.UTF-8");

if (!isset($_SESSION['IP']) || $_SESSION['IP']!=$_SERVER['REMOTE_ADDR'] || isset($logout)) {
  $_SESSION=array();
  $_SESSION['IP']=$_SERVER['REMOTE_ADDR'];
  $_SESSION['IP2']=@$_SERVER['$HTTP_X_FORWARDED_FOR'];
}
$session=session_id();

if (isset($_REQUEST['login']) && isset($_REQUEST['pass'])) {
  $login=preg_replace('/[^0-9a-zA-Z_]/','',$_REQUEST['login']);
  $pass=md5($_REQUEST['pass']);
  if ($login) {
	$r=mysql_query("SELECT * FROM admins WHERE login='$login' AND pass='$pass' AND dept='report'");
	if (mysql_num_rows($r)) {
		$rs=mysql_fetch_array($r);
		$_SESSION['admin_name']=$login;
		  
		if($login=='report') {
			$admin_lvl='top';
			$redirect_url='report_crm.php';
		}elseif($login=='cpcoutsource'){
			$admin_lvl='cpcoutsource';
			$redirect_url='report_crm_cpc.php';
		} else {
			$admin_lvl='middle';
			$redirect_url='report_source.php';
		}
		
		$_SESSION['admin_lvl']=$admin_lvl;
		 
		  mysql_query("INSERT INTO admins_log SET adminID='".$rs['ID']."', visit='".time()."'");
		  
//		echo "location:/report/".$redirect_url;
//		print_r($_SESSION);

        header("location:/report/".$redirect_url);
    }
  }
}

if(isset($_REQUEST['logout'])){
	unset($_SESSION['admin_name']);
	header("location:/report/index.html");
}

if (!isset($_SESSION['admin_name']) || !$_SESSION['admin_name']) {
	header("Location: /report/index.html"); 
	exit(); exit(); exit();
}
?>