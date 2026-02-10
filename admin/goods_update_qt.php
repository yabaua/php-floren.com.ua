<?
header("content-type: text/html;charset=utf-8 \r\n");
include("../include/strlib.php");
require('con_mysql.php');

$data_1c = array();

function get_data_from_1c() {

    libxml_use_internal_errors(true);

    $data_from_1c = array();

    $dom = new DomDocument;
    $dom->loadHTMLFile("../images/1c/Zalishki%20tovariv%20v%20rozdribnikh%20tsinakh%20(HTML4).html");
    $xpath = new DomXPath($dom);
    $nodes = $xpath->query("//tr[@class='R2']");

    foreach ($nodes as $i => $node) {

        $isValid = false;
        $bar = '';

        foreach ($node->childNodes as $i => $chnode) {
            if ($i == 0) {
                $bar = $chnode->nodeValue;
                if ($isValid = validate_barcode($bar)) {
                    $data_from_1c[$bar] = array('barcode' => $bar);
                }
            }

            if ($isValid && $i == 2) {
                $data_from_1c[$bar]['name'] = $chnode->nodeValue;
            }

            if ($isValid && $i == 4) {
                $data_from_1c[$bar]['f1_stock'] = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);
            }

            if ($isValid && $i == 8) {
                $data_from_1c[$bar]['f2_stock'] = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);
            }

            if ($isValid && $i == 12) {
                $data_from_1c[$bar]['f3_stock'] = (int) preg_replace('/[^0-9]/', '', $chnode->nodeValue);
            }

            if ($isValid && $i == 18) {
                $price = preg_replace('/[^0-9]/', '', substr($chnode->nodeValue, 0, -3));
                $data_from_1c[$bar]['price'] = empty($price) ? '0' :  $price;
            }

        } 
    }

    return $data_from_1c;
};

function validate_barcode($barcode) {
    return strlen($barcode) == 13 ? true : false;
}

function get_data_from_db() {
    $req = mysql_query("SELECT * FROM goods_forms2_1c");
    $data_db = array();

    while($res = mysql_fetch_array($req)) {
        $data_db[$res['barcode']] = array(
            'fID' => $res['fID'],
            'barcode' => $res['barcode'],
        );
    };

    return $data_db;
}



$data_1c = get_data_from_1c();

if (count($data_1c) > 0) {

    mysql_query("DELETE FROM goods_1c");

    $data_db = get_data_from_db();

    foreach ($data_1c as $key => $value) {

            mysql_query("INSERT INTO goods_1c SET f1_stock='".$value['f1_stock']."', f2_stock='".$value['f2_stock']."', f3_stock='".$value['f3_stock']."', price='".$value['price']."', name='".$value['name']."', barcode='".$key."'");

            if (isset($data_db[$key])) {
                // Обновить цены в привязанных штрихкодах
                // mysql_query("UPDATE goods_forms SET price='".$price."' WHERE ID='".$data_db[$key]['fID']."'");
            }
    }

    // foreach ($data_db as $key => $value) {
        // if (!isset($data_1c[$key])) {

            // Если в привязке есть штрихкод, но в файле с остатками 1с его нет
            // mysql_query("UPDATE goods_forms SET price='0' WHERE ID='".$value['fID']."'");
        // }
    // }
        
    echo 'Данные синхронизированы. ';
} else {
    echo '<p class="err">Файл с остатками товаров не найден. Данные не обновлены.</p>';
}
