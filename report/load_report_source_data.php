<?

//header("content-type: text/html;charset=utf-8 \r\n");
require('../database.php');


    $fname2load="/images/1c/_ValoviyPributokDzhereloHTML (HTML4).html";
    if(isset($_REQUEST['month']) && $_REQUEST['month']=='prevmonth')
        $fname2load="/images/1c/_ValoviyPributokDzhereloHTML2 (HTML4).html";

    libxml_use_internal_errors(true);

    $data_from_1c = array();
    $dom = new DomDocument;
        $dom->loadHTMLFile($_SERVER['DOCUMENT_ROOT'].$fname2load);
        $corretion_filetype=0;
        $header_row="//tr[@class='R0']";
        $nodes_row="//tr[@class='R2']";
        $nodes_row_alter="//tr[@class='R3']";
    
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

    $nodes = array($xpath->query($nodes_row), $xpath->query($nodes_row_alter)); // if several classes R2, R3
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
            	$sourceNameFull=str_replace("'","&#700;",trim($chnode->nodeValue));
            	
            	$sourceNVO='';
            	$sourceName=$sourceNameFull;
            	if(substr_count($sourceNameFull, "Існуючий клієнт")) {
            	    $sourceNVO="old";
            	    $sourceName=trim(str_replace("Існуючий клієнт", "",$sourceNameFull));
            	}
            	if(substr_count($sourceNameFull, "Новий клієнт"))  {
            	    $sourceNVO="new";
            	    $sourceName=trim(str_replace("Новий клієнт", "",$sourceNameFull));
            	}
            	$data_from_1c[$sourceNameFull]['sourceNameFull'] = $sourceNameFull;            	
                $data_from_1c[$sourceNameFull]['sourceName'] = $sourceName;
                $data_from_1c[$sourceNameFull]['sourceNameNVO'] = $sourceNVO;
            }

            if ($i == 2+$correction) { 
                $data_from_1c[$sourceNameFull]['qt'] = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);
            }
            if ($i == 4+$correction-$corretion_filetype) { // was 12
                $gross=(float) str_replace(",",".",preg_replace('/[^0-9,]/', '', $chnode->nodeValue));
                $data_from_1c[$sourceNameFull]['gross'] = empty($gross) ? '0' :  $gross;
            }
 
            $data_from_1c[$sourceNameFull]['report_year']=$report_year;
            $data_from_1c[$sourceNameFull]['report_month']=$report_month;
        }//foreach childNode 
    }//foreach one_node
    }//foreach nodes



    if (count($data_from_1c) > 0) {
        $cnt_goods=0;
        $query="DELETE FROM report_source WHERE report_year='".$report_year."' AND report_month='".$report_month."'";
        //echo "<br><br>";
    	  $db->query($query);
        foreach($data_from_1c AS $k=>$v){
          //  if (strlen($v['barcode']) != 13) continue;
          if((substr_count($v['sourceName'],"Замовлення покупця")>0) || !strlen($v['sourceName'])) continue;
          if(substr_count($v['sourceName'],'Итого')>0) continue;
          //  else {
          $query="INSERT INTO report_source (sourceNameFull,sourceName,sourceNameNVO ,report_year,report_month,qt,gross) VALUES
                                       ('".$v['sourceNameFull']."','".$v['sourceName']."','".$v['sourceNameNVO']."','".$v['report_year']."','".$v['report_month']."', '".$v['qt']."', '".$v['gross']."')";
          //	echo "<br />";
              $db->query($query, 1);
                $cnt_goods++;
          //  }
        }
        echo   $sync_text = 'Завантажено джерел: <b>'.$cnt_goods.'</b><br />';
    } else {
        echo '<p class="err">Файл з джерелами замовлень не знайдено. Дані не оновлено.</p>';
    }


?>