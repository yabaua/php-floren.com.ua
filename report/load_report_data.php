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


    $fname2load="/images/1c/_ValoviyPributokZaNomenklaturoyuHTML2 (HTML4).html";
    if(isset($_REQUEST['month']) && $_REQUEST['month']=='prevmonth')
        $fname2load="/images/1c/_ValoviyPributokZaNomenklaturoyuHTML (HTML4).html";

     
    libxml_use_internal_errors(true);

    $data_from_1c = array();
    $dom = new DomDocument;
        $dom->loadHTMLFile($_SERVER['DOCUMENT_ROOT'].$fname2load);
        $corretion_filetype=0;
        $nodes_row_alter="//tr[@class='R2']";
        $nodes_row="//tr[@class='R3']";
        $header_row="//tr[@class='R0']";
    
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

    $nodes = array($xpath->query($nodes_row), $xpath->query($nodes_row_alter));
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
        $bar = '';
        
        foreach ($node->childNodes as $i => $chnode) {
            if ($i == 0+$correction) { // local version bar code is under 0 on host version bar code is under 1
				
                $bar = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);                
                $data_from_1c[$bar]['barcode']=$bar;

            }
          
            if ($i == 2+$correction) {
            	$className=!strlen($chnode->nodeValue)?'_Головний Екран':str_replace("'","&#700;",trim($chnode->nodeValue));
                $data_from_1c[$bar]['className'] = $className;
            }
            if ($i == 4+$correction) {
                $data_from_1c[$bar]['name'] = str_replace("'","&#700;",trim($chnode->nodeValue));
            }
            if ($i == 6+$correction) { //aslo rezerv if rezerv
                $data_from_1c[$bar]['qt'] = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);
            }
            

            if ($i == 8+$correction-$corretion_filetype) { // was 12
                $gross=(float) str_replace(",",".",preg_replace('/[^0-9,]/', '', $chnode->nodeValue));
                $data_from_1c[$bar]['gross'] = empty($gross) ? '0' :  $gross;
            }
            if ($i == 10+$correction-$corretion_filetype) { // was 12
                $foodcost = (float) str_replace(",",".",preg_replace('/[^0-9,]/', '', $chnode->nodeValue));
                $data_from_1c[$bar]['foodcost'] = empty($foodcost) ? '0' :  $foodcost;
            }
            if ($i == 12+$correction-$corretion_filetype) { // was 12
                $margin = (float) str_replace(",",".",preg_replace('/[^0-9,]/', '', $chnode->nodeValue));
                $data_from_1c[$bar]['margin'] = empty($margin) ? '0' :  $margin;
            }
            if ($i == 14+$correction-$corretion_filetype) { // was 12
                $rentability = (float) str_replace(",",".",preg_replace('/[^0-9,]/', '', $chnode->nodeValue));
                $data_from_1c[$bar]['rentability'] = empty($rentability) ? '0' :  $rentability;
            }

            $data_from_1c[$bar]['report_year']=$report_year;
            $data_from_1c[$bar]['report_month']=$report_month;
            $data_from_1c[$bar]['uniqueBarYearMonth']=$bar.$report_year.$report_month;
            
        }//foreach childNode 
    }//foreach one_node
    }//foreach nodes



    if (count($data_from_1c) > 0) {
        $cnt_goods=0;
        mysql_query("DELETE FROM report_goods WHERE report_year='".$report_year."' AND report_month='".$report_month."'");
    //    echo "DELETE FROM report_goods WHERE report_year='".$report_year.". AND report_month='".$report_month."'";
        foreach($data_from_1c AS $k=>$v){
          //  if (strlen($v['barcode']) != 13) continue;
          //  else {
                $query="INSERT INTO report_goods (barcode,name,className, uniqueBarYearMonth,report_year,report_month,qt,gross,foodcost,margin,rentability) VALUES
                                       ('".$v['barcode']."','".$v['name']."','".$v['className']."','".$v['uniqueBarYearMonth']."','".$v['report_year']."','".$v['report_month']."', '".$v['qt']."', '".$v['gross']."', '".$v['foodcost']."', '".$v['margin']."', '".$v['rentability']."')";
         //   echo "<br />".$query;
                mysql_query($query);
                $cnt_goods++;
          //  }
        }
        echo   $sync_text = 'Завантажено товарів: <b>'.$cnt_goods.'</b><br />';
    } else {
        echo '<p class="err">Файл з продажами товарів не знайдено. Дані не оновлено.</p>';
    }

mysql_close($link);
?>