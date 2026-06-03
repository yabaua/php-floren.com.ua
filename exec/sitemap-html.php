<?
$TITLE=array();
$hleb=array();
$hleb[0]['link']='/';
$hleb[0]['name']=$lingvo['main_page'];
$hleb[1]['link']='';
$hleb[1]['name']=$lingvo['sitemap'];


$sitemap=array();
$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID=0 AND act='1' ORDER BY sort DESC,name");
while ($f=$db->fetch()) {
	$sitemap[$f['ID']]['name']=$f['name'];
	$sitemap[$f['ID']]['alias']=$f['alias'];
	$sitemap[$f['ID']]['ID']=$f['ID'];
	$db->query("SELECT gc.name, gc.ID, gc.alias FROM goods".$db_sufix."_class gc WHERE motherID=".$f['ID']." AND act='1' ORDER BY sort DESC",1);
	while ($ff=$db->fetch(1)) {
		$sitemap[$f['ID']]['category'][]=$ff;
		$sitemap[$f['ID']]['category'][count($sitemap[$f['ID']]['category'])-1]['goods']=array();

		$old_aliases = array('lamela-old', 'elho-old', 'ceramic-old', 'beton-old');
		if (in_array($ff['alias'], $old_aliases)) {
			$tmp_arr = explode('-', $ff['alias']);
			$sitemap[$f['ID']]['category'][count($sitemap[$f['ID']]['category'])-1]['cur_alias'] = $tmp_arr[0];
		} else {

			if ($ff['alias'] == 'wood-planters-old') {
				$sitemap[$f['ID']]['category'][count($sitemap[$f['ID']]['category'])-1]['cur_alias'] = 'wood-planters';
			} else {
				$sitemap[$f['ID']]['category'][count($sitemap[$f['ID']]['category'])-1]['cur_alias'] = $ff['alias'];
			}
		}

		$db->query("SELECT g.ID, g.name, g.link, g.classID FROM goods".$db_sufix." g WHERE classID=".$ff['ID']." AND act='Y' ORDER BY sort DESC",2);
		while ($fff=$db->fetch(2)) {
			if($fff['classID']=='68' || $fff['classID']=='74'){
				continue;
			}
			$sitemap[$f['ID']]['category'][count($sitemap[$f['ID']]['category'])-1]['goods'][]=$fff;
		}
	}
}

$smarty->assign("SITEMAP",$sitemap);

//======services
$sservices=array();
$db->query("SELECT alias, title FROM services".$db_sufix." WHERE act='1'");
while($s=$db->fetch()){
	$sservices[]=$s;
};
$smarty->assign("S_SERVICES",$sservices);

//======landscape
$slandscape=array();
$db->query("SELECT category, alias, title FROM services_landscape".$db_sufix." WHERE act='1'");
while($sl=$db->fetch()){
	$slandscape[]=$sl;
};
$smarty->assign("S_LANDSCAPE",$slandscape);

//======gallery
$db->query("SELECT * FROM gallery_list".$db_sufix."");
while($f=$db->fetch()) {
	$sgallery[]=$f;
};
$smarty->assign("S_GALLERY",$sgallery);

//======publications
$db->query("SELECT * FROM publications".$db_sufix."");
while($f=$db->fetch()) {
	$spublications[]=$f;
};
$smarty->assign("S_PUBLICATIONS",$spublications);


$db->query("SELECT * FROM tree".$db_sufix." WHERE alias='sitemap'");
$s=$db->fetch();
$smarty->assign("PAGE_TITLE",$lingvo['sitemap']);
$TITLE[0]=$s['meta_title'];
$smarty->assign("META_DESCRIPTION",$s['meta_description']);
$smarty->assign("META_KEYWORDS",$s['meta_keywords']);
			
			
$smarty->assign("CONTENT_TPL",'sitemap-html.tpl');
$smarty->assign("HLEB",$hleb);
