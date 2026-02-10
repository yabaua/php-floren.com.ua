<?php
require("auth.php");
require("dir_list.php");

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
	
	if (!isset($lang)) $lang='ua';
	
	if (!isset($_REQUEST['ID'])) $ID=0;
	else $ID=$_REQUEST['ID'];
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="/admin/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" type="text/css" href="style_back.css">
</head>
<body style="margin-left:20px;">
<?php 


$path='';
$PATH=array();

function get_path($id) {
  global $path,$PATH,$ID,$db,$db_sufix;
  $db->query("SELECT * FROM tree".$db_sufix." WHERE ID=$id");
  if ($db->num_rows()) {
    $f=$db->fetch();
    $PATH[]=$f['alias'];
    if ($ID!=$id) $path='<a href="edit_catalog.php?ID='.$f['ID'].'">'.$f['name'].'</a> <span class="root">»»</span> '.$path;
      else $path=$f['name'].'<BR><BR>';
    if ($f['motherID']) get_path($f['motherID']);
      else $path='<a href="edit_catalog.php?ID=0">root</a> <span class="root">»»</span> '.$path;
  }
}

get_path($ID);
$PATH=array_reverse($PATH);

if (isset($_REQUEST['add']) && ($alias=preg_replace('/[^0-9a-zA-Z_-]/','',$_REQUEST['alias'])) && $_REQUEST['new_name'])  {
  $alias=strtolower($alias);
  $db->query("SELECT COUNT(*) count FROM tree".$db_sufix." WHERE motherID=$ID AND alias='$alias'");
  $f=$db->fetch();

	if (!$f['count']) {
		if ($ID) {
			$db->query("SELECT levels FROM tree".$db_sufix." WHERE ID=$ID");
			$f=$db->fetch();
			$levels=$f['levels']+1;
		} else {
			$levels=0;
		}
		$db->query("SELECT MAX(order_p) AS max FROM tree".$db_sufix." WHERE motherID=$ID");
		$f=$db->fetch();
		$max=$f['max']+10;
		$new_name=stripslashes($_REQUEST['new_name']);
		$content=stripslashes($_REQUEST['content']);
		if (get_magic_quotes_gpc()) {
			$new_name=stripslashes($new_name);
			$content=stripslashes($content);
		}
		if (!isset($_REQUEST['new_show'])) $new_show='';
		else $new_show=$_REQUEST['new_show'];
		
		if (!isset($_REQUEST['new_intop'])) $new_intop='';
		else $new_intop=$_REQUEST['new_intop'];

		$db->query("INSERT INTO tree".$db_sufix." (motherID,alias,name,meta_title,meta_description,meta_keywords,script,order_p,act,top_menu,content)
				VALUES($ID,'$alias','$new_name','$new_title','$new_description','$new_keywords','$script',$max,'$new_show','$new_intop','$content')");
	}
}

if (isset($_REQUEST['edit'])) {
  foreach ($_REQUEST['order'] AS $id=>$o) {
    $o=(int)$o;
    if (isset($_REQUEST['show'][$id])) $s="Y";
      else $s='';
    $db->query("UPDATE tree".$db_sufix." SET order_p=$o,act='$s' WHERE ID=$id");
  }
}

if (isset($delet) && isset($del)) {
  foreach ($del AS $d) $db->query("DELETE FROM tree WHERE ID=$d");
  foreach ($del AS $d) $db->query("DELETE FROM tree_ua WHERE ID=$d");
}

echo $path;
?>
<div class="holder" style="margin:10px 0;padding:10px 0;">
	<a href="?lang=ru&ID=<?=$ID?>" class="adm-btn adm-btn_max<?=$lang=='ru'?' btn_active':''?>">RU</a>
	<a href="?lang=ua&ID=<?=$ID?>" class="adm-btn adm-btn_max<?=$lang=='ua'?' btn_active':''?>">UA</a>
</div>
<h3>Изменение дерева</h3>
<form action="edit_catalog.php?ID=<?=$ID?>&lang=<?=$lang?>" method="post">
<?php 
$r=$db->query("SELECT * FROM tree".$db_sufix." WHERE motherID=$ID ORDER BY order_p");
$N=$db->num_rows();
?>
Подразделы: <BR>
<?php 
if (!$N) echo "отсуствуют";
if ($N) {
?>
	<table class="tbl" cellspacing="0">
		<tr>
			<th>Название</th>
			<th>Alias</th>
			<th>Сортировка</th>
			<th>Top Menu</th>
			<th>Показывать</th>
			<!--th>&nbsp;</th-->
			<th>&nbsp;</th>
			<th>Удалить</th>
		</tr>
<?php while ($f=$db->fetch()) {?>
	<tr>
		<input type=hidden name="treeID[<?=$f['ID']?>]">
		<td><?=$f['name']?></td>
		<td><?=$f['alias']?></td>
		<td><input type=text name=order[<?=$f['ID']?>] value="<?=$f['order_p']?>" size=3 class="input_text"></td>
		<td align="center"><input type="checkbox" name="top_menu[<?=$f['ID']?>]" <?=($f['top_menu']!=''?' checked':'')?> value="Y" class="input_check"></td>
		<td align="center"><input type="checkbox" name="show[<?=$f['ID']?>]" <?=($f['act']!=''?' checked':'')?> value="Y" class="input_check"></td>
		<!--td><a href="edit_catalog.php?ID=<?=$f['ID']?>&lang=<?=$lang?>">Подразделы</a></td-->
		<td><a href="edit_catalog1.php?ID=<?=$f['ID']?>&lang=<?=$lang?>">Редактировать</a></td>
		<td><input type="checkbox" name=del[] value="<?=$f['ID']?>"></td>
	</tr>
<?php } // endwhile;?>
</table>
<BR />
<input type=submit name="edit" value="Изменить" class="button"> <input type=submit name=delet value="Удалить" class="button">
<?php } // endif;?>
<p>&nbsp;</p>
<h3>Добавить новый подраздел:</h3>
<table cellspacing="0" class="tbl">
	<tr>
		<td>Название раздела:</td>
		<td><input type="text" name="new_name" class="input_text" style="width:300px;"></td>
	</tr>
	<tr>
		<td>Alias:</td>
		<td><INPUT TYPE="text" NAME="alias" class="input_text" style="width:300px;"</td>
	</tr>
	<tr>
		<td>Мета тэг TITLE:</td>
		<td><input type="text" name="new_title" class="input_text" style="width:300px;"></td>
	</tr>
	<tr>
		<td>Мета тэг DESCRIPTION:</td>
		<td><TEXTAREA NAME="new_description" style="width:300px;height:40px;"></TEXTAREA></td>
	</tr>
	<tr>
		<td>Мета тэг KEYWORDS:</td>
		<td><TEXTAREA NAME="new_keywords" style="width:300px;height:40px;"></TEXTAREA></td>
	</tr>
<?php 
$exec=dir_list('exec','');
?>
	<tr>
		<td>Исп. Файл:</td>
		<td><select name="script" style="width:300px;"><?php  echo $exec ?></select></td>
	</tr>
</table>
<input type="checkbox" name="new_intop" value="Y" checked class="input_check"> Показывать в верхнем меню<br>
<input type="checkbox" name="new_show" value="Y" checked class="input_check"> Показать подраздел<br>
Содержание:<br>
<textarea id="content" name="content" style="width:600px;height:400px;" rows="20" cols="50">
                <?php echo $f['content']?>
            </textarea>
            <script>
                CKEDITOR.replace( 'body', {
					allowedContent: true,
					width: '70%',
					height: 500
				} );
            </script>
<input type="submit" name="add" value="Добавить" class="button">
</form>
</body>
</html>
