<?php 

error_reporting(E_ALL);
require("auth.php");
require("../include/strlib.php");
require("../include/resize.php");
require("check_product_availability.php");
require("get_video_data.php");

//id товара и LANG

if (!isset($_REQUEST['ID'])){
	header("location:goods_list.php");
	exit();
}else
	$ID=$_REQUEST['ID'];

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

//=============Категория товара

if (isset($_REQUEST['category'])) $category=$_REQUEST['category'];// Если изменена категория товара
else{
	header("location:goods_list.php?lang=".$lang);
	exit();
}



$goods_without_colors = array();
$db->query("SELECT * FROM goods_forms WHERE goodID=$ID AND color='0'");
while ($gwc_res=$db->fetch()) {
	$goods_without_colors[] = $gwc_res['ID'];
};


$db->query("SELECT * FROM goods".$db_sufix."_class WHERE ID='".$category."'");
$rs = $db->fetch();
$motherCAT  = $rs['motherID'];
$selfCAT = $rs['ID'];
$curCatName = $rs['name'];
$group_img_color = '';

$err_dict = array(
	'sizes' => 'Форма выпуска не добавлена! Невозможно одновременно добавить диаметр и ширину',
	'empty' => 'Введите данные для добавления формы выпуска',
	'color' => 'Добавьте цвет в форму выпуска',
	'square' => 'Ошибка! Фото должно быть квадратным',
);

if (isset($_GET['error'])) {
	$err_name = $_GET['error'];
	echo '<p style="color:red; margin-top: 15px; margin-bottom: 15px;">'.$err_dict[$err_name].'</p>';
}

//==============Категория товара

//Удалить форму выпуска

if (isset($_REQUEST['del'])) {

	foreach($_REQUEST['del'] as $k=>$v){
		$db->query("DELETE FROM goods_forms WHERE ID=".$k);
		$db->query("DELETE FROM goods_forms2_1c WHERE fID=".$k);
		$db->query("DELETE FROM goods_videos WHERE formID=".$k);
	}

	check_availability('goods');
	check_availability('goods_ua');
}

if (isset($_REQUEST['video_del'])) {
	foreach($_REQUEST['video_del'] as $k=>$v){
		$db->query("DELETE FROM goods_videos WHERE formID=".$k);
	}
}

// Удалить загруженное фото формы выпуска

if(isset($_REQUEST['img_del'])){

	foreach($_REQUEST['img_del'] as $k=>$v){
		$r=$db->query("SELECT * FROM goods_forms WHERE ID=".$k);
		$f=$db->fetch();

		$db->query("UPDATE goods_forms SET img='', image_gmcxml='' WHERE ID=".$k);

	}	
	header("location:goods_edit.php?lang=".$lang."&ID=".$ID);
	header("location:goods_edit.php?lang=".$lang."&ID=".$ID."&category=".$category);
}

// Видимость формы выпуска

if (isset($_REQUEST['change_visibility'])) {
	/*
	TURN ON|OFF one size and color. == OLD VARIANT==
	foreach($_REQUEST['change_visibility'] as $k => $v) {
		$new_visibility = $v === 'Показать' ? 1 : 0;
		mysql_query("UPDATE goods_forms SET visibility=".$new_visibility." WHERE ID=".$k);
	}
	*/
	/*== NEW VARIANT ==
	TURN ON|OFF all sizes of one color.
	*/
	foreach($_REQUEST['change_visibility'] as $k => $v) {
		$new_visibility = $v === 'Показать' ? 1 : 0;
		$db->query("SELECT * FROM goods_forms WHERE ID='".$k."'");
		$rs=$db->fetch();
		
		$db->query("SELECT ID FROM goods_forms WHERE goodID='".$rs['goodID']."' AND dia='".$rs['dia']."' AND hgt='".$rs['hgt']."' AND wdt='".$rs['wdt']."'",1);
		while ($rs2=$db->fetch(1)){
			$db->query("UPDATE goods_forms SET visibility=".$new_visibility." WHERE ID='".$rs2['ID']."'");
			echo "UPDATE goods_forms SET visibility=".$new_visibility." WHERE ID='".$rs2['ID']."'<br />";
		}
	}
	check_availability('goods');
	check_availability('goods_ua');
}

// Рекламный фид

$show_ads_text = '';
$ads_val = show_ads();

function show_ads() {

	$show_ads_value = '';
	global $ID; 
	global $show_ads_text;
	global $lang;
	global $db_sufix;
	global $db;

	if (isset($_REQUEST['edit_ads'])) {
		$new_ads_val = $_REQUEST['ads_val'] == 1 ? 0 : 1;
		$db->query("UPDATE goods SET show_ads=".$new_ads_val." WHERE ID=".$ID);
		$db->query("UPDATE goods_ua SET show_ads=".$new_ads_val." WHERE ID=".$ID);
	}

	$show_ads_req = $db->query("SELECT show_ads FROM goods".$db_sufix." WHERE ID=".$ID);
	$show_ads_res = $db->fetch();

	$show_ads_value = $show_ads_res['show_ads'];
	$show_ads_text = $show_ads_value == 1 ? "Товар участвует в рекламе" : "Товар не участвует в рекламе";

	return $show_ads_value;
	
}

// START: ADD NEW FORM

if (isset($_REQUEST['add_new'])) {

	if ($_REQUEST['new_dia'] > 0 && $_REQUEST['new_wdt'] > 0) {
		header("location:goods_edit.php?ID=".$ID."&category=".$category.$lang_param."&error=sizes");
		exit();
	}

	if ($motherCAT == 5 && $selfCAT != '71' && empty($_REQUEST['new_goodcolor'])) {
		header("location:goods_edit.php?ID=".$ID."&category=".$category.$lang_param."&error=color");
		exit();
	}

	if ($_REQUEST['new_measure_qt'] > 0 && ($_REQUEST['new_wdt'] > 0 || $_REQUEST['new_dia'] > 0 || $_REQUEST['new_hgt'] > 0 || $_REQUEST['new_depth'] > 0)) {
		header("location:goods_edit.php?ID=".$ID."&category=".$category.$lang_param."&error=sizes");
		exit();
	}

	if (empty($_REQUEST['new_dia']) && empty($_REQUEST['new_wdt']) && empty($_REQUEST['new_measure_qt'])) {
		header("location:goods_edit.php?ID=".$ID."&category=".$category.$lang_param."&error=empty");
		exit();

	} else {

		$db->query("SELECT gc.motherID, g.link, g.image, g.images FROM goods g JOIN goods".$db_sufix."_class gc ON g.classID=gc.ID WHERE g.ID=".$ID);
		$f = $db->fetch();
	
		$dia = empty($_REQUEST['new_dia']) ? 0 : trim($_REQUEST['new_dia']);
		$hgt = empty($_REQUEST['new_hgt']) ? 0 : trim($_REQUEST['new_hgt']);
		$wdt = empty($_REQUEST['new_wdt']) ? 0 : trim($_REQUEST['new_wdt']);
		$depth = empty($_REQUEST['new_depth']) ? 0 : trim($_REQUEST['new_depth']);
		$price = empty($_REQUEST['new_price']) ? 0 : trim($_REQUEST['new_price']);
		$old_price = empty($_REQUEST['new_oldprice']) ? 0 : trim($_REQUEST['new_oldprice']);
		$new_measure = empty($_REQUEST['new_measure']) ? 0 : trim($_REQUEST['new_measure']);
		$new_measure_qt = empty($_REQUEST['new_measure_qt']) ? 0 : trim($_REQUEST['new_measure_qt']);

		$new_color = '0';
		$image = '';
		$gmc_image = '';

		$qv_new = "INSERT INTO goods_forms SET goodID='".$ID."', dia='".$dia."', hgt='".$hgt."', wdt='".$wdt."', depth='".$depth."', measure_id='".$new_measure."', measure_qt='".$new_measure_qt."', old_price='".$old_price."', price='".$price."'";

		if ($motherCAT == 5 && $selfCAT != '71' && empty($_REQUEST['new_goodcolor'])) {
			header("location:goods_edit.php?ID=".$ID."&category=".$category.$lang_param."&error=color");
		} else {

			if (isset($_REQUEST['new_goodcolor'])) {
				$new_color = trim($_REQUEST['new_goodcolor']);
				$qv_new = $qv_new . ", color='".$new_color."'";
			}

			if (isset($_FILES['new_img']) && $_FILES['new_img']['name'] != '') {
				$image = createImg($_FILES['new_img']['tmp_name'], $new_color, $ID);
				$gmc_image = "gmcxml-".$image;
				$qv_new = $qv_new . ", image_gmcxml='".$gmc_image."'";
			} else {
				$image = $f['image'];
			};
	
			$qv_new = $qv_new . ", img='".$image."'";
	
		//	echo $db->error();
			$db->query($qv_new);
	
			check_availability('goods');
			check_availability('goods_ua');
	
			header("location:goods_edit.php?ID=".$ID."&category=".$category.$lang_param);
		}
	}	
}

// END: ADD NEW FORM


/* Add one photo to all fids */

if (isset($_REQUEST['download_all'])) {
	if (isset($_REQUEST['available_colors'])) {
		$color = $_REQUEST['available_colors'];
		if (isset($_FILES['download_img']) && isset($_FILES['download_img']['tmp_name'])) {
			$db->query("SELECT * FROM goods_forms WHERE goodID=".$ID." AND color='".$color."'");
			while ($fids_res = $db->fetch()) {
				$image = createImg($_FILES['download_img']['tmp_name'], $color, $ID);
				$image_fid = 'gmcxml-' . $image;
				$db->query("UPDATE goods_forms SET img='".$image."', image_gmcxml='".$image_fid."' WHERE goodID=".$ID." AND ID=".$fids_res['ID'], 1);
			}
		}
	}
}

function createImg($file, $color, $id) {

	global $lang;
	global $db_sufix;
	global $db;

	$db->query("SELECT g.link FROM goods".$db_sufix." g WHERE g.ID=".$id."");
	$f=$db->fetch();

	$img_name = str_replace('_','-', $f['link']).'-'.time();
	$size=getimagesize($file);

	if ($size[0]!=$size[1]) {
	
		echo '<b><FONT COLOR="#FF0000">Ошибка! Фото должно быть квадратным</FONT></b><br />';

	} else {
		
		$ww=(($size[0] < 1600)? $size[0]: "1600");
		$hh=(($size[1] < 1600)? $size[1] : "1600");

		$cl = $color ? "_" . $color : '';
	
		$image = $img_name.$cl.".jpg";
		$image_prev = "prev_".$img_name.$cl.".jpg";

		$newImgSizeX=200;
		$newImgSizeY=200;

		$prevImgSizeX=40;
		$prevImgSizeY=40;

		img_resize($file, $_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$image, $newImgSizeX,$newImgSizeY, 0xFFFFFF, 100, true, true);
		img_resize($file, $_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$image, $ww, $hh, 0xFFFFFF, 90, true, true, true);
		img_resize($file, $_SERVER['DOCUMENT_ROOT'].'/images/ins/preview/'.$image_prev, $prevImgSizeX, $prevImgSizeY, 0xFFFFFF, 90, true, true, false);
		img_resize($file, $_SERVER['DOCUMENT_ROOT'].'/images/ins/b/gmcxml-'.$image, $ww,$hh, 0xFFFFFF, 90, true, true, false);

		chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$image, 0777);
		chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$image, 0777);
		chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/preview/'.$image_prev, 0777);
	}

	return $image;

}

/* START: EDIT FORM */

if (isset($_REQUEST['edit-form']) && isset($_REQUEST['change'])) {

	foreach ($_REQUEST['change'] as $val) {
		$new_color = '0';
		$video_data = array();

		$dia = empty($_REQUEST['edit_dia'][$val]) ? 0 : trim($_REQUEST['edit_dia'][$val]);
		$hgt = empty($_REQUEST['edit_hgt'][$val]) ? 0 : trim($_REQUEST['edit_hgt'][$val]);
		$wdt = empty($_REQUEST['edit_wdt'][$val]) ? 0 : trim($_REQUEST['edit_wdt'][$val]);
		$depth = empty($_REQUEST['edit_depth'][$val]) ? 0 : trim($_REQUEST['edit_depth'][$val]);
		$price = empty($_REQUEST['edit_price'][$val]) ? 0 : trim($_REQUEST['edit_price'][$val]);
		$old_price = empty($_REQUEST['edit_oldprice'][$val]) ? 0 : trim($_REQUEST['edit_oldprice'][$val]);
		$video = trim($_REQUEST['edit_video'][$val]);
		$measure = empty($_REQUEST['edit_measure'][$val]) ? 0 : trim($_REQUEST['edit_measure'][$val]);
		$measure_qt = empty($_REQUEST['edit_measure_qt'][$val]) ? 0 : trim($_REQUEST['edit_measure_qt'][$val]);

		if (!empty($video)) {
			$video_data = get_video_info($video);

			if (count($video_data) > 0) {
				$prev = $video_data['preview'];
				$duration = $video_data['duration'];
				$pub_date = $video_data['pub_date'];
				$videoId = $video_data['videoID'];
				$symbols = array("\\", "\/", "\|");
				$title = base64_encode(str_replace($symbols, ', ', $video_data['title']));

				$db->query("DELETE FROM goods_videos WHERE formID=".$val);
				$db->query("INSERT INTO goods_videos (formID, video, title, pub_date, preview, duration) VALUES ('$val', '$videoId', '$title', '$pub_date', '$prev', '$duration')");
			} else {
				echo '<b><FONT COLOR="#FF0000">Невозможно привязать данное видео. Проверьте правильность ввода идентификатора</FONT></b><br />';
			}
		}

		$qv_edit = "UPDATE goods_forms SET dia='".$dia."', hgt='".$hgt."', wdt='".$wdt."', depth='".$depth."', measure_id='".$measure."', measure_qt='".$measure_qt."', price='".$price."', old_price='".$old_price."'";

		if (isset($_REQUEST['color_select'])) {
			$new_color = trim($_REQUEST['color_select'][$val]);
			$qv_edit = $qv_edit . ", color='".$new_color."'";
		}

		if (isset($_FILES['image_color']['name']) && $_FILES['image_color']['name'] != '') {
			foreach ($_FILES['image_color']['name'] as $k => $v) {
				if (!$v) continue;

				$image = createImg($_FILES['image_color']['tmp_name'][$k], $new_color, $ID);
				$gmc_image = "gmcxml-".$image;
				$qv_edit = $qv_edit . ", image_gmcxml='".$gmc_image."', img='".$image."'";
			}
		} 

		$qv_edit = $qv_edit . " WHERE ID=".$val."";
		$db->query($qv_edit);
		
		//=============	UPDATE 1C price for goods that is no in stock for the moment
		$db->query("SELECT * FROM goods_forms gf JOIN goods_forms2_1c gf21c ON gf.ID=gf21c.fID WHERE gf.ID='".$val."'", 1);
		while($rrs=$db->fetch(1)){
			$db->query("UPDATE goods_1c SET price='".$price."' WHERE barcode='".$rrs['barcode']."'", 2);
		}
		//=============	UPDATE 1C price for goods that is no in stock for the moment

/* 		header("location:goods_edit.php?ID=".$ID."&category=".$category.$lang_param);
		echo mysql_error(); */

	}

	check_availability('goods');
	check_availability('goods_ua');
}

/* END: EDIT FORM */


//Удаление фото

if(isset($_REQUEST['del_img_b'])){
	foreach($_REQUEST['del_img_b'] as $k=>$v){
		$db->query("UPDATE goods SET image='' WHERE ID=".$ID);
		$db->query("UPDATE goods_ua SET image='' WHERE ID=".$ID);
	//	@unlink($_SERVER['DOCUMENT_ROOT']."/images/ins/b/".$k);
	//	@unlink($_SERVER['DOCUMENT_ROOT']."/images/ins/s/".$k);
	}
}

if(isset($_REQUEST['del_img_s'])){
	foreach($_REQUEST['del_img_s'] as $k=>$v){
		$qr=$db->query("SELECT images FROM goods".$db_sufix." WHERE ID=".$ID);
		$rs=$db->fetch();
		
		$images=explode(",", $rs['images']);
		unset($images[array_search($k, $images)]);
		
		$db->query("UPDATE goods SET images='".implode(",", $images)."' WHERE ID=".$ID);
		$db->query("UPDATE goods_ua SET images='".implode(",", $images)."' WHERE ID=".$ID);
	//	@unlink($_SERVER['DOCUMENT_ROOT']."/images/ins/b/".$k);
	//	@unlink($_SERVER['DOCUMENT_ROOT']."/images/ins/s/".$k);
	
	}
}


if (isset($_REQUEST['edit'])) {

	if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

		$db->query("SELECT gc.motherID,g.link,g.image, g.images FROM goods".$db_sufix." g JOIN goods".$db_sufix."_class gc ON g.classID=gc.ID WHERE g.ID=".$ID);
		$f=$db->fetch();

		$images=$f['images']; //сохраним старые доп.фото

		/*
		if($f['image']!=''){//если главная картинка уже есть перемещаем её в дополнительные
			if($f['images']=='') $imgs=array();
			else $imgs=explode(',',$f['images']);
			$imgs[]=$f['image'];
			$images=implode(',',$imgs);
			//аналог array_push();
		}
		*/

		$img_name=str_replace('_','-', $f['link']).'-'.time();
		$size=getimagesize($_FILES['image']['tmp_name']);

		if($size[0]!=$size[1]) {

			header("location:goods_edit.php?ID=".$ID."&category=".$category.$lang_param."&error=square");
			exit();

		}else{

			$ww=(($size[0]<1600)?$size[0]:"1600");
			$hh=(($size[1]<1600)?$size[1]:"1600");
		
			$image=$img_name.".jpg";
			$applyMaskBig=false;
			if ($_REQUEST['apply_mask_check_big']=="on")  $applyMaskBig=true;

			$newImgSizeX=200;
			$newImgSizeY=200;
			if($f['motherID']=='77'){
				$newImgSizeX=310;
				$newImgSizeY=310;
			}
			
			img_resize($_FILES['image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$image, $newImgSizeX,$newImgSizeY, 0xFFFFFF, 100, true, true);
			img_resize($_FILES['image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$image, $ww,$hh, 0xFFFFFF, 90, true, true, $applyMaskBig);
			img_resize($_FILES['image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/ins/b/gmcxml-'.$image, $ww,$hh, 0xFFFFFF, 90, true, true, false);

			chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$image,0777);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$image,0777);

			$db->query("UPDATE goods SET image='".$image."', image_gmcxml='gmcxml-".$image."' WHERE ID=".$ID);
			$db->query("UPDATE goods_ua SET image='".$image."', image_gmcxml='gmcxml-".$image."' WHERE ID=".$ID);

		}//if square photo
}
}


if (isset($_REQUEST['edit'])) {
	if (isset($_FILES['images_dop']) && is_uploaded_file($_FILES['images_dop']['tmp_name'])) {

		$db->query("SELECT gc.motherID,g.link,g.image, g.images FROM goods".$db_sufix." g JOIN goods".$db_sufix."_class gc ON g.classID=gc.ID WHERE g.ID=".$ID);
		$f=$db->fetch();
			
		$temp_image=str_replace('_','-',$f['link']).'-'.time().'-1.jpg';
		if($f['images']=='') $imgs=array();
		else $imgs=explode(',',$f['images']);
		$imgs[]=$temp_image;
		$images=implode(',',$imgs);

		$size=getimagesize($_FILES['images_dop']['tmp_name']);
		$ww=(($size[0]<1600)?$size[0]:"1600");
		$hh=(($size[1]<1600)?$size[1]:"1600");
		
		$applyMask=false;
		if ($_REQUEST['apply_mask_check']=="on")  $applyMask=true;
		
		if($category=='51') 	{
			img_resize($_FILES['images_dop']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$temp_image, 200,200, 0xFFFFFF, 100, true, false);
			img_resize($_FILES['images_dop']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$temp_image, $ww,$hh, 0xFFFFFF, 90, true, true, $applyMask);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$temp_image,0777);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$temp_image,0777);
		}elseif($category=='31' || $category=='67'){
			img_resize($_FILES['images_dop']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$temp_image, 200,200, 0xFFFFFF, 100, true, false);
			img_resize($_FILES['images_dop']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$temp_image, $ww,$hh, 0xFFFFFF, 90, true, true, $applyMask);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$temp_image,0777);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$temp_image,0777);
		}else{
			img_resize($_FILES['images_dop']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$temp_image, 200,200, 0xFFFFFF, 100, true, false);
			img_resize($_FILES['images_dop']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$temp_image, $ww,$hh, 0xFFFFFF, 90, true, true, $applyMask);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/b/'.$temp_image,0777);
			chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/s/'.$temp_image,0777);
		}

		$db->query("UPDATE goods SET images='".$images."' WHERE ID=".$ID);
		$db->query("UPDATE goods_ua SET images='".$images."' WHERE ID=".$ID);
	}
}



//======================Обновление объекта

if (isset($_REQUEST['edit']) && ($name=trim($_REQUEST['name']))) {

	$db->query("SELECT gc.motherID,g.link,g.image, g.images FROM goods".$db_sufix." g JOIN goods".$db_sufix."_class gc ON g.classID=gc.ID WHERE g.ID=".$ID);
	$f=$db->fetch();
	
	$body=$_REQUEST['body'];

	$short_dsc=$_REQUEST['short_dsc'];

	if (!get_magic_quotes_gpc()) {
		$name=addslashes(stripslashes(str_replace("'", "&#700;", $name)));
		$meta_title=addslashes(stripslashes(str_replace("'", "&#700;", $_REQUEST['meta_title'])));
		$meta_description=addslashes(stripslashes(str_replace("'", "&#700;", $_REQUEST['meta_description'])));
		$body=addslashes($body);
		$short_dsc=addslashes($short_dsc);
	}
	/*
	mysql_query("UPDATE goods".$db_sufix." SET
		name='".$name."',
		short_dsc='".$short_dsc."',
		body='".$body."',
		classID='".$category."'
		WHERE ID='".$ID."'");
	*/
	$db->query("UPDATE goods".$db_sufix." SET
		name='".$name."',
		meta_title='".$meta_title."',
		meta_description='".$meta_description."',
		short_dsc='".$short_dsc."',
		body='".$body."'
		WHERE ID='".$ID."'");
	
	if($_REQUEST['new_category']!=$category){
		$db->query("UPDATE goods SET classID='".$_REQUEST['new_category']."' WHERE ID='".$ID."'");
		$db->query("UPDATE goods_ua SET classID='".$_REQUEST['new_category']."' WHERE ID='".$ID."'");
		$location_category_id=$_REQUEST['new_category'];
	}
	else {
		$location_category_id=$category;
	}
	//	echo mysql_error();
	header("location:goods_edit.php?ID=".$ID."&category=".$location_category_id.$lang_param."&updated=1");
}

//=============фильтры
if(isset($_REQUEST['edit_filters'])){
		//filters for main category
		if(isset($_REQUEST['mCatFilter'])){
			foreach($_REQUEST['mCatFilter'] AS $kk=>$vv){
				$db->query("DELETE FROM goods_f2g WHERE gID='".$kk."' AND classID='".$motherCAT."'");
//				echo "===DELETE FROM goods_f2g WHERE gID='".$kk."' AND classID='".$motherCAT."'<br>";
				foreach ($vv AS $vvv){					
					foreach ($vvv AS $www){
						$idd=explode("_", $www);
						$db->query("INSERT INTO goods_f2g SET fID='".$idd[1]."', gID='".$idd[0]."', classID='".$motherCAT."'", 1);
//						echo "INSERT INTO goods_f2g SET fID='".$idd[1]."', gID='".$idd[0]."', classID='".$motherCAT."'<br>";
					}
					
				}
			}
		}
		//filters for local category
		if(isset($_REQUEST['filter'])){
			foreach($_REQUEST['filter'] AS $kk=>$vv){
				$db->query("DELETE FROM goods_f2g WHERE gID='".$kk."' AND classID='".$category."'");
				foreach ($vv AS $vvv){
					foreach ($vvv AS $www){
						$idd=explode("_", $www);
						$db->query("INSERT INTO goods_f2g SET fID='".$idd[1]."', gID='".$idd[0]."', classID='".$category."'", 1);
					}
				}

			}
		}
//	header("location:goods_edit.php?ID=".$ID."&category=".$category);
}

//=============Тех. Хар-ки
if(isset($_REQUEST['edit_tech'])){

	$db->query("DELETE FROM goods".$db_sufix."_tech2g WHERE gID=".$ID);//Удаяляем все фильтры, по конкретному товару
	foreach ($_REQUEST['tech'] AS $tid=>$tval) {
		$db->query("INSERT INTO goods".$db_sufix."_tech2g SET tID=".$tid.", gID=".$ID.", val='".$tval."'",1);
	}
	header("location:goods_edit.php?ID=".$ID."&category=".$category.$lang_param);
}


if(isset($_REQUEST['action']) && $_REQUEST['action']=='fl2g') {
	$db->query("INSERT INTO goods_g2flowers SET gID='".$_REQUEST['ID']."', flID='".$_REQUEST['sostav']."', classID='".$category."'");
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='deleteSostav') {
	$db->query("DELETE FROM goods_g2flowers WHERE gID='".$_REQUEST['ID']."' AND flID='".$_REQUEST['flID']."'");
}

function generate_cls_select($name, $id = '', $selected = '') {

	global $lang, $db;

	$is_selected = '';

	$select_id = $id ? '['.$id.']' : '';

	$db->query("SELECT * FROM goods_colors ORDER BY name_ru", 51);

	$cls_markup = '<select class="select select_color" name='.$name.$select_id.'>';

	if ($name === 'new_goodcolor') {
		$cls_markup = $cls_markup . '<option value="0">Доступные цвета</option>';
	}

	if ($name === 'color_select' && $selected == 0) {
		$cls_markup = $cls_markup . '<option value="0">Цвет не выбран</option>';
	}

	while ($cls_res=$db->fetch(51)) {

		if ($selected) {
			$is_selected = $cls_res['alias'] === $selected ? 'selected' : '';
		}
		$cls_markup = $cls_markup . '<option '.$is_selected.' value="'.$cls_res['alias'].'">'.$cls_res['name_'.$lang].' ('.$cls_res['alias'].')'.'</option>';
	}

	$cls_markup = $cls_markup . '</select>';

	return $cls_markup;

}

function get_forms_colors($id) {

	global $lang, $db;

	$db->query("SELECT * FROM goods_forms g JOIN goods_colors gc ON g.color=gc.alias WHERE goodID=".$id." ORDER BY color",48);
	$colors = array();

	while ($all_cls_res = $db->fetch(48)) {

		if (!in_array($all_cls_res['alias'], $colors)) {
			$colors[$all_cls_res['name_'.$lang]] = $all_cls_res['alias'];
		}
	}

	return $colors;
}

function get_group_photo($id, $color) {
	global $db;
	$db->query("SELECT * FROM goods_forms WHERE goodID=".$id." AND color='".$color."'");
	$group_img_color = '';

	while ($cc_res = $db->fetch()) {

		if ($cc_res['img'] != '0' && $cc_res['img'] != 'ph-soon.jpg') {
			$group_img_color = $cc_res['img'];
		}

	}

	return $group_img_color;

}

function checkForms($id) {
	global $db;
	$qnt = 0;

	$db->query("SELECT count(ID) AS cnt FROM goods_forms WHERE goodID='".$id."'", 49);

	$q_res = $db->fetch(49);
	$qnt = $q_res['cnt']; 

	return $qnt;
}

function checkFormsWithColor($id) {
	global $db;
	$qnt = 0;

	$db->query("SELECT count(ID) AS cnt FROM goods_forms WHERE color<>'0' AND color<>'' AND goodID='".$id."'", 50);

	$q_res = $db->fetch(50);
	$qnt = $q_res['cnt']; 
	

	return $qnt;
}

?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="/admin/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" type="text/css" href="style_back.css?v=<?=time()?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<style type="text/css">

		

		.border {
			border: 1px solid #9D9C9B;
			padding: 20px;
		}

		h3 {
			margin-bottom: 20px;
		}

		.ads {
			max-width: 400px;
		}

		tr.hide {
			background-color: #FBE8E5;

		}

		.del_video {
			border: none;
			background-color: transparent;
			padding-top: 4px;
			padding-bottom: 2px;
			border-bottom: 1px dashed #333;
			font-size: 12px;
			cursor: pointer;
		}

  	</style>

</head>
<body style="margin-left:20px;">
<?php 
	if(isset($_REQUEST['updated']) && $_REQUEST['updated']==1){?>
	<p style="font-size:14px;color:#FF0000;"><b>Товар изменен</b></p>
<?php }?>
<?php 
//============================

	include("top_menu.php");

//============================

	$db->query("SELECT * FROM goods".$db_sufix." WHERE ID=".$ID);
	$f=$db->fetch();
?>

<h3><a href="goods_list.php?category=<?=$f['classID']?><?=$lang_param?>">Товары</a>&nbsp;&raquo;&nbsp;Изменить товар <font color="#DD0000"><?=$f['name']?></font></h3>

<br>
<table cellpadding="2" cellspacing="0">
<tr valign="top">
<td>

<form name="form" id="form" action="goods_edit.php?ID=<?=$ID?>&category=<?=$category?><?=$lang_param?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="submit" />
<table class="tbl_no_border" cellpadding="2" cellspacing="0">
	<tr>
		<td>
			<b>Название / H1:<span style="color:#FF0000;">(в УКР мові і якості опострофу використовувати </span> &#700; <span style="color:#FF0000;"> або код</span> &amp;#700; <span style="color:#FF0000;">можна скопіювати те або те</span>)</span></b><br />
			<input type="text" name="name" value='<?=$f['name']?>' class="input_type" style="width:100%;">
		</td>
	</tr>
	<tr>
		<td>
			<b>Meta-Title:</b><br />
			<input type="text" name="meta_title" value="<?=$f['meta_title']?>" class="input_type" style="width:100%;">
		</td>
	</tr>
	<tr>
		<td>
			<b>Meta-Description:</b><br />
			<input type="text" name="meta_description" value="<?=$f['meta_description']?>" class="input_type" style="width:100%;">
		</td>
	</tr>
	<tr>
		<td style="padding:10px 2px"><input type="submit" name="edit" value="Изменить" class="button"></td>
	</tr>
	<tr>
		<td>
			<b>Категория:</b><br />
			<select name="new_category" id="classes">
				<option value="0"></option>
				<?php 
					$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID=0");

					while($rs=$db->fetch()){

					if($rs['ID']=='25' || $rs['ID']=='49'){

				?>
				<option value="<?=$rs['ID']?>"<?=($category==$rs['ID']?' selected':'')?>>
					========<?=$rs['name']?>========
				</option>
				<?php 
					}else{
				?>
				<OPTGROUP label="<?=$rs['name']?>">
					<?php 
						$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID=".$rs['ID'],1);
						while($rs1=$db->fetch(1)){
					?>
					<option value="<?=$rs1['ID']?>"<?=($category==$rs1['ID']?' selected':'')?>><?=$rs1['name']?></option>
			 	  <?php }?>
				</optgroup>
				<?php }//if wedding?>
				<?php }//while?>
			</select></td>
	</tr>
	<tr valign="top">
		<td style="border:1px solid #999999;padding:5px;"><b>Главное Фото:</b><br />
		<div class="holder">
		<?php if ($f['image']) {?>
			<img src="/images/ins/s/<?=$f['image'].'?'.time()?>" border=0 align="left" style="margin-right:2px;">
		<?php }?>
		<br>
		<div style="clear:both;padding:10px 0;">
			<b>Загрузить главное фото – (<font color="#FF0000">Должно быть квадратное</font>):</b> 
			<br />
			<input type="file" name="image">
			<br />
			<input type="checkbox" checked="true" name="apply_mask_check_big" />&nbsp;&nbsp;&nbsp;Использовать логотип поверх
		</div>
		</td>
	</tr>
		
	<tr>
		<td style="border:1px solid #999999;padding:5px;"><b>Дополнительные Фото:</b><br />
		<?php 
		if ($f['images']){
		$imgs=explode(',', $f['images']);
		?>
			<?php foreach($imgs as $v){?>
			<div style="float:left;margin-left:5px;">
				<img src="/images/ins/s/<?=$v.'?'.time()?>" border=0 align="left" style="margin-right:2px;">
				<input type="Submit" name="del_img_s[<?=$v?>]" class="delete_but" value="&#10006;" onclick="if(!confirm('Уверен?')) return false;">
			</div>
			<?php }//foreach?>
		<?php }//if images?>
		</div>
		<br>
		<div style="clear:both;padding:15px 0;">
			<b>Загрузить новое:</b> <input type="file" name="images_dop"><br />
			<input type="checkbox" checked="true" name="apply_mask_check" />&nbsp;&nbsp;&nbsp;Использовать логотип поверх
		</div>
		</td>
		
	</tr>
	<tr>
		<td>
			<b>Краткое описание:</b><br />
			<textarea name="short_dsc" class="input_type" style="width:100%;height:95px;"><?=$f['short_dsc']?></textarea>
		</td>
	</tr>
	<tr>
		<td>Полное описание:
			<textarea id="content" name="body" style="width:600px;height:400px;" rows="20" cols="50">
                <?php echo $f['body']?>
            </textarea>
            <script>
                CKEDITOR.replace( 'body', {
					allowedContent: true,
					width: '70%',
					height: 500
				} );
            </script>
		</td>
	</tr>
</table>
<input type="submit" name="edit" value="Изменить" class="button">
</form>

<br /><br />

<!-- Фид -->

<div class="border ads">
	<h3><?=$show_ads_text?></h3>
	<form name="change_ads" action="goods_edit.php?ID=<?=$ID?>&category=<?=$category?><?=$lang_param?>" method="post">
		<input type="hidden" name="ads_val" value="<?=$ads_val?>">
		<input type="submit" name="edit_ads" value="Изменить" class="button">
	</form>
</div>

<br /><br />

<!-- =========================== ADD NEW FORM ========================== -->

<section class="section">
	<p class="headline">Новая форма выпуска</p>
	
	<form name="form_new" action="goods_edit.php?ID=<?=$ID?>&category=<?=$category?><?=$lang_param?>" method="post" enctype="multipart/form-data">
		<table class="adm-table">
			<thead class="adm-table__head">
				<th>Диаметр</th>
				<th>Ширина</th>
				<th>Высота</th>
				<th>Глубина</th>
				<th>Другое значение</th>
				<th>Ед. измерения</th>
				<th>Цена</th>
				<th>Старая цена</th>
				<th>Цвет</th>
				<th>Фото</th>
			</thead>
			<tbody class="adm-table__body">
				<tr>
					<td><input class="input" type="text" name="new_dia" placeholder="0"></td>
					<td><input class="input" type="text" name="new_wdt" placeholder="0"></td>
					<td><input class="input" type="text" name="new_hgt" placeholder="0"></td>
					<td><input class="input" type="text" name="new_depth" placeholder="0"></td>
					<td><input class="input" type="text" name="new_measure_qt" placeholder="0"></td>
					<td>
						<select name="new_measure" class="select">
							<?php 
								$db->query("SELECT * FROM goods_measures", 2);
								while ($m = $db->fetch(2)) {
							?>
								<option value="<?=$m['ID']?>"><?=$m['name_ru']?>: <?=$m['unit']?></option>
							<?php }?>
						</select>
					</td>
					<td><input class="input" type="text" name="new_price" placeholder="0"></td>
					<td><input class="input" type="text" name="new_oldprice" placeholder="0"></td>
					<td><?php echo generate_cls_select('new_goodcolor');?></td>
					<td><input type="file" name="new_img"></td>
				</tr>
			</tbody>
		</table>
		<input type="submit" name="add_new" value="Добавить" class="adm-btn adm-btn_max">
	</form>
	<p>
		<b>Чтобы привязать видео к форме выпуска:</b><br>
		1. Загрузить видео на youtube. Кликнуть на кнопку "Поделиться" - <a href="https://prnt.sc/ClwZKPJzvlYy" target="_blank">https://prnt.sc/ClwZKPJzvlYy</a> <br>
		2. Скопировать идентификатор видео и добавить в поле - <a href="https://prnt.sc/frErEpqLJk2m" target="_blank">https://prnt.sc/frErEpqLJk2m</a>
	</p>
</section>

<?php if($selfCAT != '71' && checkForms($ID) & checkFormsWithColor($ID)) {?>

<section class="section">
	<form style="border: 1px solid #9D9C9B; padding: 10px; width: 70%" name="form_download" id="form_download" action="goods_edit.php?ID=<?=$ID?>&category=<?=$category?><?=$lang_param?>" method="post" enctype="multipart/form-data">
		<p class="headline">Загрузить общее изображение для форм выпуска одного цвета</p>
		<br><br>
		<select name="available_colors">

		<?php 
			$available_cls = get_forms_colors($ID);
			foreach($available_cls as $cls => $k) {
		?>

		<option value="<?=$k?>"><?=$cls?></option>
		<?php }?>	

		</select>			

		<input type="file" name="download_img" >
		<input type="submit" name="download_all" class="button" name="Загрузить" value="Загрузить" >
	</form>
</section>
<?php }?>

<!-- =========================== EDIT FORMS ========================== -->

<?php 
	if (checkForms($ID)) {
?>

<section class="section">
	<p class="headline">Редактировать формы выпуска</p>
	<p style="margin-bottom: 30px;">Перед изменением отметьте необходимые формы выпуска</p>

		<?php 
			$colors = get_forms_colors($ID);
			
			if (count($goods_without_colors) > 0) {
				$colors['Без цвета'] = '0';
			}

			foreach ($colors as $color => $alias) {
		?>
			<div>
				<p class="headline_color"><?=$color?></p>
				<p style="color:red;">Увага! Приховувати товар можна або весь розмір або весь колір. Напр: Якщо ви хочете повністю приховати розмір 20х20, то він повинен бути прихований у всіх кольорах. Або просто ставити ціну 0.00.</p>
				<p style="color:red;">При додаванні: Якщо додається новий розмір – його необхідно додати у всі кольори.</p>
				<form name="form_edit" action="goods_edit.php?ID=<?=$ID?>&category=<?=$category?><?=$lang_param?>" method="post" enctype="multipart/form-data">
				<table class="adm-table">
					<thead class="adm-table__head">
						<th>Змін</th>
						<th>ID</th>
						<th>Діаметр</th>
						<th>Ширина</th>
						<th>Висота</th>
						<th>Глибина</th>
						<th>Інше значення</th>
						<th>Од. виміру</th>
						<th>Ціна</th>
						<th>Стара ціна</th>
						<th>Колір</th>
						<th>Фото</th>
						<th>Новое фото / Відео</th>
						<th>Дія</th>
					</thead>
					<tbody class="adm-table__body">
					<?php 			
						$db->query("SELECT gf.*, gv.*, g1c.name AS name_1c, g1c.price AS price_1c, g1c.barcode, g1c.f1_stock, g1c.f2_stock, g1c.f3_stock
										FROM goods_forms gf 
										LEFT JOIN goods_videos gv ON gf.ID=gv.formID
										LEFT JOIN goods_forms2_1c g21c ON gf.ID=g21c.fID
										LEFT JOIN goods_1c g1c ON g1c.barcode=g21c.barcode
										WHERE gf.goodID=$ID ORDER BY gf.color, gf.dia, gf.hgt");

						while ($cf_res=$db->fetch()) {
							
							$green_border='';
							if(($cf_res['f1_stock']+$cf_res['f2_stock']+$cf_res['f3_stock'])>0 && $cf_res['visibility']==0)
								$green_border=' style="border:3px solid green"';
							
							if ($cf_res['color'] === $alias) {

					?>
						<tr class="<?=$cf_res['visibility'] == 0 ? "hide" : ''?>"<?=$green_border?>>
							<td><input type="checkbox" class="input" name="change[]" value="<?=$cf_res['ID']?>"></td>	
							<td align="center"><?=$cf_res['ID']?></td>
							<td><input type="text" name="edit_dia[<?=$cf_res['ID']?>]" class="input" value="<?=$cf_res['dia']?>"></td>
							<td><input type="text" name="edit_wdt[<?=$cf_res['ID']?>]" class="input" value="<?=$cf_res['wdt']?>"></td>
							<td><input type="text" name="edit_hgt[<?=$cf_res['ID']?>]" class="input" value="<?=$cf_res['hgt']?>"></td>
							<td><input type="text" name="edit_depth[<?=$cf_res['ID']?>]" class="input" value="<?=$cf_res['depth']?>"></td>
							<td><input type="text" name="edit_measure_qt[<?=$cf_res['ID']?>]" class="input" value="<?=$cf_res['measure_qt']?>"></td>
							<td>
								<select name="edit_measure[<?=$cf_res['ID']?>]" class="select">
								<?php 				
									$db->query("SELECT * FROM goods_measures",1);
									while ($m=$db->fetch(1)) {
								?>
									<option <?php if ($cf_res['measure_id'] === $m['ID']) {?>selected<?php }?> value="<?=$m['ID']?>"><?=$m['name_ru']?>: <?=$m['unit']?></option>
								<?php }?>
								</select>
							</td>
							<td><input type="text" name="edit_price[<?=$cf_res['ID']?>]" class="input" value="<?=$cf_res['price']?>"></td>
							<td><input type="text" name="edit_oldprice[<?=$cf_res['ID']?>]" class="input" value="<?=$cf_res['old_price']?>"></td>
							<td>
								<?=generate_cls_select('color_select', $cf_res['ID'], $alias)?>
								<hr style="background-color:#cabcaa;border:0;height:1px;">
								<b><?=$cf_res['barcode']?></b>&nbsp;&nbsp;&ndash;&nbsp;&nbsp;<b><?=$cf_res['price_1c']?></b><br />
								Назва 1С: <?=$cf_res['name_1c']?>
								<hr style="background-color:#cabcaa;border:0;height:1px;">
								Наявність: Осн:<b><?=$cf_res['f1_stock']?></b>, Ф2:<b><?=$cf_res['f2_stock']?></b>, Ф3:<b><?=$cf_res['f3_stock']?></b>
								
							</td>
							<td class="image">
										
									<?php if ($cf_res['img'] && $cf_res['img'] != '0' ) { ?>
										<img width="60" src="/images/ins/s/<?=$cf_res['img']?>">
									<?php } elseif ($cf_res['color'] && $motherCAT != '3') { ?>	
										<img width="60" src="/images/ins/s/<?=$f['link']?>_<?= $cf_res['color']?>.jpg">
									<?php } else {?>
										<img width="60" src="/images/ins/s/<?=$f['image']?>">
									<?php }?>

								<?php if ($cf_res['img'] && $cf_res['img'] !== $f['image'] ) {?>
									<input title="Удалить фото" value="x" class="adm-btn_del" type="submit" name="img_del[<?=$cf_res['ID']?>]">
								<?php }?>
								
							</td>
							<td>
								<input type="file" name="image_color[]">
								<hr style="background-color:#cabcaa;border:0;height:2px;" noshade="true">
								<input type="text" placeholder="—" <?php if ($cf_res['video']) { ?>readonly<?php }?> name="edit_video[<?=$cf_res['ID']?>]" class="input" value="<?=$cf_res['video']?>">
								<?php if ($cf_res['video']) { ?>
									<input value="Удалить видео" class="del_video" type="submit" name="video_del[<?=$cf_res['ID']?>]">
								<?php }?>
							</td>
							<td>
								<input title="Видимость формы выпуска на сайте" value="<?=$cf_res['visibility'] == 1 ? 'Скрыть' : 'Показать'?>" type="submit" name="change_visibility[<?=$cf_res['ID']?>]" class="adm-btn adm-btn_mini" style="margin-bottom: 5px;width:85px;background:#<?=$cf_res['visibility'] == 1 ? 'eee7df' : 'a5c7ae'?>;color:#5f1c13;border:1px solid #CABCAA;">
								<input value="Удалить" type="submit" name="del[<?=$cf_res['ID']?>]" class="adm-btn adm-btn_mini" style="width:85px;">
							</td>
						</tr>
					<?php }}?>
					</tbody>
				</table>
				
				<!--
 				<?php if (get_group_photo($ID, $alias)) { ?>

				<div style="margin-top: 15px; display: flex;"><label style="align-self: center; padding-right: 10px"><input type="checkbox" name="image_allnew[<?=$alias?>]"> Добавить существующее фото вместо временных или отсутствующих изображений</label>
					<img src="/images/ins/s/<?= get_group_photo($ID, $alias) ?>">
				</div>

				<?php }?>
				-->

				<div>
					<input type="submit" name="edit-form" value="Изменить" class="adm-btn adm-btn_max">
				</div>
			</div>
		<?php }?>


</section>

<?php }?>


<!-- =========================== SOSTAV BUKETA ========================== -->
<?php 
	if($motherCAT=='77'){
?>

<h3>Состав букета</h3>
<table cellspacing="0" class="tbl">
	<tr>
		<td><b>Цветок</b></td>
		<td>&nbsp;</td>
	</tr>
	<?php 
	$db->query("SELECT gfl.ID, gfl.flower_name, gfl.flower_name_ua FROM goods_flowers gfl JOIN goods_g2flowers g2fl ON gfl.ID=g2fl.flID WHERE g2fl.gID='".$ID."'");
	while($rs=$db->fetch()){
	?>
	<tr>
		<td><?=$rs['flower_name'.($lang=='ru'?'':$lang)]?></td>
		<td align="center"><a href="goods_edit.php?action=deleteSostav&flID=<?=$rs['ID']?>&ID=<?=$ID?>&category=<?=$category?><?=$lang_param?>">[X]</td>
	</tr>
	<?php }?>
	<tr>
	<form name="form134" action="goods_edit.php?action=fl2g&ID=<?=$ID?>&category=<?=$category?><?=$lang_param?>" method="post">
	<td><select name="sostav">
			<option value="0"></option>
				<?php 
					$db->query("SELECT * FROM goods_flowers ORDER BY flower_name");
					while($rs=$db->fetch()){
				?>
				<option value="<?=$rs['ID']?>">
					<?=$rs['flower_name'.($lang=='ru'?'':$lang)]?>
				</option>
				<?php }//while?>
		</select>
	</td>
	<td><input type="Submit" name="add_new_flower" class="inp" value="+" style="width:30px;"></td>
	</tr>
	</form>
</table>
<?php }?>

<!-- =========================== SOSTAV BUKETA ========================== -->

<!-- =========================== SERVICE CARE TEXT========================== -->
<?php if($motherCAT=='3'){?>
<form name="form1" action="goods_edit.php?ID=<?=$ID?>&category=<?=$category?><?=$lang_param?>" method="post">
<h3>Уход</h3>
<?php 
	$db->query("SELECT gt.*, t2g.val FROM goods".$db_sufix."_tech gt LEFT JOIN goods".$db_sufix."_tech2g t2g ON (gt.ID=t2g.tID AND t2g.gID=".$ID.") WHERE classID=".$category." ORDER BY sort");
	
?>
<table>
	<?php 
		while ($rs_f=$db->fetch()) {
	?>
	<tr>
		<td><?=$rs_f['name']?></td>
		<td><textarea class="input_type" style="width:250px;height:80px" name="tech[<?=$rs_f['ID']?>]"><?=$rs_f['val']?></textarea></td>
	</tr>
	<?php }?>
</table>
<br /><br />
<INPUT TYPE="submit" name="edit_tech" value="Изменить Уход" class="button">
</form>
<!-- =========================== SERVICE CARE TEXT========================== -->
<?php } //if?>



<p>&nbsp;</p>
<p>&nbsp;</p>
<form name="form2" action="goods_edit.php?ID=<?=$ID?>&category=<?=$category?><?=$lang_param?>" method="post">
<table cellpadding="0" cellspacing="0" border="0">
<tr valign="top">
<td width="50%">
<h1>Фильтры Материнской категории</h1>
<?php 
		$db->query("SELECT
				gf.ID AS gfID,
				gfg.ID AS gfgID,
				gf.name AS fname,
				gf.name_ua AS fname_ua,
				gfg.name AS gname,
				gf2g.fID AS selectedID
				FROM goods_filters gf
				JOIN goods_filter_groups gfg ON gfg.ID=gf.groupID
				LEFT JOIN goods_f2g gf2g ON gf.ID=gf2g.fID AND gf2g.gID='".$ID."'
				WHERE gfg.classID=".$motherCAT."
				
				ORDER BY gfg.sort DESC,gf.sort DESC,gf.alias");

				
			$prev_group='0';

			while($rs2=$db->fetch()){
			?>

				<?php 
				if($prev_group!=$rs2['gfgID']){
				?>
				<div style="clear:both;padding-top:10px;"><b><?=$rs2['gname']?></b>:</div>
				<?php }//if group_name?>
			
				<div style="width:120px;float:left;">
					<input type="checkbox" name="mCatFilter[<?=$ID?>][<?=$rs2['gfgID']?>][]" value="<?=$ID?>_<?=$rs2['gfID']?>"<?php if($rs2['selectedID']==$rs2['gfID']) echo ' checked="true"';?> />
					<?=$rs2['fname'.($lang=='ru'?'':'_'.$lang)]?>&nbsp;&nbsp;
				</div>
			<?php 
				$prev_group=$rs2['gfgID'];
			}// while

			?>
</td>
<td width="50%">
<h1>Фильтры категории <?=$curCatName?></h1>
<?php 
		$db->query("SELECT
				gf.ID AS gfID,
				gfg.ID AS gfgID,
				gf.name AS fname,
				gf.name_ua AS fname_ua,
				gfg.name AS gname,
				gf2g.fID AS selectedID
				FROM goods_filters gf
				JOIN goods_filter_groups gfg ON gfg.ID=gf.groupID
				LEFT JOIN goods_f2g gf2g ON gf.ID=gf2g.fID AND gf2g.gID='".$ID."'
				WHERE gfg.classID=".$category."
				
				ORDER BY gfg.sort DESC,gf.sort DESC,gf.alias");
			$prev_group='0';

			while($rs2=$db->fetch()){
			?>
				<?php
					if($prev_group!=$rs2['gfgID']){
				?>
				<div style="clear:both;padding-top:10px;"><b><?=$rs2['gname']?></b>:</div>
				<?php }//if group_name?>
			
				<div style="width:120px;float:left;">
					<input type="checkbox" name="filter[<?=$ID?>][<?=$rs2['gfgID']?>][]" value="<?=$ID?>_<?=$rs2['gfID']?>"<?php if($rs2['selectedID']==$rs2['gfID']) echo ' checked="true"';?> />	
					<?=$rs2['fname'.($lang=='ru'?'':'_'.$lang)]?>&nbsp;&nbsp;
				</div>
			<?php 
				$prev_group=$rs2['gfgID'];
			}// while
			?>
</td>
</tr>
</table>
<div align="center"><INPUT TYPE="submit" name="edit_filters" value="Изменить Фильтры" class="button"></div>
</form>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>