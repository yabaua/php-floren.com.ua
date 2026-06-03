<?
require("auth.php");
require("../include/strlib.php");

if(isset($_REQUEST['category'])) $category=$_REQUEST['category'];
else $category=0;

if (isset($_REQUEST['delet']) && isset($_REQUEST['del'])) {
	foreach ($_REQUEST['del'] AS $d) {
		$r=mysql_query("SELECT image,images FROM goods WHERE ID=".$d);
		$f=mysql_fetch_array($r);
    	if ($f['image']) @unlink($_SERVER['DOCUMENT_ROOT'].'/images/ins/'.$f['image']);
		if ($f['images']){
			$imgs=explode(',',$f['images']);
			foreach($imgs as $v)
				@unlink($_SERVER['DOCUMENT_ROOT'].'/images/ins/'.$f['image']);
		}
		mysql_query("DELETE FROM goods WHERE ID=".$d);
		mysql_query("DELETE FROM filters_goods WHERE goodsID=".$d);
		mysql_query("DELETE FROM goods_f2g WHERE gID=".$d);
		mysql_query("DELETE FROM price_maglist WHERE qID=".$d);
		$qr=mysql_query("SELECT * FROM price_maglist pm JOIN company c ON c.ID=pm.magID WHERE qID=".$d);
		if(mysql_num_rows($qr)){
			while($rs=mysql_fetch_array($qr)){
				mysql_query("UPDATE mag_".$rs['alias']." SET qID='', formID='' WHERE qID=".$d);
				
				echo mysql_error();
			}
		}
	}
}

if (isset($_REQUEST['edit']) && isset($_REQUEST['ID_'])) {
	$num=0;
	foreach ($_REQUEST['ID_'] AS $id) {
		if (isset($show_p[$id])) $sh='Y';
		else $sh='';
		$qr_upd=mysql_query("UPDATE goods SET
		name=	'".addslashes($_REQUEST['g_name'][$id])."',
		link=	'".addslashes($_REQUEST['g_link'][$id])."',
		body=	'".str_replace("'", "&rsquo;", $_REQUEST['g_body'][$id])."',
		act=	'".$sh."' 
		WHERE ID=".$id);
		
		$num+=mysql_affected_rows();
		//echo mysql_error(), "<br>";
	}
	
	header("location:goods_edit_quick.php?category=".$category."&num=".$num);
}
?>
<html><head>
<link rel="stylesheet" type="text/css" href="style_back.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style_back.css">
<script language="JavaScript" src="cms.js" type="text/javascript"></script>
</head>
<body style="margin-left:20px;">
<h3><a href="goods_list.php?category=<?=$category?>">Товары</a>&nbsp;&raquo;&nbsp;<a href="goods_edit_quick.php?category=<?=$category?>">Быстрое редактирование</a></h3>
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
<div id="divTemp" style="width:0;height:0"></div>
<form action="goods_edit_quick.php?category=<?=$category?>" method="post">
&nbsp;
<br />
<?
if(isset($num)) echo '<font color="#FF0000">Изменено записей: '.$_REQUEST['num'].'</font>';
else echo "&nbsp;";?>
<br /><br />
<select name="category" id="classes">
	<option value="0"></option>
	<?
	$qr=mysql_query("SELECT * FROM goods_class WHERE motherID=0");
	while($rs=mysql_fetch_array($qr)){
	?>
	<OPTGROUP label="<?=$rs['name']?>">
		<?
		$qr1=mysql_query("SELECT * FROM goods_class WHERE motherID=".$rs['ID']);
		while($rs1=mysql_fetch_array($qr1)){
		?>
		<option value="<?=$rs1['ID']?>"<?=($category==$rs1['ID']?' selected':'')?>><?=$rs1['name']?></option>
	   <?}?>
	</optgroup>
	<?}?>
</select>
<input type="submit" name="go" value="Показать" onclick="if(document.getElementById('classes').value=='0') {alert('Не выбрана рубрика');return false;}">
<br /><br />

<?if ($category) {

	$r=mysql_query("SELECT g.* FROM goods g WHERE classID=".$category." ORDER BY name");
	echo mysql_error();

	$goods=array();
	for ($i=1;$f=mysql_fetch_array($r);$i++) {
		$goods[$f['ID']]['name']=$f['name'];
		$goods[$f['ID']]['body']=$f['body'];
		$goods[$f['ID']]['link']=$f['link'];
		$goods[$f['ID']]['act']=$f['act'];
	}
	?>
<table class="tbl" cellpadding="2" cellspacing="0" border=0>
	<tr>
		<th>ID</th>
		<th>Название</th>
		<th>Производитель</th>
		<th>Показ</th>
		<th>Удалить</th>
	</tr>
	<?foreach($goods as $k=>$v){?>
	<tr valign="top">
		<input type="hidden" name="ID_[]" value="<?=$k?>">
		<td><a title="Редактировать" href="goods_edit.php?ID=<?=$k?>&cid=<?=$category?>"><?=$k?></a></td>
		<td>
			<input type="Text" name="g_name[<?=$k?>]" value='<?=$v['name']?>' class="input_type" style="width:400px;"><br />
			<div contenteditable='true' style="border:1px solid #CABCAA;background:#FFFFFF;width:400;min-height:90px;" onkeyup="document.getElementById('body_<?=$k?>').value=this.innerHTML" onblur="document.getElementById('body_<?=$k?>').value=this.innerHTML" onbeforepaste="cmsBeforePaste()"><?=stripslashes($v['body'])?></div>
			<input type="Hidden" name="g_body[<?=$k?>]" id="body_<?=$k?>" value="<?=htmlspecialchars(stripslashes($v['body']))?>" />
		</td>
		<td>
			<b>link:</b><br />
			<input type="Text" name="g_link[<?=$k?>]" value='<?=$v['link']?>' class="input_type" style="width:200px;"><br />
		</td>
		<td><input type="checkbox" name="show_p[<?=$k?>]" value="Y" class="input_check"<?=($v['act']=='Y'?' checked':'')?>></td>
		<td><input type=checkbox name=del[] value="<?=$k?>" class=input_check></td>
	</tr>
	<tr>
		<td colspan="100" bgcolor="#EEEBE7">&nbsp;</td>
	</tr>
    <?}?>
</table>
<br />
<INPUT TYPE="submit" name="edit" value="Изменить" class="button"> <INPUT TYPE="submit" name="delet" value="Удалить" class="button">
<br /><br />

<?}//if rubrik?>
</form>
</body>
</html>