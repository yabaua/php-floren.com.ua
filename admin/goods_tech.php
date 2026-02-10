<?php 
require("auth.php");

if(isset($_REQUEST['category'])) $category=$_REQUEST['category'];
else $category=0;

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

if (isset($_REQUEST['delete_group']) && isset($_REQUEST['del_group'])) {
	foreach ($_REQUEST['del_group'] AS $d) {
		$db->query("DELETE FROM goods_tech WHERE ID=".$d);
		$db->query("DELETE FROM goods_tech2g WHERE tID=".$d);
	}
}

if (isset($_REQUEST['edit_group']) && isset($_REQUEST['group_sort'])) {
//print_r($_POST);
	foreach ($_REQUEST['group_sort'] AS $id=>$s) {
		$s=(int)$s;
		$db->query("UPDATE goods_tech SET sort=".$s." WHERE ID=".$id);
		if ($nn=trim($_REQUEST['new_group_name'][$id])) {
			$db->query("UPDATE goods_tech SET name='".$nn."', measure='".trim($_REQUEST['new_measure'][$id])."' WHERE ID=".$id);
		}
	}
}

if (isset($_REQUEST['add_group']) && ($_REQUEST['name_group']=trim($_REQUEST['name_group']))) {
	$name_group=$_REQUEST['name_group'];
	$measure=$_REQUEST['measure'];
	if (!get_magic_quotes_gpc()) {
		$name_group=addslashes($_REQUEST['name_group']);
		$measure=addslashes($_REQUEST['measure']);
	}
	
	$db->query("SELECT ID FROM goods_tech WHERE name='".$name_group."' AND classID=".$category);
	echo $db->error();
	if (!$db->num_rows($r)) {
		$db->query("SELECT MAX(sort) AS m FROM goods_tech WHERE classID=".$category);
		$f=$db->fetch();
		$sort=$f['m']+10;
		$db->query("INSERT INTO goods_tech SET
			classID=".$category.",
			name='".$name_group."',
			measure='".$measure."',
			sort=".$sort, 1);
		echo $db->error();
	}
}

?>
<html><head>
<link rel="stylesheet" type="text/css" href="style_back.css?v=2">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="margin-left:20px;">
<?php 
//============================

include("top_menu.php");

//============================
?>
<h3>Фильтры товаров</h3>
<form action="goods_tech.php?category=<?=$category?>" method="post">
<br /><br />
<select name="category" id="classes">
	<option value="0"></option>
	<?php 
	$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID=0");
	while($rs=$db->fetch()){
	?>
	<OPTGROUP label="<?=$rs['name']?>">
		<?php 
		$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID=".$rs['ID'], 1);
		while($rs1=$db->fetch(1)){
		?>
		<option value="<?=$rs1['ID']?>"<?=($category==$rs1['ID']?' selected':'')?>><?=$rs1['name']?></option>
	   <?php }?>
	</optgroup>
	<?php }?>
</select>
<input type="submit" name="go" value="Показать" onclick="if(document.getElementById('classes').value=='0') {alert('Не выбрана рубрика');return false;}">
<br /><br />
<?php if ($category) {?>
<br /><br />
<table width="600">
<tr valign="top">
<!--================ГРУППЫ ФИЛЬТРОВ======================= -->
<td width="30%">
	<H3>Группы Фильтров:</H3>
	<?php $db->query("SELECT * FROM goods_tech WHERE classID='".$category."' ORDER BY sort,name");?>
	<table cellspacing="0" class="tbl">
		<tr>
			<td>ID</td>
			<td>Название</td>
			<td>Ед. Изм.</td>
			<td>Сорт</td>
			<td>&nbsp;</td>
		</tr>
	  <?php while ($f=$db->fetch()) {?>
		<tr bgcolor="#FFFBEC">
			<td><?=$f['ID']?></td>
			<td><input type="text" name="new_group_name[<?=$f['ID']?>]" class="input_type" style="width:200px;" value="<?=$f['name']?>"></td>
			<td><input type="text" name="new_measure[<?=$f['ID']?>]" class="input_type" style="width:50px;" value="<?=$f['measure']?>"></td>
			<td><input type="text" name="group_sort[<?=$f['ID']?>]" value="<?=$f['sort']?>" class="input_type" style="width:30px;text-align:center;"></td>
			<td><input type=checkbox name=del_group[] value="<?=$f['ID']?>" class=input_check></td>
		</tr>
	  <?php }?>
		<tr>
			<td>&nbsp;</td>
			<td><input type="text" class="input_type" name="name_group" style="width:200px"></td>
			<td><input type="text" class="input_type" name="measure" style="width:50px"></td>
			<td colspan="2" align="right"><INPUT TYPE="submit" name="add_group" value="+" class="button" style="width:40px;"></td>
		</tr>
	</table>
	<br />
	<INPUT TYPE="submit" name="edit_group" value="Изменить" class="button"> <INPUT TYPE="submit" name="delete_group" value="Удалить" class="button">
</td>
<!--================/ГРУППЫ ФИЛЬТРОВ======================= -->

</tr>
</table>
<?php }?>



</form>
</body>
</html>