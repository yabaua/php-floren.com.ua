<?php
header("Content-Type: application/xml; charset=utf-8");
//error_reporting(E_ALL);

$host_xml = "floren.mysql.tools";
$user_xml = "floren_utf2025";
$pass_xml = "i4d4XB48bV";
$db_xml   = "floren_utf2025";

// Подключение
$mysqli = new mysqli($host_xml, $user_xml, $pass_xml, $db_xml);
$mysqli->set_charset("utf8");

if ($mysqli->connect_errno) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

$body='';
$count=0;
$nn="\r\n";
$tt="\t";

function add_body($title,$alias,$gfID,$price,$image,$item_group_id,$hgt=0,$dia=0,$wdt=0) {

	global $body,$_SERVER,$count,$nn,$tt;

	if ($count>50000) exit();
	
	if (!$body) $body.=$nn;
	
	if (!trim(isset($freq))) $freq='daily';
	if (!isset($priority)) $priority='0.5';
	
	$ttl_dia='';
	$ttl_wdt='';
	$ttl_hgt='';
	$ttl_short_dia='';
	$ttl_short_wdt='';
	$ttl_short_hgt='';

  if($dia > 0){
		$ttl_short_dia=" ".$dia."см x";
		$ttl_dia=" ".$dia."см x";
	}

  if($wdt > 0){
		$ttl_short_wdt=" ".$wdt."см x";
		$ttl_wdt=" ".$wdt."см x";
	}

	if($hgt > 0){
		$ttl_short_hgt=" ".$hgt."см";
		$ttl_hgt=" ".$hgt."см";
	}

	$body.="<item>".$nn;
	$body.=$tt."<g:id>".$gfID."</g:id>".$nn;
	$body.=$tt."<g:item_group_id>".$item_group_id."</g:item_group_id>".$nn;
	$body.=$tt."<g:title>" . $title.$ttl_short_dia.$ttl_short_wdt.$ttl_short_hgt . "</g:title>".$nn;
	$body.=$tt."<g:description>Купить ".$title.$ttl_dia.$ttl_wdt.$ttl_hgt." в Киеве с доставкой по Украине</g:description>".$nn;
	$body.=$tt."<g:link>https://floren.com.ua/".$alias."</g:link>".$nn;
	$body.=$tt."<g:condition>new</g:condition>".$nn;
	$body.=$tt."<g:price>".$price." UAH</g:price>".$nn;
	$body.=$tt."<g:availability>in stock</g:availability>".$nn;
	$body.=$tt."<g:image_link>https://floren.com.ua/".$image."</g:image_link>".$nn;
	$body.=$tt."<g:shipping>".$nn;
	$body.=$tt.$tt."	<g:country>UA</g:country>".$nn;
	$body.=$tt.$tt."	<g:service>Standard</g:service>".$nn;
	$body.=$tt.$tt."<g:price>200 UAH</g:price>".$nn;
	$body.=$tt."</g:shipping>".$nn;
	$body.="</item>".$nn;
	$count++;
	if ($count>50000) mail('info@floren.com.ua','SITEMAP OVERFLOW '.$SERVER_NAME,'SITEMAP OVERFLOW '.$SERVER_NAME);
}

$body.='<?xml version="1.0"?>'.$nn;
$body.='<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">'.$nn;
$body.='<channel>'.$nn;
$body.=$tt.'<title>Флорен - студия фитодизайна</title>'.$nn;
$body.=$tt.'<link>https://floren.com.ua</link>'.$nn;
$body.=$tt.'<description>Озеленение интерьера, продажа комнатных растений, горшков и кашпо</description>'.$nn;

$i=0;

//Lechuza

function ch_title($ttl) {
	global $mysqli;
	$qr = $mysqli->query("SELECT * FROM goods_colors WHERE alias='".$ttl."'");
	$cls = $qr->fetch_assoc();
	$n_ttl = $cls['name_ru'];
	return $n_ttl;
}





//=========== PLANTS	=============



//82 – inventar
//77 – bouquets
$exclude_arr_alias = array('moss-decor', 'new-year', 'rasteniya', 'vase', 'metal-pots');
$exclude_arr_idds = array (77, 82);

$exclude_mother_cats = implode("','", $exclude_arr_idds);
$exclude_cats = implode("','", $exclude_arr_alias);

$qr = $mysqli->query("SELECT g.ID, g.link, g.classID, g.meta_description, g.name AS title, g.image, g.image_gmcxml, gf.image_gmcxml AS fid_xml, gf.ID AS gfID, gf.price, gf.color, gf.hgt, gf.dia, gf.wdt,(g1c.f1_stock+g1c.f2_stock-g1c.rezerv) AS db_1c_availability
FROM goods g
JOIN goods_class gc ON g.classID=gc.ID
JOIN goods_forms gf ON gf.goodID=g.ID
		LEFT JOIN goods_forms2_1c g21c ON gf.ID=g21c.fID
		LEFT JOIN goods_1c g1c ON g1c.barcode=g21c.barcode
WHERE gf.price>0 AND g.availability=1 AND gf.visibility!=0
		#AND gc.alias NOT IN ('".$exclude_cats."')
		AND gc.motherID NOT IN ('".$exclude_mother_cats."')
ORDER BY g.ID
		#, db_1c_availability > 0 DESC, gf.price DESC, gf.color DESC
		");



$fids = array();
$prevID=0;
while ($f=$qr->fetch_assoc()) {

	$i++;
	$curID = $f['ID'];
	$f_link = '';
	$f_color = $f['color'] != '0' ? " ".ch_title($f['color']) : '';

	$title = str_replace('&', '', $f['title']);

	if($f['classID']=='49')
		continue;
		//$f_link='compositions/'.$f['link'].'/';
	else{
		if($prevID!=$curID){
			$f_link='product/'.$f['ID'].'_'.$f['link'].'/';
		}else{
			$f_link='product/'.$f['ID'].'_'.$f['link'].'/'.$f['gfID'].'/';
		}
	}
	$prevID=$curID;
	if ($f['fid_xml'] != '') {

		$image='images/ins/b/'.$f['fid_xml'];

		if ($f['color'] != '0') {
			add_body($title.$f_color, $f_link, $f['gfID'], $f['price'], $image, $f['ID'], $f['hgt'], $f['dia'], $f['wdt']);
		} else {
			add_body($title, $f_link, $f['gfID'], $f['price'], $image, $f['ID'], $f['hgt'], $f['dia'], $f['wdt']);
		}

	} else {

		if ($f['image_gmcxml']!='') {
			$image='images/ins/b/'.$f['image_gmcxml'];
		} else{
			$image='images/ins/s/'.$f['image'];
		}
		add_body($title.$f_color, $f_link, $f['gfID'], $f['price'] ,$image, $f['ID'], $f['hgt'], $f['dia'], $f['wdt']);
	}
	
	if($f['ID']=='468') $image='images/ins/s/ficus-robusta-lechuza-cubico-40.jpg';
	if($f['ID']=='443') $image='images/ins/s/dracena-white-stripes-lechuza-cararo.jpg';
	

}

$body.='</channel>';
$body.='</rss>';
//echo $i;

if (!empty($is_cache)) {
  if ($gz_cache) {
    $tmpf=uniqid("/tmp/sitemap");
    $f=@fopen($tmpf,'w');
    if ($f) {
      fwrite($f,$body);
      fclose($f);
      exec("gzip -c $tmpf > $gzip_file_cache");
      unlink($tmpf);
      chmod($gzip_file_cache,0777);

      $f=fopen($gzip_file_cache,'rb');
      header("Content-Length: ".filesize($gzip_file_cache));
      fpassthru($f);
    }
    exit();
  } else {
    $f=@fopen($file_cache,'w');
    if ($f) {
      fwrite($f,$body);
      fclose($f);
      chmod($file_cache,0777);
    }
  }
}

echo $body;

exit();

?>
