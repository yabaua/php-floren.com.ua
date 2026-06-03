<?
require("auth.php");
require("../include/strlib.php");
require("../include/resize.php");
//id товара
if (!isset($_REQUEST['ID'])){
	header("location:gallery_list.php");
	exit();
}else
	$ID=$_REQUEST['ID'];

//==============Категория товара
//Удаление фото

if(isset($_REQUEST['del_img'])){
	foreach($_REQUEST['del_img'] as $k=>$v){
		$qr=mysql_query("SELECT imgURL FROM gallery_item WHERE ID=".$k);
		$rs=mysql_fetch_array($qr);
		
		mysql_query("DELETE FROM gallery_item WHERE ID=".$k);
		@unlink($_SERVER['DOCUMENT_ROOT']."/images/gallery/b/".$rs['imgURL']);
		@unlink($_SERVER['DOCUMENT_ROOT']."/images/gallery/s/".$rs['imgURL']);
	}
}


//======================Обновление объекта
if (isset($_REQUEST['edit']) && ($galleryName=trim($_REQUEST['galleryName']))) {

	$galleryDescription=$_REQUEST['galleryDescription'];
	mysql_query("UPDATE gallery_list SET
		galleryName='".$galleryName."',
		galleryDescription='".$galleryDescription."'
		WHERE ID=".$ID);
	echo mysql_error();
	echo '<FONT COLOR="#FF0000">Название и описание изменено</FONT>';
	
}

if (isset($_REQUEST['editIMG']) && isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

	$size=getimagesize($_FILES['image']['tmp_name']);
	
			$ww=(($size[0]<1600)?$size[0]:"1600");
			$hh=(($size[1]<1600)?$size[1]:"1600");
	
		
			$image_name=explode('.', $_FILES['image']['name'], 2);
			$image=transliterate($image_name[0])."-".time().".jpg";

			img_resize($_FILES['image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/gallery/s/'.$image, 180,180, 0xFFFFFF, 100, true, false);
			img_resize($_FILES['image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/gallery/b/'.$image, $ww,$hh, 0xFFFFFF, 90, true, true, true);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/gallery/b/'.$image,0777);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/gallery/s/'.$image,0777);
		
		
	mysql_query("INSERT INTO gallery_item (imgURL,galleryID)
		VALUES ('".$image."', '".$ID."')");
	echo mysql_error();
	echo '<FONT COLOR="#FF0000">Фото добавлено</FONT>';
	

	
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<script src="/admin/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" type="text/css" href="style_back.css">
</head>
<body style="margin-left:20px;">
<?
	$q=mysql_query("SELECT * FROM gallery_list WHERE ID=".$ID);
	$f=mysql_fetch_array($q);
?>
<h3><a href="gallery_list.php">Список Объектов</a>&nbsp;&raquo;&nbsp;Изменить Фото <font color="#DD0000"><?=$f['galleryName']?></font></h3>
<br>
<h3>Фото:</h3>
<div class="holder" style="width:600px;">
<form name="formIMG" id="formIMG" action="gallery_item.php?ID=<?=$ID?>" method="post" enctype="multipart/form-data">
<?
$qr2=mysql_query("SELECT * FROM gallery_item WHERE galleryID='".$ID."'");
while($rs2=mysql_fetch_array($qr2)){?>
	<div style="width:135px;float:left;margin-left:5px;margin-top:15px;">
		<img src="/images/gallery/s/<?=$rs2['imgURL'].'?'.time()?>" border=0 width="100" align="left" style="margin-right:2px;"><input type="Submit" name="del_img[<?=$rs2['ID']?>]" value="X" class="button" style="width:25px;height:25px;padding:0;text-align:center;font-size:12px;" onclick="if(!confirm('Уверен?')) return false;">
	</div>
<?}//if images?>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style="clear:both;">
	Загрузить новое: <input type="file" name="image"><INPUT TYPE="submit" name="editIMG" value="Добавить" class="button">
</div>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<form name="form" id="form" action="gallery_item.php?ID=<?=$ID?>" method="post" enctype="multipart/form-data">
<h3>Название:</h3>
<input type="text" name="galleryName" value='<?=$f['galleryName']?>' class="input_type" style="width:450px;"></td>
<p>&nbsp;<br></p>
<h3>Полное описание:</h3>
			<textarea id="content" name="galleryDescription" style="width:600px;height:400px;" rows="20" cols="50">
                <?echo $f['galleryDescription']?>
            </textarea>
            <script>
                CKEDITOR.replace( 'galleryDescription', {
					allowedContent: true,
					width: '70%',
					height: 300
				} );
            </script>
<INPUT TYPE="submit" name="edit" value="Изменить" class="button">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>