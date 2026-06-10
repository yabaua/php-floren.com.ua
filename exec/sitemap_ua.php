<?

$life_time=60*5; // 5 ìèíóò

$gz_cache=0;
$gzip_file_cache='cache/sitemap.gz';
if (preg_match('/\.gz$/',$_SERVER['REQUEST_URI'])) {
	$file_cache=$gzip_file_cache;
	$gz_cache=1;
	header('Content-type: application/x-gzip');
} else {
	$file_cache='cache/sitemap.xml';
	header('Content-type: application/xml');
}

if (is_file($file_cache) && filemtime($file_cache)+$life_time>time()) {
	$f=fopen($file_cache,'rb');
	header("Content-Length: ".filesize($file_cache));
	fpassthru($f);
	exit();
} else {
	$is_cache=1;
}

$body='';
$count=0;
function add_body($alias,$time,$freq,$priority) {
	global $body,$_SERVER,$count;
	
	if ($count>50000) exit();
	
	$nn="\r\n";
	if (!$body) $body.=$nn;
	
	if (!trim($freq)) $freq='daily';
	if (!$priority) $priority='0.5';
	
	$body.="<url>".$nn;
	if ($alias==''){
		$new_alias="";
	}else{
		$new_alias="ua/".$alias;
	}
	$body.="<loc>https://floren.com.ua/".$new_alias."</loc>".$nn;
	if ($time) $body.="<lastmod>".gmdate('Y-m-d\TH:i:s',$time)."+00:00</lastmod>".$nn;
	$body.="<changefreq>$freq</changefreq>".$nn;
	$body.="<priority>$priority</priority>".$nn;
	$body.="</url>".$nn;
	$count++;
	if ($count>50000) mail('info@floren.com.ua','SITEMAP OVERFLOW '.$SERVER_NAME,'SITEMAP OVERFLOW '.$SERVER_NAME);
}

$body.='<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">';

$date=time();

// òàáëèöà ñàéòìàï
// ïëîñêèå ñòðàíèöû
add_body('',time(),'always','1.0');

$i=0;
//Ðóáðèêè
add_body('komnatnie-rasteniya/',$date,'weekly', '1');
add_body('komnatnie-rasteniya/page2/',$date,'weekly', '1');
add_body('komnatnie-rasteniya/page3/',$date,'weekly', '1');
add_body('komnatnie-rasteniya/page4/',$date,'weekly', '1');
add_body('komnatnie-rasteniya/page5/',$date,'weekly', '1');
add_body('komnatnie-rasteniya/page6/',$date,'weekly', '1');
add_body('komnatnie-rasteniya/page7/',$date,'weekly', '1');
add_body('komnatnie-rasteniya/page8/',$date,'weekly', '1');
// add_body('lechuza/',$date,'weekly', '1');
add_body('planters/',$date,'weekly', '1');
add_body('services/',$date,'weekly', '1');
add_body('publications/',$date,'weekly', '1');
add_body('sitemap/',$date,'weekly', '1');
add_body('phytodesign/',$date,'weekly', '1');
//add_body('compositions/',$date,'weekly', '1');
add_body('about/',$date,'weekly', '1');
add_body('clients/',$date,'weekly', '1');
add_body('contacts/',$date,'weekly', '1');
add_body('delivery/',$date,'weekly', '1');
add_body('gallery/',$date,'weekly', '1');
add_body('partnership/',$date,'weekly', '1');
add_body('gift-card/',$date,'weekly', '1');



$db->query("SELECT * FROM goods_class WHERE motherID='0' AND alias!=''");
while($f=$db->fetch()) {
	$db->query("SELECT * FROM goods_class WHERE motherID='".$f['ID']."' AND act='1'", 1);
	while($ff=$db->fetch(1)) {
		$i++;

		$old_aliases = array('lamela-old', 'elho-old', 'ceramic-old', 'beton-old');

		if (in_array($ff['alias'], $old_aliases) || $ff['alias'] == 'wood-planters-old') {
			continue;
		}

		if($ff['ID']=='51') continue;//lechuza
		if($f['ID']=='3'){
			add_body('komnatnie-rasteniya/'.$ff['alias'].'/',$date,'weekly', '0.8');
		}
		else
			add_body($f['alias'].'/'.$ff['alias'].'/',$date,'weekly', '0.8');
	}
};

//category filters
$category_left=array();
$db->query("SELECT ID, alias FROM goods_ua_class WHERE motherID=0 AND act='1' ORDER BY sort DESC,name");
while ($f=$db->fetch()) {
	$category_left[$f['ID']]['alias']=$f['alias'];
	$db->query("SELECT gc.ID, gc.alias FROM goods_ua_class gc WHERE motherID=".$f['ID']." AND act='1' ORDER BY sort DESC",1);
	while ($ff=$db->fetch(1)) {
		$category_left[$f['ID']]['category'][]	=	$ff;
	}
}
	foreach($category_left AS $k=>$v){
		$db->query("SELECT * FROM goods_filters_meta WHERE classID='".$k."' AND is_index='1'");
		while($f=$db->fetch()){
			
			add_body($v['alias'].'/'.$f['alias'].'/',$date,'weekly', '0.6');
		}
		if (count($v['category']) > 0) {
	
			foreach($v['category'] AS $kk=>$vv){
	
			$db->query("SELECT * FROM goods_filters_meta WHERE classID='".$vv['ID']."' AND is_index='1'", 2);
			while($ff=$db->fetch(2)){
				add_body($v['alias']."/".$vv['alias']."/".$ff['alias']."/",$date,'weekly', '0.6');
			}
	
		}
	}
	}


$db->query("SELECT * FROM services WHERE act='1'");
while($f=$db->fetch()) {
	add_body('services/'.$f['alias'].'/',$date,'weekly', '0.6');
};
/*
$db->query("SELECT * FROM services_landscape WHERE act='1' ORDER BY ID");
while($f=$db->fetch()) {
	if($f['category']==$f['alias']){
		add_body($f['category'].'/',$date,'weekly', '0.6');	
	}else{
		add_body($f['category'].'/'.$f['alias'].'/',$date,'weekly', '0.6');
	}
};
*/
$db->query("SELECT * FROM gallery_list");
while($f=$db->fetch()) {
	add_body('gallery/'.$f['alias'].'/',$date,'weekly', '0.3');
};
$db->query("SELECT * FROM publications");
while($f=$db->fetch()) {
	add_body('publications/'.$f['alias'].'/',$date,'weekly', '0.3');
};

//Òîâàðû
$db->query("SELECT g.ID, g.link, g.classID, gc.motherID AS mID
						FROM goods g
						JOIN goods_class gc ON g.classID=gc.ID
						WHERE g.act='Y'
						ORDER BY g.classID, g.name");
while ($f=$db->fetch()) {
	$i++;
	if(in_array($f['classID'], array(49))){
	//	add_body('compositions/'.$f['link'].'/',$date,'weekly', '0.8');
		continue;
	}
	elseif($f['classID']=='68' || $f['classID']=='74'){ //wood-planters
		continue;
	}
	elseif(in_array($f['classID'], array(77,78,79,80))){ //buket
		continue;
		//add_body('buket/'.$f['ID'].'/',$date,'weekly', '0.8');
	}
	else{
		add_body('product/'.$f['ID'].'_'.$f['link'].'/',$date,'weekly', '0.8');
	}
	
};

$body.='</urlset>';
//echo $i;

if ($is_cache) {
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
