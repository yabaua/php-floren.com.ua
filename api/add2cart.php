<?php
session_start();
header("Content-type: application/json; charset=utf-8");
require($_SERVER['DOCUMENT_ROOT']."/database.php");
$goods_in_cart_error = 0;


$REFERER = $_SERVER['HTTP_REFERER'];
$URL = parse_url($REFERER);
$post_data = file_get_contents('php://input');
if(!isset($_SERVER['HTTP_REFERER'])){
	echo json_encode('invalid', JSON_UNESCAPED_UNICODE);
	exit();
}
$data = json_decode($post_data, true);
if(!isset($data)){
	echo json_encode('not valid', JSON_UNESCAPED_UNICODE);
	exit();
}

	$img_path = '';
	$lingvo = array(
		'dia' 	=> array('ru'=>'Диаметр:', 'ua'=>'Діаметр:'),
		'wdt' 	=> array('ru'=>'Ширина:', 'ua'=>'Ширина:'),
		'hgt' 	=> array('ru'=>'Высота:', 'ua'=>'Висота:'),
		'depth' => array('ru'=>'Глубина:', 'ua'=>'Глибина:'),
		'color' => array('ru'=>'Цвет:', 'ua'=>'Колір:')
	);
	
if(substr($URL['path'], 1, 2) == 'ua' || $URL['path']==='/') {
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
//	echo $URL['path'];
	function send_empty_bsk(){
			global $db;
	
			$html_header = "MIME-Version: 1.0\r\n";
			$html_header .= "Content-type: text/html; charset=windows-1251\r\n";
			$html_header .= "From:  Флорен <info@floren.com.ua>\r\n";
			
			
		//	echo "cxx";
			ob_start();
			echo date("d/m/Y h:i:s").'<BR>';
			echo $_SERVER['REQUEST_URI'].'<BR>';
			echo '<FONT COLOR="#FF0000">'.$db->error().'<BR>'.htmlspecialchars($sql).'</FONT><BR>';
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

//	print_r($data);
//	exit();
	$_SESSION['basket'] = array(); // Обнуляэмо корзину перед запитом
//print_r($_SESSION['basket']);
	foreach($data AS $k=>$v) {
		foreach($v AS $kk=>$vv ){
			
			if ($vv == 0) {
            unset($_SESSION['basket'][$kk]);
        } else {
            $_SESSION['basket'][$kk] = $vv ?: 1;
        }
		}
	}
	ksort($_SESSION['basket']); // THIS SHIT BECAUSE AFTER RENDERING CART ITEMS ARE JUMPING

	$q=implode("','",array_keys($_SESSION['basket']));
	
	$query = "SELECT g.ID, g.image AS main_img, gf.img AS formImg, g.name, g.name_alter, g.classID, gcl.motherID, g.link, g.makerID, gf.ID AS formID, gf.hgt, gf.dia, gf.wdt, gf.depth, gf.qt, gf.color, gf.price, gf.measure_qt, gmg.alias AS mg_alias, gmg.unit AS mg_unit, gmg.name_ru AS mg_name_ru, gmg.name_ua AS mg_name_ua, gc.name_ru AS color_name_ru, gc.name_ua AS color_name_ua
		FROM goods".$db_sufix." g
		LEFT JOIN goods_forms gf ON g.ID=gf.goodID
		LEFT JOIN goods".$db_sufix."_class gcl ON g.classID=gcl.ID
		LEFT JOIN goods_measures gmg ON gmg.ID=gf.measure_id
		LEFT JOIN goods_colors gc ON gf.color=gc.alias
		WHERE gf.ID IN ('".$q."')";
	
	
//	echo $query;
	$db->query($query);
	$od=array();
	while($f=$db->fetch()){
		$od[]=$f;
	}
	$kk=1;
	$body='';

	$counter=0;
	$cart_sum=0;
	$goods_in_cart=array();
	foreach ($od AS $ov){
		$product_path = $lang_url."/product/".$ov['ID']."_".$ov['link']."/";
		$img_path 					= "https://floren.com.ua/images/ins/s/";
		$name					=	$ov['name'];
	
		if ($ov['formImg'] && $ov['formImg'] != '0') {
			$img_path .= $ov['formImg'];
		} elseif ($ov['color'] && $ov['motherID'] !='3') {
			$img_path .= $ov['link'] . '_' . $ov['color'] . '.jpg';
		} else {
			$img_path .= $ov['main_img'];
		}
	
		if($ov['classID']=='49'){
			$link=$lang_url."/compositions/".$ov['link']."/";
			$img_path="/images/compositions/s/".$ov['main_img'];
			$name=$ov['name']." ".$ov['name_alter'];
		}
		if($ov['classID']=='74'){
			$link="#";
		}
	
		$goodLegend_arr= array();
		if($ov['dia']){
			$goodLegend_arr[] = '&#216;' . $ov['dia'] . 'см';
		}
		if($ov['wdt']){
			$goodLegend_arr[] = $lingvo['wdt'][$lang] . ' ' . $ov['wdt'] . 'см';
		}
		if($ov['hgt']){
			$goodLegend_arr[] = $lingvo['hgt'][$lang] . ' ' . $ov['hgt'] . 'см';
		}
		if($ov['depth']){
			$goodLegend_arr[] = $lingvo['depth'][$lang] . ' ' . $ov['depth'] . 'см';
		}
		if($ov['measure_qt']){
			$goodLegend_arr[] = $ov['mg_name_'.$lang] . ' ' . $ov['measure_qt'] . $ov['mg_unit'];
		}
		if($ov['color']){
			$goodLegend_arr[] = $ov['color_name_'.$lang];
		}
		$goodLegend=implode(", ", $goodLegend_arr);
		
		$goods_in_cart[] = array(
			"formID"				=>	$ov['formID'],
			"name"					=>	$ov['name'],
			"product_path"	=>	$product_path,
			"img_path"			=>	$img_path,
			"formName"			=>	$goodLegend ?? '',
			"price"					=>	$ov['price'],
			"cnt"						=>	$_SESSION['basket'][$ov['formID']],
			"goodSum"				=>	$ov['price']*$_SESSION['basket'][$ov['formID']],
		);
		$cart_sum+=	$ov['price']*$_SESSION['basket'][$ov['formID']];
		$counter++;
	}//foreach SESSION [basket]
		
		
		if($counter==!count($_SESSION['basket'])){
			send_empty_bsk();
			$goods_in_cart_error=1;
		}
		

	$cart = array(
	'basket_sum'		=>	$cart_sum,
	'basket_error'	=>	$goods_in_cart_error,
	'basket_count'	=>	count($goods_in_cart),
	'basket_items'	=>	$goods_in_cart
	);

echo json_encode($cart, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		
?>

	
