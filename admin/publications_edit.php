<?
//set_magic_quotes_runtime(0);
error_reporting(E_ALL);
require("auth.php");
include("../include/strlib.php");
require("../include/resize.php");

if(isset($_REQUEST['ID'])){
	$ID=$_REQUEST['ID'];
	$qr=mysql_query("SELECT * FROM publications WHERE ID='".$ID."'");
	$rs=mysql_fetch_array($qr);
}
else header("location:publications_list.php");

if(isset($_REQUEST['edit_article'])){
	$df=explode(".", $_REQUEST['pdate']);
	$date=mktime(0, 0, 0, $df[1], $df[0], $df[2]);

	mysql_query("UPDATE publications SET
	title='".$_REQUEST['ptitle']."',
	meta_title='".$_REQUEST['meta_title']."',
	meta_description='".$_REQUEST['meta_description']."',
	meta_keywords='".$_REQUEST['meta_keywords']."',
	body_top='".addslashes($_REQUEST['pbody_top'])."',
	body='".addslashes($_REQUEST['pbody'])."',
	date_add='".$date."'
	WHERE ID='".$ID."'");
	echo mysql_error();
	header("location:publications_edit.php?ID=".$ID);
}
	if (isset($_FILES['article_image']) && is_uploaded_file($_FILES['article_image']['tmp_name'])) {
		
			$temp_image_name=str_replace('_','-',$rs['alias']).'-'.time().'-1.jpg';
			
			$size=getimagesize($_FILES['article_image']['tmp_name']);
			$ww=(($size[0]<1200)?$size[0]:"1200");
			$hh=(($size[1]<1200)?$size[1]:"1200");
			
			$applyMask=false;
			if (isset($_REQUEST['apply_mask_check']) && $_REQUEST['apply_mask_check']=="on")  $applyMask=true;
			
			img_resize($_FILES['article_image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'images/content/s-'.$temp_image_name, 200,150, 0xFFFFFF, 100, true, false);
			img_resize($_FILES['article_image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'images/content/b-'.$temp_image_name, $ww,$hh, 0xFFFFFF, 90, true, true, $applyMask);
			chmod($_SERVER['DOCUMENT_ROOT'].'images/content/s-'.$temp_image_name,0777);
			chmod($_SERVER['DOCUMENT_ROOT'].'images/content/b-'.$temp_image_name,0777);
			
			mysql_query("UPDATE publications SET images='https://floren.com.ua/images/content/b-".$temp_image_name."' WHERE ID=".$ID);
			mysql_query("UPDATE publications_ua SET images='https://floren.com.ua/images/content/b-".$temp_image_name."' WHERE ID=".$ID);
			header("location:publications_edit.php?ID=".$ID);
	}

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style_back.css">
	<script src="/admin/ckeditor/ckeditor.js"></script>
</head>
<body style="margin-left:20px;">
<form name="f1" method="post" action="publications_edit.php?ID=<?=$ID?>" enctype="multipart/form-data">
<h3>Изменить статью</h3>

<div class="holder">
	<div style="width:350px;float:left;">
		<div>
			Название<br>
			<input type="Text" name="ptitle" class="input_type" style="width:300px;" value="<?=$rs['title']?>">
		</div>
		<div>
			Дата:<br>
			<input type="Text" name="pdate" class="input_type" style="width:300px;" value="<?=date("d.m.Y", $rs['date_add']);?>">
		</div>
		<div>
			meta title<br>
			<textarea name="meta_title" class="input_type" style="width:300px;height:70px;"><?=$rs['meta_title']?></textarea>
		</div>
		<div>
			meta description<br>
			<textarea name="meta_description" class="input_type" style="width:300px;height:70px;"><?=$rs['meta_description']?></textarea>
		</div>
		<div>
			meta keywords<br>
			<textarea name="meta_keywords" class="input_type" style="width:300px;height:70px;"><?=$rs['meta_keywords']?></textarea>
		</div>
	</div>
	<div style="width:350px;float:left;">
		<?if($rs['images']!=''){?>
		<img src="<?=str_replace('content/b-','content/s-', $rs['images'])?>" />
		<?}?>
		<div style="clear:both;padding:15px 0;">
			<b>Загрузить новое:</b> <input type="file" name="article_image"><br />
			<input type="checkbox" checked="true" name="apply_mask_check" />&nbsp;&nbsp;&nbsp;Использовать логотип поверх
			
		</div>
	</div>
</div>
<div>
Шапка статьи<br>
<textarea id="pbody_top" name="pbody_top" style="width:600px;height:400px;" rows="20" cols="50">
           <?echo $rs['body_top']?>
       </textarea>
       <script>
           // Replace the <textarea id="editor1"> with a CKEditor
           // instance, using default configuration.
           CKEDITOR.replace( 'pbody_top', {
allowedContent: true,
width: '70%',
height: 150
} );
       </script>
</div>
<div>
Тело статьи<br>
<textarea id="pbody" name="pbody" style="width:600px;height:400px;" rows="20" cols="50">
           <?echo $rs['body']?>
       </textarea>
       <script>
           // Replace the <textarea id="editor1"> with a CKEditor
           // instance, using default configuration.
           CKEDITOR.replace( 'pbody', {
allowedContent: true,
width: '70%',
height: 300
} );
       </script>
</div>
<input type="Submit" name="edit_article" class="button" value="Изменить">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>