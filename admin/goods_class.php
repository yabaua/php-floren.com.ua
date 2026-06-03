<?php
require("auth.php");

if (!isset($_REQUEST['ID'])) {
	$ID = 0;
} else {
	$ID = (int)$_REQUEST['ID'];
}

if (!isset($_REQUEST['lang']) || !$_REQUEST['lang']) {
	$lang = 'ua';
	$db_sufix = '_ua';
	$btn_lang = 'lang_ua';
} else {
	$lang = $_REQUEST['lang'];
	$db_sufix = $_REQUEST['lang'] == 'ru' ? '' : ('_' . $_REQUEST['lang']);
	$btn_lang = 'lang_' . $_REQUEST['lang'];
}

/* ===== ADD ===== */
if (isset($_REQUEST['add']) && $_REQUEST['new_name']) {
	$names = explode("\r\n", $_REQUEST['new_name']);
	$sort = 10;
	foreach ($names as $name) {
		if ($name = trim($name)) {
			$name = trim(preg_replace('/^[0-9]+/', '', $name));
			$db->query("INSERT INTO goods" . $db_sufix . "_class SET motherID=" . $ID . ", name='" . $name . "', sort=" . $sort);
			$sort += 10;
		}
	}
}

/* ===== EDIT SORT ===== */
if (isset($_REQUEST['edit']) && isset($_REQUEST['sort'])) {
	foreach ($_REQUEST['sort'] as $ecid => $s) {
		$s = (int)$s;
		$db->query("UPDATE goods" . $db_sufix . "_class 
			SET sort=" . $s . ", list_or_tbl='" . $_REQUEST['list_or_tbl'][$ecid] . "' 
			WHERE ID=" . (int)$ecid);
	}
}

/* ===== EDIT SEO ===== */
if (isset($_REQUEST['edit_seo'])) {
	$db->query("UPDATE goods" . $db_sufix . "_class SET
		meta_title='" . $_REQUEST['meta_title'] . "',
		meta_description='" . $_REQUEST['meta_description'] . "',
		meta_keywords='" . $_REQUEST['meta_keywords'] . "',
		seotext='" . $_REQUEST['seotext'] . "',
		topSEOtext='" . $_REQUEST['topSEOtext'] . "',
		centerSEOtext='" . addslashes($_REQUEST['centerSEOtext']) . "'
		WHERE ID=" . $ID
	);
	header("location: goods_class.php?ID=" . $ID . "&lang=" . $lang);
	exit;
}

/* ===== DELETE ===== */
if (isset($_REQUEST['delet']) && isset($_REQUEST['del'])) {
	foreach ($_REQUEST['del'] as $d) {
		$d = (int)$d;
		$r = $db->query("SELECT * FROM goods" . $db_sufix . "_class WHERE motherID=" . $d);
		if (!$db->num_rows()) {
			$r = $db->query("SELECT COUNT(*) AS c FROM goods" . $db_sufix . " WHERE classID=" . $d);
			$f = $db->fetch();
			if (!$f['c']) {
				$db->query("DELETE FROM goods" . $db_sufix . "_class WHERE ID=" . $d);
			} else {
				echo '<font color="#ff0000">Категория не пуста и содержит товары</font><br>';
			}
		} else {
			echo '<font color="#ff0000">Категория имеет подкатегории</font><br>';
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style_back.css?v=12">
	<script src="/admin/ckeditor/ckeditor.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body style="margin-left:20px;">

<?php include("top_menu.php"); ?>

<h3>Классификация</h3>

<form action="?ID=<?php echo $ID; ?>&lang=<?php echo $lang; ?>" method="post">

<?php
function get_path($ID) {
	global $db_sufix, $lang, $db, $db_sufix;

	if (!$ID) {
		echo '<a href="?ID=0">Начало</a> <span class="root"> » </span> ';
		return;
	}

	$db->query("SELECT * FROM goods" . $db_sufix . "_class WHERE ID=" . $ID);
	while ($f = $db->fetch()) {
		get_path($f['motherID']);
	}

	$db->query("SELECT * FROM goods" . $db_sufix . "_class WHERE ID=" . $ID);
	$f = $db->fetch();
	echo '<a href="?ID=' . $f['ID'] . '&lang=' . $lang . '">' . $f['name'] . '</a><span class="root"> » </span>';
}
get_path($ID);
?>

<br><br>

<table class="table" border="0">
	<tr>
		<th colspan="2">Название</th>
		<th>Сортировка</th>
		<th>Вид</th>
		<th>Удалить</th>
	</tr>

<?php
$db->query("SELECT * FROM goods" . $db_sufix . "_class WHERE motherID=" . $ID . " ORDER BY sort DESC");
while ($f = $db->fetch()) {
?>
	<tr bgcolor="#EEE7DF">
		<td colspan="2">
			<a href="?ID=<?php echo $f['ID']; ?>&lang=<?php echo $lang; ?>">
				<?php echo $f['name']; ?>
			</a>
		</td>
		<td>
			<input type="text" name="sort[<?php echo $f['ID']; ?>]" value="<?php echo $f['sort']; ?>" class="input_type" style="width:30px;">
		</td>
		<td>
			<input type="radio" name="list_or_tbl[<?php echo $f['ID']; ?>]" value="0"<?php if ($f['list_or_tbl'] == 0) echo ' checked'; ?>> Список
			<input type="radio" name="list_or_tbl[<?php echo $f['ID']; ?>]" value="1"<?php if ($f['list_or_tbl'] == 1) echo ' checked'; ?>> Таблица
		</td>
		<td>
			<input type="checkbox" name="del[]" value="<?php echo $f['ID']; ?>">
		</td>
	</tr>

	<?php if ($ID == 0) {
		$db->query("SELECT * FROM goods" . $db_sufix . "_class WHERE motherID=" . $f['ID'] . " ORDER BY sort DESC", 1);
		while ($ff = $db->fetch(1)) {
	?>
	<tr>
		<td style="padding-right:10px;"><?php echo $ff['ID']; ?></td>
		<td><?php echo $ff['name']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<?php } } } ?>
</table>

<br>
<input type="submit" name="edit" value="Изменить" class="button">
<input type="submit" name="delet" value="Удалить" class="button">

<h3>Добавить новый подраздел:</h3>
<textarea name="new_name" style="width:500px;height:200px;"></textarea><br>
<input type="submit" name="add" value="Добавить" class="button">

<?php
$db->query("SELECT * FROM goods" . $db_sufix . "_class WHERE ID=" . $ID);
$rs = $db->fetch();
?>

<h3>META Title:</h3>
<textarea name="meta_title" style="width:500px;height:50px;"><?php echo $rs['meta_title']; ?></textarea>

<h3>META Description:</h3>
<textarea name="meta_description" style="width:500px;height:50px;"><?php echo $rs['meta_description']; ?></textarea>

<h3>META Keywords:</h3>
<textarea name="meta_keywords" style="width:500px;height:50px;"><?php echo $rs['meta_keywords']; ?></textarea>

<h3>СЕО текст сбоку:</h3>
<textarea id="seotext" name="seotext"><?php echo $rs['seotext']; ?></textarea>

<script>
CKEDITOR.replace('seotext', { allowedContent: true, width: '70%', height: 300 });
</script>

<h3>Текст под заголовком:</h3>
<textarea id="topSEOtext" name="topSEOtext"><?php echo $rs['topSEOtext']; ?></textarea>

<script>
CKEDITOR.replace('topSEOtext', { allowedContent: true, width: '70%', height: 300 });
</script>

<h3>Текст в центр:</h3>
<textarea id="centerSEOtext" name="centerSEOtext"><?php echo $rs['centerSEOtext']; ?></textarea>

<script>
CKEDITOR.replace('centerSEOtext', { allowedContent: true, width: '70%', height: 300 });
</script>

<br>
<input type="submit" name="edit_seo" value="Обновить" class="button">

</form>
</body>
</html>
