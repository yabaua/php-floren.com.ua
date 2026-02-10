<?
header("content-type: text/html;charset=utf-8 \r\n");
require("auth.php");
include("../include/strlib.php");

$sync_text = '';
$show_barcodes = false;
$data_1c = array();
$upd_data_1c = array();
$not_in_db = array();
$forms_without_barcodes = array();
$forms_with_barcodes = array();


	$all_cls = mysql_query("SELECT * FROM goods_colors");
	$colors = array();

	while ($all_cls_res = mysql_fetch_array($all_cls)) {
			$colors[$all_cls_res['alias']] = $all_cls_res['name_ua'];
	}

function measureTtl($dia=0, $wdt=0, $depth=0, $hgt){
          $form_measure = '';
          if ($dia) {
						$form_measure = $form_measure . $dia;
					}
					if ($wdt) {
						$form_measure = $form_measure . $wdt;
					}
					if ($depth) {
						$form_measure = $depth ? $form_measure . 'x' . $depth : $form_measure . $depth;
					}
					if ($hgt) {
						$form_measure = $dia ? $form_measure . ', висота: ' . $hgt : $form_measure . 'см, висота: ' . $hgt;
					}				
				$form_measure = $form_measure . 'см.';
				
				return $form_measure;
}

function get_data_with_binding() {
    global $upd_data_1c;
    global $colors;

    $q = mysql_query("SELECT  gf.ID AS formID, g.ID AS goodID, g.name, gf.dia, gf.wdt, gf.depth, gf.hgt, gf.color, v2fID.our_formID AS binded_formID FROM goods_forms gf JOIN goods g ON g.ID=gf.goodID LEFT JOIN vendors_2_fID v2fID ON gf.ID=v2fID.our_formID");

    while ($res = mysql_fetch_array($q, MYSQL_ASSOC)) {
        $upd_data_1c[$res['formID']] = array(
            'formID' => $res['formID'],
            'name' => $res['name'] . ' ' . measureTtl($res['dia'], $res['wdt'], $res['depth'], $res['hgt']) . ($res['color'] ? ' ' . $colors[$res['color']] : ''),
            'has_binding' => $res['binded_formID'] ? 1 : 0,
        );
    } 
}

    $show_barcodes = true;

    get_data_with_binding();



if (isset($_REQUEST['add_barcode'])) {

    foreach($_REQUEST['our_formID'] as $k=>$v){
            mysql_query("DELETE FROM vendors_2_1c WHERE vendor_articul='".$k."' AND vendorID='33'");
            $query =  "INSERT INTO vendors_2_fID SET vendor_articul='".$k."', our_formID='".$v."', vendorID='33'";
            mysql_query($query);
	}

    get_data_with_binding();
}

if (isset($_REQUEST['remove_barcode'])) {

    if (isset($_REQUEST['barcode'])) {
        foreach($_REQUEST['barcode'] as $k=>$v){
            mysql_query("DELETE FROM vendors2_fID WHERE our_formID='".$k."'");
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

            <h2>Выберите категорию из списка</h2>

            <form name="f1" action="/admin/goods_vendors.php" method="post">

                
                <h2>Привязать Поставщика к товарам из 1С</h2>
                <div style="padding:20px 0">
                    <div style="float:left;margin-right:10px;background:#FBE8E5;width:70px;height:35px;border: 1px solid #cec2b3;">&nbsp;</div>
                    <p align="left">– скриті на сайті</p>
                </div>
                <table width="1200" class="tbl" cellspacing="0">
                <tr>
                    <th>Название gjcnfdobrf</th>
                    <th>Артикул поставщика</th>
                    <th>Штрихкод</th>
                    <th>Название в 1C</th>
                    <th>Скл 1.</th>
                    <th>Скл 2.</th>
                    <th>Скл 3.</th>
                </tr>
                <? 
                $qr = mysql_query("SELECT v.name, v.articul, v2fID.our_formID, v.stock1, v.stock2, v.stock3, gf.ID AS formID, g.name AS gname, gf.dia, gf.wdt, gf.depth, gf.hgt, gf.color
                                  FROM vendors_lechuza v
                                  LEFT JOIN vendors_2_fID v2fID ON v.articul=v2fID.vendor_articul
                                  LEFT JOIN goods_forms gf ON gf.ID=v2fID.our_formID
                                  LEFT JOIN goods g ON gf.goodID=g.ID");

                for ($i=0;$rs=mysql_fetch_array($qr);$i++) {
                ?>

                <tr>

                    
                    <td><?=$rs['name']?></td>
                    <td align="center"><?=$rs['articul']?></td>
                    <td class="product" data-id="<?=$rs['articul']?>">
                        <form name="f2" action="/admin/goods_vendor.php" method="post">

                        <? if ($rs['our_formID']) {?>

                            <div class="filled_barcode">
                                <input type="hidden" name="barcode[<?=$rs['articul']?>]" value="<?=$rs['our_barcode']?>">
                                <div class="bar">
                                    <p><?=$rs['our_formID']?></p>
                                    <input class="remove" type="submit" value="x" name="remove_barcode">
                                </div>
                            </div>

                        <?} else {?>
                            <div class="bar">
                                <input type="text" class="input"
                                    value="<?=$rs['our_formID']?>"
                                    placeholder="Введите название товара"  
                                    name="our_formID[<?=$rs['articul']?>]" 
                                    onfocus="init(this.value, <?=$rs['articul']?>);"
                                    oninput="inputHandler(this.value, <?=$rs['articul']?>);">
                                <input class="add" type="submit" value="+" name="add_barcode">
                            </div>
                            <ul class="livesearch"></ul>

                        <?}?>
                        </form>
                    </td>
                    <td>
                      <?
                        echo $rs['gname'];
                        if($rs['gname']!=''){
                          echo ' ' . measureTtl($rs['dia'], $rs['wdt'], $rs['depth'], $rs['hgt']);
                          if($rs['color']!='0') echo ' ' . $colors[$rs['color']];
                        }else{
                          
                        }
                        ?></td>
                    <td align="center"><?=$rs['stock1']?></td>
                    <td align="center"><?=$rs['stock2']?></td>
                    <td align="center"><?=$rs['stock3']?></td>
                </tr>
                <?}?>
                </table>
            </form>


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
                    console.log(currentInput);
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
                    
                    

//                    let res = products.filter(pr => pr.name.toLowerCase().includes(val.toLowerCase()));
                    const res = Object.values(products).filter(pr =>
                        pr.name.toLowerCase().includes(val.toLowerCase())
                    );
                    let markup = [];

                    if (res.length > 0) {
                        res.forEach(item => {
                            let binding = item['has_binding'] ? '<span style="color:red">(уже привязан)</span>' : '';
                            let bindind_attr = item['has_binding'] ? 'data-binding="1"' : '';
                            markup.push(`<li ${bindind_attr} id="${item.formID}">${item.name}, ${item.formID} ${binding}</li>`);
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
                        //    if (currentInput.value.length !== 13) currentInput.value = '';
                        }
                    });
                }

                function clickHandler({target}) {
                        const formID = target.id;
                        const hasBinded = target.dataset.binding;

                        if (!formID || hasBinded) return;

                        currentInput.value = formID;
                        toggleSearch(false);
                }
            </script>
    </body>
</html>