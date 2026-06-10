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

if(isset($_REQUEST['ID'])) $ID=$_REQUEST['ID'];
else header("location:service_list.php");

if(isset($_REQUEST['edit_article'])){

	$db->query("UPDATE services".$db_sufix." SET
	title='".$_REQUEST['ptitle']."',
	menuttl='".$_REQUEST['menuttl']."',
	meta_title='".$_REQUEST['meta_title']."',
	meta_description='".$_REQUEST['meta_description']."',
	meta_keywords='".$_REQUEST['meta_keywords']."',
	body='".addslashes($_REQUEST['pbody'])."'
	WHERE ID='".$ID."'");
	header("location:service_edit.php?ID=".$ID."&lang=".$lang);
}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_back.css">
	<script src="/admin/ckeditor/ckeditor.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="margin-left:20px;">
<?php
	if (!isset($lang)) $lang='ua';
	if (isset($ID)) $urlID='&ID='.$ID;
?>
<div class="holder" style="margin:10px 0;padding:10px 0;">
	<a href="?lang=ru<?=$urlID?>" class="adm-btn adm-btn_max<?=$lang=='ru'?' btn_active':''?>">RU</a>
	<a href="?lang=ua<?=$urlID?>" class="adm-btn adm-btn_max<?=$lang=='ua'?' btn_active':''?>">UA</a>
</div>
<form name="f1" method="post" action="service_edit.php?lang=<?=$lang?><?=$urlID?>">
<h3>Изменить услугу</h3>
<?php 
$db->query("SELECT * FROM services".$db_sufix." WHERE ID='".$ID."'");
$rs=$db->fetch();
?>
<div>
	Название пункта меню<br>
	<input type="Text" name="menuttl" class="input_type" style="width:300px;" value="<?=$rs['menuttl']?>">
</div>
<div>
	Название<br>
	<input type="Text" name="ptitle" class="input_type" style="width:300px;" value="<?=$rs['title']?>">
</div>
<div>
	meta title<br>
	<textarea name="meta_title" class="input_type" style="width:300px;height:70px;"><?=$rs['meta_title']?></textarea>
</div>
<div>
	meta keywords<br>
	<textarea name="meta_keywords" class="input_type" style="width:300px;height:70px;"><?=$rs['meta_keywords']?></textarea>
</div>
<div>
	meta description<br>
	<textarea name="meta_description" class="input_type" style="width:300px;height:70px;"><?=$rs['meta_description']?></textarea>
</div>
<div>
	Тело статьи<br>
	<textarea id="content" name="pbody" style="width:600px;height:400px;" rows="20" cols="50">
                <?=$rs['body']?>
            </textarea>
            <script>
                CKEDITOR.replace( 'pbody', {
					allowedContent: true,
					width: '80%',
					height: 600
				} );
            </script>
</div>
<input type="Submit" name="edit_article" class="button" value="Изменить">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>