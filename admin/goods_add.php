<?php 
require("auth.php");
// include("fckeditor/fckeditor.php") ;
require("../include/strlib.php");



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
	
//======================Обновление объекта
if (isset($_REQUEST['add_good'])) {
	$ii=0;
	foreach($_REQUEST['p_name'] as $k=>$v){
		if($v=='') continue;
		$name=$_REQUEST['p_name'][$k];
		$body=$_REQUEST['body'][$k];
	
		if (!get_magic_quotes_gpc()) {
			$name=addslashes(stripslashes($name));
			$body=addslashes($body);
		}
		$link=transliterate($name);

		$db->query("INSERT INTO goods SET
		classID=".$_REQUEST['category'].",
		name='".$name."',
		link='".$link."',
		body='".$body."',
		date_add=UNIX_TIMESTAMP(),
		act='Y'");

		$ID=$db->insert_id();

		$db->query("INSERT INTO goods_ua 
		SELECT * FROM goods WHERE ID=".$ID);

		echo $db->error();
		

		//ФИЛЬТРЫ
		if(isset($_REQUEST['filters']) && count($_REQUEST['filters'])>0){
			foreach($_REQUEST['filters'] as $k=>$v){
				$db->query("INSERT INTO goods_f2g SET fID=".$k.", gID=".$ID);
			}
		}
		$ii++;
	}//foreach
	//header("location:goods_add.php?added=&category=".$category);
}
?>
<html><head>
<link rel="stylesheet" type="text/css" href="style_back.css?c=2">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style_back.css">
<script language="JavaScript" src="cms.js" type="text/javascript"></script>
</head>
<body style="margin-left:20px;">

<?php 
//============================

include("top_menu.php");

//============================
?>
<h3>Добавление товара</h3>
<div id="divTemp" style="width:0;height:0;"></div>
<br /><br />

<form name="form" action="goods_add.php?category=<?=$category?>" method="post" enctype="multipart/form-data">

<?php if(isset($_REQUEST['added'])){?>
<FONT COLOR="#FF0000">Товары добавлены.</FONT><br />
<?php }?>
<div align="center">
		<select name="category" id="classes" onchange="document.location.href='goods_add.php?category='+this.value">
			<option value="0"></option>
			<?php 
			$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID=0");
			while($rs=$db->fetch()){
			?>
			<OPTGROUP label="<?=$rs['name']?>">
				<?php 
				$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID='".$rs['ID']."'", 1);
				while($rs1=$db->fetch(1)){
				?>
				<option value="<?=$rs1['ID']?>"<?=($category==$rs1['ID']?' selected':'')?>><?=$rs1['name']?></option>
			   <?php }?>
			</optgroup>
			<?php }?>
</select></div>
<br /><br />

<?php if($category!=0){?>
<table align="center">
<tr valign="top">
	<td style="padding-right:10px;">
	<h3>Фильтры</h3>
		<?php 
			$db->query("SELECT * FROM goods_filter_groups WHERE classID=".$category." ORDER BY sort");
			while ($rs_f=$db->fetch()) {
		?>
				<h4><?=$rs_f['name']?></h4>
				<?php 
					$db->query("SELECT gf.ID,gf.name
						FROM goods_filters gf
						WHERE gf.groupID=".$rs_f['ID']." ORDER BY gf.sort", 1);
					while ($rs_fg=$db->fetch(1)){
				?>
				<input type="checkbox" name="filters[<?=$rs_fg['ID']?>]" value="Y"><?=$rs_fg['name']?><br />
				<?php }// whihe filters?>
		<?php }//while filter groups?>
	
	</td>
	<td>
					<table class="tbl_no_border" cellpadding="2" cellspacing="0">
					<?php for($i=1;$i<=11;$i++){?>
						<tr <?=(($i%2==1) ? 'bgcolor="#EEEBE7"' :'')?>>
							<td style="padding-top:10px;" colspan="3">Название:<br><input type="text" name="p_name[<?=$i?>]" class="input_type" style="width:600px;"></td>
						</tr>
						<tr valign="top" <?=(($i%2==1) ? 'bgcolor="#EEEBE7"' :'')?>>
							<td colspan="3">Описание:<br />
							<div contenteditable='true' style="border:1px solid #CABCAA;background:#FFFFFF;width:600;min-height:90px;" onkeyup="document.getElementById('body_<?=$i?>').value=this.innerHTML" onblur="document.getElementById('body_<?=$i?>').value=this.innerHTML" onbeforepaste="cmsBeforePaste()"></div>
							<input type="Hidden" name="body[<?=$i?>]" id="body_<?=$i?>" /></td>
						</tr>
					<?php }?>
					</table>
</td>
</tr>
</table>
<INPUT TYPE="submit" name="add_good" value="Добавить" class="button" onclick="if(document.getElementById('category').value=='0') {alert('Не выбрана рубрика');return false;}">
<br /><br />
</form>
<?php }//if category 
?>
</body>
</html>