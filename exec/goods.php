<?php
include_once("good_comment.php");

if(!isset($PARAM[0]) || $PARAM[0]=='' || isset($PARAM[2])){
	header('HTTP/1.0 404 Not Found', true, '404');
	include($_SERVER['DOCUMENT_ROOT']."/404.php");
	exit();
}

$from_goods = 1;

$sql_pot_group = '';
$is_pot = 0;
$max_pages_links = 20;
$sql_sort_order = "g.act='0', g.availability > 0 DESC, g.preorder=0, sort DESC, gf.price > 0 DESC, g.classID DESC, g.name";

if($URL[0] == 'planters') {
	$is_pot = 1;
	$sql_pot_group = "GROUP BY hgt";
}

$smarty->assign("FROM_GOODS", $from_goods);
$smarty->assign("IS_POT", $is_pot);


$TITLE=array();
//=========hleb
$hleb=array();
$hleb[0]['link']='/';
$hleb[0]['name']=$lingvo['main_page'];
//=========hleb

$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID='0'");
while($ss=$db->fetch()){
	$hleb_cat_link[$ss['ID']]='/'.$ss['alias'].'/';
}

//Выбранная рубрика
$db->query("SELECT * FROM goods".$db_sufix."_class WHERE alias='".$PARAM[0]."'");

$show_comments = 1;

if ($URL[0] == 'komnatnie-rasteniya' && (!$URL[1] || substr($URL[1], 0, 4)=='page')) {
	$show_comments = 0;
}

$smarty->assign("SHOW_COMMENTS", $show_comments);


if(!$db->num_rows()){
	header('HTTP/1.0 404 Not Found', true, '404');
	include($_SERVER['DOCUMENT_ROOT']."/404.php");
	exit();
}

$f_cat=$db->fetch();

$goods_WHERE=" g.classID=".$f_cat['ID'];
$meta_rel_canonical='<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/'.$URL[0].'/'.$URL[1].'/" />';

if ($URL[1] == 'sezon') {
	$hleb[1]['link'] = $hleb_cat_link[$f_cat['motherID']];
	$hleb[1]['name'] = $lingvo['buketi'];
	$hleb[2]['link'] = '';
	$hleb[2]['name'] = $lingvo['sezon'];
}elseif ($URL[0] == 'iskusstvennie-cvety') {
	$hleb[1]['link'] = $hleb_cat_link[$f_cat['motherID']];
	$hleb[1]['name'] = $lingvo['iskusstvennie_cvety'];
	$hleb[2]['link']='';
	$hleb[2]['name'] = $f_cat['name'];
} else {
	$hleb[1]['link'] = $hleb_cat_link[$f_cat['motherID']];
	if ($is_pot) {
		$hleb[1]['name'] = $lingvo['planters_kashpo'];
	} else {
		$hleb[1]['name'] = $category_left[$f_cat['motherID']]['name'];
	}

	$hleb[2]['link']='';
	$hleb[2]['name'] = $f_cat['name'];
}


	//======FILTERS
	$filters=array();
	$filters_url=array();
	$tmp_filters_url=array();
	$filter_selected_goods=array();
	$filter_selected_groups=array();
	$filter_selected_goods_SQL='';
	$show_more_IDDs='';

	//check if filters in rubric
	$db->query("SELECT count(ID) AS cnt FROM goods_filters WHERE classID='".$f_cat['ID']."'");
	$rs=$db->fetch();
	
	//	check if isset filters in rubric. If no filters but manual put into url smth there many fake pages
	if ($rs['cnt']==0 && isset($URL[2]) && substr($URL[2], 0, 4)!='page'){
		header('HTTP/1.0 404 Not Found', true, '404');
		include($_SERVER['DOCUMENT_ROOT']."/404.php");
		exit();
	}

	if ($rs['cnt'] > 0) {
		//====		1 or MORE FILTER SELECTED 
		if(isset($URL[2]) && substr($URL[2], 0, 4)!='page'){
					$filters_url=explode('-', $URL[2]);
		
					//===== 404
					$cnt_filters=array();
					$tmp_filter_groups=array();
					$db->query("SELECT * FROM goods_filters WHERE alias IN ('".implode("','", $filters_url)."') AND classID='".$f_cat['ID']."'");
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
					if(count($cnt_filters)!=count($filters_url) || $URL[2]=='' || $stop_flag){
						header('HTTP/1.0 404 Not Found', true, '404');
						include($_SERVER['DOCUMENT_ROOT']."/404.php");
						exit();
					}
					//==== END 404 =====
					$tmp_selected_goods_SQL='';
					foreach ($filters_url AS $v){
									$db->query("SELECT g.ID AS gID, gf.groupID, gf.name".$db_sufix." AS name
												FROM goods g
												JOIN goods_f2g f2g ON f2g.gID=g.ID
												JOIN goods_filters gf ON f2g.fID=gf.ID
												WHERE gf.alias='".$v."'
												GROUP BY g.ID
												");
					
									while($rs=$db->fetch()){
										$tmp_filter_selected_goods[]=$rs['gID'];
										$filter_selected_groups[]=$rs['groupID'];
										$filter_selected_names[]=$rs['name'];
									}	//while
						}	//foreach
			
						if (is_array($tmp_filter_selected_goods)) {
										$cnt_filter_selected_goods = array_count_values($tmp_filter_selected_goods);
										foreach($cnt_filter_selected_goods AS $fid => $cnt) {
													if ($cnt == count(array_unique($filter_selected_groups))) {
																$filter_selected_goods[] = $fid;
													}
										}
						}
						$filter_selected_goods_SQL=" AND g.ID IN ('".implode("','", $filter_selected_goods)."')";
			
						$show_more_IDDs = implode(",", $filter_selected_goods);
						$smarty->assign("SHOW_MORE_IDDS", $show_more_IDDs);
						$smarty->assign("FILTERS_URL", "/".implode("-", $filters_url));

		}//if isset filters
		
		//BUILD FILTERS
		$db->query("SELECT gfg.ID AS gfgID, gfg.name".$db_sufix." AS gfgName FROM goods_filter_groups gfg WHERE gfg.classID IN ('".$f_cat['ID']."')  ORDER BY gfg.sort DESC");
		while($ff=$db->fetch()){

			$filters[$ff['gfgID']]['groupName']	=	$ff['gfgName'];

			$db->query("SELECT gf.ID AS gfID, gf.alias AS alias, gf.name".$db_sufix." AS gfName,  count(g.ID) AS cnt, gf.groupID
								FROM goods_filters gf
								LEFT JOIN goods_f2g f2g ON gf.ID=f2g.fID
								LEFT JOIN goods g ON g.ID=f2g.gID
								WHERE gf.classID IN ('".$f_cat['ID']."')
								AND gf.groupID='".$ff['gfgID']."'
								GROUP BY gf.ID	
								ORDER BY gf.sort DESC", 1);

			while($fff=$db->fetch(1)){
			
				$db->query("SELECT COUNT(g.ID) AS cnt2, gf.alias
								FROM goods g
								JOIN goods_f2g f2g ON f2g.gID=g.ID
								JOIN goods_filters gf ON gf.ID=f2g.fID
								WHERE gf.ID='".$fff['gfID']."' AND g.classID IN ('".$f_cat['ID']."')
								".$filter_selected_goods_SQL, 2);	
			

				$cnt2=$db->fetch(2);
				$tmp_filters_url=$filters_url;
				array_push($tmp_filters_url, $fff['alias']);

				$new_filters_url=array_unique($tmp_filters_url);

		//		$new_filters_url=array($fff['alias']);		// danger code :)



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
					(isset($URL[2]) && strpos($URL[2], '-')) || 
					!isset($URL[2]) ||  
					(!strpos($URL[2],'page') && $filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['act']!=1)
				)
				{
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['need_slash']='/';				
				}else{
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['need_slash']='';
				}
				
				/** =========== **/
				
				if(in_array($fff['groupID'], $filter_selected_groups)){
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['cnt']=($fff['cnt']==0?'':'+').$fff['cnt'];
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['disable']='1'; 	// vybrat mozhno tolko 1 filtr iz grupi
				}else{
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['cnt']=$cnt2['cnt2'];
					$filters[$ff['gfgID']]['sub_filters'][$fff['alias']]['disable']='0';
				}
			
				$tmp_filters_url=array();
				$tmp_filters[]=$fff['alias'];
			}//filters in 1 group
		}//filters_group	
		$smarty->assign("FILTERS", $filters);
		
		//================		/	FILTERS		=================
	}


$add_ttl_txt='';
if(isset($_REQUEST['p']) && $_REQUEST['p']>1){
	$add_ttl_txt=", ".$lingvo['pages_curpage']." ".$_REQUEST['p'];
}
//============.     META.   =============================
$page_title		=		($f_cat['page_title']==''?$f_cat['name']:$f_cat['page_title']).$add_ttl_txt;


$page_sub		=		$f_cat['name'];
$leftSEOtext			=		$f_cat['seotext'];
$centerSEOtext		=		$f_cat['centerSEOtext'];
$topSEOtext			=		$f_cat['topSEOtext'];
$meta_title				=		$f_cat['meta_title'].$add_ttl_txt;
$meta_description	=		$f_cat['meta_description'].$add_ttl_txt;
$meta_keywords		=		$f_cat['meta_keywords'].$add_ttl_txt;



if(count($filters_url)){
	$db->query("SELECT * FROM goods_filters_meta WHERE alias='".$URL[2]."' AND classID='".$f_cat['ID']."'");
	if(!$db->num_rows())
		$db->query("INSERT INTO goods_filters_meta SET alias='".$URL[2]."', classID='".$f_cat['ID']."', is_index='0'", 2);
	else
		$db->query("UPDATE goods_filters_meta SET filter_views=filter_views+1 WHERE alias='".$URL[2]."' AND classID='".$f_cat['ID']."'", 2);
		
				
	$f_meta=$db->fetch();
	if($f_meta['is_index']!='1')	{
		$smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, nofollow">');
					
		$page_title				=		$page_title." (".implode(", ", array_unique($filter_selected_names)).")".$add_ttl_txt;
		
		$topSEOtext			=		'';
		$leftSEOtext			=		'';
		$centerSEOtext		=		'';

		$hleb[2]['link']=$hleb_cat_link[$f_cat['motherID']].$f_cat['alias']."/";
		$hleb[2]['name']=$f_cat['name'];
		$hleb[3]['link']='';
		$hleb[3]['name']="Фильтр: ".implode(", ", array_unique($filter_selected_names)).$add_ttl_txt;
	}else{
		$meta_rel_canonical		=		'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/komnatnie-rasteniya/'.$f_cat['alias'].'/'.$f_meta['alias'].'/" />';
	
		
		$meta_title=$f_meta['meta_title'.$db_sufix].$add_ttl_txt;
		$meta_description	=		$f_meta['meta_description'.$db_sufix].$add_ttl_txt;
		$meta_keywords		=		$f_meta['meta_keywords'.$db_sufix];
		$page_title				=		($f_meta['page_title'.$db_sufix]=='' ? $f_meta['name'.$db_sufix]:$f_meta['page_title'.$db_sufix]).$add_ttl_txt;
		$page_sub		=		$f_meta['name'.$db_sufix];
		$topSEOtext			=		$f_meta['topSEOtext'.$db_sufix];
		$leftSEOtext			=		$f_meta['leftSEOtext'.$db_sufix];
		$centerSEOtext		=		$f_meta['centerSEOtext'.$db_sufix];
				
		$hleb[1]['link']='/komnatnie-rasteniya/';
		$hleb[1]['name']=$lingvo['plants'];
		$hleb[2]['link']=$hleb_cat_link[$f_cat['motherID']].$f_cat['alias']."/";
		$hleb[2]['name']=$f_cat['name'];
		$hleb[3]['link']='';
		$hleb[3]['name']=$page_title.$add_ttl_txt;
	}
}	//if count filters META WITH FILTERS
	
		//==========		/ META			===============


$smarty->assign("PAGE_TITLE", $page_title);
$smarty->assign("PAGE_SUB",	$page_sub);
$smarty->assign("SEO_TEXT",	$leftSEOtext);
$smarty->assign("CENTER_SEO_TEXT",	$centerSEOtext);
$smarty->assign("TOP_SEO_TEXT",	$topSEOtext);

$TITLE[1]=$meta_title;
$smarty->assign("META_DESCRIPTION",		$meta_description);
$smarty->assign("META_KEYWORDS",		$meta_keywords);

//============.  /  META.   =============================

	$smarty->assign("CATEGORY_ID",$f_cat['ID']);
	$smarty->assign("PAGETYPE_SESSNAME",'goodCAT'.$f_cat['ID']);
	$smarty->assign("CATEGORY_M_ID",$f_cat['motherID']);
	$smarty->assign("CUR_CAT",$PARAM[0]);
	$smarty->assign("LIST_OR_TBL",$f_cat['list_or_tbl']);
	//CEO
	if(isset($_REQUEST['p'])){
		$smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, follow">');
		$smarty->assign("SEO_TEXT",'');
		$smarty->assign("CENTER_SEO_TEXT",'');
	}
	
	//=========ОТЗЫВЫ
	//	$good_feedback=array();
		$db->query("SELECT * FROM goods_voting WHERE pageID='".$f_cat['ID']."' AND pageType='goodCAT' AND act='1' ORDER BY date_add DESC");
		if($db->num_rows()){
			while($g_fb=$db->fetch()){
				$good_feedback[]=$g_fb;
			}
			$smarty->assign("GOOD_FEEDBACK", $good_feedback);
		}
		$db->query("SELECT COUNT(gv.ID) AS vote_cnt, SUM(gv.vote) vote_summ, round((SUM(gv.vote)/COUNT(gv.ID)), 2) AS vote_avg FROM goods_voting gv WHERE pageID='".$f_cat['ID']."' AND pageType='goodCAT' AND act='1'");
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
	
	//=============== Вывод списка товаров БЕЗ фильтров ========
			$promo = array();
			$not_available = 0;	
			$prices = array();
			$colors = array();
			
			//Считаем сколько товаров. Для страниц
			$db->query("SELECT 
				g.ID AS c
				FROM goods".$db_sufix." g
				LEFT JOIN goods_forms gf ON g.ID=gf.goodID
				WHERE ".$goods_WHERE."
				".$filter_selected_goods_SQL."
				GROUP BY g.ID");
			$rs_cnt_goods=$db->num_rows();	
			$total_goods=$rs_cnt_goods;


			$smarty->assign("GOODS_CNT",$total_goods);
			$ofset=0;

			$max_pages_links=20;
			$page=max(1,(int)@$_REQUEST['p']);

			$ofset=($page-1)*$max_pages_links;
			$pages=array();
			$lastPage=ceil($total_goods/$max_pages_links);
			$smarty->assign("LASTPAGE",$lastPage);
			
			
			
			for ($i=1;$i<=ceil($total_goods/$max_pages_links);$i++){
				$pages[]=array('active'=>($i==$page), 'page'=>$i, 'prev'=>$i+1==$page, 'next'=>$i-1==$page);
			}
			
			if(isset($_REQUEST['p']) && ($_REQUEST['p']<2 || $_REQUEST['p']>$lastPage)){
				include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
				header("HTTP/1.0 301 Moved Permanently"); 
				header("location:".$hleb_cat_link[$f_cat['motherID']]);
				exit();
			}		
			
			$smarty->assign("PAGES",$pages);
			$smarty->assign("CUR_PAGE",$page);
			$smarty->assign("PAGE_MAX",$total_goods>$max_pages_links?100:1);//Выводить пагинацию или нет
			//===/Страницы
			
			$db->query("SELECT g.*, gf.ID AS gfID, min(gf.price) AS min_price, max(gf.price) AS max_price FROM goods".$db_sufix." g
			LEFT JOIN goods_forms gf
			ON g.ID=gf.goodID
			WHERE ".$goods_WHERE."
			".$filter_selected_goods_SQL."
			GROUP BY g.ID
			ORDER BY ".$sql_sort_order."
			LIMIT ".$ofset.",".$max_pages_links);

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
					'colors' => $colors[$rs_goods['ID']]
				);

				

				$order_type = 'DESC';

				if ($f_cat['motherID'] == 5) $order_type=''; //Горшки отсортированы по цене от 0 до 100

				// $db->query("SELECT ID, dia, hgt, wdt, depth, price, color, visibility FROM goods_forms WHERE goodID='".$rs_goods['ID']."' AND visibility=1 AND price > 0 ".$sql_pot_group, 1);

				$db->query("SELECT gfs.ID, gfs.dia, gfs.hgt, gfs.wdt, gfs.depth, gfs.price, gfs.old_price, gfs.color, gfs.visibility, gfs.measure_qt, gmg.unit, gmg.name_ru AS mg_name_ru, gmg.name_ua AS mg_name_ua FROM goods_forms gfs LEFT JOIN goods_measures gmg ON gmg.ID=gfs.measure_id
				WHERE gfs.goodID='".$rs_goods['ID']."' AND gfs.visibility=1 AND gfs.price > 0 ".$sql_pot_group, 1);

				$is_action=0;
				$prices[$rs_goods['ID']]=array();
				
				while($rs_goods_forms = $db->fetch(1)) {
				
					if ($rs_goods['availability'] == 1 && intval($rs_goods_forms['price']) > 0) {
						$prices[$rs_goods['ID']][] = intval($rs_goods_forms['price']);
					}

					$promo[count($promo)-1]['forms'][] = array(
						'form_id' => $rs_goods_forms['ID'],
						'dia' => $rs_goods_forms['dia'],
						'hgt' => $rs_goods_forms['hgt'],
						'wdt' => $rs_goods_forms['wdt'],
						'depth' => $rs_goods_forms['depth'],
						'price' => $rs_goods_forms['price'],
						'measure_qt' => $rs_goods_forms['measure_qt'],
						'unit' => $rs_goods_forms['unit'],
						'mg_name_ru' => $rs_goods_forms['mg_name_ru'],
						'mg_name_ua' => $rs_goods_forms['mg_name_ua']
					);
					
					if ($rs_goods_forms['color'] != '0') {

						$db->query("SELECT gf.color, gc.name_ru, gc.name_ua, gc.preview FROM goods_forms gf LEFT JOIN goods_colors gc ON gf.color=gc.alias WHERE goodID='".$rs_goods['ID']."' AND visibility=1 AND price > 0 ", 2);

						while ($rs_goods_colors = $db->fetch(2)) {
							if ($rs_goods_colors['color'] != '0') {
								$colors[$rs_goods['ID']][] = array(
									'name_ru' => $rs_goods_colors['name_ru'],
									'name_ua' => $rs_goods_colors['name_ua'],
									'image' => $rs_goods_colors['preview'],
								);
							}
						}
					}
					
				if($rs_goods_forms['old_price']>0) $is_action=1;
				$promo[count($promo)-1]['is_action']=$is_action;
				}
				
				
				if (count($prices[$rs_goods['ID']]) > 0) {
					$promo[count($promo)-1]['min_price'] = min(array_filter($prices[$rs_goods['ID']]));
					$promo[count($promo)-1]['max_price'] = max(array_filter($prices[$rs_goods['ID']]));
				}

				$promo[count($promo)-1]['colors'] = array_unique($colors[$rs_goods['ID']], SORT_REGULAR);
				
			}
			$schema_prices_min=array();
			foreach ($promo AS $k=>$v){
					if(!isset($v['min_price']) || !$v['min_price']) continue;
					else	{
							$schema_prices_min[]=$v['min_price'];
							$schema_prices_max[]=$v['max_price'];
					}
			}
			
			$schema_offers_count=$total_goods;
			$schema_min_price=@min($schema_prices_min);
			$schema_max_price=@max($schema_prices_max);
			
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
												"name"				:	"'.str_replace('"', '&quot;', str_replace('\'', '&#700;', strip_tags($page_title))).'",
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

			if($PARAM[0]=='metal-pots'){
				$smarty->assign("CONTENT_TPL",'category/metal_pots.tpl');
			} else {
				$smarty->assign("CONTENT_TPL",'plants.tpl');
			}


		//=============== /Вывод списка товаров БЕЗ фильтров ========

	$smarty->assign("META_REL_CANONICAL",$meta_rel_canonical);

?>









