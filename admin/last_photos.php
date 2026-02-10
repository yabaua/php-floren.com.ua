<?
error_reporting(E_ALL);
require("auth.php");
require("../include/strlib.php");
require("../include/resize.php");
//id товара

if (!isset($_REQUEST['lang'])){
		$lang='ua';
		$db_sufix='_ua';
		$btn_lang = 'lang_ua';
	}else{		
		$lang=$_REQUEST['lang'];
		$db_sufix=	$_REQUEST['lang']=='ru'?'':('_'.$_REQUEST['lang']);
		$btn_lang = 'lang_'.$_REQUEST['lang'];
	}


//==============Категория товара
//Удаление фото
if(isset($_REQUEST['del_img_s'])){
	print_r($_REQUEST['del_img_s']);
	
	foreach($_REQUEST['del_img_s'] as $k=>$v){
		
		$qr=mysql_query("SELECT * FROM last_photos WHERE ID='".$k."'");
		$rs=mysql_fetch_array($qr);

		@unlink($_SERVER['DOCUMENT_ROOT']."/images/lastphotos/b/".$rs['photo_url']);
		@unlink($_SERVER['DOCUMENT_ROOT']."/images/lastphotos/s/".$rs['photo_url']);
		mysql_query("DELETE FROM last_photos WHERE ID=".$k);
	}
}

//======================Обновление объекта
if (isset($_REQUEST['add_photo']) && ($photo_name=trim($_REQUEST['photo_name'])) && isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

	$photo_dsc=$_REQUEST['photo_dsc'];
	$photo_name=$_REQUEST['photo_name'];
	$photo_dsc_ua=$_REQUEST['photo_dsc_ua'];
	$photo_name_ua=$_REQUEST['photo_name_ua'];
	
			$photo_url=transliterate(strtolower($photo_name)).'-'.time().'.jpg';
			
			echo $photo_url;

			
			$size=getimagesize($_FILES['image']['tmp_name']);
			$ww=(($size[0]<1600)?$size[0]:"1600");
			$hh=(($size[1]<1600)?$size[1]:"1600");
			
			$applyMask=false;
			if (isset($_REQUEST['apply_mask_check']) && $_REQUEST['apply_mask_check']=="on")  $applyMask=true;
			
			img_resize($_FILES['image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/lastphotos/s/'.$photo_url, 250,250, 0xFFFFFF, 70, true, false);
			img_resize($_FILES['image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/lastphotos/b/'.$photo_url, $ww,$hh, 0xFFFFFF, 90, true, true, $applyMask);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/lastphotos/b/'.$photo_url,0777);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/lastphotos/s/'.$photo_url,0777);
			
			mysql_query("INSERT INTO last_photos (photo_name, photo_name_ua, photo_url, photo_dsc, photo_dsc_ua, date_add) VALUES ('".$photo_name."', '".$photo_name_ua."', '".$photo_url."', '".$photo_dsc."', '".$photo_dsc_ua."', '".time()."')");
	
	echo mysql_error();
	echo '<FONT COLOR="#FF0000">Фото добавлено</FONT>';
	
	
}

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="/admin/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" type="text/css" href="style_back.css">
</head>
<body style="margin-left:20px;">
<div class="holder" style="margin:10px 0;padding:10px 0;">
	<a href="?&lang=ru" class="adm-btn adm-btn_max<?=$lang=='ru'?' btn_active':''?>">RU</a>
	<a href="?&lang=ua" class="adm-btn adm-btn_max<?=$lang=='ua'?' btn_active':''?>">UA</a>
</div>
<h3>Последние работы</h3>
<br>
<br>
<div style="width:500px;">

<form name="form" id="form" action="last_photos.php" method="post" enctype="multipart/form-data">
			<b>Назва РУС:</b><br />
			<input type="text" name="photo_name" value='' class="input_type" style="width:420px;">
			<br /><b>Назва УКР:</b><br />
			<input type="text" name="photo_name_ua" value='' class="input_type" style="width:420px;">
			<p>&nbsp;</p>
			<div style="clear:both;padding:10px 0;">
				<b>Загрузить новое фото</b> 
				<br />
				<input type="file" name="image">
				<br />
				<input type="checkbox" checked="true" name="apply_mask_check" />&nbsp;&nbsp;&nbsp;Использовать логотип поверх
			</div>
			<p>&nbsp;</p>
			<b>Краткое описание РУС:</b><br />
			<textarea name="photo_dsc" class="input_type" style="width:420px;height:65px;"></textarea>
			<br />
			<b>Короткий опис УКР:</b><br />
			<textarea name="photo_dsc_ua" class="input_type" style="width:420px;height:65px;"></textarea>
			<p>&nbsp;</p>
			<INPUT TYPE="submit" name="add_photo" value="Додати" class="button">
</div>
<style>
.instagram-indx div {
				display:block;
				float:left;
				margin:0 5px 5px 0;
				width:180px;
				
				
			}
		.instagram-indx .image{
			display:block;
			overflow:hidden;
			border:2px solid #FFF;
			box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			line-height:0px;
		}
		.instagram-indx p{
			margin-top: 4px;
			font-size:12px;
		}
</style>
<div class="instagram-indx">
	<?
	$qr=mysql_query("SELECT * FROM last_photos ORDER BY date_add DESC");
	for($i=0;$rs=mysql_fetch_array($qr);$i++){
	?>
					<div style="height:300px;overflow-y: auto;margin:10px 5px;">
						<p><?=$rs['photo_name'.$db_sufix]?></p>
						<a href="/images/lastphotos/b/<?=$rs['photo_url']?>" class="image" target="_blank" data-fancybox="indxGallery"><img src="/images/lastphotos/s/<?=$rs['photo_url']?>" width="180" alt="" /></a>
						<p>Дата: <?=date("d.m.Y", $rs['date_add'])?></p>
						<p><?=$rs['photo_dsc'.$db_sufix];?></p>
						<p align="center"><input type="Submit" name="del_img_s[<?=$rs['ID']?>]" class="delete_but" value="" onclick="if(!confirm('Уверен?')) return false;"></p>
					</div>
			<?
			if($i%5==4){
				echo '</div><div class="instagram-indx">';
			}//if
		} //for
	?>
</div>
</body>
</html>