<?php

if(!isset($_REQUEST['srch'])){
	header("HTTP/1.0 301 Moved Permanently"); 
	header("Location: /");
}
$goods=array();
if($_REQUEST['srch']=='') $_REQUEST['srch']='Шефлера';

if(strlen($_REQUEST['srch'])>= 2){
	if(!get_magic_quotes_gpc())
		$srch=addslashes(trim($_REQUEST['srch']));
	else
		$srch=trim($_REQUEST['srch']);
	

	$first_table = strlen($db_sufix) > 0 ? 'goods_ua' : 'goods';
	$second_table = strlen($db_sufix) > 0 ? 'goods' : 'goods_ua';
	
	
	
//=====================Search BY Articul====================
	$db->query("SELECT * from goods_colors");
	$colors = array();
	while($cls=$db->fetch()){
		$colors[$cls['alias']]=$cls;
	}

	$db->query("SELECT 
				g.ID AS gID, g.link AS gLink, g.classID AS classID, g.name AS goodName, gf.*, gf.ID AS formID, gf.price AS goodPrice, g1c.*, gc.motherID AS mID
				FROM goods".$db_sufix." g
				JOIN goods".$db_sufix."_class gc ON g.classID=gc.ID
				JOIN goods_forms gf ON g.ID=gf.goodID
				LEFT JOIN goods_forms2_1c g21c ON gf.ID=g21c.fID
				LEFT JOIN goods_1c g1c ON g1c.barcode=g21c.barcode
				WHERE gf.ID LIKE '".$srch."' AND g.act='Y' AND g.classID NOT IN (78, 79)
				ORDER BY g.sort, g.availability DESC");
				
				
	while($rs_goods_articul=$db->fetch()){
		
		$new_link_articul	= $lang_url . '/product/'.$rs_goods_articul['gID'].'_'.$rs_goods_articul['gLink'].'/';
		
		
		if($rs_goods['classID']=='49') {
			$new_link_articul= $lang_url . '/compositions/'.$rs_goods_articul['gLink'].'/';
		}
		elseif($rs_goods_articul['classID']=='78' || $rs_goods_articul['classID']=='79' || $rs_goods_articul['classID']=='80') {
			$new_link_articul=$lang_url . '/buket/'.$rs_goods_articul['gID'].'/';
		}
		else{
			$new_link_articul= $lang_url . '/product/'.$rs_goods_articul['gID'].'_'.$rs_goods_articul['gLink'].'/'.$rs_goods_articul['formID']."/";
		}
		
		
			$form_measure = '';

			if ($rs_goods_articul['dia']) {
				$form_measure = $form_measure . '&#216; ' . $rs_goods_articul['dia'];
			}
			if ($rs_goods_articul['wdt']) {
				$form_measure = $form_measure . $rs_goods_articul['wdt'];
			}
			if ($rs_goods_articul['depth']) {
				$form_measure = $rs_goods_articul['depth'] ? $form_measure . ' x ' . $rs_goods_articul['depth'] : $form_measure . $rs_goods_articul['depth'];
			}
			if ($rs_goods_articul['hgt']) {
				$form_measure = $rs_goods_articul['dia'] ? $form_measure . ', ' . $lingvo['hgt'] . ' ' . $rs_goods_articul['hgt'] : $form_measure . ', ' . $lingvo['hgt'] . ' ' . $rs_goods_articul['hgt'];
			}
			if ($rs_goods_articul['measure_qt']) {
				if ($rs_goods_articul['dia'] || $rs_goods_articul['wdt'] || $rs_goods_articul['hgt']) {
					$form_measure = $form_measure . ', ' . $rs_goods_articul['measure_qt'];
				} else {
					$form_measure = $form_measure . $rs_goods_articul['measure_qt'];
				}
			}
			$form_measure = $form_measure . ' ' .$rs_goods_articul['unit'];
			
			if ($rs_goods_articul['color']) {
				$form_measure = $form_measure . $colors[$rs_goods_articul['color']]['name_'.$lang];
			}
		$articul_search[]=$rs_goods_articul;
		$articul_search[count($articul_search)-1]['measure'] = $form_measure;
		$articul_search[count($articul_search)-1]['new_link_articul'] = $new_link_articul;
	}
	$smarty->assign("ARTICUL_SEARCH", $articul_search);
	

	$db->query("SELECT 
				g.*, gc.motherID AS mID
				FROM $first_table g
				JOIN $second_table gu ON g.ID=gu.ID
				JOIN goods".$db_sufix."_class gc ON g.classID=gc.ID
				JOIN goods_forms gf ON g.ID=gf.goodID
				WHERE ((g.name LIKE '%".$srch."%' OR gu.name LIKE '%".$srch."%' OR g.name_alter LIKE '%".$srch."%') OR gf.ID='".$srch."') AND g.act='Y' AND g.classID NOT IN (78, 79)
				ORDER BY g.sort, g.availability DESC");

	while($rs_goods=$db->fetch()){
		$goods[$rs_goods['ID']]=$rs_goods;
		if($rs_goods['classID']=='49') {
			$new_link= $lang_url . '/compositions/'.$rs_goods['link'].'/';
			$new_image='compositions/s/'.$rs_goods['image'];
		}
		elseif($rs_goods['classID']=='78' || $rs_goods['classID']=='79' || $rs_goods['classID']=='80') {
			$new_link=$lang_url . '/buket/'.$rs_goods['ID'].'/';
			$new_image='ins/s/'.$rs_goods['image'];
		}
		else{
			$new_link= $lang_url . '/product/'.$rs_goods['ID'].'_'.$rs_goods['link'].'/';
			$new_image='ins/s/'.$rs_goods['image'];
		}
		$goods[$rs_goods['ID']]['new_link']= $new_link;
		$goods[$rs_goods['ID']]['new_image']= $new_image;
		
		// $db->query("SELECT * FROM goods_forms WHERE goodID='".$rs_goods['ID']."' AND visibility='1' ORDER BY price=0, price DESC", 1);
		$db->query("SELECT *, gf.ID AS fid FROM goods_forms gf LEFT JOIN goods_measures gm ON gf.measure_id=gm.ID WHERE goodID='".$rs_goods['ID']."' AND visibility=1 GROUP BY dia, wdt, hgt, depth, measure_qt ORDER BY price DESC, dia DESC, wdt DESC, measure_qt DESC", 1);
		$is_action=0;
		while ($rs_goods_forms=$db->fetch(1)){

			$form_measure = '';

			if ($rs_goods_forms['dia']) {
				$form_measure = $form_measure . '&#216; ' . $rs_goods_forms['dia'];
			}
			if ($rs_goods_forms['wdt']) {
				$form_measure = $form_measure . $rs_goods_forms['wdt'];
			}
			if ($rs_goods_forms['depth']) {
				$form_measure = $rs_goods_forms['depth'] ? $form_measure . ' x ' . $rs_goods_forms['depth'] : $form_measure . $rs_goods_forms['depth'];
			}
			if ($rs_goods_forms['hgt']) {
				$form_measure = $rs_goods_forms['dia'] ? $form_measure . ', ' . $lingvo['hgt'] . ' ' . $rs_goods_forms['hgt'] : $form_measure . ', ' . $lingvo['hgt'] . ' ' . $rs_goods_forms['hgt'];
			}
			if ($rs_goods_forms['measure_qt']) {
				if ($rs_goods_forms['dia'] || $rs_goods_forms['wdt'] || $rs_goods_forms['hgt']) {
					$form_measure = $form_measure . ', ' . $rs_goods_forms['measure_qt'];
				} else {
					$form_measure = $form_measure . $rs_goods_forms['measure_qt'];
				}
			}

			$form_measure = $form_measure . ' ' .$rs_goods_forms['unit'];

			$goods[$rs_goods['ID']]['forms'][] = $rs_goods_forms;
			$goods[$rs_goods['ID']]['forms'][count($goods[$rs_goods['ID']]['forms'])-1]['measure'] = $form_measure;
			
			if($rs_goods_forms['old_price']>0) $is_action=1;
			$goods[$rs_goods['ID']]['is_action']=$is_action;
		}

		if(count($goods[$rs_goods['ID']]['forms'])>1) $goods[$rs_goods['ID']]['show_qt']=1;
	}

	if (!isset($_COOKIE['no_counter'])){
		$db->query("INSERT INTO search_words SET q='".$srch."', IP='".$_SESSION['IP']."', q_date=".time());
	}
	$smarty->assign("SRCH_ROW", stripslashes($srch));
}else{
	$smarty->assign("LEN", true);
}



$smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, nofollow">');
$smarty->assign("GOODS", $goods);
$smarty->assign("CONTENT_TPL",'search.tpl');

?>