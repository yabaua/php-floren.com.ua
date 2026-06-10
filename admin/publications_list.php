<?php
//set_magic_quotes_runtime(0);
require("auth.php");
include("../include/strlib.php");

if (!isset($_REQUEST['lang'])){
	$lang='ua';
	$db_sufix='_ua';
	$btn_lang = 'lang_ua';
	$lang_param="&lang=ua";
}else{		
	$lang=$_REQUEST['lang'];
	$db_sufix=	$_REQUEST['lang']=='ru'?'':('_'.$_REQUEST['lang']);
	$btn_lang = 'lang_'.$_REQUEST['lang'];
	$lang_param="&lang=".$_REQUEST['lang'];
}

if(isset($_REQUEST['add_article'])){
	$df=explode(".", $_REQUEST['pdate']);
	$date=mktime(0, 0, 0, $df[1], $df[0], $df[2]);

	$db->query("INSERT INTO publications".$db_sufix." SET
		title='".$_REQUEST['ptitle']."',
		alias='".transliterate($_REQUEST['ptitle'])."',
		meta_description='".$_REQUEST['pdescription']."',
		body='".$_REQUEST['pbody']."',
		date_add='".$date."'");
	header("location:publications_list.php?lang=".$lang);
}
if(isset($_REQUEST['delart'])){
	echo "cccc";
	print_r($_REQUEST['delart']);
//	foreach($_REQUEST['delart'] AS $k=>$v){
//		mysql_query("DELETE FROM publications WHERE ID='".$k."'");
//	}
//	header("location:publications_list.php");
}
if(isset($_REQUEST['update'])){
	$db->query("DELETE FROM publications_pub2cat");
	foreach($_REQUEST['pub'] AS $k=>$v){
			$pub_arr=explode("_", $k);
			$db->query("INSERT INTO publications_pub2cat SET pubID='".$pub_arr[1]."', catID='".$v."'");
	}
}
?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="/admin/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" type="text/css" href="style_back.css">
</head>
<body style="margin-left:20px;">
<?php 
//============================

	include("top_menu.php");

//============================
?>
<h3>Список статей</h3>



<form name="f2" method="post" action="publications_list.php?lang=<?=$lang?>">
<input type="Submit" name="update" class="button" value="Обновить">
<table cellspacing="0">
<?php 
$qr=$db->query("SELECT * FROM publications".$db_sufix." ORDER BY date_add DESC");
for($i=0;$rs=$db->fetch();$i++){
?>
<tr<?php if($i%2==1) echo ' bgcolor="#EEE7DF"'?>>
	<td width="210">
		<?php if($rs['images']!=''){?>
		<img src="<?=str_replace('content/b-','content/s-', $rs['images'])?>" width="200" />
		<?php }?>
	</td>
	<td><a href="publications_edit.php?lang=<?=$lang?>&ID=<?=$rs['ID']?>"><?=$rs['title']?></a></td>
	<td><input type="Submit" name="delart[<?=$rs['ID']?>]" class="delete_but" value=""></td>
	<td>
		<?php 
			$db->query("SELECT * FROM publications_category pc LEFT JOIN publications_pub2cat p2c ON p2c.catID=pc.ID AND p2c.pubID='".$rs['ID']."'", 1);
			
			while ($rs2=$db->fetch(1)){
		?>
			<div style="padding:3px;">
				<input type="checkbox"
					name="pub[<?=$rs2['ID']?>_<?=$rs['ID']?>]"
					id="<?=$rs2['ID']?>_<?=$rs['ID']?>"
					value="<?=$rs2['ID']?>"
					<?php if($rs2['pubID']) echo ' checked="checked"';?>
				>&nbsp;&nbsp;<label for="<?=$rs2['ID']?>_<?=$rs['ID']?>"><?=$rs2['name']?></label>
			</div>
		<?php }?>
	</td>
</tr>
<?php }?>
</table>
<input type="Submit" name="update" class="button" value="Обновить">
</form>
<p>&nbsp;</p>
<h3>Добавить статью</h3>
<form name="f1" method="post" action="publications_list.php?lang=<?=$lang?>">
<div>
	Название<br>
	<input type="Text" name="ptitle" class="input_type" style="width:300px;">
</div>
<div>
	Дата:<br>
	<input type="Text" name="pdate" class="input_type" style="width:300px;" value="<?=date("d.m.Y", time());?>">
</div>
<div>
	Description<br>
	<textarea name="pdescription" class="input_type" style="width:300px;height:70px;"></textarea>
</div>
<div>
	Тело статьи<br>
	<textarea id="content" name="pbody" style="width:600px;height:400px;" rows="20" cols="50">
                
            </textarea>
            <script>
                CKEDITOR.replace( 'pbody', {
					allowedContent: true,
					width: '70%',
					height: 500
				} );
            </script>
</div>
<input type="Submit" name="add_article" class="button" value="Добавить">

</form>
<p>&nbsp;</p>
<p>&nbsp;</p>