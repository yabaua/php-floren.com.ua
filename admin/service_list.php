<?php 
//set_magic_quotes_runtime(0);
require("auth.php");
include("../include/strlib.php");

if (!isset($_REQUEST['lang'])){
		$lang='ua';
		$db_sufix='_ua';
		$btn_lang = 'lang_ua';
	}else{		
		$lang=$_REQUEST['lang'];
		$db_sufix=	$_REQUEST['lang']=='ru'?'':('_'.$_REQUEST['lang']);
		$btn_lang = 'lang_'.$_REQUEST['lang'];
	}

if(isset($_REQUEST['add_article'])){

	$db->query("INSERT INTO services SET
							title='".$_REQUEST['ptitle']."',
							menuttl='".$_REQUEST['menuttl']."',
							alias='".transliterate($_REQUEST['menuttl'])."',
							meta_description='".$_REQUEST['pdescription']."',
							body='".$_REQUEST['pbody']."'");
	$db->query("INSERT INTO services_ua SET
							title='".$_REQUEST['ptitle']."',
							menuttl='".$_REQUEST['menuttl']."',
							alias='".transliterate($_REQUEST['menuttl'])."',
							meta_description='".$_REQUEST['pdescription']."',
							body='".$_REQUEST['pbody']."'");
	header("location:service_list.php?lang=".$lang);
}
if(isset($_REQUEST['delart'])){
	foreach($_REQUEST['delart'] AS $k=>$v){
		$db->query("DELETE FROM services WHERE ID='".$k."'");
		$db->query("DELETE FROM services_ua WHERE ID='".$k."'");
	}
	header("location:service_list.php?lang=".$lang);
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="/admin/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" type="text/css" href="style_back.css?v=2">
</head>
<body style="margin-left:20px;">
<div class="holder" style="margin:10px 0;padding:10px 0;">
	<a href="?&lang=ru" class="adm-btn adm-btn_max<?=$lang=='ru'?' btn_active':''?>">RU</a>
	<a href="?&lang=ua" class="adm-btn adm-btn_max<?=$lang=='ua'?' btn_active':''?>">UA</a>
</div>
<h3>Список Услуг</h3>
<form name="f1" method="post" action="service_list.php">
<table class="tbl" cellpadding="4" cellspacing="0" border=0>
<?php 
$db->query("SELECT * FROM services".$db_sufix." ORDER BY title");
for($i=0;$rs=$db->fetch();$i++){
?>
<tr<?php if ($i%2==1) echo ' bgcolor="#EEE7DF"'?>>
	<td style="font-size:14px;"><a href="service_edit.php?ID=<?=$rs['ID']?>&lang=<?=$lang?>"><?=$rs['title']?></a></td>
	<td><input type="Submit" name="delart[<?=$rs['ID']?>]" class="delete_but" value="&#10006;"></td>
</tr>
<?php }?>
</table>
<p>&nbsp;</p>
<h3>Добавить статью</h3>
<div>
Название пункта меню<br>
<input type="Text" name="menuttl" class="input_type" style="width:300px;">
</div>
<div>
Название<br>
<input type="Text" name="ptitle" class="input_type" style="width:300px;">
</div>
<div>
Description<br>
<textarea name="pdescription" class="input_type" style="width:300px;height:70px;"></textarea>
</div>
<div>

<textarea id="content" name="pbody" style="width:600px;height:600px;" rows="20" cols="50">
              
            </textarea>
            <script>
                CKEDITOR.replace( 'pbody', {
					allowedContent: true,
					width: '80%',
					height: 600
				} );
            </script>

</div>
<input type="Submit" name="add_article" class="button" value="Добавить">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>