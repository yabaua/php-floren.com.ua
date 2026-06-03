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
        $dom->loadHTMLFile($_SERVER['DOCUMENT_ROOT']."/images/1c/Zalishki Grupa (HTML4).html");
        $corretion_filetype=0;
        $nodes_row="//tr[@class='R2']";
        $nodes_row_alter="//tr[@class='R2']";
        $header_row="//tr[@class='R0']";
    
    $xpath = new DomXPath($dom);
    
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
                $data_from_1c[$bar]['name'] = str_replace("'","&#700;",trim($chnode->nodeValue));
            }
            if ($i == 4+$correction) {
            	$className=!strlen($chnode->nodeValue)?'Головний Екран':str_replace("'","&#700;",trim($chnode->nodeValue));
                $data_from_1c[$bar]['className'] = $className;
            }

            
        }//foreach childNode 
    }//foreach one_node
    }//foreach nodes



    if (count($data_from_1c) > 0) {
        $cnt_goods=0;
        mysql_query("TRUNCATE goods_1c_class");

        foreach($data_from_1c AS $k=>$v){
          //  if (strlen($v['barcode']) != 13) continue;
          //  else {
                $query="INSERT INTO goods_1c_class (barcode,name,className) VALUES
                                       ('".$v['barcode']."','".$v['name']."','".$v['className']."')";
          //  echo "<br />";
                mysql_query($query);
                
                $query1="UPDATE report_goods SET className='".$v['className']."' WHERE barcode='".$v['barcode']."'";
                //echo $query1."<br />";
                mysql_query($query1);
                
                $cnt_goods++;
          //  }
        }
        echo   $sync_text = 'Завантажено товарів: <b>'.$cnt_goods.'</b><br />';
    } else {
        echo '<p class="err">Файл з товарами не знайдено. Дані не оновлено.</p>';
    }

mysql_close($link);
?>