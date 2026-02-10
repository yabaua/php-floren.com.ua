<?php
$TITLE=array();
// $pub_lim_num=3-count($pub_links);
if(isset($PARAM[0])){
	$db->query("SELECT * FROM publications".$db_sufix." WHERE alias='".$PARAM[0]."'");
	if(!$db->num_rows() || isset($PARAM[1])){
		//=============404===================
		header('HTTP/1.0 404 Not Found', true, '404');
		include($_SERVER['DOCUMENT_ROOT']."/404.php");
		exit();
		//=============404===================
	}
	
	
	
	
	$article=$db->fetch();
	$smarty->assign("ARTICLE",$article);
	$pubImgSize=array();
	$pubImgSize= empty($article['images']) ? '' : getimagesize($article['images']);
	$smarty->assign("ARTICLE_IMAGE",$pubImgSize);
	
	$db->query("UPDATE publications".$db_sufix." SET pub_views=pub_views+1 WHERE ID='".$article['ID']."'");
	
	$hleb=array();
	$hleb[0]['link']='/';
	$hleb[0]['name']=$lingvo['main_page'];
	$hleb[1]['link']='/publications/';
	$hleb[1]['name']=$lingvo['menu_publications'];
	$hleb[2]['link']='';
	$hleb[2]['name']=$article['title'];
	
	if($article['meta_title']!='') $TITLE[0]=$article['meta_title'];
	else $TITLE[1]=$article['title'];
	
	$smarty->assign("META_DESCRIPTION",$article['meta_description']);
	$smarty->assign("META_KEYWORDS",$article['meta_keywords']);
	
	$smarty->assign("LEFT_TPL",'left_col.tpl');
	$smarty->assign("CONTENT_TPL",'publications.tpl');
	$smarty->assign("SOC_TTL",rawurlencode($article['title']));
	$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/publications/'.$article['alias'].'/" />');
	
	
//=======COMMON–PUBLICATIONS==============================

$category_list=array();
$db->query("SELECT pc.ID AS catID FROM publications_category pc JOIN publications_pub2cat p2c ON pc.ID=p2c.catID WHERE p2c.pubID='".$article['ID']."'");
while($rs=$db->fetch()) $category_list[]=$rs['catID'];
$category_list_sql=implode("','", $category_list);

	$pub_links=array();
	$db->query("SELECT DISTINCT p.ID,  p.* FROM publications".$db_sufix." p JOIN publications_pub2cat p2c ON p.ID=p2c.pubID WHERE p.ID>".$article['ID']." AND p2c.catID IN ('".$category_list_sql."') LIMIT 3");
	if(!$db->num_rows()){
		$db->query("SELECT DISTINCT p.ID,  p.* FROM publications".$db_sufix." p JOIN publications_pub2cat p2c ON p.ID=p2c.pubID WHERE p2c.catID IN ('".$category_list_sql."') ORDER BY ID LIMIT 3");

	}
		while($gb=$db->fetch()){
			$pub_links[]=$gb;
		}
	// ???? ?? ??????? 3 ???????
	if(count($pub_links)!=3){
		$pub_lim_num=3-count($pub_links);
		$db->query("SELECT DISTINCT p.ID,  p.* FROM publications".$db_sufix." p JOIN publications_pub2cat p2c ON p.ID=p2c.pubID WHERE p2c.catID IN ('".$category_list_sql."') ORDER BY ID LIMIT ".$pub_lim_num);
		while($pub_links_plus=$db->fetch()){
			$pub_links[]=$pub_links_plus;
		}
	}
	$smarty->assign("PUB_LINKS",$pub_links);
	
	
//=======COMMON–GOODS==============================	
	if($article['goodsID']!=''){
		$db->query("SELECT g.*, min(gf.price) AS min_price, max(gf.price) AS max_price FROM goods g
					LEFT JOIN goods_forms gf
					ON g.ID=gf.goodID
					WHERE g.ID IN (".$article['goodsID'].") AND gf.price!=0
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
	}
	
	
	
	
	
	
}
//======IF 1 ARTICLE
else{//ARTICLE LIST
	
	$publications_ttl="Блог";
	$publications_category="";
	$publications_category_SQL='';
	if(isset($_REQUEST['cat'])){
		$publications_category=$_REQUEST['cat'];
		$db->query("SELECT * FROM publications_category WHERE alias='".$publications_category."'");
		if(!$db->num_rows()){
			//=============404===================
			header('HTTP/1.0 404 Not Found', true, '404');
			include($_SERVER['DOCUMENT_ROOT']."/404.php");
			exit();
			//=============404===================
		}
		$f=$db->fetch();
		$smarty->assign("META_NOFOLLOW", '<meta name="robots" content="noindex, nofollow" />');
		$publications_ttl=$f['name'.$db_sufix];
		$publications_category_SQL="JOIN publications_pub2cat p2c ON p.ID=p2c.pubID JOIN publications_category pc ON p2c.catID=pc.ID AND pc.alias='".$publications_category."'";
	//	$_SESSION
	}
	$art_list=array();
	$db->query("SELECT p.* FROM publications".$db_sufix." p ".$publications_category_SQL." ORDER BY date_add DESC");

	while($f=$db->fetch()){
		$art_list[]=$f;
		if(!empty($f['images']))	$art_list[count($art_list)-1]['main_image'] = $f['images'];
		else 											$art_list[count($art_list)-1]['main_image'] = '/img/no-image.jpg';
	}
	$smarty->assign("ART_LIST",$art_list);
	$smarty->assign("PUBLICATIONS_TTL",$publications_ttl);
	
	
	$db->query("SELECT p.ID, pc.name".$db_sufix." AS cat_name, pc.alias AS cat_alias FROM publications".$db_sufix." p LEFT JOIN publications_pub2cat p2c ON p.ID=p2c.pubID JOIN publications_category pc ON p2c.catID=pc.ID");
	while($f=$db->fetch()){
		$art_list2cat[$f['ID']][]=array('cat_alias'=>$f['cat_alias'], 'cat_name'=>$f['cat_name']);
	}
	$smarty->assign("ART_LIST2CAT",$art_list2cat);
	
	
	$hleb=array();
	$hleb[0]['link']='/';
	$hleb[0]['name']=$lingvo['main_page'];
	$hleb[1]['link']='';
	$hleb[1]['name']=$lingvo['menu_publications'];
	if(isset($_REQUEST['cat'])){
		$hleb[1]['link']='/publications/';
		$hleb[1]['name']=$lingvo['menu_publications'];
		$hleb[2]['link']='';
		$hleb[2]['name']=$publications_ttl;
	}
	
	
	//===META===
	$db->query("SELECT * FROM tree25".$db_sufix." WHERE alias='publications'");
	$f=$db->fetch();
	$TITLE[0]=$f['meta_title'];
	$smarty->assign("META_DESCRIPTION", $f['meta_description']);
	$smarty->assign("META_KEYWORDS", $f['meta_keywords']);
	
	$smarty->assign("LEFT_TPL",'left_col.tpl');
	$smarty->assign("CONTENT_TPL",'publications_list.tpl');
	$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/publications/" />');
}

//=========LEFT_COL============
		
		$db->query("SELECT alias, name".$db_sufix." AS name FROM publications_category ORDER BY p_order DESC");
		while($pcl=$db->fetch()){
			$publications_category_left[]=$pcl;
			if($pcl['alias']==$publications_category)
				$publications_category_left[count($publications_category_left)-1]['act']='1';
		}
		$smarty->assign("PUB_CATEGORIES", $publications_category_left);

//=========LEFT_COL============
$smarty->assign("CUR_CAT", "publications");
$smarty->assign("HLEB",$hleb);
?>