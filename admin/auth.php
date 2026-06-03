<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("content-type: text/html;charset=utf-8 \r\n");
error_reporting(E_ALL);
require('../database.php');
session_start();
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
    $db->query("SELECT * FROM admins WHERE login='$login' AND pass='$pass'");
    if ($db->num_rows()) {
		  $rs=$db->fetch();
		  $_SESSION['admin_name']=$login;
		  $db->query("INSERT INTO admins_log SET adminID='".$rs['ID']."', visit='".time()."'");
      if($_SESSION['admin_name']=='florist')
        header("location:https://floren.com.ua/admin/goods_list.php?category=78");
      else
        header("location:/admin/admin.php");
    }
  }
}
if(isset($_REQUEST['logout'])){
	unset($_SESSION['admin_name']);
	header("location:/admin/admin.php");
}

if (!isset($_SESSION['admin_name']) || !$_SESSION['admin_name']) {
	header("Location: /admin/sadmin.html"); 
	exit(); exit(); exit();
}

?>