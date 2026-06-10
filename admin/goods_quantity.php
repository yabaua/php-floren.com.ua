<?
header("content-type: text/html;charset=utf-8 \r\n");
require("auth.php");
include("../include/strlib.php");

$sync_text = '';
$show_barcodes = true;
$data_1c = array();
$upd_data_1c = array();
$not_in_db = array();
$forms_without_barcodes = array();
$forms_with_barcodes = array();

function get_data_with_binding() {
    global $upd_data_1c, $db;

    $db->query("SELECT *, gfc.barcode AS binded_barcode, g1c.barcode AS barcode FROM goods_1c g1c LEFT JOIN goods_forms2_1c gfc ON g1c.barcode=gfc.barcode", 33);

    while ($res = $db->fetch(33)) {
        $upd_data_1c[] = array(
            'barcode' => $res['barcode'],
            'name' => $res['name'],
            'f1_stock' => $res['f1_stock'],
            'f2_stock' => $res['f2_stock'],
            'f3_stock' => $res['f3_stock'],
            'price' => $res['price'],
            'has_binding' => $res['binded_barcode'] ? 1 : 0,
        );
    } 
}

function get_data_from_1c() {

}; // function

function validate_barcode($barcode) {

}

function get_data_from_db() {
  global $db;
    $db->query("SELECT * FROM goods_forms2_1c", 44);
    $data_db = array();

    while($res = $db->fetch(44)) {
        $data_db[$res['barcode']] = array(
            'fID' => $res['fID'],
            'barcode' => $res['barcode'],
        );
    };

    return $data_db;
}

function get_forms_from_db() {
  global $db;
    $db->query("SELECT gf.ID, g.name, gf.dia, gf.wdt, gf.hgt, gf.depth, gf.measure_qt, gf.measure_id, gm.unit, gf1c.barcode, g1c.name AS name1c
                        FROM goods_ua g 
                        JOIN goods_forms gf ON g.ID=gf.goodID 
                        LEFT JOIN goods_forms2_1c gf1c ON gf.ID=gf1c.fID
                        LEFT JOIN goods_measures gm ON gf.measure_id=gm.ID
                        LEFT JOIN goods_1c g1c ON g1c.barcode=gf1c.barcode", 22);

    while ($res = $db->fetch(22)) {
        $temp_arr[] = array(
            'fID' => $res['ID'],
            'name' => $res['name'],
            'name1c' => isset($res['name1c']) ? $res['name1c'] : '',
            'dia' => $res['dia'],
            'wdt' => $res['wdt'],
            'hgt' => $res['hgt'],
            'depth' => $res['depth'],
            'measure_qt' => $res['measure_qt'],
            'unit' => $res['unit'],
            'barcode' => $res['barcode']
        );
    }
    return $temp_arr;
    
}


if (isset($_REQUEST['not_on_site'])) {

    $data_db = get_data_from_db();
    $db->query("SELECT * from goods_1c");

    while ($f = $db->fetch()) {

        if (!isset($data_db[$f['barcode']])) {
            $not_in_db[$f['barcode']] = array(
                'barcode' => $f['barcode'],
                'name' => $f['name'],
                'f1_stock' => $f['f1_stock'],
                'f2_stock' => $f['f2_stock'],
                'f3_stock' => $f['f3_stock'],
                'price' => $f['price'],
            );
        }
    }
}

if (isset($_REQUEST['show_without_barcodes'])) {
    global $forms_without_barcodes;
    $temp_arr = get_forms_from_db();
    $cnt_items=0;
    foreach($temp_arr AS $k=>$v){
        if($v['name1c']!='')   continue;
        else {
            $forms_with_barcodes[$k]=$v;
            $cnt_items++;
        }
    }
    
}

if (isset($_REQUEST['show_with_barcodes'])) {
    global $forms_with_barcodes;
   
    $temp_arr = get_forms_from_db();
    $cnt_items=0;
    foreach($temp_arr AS $k=>$v){
        if($v['name1c']=='')   continue;
        else {
            $forms_with_barcodes[$k]=$v;
            $cnt_items++;
        } 
    }
}

if (isset($_REQUEST['show_barcodes'])) {
    $show_barcodes = true;
}

if(isset($_REQUEST['category'])) {
    $category = $_REQUEST['category'];
    $show_barcodes = true;

    get_data_with_binding();

} else { 
    $category=0;
}

if (isset($_REQUEST['add_barcode'])) {

    foreach($_REQUEST['barcode'] as $k=>$v){
        if (strlen($v) === 13 && ctype_digit($v)) {
            $db->query("INSERT INTO goods_forms2_1c SET fID='".$k."', barcode='".$v."'");
            if($db->error()){
                echo '<p class="err">Щось пішло не так ('.$db->error().')</p>';
                $db->query("SELECT CONCAT(g.name, ' ', gf.dia, '/', gf.hgt) AS nome, gf.ID, gf1c.fID,gf1c.barcode FROM goods_forms2_1c gf1c
                                LEFT JOIN goods_forms gf ON gf.ID=gf1c.fID
                                LEFT JOIN goods g ON gf.goodID=g.ID
                                WHERE gf1c.barcode='".$v."'", 1);

                $rs_qt=$db->fetch(1);
                if(!$rs_qt['nome'])
                    echo '<p class="err">Сокоріш за все штрикод привязаний до неіснуючого товару</p>';
                else{
                    echo '<p class="err">Цей штрикод привязаний до '.$rs_qt['nome'].'</p>';
                }
                
            }
        } else {
            echo '<p class="err">Штрихкод имеет неверный формат, он должен состоять из 13 цифр</p>';
        }
	}

    get_data_with_binding();
}

if (isset($_REQUEST['remove_barcode'])) {

    if (isset($_REQUEST['barcode'])) {
        foreach($_REQUEST['barcode'] as $k=>$v){
            $db->query("DELETE FROM goods_forms2_1c WHERE fID='".$k."'");
        }
    }
    get_data_with_binding();
}

?>

<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="/admin/ckeditor/ckeditor.js"></script>
		<link rel="stylesheet" type="text/css" href="style_back.css">
        <script src="js/scripts.js" type="text/javascript"></script>
        <style>

            .product {
                position: relative;
                display: flex;
                height: 28px;
            }

            .livesearch.open {
                position: absolute; 
                top: 15px;
                left:0;
                background-color: #fff;
                width: 400px;
                padding: 15px;
                z-index: 100;
                box-shadow: 0 0 14px rgb(0 0 0 / 15%);
                overflow-y: scroll;
            }

            .livesearch li {
                list-style: none;
                padding: 10px 0;
                border-bottom: 1px solid #CEC2B3;
                cursor: pointer;
            }

            .livesearch li:last-child {
                border-bottom: none;
            }

            .btns {
                margin-top: 40px;
            }

            .btns button {
                padding: 4px 10px; 
                color: #FFFFFF; 
                background: #5F1C13; 
                text-decoration: none; 
                border: none; 
                margin-top: 15px;
                cursor: pointer;
            }

            .add {
                background-color: green;
                font-weight: bold;
                color: #fff;
                border: none;
                width: 28px;
                height: 28px;
                font-size: 14px;
            }

            .remove {
                background-color: red;
                font-weight: bold;
                color: #fff;
                border: none;
                width: 28px;
                height: 28px;
                font-size: 14px;
            }

            h1 {
                margin-top: 30px;
            }

            h2 {
                margin-top: 50px;
            }

            .err {
                margin-top: 30px;
                color: red;
                font-size: 20px;
                font-weight: bold;
            }

            tr:nth-child(odd) {
                background-color: #EEE7DF;
            } 

            .filled_barcode {
                display: flex;
                align-items: baseline;
                width: 100%;
            }

            .filled {
                display: flex;
            }

            .filled p {
                flex-grow: 1;
            }

            .input {
                width: 180px;
                margin-right: 4px;
            }

            .filled_barcode p {
                width: 180px;
                margin: 0;
                margin-right: 4px;
                line-height: 28px;
                text-align: center;
            }

            .bar {
                display: flex;
                justify-content: space-around;
            }

            .bar input {
                flex-grow: 1;
            }

        </style>
	</head>

    <body style="margin-left:20px;">

        <h1>Выберите тип действия:</h1>
        <div class="holder menu_buttons">
        <div class="btns">
            <!--
            <form name="f1" method="post" action="goods_quantity.php">
                <button type="submit" value="not_on_site" name="not_on_site">Штрихкоды 1C, не привязанные к товарам на сайте</button>
                <button type="submit" name="show_without_barcodes">Товары на сайте без штрихкодов</button>
                <button type="submit" name="show_with_barcodes">Товары на сайте со штрихкодами</button>
                
                <button type="submit" name="show_barcodes">Привязать штрихкоды к товарам на сайте</button>
            </form>
            -->
            <div class="holder menu_buttons">
              <a href="/admin/goods_quantity.php">Привязать штрихкоды к товарам на сайте</a>
              <a href="/admin/goods_vendor.php">Привязать Поставщиков к товарам на сайте</a>
            </div>
        </div>


        <? if (count($not_in_db) > 0) { ?>

            <h2>Штрихкоды 1C, не привязанные к товарам на сайте:</h2>
            <table border="1" style="border-collapse: collapse;">
                <tr>
                    <th>Штрихкод</th>
                    <th>Название</th>
                    <th>Склад 1, шт</th>
                    <th>Склад 2, шт</th>
                    <th>Склад 3, шт</th>
                    <th>Цена, грн</th>
                </tr>
                <? foreach($not_in_db as $item) { ?>
                    <tr>
                        <td><?=$item['barcode']?></td>
                        <td><?=$item['name']?></td>
                        <td align="center"><?=$item['f1_stock']?></td>
                        <td align="center"><?=$item['f2_stock']?></td>
                        <td align="center"><?=$item['f3_stock']?></td>
                        <td align="center"><?=$item['price']?></td>
                    </tr>
                <?}?>   
            </table>

        <?}?> 

        <? if (count($forms_without_barcodes) > 0) { ?>

            <h2>Товары, которые есть на сайте, но нет в 1С:</h2>
            <p><b>  <?=$cnt_items?></b></p>
            <table border="1" style="border-collapse: collapse;">
                <tr>
                    <th>ID</th>
                    <th>Название на сайте</th>
                    <th>Форма выпуска</th>
                </tr>
                <? foreach($forms_without_barcodes as $item) { ?>
                    <tr>
                        <td align="center"><?=$item['fID']?></td>
                        <td><?=$item['name']?></td>
                        <td align="center">
                            <? if ($item['dia']) {?>Диаметр:<?=$item['dia']?> <?=$item['unit']?><br><?}?>
                            <? if ($item['wdt']) {?>Ширина:<?=$item['wdt']?> <?=$item['unit']?><br><?}?>
                            <? if ($item['wdt']) {?>Глубина:<?=$item['depth']?> <?=$item['unit']?><br><?}?>
                            <? if ($item['hgt']) {?>Высота:<?=$item['hgt']?> <?=$item['unit']?><br><?}?>
                            <? if ($item['measure_qt']) {?><?=$item['measure_qt']?> <?=$item['unit']?><br><?}?>
                        </td>
                    </tr>
                <?}?>   
            </table>
        <?}?>
        
        <? if (count($forms_with_barcodes) > 0) { ?>
            <h2>Товары, которые есть на сайте и имеют привязанный штрихкод 1С</h2>
            <p><b>Всего таких товаров: <?=$cnt_items?></b></p>
            <table border="1" style="border-collapse: collapse;">
                <tr>
                    <th>ID</th>
                    <th>Название на сайте</th>
                    <th>Форма выпуска</th>
                    <th>Название в 1С</th>
                    <th>Штрихкод</th>
                </tr>
                <? foreach($forms_with_barcodes as $item) { ?>
                    <tr>
                        <td align="center"><?=$item['fID']?></td>
                        <td><?=$item['name']?></td>
                        <td align="center">
                            <? if ($item['dia']) {?>Диаметр:<?=$item['dia']?> <?=$item['unit']?><br><?}?>
                            <? if ($item['wdt']) {?>Ширина:<?=$item['wdt']?> <?=$item['unit']?><br><?}?>
                            <? if ($item['wdt']) {?>Глубина:<?=$item['depth']?> <?=$item['unit']?><br><?}?>
                            <? if ($item['hgt']) {?>Высота:<?=$item['hgt']?> <?=$item['unit']?><br><?}?>
                            <? if ($item['measure_qt']) {?><?=$item['measure_qt']?> <?=$item['unit']?><br><?}?>
                        </td>
                        <td><?=$item['name1c']?></td>
                        <td><?=$item['barcode']?></td>
                    </tr>
                <?}?>   
            </table>
        <?}?>

        <? if ($show_barcodes) { ?>

            <h2>Выберите категорию из списка</h2>

            <form name="f1" action="/admin/goods_quantity.php?category=<?=$category?>" method="post">

                <select name="category" id="classes">
                    <option value="0"></option>
                    <? $db->query("SELECT * FROM goods_class WHERE motherID=0");
                    
                    while ($rs=$db->fetch()) {
                        if ($rs['ID']=='25' || $rs['ID']=='49') {
                    ?>
                        <option value="<?=$rs['ID']?>"<?=($category==$rs['ID']?' selected':'')?>>
                            ========(<?=$rs['ID']?>)&nbsp;&nbsp;<?=$rs['name']?>========
                        </option>
                        <? } else { ?>
                            <optgroup label="<?=$rs['name']?>">
                                <? $db->query("SELECT gc.ID, gc.name, COUNT(DISTINCT g.ID) AS c FROM goods_class gc LEFT JOIN goods g ON g.classID=gc.ID WHERE motherID=".$rs['ID']." GROUP BY gc.ID", 11);
                                    while($rs1=$db->fetch(11)){
                                ?>
                                    <option value="<?=$rs1['ID']?>"<?=($category==$rs1['ID']?' selected':'')?>>(<?=$rs1['ID']?>)&nbsp;&nbsp;<?=$rs1['name']?>&nbsp;&nbsp;(<?=$rs1['c']?>)</option>
                                <?}?>
                            </optgroup>
                        <?}?>
                    <?}?>
                    <option value="74"<?=($category==74?' selected':'')?>>
                        ========(74)&nbsp;&nbsp;Композиции со мхом========
                    </option>
                </select>

                <input type="submit" name="go" value="Показать" onclick="if(document.getElementById('classes').value=='0') {alert('Не выбрана рубрика');return false;}">

                <?if ($category) {?>
                
                <h2>Привязать к товарам на сайте штрихкоды из 1С</h2>
                <div style="padding:20px 0">
                    <div style="float:left;margin-right:10px;background:#FBE8E5;width:70px;height:35px;border: 1px solid #cec2b3;">&nbsp;</div>
                    <p align="left">– скриті на сайті</p>
                </div>
                <table width="1200" class="tbl" cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>Название на сайте</th>
                    <th>Форма выпуска</th>
                    <th>Цвет</th>
                    <th>Штрихкод</th>
                    <th>Название в 1C</th>
                    <th>Осн.</th>
                    <th>Ф2</th>
                    <th>Ф3</th>
                </tr>
                <?
                
                $db->query("SELECT g.ID, g.classID, g.name, g.act, gf.ID AS formID, gf.dia, gf.hgt, gf.wdt, gf.wdt, gf.color, gf.depth, gf.measure_qt, gf.measure_id, gf.visibility, gm.unit, gfc.barcode, g1c.name AS name1c, g1c.f1_stock, g1c.f2_stock, g1c.f3_stock
                            FROM goods_ua g
                            LEFT JOIN goods_forms gf ON g.ID=gf.goodID
                            LEFT JOIN goods_forms2_1c gfc ON gf.ID=gfc.fID
                            LEFT JOIN goods_1c g1c ON g1c.barcode=gfc.barcode
                            LEFT JOIN goods_measures gm ON gf.measure_id=gm.ID
                            WHERE classID=".$category."
                            ORDER BY g.name DESC, gf.dia DESC");

                for ($i=0;$rs=$db->fetch();$i++) {
                    $green_border='';
					if(($rs['f1_stock']+$rs['f2_stock']+$rs['f3_stock'])>0 && $rs['visibility']==0)
						$green_border=' style="border:3px solid green"';
                ?>

                <tr<?if ($rs['visibility']!='1'){?> style="background:#FBE8E5"<?}?>>

                    <td><a href="goods_edit.php?ID=<?=$rs['ID']?>&cid=<?=$rs['classID']?>"><?=$rs['formID']?></a></td>
                    <td<?=$green_border?>><?=$rs['name']?> <? if ($rs['act'] != 'Y') {?><span style="color:red">(товар скрыт, на сайте значится как нет в наличии)</span><?}?></td>
                    <td>
                        <? if ($rs['dia']) {?>Диаметр: <b><?=$rs['dia']?> <?=$rs['unit']?></b><br><?}?>
                        <? if ($rs['wdt']) {?>Ширина: <b><?=$rs['wdt']?> <?=$rs['unit']?></b><br><?}?>
                        <? if ($rs['wdt']) {?>Глубина: <b><?=$rs['depth']?> <?=$rs['unit']?></b><br><?}?>
                        <? if ($rs['hgt']) {?>Высота: <b><?=$rs['hgt']?> <?=$rs['unit']?></b><br><?}?>
                        <? if ($rs['measure_qt']) {?><?=$rs['measure_qt']?> <?=$rs['unit']?><br><?}?>
                    </td>

                    <td align="center"><?=$rs['color']?></td>
                    <td class="product" data-id="<?=$rs['formID']?>">
                        <form name="f2" action="/admin/goods_quantity.php?category=<?=$category?>" method="post">

                        <? if ($rs['barcode']) {?>

                            <div class="filled_barcode">
                                <input type="hidden" name="barcode[<?=$rs['formID']?>]" value="<?=$rs['barcode']?>">
                                <div class="bar">
                                    <p><?=$rs['barcode']?></p>
                                    <input class="remove" type="submit" value="x" name="remove_barcode">
                                </div>
                            </div>

                        <?} elseif (!$rs['formID']) {?>
                            <p>Товар не содержит форм выпуска</p>
                        <?} else {?>
                            <div class="bar">
                                <input type="text" class="input"
                                    value="<?=$rs['barcode']?>"
                                    placeholder="Введите название товара"  
                                    name="barcode[<?=$rs['formID']?>]" 
                                    onfocus="init(this.value, <?=$rs['formID']?>);"
                                    oninput="inputHandler(this.value, <?=$rs['formID']?>);">
                                <input class="add" type="submit" value="+" name="add_barcode">
                            </div>
                            <ul class="livesearch"></ul>

                        <?}?>
                        </form>
                    </td>
                    <td><?=$rs['name1c']?> </td>
                    <td align="center"><?=$rs['f1_stock']?></td>
                    <td align="center"><?=$rs['f2_stock']?></td>
                    <td align="center"><?=$rs['f3_stock']?></td>
                </tr>
                <?}?>
                </table>
                <?}?>
            </form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

            <?}?>

            <script>
                let products;
                let parent;
                let currentInput;
                let searchContainer;

                function init(val, fid) {
                    products = <?=json_encode($upd_data_1c, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)?>;
                    parent = document.querySelector(`[data-id="${fid}"]`);
                    currentInput = parent.querySelector('.input');
                    searchContainer = parent.querySelector('.livesearch');
                    searchContainer.addEventListener('click', clickHandler);
                }

                function toggleSearch(open, markup = '') {

                    if (open) {
                        searchContainer.classList.add('open');
                        searchContainer.insertAdjacentHTML('afterbegin', markup);
                    } else {

                        if (searchContainer.classList.contains('open')) {
                            searchContainer.innerHTML = '';
                            searchContainer.classList.remove('open');
                        }
                    }

                }

                function inputHandler(val, fid) {
                    
                    toggleSearch(false);

                    let res = products.filter(pr => pr.name.toLowerCase().includes(val.toLowerCase()));
                    let markup = [];

                    if (res.length > 0) {
                        res.forEach(item => {
                            let binding = item['has_binding'] ? '<span style="color:red">(уже привязан)</span>' : '';
                            let bindind_attr = item['has_binding'] ? 'data-binding="1"' : '';
                            markup.push(`<li ${bindind_attr} id="${item.barcode}">${item.name}, ${item.barcode} ${binding}</li>`);
                        });
                    } else {
                        markup.push(`<li>Товар не найден, попробуйте ввести другое название или штрихкод</li>`);
                        searchContainer.removeEventListener('click', clickHandler);
                    }

                    toggleSearch(true, markup.join(''));
                    searchContainer.addEventListener('click', clickHandler);

                    window.addEventListener('click', (e) => {
                        if (!e.target.closest('.product')) {
                            toggleSearch(false);
                            if (currentInput.value.length !== 13) currentInput.value = '';
                        }
                    });
                }

                function clickHandler({target}) {
                        const barcode = target.id;
                        const hasBinded = target.dataset.binding;

                        if (!barcode || hasBinded) return;

                        currentInput.value = barcode;
                        toggleSearch(false);
                }
            </script>
    </body>
</html>