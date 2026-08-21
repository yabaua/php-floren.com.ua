<?php
error_reporting(E_ALL);
if(isset($_REQUEST['tnx'])){
	$smarty->assign("ORDERED",true);
}
if(isset($_REQUEST['error']))
	$smarty->assign("ERROR",true);

if(isset($URL[1]) && $URL[1]!=''){
		//=============404===================
		header('HTTP/1.0 404 Not Found', true, '404');
		include($_SERVER['DOCUMENT_ROOT']."/404.php");
		exit();
		//=============404===================
}
$smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, nofollow">');
$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/basket/" />');

$send_text='<table>';
$bsk_idds_send=implode("','", array_keys($_SESSION['basket']));
$google_ga4_script='';


if($_SESSION['basket']){
	$google_ga4_script='
			dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
			dataLayer.push({
			event: "begin_checkout",
				ecommerce: {
					items: [';
}
      


$db->query("SELECT g.ID, g.link, g.name, gc.motherID, gfs.ID as formID, gfs.hgt, gfs.dia, gfs.wdt, gfs.depth, gfs.img, gfs.color, gfs.price
		FROM goods".$db_sufix." g
		JOIN goods_forms gfs ON g.ID=gfs.goodID
		JOIN goods_class gc ON g.classID=gc.ID
		WHERE gfs.ID IN ('".$bsk_idds_send."')");

$ga4_item_cat_arr = array(3=>'komnatnieRasteniya', 5=>'gorshki');
$btotal=0;
while($rs=$db->fetch()) {
	if(	array_key_exists($rs['motherID'], $ga4_item_cat_arr))
		$ga4_item_cat=$ga4_item_cat_arr[$rs['motherID']];
	else 
		$ga4_item_cat='prochee';

	$send_text.='<tr><td>'.$rs['name'].' '.$rs['hgt'].'х'.$rs['hgt'].'</td><td>'.$rs['price'].'</td></tr>';
	$btotal+=$floren->MakePrice($rs['price']*$_SESSION['basket'][$rs['formID']]);
	$google_ga4_script_arr[]='{
				item_name: "'.$rs['name'].' '.($rs['dia']?$rs['dia'].'/':'').($rs['wdt']?$rs['wdt'].'/':'').$rs['hgt'].($rs['color']?' '.$rs['color']:'').'", // Name or ID is required.
				item_id: "'.$rs['formID'].'",
   				price: "'.$rs['price'].'",
				item_brand: "Флорен",
				item_category: "'.$ga4_item_cat.'",
				item_variant: "'.$rs['color'].'",
				quantity: "'.$_SESSION['basket'][$rs['formID']].'"
      }';
	
}
if($_SESSION['basket']){
	$google_ga4_script.=implode(",", $google_ga4_script_arr);
	$google_ga4_script.='],
		currency: "UAH",
  		value: "'.$btotal.'"
	    }
	  });
	';
	
	$smarty->assign("GA4_SCRIPT",$google_ga4_script);
}
$send_text.='</table>';
$send_text.='<br><hr><br><br>';

$sessID = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$clientIP = isset($_SESSION['IP']) && $_SESSION['IP'] != ''
	? $_SESSION['IP']
	: (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');

$db->query("INSERT INTO orders_basket SET
						sessID='".$sessID."',
						clientIP='".$clientIP."',
						formIDs='".implode(",", array_keys($_SESSION['basket']))."',
						lang='".$lang."',
						date_add=UNIX_TIMESTAMP(),
						basket='".base64_encode(str_replace("'", "`", serialize($_SESSION['basket'])))."',
						spiders='".$spiders."'");

// COMMON BASKET goods
$goods_WHERE=array(4536,3383,2435,3390,3385,6259,6258,4871,3393,6171,4613);
$db->query("SELECT
			g.*, gfs.ID AS gfID, gfs.dia, gfs.hgt, gfs.wdt, gfs.depth, gfs.price, gfs.old_price, gfs.color, gfs.visibility, gfs.measure_qt, gmg.unit, gmg.name_ru AS mg_name_ru, gmg.name_ua AS mg_name_ua			
			FROM goods".$db_sufix." g
			JOIN goods_forms gfs ON g.ID=gfs.goodID
			LEFT JOIN goods_measures gmg ON gmg.ID=gfs.measure_id
			WHERE gfs.ID IN ('".implode("','",$goods_WHERE)."')");
		
		while($rs_goods = $db->fetch()) {			
				$product_path = $lang_url . '/product/' . $rs_goods['ID'] . '_' . $rs_goods['link'] . '/';
				$img_path = '/images/ins/s/' . $rs_goods['image'];

				if ($rs_goods['availability'] == 0) {
					$not_available = 1;
				} else {
					$not_available = 0;
				}

				$colors[$rs_goods['ID']] = array();

				$promo[] = array(
					'ID' => $rs_goods['ID'],
					'name' => $rs_goods['name'],
					'link' => $rs_goods['link'],
					'product_path' => $product_path,
					'img_path' => $img_path,
					'image' => $rs_goods['image'],
					'act' => $rs_goods['act'],
					'not_available' => $not_available,
					'preorder' => $rs_goods['preorder'],
					'colors' => $colors[$rs_goods['ID']],
						
						'form_id' => $rs_goods['gfID'],
						'dia' => $rs_goods['dia'],
						'hgt' => $rs_goods['hgt'],
						'wdt' => $rs_goods['wdt'],
						'depth' => $rs_goods['depth'],
						'price' => $rs_goods['price'],
						'measure_qt' => $rs_goods['measure_qt'],
						'unit' => $rs_goods['unit'],
						'mg_name_ru' => $rs_goods['mg_name_ru'],
						'mg_name_ua' => $rs_goods['mg_name_ua']
				);
		}
		
		$smarty->assign("PROMO", $promo);

//$floren->send_email('Dmitriy.Zhinzhikov@gmail.com','Корзина',$send_text);
$smarty->assign("PAGE_TITLE",'Ваша корзина');
$smarty->assign("CONTENT_TPL",'basket.tpl');

?>
