<?
header("content-type: text/html;charset=utf-8 \r\n");
require("auth.php");
include("../include/strlib.php");

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

        <h1>Наявність товарів:</h1>

        <div class="btns">
            <form name="f1" method="post" action="goods_quantity.php">
               <!--
                <button class="btn" type="submit" value="not_on_site" name="not_on_site">Штрихкоды 1C, не привязанные к товарам на сайте</button>
                <button class="btn" type="submit" name="show_without_barcodes">Товары на сайте без штрихкодов</button>
                <button class="btn" type="submit" name="show_with_barcodes">Товары на сайте со штрихкодами</button>
                 -->
                <button type="submit" name="show_barcodes">Привязать штрихкоды к товарам на сайте</button>
            </form>
        </div>

<?
	// ============ Total Goods =============
	$goods_qt=0;
	$db->query("SELECT COUNT(g.ID) AS cnt FROM goods g
		JOIN goods_class gc ON g.classID=gc.ID
		WHERE gc.motherID=3");
 	$rs = $db->fetch();
 	$goods_qt = $rs['cnt'];
 	// ============ Total Good Forms =============
 	$goods_forms_qt = 0;
	$db->query("SELECT COUNT(gf.ID) AS cnt FROM goods g
				JOIN goods_class gc ON g.classID=gc.ID
				JOIN goods_forms gf ON g.ID=gf.goodID
				WHERE gc.motherID=3");
	$rs2 = $db->fetch();		
	$goods_forms_qt = $rs2['cnt'];
	
	// ============ Total Goods IN Stock=============
	$db->query("SELECT gf21c.barcode AS bar, CONCAT(g.name, ' ', gf.dia, '/', gf.hgt), gf.color, (g1c.f1_stock+g1c.f2_stock) AS in_stock
				FROM goods g
				JOIN goods_class gc ON g.classID=gc.ID
				JOIN goods_forms gf ON g.ID=gf.goodID
				LEFT JOIN goods_forms2_1c gf21c ON gf21c.fID=gf.ID
				LEFT JOIN goods_1c g1c ON g1c.barcode=gf21c.barcode
				
				WHERE gc.motherID=3 AND gf21c.barcode AND (g1c.f1_stock+g1c.f2_stock)
				GROUP BY g.ID
				ORDER BY g.name;");
				
	$goods_qt_in_stock=$db->num_rows();
	
	// ============ Total Good Forms IN Stock =============
	
	$db->query("SELECT gf21c.barcode AS bar, CONCAT(g.name, ' ', gf.dia, '/', gf.hgt), gf.color, (g1c.f1_stock+g1c.f2_stock) AS in_stock
				FROM goods g
				JOIN goods_class gc ON g.classID=gc.ID
				JOIN goods_forms gf ON g.ID=gf.goodID
				LEFT JOIN goods_forms2_1c gf21c ON gf21c.fID=gf.ID
				LEFT JOIN goods_1c g1c ON g1c.barcode=gf21c.barcode
				
				WHERE 
					gc.motherID=3
					AND gf21c.barcode
					AND (g1c.f1_stock+g1c.f2_stock)
				GROUP BY gf.ID
				ORDER BY g.name;");
	$goods_forms_qt_in_stock = $db->num_rows();
	
?>

Всього кімнатних рослин на сайті: <b><?=$goods_qt?></b>, в наявності хоч один розмір: <b><?=$goods_qt_in_stock?></b> тобто <b><?echo round(($goods_qt_in_stock/$goods_qt)*100, 2)?>%</b> </br>
Всього кімнатних рослин по розмірах: <b><?=$goods_forms_qt?></b>, в наявності: <b><?=$goods_forms_qt_in_stock?></b> тобто <b><?echo round(($goods_forms_qt_in_stock/$goods_forms_qt)*100, 2)?>%</b> </br>



<h2>Кімнатні рослини, яких немає в наявності</h2>
<?
	$db->query("SELECT gf21c.barcode AS bar, gc.name AS className, CONCAT(g.name) AS nome, COUNT(g1c.f1_stock+g1c.f2_stock) AS in_stock, g.availability, gf.visibility
				FROM goods g
				JOIN goods_class gc ON g.classID=gc.ID
				JOIN goods_forms gf ON g.ID=gf.goodID
				LEFT JOIN goods_forms2_1c gf21c ON gf21c.fID=gf.ID
				LEFT JOIN goods_1c g1c ON g1c.barcode=gf21c.barcode
				
				WHERE gc.motherID=3 AND gf21c.barcode# AND !(g1c.f1_stock+g1c.f2_stock)
				GROUP BY g.ID
				ORDER BY gc.ID, g.name;");
				
	while($rs=$db->fetch()){
		$goods_not_in_stock[]=$rs;
	}
	
?>
			<table border="1" cellpadding="2" style="border-collapse: collapse;">
                <tr>
                	<th>#</th>
                	<th>ШтрихКод</th>
                    <th>Назва</th>
                    <th>Кількість</th>
                </tr>
                <? 
                	$className='';
                	$i=1;
                	foreach($goods_not_in_stock AS $item) { 
                	if($item['in_stock']>0) continue
                ?>
                	<? if($className!=$item['className']){?>
                <tr>
                	<td colspan="4" align="center"><h3><?=$item['className']?></h3></td>
                </tr>
                	<?}?>
                <tr<?if($item['availability']==0){?> bgcolor="#f4cacb"<?}?>>
                		<td><?=$i?></td>
                    	<td><?=$item['bar']?></td>
                        <td><?=$item['nome']?></td>
                        <td><?=$item['in_stock']?></td>
                </tr>
                <?
                	$i++;
                	$className=$item['className'];
                }
                ?>   
            </table>

<h2>Не прив&#740;язані товари</h2>

<?
	$db->query("SELECT gf21c.barcode AS bar, CONCAT(g.name, ' ', gf.dia, '/', gf.hgt) AS nome, gf.color AS color FROM goods g
				JOIN goods_class gc ON g.classID=gc.ID
				JOIN goods_forms gf ON g.ID=gf.goodID
				LEFT JOIN goods_forms2_1c gf21c ON gf21c.fID=gf.ID
				LEFT JOIN goods_1c g1c ON g1c.barcode=gf21c.barcode
				
				WHERE gc.motherID=3 AND gf21c.barcode IS NULL
				ORDER BY g.name");
				
	while($rs=$db->fetch()){
		$goods_without_barcode[]=$rs;
	}
	
?>
			<table border="1" style="border-collapse: collapse;">
                <tr>
                    <th>Назва</th>
                    <th>Колір</th>
                </tr>
                <? foreach($goods_without_barcode AS $item) { ?>
                    <tr>
                        <td><?=$item['nome']?></td>
                        <td><?=$item['color']?' '.$item['color']:''?></td>
                    </tr>
                <?}?>   
            </table>
</html>