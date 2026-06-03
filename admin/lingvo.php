<?
//set_magic_quotes_runtime(0);
require("auth.php");
include("../include/strlib.php");

if(isset($_REQUEST['add_new'])){
	
	$page='general';
	if($_REQUEST['page']!=='') $page=$_REQUEST['page'];

	mysql_query("INSERT INTO lingvo SET
	alias='".$_REQUEST['alias']."',
	page='".$page."',
	txt_ru='".$_REQUEST['txt_ru']."',
	txt_ua='".addslashes($_REQUEST['txt_ua'])."'");
	echo mysql_error();
//	header("location:lingvo.php");
}
if(isset($_REQUEST['delart'])){
	foreach($_REQUEST['delart'] AS $k=>$v){
		mysql_query("DELETE FROM lingvo WHERE ID='".$k."'");
	}
	echo mysql_error();
	header("location:lingvo.php");
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="/admin/ckeditor/ckeditor.js"></script>
		<link rel="stylesheet" type="text/css" href="style_back.css">	
	</head>
<body style="margin-left:20px;">
<h2>Переводчик</h2>
<form name="f1" method="post" action="lingvo.php">
<p>&nbsp;</p>
<h3>Добавить слово</h3>
<table cellspacing="5">
<tr>
	<td>Алиас</td>
	<td>Страница</td>
	<td>Русский</td>
	<td>Українська</td>
	<td>&nbsp;<td>
</tr>
<tr>
	<td><input type="Text" name="alias" class="input_type" style="width:200px;"></td>
	<td><input type="Text" name="page" class="input_type" style="width:200px;"></td>
	<td><input type="Text" name="txt_ru" class="input_type" style="width:250px;"></td>
	<td><input type="Text" name="txt_ua" class="input_type" style="width:250px;"></td>
	<td><input type="Submit" name="add_new" class="button" value="Добавить"></td>
</tr>
</table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>


<form name="f2" method="post" action="lingvo.php">
<table cellspacing="0" class="tbl">
<tr>
	<th width="150">Алиас</th>
	<th width="150">Страница</th>
	<th width="350">Русский</th>
	<th width="350">Українська</th>
	<th>&nbsp;</th>
</tr>
<?
$qr=mysql_query("SELECT * FROM lingvo ORDER BY txt_ru DESC");
for($i=0;$rs=mysql_fetch_array($qr);$i++){
?>

<tr<?if($i%2==1) echo ' bgcolor="#EEE7DF"'?>>
	<td><?=$rs['alias']?></td>
	<td><?=$rs['page']?></td>
	<td><?=$rs['txt_ru']?></td>
	<td><?=$rs['txt_ua']?></td>
	<td><input type="Submit" name="delart[<?=$rs['ID']?>]" class="delete_but" value=""></td>
</tr>
<?}?>
</table>