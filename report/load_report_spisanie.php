<?

//header("content-type: text/html;charset=utf-8 \r\n");




	$DB_HOST="floren.mysql.ukraine.com.ua";
	$DB_CHARSET='utf8';
	// main base
	$DB_USER='floren_utf2025';
	$DB_PASS='i4d4XB48bV';
	$DB_NAME='floren_utf2025';

$link = mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
if (!$link) {
    die('Не удалось соединиться : ' . mysql_error());
}

// выбираем foo в качестве текущей базы данных
$db_selected = mysql_select_db($DB_NAME, $link);
if (!$db_selected) {
    die ('Не удалось выбрать базу foo: ' . mysql_error());
}
mysql_set_charset($DB_CHARSET, $link);
echo mysql_error();




    libxml_use_internal_errors(true);

    $data_from_1c = array();
    $dom = new DomDocument;
        $dom->loadHTMLFile($_SERVER['DOCUMENT_ROOT']."/images/1c/_SPISANNYa HTML (HTML4).html");
        $corretion_filetype=0;
        $header_row="//tr[@class='R0']";
        $nodes_row="//tr[@class='R2']";
     //   $nodes_row_alter="//tr[@class='R3']";
    
    $xpath = new DomXPath($dom);
    
    $header_row=$xpath->query($header_row);
    foreach ($header_row as $i => $node) {
    	$header_string=$node->nodeValue;
    }
  
    
    $report_month='';
    $months_array =  array("січень"=>'01', "лютий"=>'02', "березень"=>'03', "квітень"=>'04', "травень"=>'05', "червень"=>'06', "липень"=>'07', "серпень"=>'08', "вересень"=>'09', "жовтень"=>'10', "листопад"=>'11', "грудень"=>'12');
    $years_array =  array('2021','2022','2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033','2034','2035');
    foreach($months_array AS $k=>$v){
        //  echo mb_strtolower($header_string)."==".mb_strtolower($k)."=".$v."<br>";
        if(strpos(mb_strtolower($header_string), mb_strtolower($k)))
           $report_month=$v;
    }
    foreach($years_array AS $k=>$v){
        if(strpos(mb_strtolower($header_string), mb_strtolower($v)))
           $report_year=$v;
    }
    echo $report_year.$report_month."<br/>";

//exit();

    $nodes = array($xpath->query($nodes_row)); // if several classes R2, R3
    //  ========== // local version bar code is under 0 on host version bar code is under 1. And everything shifted by 1
    if( $_SERVER['SERVER_NAME'] == 'floren.com.ua'){
        $correction=1;
    }else {
        $correction=0;
    }
    // ==========
    $ii=0;
    foreach($nodes AS $one_node){
    foreach ($one_node as $i => $node) {
        $ii++;
        foreach ($node->childNodes as $i => $chnode) {
        	
            if ($i == 0+$correction) {
            	$bar = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);                
                $data_from_1c[$bar]['barcode']=$bar;
            }

            if ($i == 2+$correction) { 
                $data_from_1c[$bar]['qt'] = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);
            }
            if ($i == 4+$correction-$corretion_filetype) { // was 12
                $gross=(float) str_replace(",",".",preg_replace('/[^0-9,]/', '', $chnode->nodeValue));
                $data_from_1c[$bar]['gross'] = empty($gross) ? '0' :  $gross;
            }
 
            $data_from_1c[$bar]['report_year']=$report_year;
            $data_from_1c[$bar]['report_month']=$report_month;
            $data_from_1c[$bar]['uniqueBarYearMonth']=$bar.$report_year.$report_month;
        }//foreach childNode 
    }//foreach one_node
    }//foreach nodes



    if (count($data_from_1c) > 0) {
        $cnt_goods=0;
        $query="DELETE FROM report_goods_spisanie WHERE report_year='".$report_year."' AND report_month='".$report_month."'";
        //echo "<br><br>";
    	      mysql_query($query);
        foreach($data_from_1c AS $k=>$v){
            if (strlen($v['barcode']) != 13) continue;
            else {
          $query="INSERT INTO report_goods_spisanie (barcode,uniqueBarYearMonth,report_year,report_month,qt,gross) VALUES
                                       ('".$v['barcode']."','".$v['uniqueBarYearMonth']."','".$v['report_year']."','".$v['report_month']."', '".$v['qt']."', '".$v['gross']."')";
          //	echo $query."<br />";
              mysql_query($query);
                $cnt_goods++;
            }
        }
        echo   $sync_text = 'Завантажено списаних товарів: <b>'.$cnt_goods.'</b><br />';
    } else {
        echo '<p class="err">Файл зі списання не не знайдено. Дані не оновлено.</p>';
    }

mysql_close($link);
?>