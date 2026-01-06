<?php
$TITLE=array();
//=========hleb
$hleb=array();
$hleb[0]['link']='/';
$hleb[0]['name']=$lingvo['main_page'];
//=========hleb

if(isset($PARAM[0])){
	$db->query("SELECT * FROM gallery_list".$db_sufix." WHERE alias='".$PARAM[0]."'");
	if(!$db->num_rows()){
		//=============404===================
		header('HTTP/1.0 404 Not Found', true, '404');
		include($_SERVER['DOCUMENT_ROOT']."/404.php");
		exit();
		//=============404===================
	}
	$gallery=$db->fetch();
	$db->query("SELECT * FROM gallery_item WHERE galleryID='".$gallery['ID']."' ORDER BY gItemOrder DESC");
	while($ff=$db->fetch()){
		$galleryIMG[]=$ff;
	}
	//===============NEXT ITEM============
	$db->query("SELECT * FROM gallery_list".$db_sufix." WHERE galleryOrder<'".$gallery['galleryOrder']."' ORDER BY galleryOrder DESC LIMIT 1");
	if(!$db->num_rows()){
		$db->query("SELECT * FROM gallery_list".$db_sufix." ORDER BY galleryOrder DESC LIMIT 1");
	}
	while($fff=$db->fetch()){
		$galleryNEXT=$fff;
	}
	
	$TITLE[0]=$gallery['meta_title'];
	$smarty->assign("META_DESCRIPTION", $gallery['meta_description']);
	$smarty->assign("META_KEYWORDS", "");
	
	$hleb[1]['link']='/gallery/';
	$hleb[1]['name']='Фотогалерея';
	$hleb[2]['link']='';
	$hleb[2]['name']=$gallery['galleryName'];
	
	$smarty->assign("GALLERY", $gallery);
	$smarty->assign("GALLERY_IMG", $galleryIMG);
	$smarty->assign("GALLERYNEXT", $galleryNEXT);
	$smarty->assign("CONTENT_TPL",'gallery_item.tpl');
}else{

	$db->query("SELECT * FROM tree".$db_sufix." WHERE alias='gallery'");
	$f=$db->fetch();
	$TITLE[0]=$f['meta_title'];
	$smarty->assign("META_DESCRIPTION", $f['meta_description']);
	$smarty->assign("META_KEYWORDS", $f['meta_keywords']);
	
	$hleb[1]['link']='';
	$hleb[1]['name']='Фотогалерея';
	
	$gallery=array();
	$db->query("SELECT * FROM gallery_list".$db_sufix." ORDER BY galleryOrder DESC");
	$private_fd=array(19,20,21);
	while($f=$db->fetch()){
		if(in_array($f['ID'], $private_fd))
			$gallery2[]=$f;
		else
			$gallery1[]=$f;
	}
	$smarty->assign("GALLERY1",$gallery1);
	$smarty->assign("GALLERY2",$gallery2);
	$smarty->assign("CONTENT_TPL",'gallery.tpl');
}

$smarty->assign("HLEB",$hleb);
?>