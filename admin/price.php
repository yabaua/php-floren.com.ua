<?php 
header("content-type: text/html;charset=utf-8 \r\n");
require("auth.php");
require("../include/strlib.php");


if(isset($_REQUEST['category'])) $category=$_REQUEST['category'];
else $category=0;


if(isset($_REQUEST['update_price2'])){
	foreach($_REQUEST['new_price'] AS $k=>$v){
		$db->query("UPDATE goods_forms SET price='".$_REQUEST['new_price'][$k]."', old_price='".$_REQUEST['old_price'][$k]."' WHERE ID='".$k."'");
		$db->query("UPDATE goods_ua_forms SET price='".$_REQUEST['new_price'][$k]."', old_price='".$_REQUEST['old_price'][$k]."' WHERE ID='".$k."'");
	}
	//header("location:price.php");
}
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="style_back.css?v=12">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="margin-left:20px;">
<?php 
//============================

include("top_menu.php");

//============================
?>
<h3>Цены</h3>


<form name="f1" action="/admin/price.php?category=<?=$category?>" method="post">

<select name="category" id="classes">
	<option value="0"></option>
	<?php 
	$db->query("SELECT * FROM goods_class WHERE motherID=0");
	while($rs=$db->fetch()){
	if($rs['ID']=='25' || $rs['ID']=='49'){
	?>
	<option value="<?=$rs['ID']?>"<?=($category==$rs['ID']?' selected':'')?>>
		========(<?=$rs['ID']?>)&nbsp;&nbsp;<?=$rs['name']?>========
	</option>
	<?php 
	}else{
	?>
	<OPTGROUP label="<?=$rs['name']?>">
		<?php 
		$db->query("SELECT gc.ID, gc.name, COUNT(DISTINCT g.ID) AS c FROM goods_class gc LEFT JOIN goods g ON g.classID=gc.ID WHERE motherID=".$rs['ID']." GROUP BY gc.ID", 1);
		while($rs1=$db->fetch(1)){
			//$qr_c=$db->query("SELECT COUNT(DISTINCT g.ID) AS c FROM goods g WHERE classID=".$rs1['ID'], 2);
			//$rs_c=$db->fetch(2);
		?>
		<option value="<?=$rs1['ID']?>"<?=($category==$rs1['ID']?' selected':'')?>>(<?=$rs1['ID']?>)&nbsp;&nbsp;<?=$rs1['name']?>&nbsp;&nbsp;(<?=$rs1['c']?>)</option>
	   <?php }?>
	</optgroup>
	<?php }//if wedding?>
	<?php }//while?>
	<option value="74"<?=($category==74?' selected':'')?>>
		========(74)&nbsp;&nbsp;Композиции со мхом========
	</option>
</select>
<input type="submit" name="go" value="Показать" onclick="if(document.getElementById('classes').value=='0') {alert('Не выбрана рубрика');return false;}">


<?php 
if ($category) {?>
<p>&nbsp;</p>
<input type="Submit" name="update_price2" class="input_type" style="width:150px;height:30px" value="Обновить">
<p>&nbsp;</p>
<table width="1200" class="tbl" cellspacing="0">
<tr>
	<th>ID</th>
	<th>Название</th>
	<th>Название в 1С</th>
	<th>Диаметр / Ширина</th>
	<th>Высота</th>
	<th>Цена</th>
	<th>Старая<br />Цена</th>
	<th>Склад 1, шт</th>
	<th>Склад 2, шт</th>
	<th>Склад 3, шт</th>
	<th>Штрихкод</th>
</tr>
<?php 
$db->query("SELECT g.ID, g.classID, g.name, gf.ID AS formID, gf.dia, gf.depth, gf.wdt, gf.hgt, gf.color, gf.price, gf.old_price, gfc.barcode, g1c.f1_stock, g1c.f2_stock, g1c.f3_stock, g1c.name AS name1c
			FROM goods g
			LEFT JOIN goods_forms gf ON g.ID=gf.goodID
			LEFT JOIN goods_forms2_1c gfc ON gf.ID=gfc.fID
			LEFT JOIN goods_1c g1c ON gfc.barcode=g1c.barcode
			WHERE classID=".$category."
			ORDER BY g.sort DESC, price DESC");

for($i=0;$rs=$db->fetch();$i++){
?>
<tr<?php if($i%2==1) echo ' bgcolor="#EEE7DF"'?>>
	<td><a href="goods_edit.php?ID=<?=$rs['ID']?>&cid=<?=$rs['classID']?>"><?=$rs['formID']?></a></td>
	<td><?=$rs['name']?><?=($rs['color']!=''?" (".$rs['color'].")":"--");?> </td>
	<td><?=$rs['name1c']?></td>
	<td align="center">
		<?php
			if (!empty($rs['dia']) && $rs['dia']!=0) echo "&#216; " . $rs['dia'];
			if (!empty($rs['wdt']) && $rs['wdt']!=0) echo $rs['wdt'];
			if (!empty($rs['depth']) && $rs['depth']!=0) echo " x " . $rs['depth'];
		?>
	</td>
	<td align="center"><?=$rs['hgt']?></td>
	<td>
		<?php if(!$rs['formID']){?>&nbsp;
		<?php }else{?>
		<input type="Text" class="input_type" style="width:80px;" name="new_price[<?=$rs['formID']?>]" value="<?=$rs['price']?>" />
		<?php }?>
	</td>
	<td><?php if(!$rs['formID']){?>&nbsp;
		<?php }else{?>
		<input type="Text" class="input_type" style="width:80px;" name="old_price[<?=$rs['formID']?>]" value="<?=$rs['old_price']?>" />
		<?php }?>
	</td>
	<td align="center"><?=$rs['f1_stock']?></td>
	<td align="center"><?=$rs['f2_stock']?></td>
	<td align="center"><?=$rs['f3_stock']?></td>
	<td align="center"><?=$rs['barcode']?></td>
</tr>
<?php }?>
</table>
<?php }//if rubrik?>
</form>
</body>
</html>