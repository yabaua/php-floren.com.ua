<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/exec/good_comment.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/include/resize.php");
$TITLE=array();
//=========hleb

$hleb=array();
$hleb[0]['link'] = '/';
$hleb[0]['name'] = $lingvo['main_page'];

//=========hleb

$product_path = '';
$img_path = '';

$is_plant = 0;
$is_pot = 0;
$is_bouquet = 0;
$is_aksessuary = 0;
$max_pages_links = 25;

if($URL[0]=='komnatnie-rasteniya') {
	$categoryID = '3';
	$curAlias = "komnatnie-rasteniya";
	$is_plant = 1;
	$smarty->assign("ALIAS",$curAlias);
	$hleb[1]['link']='/komnatnie-rasteniya/';
	$hleb[1]['name']=$lingvo['plants'];
}
if($URL[0]=='planters') {
	$categoryID = '5';
	$curAlias = "planters";
	$is_pot = 1;
	$smarty->assign("ALIAS",$curAlias);
	$hleb[1]['link']='/planters/';
	$hleb[1]['name']=$lingvo['planters_kashpo'];
}
if($URL[0]=='florist') {

	$categoryID = '77';
	$dept = "florist";
	$smarty->assign("DEPT", $dept);
	$curAlias = "florist";
	$is_bouquet = 1;
	$smarty->assign("ALIAS",$curAlias);
	$hleb[1]['link']='/florist/';
	$hleb[1]['name']=$lingvo['dostavka_cvetov'];
}

if(isset($URL[1]) && $URL[1]=='sezon') {

	$categoryID = '80';
	$dept = "sezon";
	$smarty->assign("DEPT", $dept);
	$curAlias = "sezon";
	$is_bouquet = 1;
	$smarty->assign("ALIAS", "florist/sezon");
}

if($URL[0]=='aksessuary') {
	$dept = "aksessuary";
	$smarty->assign("DEPT", $dept);
	$categoryID = '82';
	$curAlias = "aksessuary";
	$is_aksessuary = 1;
	$smarty->assign("ALIAS", "aksessuary");
	$hleb[1]['link']='/aksessuary/';
	$hleb[1]['name']=$lingvo['accessory'];
}
if($URL[0]=='iskusstvennie-cvety') {
	$dept = "iskusstvennie-cvety";
	$smarty->assign("DEPT", $dept);
	$categoryID = '99';
	$curAlias = "iskusstvennie-cvety";
	$is_plant = 1;
	$smarty->assign("ALIAS", $curAlias);
	$hleb[1]['link']='/iskusstvennie-cvety/';
	$hleb[1]['name']=$lingvo['iskusstvennie_cvety'];
														
}
$error_404 = false;

$sort_array = array('cheap' => 'gf.price ASC', 'expensive' => 'gf.price DESC');

if (isset($URL[1]) && substr($URL[1], 0, 4)!='page') {
	$sql_sort_order = "g.act='0', g.preorder=0, g.availability > 0 DESC, g.sort DESC";
} else {
	$sql_sort_order = "g.act='0', g.preorder=0, g.availability > 0 DESC, g.global_sort DESC";
}

$show_comments = 1;

if ($URL[0] == 'komnatnie-rasteniya' && (!isset($URL[1]) || !$URL[1] || substr($URL[1], 0, 4)=='page')) {
	$show_comments = 0;
}

$smarty->assign("SHOW_COMMENTS", $show_comments);


if(isset($_REQUEST['sort'])){
	if(!array_key_exists($_REQUEST['sort'], $sort_array)){
		$error_404=true;
	}
	$sql_sort_order=$sort_array[$_REQUEST['sort']];
	$smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, nofollow">');
}

$category_aliases = array();

if (isset($URL[1]) && $URL[1] == 'sezon') { 
	$db->query("SELECT * FROM goods".$db_sufix."_class WHERE ID='".$categoryID."'");	
} else {
	$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID='".$categoryID."'");
}

while($f = $db->fetch()) {
	$category_aliases[] = $f['alias'];
	$category_ids[] = $f['ID'];
}
//	=======================================================
//	===========		Lets merge plants.php and goods.php
//	=======================================================

if ((isset($URL[1]) && in_array($URL[1], $category_aliases))) {

	if (isset($dept) && $dept == "florist"){
		include($_SERVER['DOCUMENT_ROOT'].'/exec/category/bouquets.php');
	} else {
		include($_SERVER['DOCUMENT_ROOT'].'/exec/goods.php');	
	}

} else {

	$cur_page = '1';
	
	if(isset($URL[1]) && substr($URL[1], 0, 4)=='page') $cur_page = substr($URL[1], 4);
	if(isset($URL[2]) && substr($URL[2], 0, 4)=='page') $cur_page = substr($URL[2], 4);

	
	if (
		(isset($URL[1]) && $URL[1]=='page1')	
		||
		(isset($URL[2]) && $URL[2]=='page1')	
		||
		(isset($URL[2]) && substr($URL[2], 0, 4)!='page')
		) {
			$error_404=true;
		}

	$smarty->assign("CATEGORY_ID",$categoryID);	
		
	//======FILTERS

	$filters = array();
	$filters_url = array();
	$tmp_filters_url = array();
	$filter_selected_goods = array();
	$filter_selected_groups = array();
	$filter_selected_goods_SQL = '';
	$show_more_IDDs = '';
		
		//====		1 or MORE FILTER SELECTED

		if (isset($URL[1]) && substr($URL[1], 0, 4) != 'page') {

			$filters_url = explode('-', $URL[1]);

			//===== 404
			$cnt_filters=array();
			$tmp_filter_groups=array();
			$db->query("SELECT * FROM goods_filters WHERE alias IN ('".implode("','", $filters_url)."') AND classID='".$categoryID."'");
			// if filters in URL more than in DB
			while ($rs=$db->fetch()){
				$cnt_filters[]=$rs;
				$tmp_filter_groups[]=$rs['groupID'];
			}
			//if chosed manualy in url more than one filter from group
			$stop_flag=false;
			foreach(array_count_values($tmp_filter_groups) AS $v){
				if($v>1) $stop_flag=true;
			}
			if (		count($cnt_filters)!= count($filters_url)	 || 		$URL[1] == ''	|| $stop_flag) {
				header('HTTP/1.0 404 Not Found', true, '404');
				include($_SERVER['DOCUMENT_ROOT']."/404.php");
				exit();
			}

		//====

		$filter_selected_goods = array();
		$filter_selected_groups = array();
		$filter_selected_names = array();
	
			foreach ($filters_url AS $path){

				$db->query("SELECT g.ID AS gID, gf.groupID, gf.name".$db_sufix." AS name
							FROM goods g
							JOIN goods_f2g f2g ON f2g.gID=g.ID
							JOIN goods_filters gf ON f2g.fID=gf.ID
							WHERE gf.alias='".$path."'
							GROUP BY g.ID");
						
				while ($rs = $db->fetch()) {

					$tmp_filter_selected_goods[] = $rs['gID'];
					$filter_selected_groups[] = $rs['groupID'];
					$filter_selected_names[] = $rs['name'];

				}

			}

			if (is_array($tmp_filter_selected_goods)) {

				$cnt_filter_selected_goods = array_count_values($tmp_filter_selected_goods);

				foreach($cnt_filter_selected_goods AS $fid => $cnt) {

					if ($cnt == count(array_unique($filter_selected_groups))) {
						$filter_selected_goods[] = $fid;
					}
			}
		}

			$filter_selected_goods_SQL = " AND g.ID IN ('".implode("','", $filter_selected_goods)."')";

			$show_more_IDDs = implode(",", $filter_selected_goods);
			$smarty->assign("SHOW_MORE_IDDS", $show_more_IDDs);
			$smarty->assign("FILTERS_URL", "/".implode("-", $filters_url));

		}
		
		//BUILD FILTERS
		$active_filters_flag=0;
		$db->query("SELECT gfg.ID AS gfgID, gfg.name".$db_sufix." AS gfgName FROM goods_filter_groups gfg WHERE gfg.classID='".$categoryID."' ORDER BY gfg.sort DESC");
	
		while($ff = $db->fetch()) {

			$filters[$ff['gfgID']]['groupName']	= $ff['gfgName'];
			$filters[$ff['gfgID']]['sub_filters'] = array();
			$db->query("SELECT gf.ID AS gfID, gf.alias AS alias, gf.name".$db_sufix." AS gfName,  count(DISTINCT g.ID) AS cnt, gf.groupID
								FROM goods_filters gf
								LEFT JOIN goods_f2g f2g ON gf.ID=f2g.fID
								LEFT JOIN goods g ON g.ID=f2g.gID
								WHERE gf.classID='".$categoryID."'
								AND gf.groupID='".$ff['gfgID']."'
								GROUP BY gf.ID	
								ORDER BY gf.sort DESC", 1);

			while ($fff=$db->fetch(1)){
				if(isset($URL[1]) && $URL[1]!=''){
					$active_filter_show_in_group_arr=explode("-",$URL[1]);
					if(in_array( $fff['alias'], $active_filter_show_in_group_arr)){
						$filters[$ff['gfgID']]['active_alias']=$fff['alias'];	
					}	
				}
			
			
			
				$db->query("SELECT COUNT(DISTINCT g.ID) AS cnt2
								FROM goods g
								JOIN goods_f2g f2g ON f2g.gID=g.ID
								JOIN goods_filters gf ON gf.ID=f2g.fID
								WHERE gf.ID='".$fff['gfID']."'
								".$filter_selected_goods_SQL." GROUP BY gf.ID", 2);
				$cnt2=$db->fetch(2);

				$tmp_filters_url=$filters_url;
				array_push($tmp_filters_url, $fff['alias']);
				$new_filters_url=array_unique($tmp_filters_url);
		//		$new_filters_url=array($fff['alias']);		// danger code :)
				
				$filters[$ff['gfgID']]['sub_filters'][$fff['alias']] = array();
			
				if(in_array($fff['alias'], $filters_url)){
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['act']="1";
					unset($new_filters_url[array_search($fff['alias'], $filters_url)]);
				}
				else{
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['act']="0";
				}
				sort($new_filters_url);

				$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['link']=implode('-', $new_filters_url);
				$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['gfName']=$fff['gfName'];
				/** =========== **/
				if(
					strpos($filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['link'],'-') || 
					(isset($URL[1]) && strpos($URL[1], '-')) || 
					!isset($URL[1]) ||  
					(!strpos($URL[1],'page') && $filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['act']!=1)
				)
				{
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['need_slash']='/';				
				}else{
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['need_slash']='';
				}
				
				/** =========== **/
				if(!$filter_selected_groups){
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['cnt']=$fff['cnt'] ?? '0';
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['disable']='0';
				}
				elseif(in_array($fff['groupID'], $filter_selected_groups)){
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['cnt']=$fff['cnt'] ?? '0';
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['disable']='1'; 	// vybrat mozhno tolko 1 filtr iz grupi
				}else{
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['cnt']=	$cnt2['cnt2'] ?? '0';
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['disable']='0';
				}
			
				$tmp_filters_url=array();
				$tmp_filters[]=$fff['alias'];
			}//filters in 1 group
		}//filters_group	
		foreach($filters AS $k=>$v){
			foreach($v AS $kk=>$vv){
				if (is_array($vv)){
					foreach($vv AS $vvv){
						if(isset($vvv['act']) && $vvv['act']=='1') $active_filters_flag=1;
					}
				}
			}
		}


		$smarty->assign("FILTERS", $filters);
		$smarty->assign("ACTIVE_FILTERS_FLAG", $active_filters_flag);
		
		
			//================		/	FILTERS		=================
	
			//================			PAGES		=================
			$db->query("SELECT 
				g.ID AS c
				FROM goods".$db_sufix." g
				JOIN goods_forms gf ON g.ID=gf.goodID
				WHERE gf.visibility=1 AND g.classID IN ('".implode("','", $category_ids)."')
				".$filter_selected_goods_SQL."
				GROUP BY g.ID
				");

			$rs_cnt_goods = $db->num_rows();
			$total_goods = $rs_cnt_goods;

			$smarty->assign("GOODS_CNT",$total_goods);
			$ofset  = 0;

			//==================== PAGING

			$page = max(1,(int)@$cur_page);
			$ofset = $page > 1 ? (($page - 1) * $max_pages_links) : 0;

			$pages=array();
			$lastPage=ceil($total_goods/$max_pages_links);
			$smarty->assign("LASTPAGE",$lastPage);

			if($cur_page>$lastPage){
                // --- [dg] redirects form overlimited pagitation to last one --- //
                $curr_uri = $_SERVER['REQUEST_URI'];
                $curr_host = $_SERVER['HTTP_HOST'];
                preg_match('#\/page(\d+)#s', $curr_uri, $finder);
                if (isset($finder[1]) && $finder[1] != ""){
                    $last_page_from_url = $finder[1];
                }
                $correct_url = str_replace('/page'.$last_page_from_url, '/page'.$lastPage, $curr_uri);
            //    header('Location: //' . $curr_host . $correct_url, true, 301);
//				$error_404=true;


			}
			
			for ($i=1;$i<=$lastPage;$i++){
				$pages[]=array('active'=>($i==$page), 'page'=>$i, 'prev'=>$i+1==$page, 'next'=>$i-1==$page);
			}

			$smarty->assign("PAGES",$pages);
			$smarty->assign("CUR_PAGE",$page);
			$smarty->assign("PAGE_MAX",$total_goods>$max_pages_links?100:1);
	

		//===============		/	PAGES
		
		//==========		START META FILTERS	===============
		//==========		META	WITHOUT FILTERS	===============

		$db->query("SELECT * FROM goods".$db_sufix."_class WHERE alias='".$curAlias."'");
		$f_cat=$db->fetch();

		$add_ttl_txt='';
		if($page!=1)	$add_ttl_txt=" ".$lingvo['pages_curpage']." ".$page;
		
		$meta_title			=	($f_cat['meta_title']		==''	?	$f_cat['meta_title']			:	$f_cat['page_title']." ".$lingvo['button_buy']." ".$lingvo['in_kiev']).$add_ttl_txt;
		$meta_description	=	($f_cat['meta_description']	==''	?	$f_cat['meta_description']==''	:	$f_cat['page_title']." ".$lingvo['meta_descr_addon_2']." ".$f_cat['page_title']).$add_ttl_txt;
		$meta_keywords		=	$f_cat['meta_keywords'];
		$page_title			=	($f_cat['page_title']		=='' 	?	$f_cat['name']					:	$f_cat['page_title']).$add_ttl_txt;
		$topSEOtext			=	$f_cat['topSEOtext'];
		$leftSEOtext		=	$f_cat['seotext'];
		$centerSEOtext		=	$f_cat['centerSEOtext'];
		
		$meta_rel_canonical		=		'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/'.$curAlias.'/" />';

		
		//==========		META	=> FILTERS_META		==============




		if(count($filters_url)){
			$db->query("SELECT * FROM goods_filters_meta WHERE alias='".$URL[1]."' AND classID='".$categoryID."'");
			if(!$db->num_rows())
				$db->query("INSERT INTO goods_filters_meta SET alias='".$URL[1]."', classID='".$categoryID."', is_index='0'", 2);
			else
				$db->query("UPDATE goods_filters_meta SET filter_views=filter_views+1 WHERE alias='".$URL[1]."' AND classID='".$categoryID."'", 2);
			$f_meta=$db->fetch();
			if($f_meta['is_index']!='1')	{

				$smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, nofollow">');
				
				$page_title				=		$page_title." (".implode(", ", array_unique($filter_selected_names)).")";
				$meta_title		=	($f_meta['meta_title'.$db_sufix]		!=''?	$f_meta['meta_title'.$db_sufix]	:	$page_title." ".$lingvo['button_buy']." ".$lingvo['in_kiev']).$add_ttl_txt;
				$meta_description=	($f_meta['meta_description'.$db_sufix]	!=''?	$f_meta['meta_description'.$db_sufix]	:	$page_title." ".$lingvo['meta_descr_addon_2']." ".$page_title).$add_ttl_txt;

					$topSEOtext			=		'';
					$leftSEOtext		=		'';
					$centerSEOtext		=		'';
			
				$hleb[2]['link']='';
				$hleb[2]['name']=$lingvo['filter'].": ".implode(", ", array_unique($filter_selected_names)).$add_ttl_txt;
			}else{
				$meta_rel_canonical		=		'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/'.$curAlias.'/'.$f_meta['alias'].'/" />';
				

				$meta_title		=	($f_meta['meta_title'.$db_sufix]		!=''?	$f_meta['meta_title'.$db_sufix]	:	$page_title." ".$lingvo['button_buy']." ".$lingvo['in_kiev']).$add_ttl_txt;
				$meta_description=	($f_meta['meta_description'.$db_sufix]	!=''?	$f_meta['meta_description'.$db_sufix]	:	$page_title." ".$lingvo['meta_descr_addon_2']." ".$page_title).$add_ttl_txt;
				$meta_keywords		=	$f_meta['meta_keywords'.$db_sufix];
				$page_title			=		($f_meta['page_title']=='' ? $f_meta['name'.$db_sufix]:$f_meta['page_title'.$db_sufix]).$add_ttl_txt;
				$topSEOtext			=		$f_meta['topSEOtext'.$db_sufix];
				$leftSEOtext		=		$f_meta['leftSEOtext'.$db_sufix];
				$centerSEOtext		=		$f_meta['centerSEOtext'.$db_sufix];
				
				
				$hleb[2]['link']='';
				$hleb[2]['name']=$lingvo['filter'].": ".$page_title;
			}

		}	//if count filters META WITH FILTERS

			//=========ОТЗЫВЫ
		//	$good_feedback=array();
		$db->query("SELECT * FROM goods_voting WHERE pageID='".$categoryID."' AND pageType='goodCAT' AND act='1' ORDER BY date_add");
		if($db->num_rows()){
			while($g_fb=$db->fetch()){
				$good_feedback[]=$g_fb;
			}
			$smarty->assign("GOOD_FEEDBACK", $good_feedback);
		}
		$db->query("SELECT COUNT(gv.ID) AS vote_cnt, SUM(gv.vote) vote_summ, round((SUM(gv.vote)/COUNT(gv.ID)), 2) AS vote_avg FROM goods_voting gv WHERE pageID='".$categoryID."' AND pageType='goodCAT' AND act='1'");
		$g_vote=$db->fetch();
		if($g_vote['vote_cnt']>0){
			$SCHEMA_GOOD_REWIE_CNT=$g_vote['vote_cnt'];
			$SCHEMA_GOOD_VOTE_AVG=$g_vote['vote_avg'];
			$smarty->assign("GOOD_VOTE", $g_vote);
		}else{
			$good_vote=array('vote_cnt'=>'1', 'vote_avg'=>'5.00');
			$smarty->assign("GOOD_VOTE", $good_vote);
			$SCHEMA_GOOD_REWIE_CNT='1';
			$SCHEMA_GOOD_VOTE_AVG='5';
		}

		
	//==========		/ META			===============
		
	// =========== LETS BUILD GOODS LIST============
	$main_query = "SELECT g.*, min(NULLIF(gf.price, 0)) AS min_price, max(gf.price) AS max_price, min(NULLIF(gf.old_price, 0)) AS min_old_price, max(gf.old_price) AS max_old_price
					FROM goods".$db_sufix." g
					LEFT JOIN goods_forms gf
					ON g.ID=gf.goodID
					WHERE gf.visibility=1 AND g.classID IN ('".implode("','", $category_ids)."')
					".$filter_selected_goods_SQL."
					GROUP BY g.ID
					ORDER BY ".$sql_sort_order.", gf.price > 0 DESC, g.classID DESC, g.name
					LIMIT ".$ofset.",".$max_pages_links;

	include("goods_build_list.php");
	// =========== LETS BUILD GOODS LIST============
		
$schema_prices_min=array();
	foreach ($promo AS $k=>$v){
			if(!isset($v['min_price']) || !$v['min_price']) continue;
			else	{
						$schema_prices_min[]=$v['min_price'];
						$schema_prices_max[]=$v['max_price'];
				}
	}
	
	$schema_offers_count=$total_goods;
	$schema_min_price = min($schema_prices_min ?: [0]);
	$schema_max_price = max($schema_prices_min ?: [0]);
	
	$schema_offers_txt='';
	$schema_offers_txt.='<script type="application/ld+json">
									{	
										"@context"	:	"http://schema.org",
										"offers":
											{
												"priceCurrency"	:	"UAH",
												"lowPrice"			:	"'.$schema_min_price.'",
												"highPrice"			:	"'.$schema_max_price.'",
												"offerCount"			:	"'.$schema_offers_count.'",
												"availability"			:	"http://schema.org/InStock",
												"@type"				:	"AggregateOffer"
											},
										"@type"			:	"Product",
										"name"				:	"'.str_replace('"', '&quot;', $page_title).'",
										"description"		:	"'.str_replace('"', '&quot;', $meta_description).'"
										
										,"aggregateRating": {
		        									"@type": "AggregateRating",
		   											"ratingValue": "'.$SCHEMA_GOOD_VOTE_AVG.'",
		    										"reviewCount": "'.$SCHEMA_GOOD_REWIE_CNT.'"
		  										  }
									}
								</script>';
		
		
		$smarty->assign("SCHEMA_OFFERS", $schema_offers_txt);

		$smarty->assign("PROMO", $promo);
		$smarty->assign("IS_BOUQUET", $is_bouquet);

		$TITLE[]	=	$meta_title;

		$smarty->assign("META_DESCRIPTION", $meta_description);
		$smarty->assign("META_KEYWORDS",$meta_keywords);
		$smarty->assign("PAGETYPE_SESSNAME",'goodCAT'.$categoryID);
		$smarty->assign("PAGE_TITLE",$page_title);
		$smarty->assign("TOP_SEO_TEXT",$topSEOtext);
		$smarty->assign("SEO_TEXT",$leftSEOtext);
		$smarty->assign("LIST_OR_TBL",$f_cat['list_or_tbl']);
		
		$body_text=$centerSEOtext;
		preg_match_all('/<h2\b[^>]*>(.*?)<\/h2>(.*?)(?=(<h2\b[^>]*>|$))/is', $body_text, $matches, PREG_SET_ORDER);
		$new_body_text = '';

		foreach ($matches as $m) {
		    $body_title = trim($m[1]);
		    $body_content = trim($m[2]);
		
		    // Оборачиваем все <p>... в div.article-section__content
		    $block = '<section class="article-section">' . "\n";
		    $block .= '<h2 class="article-section__title">' . $body_title . '</h2>' . "\n";
		    $block .= '<div class="article-section__content">' . "\n" . $body_content . "\n" . '</div>' . "\n";
		    $block .= '</section>';
		
		    $new_body_text .= $block . "\n";
		}
		$new_body_text=preg_replace('/(<table\b[^>]*>.*?<\/table>)/is', '<div class="article-section__table">$1</div>', $new_body_text);
		$smarty->assign("CENTER_SEO_TEXT", $new_body_text);
		
		
		$smarty->assign("CATEGORY_M_ID",$f_cat['ID']);

		if (isset($dept) && $dept=='florist')
			$smarty->assign("CONTENT_TPL",'category/bouquets.tpl');
			// $smarty->assign("CONTENT_TPL",'category/plants.tpl');
		else
			$smarty->assign("CONTENT_TPL",'plants.tpl');

		$smarty->assign("META_REL_CANONICAL",$meta_rel_canonical);
}

if ($error_404){
	header('HTTP/1.0 404 Not Found', true, '404');
	include($_SERVER['DOCUMENT_ROOT']."/404.php");
	exit();
}
$smarty->assign("HLEB",$hleb);

?>