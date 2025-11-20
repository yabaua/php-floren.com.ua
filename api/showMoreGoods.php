<?php
header("Content-type: application/json; charset=utf-8");

require($_SERVER['DOCUMENT_ROOT']."/database.php");
//require($_SERVER['DOCUMENT_ROOT']."/smarty/Smarty.class.php");
//require($_SERVER['DOCUMENT_ROOT']."/include/floren.class.php");

/* ==============. TEST DATA ============ */ 
$json_string=array(
  "curPage"	=>	3,
  "perPage"	=>	25, // optional
//  "lang"		=>	'',
//  "mCat"		=>	'komnatnie-rasteniya',
//  "cat"			=>	'ficus',
//  "filters"	=>	['lechuza', 'krugliy']
);
$dataString = json_encode($json_string, JSON_UNESCAPED_UNICODE);
$post_data=$dataString;
$REFERER = ('https://floren33:8890/ua/komnatnie-rasteniya/ficus/');
/* ==============. TEST DATA ============ */ 


/* ==========.  NOT TEST DATA	============*/
if(!isset($_SERVER['HTTP_REFERER'])){
	echo json_encode('invalid', JSON_UNESCAPED_UNICODE);
	exit();
}
$REFERER = $_SERVER['HTTP_REFERER'];
$post_data = file_get_contents('php://input');
/*==============. NOT TEST DATA ============*/ 

$URL = parse_url($REFERER);
$data = json_decode($post_data, true);

$lingvo['hgt'] = 

//$url_filters = $data['filters'];
$url_filters=array();
$perPage = $data['perPage'] ?? '25';
$curPage = $data['curPage']-1 ?? '0';

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
	$lingvo['hgt'] = 'Висота';
	$lang='ua';
} else {
	$lang_url = '';
	$db_sufix = '';
	$url_whiout_lang = $URL['path'];
	$lingvo['hgt'] = 'Высота';
	$lang='ru';
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
if (isset($data['curPage'])) $limFirstPar = ($data['curPage']-1) * $perPage;

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


	$main_query = "SELECT g.ID, g.link, g.classID, g.name, g.image, g.availability, g.preorder, min(NULLIF(gf.price, 0)) AS min_price, max(gf.price) AS max_price, min(gf.old_price) AS min_old_price, max(gf.old_price) AS max_old_price, g.act FROM goods".$db_sufix." g
						JOIN goods_forms gf
						ON g.ID=gf.goodID WHERE g.ID IN (
						".$filter_selected_goods_str.")
						WHERE gf.visibility=1
						GROUP BY g.ID
						ORDER BY g.availability > 0 DESC, gf.price > 0 DESC, sort DESC, ".$sql_sort_order.", g.classID DESC, sort DESC, g.name
						LIMIT ".($limFirstPar).", ". $perPage;

} else {

	$main_query = "SELECT g.ID, g.link, g.classID, g.name, g.image, g.availability, g.preorder, min(NULLIF(gf.price, 0)) AS min_price, max(gf.price) AS max_price, min(NULLIF(gf.old_price, 0)) AS min_old_price, max(gf.old_price) AS max_old_price, g.act
						FROM goods".$db_sufix." g
						JOIN goods_forms gf
						ON g.ID=gf.goodID
						WHERE ".$subCat_sql." AND gf.visibility=1
						GROUP BY g.ID
						ORDER BY g.availability > 0 DESC, gf.price > 0 DESC, ".$sql_sort_order.", g.classID DESC, sort DESC, g.name
						LIMIT ".($limFirstPar).", " . $perPage;
}

//echo $query;
include($_SERVER['DOCUMENT_ROOT'] . "/exec/goods_build_list.php");
//print_r($promo);
echo json_encode($promo, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


?>