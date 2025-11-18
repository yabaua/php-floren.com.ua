<?php
header("Content-type: application/json; charset=utf-8");
require($_SERVER['DOCUMENT_ROOT']."/database.php");
session_start();
global $_SESSION;
$goods_in_cart_error = 0;

/*
if(!isset($_SERVER['HTTP_REFERER'])){
	echo json_encode('invalid', JSON_UNESCAPED_UNICODE);
	exit();
}
*/
//$REFERER = $_SERVER['HTTP_REFERER'];
$REFERER = ('https://floren33:8890/ua/komnatnie-rasteniya/ficus/benjamina/'); // test string
$URL = parse_url($REFERER);
/*
$test_json_string=array(
	"5975" =>	1, "4196" => 2, 6504 => 1
);

$dataString = json_encode($test_json_string, JSON_UNESCAPED_UNICODE);
$post_data=$dataString;
*/
$post_data = file_get_contents('php://input');
$data = json_decode($post_data, true);
if(!isset($data)){
	echo json_encode('not valid', JSON_UNESCAPED_UNICODE);
	exit();
}

foreach($data AS $k=>$v) {
	$_SESSION['basket'][$k]=$v;
}
//print_r($data);
//exit();
	$img_path = '';
	$lingvo = array(
		'dia' 	=> array('ru'=>'Диаметр:', 'ua'=>'Діаметр:'),
		'wdt' 	=> array('ru'=>'Ширина:', 'ua'=>'Ширина:'),
		'hgt' 	=> array('ru'=>'Высота:', 'ua'=>'Висота:'),
		'depth' => array('ru'=>'Глубина:', 'ua'=>'Глибина:'),
		'color' => array('ru'=>'Цвет:', 'ua'=>'Колір:')
	);
	
if(substr($URL['path'], 1, 2) == 'ua') {
	$lang_url='/ua';
	$db_sufix='_ua';
	$lang='ua';
	$url_whiout_lang = substr($URL['path'], 3);
} else {
	$lang_url = '';
	$db_sufix = '';
	$lang='ru';
	$url_whiout_lang = $URL['path'];
}
	
	function send_empty_bsk(){
	
			$html_header = "MIME-Version: 1.0\r\n";
			$html_header .= "Content-type: text/html; charset=windows-1251\r\n";
			$html_header .= "From:  Флорен <info@floren.com.ua>\r\n";
			
			
		//	echo "cxx";
			ob_start();
			echo date("d/m/Y h:i:s").'<BR>';
			echo $_SERVER['REQUEST_URI'].'<BR>';
			echo '<FONT COLOR="#FF0000">'.mysql_error().'<BR>'.htmlspecialchars($sql).'</FONT><BR>';
			echo 'GET<PRE>';
			print_r($_GET);
			echo '</PRE>';
			echo 'POST<PRE>';
			print_r($_POST);
			echo '</PRE>';
			echo 'COOKIE<PRE>';
			print_r($_COOKIE);
			echo '</PRE>';
			echo 'SERVER<PRE>';
			print_r($_SERVER);
			echo '</PRE>';
			//phpinfo();
			$text=ob_get_contents();
			ob_end_clean();
			@mail('info@floren.com.ua', 'Ошибка при добавлении в корзину', $text, $html_header);
	}

	if (!isset($_SESSION['basket'])) $_SESSION['basket']=array(); // first basket item
	$q=implode("','",array_keys($_SESSION['basket']));
	
	$db->query("SELECT g.ID, g.image, g.name, g.name_alter, g.classID, gcl.motherID, g.link, g.makerID, gfs.ID AS formID, gfs.hgt, gfs.dia, gfs.wdt, gfs.depth, gfs.qt, gfs.color, gfs.price, gfs.measure_qt, gfs.img, gmg.alias AS mg_alias, gmg.unit AS mg_unit, gmg.name_ru AS mg_name_ru, gmg.name_ua AS mg_name_ua, gc.name_ru AS color_name, gc.name_ua AS color_name_ua
		FROM goods".$db_sufix." g
		LEFT JOIN goods_forms gfs ON g.ID=gfs.goodID
		LEFT JOIN goods".$db_sufix."_class gcl ON g.classID=gcl.ID
		LEFT JOIN goods_measures gmg ON gmg.ID=gfs.measure_id
		LEFT JOIN goods_colors gc ON gfs.color=gc.alias
		WHERE gfs.ID IN ('".$q."')");
	$od=array();
	while($f=$db->fetch()){
		$od[]=$f;
	}
	$kk=1;
	$body='';

	$counter=0;
	$cart_sum=0;
	foreach ($od AS $ov){
		$product_path = $lang_url."/product/".$ov['ID']."_".$ov['link']."/";
		$img_path 					= "/images/ins/s/";
		$name					=	$ov['name'];
	
		if ($ov['img'] && $ov['img'] != '0') {
			$img_path .= $ov['img'];
		} elseif ($ov['color'] && $ov['motherID'] !='3') {
			$img_path .= $ov['link'] . '_' . $ov['color'] . '.jpg';
		} else {
			$img_path .= $ov['image'];
		}
	
		if($ov['classID']=='49'){
			$link=$lang_url."/compositions/".$ov['link']."/";
			$img_path="/images/compositions/s/".$ov['image'];
			$name=$ov['name']." ".$ov['name_alter'];
		}
		if($ov['classID']=='74'){
			$link="#";
		}
	
		$formName_arr= array();
		if($ov['dia']){
			$formName_arr[] = '&#216;' . $ov['dia'] . 'см';
		}
		if($ov['wdt']){
			$formName_arr[] = $lingvo['wdt'][$lang] . ' ' . $ov['wdt'] . 'см';
		}
		if($ov['hgt']){
			$formName_arr[] = $lingvo['hgt'][$lang] . ' ' . $ov['hgt'] . 'см';
		}
		if($ov['depth']){
			$formName_arr[] = $lingvo['depth'][$lang] . ' ' . $ov['depth'] . 'см';
		}
		if($ov['measure_qt']){
			$formName_arr[] = $ov['mg_name_'.$lang] . ' ' . $ov['measure_qt'] . $ov['mg_unit'];
		}
		if($ov['color']){
			$formName_arr[] = $lingvo['color'][$lang] . ' ' . $ov['color_name_'.$lang] . 'см';
		}
		$formName=implode(", ", $formName_arr);
		
		$goods_in_cart[] = array(
			"formID"		=>	$ov['formID'],
			"name"			=>	$ov['name'],
			"formName"	=>	$formName ?? '',
			"price"			=>	$ov['price'],
			"cnt"				=>	$_SESSION['basket'][$ov['formID']],
			"goodSum"		=>	$ov['price']*$_SESSION['basket'][$ov['formID']],
		);
		$cart_sum+=	$ov['price']*$_SESSION['basket'][$ov['formID']];
		$counter++;
	}//foreach SESSION [basket]
		
		
		if($counter==0){
			send_empty_bsk();
			$goods_in_cart_error=1;
		}
		

	$cart = array(
	'cart_sum'		=>	$cart_sum,
	'cart_error'	=>	$goods_in_cart_error,
	'cart_items'	=>	$goods_in_cart
	);

echo json_encode($cart, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		
?>

	
