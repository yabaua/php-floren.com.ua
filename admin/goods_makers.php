<?
require("auth.php");

if (isset($_REQUEST['delet']) && isset($_REQUEST['del'])) {
	foreach ($_REQUEST['del'] AS $d) {
		$r=mysql_query("SELECT COUNT(*) AS c FROM goods WHERE makerID=".$d);
		$f=mysql_fetch_array($r);
		if (!$f['c']) {
			mysql_query("DELETE FROM goods_makers WHERE ID=".$d);
		} else {
			echo 'Данный производитель не может быть удален т.к. на него ссылаються товары.';
			$qr_check=mysql_query("
				SELECT g.ID, g.name, g.classID
				FROM goods g
				WHERE g.makerID=".$d);
			while($rs_check=mysql_fetch_array($qr_check)){
				echo '-&nbsp;<a target="_blank" href="goods_edit.php?ID='.$rs_check['ID'].'&cid='.$rs_check['classID'].'">'.$rs_check['name'].'</a><br />';
			}
		}
	}
}

if (isset($_REQUEST['edit_makers'])) {
	foreach ($_REQUEST['m_name'] AS $mID=>$mn) {
		$mn=addslashes(trim($mn));
		mysql_query("UPDATE goods_makers SET name='".$mn."' WHERE ID=".$mID);
	}
}

if (isset($_REQUEST['add']) && ($name=trim($_REQUEST['name']))) {
	if (!get_magic_quotes_gpc()) {
		$name=addslashes($name);
	}
	$names=explode("\r\n",$name);
	foreach ($names AS $n) {
		$r=mysql_query("SELECT ID FROM goods_makers WHERE name='".$n."'");
		if (!mysql_num_rows($r)) {
			mysql_query("INSERT INTO goods_makers SET name='".$n."'");
		}
	}
}
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style_back.css">
</head>
<body style="margin-left:20px;">
<h3>Бренды</h3>
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
<form action="goods_makers.php" method="post">

<?
$r=mysql_query("SELECT * FROM goods_makers ORDER BY name");
?>
<table class="tbl" cellspacing="0">
	<tr>
		<th>#</th>
		<th>Название</th>
		<th>Удалить</th>
	</tr>
	<?for ($i=1;$f=mysql_fetch_array($r);$i++) {?>
  	<tr>
		<td bgcolor="eee7df"><?=$i?></td>
		<td><a href="goods_makers_one.php?ID=<?=$f['ID']?>"><?=$f['name']?></a></td>
		<td><input type=checkbox name=del[] value="<?=$f['ID']?>" class=input_check></td>
	</tr>
	<?}?>
</table>
<INPUT TYPE="submit" name="delet" value="Удалить" class="button"><BR>

<H3>Добавить производителя:</H3>
Название:<br>
<textarea name="name" rows="4" cols="40"></textarea><br>
<INPUT TYPE="submit" name="add" value="Добавить" class="button">
</form>
</body>
</html>