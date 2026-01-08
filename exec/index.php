<?php
include($_SERVER['DOCUMENT_ROOT'] ."/include/resize.php");
if	(
		$_SERVER["REQUEST_URI"]!='/' && $_SERVER["REQUEST_URI"]!='/ru/' && !(
			substr_count($_SERVER['QUERY_STRING'], 'gclid') || 
			substr_count($_SERVER['QUERY_STRING'], 'utm_') || 
			substr_count($_SERVER['QUERY_STRING'], 'yclid') || 
			substr_count($_SERVER['QUERY_STRING'], 'fbclid')	||
			substr_count($_SERVER['QUERY_STRING'], 'srsltid')
		)
	)
{
	//=============301===================
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("Location: /");
	exit();
	//=============301===================
} else

$db->query("SELECT * FROM tree25".$db_sufix." WHERE alias='index'");
$f=$db->fetch();
$smarty->assign("META_TITLE",$f['meta_title']);
$smarty->assign("META_DESCRIPTION",$f['meta_description']);
$smarty->assign("META_KEYWORDS",$f['meta_keywords']);
$smarty->assign("CONTENT",$f['content']);
$smarty->assign("CONTENT2",$f['content_2']);
$smarty->assign("CONTENT3",$f['content_3']);

$smarty->assign("CONTENT_TPL",'index.tpl');
$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.($_SERVER['REQUEST_URI']==='/' ? '/':'/ru/').'" />');


//3 promo
			$promo_g_list=array(21,71,80,43,468,144,336,56,546,115,17,101,324,560,145,94,442,559,11,322,442,426,135,76,328);
			$db->query("SELECT g.name, g.ID, g.link, g.image, min(gf.price) AS min_price, max(gf.price) AS max_price, min(gf.old_price) AS min_old_price, max(gf.old_price) AS max_old_price, AVG(gv.vote) AS stars
						FROM goods".$db_sufix." g
						JOIN goods_forms gf ON g.ID=gf.goodID
						JOIN goods_voting gv ON g.ID=gv.pageID
						WHERE g.ID IN ('".implode("','", $promo_g_list)."')
							AND g.availability>0
							AND gf.price!=0
						GROUP BY g.ID
						ORDER BY g.sort DESC LIMIT 18");
			while($rs_goods=$db->fetch()){
				$goods[$rs_goods['ID']]=$rs_goods;
				$goods[$rs_goods['ID']]['product_path']=$lang_url . '/product/' . $rs_goods['ID'] . '_' . $rs_goods['link'] . '/';
				if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/goods/s/' . str_replace('jpg', 'webp', $rs_goods['image']))){
						$goods[$rs_goods['ID']]['img_path']		 = '/images/goods/s/' . str_replace('jpg', 'webp', $rs_goods['image']);
				}else{
						$src= 'https://floren.com.ua/images/ins/b/gmcxml-' . $rs_goods['image'];
						$dest_s		=	$_SERVER['DOCUMENT_ROOT'] . '/images/goods/s/' .str_replace('jpg', 'webp', $rs_goods['image']);
						img_resize($src, $dest_s, 200, 200, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=false, $trim=false, $resize_max=false, $apply_mask=false);
						$goods[$rs_goods['ID']]['img_path']		 = '/images/goods/s/' . str_replace('jpg', 'webp', $rs_goods['image']);
				}
				//== price
				$price='';
				$price .= $rs_goods['min_price'];
				if ($rs_goods['min_price'] != $rs_goods['max_price'])
					$price .= ' – ' . $rs_goods['max_price'];
				$goods[$rs_goods['ID']]['price']=$price;
				//== / price
				if($rs_goods['min_old_price']>0 || $rs_goods['max_old_price']>0){
					$goods[$rs_goods['ID']]['is_action']=1;
				}
			}
$smarty->assign("PROMO_PLANTS",$goods);

//Articles
$pub_ind=array();
$db->query("SELECT * FROM publications ORDER BY date_add DESC LIMIT 2");
while($f=$db->fetch()) $pub_ind[]=$f;
$smarty->assign("PUBIND", $pub_ind);

$indx_clients=array();
$db->query("SELECT * FROM clients ORDER BY p_order DESC LIMIT 25");
while($f=$db->fetch()) $indx_clients[]=$f;
$smarty->assign("indxCLIENTS", $indx_clients);

$indx_lastPhotos=array();
$db->query("SELECT photo_name".$db_sufix." AS photo_name, photo_dsc".$db_sufix." AS photo_dsc, date_add, photo_url  FROM last_photos ORDER BY date_add DESC LIMIT 16");
while($f=$db->fetch()){
	$indx_lastPhotos[]=$f;
//	$indx_lastPhotos[count($indx_lastPhotos)-1]['photo_name']=$f['photo_name'.$db_sufix];
//	$indx_lastPhotos[count($indx_lastPhotos)-1]['photo_dsc']=$f['photo_dsc'.$db_sufix];
}
$smarty->assign("LASTPHOTOS", $indx_lastPhotos);
//======== GOOGLE REVIEWS
$indx_google_reviews=array();
$db->query("SELECT * FROM google_reviews ORDER BY ID DESC LIMIT 3");
while($f=$db->fetch()) $indx_google_reviews[]=$f;
$smarty->assign("GOOGLE_RATING", $indx_google_reviews);

$db->query("SELECT * FROM options_delivery WHERE option_alias='google_stars'");
$f=$db->fetch();
$smarty->assign("GOOGLESTARS", $f['option_value']);

//========END OF GOOGLE REVIEWS


$smarty->assign("SERVER_NAME",$_SERVER['SERVER_NAME']);
?>