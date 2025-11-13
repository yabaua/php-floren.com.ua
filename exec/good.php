<?php
include($_SERVER['DOCUMENT_ROOT'] ."/exec/good_comment.php");
include($_SERVER['DOCUMENT_ROOT'] ."/include/resize.php");

$db->query("SELECT * from goods_colors");

$colors = array();

while($cls=$db->fetch()){
	$colors[$cls['alias']]=$cls;
}

$good=array();
$img_path = '/images/goods/m/';
$img_preview_path = '/images/goods/b/';

$deleted_goods=array(161,162,163,164,165,169,170,171,172,173,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,271,273,275,281,285,291,292,293,302,306,307,309,313,317,318,337,338,339,340,341,342,343,344,345,346,347,348,349,350,351,352,386,388,391,393,395,397,399,400,561,588,589,590,591,592,593,594,595,596,597,598,599,600,601,602,603,604,605,606,607,608,609,610,611,612,613,614,615,616,617,618,619,620,621,622,623,624,625,626,627,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,650,651,1627,1628);

foreach($deleted_goods AS $v){
	if(strpos($_SERVER['REQUEST_URI'], '/product/'.$v.'_')){
		header('HTTP/1.0 404 Not Found', true, '404');
		include($_SERVER['DOCUMENT_ROOT']."/404.php");
		exit();
	}
}


if($PARAM[0]=='65_fikus_elastica_robusta'){
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("location:/product/468_fikus-robusta-kauchukonosniy-elastica/");
	exit();
}
if($PARAM[0]=='468_fikus_robusta_kauchukonosniy__elastica_robusta_3_s'){
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("location:/product/468_fikus-robusta-kauchukonosniy-elastica/");
	exit();
}
if($PARAM[0]=='153_yukka_vertakt_' || $PARAM[0]=='79_yukka_kop'){
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("location:/product/566_yukka_slonovaya/");
	exit();
}
if($PARAM[0]=='1587_gorshok-lamela-liliya' || $PARAM[0]=='1588_gorshok-lamela-liliya-beliy'){
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("location:/product/1727_lamela-lilia/");
	exit();
}


if((isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']!='')){
	$smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, follow">');
}

if (!isset($PARAM[0]) || (isset($PARAM[2]) && $PARAM[2]!='')) {
	//=============404===================
	header('HTTP/1.0 404 Not Found', true, '404');
	include($_SERVER['DOCUMENT_ROOT']."/404.php");
	exit();
	//=============404===================
} else {

	$TITLE=array();
	$hleb=array();
	$hleb[0]['link']='/';
	$hleb[0]['name']=$lingvo['main_page'];
	//Надо переделать
	$motherCAT=array(3=>'komnatnie-rasteniya', 5=>'planters', 99=>'iskusstvennie-cvety', 49=>'compositions', 82 => 'aksessuary');
	$gID=substr($PARAM[0], 0, strpos($PARAM[0], '_'));
	$gLINK=substr($PARAM[0], strpos($PARAM[0], '_')+1);



	$good=$PARAM[0];

	$db->query("SELECT *, gc.alias,
											gc.ID AS catID,
											gc.motherID
							FROM goods".$db_sufix." g 
							JOIN goods".$db_sufix."_class gc ON gc.ID=g.classID
							WHERE g.ID='".$gID."' AND g.link='".$gLINK."'");
	if(!$db->num_rows()){
					//=============404===================
					header('HTTP/1.0 404 Not Found', true, '404');
					include($_SERVER['DOCUMENT_ROOT']."/404.php");
					exit();
					//=============404===================
	}else{
		$rs_good=$db->fetch();
		$ceramic_good = 0;
		$is_plant = 0;
		$is_pot = 0;
		$is_ceramic_pot = 0;
		$is_special_ceramic_pot = 0;
		$is_lamela_pot = 0;
		$is_beton_pot = 0;
		$is_wood_pot = 0;
		$is_new_year = 0;
		$is_click_grow = 0;
		$is_lechuza = 0;
		$is_accessory = 0;

		if ($rs_good['motherID'] == 3 || $rs_good['catID'] == 3) {
				$is_plant = 1;
			}

			if ($rs_good['motherID'] == 82) {
				$is_accessory = 1;
			}

			if ($rs_good['catID'] == 81) {
				$is_new_year = 1;
			}

			if ($rs_good['motherID'] == 5 || $rs_good['catID'] == 5) {
				$is_pot = 1;
			}

			if ($rs_good['classID'] == 67) {
				$is_lamela_pot = 1;
			}

			if ($rs_good['classID'] == 76) {
				$is_click_grow = 1;
			}

			if ($rs_good['classID'] == 51) {
				$is_lechuza = 1;
			}

			if ($rs_good['classID']==31 && $rs_good['makerID']==7) {
				$is_special_ceramic_pot = 1;
			}

			if ($rs_good['classID']==31 && $rs_good['makerID']!=7) {
				$is_ceramic_pot = 1;
			}

			if ($rs_good['catID']== 71) {
				$is_beton_pot = 1;
			}
			
			if ($rs_good['catID']== 68) {
				$is_wood_pot = 1;
			}

			$smarty->assign("PLANT_GOOD", $is_plant);
			$smarty->assign("POT_GOOD", $is_pot);
			$smarty->assign("CERAMIC_GOOD", $is_ceramic_pot);
			$smarty->assign("SPECIAL_CERAMIC_GOOD", $is_special_ceramic_pot);
			$smarty->assign("LAMELA_GOOD", $is_lamela_pot);
			$smarty->assign("BETON_GOOD", $is_beton_pot);
			$smarty->assign("WOOD_GOOD", $is_wood_pot);
			$smarty->assign("NY_GOOD", $is_new_year);
			$smarty->assign("LECHUZA_GOOD", $is_lechuza);
			$smarty->assign("ACCESSORY_GOOD", $is_accessory);
			
			//=====WEDDING & BOUQUET
		
			if($rs_good['classID']==25){
					//=============404===================
					header('HTTP/1.0 404 Not Found', true, '404');
					include($_SERVER['DOCUMENT_ROOT']."/404.php");
					exit();
					//=============404===================
			}
			if($rs_good['motherID']==77){
				header("HTTP/1.0 301 Moved Permanently"); 
				header("Location: /buket/".$rs_good['ID']."/");
				exit();
			}
			//=====END WEDDING & BOUQUET
			if(in_array($rs_good['classID'],array(49))){
				include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
				header("HTTP/1.0 301 Moved Permanently"); 
				header("Location: /compositions/".$rs_good['link']."/");
				exit();
			}
	}


	//=============== SHOW 1 GOOD ==========
	$db->query("SELECT 
		g.*,
		gfs.ID AS gfsID,
		gfs.dia,
		gfs.wdt,
		gfs.hgt,
		gfs.depth,
		gfs.price,
		gfs.old_price,
		gfs.color,
		gfs.img,
		gfs.action_subtitle,
		gfs.visibility,
		gfs.measure_qt,
		gc.alias,
		gc.ID AS catID,
		gc.motherID,
		gc.name AS className,
		gm.name AS brand,
		gmg.alias AS mg_alias,
		gmg.unit AS mg_unit,
		gmg.name_".$lang." AS measure_name,
		gv.video,
		gv.title AS video_title,
		gv.pub_date,
		gv.preview,
		gv.duration,
		(g1c.f1_stock+g1c.f2_stock-g1c.rezerv) AS db_1c_availability
		FROM goods".$db_sufix." g
		JOIN goods".$db_sufix."_class gc ON gc.ID=g.classID
		LEFT JOIN goods_forms gfs ON g.ID=gfs.goodID
		LEFT JOIN goods_makers gm ON gm.ID=g.makerID
		LEFT JOIN goods_measures gmg ON gmg.ID=gfs.measure_id
		LEFT JOIN goods_videos gv ON gfs.ID=gv.formID
		LEFT JOIN goods_forms2_1c g21c ON gfs.ID=g21c.fID
		LEFT JOIN goods_1c g1c ON g1c.barcode=g21c.barcode
		
		WHERE g.ID='".$gID."' AND visibility=1
		ORDER BY db_1c_availability > 0 DESC, gfs.price DESC, gfs.color DESC, gfs.dia, gfs.wdt
		");

	$good = array();
	$gof = array();
	$videos = array();
	$measures = array();


	
	if($db->num_rows()){
		$good_is_action=0;
		$increment=0; // first good in list without formID
		$hrefURL=$lang_url.'/product/'.$gID.'_'.$gLINK.'/';
		while($rs_g=$db->fetch()){
			$good_images=array();
			$good['classID']=$rs_g['classID'];
			$good['ID']=$rs_g['ID'];
			$good[$rs_g['ID']]=$rs_g;

			if ($rs_g['images']) {
				$good[$rs_g['ID']]['images']=array();
				foreach(explode(",",$rs_g['images']) AS $v) {
					if(file_exists($_SERVER['DOCUMENT_ROOT'] . $img_preview_path . str_replace('jpg', 'webp', $v))){
						$addon_img_src	=	$img_preview_path . str_replace('jpg', 'webp', $v);
					}else{
						$src= 'https://floren.com.ua/images/ins/b/' . $v;
						$dest_b		=	$_SERVER['DOCUMENT_ROOT'] . $img_preview_path .str_replace('jpg', 'webp', $v);
						img_resize($src, $dest_b, 1600, 1200, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=true, $trim=false, $resize_max=true, $apply_mask=false);
						$addon_img_src	=	$img_preview_path . str_replace('jpg', 'webp', $v);
					}
					$good_images[]=$good[$rs_g['ID']]['images'][]=$addon_img_src;
				}
			}
			
			if ($rs_g['old_price']>0) $good_is_action=1;
			if ($rs_g['gfsID']) {
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['goodID']=$rs_g['ID'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['fid']=$rs_g['gfsID'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['color']=$rs_g['color'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['video']=$rs_g['video'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['dia']=$rs_g['dia'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['hgt']=$rs_g['hgt'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['depth']=$rs_g['depth'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['wdt']=$rs_g['wdt'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['price']=$rs_g['price'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['old_price']=$rs_g['old_price'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['action_subtitle']=$rs_g['action_subtitle'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['mg_alias']=$rs_g['mg_alias'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['measure_qt']=$rs_g['measure_qt'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['mg_unit']=iconv('windows-1251', 'utf-8', $rs_g['mg_unit']);
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['measure_name']=$rs_g['measure_name'];
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['db_1c_availability']=$rs_g['db_1c_availability'];
				
				$uniqueSizes[$good['ID'].'_'.$rs_g['dia'] ."_". $rs_g['wdt']."_".$rs_g['hgt']."_".$rs_g['depth']."_".$rs_g['measure_qt']][$rs_g['color']]['hrefID']= $increment==0?$hrefURL:$hrefURL.$rs_g['gfsID']."/";
				$uniqueSizes[$good['ID'].'_'.$rs_g['dia'] ."_". $rs_g['wdt']."_".$rs_g['hgt']."_".$rs_g['depth']."_".$rs_g['measure_qt']][$rs_g['color']]['old_price']=$rs_g['old_price'];
				$uniqueSizes[$good['ID'].'_'.$rs_g['dia'] ."_". $rs_g['wdt']."_".$rs_g['hgt']."_".$rs_g['depth']."_".$rs_g['measure_qt']][$rs_g['color']]['price']=$rs_g['price'];
				$uniqueSizes[$good['ID'].'_'.$rs_g['dia'] ."_". $rs_g['wdt']."_".$rs_g['hgt']."_".$rs_g['depth']."_".$rs_g['measure_qt']][$rs_g['color']]['video']=$rs_g['video'];
				$uniqueSizes[$good['ID'].'_'.$rs_g['dia'] ."_". $rs_g['wdt']."_".$rs_g['hgt']."_".$rs_g['depth']."_".$rs_g['measure_qt']][$rs_g['color']]['videoID']=$rs_g['gfsID'];
				$uniqueSizes[$good['ID'].'_'.$rs_g['dia'] ."_". $rs_g['wdt']."_".$rs_g['hgt']."_".$rs_g['depth']."_".$rs_g['measure_qt']][$rs_g['color']]['img']=$rs_g['img'];
				if(isset($PARAM[1]) && $rs_g['gfsID']==$PARAM[1]) $us_active='1'; else $us_active='0';
				$uniqueSizes[$good['ID'].'_'.$rs_g['dia'] ."_". $rs_g['wdt']."_".$rs_g['hgt']."_".$rs_g['depth']."_".$rs_g['measure_qt']][$rs_g['color']]['active'] = $us_active;
				$uniqueSizes[$good['ID'].'_'.$rs_g['dia'] ."_". $rs_g['wdt']."_".$rs_g['hgt']."_".$rs_g['depth']."_".$rs_g['measure_qt']][$rs_g['color']]['visibility'] = $rs_g['visibility'];
				$uniqueSizes[$good['ID'].'_'.$rs_g['dia'] ."_". $rs_g['wdt']."_".$rs_g['hgt']."_".$rs_g['depth']."_".$rs_g['measure_qt']][$rs_g['color']]['db_1c_availability'] = $rs_g['db_1c_availability'];
				
				$increment++;

				$f_image = '';

				if ($rs_g['img']) {
					$f_image = $rs_g['img'];
				} elseif ($rs_g['color'] && !$is_plant) {
					$f_image = $rs_g['link'] . '_' . $rs_g['color'] . '.jpg';
				} else {
					$f_image = $rs_g['image'];
				}
				
				
				$good[$rs_g['ID']]['forms'][$rs_g['gfsID']]['img']=$f_image;

		//		if ($rs_g['visibility'] == 1) {
					$gof[] = $good[$rs_g['ID']]['forms'][$rs_g['gfsID']];
		//		}
			}

			if ($rs_g['video']) {
				$videos[] = array(
					'videoID' => $rs_g['video'],
					'title' => $rs_g['video_title'],
					'pub_date' => $rs_g['pub_date'],
					'preview' => $rs_g['preview'],
					'duration' => $rs_g['duration']
				);
			}

			if($rs_g['action_subtitle']!='') $smarty->assign("ACTION_SUBTITLE", $rs_g['action_subtitle']);

			$form_measure = '';
			$ga4_form_measure = '';
			
			if ($rs_g['dia']) {
				$form_measure		=	$form_measure . '&#216; ' . $rs_g['dia'];
				$ga4_form_measure	=	$rs_g['dia'];
			}
			if ($rs_g['wdt']) {
				$form_measure		=	$rs_g['wdt'];
				$ga4_form_measure	=	$rs_g['wdt'];
			}
			if ($rs_g['depth']) {
				$form_measure		=	$rs_g['depth'] ? $form_measure . ' x ' . $rs_g['depth'] : $form_measure . $rs_g['depth'];
				$ga4_form_measure	=	$rs_g['depth'] ? $ga4_form_measure . 'x' . $rs_g['depth'] : $ga4_form_measure . $rs_g['depth'];
			}
			if ($rs_g['hgt']) {
				$form_measure = $rs_g['dia'] ? $form_measure . ', ' . $lingvo['hgt'] . ' ' . $rs_g['hgt'] : $form_measure . ', ' . $lingvo['hgt'] . ' ' . $rs_g['hgt'];
				$ga4_form_measure	=	$ga4_form_measure.'/'.$rs_g['hgt'];
			}

			if ($rs_g['measure_qt']) {

				if ($rs_g['dia'] || $rs_g['wdt'] || $rs_g['hgt']) {
					$form_measure = $form_measure . ', ' . $rs_g['measure_qt'];
				} else {
					$form_measure = $form_measure . $rs_g['measure_qt'];
				}
			}

			$form_measure = $form_measure . ' ' .$rs_g['mg_unit'];

			$measures[$rs_g['gfsID']]		=	$form_measure;
			$measures_ga4[$rs_g['gfsID']]	=	$ga4_form_measure;

}


$curSize='';
$curColor='';
$curFID='';

$firstSize=$gof[0]['goodID'].'_'.$gof[0]['dia'] ."_". $gof[0]['wdt']."_".$gof[0]['hgt']."_".$gof[0]['depth']."_".$gof[0]['measure_qt'];
$firstColor=$gof[0]['color'];
$firstFID=$gof[0]['fid'];

if(isset($PARAM[1]) && $PARAM[1]!=''){
	$db->query("SELECT * FROM goods_forms WHERE ID='".$PARAM[1]."'");
	$rsCurSC=$db->fetch();
	$curSize=$rsCurSC['goodID'].'_'.$rsCurSC['dia'] ."_". $rsCurSC['wdt']."_".$rsCurSC['hgt']."_".$rsCurSC['depth']."_".$rsCurSC['measure_qt'];
	$curColor=$rsCurSC['color'];
	$curFID=$rsCurSC['ID'];

}else{
	$curSize=$firstSize;
	$curColor=$firstColor;
	$curFID=$firstFID;

}

$smarty->assign("CUR_SIZE", $curSize);
$smarty->assign("CUR_MEASURE_TTL", $measures[$curFID]);
$smarty->assign("CUR_GA4_MEASURE_TTL", $measures_ga4[$curFID]);
$smarty->assign("CUR_COLOR_TTL", $colors[$curColor]['name_'.$lang] ?? ''); //if ! $colors[$curColor] then ''
$smarty->assign("CUR_PRICE", $uniqueSizes[$curSize][$curColor]['price']);
$smarty->assign("CUR_AVAILABILITY", $uniqueSizes[$curSize][$curColor]['db_1c_availability']);
$smarty->assign("CUR_VISIBILITY", $uniqueSizes[$curSize][$curColor]['visibility']);
$smarty->assign("CUR_OLD_PRICE", $uniqueSizes[$curSize][$curColor]['old_price']);
$smarty->assign("CUR_VIDEO", $uniqueSizes[$curSize][$curColor]['video']);
$smarty->assign("CUR_GFSID", $curFID);


			//.  SEPARATE PAGE FOR ACTIVE FORM ID FOR GOOGLE MARKET
			$fIDDs=array();
			$active_formID='';
			$active_formIDArray=array();
			
			foreach($gof AS $k=>$v){
				$fIDDs[$k]	=	$v['fid'];
			//	print_r($v);
			//	echo "<br />=====<br />";
			}
			if(isset($PARAM[1])){
				if(in_array($PARAM[1], $fIDDs)){
					$active_formID=$PARAM[1];

					$keys_fIDDs=array_flip($fIDDs);
					$active_formIDArray	=	$gof[$keys_fIDDs[$PARAM[1]]];
					
					$smarty->assign("ACTIVE_FORMID",$active_formID);
				//	$smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, follow">');	// for not different formIDs. Main is indexable other – no.
					
				}else{ // if active formID not exist
					//=============404===================
					header('HTTP/1.0 404 Not Found', true, '404');
					include($_SERVER['DOCUMENT_ROOT']."/404.php");
					exit();
					//=============404===================
				}
			}
	// END OF SEPARATE PAGE FOR ACTIVE FORM ID FOR GOOGLE MARKET
		
		$video_script = '';

		if (count($videos) > 0) {

			$video_script = '"itemList":{
				"@type": "ItemList",
				"itemListElement": [
				';

			foreach ($videos as $k => $v) {
					$video_script .= '
					{
						"@type": "ListItem",
						"position": '.($k + 1).',
						"item": {
							"@type": "VideoObject",
							"name": "'.base64_decode($v['title']).'",
							"description": "'.base64_decode($v['title']).'",
							"thumbnailUrl": "'.$v['preview'].'",
							"duration": "'.$v['duration'].'",
							"contentUrl": "https://www.youtube.com/watch?v='.$v['videoID'].'",
							"embedUrl": "https://www.youtube.com/embed/'.$v['videoID'].'",
							"uploadDate": "'.$v['pub_date'].'"
						}
					}';


					if ($k !== count($videos) - 1) {
						$video_script.= ',';
					}
				// };
			}


			$video_script = $video_script . ']}';
		}

		// Build Unique sizes

		$db->query("SELECT *, ttl".$db_sufix." AS ttl, gf.ID AS fid, gm.name_".$lang." AS measure_name, g1c.f1_stock, g1c.f2_stock, (g1c.f1_stock+g1c.f2_stock-g1c.rezerv) AS db_1c_availability
								FROM goods_forms gf 
								LEFT JOIN goods_measures gm ON gf.measure_id=gm.ID
								LEFT JOIN goods_videos gv ON gf.ID=gv.formID
								LEFT JOIN goods_forms2_1c g21c ON gf.ID=g21c.fID
								LEFT JOIN goods_1c g1c ON g1c.barcode=g21c.barcode
								WHERE goodID='".$good['ID']."' AND visibility=1
								GROUP BY dia, wdt, hgt, depth, measure_qt
								ORDER BY db_1c_availability > 0 DESC, gf.price DESC, dia DESC, wdt DESC, measure_qt DESC");
								

		while($f=$db->fetch()){
			if($f['visibility']!=1 && $f['fid']!=$active_formID) continue; //build unique sizelist. Exclude not visible sizes. But if size is visible – let's show it.
		
			$goods_sizes[]=$f;

			$form_measure = '';

			if ($f['dia']) {
				$form_measure = $form_measure . '&#216; ' . $f['dia'];
			}
			if ($f['wdt']) {
				$form_measure = $form_measure . $f['wdt'];
			}
			if ($f['depth']) {
				$form_measure = $f['depth'] ? $form_measure . ' x ' . $f['depth'] : $form_measure . $f['depth'];
			}
			if ($f['hgt']) {
				$form_measure = $f['dia'] ? $form_measure . ', ' . $lingvo['hgt'] . ' ' . $f['hgt'] : $form_measure . ', ' . $lingvo['hgt'] . ' ' . $f['hgt'];
			}
			if ($f['measure_qt']) {
				if ($f['dia'] || $f['wdt'] || $f['hgt']) {
					$form_measure = $form_measure . ', ' . $f['measure_qt'];
				} else {
					$form_measure = $form_measure . $f['measure_qt'];
				}
			}

			$form_measure = $form_measure . ' ' .$f['unit'];
			$goods_sizes[count($goods_sizes)-1][''] = iconv('windows-1251', 'utf-8', $f['name_ru']);
			$goods_sizes[count($goods_sizes)-1]['price'] = $uniqueSizes[$good['ID'].'_'.$f['dia'] ."_". $f['wdt']."_".$f['hgt']."_".$f['depth']."_".$f['measure_qt']][$curColor]['price'];
			$goods_sizes[count($goods_sizes)-1]['old_price'] = $uniqueSizes[$good['ID'].'_'.$f['dia'] ."_". $f['wdt']."_".$f['hgt']."_".$f['depth']."_".$f['measure_qt']][$curColor]['old_price'];
			$goods_sizes[count($goods_sizes)-1]['hrefID'] = $uniqueSizes[$good['ID'].'_'.$f['dia'] ."_". $f['wdt']."_".$f['hgt']."_".$f['depth']."_".$f['measure_qt']][$curColor]['hrefID'];
			if ($curSize==$good['ID'].'_'.$f['dia'] ."_". $f['wdt']."_".$f['hgt']."_".$f['depth']."_".$f['measure_qt'])
				$goods_sizes[count($goods_sizes)-1]['active'] = 1;
			else $goods_sizes[count($goods_sizes)-1]['active'] = 0;
			$goods_sizes[count($goods_sizes)-1]['video'] = $uniqueSizes[$good['ID'].'_'.$f['dia'] ."_". $f['wdt']."_".$f['hgt']."_".$f['depth']."_".$f['measure_qt']][$curColor]['video'];
			$goods_sizes[count($goods_sizes)-1]['videoID'] = $uniqueSizes[$good['ID'].'_'.$f['dia'] ."_". $f['wdt']."_".$f['hgt']."_".$f['depth']."_".$f['measure_qt']][$curColor]['videoID'];
			$goods_sizes[count($goods_sizes)-1]['measure_name'] = $f['measure_name'];
			$goods_sizes[count($goods_sizes)-1]['mg_unit'] = iconv('windows-1251', 'utf-8', $f['unit']);
			$goods_sizes[count($goods_sizes)-1]['measure'] = $form_measure;
			
			$goods_sizes[count($goods_sizes)-1]['visibility'] = $f['visibility'];
			$goods_sizes[count($goods_sizes)-1]['db_1c_availability'] = $uniqueSizes[$good['ID'].'_'.$f['dia'] ."_". $f['wdt']."_".$f['hgt']."_".$f['depth']."_".$f['measure_qt']][$curColor]['db_1c_availability'];
		}
		if($active_formID!=''){
			//$main_image	=	$img_path . $active_formIDArray['img'];
				if(file_exists($_SERVER['DOCUMENT_ROOT'] . $img_path . str_replace('jpg', 'webp', $active_formIDArray['img']))){
					$main_image	=	$img_path . str_replace('jpg', 'webp', $active_formIDArray['img']);
				}else{
					$src= 'https://floren.com.ua/images/ins/b/gmcxml-' . $active_formIDArray['img'];
					$dest_m		=	$_SERVER['DOCUMENT_ROOT'] . '/images/goods/m/' .str_replace('jpg', 'webp', $active_formIDArray['img']);
					img_resize($src, $dest_m, 600, 600, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=false, $trim=false, $resize_max=false, $apply_mask=true);
					$main_image	=	$img_path . str_replace('jpg', 'webp', $active_formIDArray['img']);
				}
		}else{
			if ($gof[0]['img']) {
				//$main_image = $img_path . $gof[0]['img'];
				if(file_exists($_SERVER['DOCUMENT_ROOT'] . $img_path . str_replace('jpg', 'webp', $gof[0]['img']))){
					$main_image	=	$img_path . str_replace('jpg', 'webp', $gof[0]['img']);
				}else{
					$src= 'https://floren.com.ua/images/ins/b/gmcxml-' . $gof[0]['img'];
					$dest_m		=	$_SERVER['DOCUMENT_ROOT'] . '/images/goods/m/' .str_replace('jpg', 'webp', $gof[0]['img']);
					img_resize($src, $dest_m, 600, 600, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=false, $trim=false, $resize_max=false, $apply_mask=true);
					$main_image	=	$img_path . str_replace('jpg', 'webp', $gof[0]['img']);
				}
			} elseif ($gof[0]['color']) {
				//$main_image = $img_path . $good[$gID]['link'] . '_' . $gof[0]['color'] . '.jpg';
				if(file_exists($_SERVER['DOCUMENT_ROOT'] . $img_path . str_replace('jpg', 'webp', ($good[$gID]['link'] . '_' . $gof[0]['color'] . '.jpg')))){
					$main_image	=	$img_path . str_replace('jpg', 'webp', ($good[$gID]['link'] . '_' . $gof[0]['color'] . '.jpg'));
				}else{
					$src= 'https://floren.com.ua/images/ins/b/gmcxml-' . ($good[$gID]['link'] . '_' . $gof[0]['color'] . '.jpg');
					$dest_m		=	$_SERVER['DOCUMENT_ROOT'] . '/images/goods/m/' .str_replace('jpg', 'webp', ($good[$gID]['link'] . '_' . $gof[0]['color'] . '.jpg'));
					img_resize($src, $dest_m, 600, 600, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=false, $trim=false, $resize_max=false, $apply_mask=true);
					$main_image	=	$img_path . str_replace('jpg', 'webp', ($good[$gID]['link'] . '_' . $gof[0]['color'] . '.jpg'));
				}
			} else {
				//$main_image = $img_path . $good[$gID]['image'];
				if(file_exists($_SERVER['DOCUMENT_ROOT'] . $img_path . str_replace('jpg', 'webp', $good[$gID]['image']))){
					$main_image	=	$img_path . str_replace('jpg', 'webp', $good[$gID]['image']);
				}else{
					$src= 'https://floren.com.ua/images/ins/b/gmcxml-' . $good[$gID]['image'];
					$dest_m		=	$_SERVER['DOCUMENT_ROOT'] . '/images/goods/m/' .str_replace('jpg', 'webp', $good[$gID]['image']);
					img_resize($src, $dest_m, 600, 600, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=false, $trim=false, $resize_max=false, $apply_mask=true);
					$main_image	=	$img_path . str_replace('jpg', 'webp', $good[$gID]['image']);
				}
			}
		}

		$smarty->assign("G_FIRST_HGT", $goods_sizes[0]['hgt']);
		$smarty->assign("MAIN_IMAGE", $main_image);

		// All forms with barcodes

		$db->query("SELECT *, gfc.barcode AS bar, gc.name_ru AS color_name_ru FROM goods_forms gf LEFT JOIN goods_forms2_1c gfc ON gf.ID=gfc.fID 
			LEFT JOIN goods_1c g1c ON gfc.barcode=g1c.barcode 
			LEFT JOIN goods_colors gc ON gf.color=gc.alias 
			LEFT JOIN goods_measures gm ON gf.measure_id=gm.ID
			WHERE goodID='".$good['ID']."'");

		$forms_availability = array();
		

		while($gb=$db->fetch()){
			$form_mg = '';
			if (!$gb['bar']) continue;

			if ($gb['dia']) {
				$form_mg = $form_mg . '&#216; ' . $gb['dia'];
			}
			if ($gb['wdt']) {
				$form_mg = $form_mg . $gb['wdt'];
			}
			if ($gb['depth']) {
				$form_mg = $gb['depth'] ? $form_mg . ' x ' . $gb['depth'] : $form_mg . $gb['depth'];
			}
			if ($gb['hgt']) {
				$form_mg = $gb['dia'] ? $form_mg . ', ' . $lingvo['hgt'] . ' ' . $gb['hgt'] : $form_mg . ', ' . $lingvo['hgt'] . ' ' . $gb['hgt'];
			}
			
			if ($gb['measure_qt']) {

				if ($gb['dia'] || $gb['wdt'] || $gb['hgt']) {
					$form_mg = $form_mg . ', ' . $gb['measure_qt'];
				} else {
					$form_mg = $form_mg . $gb['measure_qt'];
				}
			}

			$form_mg = $form_mg . ' ' .$gb['unit'];

			if ($gb['color_name_ru']) {
				$form_mg = $form_mg . ', '. $gb['color_name_ru'];
			}

			$forms_availability[] = $form_mg . ' - ' .'Осн:' . $gb['f1_stock'] . ' | Довж:' . $gb['f2_stock'] . ' | Ахм:' . $gb['f3_stock'];
		}

		$smarty->assign("F_AVAILABILITY", $forms_availability);

		// END: All forms with barcodes;
		
		$db->query("SELECT * FROM goods_forms WHERE goodID='".$good['ID']."' GROUP BY color ORDER BY ID");
			$goods_color=array();

			while($gc=$db->fetch()){
				if ($gc['color'] == '0') continue;
				foreach ($colors as $color) {
					if ($color['alias'] != $gc['color']) continue;

					$goods_color[$gc['ID']]['alias'] = $color['alias'];
					$goods_color[$gc['ID']]['colorTitle'] = $color['name_'.$lang];
					$goods_color[$gc['ID']]['hrefID'] = $uniqueSizes[$curSize][$gc['color']]['hrefID'];
					
		            $previewImg = " style=\"\"";
		    
		            if ($is_wood_pot==1) {
		              //  $previewImg = " style=\"background: url('/images/ins/preview/prev_".$gc['color'].".jpg') 0 0 / contain no-repeat\"";
		              		$previewImg = "https://floren.com.ua/images/ins/preview/prev_".$gc['color'].".jpg";
		            } else {
		                if ($gc['img'] == '0') {
		                //  $previewImg = " style=\"background: url('/images/ins/s/".$good[$good['ID']]['link']."_".$gc['color'].".jpg') 0 0 / contain no-repeat\"";
		                    $previewImg = "https://floren.com.ua/images/ins/s/".$good[$good['ID']]['link']."_".$gc['color'].".jpg";
		               } else {
		            //   		echo 
		              		if(!file_exists($_SERVER['DOCUMENT_ROOT']."/images/ins/preview/prev_".$gc['img'])){
		              	//		$previewImg = " style=\"background: url('/images/ins/s/".$gc['img']."') 0 0 / contain no-repeat\"";
		              				$previewImg = "https://floren.com.ua/images/ins/s/".$gc['img'];
		              		}else{
		               	//		$previewImg = " style=\"background: url('/images/ins/preview/prev_".$gc['img']."') 0 0 / contain no-repeat\"";
		               				$previewImg = "https://floren.com.ua/images/ins/preview/prev_".$gc['img'];
		               		}
		            //        if (img === jsonGoodOne.image) {
		                        // IF COLOR WAS SELECTED BUT IMAGE WASN'T DOWNLOADED
		             //           prevImg = "style=\"background: url('/images/ins/s/" + img + "') 0 0 / contain no-repeat\"";
		             //       } else {
		             //           prevImg = "style=\"background: url('/images/ins/preview/prev_" + img + "') 0 0 / contain no-repeat\"";
		             //       }
		                }
		            }
			
					$goods_color[$gc['ID']]['previewImg'] = $previewImg;
					if ($curColor==$gc['color']) {
						$goods_color[$gc['ID']]['colorClass']="plant__color active";
					}else{
						$goods_color[$gc['ID']]['colorClass']= "plant__color";
					}
					if ($uniqueSizes[$curSize][$gc['color']]['price']==0){
		            	$goods_color[$gc['ID']]['colorClass'] = $goods_color[$gc['ID']]['colorClass'] . " plant__color_notavailable";
		            }
				};
			}

			$smarty->assign("G_COLOR", $goods_color);
			$smarty->assign("G_FIRST_COLOR", $curColor);
			

		//======================= CERAMIC-PLANTERS======================
/*
		if($good['classID']==31 || $good['classID']==67){

/* 			$db->query("SELECT *, ttl".$db_sufix." AS ttl FROM goods_forms WHERE goodID='".$good['ID']."' GROUP BY dia, wdt, hgt, depth ORDER BY color DESC");
			$goods_sizes=array();

			while($f=$db->fetch()){
				$goods_sizes[]=$f;
			} * /


			$gfs_idds=array();
			$db->query("SELECT * FROM goods_forms WHERE goodID='".$good['ID']."'");
			while($gg=$db->fetch()){
					$gfs_idds[$gg['dia']][$gg['color']]=$gg['ID'];
			}

			$smarty->assign("GFS_IDDS", $gfs_idds);
			$first_gfsid=$gfs_idds[$goods_sizes[0]['dia']][$goods_color[0]['color']];
			
			
		}
*/


		//======================= CERAMIC-PLANTERS======================
		
		if($good[$gID]['link']!=$gLINK){
			//=============404===================
			header('HTTP/1.0 404 Not Found', true, '404');
			include($_SERVER['DOCUMENT_ROOT']."/404.php");
			exit();
			//=============404===================
		}
		$classID=$good[$gID]['classID'];
		$motherClassID=$good[$gID]['motherID'];
		
		$smarty->assign("CATEGORY_M_ID",$good[$gID]['motherID']);
		$smarty->assign("CUR_CAT",$classID);
		
		
		$hleb_mother_cat_link='/'.$motherCAT[$good[$gID]['motherID']].'/';

		$old_aliases = array('lamela-old', 'elho-old', 'ceramic-old', 'beton-old', 'fiberstone-old');

		if (in_array($good[$gID]['alias'], $old_aliases)) {
			$tmp_arr = explode('-',$good[$gID]['alias']);
			$hleb_cat_link = $hleb_mother_cat_link.$tmp_arr[0].'/';
		} else {

			if ($good[$gID]['alias'] == 'wood-planters-old') {
				$hleb_cat_link='/'.$motherCAT[$good[$gID]['motherID']].'/'.'wood-planters'.'/';
			} else {
				$hleb_cat_link='/'.$motherCAT[$good[$gID]['motherID']].'/'.$good[$gID]['alias'].'/';
			}

		}

		

		$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/product/'.$good[$gID]['ID'].'_'.$good[$gID]['link'].'/" />');
		
		//if($good[$gID]['motherID']==3){
		//	$hleb[1]['link']=$hleb_cat_link;
		//	$hleb[1]['name']=$good[$gID]['className'];
		//	$hleb[2]['link']='';
		//	$hleb[2]['name']=$good[$gID]['name'];
		//}else{
			$hleb[1]['link']= $hleb_mother_cat_link;
			$hleb[1]['name']= $category_left[$good[$gID]['motherID']]['name'];
			$hleb[2]['link']= $hleb_cat_link;

			

			$hleb[2]['name']=$good[$gID]['className'];


			$hleb[3]['link']='';
			$hleb[3]['name']=$good[$gID]['name'];
		//}
			if(isset($PARAM[1]) && $PARAM[1]!=''){
				$hleb[3]['link']='/product/'.$gID.'_'.$gLINK."/";
				$hleb[3]['name']=$good[$gID]['name'];
				
				$hleb[4]['link']='';
				$hleb[4]['name']=$good[$gID]['name'] ." ". $measures[$curFID] ." ". ($colors[$curColor]['name_'.$lang] ?? '');
			}
		//====Тайтлы
		
		$g_name_4_ttl=html_entity_decode($good[$gID]['name']);
		$g_name_wo_space=$g_name_4_ttl;

		if ($good[$gID]['forms']) {
			foreach ($good[$gID]['forms'] AS $k=>$v){
				$meta_addon_price 	= str_replace(".", ",",$v['price']);
				$meta_addon_hgt 		= $v['hgt'];
			};	
		}

		if(strpos($g_name_wo_space, '/'))
			$g_name_wo_space=trim(substr($g_name_wo_space, 0, strpos($g_name_wo_space, '/')));
			
		/*====== OLD TITLES ============
		if(substr($meta_addon_price, 0, -2)>0){
			$good_meta_title="&#5129; ".$g_name_wo_space." &ndash; ".$lingvo['buy_for_price']." ".$meta_addon_price." грн ".$lingvo['s_dostavkoy'];
		}else{
			$good_meta_title="&#5129; ".$g_name_wo_space." &ndash; ".$lingvo['v_internet_magazine']." ".$lingvo['s_dostavkoy'];
		}
		if(substr($meta_addon_price, 0, -2)>0){
			$good_meta_description=$lingvo['button_buy']." ".$g_name_4_ttl.", ".$lingvo['dsc_hgt_from']." ".$meta_addon_hgt."см, ".$lingvo['on_price']." ".$meta_addon_price." грн &#10150; ".$lingvo['studiya_fitodizayna']." &#10047; ".$g_name_wo_space." ".$lingvo['v_kieve_s_dostavkoy']." &#128666";
		}else{
				$good_meta_description=$lingvo['button_buy']." ".$g_name_4_ttl." ".$lingvo['in_kiev']." &#10150; ".$lingvo['studiya_fitodizayna']." &#10047; ".$g_name_wo_space." ".$lingvo['v_kieve_s_dostavkoy']." &#128666";
		}
		//META_KEYWORDS
		if($good[$gID]['meta_keywords']!='') $smarty->assign("META_KEYWORDS",$good[$gID]['meta_keywords']);
		$good_meta_keywords=$g_name_4_ttl;
		====================*/
		/*=============UPDATED TITLES 23-09-15=============*/
		
		$meta_addon='';
		if($active_formID!=''){
			$meta_addon	=	" ". $measures[$curFID] ." ". ($colors[$curColor]['name_'.$lang] ?? '');
		}
		
		$good_meta_title		= 	($good[$gID]['meta_title']!='' && $active_formID=='')		?	$good[$gID]['meta_title']	:	$g_name_wo_space.$meta_addon." – ".$lingvo['button_buy']." ".$g_name_4_ttl." ".$lingvo['in_kiev']." ".$lingvo['s_dostavkoy'];
		
		$good_meta_description	=	($good[$gID]['meta_description']!='' && $active_formID=='')		?	$good[$gID]['meta_description']	:	$lingvo['meta_descr_addon_1']." ".$g_name_wo_space.$meta_addon." – ".$lingvo['meta_descr_addon_2']." ".$g_name_4_ttl.", ".$lingvo['meta_descr_addon_3'];
		
		$good_meta_keywords		=	'';
			
		$TITLE[1]=$good_meta_title;
		$smarty->assign("META_DESCRIPTION", $good_meta_description);
		$smarty->assign("META_KEYWORDS",$good_meta_keywords);
		$smarty->assign("PAGETYPE_SESSNAME",'good'.$gID);

		
		//====	/	META-TITLES
		
		
		$goodH1=$good[$gID]['name'];
		if(!$is_plant && $good[$gID]['name_alter']!='') $goodH1=$good[$gID]['name_alter']." ".$good[$gID]['name']; // if planters – add additional name
		$og_link = "https://floren.com.ua".$lang_url."/product/".$gID."_".$good[$gID]['link']."/";
		if($active_formID!=''){
			$goodH1.=" <nobr>" . $measures[$curFID]."</nobr> " . ($colors[$curColor]['name_'.$lang] ?? '');
			$og_link	.=	$active_formID."/";
		}
		$og_title = str_replace('"','&quot;', str_replace("'", "&#700;", strip_tags($goodH1)));
		
		$body_text=$good[$gID]['body'];
		preg_match_all('/<h2\b[^>]*>(.*?)<\/h2>(.*?)(?=(<h2\b[^>]*>|$))/is', $body_text, $matches, PREG_SET_ORDER);
		$new_body_text = '';
		foreach ($matches as $m) {
		     $body_title = trim($m[1]);
		     $body_content = trim($m[2]);

		    // Оборачиваем все <p>... в div.article-section__content
		    $block = '<section class="article-section">' . "\n";
		    $block .= '<h2 class="article-section__title">' . $body_title . '</h2>' . "\n";
		    $block .= '<div class="article-section__content">' . "\n" . $body_content . "\n" . '</div>' . "\n";
		    $block .= '</section>';
		
		    $new_body_text .= $block . "\n";
		}
		$smarty->assign("GOOD_ONE_BODY", $new_body_text);
		
		$smarty->assign("GOOD_ONE",$good[$gID]);
		$smarty->assign("GOOD_H1", $goodH1);
		$smarty->assign("GOOD_IS_ACTION", $good_is_action);
		
		$smarty->assign("OG_TITLE", $og_title);
		$smarty->assign("OG_LINK", $og_link);
		$smarty->assign("OG_IMAGE", "https://floren.com.ua".$main_image);
		
		
		
		
		//===========ТЕХ ХАР-КИ
		$good_tech=array();
		$db->query("
			SELECT gt.name, gt.measure, t2g.val FROM goods".$db_sufix."_tech gt
			JOIN goods".$db_sufix."_tech2g t2g ON gt.ID=t2g.tID
			WHERE t2g.gID=".$gID." AND t2g.val!='' ORDER BY gt.sort");
		while($gt=$db->fetch()){
			$good_tech[]=$gt;
		}
		$smarty->assign("GOOD_TECH",$good_tech);
		
		
		
		


		//=========ОТЗЫВЫ
		$good_feedback=array(); // it was commented but do not know why (maybe schema script). Without it - warning #963 – if($good_feedback)
		$db->query("SELECT * FROM goods_voting WHERE pageID='".$gID."' AND pageType='good' AND act='1' ORDER BY date_add DESC");
		if($db->num_rows()){
			while($g_fb=$db->fetch()){
				$good_feedback[]=$g_fb;
			}
			$smarty->assign("GOOD_FEEDBACK", $good_feedback);
		}
		$db->query("SELECT COUNT(gv.ID) AS vote_cnt, SUM(gv.vote) vote_summ, round((SUM(gv.vote)/COUNT(gv.ID)), 2) AS vote_avg FROM goods_voting gv WHERE pageID='".$gID."' AND pageType='good' AND act='1'");
		$g_vote=$db->fetch();
		if($g_vote['vote_cnt']>0){
			$SCHEMA_GOOD_REWIE_CNT=$g_vote['vote_cnt'];
			$SCHEMA_GOOD_VOTE_AVG=$g_vote['vote_avg'];
			$smarty->assign("GOOD_VOTE", $g_vote);
		}else{
			$good_vote=array('vote_cnt'=>'1', 'vote_avg'=>'5.00');
			$smarty->assign("GOOD_VOTE", $good_vote);
			$SCHEMA_GOOD_REWIE_CNT='1';
			$SCHEMA_GOOD_VOTE_AVG='5';
		}
		
		//================  SHEMA ======================
		
		$schema_good_title	=	$og_title;
		$schema_good_image="https://floren.com.ua".$main_image;
		$schema_good_brand="Флорен";
			if(isset($good['brand']) && $good['brand']!='') $schema_good_brand=$good['brand'];
		$schema_good_color	=	!$curColor ? "multi"	:	$curColor;
		$schema_good_url	=	$og_link;
		
		$schema_good_InStock="https://schema.org/InStock";
		$schema_good_price=$uniqueSizes[$curSize][$curColor]['price'];
		if($schema_good_price=="0.00" || $schema_good_price=='' || !$schema_good_price){
			$schema_good_price="0.00";
			$schema_good_InStock="https://schema.org/PreOrder";
		}
		
		$schema_script='
		<script type="application/ld+json">
		{
		    "@context": "http://schema.org",
		    "@type": "Product"
		    ,"name": "'.$schema_good_title.'"
		    ,"image": "'.$schema_good_image.'"
		    ,"description": "'.str_replace('"','&quot;', $good_meta_description).'"
		    ,"sku": "00'.$gID.'"
		    ,"mpn": "'.($gID+2145367).'"
		    ,"brand": {
		    	"@type": "Brand",
		    	"name": "'.$schema_good_brand.'"
		  	},
		  	"color" : "'.$schema_good_color.'"
		    ,"offers": 
		    {"@type": "Offer",
		    "url": "'.$schema_good_url.'",
		    "priceCurrency": "UAH",
		    "price": "'.$schema_good_price.'",
		    "priceValidUntil": "'.date('Y-m-d', time()+604800).'",
		    "availability": "'.$schema_good_InStock.'"
		    ,"hasMerchantReturnPolicy": 
		    	{
					"@type": "http://schema.org/MerchantReturnPolicy",
					"productReturnLink": "https://floren.com.ua'.$lang_url.'/purchase-returns/", 
					"merchantReturnDays": "14",
					"returnPolicyCategory" : "MerchantReturnFiniteReturnWindow",
					"returnMethod": "https://schema.org/ReturnByMail",
		      	    "returnFees": "https://schema.org/FreeReturn",
					"applicableCountry": "UA",
		    		"refundType": "FullRefund",
		    		"inStoreReturnsOffered": "True",
		    		"productReturnExceptions": "Flowers, Plants"
				}
				,"shippingDetails": 
				{
					"@type": "OfferShippingDetails",
					"shippingRate": {
						"@type": "MonetaryAmount",
						"value": "200",
						"currency": "UAH"
					},
					"shippingDestination": {
						"@type": "DefinedRegion",
						"addressCountry": "UA"
					},
					
					"deliveryTime": {
						"@type": "ShippingDeliveryTime",
						"handlingTime": {
							"@type": "QuantitativeValue",
							"minValue": "0",
							"maxValue": "4",
							"unitCode": "DAY"
						},
						"transitTime": {
							"@type": "QuantitativeValue",
							"minValue": "1",
							"maxValue": "2",
							"unitCode": "DAY"
						},
						"cutOffTime": "19:30-08:30",
						"businessDays": {
							"@type": "OpeningHoursSpecification",
							"dayOfWeek": [ "https://schema.org/Monday", "https://schema.org/Tuesday", "https://schema.org/Wednesday", "https://schema.org/Thursday","https://schema.org/Friday","https://schema.org/Saturday","https://schema.org/Sunday" ]
						}
					}
					
					
				}
		    }
		    ,"aggregateRating": {
		        "@type": "AggregateRating",
		    "ratingValue": "'.$SCHEMA_GOOD_VOTE_AVG.'",
		    "reviewCount": "'.$SCHEMA_GOOD_REWIE_CNT.'"
		    }
		}
		';
		
		
		if($good_feedback){
		$schema_script.='
		    ,"review": [
		'; 
		foreach($good_feedback AS $k=>$v)     {  
			$schema_script_review[]='
		        {
		            "@type": "Review",
		            "author": {
						"@type": "Person",
		          		"name": "'.$v['u_name'].'"
					},
		            "datePublished": "'.date('Y-m-d', $v['date_add']).'",
		            "description": "'.str_replace('"','&quot;',$v['message']).'",
		            "reviewRating": {
		                "@type": "Rating",
		                "bestRating": "5",
		                "ratingValue": "'.$v['vote'].'",
		                "worstRating": "1"
		            }
		        }';
			 } //foreach
		
		$schema_script.=implode(",", $schema_script_review);     
		$schema_script.='
		    ]';
		
		}//if good_voting
		
		if ( $video_script) {
			$schema_script.= ',' . $video_script;
		}
		
		$schema_script.='
		}
		</script>
		'; 	// $schema_script				
		$smarty->assign("SCHEMA_SCRIPT",$schema_script);
		
		
		
		
				
		//================  /SHEMA ======================
		
				$gTag='
			gtag(\'event\', \'view_item\', {
				\'send_to\': \'AW-736148489\',
				\'value\': \''.$schema_good_price.'\',
				"items": [{
					';
					$gTag.='\'id\': \''.$good[$gID]['gfsID'].'\',';
					$gTag.='\'google_business_vertical\': \'retail\'';
		
					$gTag.='
							}]
			});';// gTag
			$smarty->assign("GTAG", $gTag);
			
			
		
	
	
	} else {// 404 if good not exist
		//=============404===================
		header('HTTP/1.0 404 Not Found', true, '404');
		include($_SERVER['DOCUMENT_ROOT']."/404.php");
		exit();
		//=============404===================
	}
	$smarty->assign("CONTENT_TPL",'good.tpl');
	$smarty->assign("HLEB",$hleb);
}


/* For JS */


// $gfs_idds_json = json_encode($gfs_idds); because gfs_idds commented above
$goods_sizes_json = json_encode($goods_sizes);		
$good_one_json = json_encode($good[$gID]);
$good_forms_json = json_encode($gof);

		if($active_formID!=''){
		
			$smarty->assign("G_CUR_wdt",$active_formIDArray['wdt']);
			$smarty->assign("G_CUR_hgt",$active_formIDArray['hgt']);
			$smarty->assign("G_CUR_dia",$active_formIDArray['dia']);
			$smarty->assign("G_CUR_dept", ($active_formIDArray['dept'] ?? ''));
			$smarty->assign("G_CUR_PRICE",$active_formIDArray['price']);
	//		$smarty->assign("G_CUR_SIZE",$goods_sizes[0]['ttl']);
			$smarty->assign("G_CUR_COLOR", $active_formIDArray['color']);
	//		$smarty->assign("G_CUR_SIZE_INPUT",$goods_sizes[0]['dia'].'_'.$goods_sizes[0]['hgt']);
			$smarty->assign("G_CUR_gfsID",$active_formID);
	//		$smarty->assign("G_CUR_COLOR_INPUT",$goods_color[0]['color']);
		}else{
			$smarty->assign("G_CUR_PRICE",'');
			$smarty->assign("G_CUR_COLOR",'');
			$smarty->assign("G_CUR_gfsID",'');
		}
		
		
		$smarty->assign("FORM_MEASURES", $measures);
		$smarty->assign("GO_FORMS", $gof);
		$smarty->assign("GOOD_IMAGES", $good_images);


$smarty->assign("G_SIZES",$goods_sizes);
?>