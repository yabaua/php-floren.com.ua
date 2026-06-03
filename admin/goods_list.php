<?php
require("auth.php");
require("../include/strlib.php");


if(isset($_REQUEST['category'])) $category=$_REQUEST['category'];
else $category=0;

if (!isset($_REQUEST['lang'])){
		$lang='ua';
		$db_sufix='_ua';
		$btn_lang = 'lang_ua';
	}else{		
		$lang=$_REQUEST['lang'];
		$db_sufix=	$_REQUEST['lang']=='ru'?'':('_'.$_REQUEST['lang']);
		$btn_lang = 'lang_'.$_REQUEST['lang'];
	}

$db->query("SELECT motherID FROM goods".$db_sufix."_class WHERE ID='".$category."'");
$rs=$db->fetch();
$motherCAT = $rs['motherID'];

if(isset($_REQUEST['action']) && $_REQUEST['action']=='showhide'){
		$db->query("UPDATE goods SET act='".$_REQUEST['todo']."' WHERE ID='".$_REQUEST['ID']."'");
		$db->query("UPDATE goods_ua SET act='".$_REQUEST['todo']."' WHERE ID='".$_REQUEST['ID']."'");
/*
		require("check_product_availability.php");
		check_availability('goods');
		check_availability('goods_ua');
*/
		// header("location: goods_list.php?category=".$_REQUEST['category']);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=='preorder'){
		$db->query("UPDATE goods SET preorder='".$_REQUEST['todo']."' WHERE ID='".$_REQUEST['ID']."'");
		$db->query("UPDATE goods_ua SET preorder='".$_REQUEST['todo']."' WHERE ID='".$_REQUEST['ID']."'");
/*
		require("check_product_availability.php");
		check_availability('goods');
		check_availability('goods_ua');
*/
		// header("location: goods_list.php?category=".$_REQUEST['category']);
}

if(isset($_REQUEST['edit'])){

	$sort_field	=	$motherCAT=='0'	?	'global_sort'	:	'sort'	;
	
	foreach($_REQUEST[$sort_field] AS $z=>$x){
		$db->query("UPDATE goods SET ".$sort_field."='".$x."' WHERE ID='".$z."'");
		$db->query("UPDATE goods_ua SET ".$sort_field."='".$x."' WHERE ID='".$z."'");
	}
	
	header("location: goods_list.php?category=".$_REQUEST['category']."&lang=".$lang);
		//if
}

if (isset($_REQUEST['change_ads'])){

	if (isset($_REQUEST['change_ads']) && isset($_REQUEST['id'])) {

		$new_ads_val = $_REQUEST['change_ads'] == 1 ? 0 : 1;

		$db->query("UPDATE goods SET show_ads=".$new_ads_val." WHERE ID=".$_REQUEST['id']);
		$db->query("UPDATE goods_ua SET show_ads=".$new_ads_val." WHERE ID=".$_REQUEST['id']);
		
		header("location: goods_list.php?category=".$_REQUEST['category']."&lang=".$lang);

	}

}
if (isset($_REQUEST['show_hide_ads'])){
//print_r($_POST);
$idds=array();
$db->query("SELECT ID FROM goods_forms WHERE goodID IN ('" . implode("','", $_REQUEST['ID_']) . "')");
while ($rs=$db->fetch()){
	$idds[]=$rs['ID'];
}
$db->query("DELETE FROM goods_forms2ads WHERE formID IN ('" . implode("','", $idds) . "')");

if(count($_REQUEST['show_g_ads'])){
	foreach($_REQUEST['show_g_ads'] AS $k=>$v){
		$db->query("INSERT INTO goods_forms2ads SET formID='".$k."', show_g_ads=1");
	}
}

}




if (isset($_REQUEST['act_delete']) && isset($_REQUEST['idd'])) {
		$db->query("DELETE FROM goods WHERE ID='".$_REQUEST['idd']."'");
		$db->query("DELETE FROM goods_ua WHERE ID='".$_REQUEST['idd']."'");
		$db->query("DELETE FROM goods_forms WHERE goodID='".$_REQUEST['idd']."'");
		$db->query("DELETE FROM goods_f2g WHERE gID='".$_REQUEST['idd']."'");
		$db->query("DELETE FROM goods_g2flowers WHERE gID='".$_REQUEST['idd']."'");
		//echo mysql_error();
		header("location: goods_list.php?category=".$_REQUEST['category']);

}


?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style_back.css?v=<?=time()?>">
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body style="margin-left:20px;">
<?php
//============================

include("top_menu.php");

//============================
?>
<h3>Товары</h3>


<form action="goods_list.php?category=<?=$category?>&lang=<?=$lang?>" method="post">

&nbsp;<!--&raquo;&nbsp;a href="goods_list.php?synchronyze"><b>Синхронизировать временную таблицу с реальной</b></a -->
<br />
<select name="category" id="classes">
	<option value="0"></option>
	<?php
	$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID=0");
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
		<option value="<?=$rs['ID']?>"<?=($category==$rs['ID']?' selected':'')?>>ВСЕ ТОВАРЫ КАТЕГОРИИ</option>
		<?php
		$db->query("SELECT gc.ID, gc.name, COUNT(DISTINCT g.ID) AS c FROM goods".$db_sufix."_class gc LEFT JOIN goods".$db_sufix." g ON g.classID=gc.ID WHERE motherID=".$rs['ID']." GROUP BY gc.ID", 1);
		while($rs1=$db->fetch(1)){
			//$qr_c=mysql_query("SELECT COUNT(DISTINCT g.ID) AS c FROM goods g WHERE classID=".$rs1['ID']);
			//$rs_c=mysql_fetch_array($qr_c);
		?>
		<option value="<?=$rs1['ID']?>"<?=($category==$rs1['ID']?' selected':'')?>>(<?=$rs1['ID']?>)&nbsp;&nbsp;<?=$rs1['name']?>&nbsp;&nbsp;(<?=$rs1['c']?>)</option>
	   <?php }?>
	</optgroup>
	<?php }//if wedding?>
	<?php }//while?>
</select>
<input type="submit" name="go" value="Показать" onclick="if(document.getElementById('classes').value=='0') {alert('Не выбрана рубрика');return false;}">
<br /><br />

<?php if ($category) {?>

<INPUT TYPE="submit" name="edit" value="Изменить" class="button"> <INPUT TYPE="submit" name="__delet__" value="Удалить" class="button" > <INPUT TYPE="submit" name="show_hide_ads" value="Обновить рекламу" class="button">
<br />
<div align="right">

</div>
<table class="tbl" cellpadding="2" cellspacing="0" border=0>
	<tr>
		<th>ID</th>
		<th>Фото</th>
		<th>Название</th>
		<th>Фильтры</th>
		<th>Сорт</th>
		<th>Показ</th>
		<th>Удалить</th>
		<?php if($motherCAT!='0'){?>
		<th>Участвует в рекламе</th>
		<?php }?>
	</tr>
	<?php
		if($motherCAT=='0'){
			$db->query("SELECT g.* FROM goods".$db_sufix." g JOIN goods".$db_sufix."_class gc ON g.classID=gc.ID WHERE gc.motherID='".$category."'
							ORDER BY g.act='0', g.preorder='0', g.global_sort DESC, name");
							
		}else{
			$db->query("SELECT g.* FROM goods".$db_sufix." g WHERE classID=".$category." ORDER BY act='0', g.preorder='0', sort DESC");
		}
		
		while ($v=$db->fetch()) {
		$k=$v['ID'];
	?>
	<tr<?php if($v['act']!='Y'){?> style="background:#FBE8E5"<?php }?>>
		<input type="hidden" name="ID_[]" value="<?=$k?>">
		<td><?=$k?></td>
		<td>
			<?php if ($v['image']) {?>
				<img src="/images/ins/s/<?=$v['image'].'?'.time()?>" border=0 align="left" width="75" style="margin-right:2px;">
			<?php }?>
		</td>
		<td width="200"><a href="goods_edit.php?ID=<?=$k?>&category=<?=$v['classID']?>&lang=<?=$lang?>"><?=$v['name']?></a></td>
		<td>
		<?php
			$db->query("SELECT
				gf.ID AS gfID,
				gfg.ID AS gfgID,
				gf.name AS fname,
				gfg.name AS gname,
				gf2g.fID AS selectedID
				FROM goods_filters gf
				JOIN goods_filter_groups gfg ON gfg.ID=gf.groupID
				LEFT JOIN goods_f2g gf2g ON gf.ID=gf2g.fID AND gf2g.gID='".$k."'
				WHERE gfg.classID=".$category."
				
				ORDER BY gfg.sort DESC,gf.sort DESC,gf.alias", 1);
			$prev_group='0';
			while($rs2=$db->fetch(1)){
			?>
				<?php
				if($prev_group!=$rs2['gfgID']){?>
				<div style="clear:both;padding-top:10px;"><b><?=$rs2['gname']?></b>:</div>
				<?php
				}//if group_name?>
			
				<div style="width:120px;float:left;<?php if($rs2['selectedID']==$rs2['gfID']) echo 'color:#689860;';?>">
					<?=$rs2['fname']?>&nbsp;&nbsp;
				</div>
			<?php
				$prev_group=$rs2['gfgID'];
			}// while
			?>
			
		</td>
		<td>
		<nobr>
			<?php if($motherCAT=='0'){?>
				<input type="Text" name="global_sort[<?=$k?>]" value="<?=$v['global_sort']?>" class="input_type" style="width:70px;text-align:center;" />
			<?php }else{?>
				<input type="Text" name="sort[<?=$k?>]" value="<?=$v['sort']?>" class="input_type" style="width:70px;text-align:center;" />
			<?php }?>
		</nobr>
		</td>
		<td align="center" bgcolor="<?=($v['preorder']=='0'?'#FBE8E5':'#def7e4')?>">
			<a href="goods_list.php?category=<?=$category?>&ID=<?=$k?>&action=showhide&todo=<?php if($v['act']=="Y"){?>0<?php }
				else{?>Y<?php }?>"><?php if($v['act']=="Y"){?>Скрыть<?php }else{?>Показать<?php }?></a>
			<?php if($v['act']=='Y'){?>
			<br /><br />
			<a href="goods_list.php?category=<?=$category?>&ID=<?=$k?>&action=preorder&todo=<?php if($v['preorder']=="1"){?>0<?php }
				else{?>1<?php }?>"><?php if($v['preorder']=="1"){?>Заборонити<br />Передзамовлення<?php }else{?>Дозволити<br />Передзамовлення<?php }?></a>
			<?php }?>
		</td>
		<td align="center">
			<a href="goods_list.php?category=<?=$category?>&act_delete=1&idd=<?=$k?>" onclick="if(!confirm('Уверен в удалении?')) return false;" style="text-decoration:none;">&#10060;</a>
		</td>
				<?php if($motherCAT!='0'){?>
		<td>
									<?php 
										$db->query("SELECT * FROM goods_forms gf LEFT JOIN goods_forms2ads gf2a ON gf.ID=gf2a.formID WHERE goodID='".$v['ID']."' ORDER BY price DESC",2);
										while($rs3=$db->fetch(2)){
									?>
										<div>
											<nobr>
												<input type="checkbox" <?php if(isset($rs3['show_g_ads']) && $rs3['show_g_ads'] == "1") echo 'checked'?> name="show_g_ads[<?=$rs3['ID']?>]" value="<?=(int) $rs3['show_g_ads']?>" style="width:45px;text-align:center;" /> <?=$rs3['dia'] . "/" . $rs3['hgt'] . (!$rs3['color'] ?  '' : ' ' . $rs3['color']) . ' ' . $rs3['price'] . 'грн.'?></nobr>
										</div>
										<?php }// while?>
		</td>
		<?php } // if motherCAT?>
	</tr>
    <?php }?>
</table>
<br /><br />
<INPUT TYPE="submit" name="edit" value="Изменить" class="button"> <INPUT TYPE="submit" name="__delet__" value="Удалить" class="button" > <INPUT TYPE="submit" name="show_hide_ads" value="Обновить рекламу" class="button">
<?php
	}//if rubrik
?>
</form>

<script>

	function change_ads(cat) {
		
		const id = event.target.name;
		const value = event.target.value;
		window.location.href = `goods_list.php?category=${cat}&change_ads=${value}&id=${id}`;
	}

</script>

</body>
</html>