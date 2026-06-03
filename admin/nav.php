<?php
require("auth.php");
?>
<html>
<head>
<title>vsop</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="Cache-control" CONTENT="no-cache">
<meta http-equiv="Cache-Control" content="max-age=1, must-revalidate">
<meta http-equiv="Cache-Control" content="max-age=1, proxy-revalidate">
<link rel="stylesheet" type="text/css" href="style_back.css">
</head>

<body style="padding-left:0;padding-top:20px;">
<style>
	div{
		color:#333333;
		padding:2px 0 2px 10px;
		font-size:13px;
		font-weight:bold;
	}
	a{
		color:#5F1C13;
		text-decoration:none;
	}
		a:hover{
			color:#000000;
		}
	.separator{
		margin-top:4px;
		padding-top:4px;
		border-top:1px solid DDDDDD;
	}
</style>
<?php
if ($_SESSION['admin_name']=='img'){?>
<div class="separator" style="padding-top:40px;">
	<a href="goods_list.php" class="menu" target="main">Товари1</a>
</div>
<div class="separator">
	<a href="last_photos.php" class="menu" target="main">Фото на главную2</a>
</div>
<?php }else{?>

<div>
	<a href="edit_catalog.php" class="menu" target="main">Структура сайта</a>
</div>
<div style="padding-top:10px;">
	<a href="goods_list.php" class="menu" target="main">Товари</a>
</div>
<div style="padding-top:20px;">
	<a href="last_photos.php" class="menu" target="main">Фото на главную</a>
</div>
<div style="padding-top:20px;">
	<a href="marketing.php" class="menu" target="main">Статистика</a>
</div>
<div class="separator" style="padding-top:20px;">
	Статьи <a href="publications_list.php" class="menu" target="main">РУС</a> / <a href="publications_list_ua.php" class="menu" target="main">УКР</a>
</div>
<div style="padding-top:20px;">
	<a href="lingvo.php" class="menu" target="main">Словарь</a>
</div>
<div style="padding-top:20px;">
	<a href="delivery_options_edit.php" class="menu" target="main">Условия доставки</a>
</div>
<div style="padding-top:20px;">
	<a href="edit_team.php" class="menu" target="main">Редактировать сотрудников</a>
</div>
<div style="padding-top:20px;">
	<a href="edit_sliders.php" class="menu" target="_blank">Редактировать слайдеры</a>
</div>

<div class="separator" style="padding-top:20px;">
	<a href="./tmp/update_filters.php" class="menu" target="main">Обновить фильтры по цене</a>
</div>
<div style="padding-top:20px;">
	<a href="change_all_product_availability.php" class="menu" target="main">Обновить доступность<br>товаров  в каталоге</a>
</div>
<div style="padding-top:20px;">
	<a href="goods_availability.php" class="menu" target="main">Наличие товаров</a>
</div>


<div class="separator" style="padding-top:20px;">
	<a href="service_list.php?lang=ua" class="menu" target="main">Услуги</a>
</div>
<div>
	Услуги Ландшафт <a href="service_list_landscape.php" class="menu" target="main">РУС</a> / <a href="service_list_landscape_ua.php" class="menu" target="main">УКР</a>
</div>

<div class="separator" style="padding-top:20px;">
	<a href="gallery_list.php" class="menu" target="main">Фотогалерея</a>
</div>
<div class="separator">
	<a href="edit_pass.php" class="menu" target="main">Изменить пароль</a>
</div>
<div>
	<a href="auth.php?logout=1" class="menu" target="_top">Выход</a>
</div>
<?php }?>
</body>
</html>
