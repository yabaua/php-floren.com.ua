<?

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
	//=============404===================
	header('HTTP/1.1 404 Not Found', true, '404');
	include($_SERVER['DOCUMENT_ROOT']."/404.php");
	exit();
	//=============404===================
} else

$db->query("SELECT * FROM tree".$db_sufix." WHERE alias='index'");
$f=$db->fetch();
$smarty->assign("META_TITLE",$f['meta_title']);
$smarty->assign("META_DESCRIPTION",$f['meta_description']);
$smarty->assign("META_KEYWORDS",$f['meta_keywords']);
$smarty->assign("CONTENT",$f['content']);
$smarty->assign("CONTENT2",$f['content_2']);
$smarty->assign("CONTENT3",$f['content_3']);

$smarty->assign("LEFT_TPL",'left_col.tpl');
$smarty->assign("CONTENT_TPL",'index.tpl');
$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.($_SERVER['REQUEST_URI']==='/' ? '/':'/ru/').'" />');


//3 promo
			$promo_g_list=array(21,71,80,43,468,144,336,56,546,115,17,101,324,560,145,94,442,559,11,322,442,426,135,76,328);
			$db->query("SELECT g.*, min(gf.price) AS min_price, max(gf.price) AS max_price FROM goods g
						LEFT JOIN goods_forms gf
						ON g.ID=gf.goodID
						WHERE g.ID IN ('".implode("','", $promo_g_list)."')
						GROUP BY g.ID
						ORDER BY g.sort DESC LIMIT 18");
			
			while($rs_goods=$db->fetch()){
				$goods[$rs_goods['ID']]=$rs_goods;
				
				$db->query("SELECT * FROM goods_forms WHERE goodID='".$rs_goods['ID']."' ORDER BY price=0, price DESC", 1);
				$goods[$rs_goods['ID']]['forms']=array();
				while ($rs_goods_forms=$db->fetch(1)){
					$goods[$rs_goods['ID']]['forms'][]=$rs_goods_forms;
					if($rs_goods_forms['old_price']>0){
						$goods[$rs_goods['ID']]['is_action']=1;
					}
				}
				if(count($goods[$rs_goods['ID']]['forms'])>1) $goods[$rs_goods['ID']]['show_qt']=1;
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

$smarty->assign("SERVER_NAME",$_SERVER['SERVER_NAME']);
?>