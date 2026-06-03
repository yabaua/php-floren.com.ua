<?php
	if (!isset($lang)) $lang='ua';
	$urlID = isset($ID) ? '&ID=' . $ID : '';
	$urlCategoryID = isset($category) ? '&category=' . $category : '';
	
	
?>
<div class="holder" style="margin:10px 0;padding:10px 0;">
	<a href="?lang=ru<?=$urlID?><?=$urlCategoryID?>" class="adm-btn adm-btn_max<?=$lang=='ru'?' btn_active':''?>">RU</a>
	<a href="?lang=ua<?=$urlID?><?=$urlCategoryID?>" class="adm-btn adm-btn_max<?=$lang=='ua'?' btn_active':''?>">UA</a>
</div>
<div class="holder menu_buttons">
	<a href="/admin/goods_class.php?lang=<?=$lang?>" target="main">Структура</a>
	<a href="/admin/goods_list.php?lang=<?=$lang?>" target="main">Товары</a>
	<a href="/admin/goods_filters.php" target="main">Фильтры товаров</a>
	<a href="/admin/goods_add.php" target="main">Добавить товар</a>
	<a href="/admin/goods_tech.php" target="main">Тех. Хар-ки</a>
	<a href="/admin/goods_compo_list.php" target="main">Композиции</a>
	<a href="/admin/price.php" target="main">Цены</a>
	<a href="/admin/goods_colors_edit.php" target="main">Редактировать цвета</a>
</div>
<p>&nbsp;</p>