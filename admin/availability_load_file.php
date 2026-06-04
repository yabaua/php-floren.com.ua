<?
header("content-type: text/html;charset=utf-8 \r\n");
require('../database.php');


function get_data_from_1c($filetype) {
  global $db;

    libxml_use_internal_errors(true);

    $data_from_1c = array();

    $dom = new DomDocument;
    if($filetype=="ostatki"){
        $dom->loadHTMLFile($_SERVER['DOCUMENT_ROOT']."/images/1c/_Zalishki utch 0 (HTML4).html");
        $corretion_filetype=0;
        $nodes_txt="//tr[@class='R2']";
    }
    if($filetype=="price"){
        $dom->loadHTMLFile($_SERVER['DOCUMENT_ROOT']."/images/1c/Zalishki tovariv v rozdribnikh tsinakh (HTML4).html");
        $corretion_filetype=10;  // 24.06.14 was 4
        $nodes_txt="//tr[@class='R3']";
    }
    if($filetype=="rezerv"){
        $dom->loadHTMLFile($_SERVER['DOCUMENT_ROOT']."/images/1c/Zalishki Artikul Rezerv (HTML4).html");
        $corretion_filetype=5;
        $nodes_txt="//tr[@class='R1']";
    }
    
    // =======WHEN STOCK UPDATED
    $_1c_file_updated_at    = filectime($_SERVER['DOCUMENT_ROOT']."/images/1c/Zalishki tovariv v rozdribnikh tsinakh (HTML4).html");
    $db->query("UPDATE admins SET 1c_file_updated_at='".$_1c_file_updated_at."' WHERE login='adm'");
    $db->query("UPDATE admins SET www_stock_updated_at='".time()."' WHERE login='adm'");
    // =======END WHEN STOCK UPDATED
    
    $xpath = new DomXPath($dom);
    
    
    $nodes = $xpath->query($nodes_txt);
    //  ========== // local version bar code is under 0 on host version bar code is under 1. And everything shifted by 1
    if( $_SERVER['SERVER_NAME'] == 'floren.com.ua'){
        $correction=1;
    }else {
        $correction=0;
    }
    // ==========

    foreach ($nodes as $i => $node) {
        
        $isValid = false;
        $bar = '';
        foreach ($node->childNodes as $i => $chnode) {
            if ($i == 0+$correction) { // local version bar code is under 0 on host version bar code is under 1
				
                $bar = $chnode->nodeValue;

                if (validate_barcode($bar)) {
                    $data_from_1c[$bar] = array('barcode' => $bar);
                    $isValid = true;
                    
                }  
            }

            if ($isValid && $i == 2+$correction) {
                $data_from_1c[$bar]['name'] = $chnode->nodeValue;
            }

            if ($isValid && $i == 4+$correction) { //aslo rezerv if rezerv
                $data_from_1c[$bar]['f1_stock'] = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);
            }

            if ($isValid && $i == 16+$correction-$corretion_filetype) { // was 12
                $data_from_1c[$bar]['f2_stock'] = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);
            }

            if ($isValid && $i == 26+$correction-$corretion_filetype*2) { // was 18 
                $price = preg_replace('/[^0-9]/', '', substr($chnode->nodeValue, 0, -3));
                $data_from_1c[$bar]['price'] = empty($price) ? '0' :  $price;
            }
            //rezerv
            if ($isValid && $i == 4+$correction && $filetype=="rezerv") { //aslo rezerv if rezerv
                $data_from_1c[$bar]['rezerv'] = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);
            }
            
            
        } //foreach nodes
    }//foreach childNode

    return $data_from_1c;
  
}; // function

function validate_barcode($barcode) {
    return strlen($barcode) == 13 ? true : false;
}

$microtime=microtime();
$start_time=substr($microtime,11).'.'.substr($microtime,2,8);

    $data_1c = get_data_from_1c('ostatki');

    if (count($data_1c) > 0) {
        $cnt_ostatki=0;
//echo "1";
        $db->query("TRUNCATE goods_1c");
        foreach ($data_1c as $key => $value) {
            $temp_arr[]="('".$key."', '".str_replace("'","&#700;",$value['name'])."', '".$value['f1_stock']."','".$value['f2_stock']."','".round($value['price'])."')";
            
            $cnt_ostatki++ ;
        }
        $temp_arr2=array_chunk($temp_arr, 200);
        foreach($temp_arr2 AS $v){
            $db->query("INSERT INTO goods_1c (barcode,name,f1_stock,f2_stock,price)
                                        VALUES ".implode(",", $v));
        }
        /*
                $db->query("INSERT INTO goods_1c (barcode,name,f1_stock,f2_stock,price)
                                        VALUES('".$key."', '".str_replace("'","&#700;",$value['name'])."', '".$value['f1_stock']."','".$value['f2_stock']."','".round($value['price'])."')");
         */  
            
        
        echo   $sync_text = 'Залишки синхронізовані. Завантажено товарів: <b>'.$cnt_ostatki.'</b><br />';
    } else {
        echo '<p class="err">Файл с остатками товаров не найден. Данные не обновлены.</p>';
    }
    
//=============
$microtime=microtime();
$end_ostatki_time=substr($microtime,11).'.'.substr($microtime,2,8);
echo "Оновлено за: <b>".$ostatki_time   =   round(($end_ostatki_time-$start_time), 3)."</b>";
echo " сек.<br />";
//=============

    $data_1c_price = get_data_from_1c('price');

    if (count($data_1c_price) > 0) {

        $cnt_price=0;
        foreach ($data_1c_price as $key => $value) {
        //    print_r($value);
        //   echo "<br />";
            if($value['price']>0){
                $db->query("UPDATE goods_1c SET price='".round($value['price'])."' WHERE barcode='".$key."'");
            //    echo "UPDATE goods_1c SET price='".$value['price']."' WHERE barcode='".$key."'<br />";
                $cnt_price++;
            }
                						
        }
        echo   $sync_text = 'Ціни синхронізовані. Оновлено позицій <b>'.$cnt_price.'</b><br />';
    } else {
        echo '<p class="err">Файл з цінами товаров не найден. Данные не обновлены.</p>';
    }
//=============
$microtime=microtime();
$end_price_time=substr($microtime,11).'.'.substr($microtime,2,8);
echo "Оновлено за: <b>".$price_time   =   round(($end_price_time-$end_ostatki_time), 3)."</b>";
echo " сек.<br />";
//=============


    
    $data_1c_rezerv = get_data_from_1c('rezerv');
    if (count($data_1c_rezerv) > 0) {
        $cnt_rezerv=0;
//echo "3";
        $db->query("UPDATE goods_1c SET rezerv='0'");
        foreach ($data_1c_rezerv as $key => $value) {
            
            if($value['rezerv']>0){
                $qr=$db->query("UPDATE goods_1c SET rezerv='".$value['rezerv']."' WHERE barcode='".$key."'", 1);
            }
            $cnt_rezerv++;      						
        }
        echo   $sync_text = 'Резерви синхронізовані. Оновлено позицій: <b>'.$cnt_rezerv.'</b><br />';
    } else {
        echo '<p class="err">Файл с резервами не найден. Данные не обновлены.</p>';
    }
    
    
//=============
$microtime=microtime();
$end_rezerv_time=substr($microtime,11).'.'.substr($microtime,2,8);
echo "Оновлено за: <b>".$rezerv_time   =   round(($end_rezerv_time-$end_price_time), 3)."</b>";
echo " сек.<br />";
//=============

//================SYNCHRONIZE PRICES from 1C to site ====================

$rs_isPlant=array();
$qr_isPlant=$db->query("SELECT gf.ID AS IDD FROM goods g
                    JOIN goods_forms gf ON gf.goodID=g.ID
                    JOIN goods_class gc ON g.classID=gc.ID
                    WHERE gc.motherID=3");
while($rsp=$db->fetch()){
    $rs_isPlant[]=$rsp['IDD'];
}

//print_r($rs_isPlant);
$db->query("SELECT fID, g1c.price AS newprice FROM goods_forms2_1c g21c
JOIN goods_1c g1c ON g1c.barcode=g21c.barcode
WHERE g1c.price>0");


while($rs_price=$db->fetch()){
    //if(in_array($rs_price['fID'], $rs_isPlant)){
    //    echo "UPDATE goods_forms SET price='".$rs_price['newprice']."' WHERE ID='".$rs_price['fID']."'<br />";
        $db->query("UPDATE goods_forms SET price='".$rs_price['newprice']."' WHERE ID='".$rs_price['fID']."'", 1); 
    //}else{
       
    //}
}

//=============
$microtime=microtime();
$end_data2www_time=substr($microtime,11).'.'.substr($microtime,2,8);
echo "Дані завантажено на сайт за: <b>".$data2www_time   =   round(($end_data2www_time-$end_rezerv_time), 3)."</b>";
echo " сек.<br />";
//=============

//================UPDATE AVAILABILITY IN goods table // ONLY PLANTS ============================


//It updates good availability not good forms

$db->query("SELECT g.ID, max(g1c.f1_stock+g1c.f2_stock-g1c.rezerv) AS db_1c_availability
								FROM goods_forms gf
								JOIN goods g ON g.ID=gf.goodID
								JOIN goods_class gc ON gc.ID=g.classID
								JOIN goods_forms2_1c g21c ON gf.ID=g21c.fID
								JOIN goods_1c g1c ON g1c.barcode=g21c.barcode
								WHERE gc.motherID=3
								GROUP BY g.ID");
while($rs_avail=$db->fetch()){
    $xx=(max(0, $rs_avail['db_1c_availability'])>0)?1:0;
    $db->query("UPDATE goods SET availability='".$xx."' WHERE ID='".$rs_avail['ID']."'", 1);
    $db->query("UPDATE goods_ua SET availability='".$xx."' WHERE ID='".$rs_avail['ID']."'", 2);
}



$db->query("SELECT gf.ID, price, old_price FROM goods_forms gf
                                JOIN goods g ON g.ID=gf.goodID
                                JOIN goods_class gc ON g.classID=gc.ID
                                WHERE gf.old_price>0 AND g.classID=51");
$cnd_bf=0;
while($rs_black_friday=$db->fetch()){
    
    //$new_price=floor($rs_black_friday['price']*0.9);
    //mysql_query("UPDATE goods_forms SET old_price='".$rs_black_friday['price']."', price='".$new_price."' WHERE ID='".$rs_black_friday['ID']."'");
    
    $db->query("UPDATE goods_forms SET old_price='0', price='".$rs_black_friday['old_price']."' WHERE ID='".$rs_black_friday['ID']."'", 1);
    
    $cnd_bf++;
}
echo "Знижка установилась на ".$cnd_bf." товара";



//=============
$microtime=microtime();
$end_avail_time=substr($microtime,11).'.'.substr($microtime,2,8);
echo "<br />Оновлено доступність товару за: <b>".$avail_time=round(($end_avail_time-$end_data2www_time), 3)."</b>";
echo " сек.<br />";
//=============

// ================== UPDATE VENDORS STOCK
$cnd_vendor=0;
$db->query("SELECT v21c.our_barcode, v.stock1, v.stock2, v.stock3 FROM vendors_lechuza v
  JOIN vendors_2_1c v21c ON v.articul=v21c.vendor_articul");
  while($rs=$db->fetch()){
    mysql_query("UPDATE goods_1c SET vendor_1day_stock='".$rs['stock1']."', vendor_3day_stock='".($rs['stock2']+$rs['stock3'])."' WHERE barcode='".$rs['our_barcode']."'", 1);
    $cnd_vendor++;
  }
//=============
echo "Оновлено наявність у постачальника на <b>".$cnd_vendor."</b> товара";
$microtime=microtime();
$end_vendor_time=substr($microtime,11).'.'.substr($microtime,2,8);
echo "Оновлено наявність у постачальника за: <b>".$vendor_time=round(($end_vendor_time-$end_avail_time), 3)."</b>";
echo " сек.<br />";
//=============
		
echo "<br />Усього завантеження зайняло <b>".round(($end_vendor_time-$start_time), 3)."</b> сек.<br />";					
//}
?>