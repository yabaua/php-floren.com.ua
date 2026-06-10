<?php
$TITLE=array(0=>'Флорен');
$hleb=array();
$hleb[0]['link']='/';
$hleb[0]['name']='Озеленення та фітодизайн';
$hleb[1]['link']='';
$hleb[1]['name']='Прайс-лист';
//Надо переделать


$cur_cat=0;
$price=array();
$db->query("SELECT gc.name AS catName, gc.ID AS catID, gc.motherID AS mCat, gc.alias, g.ID, g.name, g.link
			FROM goods".$db_sufix." g
			JOIN goods".$db_sufix."_class gc ON g.classID=gc.ID
			WHERE gc.act='1'
			ORDER BY g.classID");
$price['ei']=array();
while($f=$db->fetch()){
	if($f['catID']!=$cur_cat){
		$price['ei'][$f['catID']]['mCat']=$f['mCat'];
		$price['ei'][$f['catID']]['alias']=$f['alias'];
		$price['ei'][$f['catID']]['ID']=$f['catID'];
		$price['ei'][$f['catID']]['name']=$f['catName'];
		if($f['mCat']=='3') $price['ei'][$f['catID']]['mCatAlias']='komnatnie-rasteniya';
		if($f['mCat']=='5') $price['ei'][$f['catID']]['mCatAlias']='planters';
		$price['ei'][$f['catID']]['goods']=array();
		
	}
	$price['ei'][$f['catID']]['goods'][]=$f;
	$cur_cat=$f['catID'];
}
$smarty->assign("PRICE",$price);

$db->query("SELECT * FROM tree25".$db_sufix." WHERE alias = 'pricelist'");
$rs=$db->fetch();
$smarty->assign("PAGE_TITLE",$rs['meta_title']);
$TITLE[1]=$rs['meta_title'];
$smarty->assign("META_DESCRIPTION",$rs['meta_description']);
$smarty->assign("META_KEYWORDS",$rs['meta_keywords']);
$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/pricelist/" />');		
			
$smarty->assign("CONTENT_TPL",'pricelist.tpl');
$smarty->assign("HLEB",$hleb);
?>