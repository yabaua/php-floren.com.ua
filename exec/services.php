<?php
include("good_comment.php");
$TITLE=array();

if($URL[0]=='phytodesign'){
	if(isset($URL[1])){
		include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
			//=============404===================
			header('HTTP/1.0 404 Not Found', true, '404');
			include($_SERVER['DOCUMENT_ROOT']."/404.php");
			exit();
			//=============404===================
	//	header("HTTP/1.0 301 Moved Permanently"); 
	//	header("location:".$lang_url."/phytodesign/");
	//	exit();
	}

	//phytodesign page
	$db->query("SELECT *, content AS body, name AS title FROM tree25".$db_sufix." WHERE alias='phytodesign'");
	$service=$db->fetch();
	$smarty->assign("SERVICE",$service);
	
	$hleb=array();
	$hleb[0]['link']='/';
	$hleb[0]['name']=$lingvo['main_page'];
	$hleb[1]['link']='';
	$hleb[1]['name']=$lingvo['phytodesign'];
	
	if($service['meta_title']!='') $TITLE[1]=$service['meta_title'];
	else $TITLE[0]=$service['title'];
	
	
	
	$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.$_SERVER['REQUEST_URI'].'" />');
	$smarty->assign("META_DESCRIPTION",$service['meta_description']);
	$smarty->assign("META_KEYWORDS",$service['meta_keywords']);
	$smarty->assign("PAGETYPE_SESSNAME",'service'.$service['ID']);
	$smarty->assign("PHOTOS", "xxxx");
	
	$smarty->assign("LEFT_TPL",'left_col.tpl');
	$smarty->assign("CONTENT_TPL",'services.tpl');
	$smarty->assign("SOC_TTL",rawurlencode($service['title']));

}
else
{// all other services not phytodesign. This shit is only because URL structure

	if(isset($PARAM[0])){
				
				
				$db->query("SELECT * FROM services".$db_sufix." WHERE alias='".$PARAM[0]."'");
				if(!$db->num_rows() || isset($PARAM[1])){
					
					
					//=============404===================
					header('HTTP/1.0 404 Not Found', true, '404');
					include($_SERVER['DOCUMENT_ROOT']."/404.php");
					exit();
					//=============404===================
				}
				
				$service=$db->fetch();
				if($service['category']=='florist') {
					$dept='florist';
					$smarty->assign("DEPT", $dept);
				}

				$smarty->assign("SERVICE",$service);
				$servImgSize=array();
				if(isset($service['schema_image']) && $service['schema_image']!=''){
					$servImgSize=@getimagesize($service['schema_image']);
					$smarty->assign("SERVICE_IMAGE",$servImgSize);
				}
				
				
	
				$hleb=array();
				$hleb[0]['link']='/';
				$hleb[0]['name']=$lingvo['main_page'];
				$hleb[1]['link']='/services/';
				$hleb[1]['name']=$lingvo['services'];
				$hleb[2]['link']='';
				$hleb[2]['name']=$service['menuttl'];
			
			
				if($service['meta_title']!='') $TITLE[1]=$service['meta_title'];
				else $TITLE[0]=$service['title'];
		
		
			//========= Відгуки
				//	$good_feedback=array();
				$db->query("SELECT * FROM goods_voting WHERE pageID='".$service['ID']."' AND pageType='service' AND act='1'");
				if($db->num_rows()){
					while($g_fb=$db->fetch()){
						$good_feedback[]=$g_fb;
					}
					$smarty->assign("GOOD_FEEDBACK", $good_feedback);
				}
					
				$db->query("SELECT COUNT(gv.ID) AS vote_cnt, SUM(gv.vote) vote_summ, round((SUM(gv.vote)/COUNT(gv.ID)), 2) AS vote_avg FROM goods_voting gv WHERE pageID='".$service['ID']."' AND pageType='service' AND act='1'");
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
		
				$body_file = 'services/' . $lang .'_'.$service['alias'] . '.tpl';
			//	echo $body_file;
				$smarty->assign("BODY_FILE",$body_file);
				
				$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.$_SERVER['REQUEST_URI'].'" />');
				$smarty->assign("META_DESCRIPTION",$service['meta_description']);
				$smarty->assign("META_KEYWORDS",$service['meta_keywords']);
				$smarty->assign("PAGETYPE_SESSNAME",'service'.$service['ID']);
				$smarty->assign("PHOTOS", "xxxx");
				
				
				$smarty->assign("LEFT_TPL",'left_col.tpl');
				$smarty->assign("CONTENT_TPL",'services.tpl');
				$smarty->assign("CUR_CAT",'phytodesign');
	}
	//======IF 1 SERVICE
	else{//SERVICES LIST


		$hleb=array();
		$hleb[0]['link']='/';
		$hleb[0]['name']=$lingvo['main_page'];
		$hleb[1]['link']='';
		$hleb[1]['name']=$lingvo['services'];
		

		$db->query("SELECT * FROM tree25".$db_sufix." WHERE alias='services'");
		$ff=$db->fetch();
		
		
		$TITLE[1]=$ff['meta_title'];
		$smarty->assign("META_DESCRIPTION",$ff['meta_description']);
		$smarty->assign("META_KEYWORDS",$ff['meta_keywords']);
		$smarty->assign("CONTENT",$ff['content']);
		$smarty->assign("PAGE_TITLE",$ff['name']);
		
		$smarty->assign("LEFT_TPL",'left_col.tpl');
		$smarty->assign("CONTENT_TPL",'services_list.tpl');
		
	}
} //phytodesign pages or not
$smarty->assign("HLEB",$hleb);
?>