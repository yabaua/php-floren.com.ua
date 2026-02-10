<?
require("auth.php");
include("fckeditor/fckeditor.php") ;
require("../include/strlib.php");
//id товара
if (!isset($_REQUEST['ID'])){
	echo "xx";
	//header("location:goods_list.php");
	exit();
}else
	$ID=$_REQUEST['ID'];

?>
<?
//Удаление фото
if(isset($_REQUEST['del_img_s'])){
	print_r($_POST);
}

//======================Обновление объекта
if (isset($_REQUEST['edit']) && ($name=trim($_REQUEST['name']))) {
	$r=mysql_query("SELECT logo FROM goods_makers WHERE ID=".$ID);
	$f=mysql_fetch_array($r);

	if (!get_magic_quotes_gpc()) {
		$name=addslashes($name);
		$body=addslashes($body);
	}
	if (isset($_FILES['logo']) && is_uploaded_file($_FILES['logo']['tmp_name'])) {
		$logo=parse_img_name_md5($_FILES['logo']['name']);
		copy($_FILES['logo']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/makers/'.$logo);
		chmod($_SERVER['DOCUMENT_ROOT'].'/images/makers/'.$logo,0777);
	}
	else{//Оставим, старые картинки
		$logo=$f['logo'];
	}
	//=====   Производитель =======
	
	mysql_query("UPDATE goods_makers SET
		name='".$name."',
		body='".$body."',
		logo='".$logo."'
		WHERE ID=".$ID);
	echo mysql_error();
	echo '<FONT COLOR="#FF0000">Производитель изменён</FONT>';
}

?>
<html><head>
<link rel="stylesheet" type="text/css" href="style_back.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style_back.css">
</head>
<body style="margin-left:20px;">
<?
	$q=mysql_query("SELECT * FROM goods_makers WHERE ID=".$ID);
	$f=mysql_fetch_array($q);
?>
<h3><a href="/admin/goods_makers.php">Бренды</a>&nbsp;&raquo;&nbsp;Изменить производителя <font color="#DD0000"><?=htmlspecialchars($f['name'])?></font></h3>
<div class="holder" style="padding:10px 0;">
	<a href="/admin/goods_class.php" class="menu_button" target="main">Структура</a>
	<a href="/admin/goods_list.php" class="menu_button" target="main">Товары</a>
	<a href="/admin/goods_units.php" class="menu_button" target="main">Единицы товаров</a>
	<a href="/admin/goods_makers.php" class="menu_button" target="main">Бренды</a>
	<a href="/admin/goods_filters.php" class="menu_button" target="main">Фильтры товаров</a>
	<a href="/admin/goods_add.php" class="menu_button" target="main">Добавить товар</a>
	<a href="/admin/goods_tech.php" class="menu_button" target="main">Тех. Хар-ки</a>
	<a href="/admin/goods_compo_list.php" class="menu_button" target="main">Композиции</a>
</div>


<form name="form" action="goods_makers_one.php?ID=<?=$ID?>" method="post" enctype="multipart/form-data">
<br /><br />
<table class="tbl_no_border" cellpadding="2" cellspacing="0">
	<tr>
		<td>Название:</td>
		<td><input type="text" name="name" value="<?=htmlspecialchars($f['name'])?>" class="input_type" style="width:300px;"></td>
	</tr>
	<tr valign="top">
		<td>Лого:</td>
		<td>
		<?if ($f['logo']) {?>
				<img src="/images/makers/<?=$f['logo'].'?'.time()?>" border=0><br />
		<?}?>
		Загрузить Лого: <input type="file" name="logo">
	<tr>
		<td colspan="2">Полное описание:
		<?
		$oFCKeditor = new FCKeditor('body') ;
		$oFCKeditor->BasePath	= '/admin/fckeditor/' ;
		$oFCKeditor->Width      = '700'; // Ширина 
		$oFCKeditor->Height     = '300'; // Высота
		$oFCKeditor->Value		= $f['body'] ;
		$oFCKeditor->Create() ;
		?>
		</td>
	</tr>
</table><INPUT TYPE="submit" name="edit" value="Изменить" class="button">
<br /><br />
</form>

</body>
</html>