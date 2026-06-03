<?php 
require("auth.php");
require("../include/strlib.php");

if (!isset($_REQUEST['category'])) $category=0;
else $category=$_REQUEST['category'];

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

if (isset($_REQUEST['delet']) && isset($_REQUEST['del'])) {
	foreach ($_REQUEST['del'] AS $d) {
		$db->query("SELECT fID FROM goods_f2g WHERE fID='".$d."'");
		if (!$db->num_rows()) {
			$db->query("DELETE FROM goods_filters WHERE ID='".$d."'");
		} else {
			echo '<p  style="color:#ff0000;font-size:16px;"><b>Нельзя удалить свойство т.к. оно уже используеться</b></p><br>';
			$db->query("
				SELECT g.ID, g.name, g.classID
				FROM goods_f2g gf2g
				JOIN goods g ON g.ID=gf2g.gID
				WHERE gf2g.fID=".$d);
			while($rs_check=$db->fetch()){
			echo '-&nbsp;<a target="_blank" href="goods_edit.php?ID='.$rs_check['ID'].'&cid='.$rs_check['classID'].'">'.$rs_check['name'].'</a><br />';
			
			}
		}
	}
}

if (isset($_REQUEST['delete_group']) && isset($_REQUEST['del_group'])) {
	foreach ($_REQUEST['del_group'] AS $d) {
		$db->query("SELECT ID FROM goods_filters WHERE groupID=".$d);
		if (!$db->num_rows()) {
			$db->query("DELETE FROM goods_filter_groups WHERE ID=".$d);
		} else {
			echo '<p  style="color:#ff0000;font-size:16px;"><b>Нельзя удалить группу т.к. она уже используеться</b></p><br>';
		}
	}
}

if (isset($_REQUEST['edit']) && isset($_REQUEST['sort'])) {
	foreach ($_REQUEST['sort'] AS $id=>$s) {
		$s=(int)$s;
		$g=(int)$_REQUEST['groupID'][$id];
		$db->query("UPDATE goods_filters SET groupID=".$g.",sort=".$s." WHERE ID=".$id);
		if ($nn=trim($_REQUEST['new_name'][$id])) {
			$db->query("UPDATE goods_filters SET name='".$nn."', name_ua='".trim($_REQUEST['new_name_ua'][$id])."'  WHERE ID=".$id);
		}
	}
}

if (isset($_REQUEST['edit_group']) && isset($_REQUEST['group_sort'])) {
//print_r($_POST);
	foreach ($_REQUEST['group_sort'] AS $id=>$s) {
		$s=(int)$s;
		$db->query("UPDATE goods_filter_groups SET sort=".$s." WHERE ID=".$id);
		if ($nn=trim($_REQUEST['new_group_name'][$id])) {
			$db->query("UPDATE goods_filter_groups SET name".$db_sufix."='".$nn."' WHERE ID=".$id);
		}
	}
}

if (isset($_REQUEST['add']) && ($name=trim($_REQUEST['name']))) {
	if (!get_magic_quotes_gpc()) {
		$name=addslashes($name);
	}
	$names=explode("\r\n",$name);
	print_r($names);
	foreach ($names AS $un) {
		if ($un=trim($un)) {
		//	echo $un."<br />";
			$db->query("SELECT ID FROM goods_filters WHERE classID=".$category." AND name='".$un."' AND groupID=0");
			if (!$db->num_rows()) {
				$db->query("SELECT MAX(sort) AS m FROM goods_filters WHERE classID=".$category);
				$f=$db->fetch();
				$sort=$f['m']+10;
				$db->query("INSERT INTO goods_filters SET classID=".$category.",name='".$un."',alias='".transliterate($un, "_")."',sort='".$sort."'");

			}
		}
	}
}

if (isset($_REQUEST['add_group']) && ($_REQUEST['name_group']=trim($_REQUEST['name_group']))) {
	if (!get_magic_quotes_gpc()) {
		$name_group=addslashes($_REQUEST['name_group']);
	}
	$motherID=(int)$_REQUEST['motherID_group'];

	$db->query("SELECT ID FROM goods_filter_groups WHERE classID=".$category." AND name='".$name_group."' AND motherID!=".$motherID);
	if (!$db->num_rows()) {
		$db->query("SELECT MAX(sort) AS m FROM goods_filter_groups WHERE classID=".$category);
		$f=$db->fetch();
		$sort=$f['m']+10;
		$db->query("INSERT INTO goods_filter_groups SET
			classID=".$category.",
			motherID=".$motherID.",
			name='".$name_group."',
			sort=".$sort);
	}
}
function echo_groups($ID=0) {
	global $category, $db, $db_sufix;

	$out='';
	$db->query("SELECT gfg.ID, gfg.name".$db_sufix." AS group_name, gf.name".$db_sufix." AS subName FROM goods_filter_groups gfg LEFT JOIN goods_filters gf ON gf.ID=gfg.motherID WHERE gfg.classID=".$category." ORDER BY gfg.sort,gfg.name");
	
	while ($f=$db->fetch())
		$out.='<option value="'.$f['ID'].'"'.($f['ID']==$ID?' selected':'').'>'.$f['group_name'].'</option>';
	return $out;
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
<form action="goods_filters.php?category=<?=$category?>" method="post">
<br /><br />
<select name="category" id="classes">
	<option value="0"></option>
	<?php 
		$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID=0");
		while($rs=$db->fetch()){
	?>
	<OPTGROUP label="<?=$rs['name']?>">
		<option value="<?=$rs['ID']?>"<?=($category==$rs['ID']?' selected':'')?>>ВСЕ ТОВАРЫ КАТЕГОРИИ</option>
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
<table width="600">
<tr valign="top">
<!--================ГРУППЫ ФИЛЬТРОВ======================= -->
<td width="30%">
	<H3>Группы Фильтров:</H3>
	<?php 
		$db->query("SELECT * FROM goods_filter_groups WHERE classID=".$category." ORDER BY sort DESC,name");
	?>
	<table cellspacing="0" class="tbl">
	  <?php 
	    while ($f=$db->fetch()) {
	  ?>
		<tr bgcolor="#FFFBEC">
			<td><?=$f['ID']?></td>
			<td><input type="text" name="new_group_motherID[<?=$f['motherID']?>]" class="input_type" style="width:30px;text-align:center;" value="<?=$f['motherID']?>"></td>
			<td><input type="text" name="new_group_name[<?=$f['ID']?>]" class="input_type" style="width:200px" value="<?=$f['name'.$db_sufix]?>"></td>
			<td><input type="text" name="group_sort[<?=$f['ID']?>]" value="<?=$f['sort']?>" class="input_type" style="width:30px;text-align:center;"></td>
			<td><input type=checkbox name=del_group[] value="<?=$f['ID']?>" class=input_check></td>
		</tr>
		
	  <?php }?>
		<tr>
			<td>&nbsp;</td>
			<td><input type="text" class="input_type" name="motherID_group" style="width:30px;text-align:center;"></td>
			<td><input type="text" class="input_type" name="name_group" style="width:200px"></td>
			<td colspan="2" align="right"><INPUT TYPE="submit" name="add_group" value="+" class="button" style="width:40px;"></td>
		</tr>
	</table>
	<br />
	<INPUT TYPE="submit" name="edit_group" value="Изменить" class="button"> <INPUT TYPE="submit" name="delete_group" value="Удалить" class="button">
</td>
<!--================/ГРУППЫ ФИЛЬТРОВ======================= -->
<!--================ФИЛЬТРЫ ТОВАРОВ======================= -->
<td width="70%" style="padding-left:50px;">
<h3>Фильтры товаров</h3>
<?php 
$db->query("SELECT
	gf.*,
	gfg.name".$db_sufix." AS group_name
	FROM goods_filters gf
	LEFT JOIN goods_filter_groups gfg ON (gf.groupID=gfg.ID)
	WHERE gf.classID=".$category."
	ORDER BY gfg.sort DESC,gf.sort DESC,gf.alias", 2); // "2" – because function inside
?>
<table cellspacing="0" class="tbl">
	<?php 
		$group=0;
		while ($f=$db->fetch(2)) {
			if ($group!=$f['groupID']) {
  ?>
	<tr bgcolor="#EEE7DF">
		<td colspan="6"><b><?=$f['group_name']?></b></td>
	</tr>
	<?php 
		$group=$f['groupID'];
	}//if?>
	<tr>
		<td><?=$f['ID']?></td>
		<td><input type="text" name="new_name[<?=$f['ID']?>]" style="width:150px;" class="input_type" value="<?=$f['name']?>"></td>
		<td><input type="text" name="new_name_ua[<?=$f['ID']?>]" style="width:150px;" class="input_type" value="<?=$f['name_ua']?>"></td>
		<td><select name="groupID[<?=$f['ID']?>]" style="width:150px;">
				<option value="0"></option>
				<?=echo_groups($f['groupID'])?>
			</select></td>
		<td><input type="text" name="sort[<?=$f['ID']?>]" value="<?=$f['sort']?>" class="input_type" style="width:30px;text-align:center;"></td>
		<td><input type=checkbox name=del[] value="<?=$f['ID']?>" class=input_check></td>
	</tr>
  <?php }?>
	<tr>
		<td colspan="6"><INPUT TYPE="submit" name="edit" value="Изменить" class="button"> <INPUT TYPE="submit" name="delet" value="Удалить" class="button"></td>
	</tr>
	<tr>
		<td colspan="5"><textarea name="name" style="width:350px;height:75px;"></textarea></td>
		<td><INPUT TYPE="submit" name="add" value="+" class="button" style="width:20px;height:75px;"></td>
	</tr>
</table>
<br />

</td>
<!--================ФИЛЬТРЫ ТОВАРОВ======================= -->
</tr>
</table>




<br /><br />
<H3>Переместить фильтры в другую категорию:</H3>
Категория:
<br />
<select name="mv_to_category" id="classes2">
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
			<option value="<?=$rs1['ID']?>"<?=($category==$f['ID']?' selected':'')?>><?=$rs1['name']?></option>
	  <?php }?>
	</optgroup>
	<?php }?>
</select>
<INPUT TYPE="submit" name="mv" value="Переместить" class="button">
<br><br>


<h2>SEO фильтров</h2>
<table cellspacing="0" class="tbl">
<tr>
	<th>Алиас</th>
	<th>Индексируется</th>
</tr>
<?php 
$db->query("SELECT * FROM goods_filters_meta WHERE classID='".$category."' ORDER BY is_index, alias");
while($rs=$db->fetch()){
?>
<tr>
	<td><a href="goods_filters_seo.php?ID=<?=$rs['ID']?>"><?=$rs['alias']?></a></td>
	<td align="center"><?=$rs['is_index']?></td>
</tr>
<?php }	//SEO filter	?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } // if category	?>

</form>
</body>
</html>