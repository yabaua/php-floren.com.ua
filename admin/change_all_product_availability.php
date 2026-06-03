<?php
require('con_mysql.php');

function change_availability($name) {

    $req = mysql_query("SELECT * FROM $name");

    while($res = mysql_fetch_array($req)) {

        $prod_req = mysql_query("SELECT g.act, min(NULLIF(gf.price, 0)) AS min_price, max(gf.price) AS max_price FROM $name g LEFT JOIN goods_forms gf ON g.ID=gf.goodID WHERE g.ID=".$res['ID']." AND gf.visibility=1");

        $prod_res = mysql_fetch_array($prod_req);

        $is_active = $prod_res['act'] === 'Y' ? 1 : 0;
        $zero_price = intval($prod_res['min_price']) === 0 && intval($prod_res['max_price']) === 0 ? 1 : 0;

        if (!$is_active || $zero_price) {
            $available = 0;
        } else {
            $available = 1;
        }

         mysql_query("UPDATE $name SET availability=".$available." WHERE ID=".$res['ID']);

    }

}

change_availability('goods');
change_availability('goods_ua');

echo "Значения доступности товаров в каталоге обновлены";