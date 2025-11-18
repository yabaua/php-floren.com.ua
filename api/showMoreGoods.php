<?php
header("Content-type: application/json; charset=utf-8");

require($_SERVER['DOCUMENT_ROOT']."/database.php");
//require($_SERVER['DOCUMENT_ROOT']."/smarty/Smarty.class.php");
//require($_SERVER['DOCUMENT_ROOT']."/include/floren.class.php");

//test JSON string
/*
$json_string=array(
	
//  "lang"		=>	'ru',
  "curPage"	=>	0,
  "perPage"	=>	25,
//  "mCat"		=>	'komnatnie-rasteniya',
//  "cat"			=>	'ficus',
//  "filters"	=>	['lechuza', 'krugliy']
);


$dataString = json_encode($json_string, JSON_UNESCAPED_UNICODE);
*/
//echo $dataString;
//print_r( json_decode($dataString, true));
//exit();


if(!isset($_SERVER['HTTP_REFERER'])){
	echo json_encode('invalid', JSON_UNESCAPED_UNICODE);
	exit();
}
$REFERER = $_SERVER['HTTP_REFERER'];
//$REFERER = ('https://floren33:8890/ua/komnatnie-rasteniya/ficus/benjamina/');
$URL = parse_url($REFERER);
$txt_hgt = array('_ua' => 'Висота', '' => 'Высота');



//$post_data = file_get_contents('php://input');
$post_data=$dataString;
$data = json_decode($post_data, true);
//$url_filters = $data['filters'];
$url_filters=array();
$perPage = $data['perPage'] ?? '25';

$categoryID='';
$product_path = '';
$img_path = '';
$sql_pot_group = '';
$is_plant = 0;
$is_pot = 0;
$is_bouquet = 0;
$is_sezon = 0;
$is_accessory = 0;

if (substr($URL['path'], 1, 2) == 'ua') {
	$lang_url='/ua';
	$db_sufix='_ua';
	$url_whiout_lang = substr($URL['path'], 3);
} else {
	$lang_url = '';
	$db_sufix = '';
	$url_whiout_lang = $URL['path'];
}

$parsedURL = explode('/',$url_whiout_lang);
$sql_sort_order = "g.global_sort DESC";



if ($parsedURL[1]=='komnatnie-rasteniya') {
	$is_plant = 1;
	$categoryID = 3;

	if (!empty($parsedURL[2]) && substr($parsedURL[2], 0, 4)!='page') {	// if subrubric !exists AN !page
		$sql_sort_order = "g.sort DESC";
	} else {
		$sql_sort_order = "g.global_sort DESC";
	}
}

if ($parsedURL[1]=='florist') {
	$is_bouquet = 1;
	$categoryID = 77;
	$sql_sort_order = "g.sort DESC";
}

if ($parsedURL[1]=='sezon') {
	$is_bouquet = 1;
	$categoryID = 80;
	$is_sezon = 1;
}

if ($parsedURL[1]=='planters') {
	$is_pot = 1;
	$categoryID = 5;
	$sql_pot_group = "GROUP BY gfs.hgt";

	if (!empty($parsedURL[2]) && substr($parsedURL[2], 0, 4)!='page') {
		$sql_sort_order = "g.sort DESC";
	} else {
		$sql_sort_order = "g.global_sort DESC";
	}
}

if ($parsedURL[1]=='aksessuary') {
	$is_accessory = 1;
	$categoryID = 82;
	$sql_pot_group = "GROUP BY gfs.measure_qt";
}


$subCatAlias='';
$subCatID='';
$subCat_sql='';
$subCat_arr= array();
$db->query("SELECT ID, alias FROM goods".$db_sufix."_class WHERE motherID='".$categoryID."'");
while($f=$db->fetch()){
	$subCat_arr[$f['alias']]=$f['ID'];
}
if(array_key_exists($parsedURL[2], $subCat_arr)){
	$subCatID=$subCat_arr[$parsedURL[2]];
	$subCatAlias=$parsedURL[2];
}	
	

if(isset($parsedURL[2]) && $parsedURL[2]!='' && array_key_exists($parsedURL[2], $subCat_arr)){
	$subCat_sql = "classID='".$subCat_arr[$parsedURL[2]]."'";
}else{
	if ($is_sezon) {
		$db->query("SELECT * FROM goods".$db_sufix."_class WHERE ID='".$categoryID."'");
	}else{
		$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID='".$categoryID."'");
	}
	while ($f = $db->fetch()){
		$categoryIDDs[] = $f['ID'];
	}
	$subCat_sql="classID IN ('".implode("','", $categoryIDDs)."')";
}

//TRY TO FIND FILTERS IN URL first lvl

if(isset($parsedURL[2]) && $parsedURL[2]!='' && !array_key_exists($parsedURL[2], array_keys($subCat_arr)) && substr($parsedURL[2], 0, 4)!='page'){
	$filters_arr = array();
	$db->query("SELECT * FROM goods_filters WHERE classID = '".$categoryID."'");
	while($f=$db->fetch()){
		$filters_arr[]=$f['alias'];	// we took all filters in cat
	}

	$tmp_url_filters=explode("-", $parsedURL[2]);
	foreach ($tmp_url_filters AS $v){
		if(in_array($v, $filters_arr))	$url_filters[]=$v;
	}
}
// END TRY TO FIND FILTERS IN URL first lvl

//TRY TO FIND FILTERS IN URL second lvl
if(!count($url_filters)){ // if steel no filters detected
	if(isset($parsedURL[3]) && $parsedURL[3]!='' && $subCatID!='' && substr($parsedURL[3], 0, 4)!='page'){
		$filters_arr = array();
		$db->query("SELECT * FROM goods_filters WHERE classID = '".$subCatID."'");
		while($f=$db->fetch()){
			$filters_arr[]=$f['alias'];
		}
		$tmp_url_filters=explode("-", $parsedURL[3]);
		foreach ($tmp_url_filters AS $v){
			if(in_array($v, $filters_arr))	$url_filters[]=$v;
		}
	}
}
//END TRY TO FIND FILTERS IN URL second lvl


$limFirstPar = 0;
if (isset($data['curPage'])) $limFirstPar = $data['curPage'] * $perPage;

$tmp_filter_selected_goods = array();
$filter_selected_groups = array();
$filter_selected_goods=array();

if (count($url_filters) > 0) {

	foreach ($url_filters as $filter) {
		$db->query("SELECT g.ID AS gID, gf.groupID, gf.name".$db_sufix." AS name
		FROM goods g
		JOIN goods_f2g f2g ON f2g.gID=g.ID
		JOIN goods_filters gf ON f2g.fID=gf.ID
		WHERE gf.alias='".$filter."'
		GROUP BY g.ID");
		while ($rs=$db->fetch()) {
			$tmp_filter_selected_goods[] = $rs['gID'];
			$filter_selected_groups[] = $rs['groupID'];
		}

	}

	if (is_array($tmp_filter_selected_goods)) {

		$cnt_filter_selected_goods = array_count_values($tmp_filter_selected_goods);

		foreach ($cnt_filter_selected_goods AS $fid => $cnt) {

			if ($cnt == count(array_unique($filter_selected_groups))) {
				$filter_selected_goods[] = $fid;
			}

		}
	}

	$filter_selected_goods_str = implode(',', $filter_selected_goods);


	$query = "SELECT g.ID, g.link, g.classID, g.name, g.image, g.availability, min(NULLIF(gf.price, 0)) AS min_price, max(gf.price) AS max_price, g.act FROM goods".$db_sufix." g
						LEFT JOIN goods_forms gf
						ON g.ID=gf.goodID WHERE g.ID IN (
						".$filter_selected_goods_str.")
						GROUP BY g.ID
						ORDER BY g.availability > 0 DESC, gf.price > 0 DESC, sort DESC, ".$sql_sort_order.", g.classID DESC, sort DESC, g.name
						LIMIT ".($limFirstPar).", ". $perPage;

} else {

	$query = "SELECT g.ID, g.link, g.classID, g.name, g.image, g.availability, min(NULLIF(gf.price, 0)) AS min_price, max(gf.price) AS max_price, g.act FROM goods".$db_sufix." g
						LEFT JOIN goods_forms gf
						ON g.ID=gf.goodID
						WHERE ".$subCat_sql."
						GROUP BY g.ID
						ORDER BY g.availability > 0 DESC, gf.price > 0 DESC, ".$sql_sort_order.", g.classID DESC, sort DESC, g.name
						LIMIT ".($limFirstPar).", " . $perPage;
}

//echo $query;
$db->query($query);

$zero_price = 0;
$not_available = 0;	
$prices = array();
$promo=array();
while($f=$db->fetch()){

	$colors[$f['ID']] = array();
	$prices[$f['ID']] = array();


	if (intval($f['min_price']) == 0 && intval($f['max_price']) == 0) {
		$zero_price = 1;
	}

	if ($f['act'] === "0" || $zero_price === 1) {
		$not_available = 1;
	}

	if ($is_bouquet) {
		$product_path = $lang_url . '/buket/' . $f['ID'] . '/';
	} else {
		$product_path = $lang_url . '/product/' . $f['ID'] . '_' . $f['link'] . '/';
	}
	$image_path = '/images/goods/s/'.$f['image'];

	$promo[] = array(
		'ID' => $f['ID'],
		'name' => $f['name'],
	//	'link' => $f['link'],
		'product_path' => $product_path,
		'image' => $image_path,
		'act' => $f['act'],
		'not_available' => $not_available,
		'colors' => $colors[$f['ID']]
	);

	$db->query("SELECT gfs.ID, gfs.dia, gfs.hgt, gfs.wdt, gfs.depth, gfs.price, gfs.old_price, gfs.color, gfs.visibility, gfs.measure_id, gfs.measure_qt, gmg.unit FROM goods_forms gfs LEFT JOIN goods_measures gmg ON gmg.ID=gfs.measure_id WHERE gfs.goodID='".$f['ID']."' AND gfs.visibility=1 AND gfs.price > 0 $sql_pot_group", 1);
	
	$is_action=0;
	
	while($ff=$db->fetch(1)) {

		if ($f['availability'] == 1 && intval($ff['price']) > 0) {
			$prices[$f['ID']][] = intval($ff['price']);
		}

		$form_measure = '';

			if ($ff['dia']) {
				$form_measure = $form_measure . '&#216; ' . $ff['dia'];
			}
			if ($ff['wdt']) {
				$form_measure = $form_measure . $ff['wdt'];
			}
			if ($ff['depth']) {
				$form_measure = $ff['depth'] ? $form_measure . ' x ' . $ff['depth'] : $form_measure . $ff['depth'];
			}
			if ($ff['hgt']) {
				$form_measure = $ff['dia'] ? $form_measure . ', ' . $txt_hgt[$db_sufix] . ' ' . $ff['hgt'] : $form_measure . ', ' . $txt_hgt[$db_sufix] . ' ' . $ff['hgt'];
			}
			if ($ff['measure_qt']) {

				if ($ff['dia'] || $ff['wdt'] || $$ff['hgt']) {
					$form_measure = $form_measure . ', ' . $ff['measure_qt'];
				} else {
					$form_measure = $form_measure . $ff['measure_qt'];
				}
			}
		
		$form_measure = $form_measure . ' ' .$ff['unit'];

		$promo[count($promo)-1]['forms'][] = array(
		//	'form_id' => $ff['ID'],
			'dia' => $ff['dia'],
			'hgt' => $ff['hgt'],
			'wdt' => $ff['wdt'],
			'depth' => $ff['depth'],
		//	'price' => $ff['price'],
			'form_measure' => $form_measure
		);

		if (!is_numeric($ff['color'])) {

			$db->query("SELECT DISTINCT gc.preview, gc.alias, gc.name_ru, gc.name_ua FROM goods_colors gc LEFT JOIN goods_forms gf ON gc.alias=gf.color WHERE gf.goodID='".$f['ID']."' AND gf.visibility=1 AND gf.price > 0 ", 2);

			while ($fc = $db->fetch(2)) {

				
				$colors[$f['ID']][] = array(
					'name' => $db_sufix== '' ? $fc['name_ru'] : $fc['name_ua'],
					'image' => $fc['preview'],
				);

			}

		}
		if($ff['old_price']>0) $is_action=1;
		$promo[count($promo)-1]['is_action']=$is_action;
	};

	if (count($prices[$f['ID']]) > 0) {

		$promo[count($promo)-1]['min_price'] = min(array_filter($prices[$f['ID']]));
		$promo[count($promo)-1]['max_price'] = max(array_filter($prices[$f['ID']]));
	
	}

	$promo[count($promo)-1]['colors'] = array_unique($colors[$f['ID']], SORT_REGULAR);

};
//print_r($promo);
echo json_encode($promo, JSON_UNESCAPED_UNICODE);


?>