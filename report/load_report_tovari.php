<?

//header("content-type: text/html;charset=utf-8 \r\n");

require('../database.php');

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
        $db->query("TRUNCATE goods_1c_class");

        foreach($data_from_1c AS $k=>$v){
          //  if (strlen($v['barcode']) != 13) continue;
          //  else {
                $query="INSERT INTO goods_1c_class (barcode,name,className) VALUES
                                       ('".$v['barcode']."','".$v['name']."','".$v['className']."')";
          //  echo "<br />";
                $db->query($query);
                
                $query1="UPDATE report_goods SET className='".$v['className']."' WHERE barcode='".$v['barcode']."'";
                //echo $query1."<br />";
                $db->query($query1, 1);
                
                $cnt_goods++;
          //  }
        }
        echo   $sync_text = 'Завантажено товарів: <b>'.$cnt_goods.'</b><br />';
    } else {
        echo '<p class="err">Файл з товарами не знайдено. Дані не оновлено.</p>';
    }

?>