<?php
error_reporting(E_ALL);
register_shutdown_function('sql_stat');
//setlocale(LC_ALL, 'ru_RU');
// SQL+page stat
$microtime=microtime();
$start_time=substr($microtime,11).'.'.substr($microtime,2,8);

//header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Expires: ".date("D, d M Y H:i:s", time()+86400)." GMT");
header("Cache-Control: max-age=86400, public, must-revalidate"); // HTTP/1.1
header("Vary: User-Agent"); // HTTP/1.1
header("content-type: text/html; charset=utf-8");
header("X-Robots-Tag: llms-txt \r\n");
header("X-Frame-Options: DENY \r\n");
/*
$curFile=$_SERVER['REQUEST_URI'];
$etag = md5_file($curFile);
header("Etag: $etag"); 
header("Cache-Control: max-age=86400, public, must-revalidate");

	if (trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) { 
		header("HTTP/1.1 304 Not Modified"); 
  		exit; 
	} 
*/

require($_SERVER['DOCUMENT_ROOT'] . "/database.php");
require($_SERVER['DOCUMENT_ROOT'] . "/include/floren.class.php");
// require("include/post.php");
require($_SERVER['DOCUMENT_ROOT'] . "/include/telegram.class.php");



function sql_stat() {
	global $db,$dbu,$billing,$_SERVER,$start_time;
	
	$microtime=microtime();
	$end_time=substr($microtime,11).'.'.substr($microtime,2,8);
	$total=$end_time-$start_time;
	
	$page=$_SERVER['REQUEST_URI'];
	$sql_count=$db->sql_count;
	$time_count=$db->sql_time_count;
	if (!isset($_COOKIE['no_counter']))
		$db->query("INSERT INTO page_time_stat SET date_add=UNIX_TIMESTAMP(),page='".$page."',sql_count=".$sql_count.",time_count=".$time_count.",total=".$total);
		

}

$clientIP = isset($_SERVER['HTTP_CLIENT_IP']) 
    ? $_SERVER['HTTP_CLIENT_IP'] 
    : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) 
      ? $_SERVER['HTTP_X_FORWARDED_FOR'] 
      : $_SERVER['REMOTE_ADDR']);

   
      
$spiders=preg_match('/(bot|Bot|AdsBot|Googlebot|Slurp|MSNBOT|UdmSearch|InfoSeek|Yandex|StackRambler|Aport|BigmirSpider|MetaSpider|lunabot)/',@$_SERVER["HTTP_USER_AGENT"]);
session_start();

$_SESSION['spiders']=$spiders;
$country = '';
if (!$spiders) {
	
	if (!isset($_SESSION['ID']) || !$_SESSION['ID']) {
		
		$_SESSION['ID']= session_id();		
		$_SESSION['IP']=$clientIP;
		
		if (isset($_SERVER['HTTP_REFERER'])) {		// Do not know what is that
			$url=parse_url($_SERVER['HTTP_REFERER']);
			if (!preg_match('/(www\.)?floren\.com\.ua/',$url['host'])) $_SESSION['HTTP_REFERER']=@$_SERVER['HTTP_REFERER'];
		}
		/*
		include('SxGeo.php');
		$SxGeo = new SxGeo('SxGeo.dat');
		$country = $SxGeo->getCountry($clientIP);
		*/
		$_SESSION['clientCountry']=$country;
//		$session_id=session_id();

		
		$db->query("INSERT INTO stat_top 
								SET date_add=UNIX_TIMESTAMP(),
								IP='".$clientIP."',
								IPremote='".$_SERVER['REMOTE_ADDR']."',
								sessID='".session_id()."',
								serverContent='".@str_replace("'", "", $_SERVER["HTTP_USER_AGENT"])."',
								referer='".@str_replace("'", "", $_SERVER["HTTP_REFERER"])."',
								spiders='".$spiders."',
								country='".$country."'");
	}else{
	//	echo "0";
	} // if NOT SESSION['ID']
}// if NOT spyder

	
	if (!isset($_SESSION['basket'])) $_SESSION['basket']=array();
	//if (!isset($_SESSION['user'])) $_SESSION['basket']=array();

// стартует индификатор сессии
/*
if(isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/admin') === false && $_SERVER['REQUEST_METHOD'] === 'GET'){
    if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')){
        if(file_exists('seoshield-client/main.php'))
      
        {
            include_once('seoshield-client/main.php');
            if(function_exists('seo_shield_start_cms')){
                seo_shield_start_cms();
            }
            if(function_exists('seo_shield_out_buffer')){
                ob_start('seo_shield_out_buffer');
            }
        }
        
    }
}
*/
/*
if (!$spiders && (!isset($_COOKIE['qms']) || !($_COOKIE['qms']=eregi_replace('[^a-fA-F0-9]','',$_COOKIE['qms'])) || strlen($_COOKIE['qms'])!=32)) {
	mt_srand((double)microtime()*1000000);
	setcookie('qms',md5(uniqid(mt_rand(0,(double)microtime()*1000000))),time()+86400*14,'/'); // 14 суток 
}
*/
//print_r($_COOKIE);


//lets put utm-s to Session to track it in basket
if(isset($_REQUEST['utm_source']) && $_REQUEST['utm_source']!=''){
	$_SESSION['utm_source']=	$_REQUEST['utm_source'];
	$_SESSION['utm_medium']=	$_REQUEST['utm_medium'];
	$_SESSION['utm_campaign']=	$_REQUEST['utm_campaign'];
	$_SESSION['utm_content']=	(isset($_REQUEST['utm_content']) && $_REQUEST['utm_content']!='')?$_REQUEST['utm_content']:'';
	$_SESSION['utm_term']=		(isset($_REQUEST['utm_term']) && $_REQUEST['utm_term']!='')?$_REQUEST['utm_term']:'';
}
if(isset($_REQUEST['srsltid']) && !isset($_REQUEST['utm_source'])){
	$_SESSION['utm_source']=	'google';
	$_SESSION['utm_medium']=	'organic';
	$_SESSION['utm_campaign']=	'srsltid';
	$_SESSION['utm_content']=	'';
	$_SESSION['utm_term']=		'';
}
if(!isset($_SESSION['first_url'])){
	$_SESSION['first_url']=$_SERVER['REQUEST_URI'];
}

// проверка логина пароля

//парсинг урла
$parse_url=parse_url($_SERVER["REQUEST_URI"]);
$path=explode('?',$parse_url['path']);
$path=preg_replace('/[^0-9a-zA-Z\/_*%.-]/','',$path[0]);
$path=preg_replace('/\/$/','',$path);
$path=preg_replace('/^\//','',$path);
$URL=explode('/',$path);

if($URL[0]==''){// index page
		$lang='ua';
		$lang_url='/ua';
		$db_sufix='_ua';
		$hreflang='uk-UA';
}
elseif($URL[0]=='ua' || $URL[0]=='ru'){
	if($URL[0]=='ua') {
		$lang=$URL[0];
		$lang_url='/ua';
		$db_sufix='_ua';
		$hreflang='uk-UA';
		
		
		if(count($URL)==1){	// Redirect old main UA page. floren.com.ua/ua/ to floren.com.ua/
				include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
				header("HTTP/1.0 301 Moved Permanently"); 
				header("Location: /");
				exit();
		}
		
	}
	elseif($URL[0]=='ru') {
		$lang=$URL[0];
		$lang_url='';
		$db_sufix='';
		$hreflang='ru-UA';
			if(count($URL)!=1){	// Redirect old main UA page. floren.com.ua/ua/ to floren.com.ua/
				include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
				header("HTTP/1.0 301 Moved Permanently"); 
				header("Location: https://floren.com.ua".str_replace("/ru","",$_SERVER["REQUEST_URI"]));
				exit();
			}
	}
	else {
	//	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	//	header("Location: /");
	//	exit();
	}
	
	array_shift($URL);
	if(!count($URL)) $URL[0]=''; // index page
} else {
	$lang='ru';
	$lang_url='';
	$db_sufix='';
	$hreflang='ru-UA';
	
}
$_SESSION['lang']=$lang;

//include('include/redirect.php');

$POST=array();
$POST=$_POST;

  foreach ($POST AS $n=>$v) {
    if (is_array($v)) {
      foreach ($v AS $nv=>$vv) $v[$nv]=stripslashes($vv);
      $POST[$n]=$v;
    } else {
      $POST[$n]=stripslashes($v);
	}
  }
//$telegram = new Telegram(file_get_contents("config.json"));


require_once __DIR__ . '/smarty5/libs/Smarty.class.php';
$smarty = new \Smarty\Smarty;
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/smarty5/templates_c/');
$smarty->setCacheDir(__DIR__ . '/smarty5/cache/');
$smarty->setConfigDir(__DIR__ . '/smarty5/src/');
$smarty->muteUndefinedOrNullWarnings(true);
// $smarty->debugging=true;

$smarty->assign('CLIENT_COUNTRY', $_SESSION['clientCountry']);
$smarty->assign('URL',$URL);
$smarty->assign('PATH',$path);
	$lang_selector_link='';
	if($URL[0]=='') {
		$smarty->assign("LANG_SELECTOR_UA", '/');
		$smarty->assign("LANG_SELECTOR_RU", '/ru/');
	}else{
		$lang_selector_link=implode("/",$URL).'/';
		$smarty->assign("LANG_SELECTOR_UA", '/ua/'.$lang_selector_link);
		$smarty->assign("LANG_SELECTOR_RU", '/'.$lang_selector_link);
	}
	


$floren=new florenClass();

//TRANSLATOR
$lingvo_texts=array();
$db->query("SELECT alias, txt_".$lang." FROM lingvo WHERE page='general'");

while($rs_lingvo=$db->fetch()){
	$lingvo[$rs_lingvo['alias']]=$rs_lingvo['txt_'.$lang];
}


///======================

$db->query("SELECT alias, txt_".$lang." FROM lingvo WHERE page='".$URL[0]."'");
while($rs_lingvo_page=$db->fetch()){
	$lingvo[$rs_lingvo_page['alias']]=$rs_lingvo_page['txt_'.$lang];
}



$smarty->assign("LANGURL",$lang_url);
$smarty->assign("DBSUFIX",$db_sufix);
$smarty->assign("LANG",$lang);
$smarty->assign("LINGVO", $lingvo);


$needle = array('utm_', 'sort=', 'gclid=', 'UAH', 'RUR', 'RUR', 'USD', 'srsltid');
foreach ($needle as $k => $v) {
    if (stripos($_SERVER['QUERY_STRING'], $v) !== false) {
        $smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, follow">');
    }
}

if(substr($_SERVER['REQUEST_URI'],0,3)=='/ua'){
	$href_lang_page_ua	=		$_SERVER['REQUEST_URI'];
	$href_lang_page_ru	=		substr($_SERVER['REQUEST_URI'],3);
}elseif($_SERVER['REQUEST_URI']==='/' || $_SERVER['REQUEST_URI']==='/ru/'){
	$href_lang_page_ua	=		'/';
	$href_lang_page_ru	=		'/ru/';
}else {
	$href_lang_page_ua	=		'/ua'.$_SERVER['REQUEST_URI'];
	$href_lang_page_ru	=		$_SERVER['REQUEST_URI'];
}

$final_href_lang_page_ua	=	$href_lang_page_ua;
$final_href_lang_page_ru	=	$href_lang_page_ru;
if(stripos($href_lang_page_ua, "?")>0)	$final_href_lang_page_ua=substr($href_lang_page_ua, 0, stripos($href_lang_page_ua, "?"));
if(stripos($href_lang_page_ru, "?")>0)	$final_href_lang_page_ru=substr($href_lang_page_ru, 0, stripos($href_lang_page_ru, "?"));


$smarty->assign("META_REL_ALTERNATE",'<link rel="alternate" href="https://floren.com.ua'.$final_href_lang_page_ua.'" hreflang="uk-UA" />
	<link rel="alternate" href="https://floren.com.ua'.$final_href_lang_page_ru.'" hreflang="ru-UA" />');

//LEFT menu

$group_sql = '';

if ($URL[0]=='planters') {
	$group_sql = ' AND alias !="planters"';
}


$category_left=array();
$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID=0 AND act='1'".$group_sql." ORDER BY sort DESC,name");


while ($f=$db->fetch()) {
	$category_left[$f['ID']]['name']=$f['name'];
	$category_left[$f['ID']]['alias']=$f['alias'];

	$category_left[$f['ID']]['ID']=$f['ID'];
	$category_left[$f['ID']]['img']=$f['img'];

	$db->query("SELECT gc.* FROM goods".$db_sufix."_class gc WHERE motherID=".$f['ID']." AND act='1' ORDER BY sort DESC",1);

	while ($ff=$db->fetch(1)) {

	//	$category_left[$f['ID']]['category'][]=$ff;
	//	$category_left[count($goods_board_lechuza)-1]['image']
	//	$category_left[$f['ID']]['category']=array();

	$category_left[$f['ID']]['category'][] = $ff;

	$old_aliases = array('lamela-old', 'elho-old', 'ceramic-old', 'beton-old');
	
	if (in_array($ff['alias'], $old_aliases)) {
		$tmp_arr = explode('-', $ff['alias']);
		$category_left[$f['ID']]['category'][count($category_left[$f['ID']]['category'])-1]['cur_alias'] = $tmp_arr[0];
	} else {

		if ($ff['alias'] == 'wood-planters-old') {
			$category_left[$f['ID']]['category'][count($category_left[$f['ID']]['category'])-1]['cur_alias'] = 'wood-planters';
		} else {
			$category_left[$f['ID']]['category'][count($category_left[$f['ID']]['category'])-1]['cur_alias'] = $ff['alias'];
		}
	}

	$category_left[$f['ID']]['category'][count($category_left[$f['ID']]['category'])-1]['name']=$ff['name'];

	}
}

$smarty->assign("CATEGORY_LEFT", $category_left);

//=============================================================

// скрытие счетчиков для особых пользователей по куке
//if (isset($_COOKIE['no_counter']) || $_SERVER['REMOTE_ADDR']=='77.239.179.143') $smarty->assign("NO_COUNTER",true);
if(isset($_REQUEST['nnn'])) {
	mt_srand((double)microtime()*1000000);
	setcookie('no_counter',md5(uniqid(mt_rand(0,(double)microtime()*1000000))),time()+86400*500,'/'); // 14 суток
	//$_SESSION['no_counter']='Y';
	header("location:/");
}
if(isset($_REQUEST['adm'])) {
	mt_srand((double)microtime()*1000000);
	setcookie('is_admin',md5(uniqid(mt_rand(0,(double)microtime()*1000000))),time()+86400*500,'/'); // 14 суток

	header("Location: /");
	exit();
}

if (isset($_COOKIE['is_admin'])) {
	$smarty->assign("IS_ADMIN",true);
}

if (isset($_COOKIE['no_counter']) || isset($_SESSION['no_counter']) || $_SERVER["SERVER_NAME"]=="floren" || $_SERVER['REMOTE_ADDR']=='77.239.179.143')
	$smarty->assign("NO_COUNTER",true);


if ($URL[0] =='florist') {
	$smarty->assign("LEFT_TPL",'left_col.tpl');
}


if (isset($dept) && $dept=='landscape'){
	$smarty->assign("LEFT_TPL",'left_col_landscape.tpl');
} else {
	$smarty->assign("LEFT_TPL",'nav_catalog.tpl');
}
// дерево сайта
function gen_tree($ID,$level) {
	global $db,$URL,$PATH,$TITLE,$param_trim,$script,$COLUMN3,$db_sufix;
	
	if (!($alias=@$URL[$level])) return;
	$db->query("SELECT ID,motherID,alias,name,meta_title,meta_description,meta_keywords,script,content FROM tree".$db_sufix." WHERE motherID=$ID AND alias='$alias' AND act='Y' ORDER BY order_p");
	if (!($row=$db->fetch())) return;
	//$PATH[$row['alias']]=$row;
	$PATH[]=$row;
	if (!$script) $param_trim++;
	$TITLE[]=$row['meta_title'];
	if ($row['script']) {
		$script=$row['script'];
		//return $row;
	}
	$r=gen_tree($row['ID'],$level+1);
	if ($r) return $r;
		else return $row;
}
if (count($URL)==1 && $URL[0]=='sitemap.xml') {
	include_once("exec/sitemap.php");
}
elseif (count($URL)==1 && $URL[0]=='sitemap_ua.xml') {
	include_once("exec/sitemap_ua.php");
}
elseif (count($URL)==1 && $URL[0]=='plants') {
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("Location: /komnatnie-rasteniya/");
	exit();
}
elseif (count($URL)==1 && $URL[0]=='orchids') {
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("Location: /komnatnie-rasteniya/orchids/");
	exit();
}
elseif (count($URL)==1 && $URL[0]=='metal-pots') {
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("Location: /planters/metal-pots/");
	exit();
}
elseif (count($URL)==1 && $URL[0]=='wood-planters') {
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("Location: /planters/wood-planters/");
	exit();
}
elseif ($URL[0]=='florist' && ($URL[1]=='korobki-cvetov' || $URL[1]=='buketi')) {
	header('HTTP/1.0 404 Not Found', true, '404');
	include($_SERVER['DOCUMENT_ROOT']."/404.php");
	exit();
}
/*
elseif (count($URL)==2 && $URL[0]=='services' && $URL[1]=='remont_gazona') {
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("Location: /uhod/remont-gazona/");
	exit();
}

elseif (count($URL)==2 && $URL[0]=='services' && $URL[1]=='garden-care') {
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("Location: /uhod/");
	exit();
}

elseif (count($URL)==2 && $URL[0]=='services' && $URL[1]=='ustroystvo_gazona') {
	include($_SERVER['DOCUMENT_ROOT'].'/include/send_404_email.php');
	header("HTTP/1.0 301 Moved Permanently"); 
	header("Location: /gazon/");
	exit();
}
*/
elseif (count($URL)==1 && ($URL[0]=='404' || $URL[0]=='404.php')) {
	include_once("404.php");
}
elseif (count($URL)==1 && $URL[0]=='gxml.xml') {
	include_once("exec/gxml.php");
}
elseif (count($URL)==1 && $URL[0]=='gmcxml.xml') {
	include_once("exec/gmcxml.php");
}
elseif (count($URL)==1 && $URL[0]=='gmcxml-ua.xml') {
	include_once("exec/gmcxml_ua.php");
}
elseif (count($URL)==1 && $URL[0]=='gmcxml-fb.xml') {
	include_once("exec/gmcxml-fb.php");
}
elseif (count($URL)==1 && $URL[0]=='gmcxml-fb-ua.xml') {
	include_once("exec/gmcxml-fb-ua.php");
}
elseif (count($URL)==1 && $URL[0]=='gmcxml-bouquets.xml') {
	include_once("exec/gmcxml-bouquets.php");
}
elseif (count($URL)==1 && $URL[0]=='gmcxml-bouquets-ua.xml') {
	include_once("exec/gmcxml-bouquets_ua.php");
}
elseif (count($URL)==1 && ($URL[0]=='' || $URL[0]=='indexphp')) {
		include_once("exec/index.php");
} else {
  $param_trim=0;
  $PATH=array();
  $TITLE= array();
  $script='';
  $COLUMN3='';
  $r=gen_tree(0,0);
  $PARAM=array_slice($URL,$param_trim);

	if ($r) {
		$smarty->assign("TITLE",$r['name']);
		$smarty->assign("META_TITLE",$r['meta_title']);
		$smarty->assign("META_DESCRIPTION",$r['meta_description']);
		$smarty->assign("META_KEYWORDS",$r['meta_keywords']);




		if ($script) {
			include_once($script);
		} else {
			
				if($URL[0]=='phytodesign'){
					
					$hleb[0]['link']='/';
					$hleb[0]['name']=$lingvo['main_page'];
					$hleb[1]['link']='';
					$hleb[1]['name']=$lingvo['phytodesign'];
					$smarty->assign("SCHEMA_VIDEODATA_1", getVideoData('mgf72jrA2cY'));
				}else{
					$hleb[0]['link']='/';
					$hleb[0]['name']=$lingvo['main_page'];
					$hleb[1]['link']='';
					$hleb[1]['name']=$r['name'];
				}
			
			$smarty->assign("HLEB",$hleb);	
			$smarty->assign("CONTENT_TPL",'content.tpl');
			$smarty->assign("CONTENT",$r['content']);
			if(isset($PARAM[0])){

				
				//=============404===================
				header('HTTP/1.0 404 Not Found', true, '404');
				include($_SERVER['DOCUMENT_ROOT']."/404.php");
				exit();
				//=============404===================
			}
	    }
    $TITLE=array_reverse($TITLE); // обратная сортировка титлов
    $TITLE=implode(' :: ',$TITLE);
    $smarty->assign("META_TITLE",$TITLE);
  } else {
	header('HTTP/1.0 404 Not Found', true, '404');
	include($_SERVER['DOCUMENT_ROOT']."/404.php");
	exit();
  }
}
$smarty->assign("LAST_WORKS",'last_works.tpl');

// SLIDER

$sliders_options = array();

$db->query("SELECT * FROM sliders");

while($sld_q = $db->fetch()) {

	$sliders_options[$sld_q['slider_id']] = array();
	$sliders_options[$sld_q['slider_id']]['slider'] = $sld_q['alias'];
	$sliders_options[$sld_q['slider_id']]['slider_id'] = $sld_q['slider_id'];
	$sliders_options[$sld_q['slider_id']]['qnt_large'] = $sld_q['qnt_large'];
	$sliders_options[$sld_q['slider_id']]['qnt_medium'] = $sld_q['qnt_medium'];
	$sliders_options[$sld_q['slider_id']]['qnt_small'] = $sld_q['qnt_small'];
	$sliders_options[$sld_q['slider_id']]['qnt_min'] = $sld_q['qnt_min'];
	$sliders_options[$sld_q['slider_id']]['zoom'] = $sld_q['zoom'];
	$sliders_options[$sld_q['slider_id']]['height'] = $sld_q['height'];
	$sliders_options[$sld_q['slider_id']]['visible'] = $sld_q['visible'];
	$sliders_options[$sld_q['slider_id']]['name_ru'] = $sld_q['name_ru'];
	$sliders_options[$sld_q['slider_id']]['name_ua'] = $sld_q['name_ua'];
	$sliders_options[$sld_q['slider_id']]['slides'] = array();
	$sliders_options[$sld_q['slider_id']]['pages'] = array();

};

$db->query("SELECT * FROM sliders s JOIN sliders_pages sp ON s.slider_id=sp.slider_id;");

while($slp_q = $db->fetch()){
	$sliders_options[$slp_q['slider_id']]['pages'][] = $slp_q['page'];
}

foreach ($sliders_options as $so_key => $so_value) {

	$db->query("SELECT * FROM sliders s JOIN sliders_data sp ON s.slider_id=sp.slider_id WHERE s.slider_id='".$so_key."' ORDER BY sp.slide_order"); 
	
	while($sldata_q = $db->fetch()){
		$sliders_options[$so_key]['slides'][] = array(
			'img' => $sldata_q['img'], 
			'link' => $sldata_q['link'],
			'slide_order' => $sldata_q['slide_order'],
			'caption_ru' => $sldata_q['caption_ru'],
			'caption_ua' => $sldata_q['caption_ua']
		);

	}
}

$sliders_options_json = json_encode($sliders_options);

$smarty->assign("SLIDERS_OPTIONS", $sliders_options);
$smarty->assign("SLIDERS_OPTIONS_JSON", $sliders_options_json);

// END SLIDER

//==================COMMON_FUNC============

function MakePrice($p) {
	$p=str_replace(",", ".", $p);
	$p=str_replace("-", "0", $p);
	if ($p=="") return "0.00";
	if ($p*1==0) return "0.00";
	if ($p==round($p)) return ($p*1).".00";
	$p=round($p*100); $last=substr($p, strlen($p)-1, 1); $res=$p;
	$p=$res/100;
	if ($p==round($p)) return $p.".00";
	if (substr($p, strlen($p)-2, 1)==".") return $p."0";
	return $p;
}
if(isset($_POST['add2cart'])){
	foreach($_POST['add2cart'] AS $k=>$v){
		$db->query("SELECT g.ID, g.name, gfs.hgt,gfs.dia, gfs.price
		FROM goods".$db_sufix." g
		LEFT JOIN goods_forms gfs ON g.ID=gfs.goodID
		WHERE gfs.ID='".$k."'");
		$rs=$db->fetch();
		$send_add2cart="";
		$send_add2cart.='<a href="//floren.com.ua'.$lang_url.'/product/'.$rs['ID'].'/">'.$rs['name'].' '.$rs['dia'].'?'.$rs['hgt'].' '.$rs['price'].'</a><br>';
		$send_add2cart.=@$_SESSION['HTTP_REFERER'];
	
	//	$floren->send_email("Dmitriy.Zhinzhikov@gmail.com", "add2cart", $send_add2cart);
		
		if(array_key_exists($k, $_SESSION['basket']))
			$_SESSION['basket'][$k]+=1;
		else
			$_SESSION['basket'][$k]=1;
	}
}
if (isset($_REQUEST['delete_session'])) unset($_SESSION['basket']);

 
//DELETE FROM BASKET
if (isset($_POST['delete_item']) && $_POST['delete_item']!=''){
	unset($_SESSION['basket'][$_POST['delete_item']]);
	header('location:'.$_SERVER["REQUEST_URI"]);
}
//BUILD BASKET

$bsk=array();

if(count($_SESSION['basket'])>0){

	$bsk_stop_post_delivery=0;
	$bsk_big_good_courier=0;
	$bsk_buket_delivery=0;
	$bsk_stop_privat=0;

	$is_bsk_pot = 0;
	$is_bsk_plant = 0;
	$bsk_pot_classes = array(5);
	$bsk_plant_classes = array(3);

	/* START: delivery options from DB */

	$delivery_options = array();

	$db->query("SELECT * FROM options_delivery");

	while($q = $db->fetch()){
		$delivery_options[$q['option_alias']] = $q['option_value'];
	};

	$smarty->assign("DELIVERY_OPTIONS", $delivery_options);

	/* END: delivery options from DB */

	$stop_post_delivery_ids=array();
	$bouquets_categories = array(77);

	$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID IN ('77')");
	
	while($f=$db->fetch()){
		$stop_post_delivery_ids[]=$f['ID'];
	}

	$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID IN ('77')");

	while($f=$db->fetch()){
		$bouquets_categories[]=$f['ID'];
	}

	$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID IN ('5')");

	while($f=$db->fetch()){
		$bsk_pot_classes[] = $f['ID'];
	}

	$db->query("SELECT * FROM goods".$db_sufix."_class WHERE motherID IN ('3')");

	while($f=$db->fetch()){
		$bsk_plant_classes[] = $f['ID'];
	}

	$IDs=implode("','", array_keys($_SESSION['basket']));
	$db->query("SELECT g.ID, g.makerID, g.classID, g.link, g.image, g.name, g.name_alter, gfs.ID AS formID, makerID, gcl.motherID, gfs.hgt, gfs.img, gfs.dia, gfs.wdt, gfs.depth, gfs.ttl, gfs.price,gfs.color, gfs.measure_qt, gmg.unit, gmg.name_ru AS mg_name_ru, gmg.name_ua AS mg_name_ua, gc.name_ru AS color_name_ru, gc.name_ua AS color_name_ua, (g1c.f1_stock+g1c.f2_stock-g1c.rezerv) AS db_1c_availability
		FROM goods".$db_sufix." g
		LEFT JOIN goods_forms gfs ON g.ID=gfs.goodID
		LEFT JOIN goods_class gcl ON g.classID=gcl.ID
		LEFT JOIN goods_measures gmg ON gmg.ID=gfs.measure_id
		LEFT JOIN goods_colors gc ON gfs.color=gc.alias
		LEFT JOIN goods_forms2_1c g21c ON gfs.ID=g21c.fID
		LEFT JOIN goods_1c g1c ON g1c.barcode=g21c.barcode
		WHERE gfs.ID IN ('".$IDs."')");

	$ttl=0;
	while($f=$db->fetch()){
		$cnt=0;

		if(in_array($f['classID'], array('78', '79', '80'))) {
			$bsk[$f['formID']]['href']=$lang_url.'/buket/'.$f['ID'].'/';
		}elseif($f['classID']=='49') {
			$bsk[$f['formID']]['href']=$lang_url.'/compositions/'.$f['link'].'/';
		}else{
			$bsk[$f['formID']]['href']=$lang_url.'/product/'.$f['ID'].'_'.$f['link'].'/';
		}

		$bsk[$f['formID']]['ID']=$f['ID'];
		$bsk[$f['formID']]['classID']=$f['classID'];
		$bsk[$f['formID']]['image']=$f['image'];
		$bsk[$f['formID']]['link']=$f['link'];
		$bsk[$f['formID']]['color']=$f['color'];
		$bsk[$f['formID']]['formID']=$f['formID'];
		$bsk[$f['formID']]['hgt']=$f['hgt'];
		$bsk[$f['formID']]['dia']=$f['dia'];
		
		$bsk[$f['formID']]['wdt']=$f['wdt'];
		$bsk[$f['formID']]['depth']=$f['depth'];
		$bsk[$f['formID']]['measure_qt']=$f['measure_qt'];
		$bsk[$f['formID']]['unit']=$f['unit'];
		$bsk[$f['formID']]['mg_name_ua']=$f['mg_name_ua'];
		$bsk[$f['formID']]['mg_name_ru']=$f['mg_name_ru'];
		$bsk[$f['formID']]['color_name_ru']=$f['color_name_ru'];
		$bsk[$f['formID']]['color_name_ua']=$f['color_name_ua'];
		$bsk[$f['formID']]['ttl']=$f['ttl'];
		$bsk[$f['formID']]['name']=$f['name'];
		$bsk[$f['formID']]['name_alter']=$f['name_alter'];
		$bsk[$f['formID']]['price']=$f['price'];
		$bsk[$f['formID']]['not_available']=0;
		
		$cnt=$bsk[$f['formID']]['cnt']=$_SESSION['basket'][$f['formID']];
		$bsk[$f['formID']]['sttl']=MakePrice($f['price']*$cnt);

		$bsk_img = "/images/ins/s/";

		if ($f['img'] && $f['img'] != '0') {
			$bsk_img .= $f['img'];
		} elseif ($f['color'] && $f['motherID'] !='3') {
			$bsk_img .= $f['link'] . '_' . $f['color'] . '.jpg';
		} else {
			$bsk_img .= $f['image'];
		}
	
		if($f['classID']=='49'){
			$bsk_img="/images/compositions/s/".$f['image'];
		}

		$bsk[$f['formID']]['img']=$bsk_img;

		$stop_post_classes = array(25, 74, 49);

		if(in_array($f['classID'], $bsk_pot_classes)){
			$is_bsk_pot = 1;
		}

		if (in_array($f['classID'], $bsk_plant_classes)) {
			$is_bsk_plant = 1;
		}

		if(in_array($f['classID'], $stop_post_delivery_ids) || in_array($f['classID'], $stop_post_classes)) {
			$bsk_stop_post_delivery=1;
		}

		if ($f['classID']=='71' || ($f['classID']=='31' && $f['makerID']=='7')) {
			$bsk_big_good_courier=1;
		}

		if(($f['classID']=='25') || ($f['motherID']==3 && !$f['db_1c_availability'])){
			$bsk_stop_privat=1;
			$bsk[$f['formID']]['not_available']=1;
		}

		if(in_array($f['classID'], $bouquets_categories)) {
			$bsk_buket_delivery=1;
		}
	
		$ttl+=MakePrice($f['price']*$cnt);
	}

	$smarty->assign("NO_COMMON_INFO", array(25,12,14,26,27,28,29,64));
	$smarty->assign("BSK_TTL", MakePrice($ttl));
	$smarty->assign("BASKET", $bsk);
	$smarty->assign("BSK_STOP_POST_DELIVERY", $bsk_stop_post_delivery);
	$smarty->assign("BSK_STOP_PRIVAT", $bsk_stop_privat);
	$smarty->assign("BSK_BIG_GOOD_COURIER", $bsk_big_good_courier);
	$smarty->assign("BSK_BUKET_DELIVERY", $bsk_buket_delivery);
	$smarty->assign("IS_BSK_POT", $is_bsk_pot);
	$smarty->assign("IS_BSK_PLANT", $is_bsk_plant);

/*
	$gTagPrices=array();
	$gTagIDs=array();
	foreach($bsk AS $k=>$v){
		$gTagPrices[]=$v['price'];
		$gTagIDs[]="\r\n\t\t\t\t\t{'id' : '".$k."', 'google_business_vertical': 'retail'}";
	}
	$gTagPricesStr=implode(",", $gTagPrices);
	$gTagIDsStr=implode(",", $gTagIDs)."\r\n\t\t\t\t";
	$gTag='
	gtag(\'event\', \'add_to_cart\', {';
	$gTag.='
		\'send_to\': \'AW-736148489\',
		\'value\': ['.$gTagPricesStr.'],
		\'items\': ['.$gTagIDsStr.']';

$gTag.='
	});';// gTag
*/
	if($URL[0]=='basket'){
	//	$smarty->assign("GTAG",$gTag);
		$smarty->assign("GTAG",'');
	}
}

if ($URL[0]=="product") {
		$goods_accessories = array();
		$board_cnt = 4;
		$db->query("SELECT *, g.ID AS goodID FROM goods".$db_sufix." g JOIN goods_class gc ON g.classID=gc.ID WHERE gc.motherID=82 ORDER BY RAND() LIMIT ".$board_cnt);
		
		while($gb=$db->fetch()){
			$goods_accessories[]=$gb['goodID'];
		}
	
		$goods_board_comma = implode(",", $goods_accessories);
	
		$db->query("SELECT g.ID, g.classID, g.link, g.name, g.image, min(gf.price) AS min_price, max(gf.price) AS max_price FROM goods".$db_sufix." g
					LEFT JOIN goods_forms gf ON g.ID=gf.goodID
					WHERE g.ID IN (".$goods_board_comma.") AND g.availability=1 AND gf.price > 0
					GROUP BY g.ID");
	
			while($f=$db->fetch()){
				$accessories_final[]=$f;
			}
			
		$smarty->assign("GOODS_BOARD_ACCESSORIES", $accessories_final);
}


// Перелинковка
$goods_board=array();
if($URL[0]=="product" || $URL[0]=="buket"){
	
	if(in_array($classID, array('78', '79', '80', '81'))) $cur_gID=intval($PARAM[0]);
	else $cur_gID=intval(substr($PARAM[0], 0, strpos($PARAM[0], '_')));

	$classID_sql=" AND classID='".$classID."' AND g.availability=1";
	$board_cnt=4;

	$db->query("SELECT DISTINCT ID FROM goods".$db_sufix." g WHERE ID>".$cur_gID.$classID_sql." ORDER BY ID LIMIT ".$board_cnt);

	if(!$db->num_rows()){
		$db->query("SELECT DISTINCT ID FROM goods".$db_sufix." g WHERE 1=1".$classID_sql." ORDER BY ID LIMIT ".$board_cnt);

	}

	while($gb=$db->fetch()){
		$goods_board[]=$gb['ID'];
	}

	
	if(count($goods_board)!=$board_cnt){

		$lim_num=$board_cnt-count($goods_board);
		$db->query("SELECT DISTINCT ID FROM goods".$db_sufix." g WHERE 1=1".$classID_sql." ORDER BY ID LIMIT ".$lim_num);
		while($gb_plus=$db->fetch()){
			$goods_board[]=$gb_plus['ID'];
		}
	}

		if(count($goods_board)==0){
				$db->query("SELECT DISTINCT ID FROM goods".$db_sufix." g WHERE 1=1 AND g.availability=1 ORDER BY RAND() LIMIT 4");
				while($gb_plus=$db->fetch()){
					$goods_board[]=$gb_plus['ID'];
				}
		}

		$goods_board_comma=implode(",", $goods_board);
        
		$db->query("SELECT g.ID, g.classID, g.link, g.name, g.image, min(gf.price) AS min_price, max(gf.price) AS max_price FROM goods".$db_sufix." g
				LEFT JOIN goods_forms gf ON g.ID=gf.goodID
				WHERE g.ID IN (".$goods_board_comma.") AND g.availability=1 AND gf.price > 0
				GROUP BY g.ID");

		while($f=$db->fetch()){
			$goods_board_final[]=$f;
		}

		foreach ($goods_board_final AS $k=>$v){

			if (in_array($v['classID'], array('78', '79', '80'))) {
				$goods_board_final[$k]['new_link']=$lang_url.'/buket/'.$v['ID'].'/';
				
			} else {
				$goods_board_final[$k]['new_link']=$lang_url.'/product/'.$v['ID'].'_'.$v['link'].'/';
			}

		}


	$smarty->assign("GOODS_BOARD", $goods_board_final);

	if($URL[0]!='wedding_bouquet' && $URL[0]!='buket'){

		$db->query("SELECT g.ID, g.classID, g.link, g.name, g.image, min(gf.price) AS min_price, max(gf.price) AS max_price, gf.color FROM goods".$db_sufix." g
					JOIN goods_forms gf	ON g.ID=gf.goodID
					WHERE g.classID=51 AND g.availability=1 AND gf.price > 0 GROUP BY g.ID ORDER BY RAND() LIMIT 2");

		while($f=$db->fetch()){
			$goods_board_lechuza[]=$f;
			$goods_board_lechuza[count($goods_board_lechuza)-1]['image']="/images/ins/s/".$f['image'];
		}

		if($motherClassID==3){
			$goods_board_classID="AND g.classID='31'";
			$goods_board_title_2=array('link'=>$lang_url.'/planters/ceramic/', 'name'=>$lingvo['goods_ceramic']);
		}elseif ($motherClassID==5){
			$goods_board_classID="AND g.classID IN (41, 16, 20)";
			$goods_board_title_2=array('link'=>$lang_url.'/komnatnie-rasteniya/', 'name'=>$lingvo['plants']);
		}else{}
			
		
		$db->query("SELECT g.ID, g.classID,g.makerID, g.link, g.name, g.image, min(gf.price) AS min_price, max(gf.price) AS max_price, gf.color FROM goods".$db_sufix." g
						JOIN goods_forms gf	ON g.ID=gf.goodID
						WHERE 1=1 AND g.availability=1 ".$goods_board_classID." AND gf.price > 0
						GROUP BY g.ID ORDER BY RAND() LIMIT 2");

		while($f=$db->fetch()){
			$goods_board_lechuza[]=$f;

			$goods_board_lechuza[count($goods_board_lechuza)-1]['image']="/images/ins/s/".$f['image'];
		}


		foreach ($goods_board_lechuza AS $k=>$v){

			if (in_array($v['classID'], array('78', '79', '80'))) {
				$goods_board_lechuza[$k]['new_link']=$lang_url.'/buket/'.$v['ID'].'/';
			} else {
				$goods_board_lechuza[$k]['new_link']=$lang_url.'/product/'.$v['ID'].'_'.$v['link'].'/';
			}
		
		}


		$smarty->assign("GOODS_BOARD_LECHUZA", $goods_board_lechuza);
		$smarty->assign("GOODS_BOARD_TITLE_2",$goods_board_title_2);
	}
}

if (isset($dept) && $dept=='landscape'){
	$planters_groups=array(71);
	shuffle($planters_groups);
	$db->query("SELECT gc.name AS group_name, gc.alias AS group_link, g.ID, g.classID, g.link, g.name, g.image, min(gf.price) AS min_price, max(gf.price) AS max_price FROM goods".$db_sufix." g
							JOIN goods".$db_sufix."_class gc ON g.classID=gc.ID AND gc.ID='".$planters_groups[0]."'
							LEFT JOIN goods_forms gf	ON g.ID=gf.goodID
							GROUP BY g.ID
							ORDER BY RAND()
							LIMIT 1");
	$f=$db->fetch();

	if ($f['group_link'] == 'beton-old') {
		$f['group_link'] = 'beton';
	}

	$smarty->assign("GOODS_BOARD_LANDSCAPE", $f);

}
/*
if(isset($_REQUEST['cb_send'])){
	$cb_letter="<b>Обратный звонок</b><br>";
	$cb_letter.="<hr>";
	$cb_letter.="<b>Имя</b>: ".$_POST['cb_name']."<br>";
	$cb_letter.="<b>Телефон</b>: ".$_POST['cb_phone']."<br><br>";
	$cb_letter.="<b>Сообщение</b>: ".$_POST['cb_txt']."<br>";
	$cb_letter.="<hr>";
	$cb_letter.="Откуда пришел: ".$_SESSION['HTTP_REFERER'];
	$cb_letter.="<br>";
	$cb_letter.="IP: ".$_SERVER['REMOTE_ADDR'];
	
	$subject="Обратный звонок";
	if(isset($_REQUEST['cb_topic'])) $subject.=' - '.$_REQUEST['cb_topic'];
	
	$floren->send_email('info@floren.com.ua',$subject,$cb_letter);
	
	
	header('Location: /?FBOK');
	exit();
}
*/




//clients
$clients=array();
$db->query("SELECT * FROM clients ORDER BY RAND() LIMIT 2");
while($rs=$db->fetch()){
	$clients[]=$rs;
}
$smarty->assign("CLIENTSBOT", $clients);

//======================================
function getVideoData($videoID){
		$api_key = 'AIzaSyDaGQJMy8v1XwCSuhc_efqx4iBzGIANkYw';

		$json_result = file_get_contents ("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics,status&id=$videoID&key=$api_key");
		$video_data=json_decode($json_result, true);

		$videoTXT1='<script type="application/ld+json">';
		$videoTXT1.='{';
		$videoTXT1.='"@context": "http://schema.org",';
		$videoTXT1.='"@type": "VideoObject",';
		$videoTXT1.='"contentUrl": "https://youtu.be/'.$videoID.'", ';
		$videoTXT1.='"name": "'.iconv('utf-8','windows-1251', htmlspecialchars($video_data["items"]["0"]["snippet"]["title"])).'",';
		$videoTXT1.='"description": "'.iconv('utf-8','windows-1251', htmlspecialchars($video_data["items"]["0"]["snippet"]["description"])).'",';
		$videoTXT1.='"thumbnailUrl": "'.$video_data["items"]["0"]["snippet"]["thumbnails"]["default"]["url"].'",';
		$videoTXT1.='"encodingFormat": "MP4",';
		$videoTXT1.='"uploadDate": "'.substr($video_data["items"]["0"]["snippet"]["publishedAt"],0,10).'",';
		$videoTXT1.='"duration": "'.$video_data["items"]["0"]["contentDetails"]["duration"].'",';
		$videoTXT1.='"interactionCount": "'.$video_data["items"]["0"]["statistics"]["viewCount"].'"';
		$videoTXT1.='}';
		$videoTXT1.='</script>';
		
		return $videoTXT1;
}
//======================================
if (strpos($_SERVER['REQUEST_URI'],'FBOK')) $smarty->assign("FBOK",true);
//==============================COMMON_FUNC

$smarty->display('main.tpl');


?>
