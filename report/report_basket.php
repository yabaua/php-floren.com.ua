<?php
header("content-type: text/html;charset=utf-8 \r\n");
setlocale(LC_ALL, 'uk_UA.UTF-8', 'uk_UA', 'uk', 'ukr');
require("auth.php");
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="/admin/style_back.css?v=12">
	<link href="https://fonts.googleapis.com/css?family=Lato:900&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body style="margin-left:20px;">
<?
//============================

include("top_menu.php");

//============================
?>
<?
$date_from	=	!isset($_REQUEST['nDateFrom'])?date("Y-m-d", (time()-30*24*60*60)):$_REQUEST['nDateFrom'];
$date_to	=	!isset($_REQUEST['nDateTo'])?date("Y-m-d", (time())):$_REQUEST['nDateTo'];

$groupData='day';
if(isset($_REQUEST['groupData'])) $groupData=$_REQUEST['groupData'];
?>
<h1>Статистика</h1>
<p></p>
<form name="reportDate">
	<input type="text" name="nDateFrom" value="<?=$date_from?>" class="input_type" style="width:130px;">
	<input type="text" name="nDateTo" value="<?=$date_to?>" class="input_type" style="width:130px;">
	<input type="radio" name="groupData" value="day" id="groupByDay" <?=($groupData=='day'?' checked="true"':'')?>><label for="groupByDay">За днями</label>
	<input type="radio" name="groupData" value="week" id="groupByWeek" <?=($groupData=='week'?' checked="true"':'')?>><label for="groupByWeek">За тижнями</label>
	<input type="radio" name="groupData" value="month" id="groupByMonth" <?=($groupData=='month'?' checked="true"':'')?>><label for="groupByMonth">За місяцями</label>
	<input style="padding: 6px 10px 5px 10px;margin-top:-2px; color: #FFFFFF; background: #5F1C13; text-decoration: none; border:none;" type="submit" name="change" value="Застосувати">
</form>
<h3>Корзини</h3>
<?



//echo "<br>",$date_from;
//echo "<br>",$date_to;

//echo "xx".$_REQUEST['groupWeek']."yy";

$ndf	=	explode(",",str_replace("-",",",("0-0-0-".$date_from)));
$ndt	=	explode(",",str_replace("-",",",("0-0-0-".$date_to)));

//	print_r($ndf);

$sql_date_from=mktime($ndf[0],$ndf[1],$ndf[2],$ndf[4],$ndf[5],$ndf[3]);
$sql_date_to= mktime($ndt[0],$ndt[1],$ndt[2],$ndt[4],$ndt[5],$ndt[3]);

//=====check========
//	echo "<br>",	date("d-m-Y-h-i-s", $sql_date_from);
//	echo "<br />",	date("d-m-Y-h-i-s", $sql_date_to);


$orders=array();

$group_by_basket_SQL="FROM_UNIXTIME(date_add, '%Y-%m-%d')";
$group_by_orders_SQL="FROM_UNIXTIME(order_date, '%Y-%m-%d')";
//$week_SQL=
if($groupData=='week'){
	$group_by_basket_SQL="WEEK(FROM_UNIXTIME(date_add, '%Y-%m-%d'),1)";
	$group_by_orders_SQL="WEEK(FROM_UNIXTIME(order_date, '%Y-%m-%d'),1)";
}
if($groupData=='month'){
	$group_by_basket_SQL="MONTH(FROM_UNIXTIME(date_add, '%Y-%m-%d'))";
	$group_by_orders_SQL="MONTH(FROM_UNIXTIME(order_date, '%Y-%m-%d'))";
}

//========Data From Basket
$db->query("SELECT DISTINCT(sessID), count(ID) AS bsk_qt, date_add, WEEK(FROM_UNIXTIME(date_add, '%Y-%m-%d'),1) AS weekNo, MONTH(FROM_UNIXTIME(date_add, '%Y-%m-%d')) AS monthNo
		FROM orders_basket
		WHERE formIDs!='' AND spiders!=1 AND (date_add BETWEEN '".$sql_date_from."' AND '".$sql_date_to."')
		GROUP BY ".$group_by_basket_SQL."
		ORDER BY date_add");


while($rs=$db->fetch()){
	switch($groupData){
		case 'day'	: 	$new_var=date("Y-m-d", $rs['date_add']);break;
		case 'week'	: 	$new_var=$rs['weekNo'];break;
		case 'month':	$new_var=$rs['monthNo'];break;
	}

	$orders[$new_var]['bsk_qt']=!$rs['bsk_qt']?1:$rs['bsk_qt'];
	$orders[$new_var]['bsk_date']=date("Y-m-d", $rs['date_add']);
}

//========Data From Orders
$db->query("SELECT count(ID) AS orders_qt, SUM(total) AS summ_uah, order_date, WEEK(FROM_UNIXTIME(order_date, '%Y-%m-%d'),1) AS weekNo, MONTH(FROM_UNIXTIME(order_date, '%Y-%m-%d')) AS monthNo
				FROM orders
				WHERE order_date BETWEEN '".$sql_date_from."' AND '".$sql_date_to."'
				GROUP BY ".$group_by_orders_SQL."
				ORDER BY order_date");
				
				 
while($rs=$db->fetch()){
	switch($groupData){
		case 'day'	: 	$new_var=date("Y-m-d", $rs['order_date']);break;
		case 'week'	: 	$new_var=$rs['weekNo'];break;
		case 'month':	$new_var=$rs['monthNo'];break;
	}
	$orders[$new_var]['orders_qt']	=	$rs['orders_qt'];
	$orders[$new_var]['summ_uah']	=	$rs['summ_uah'];
}

//========Data From Orders ONLY successful
$db->query("SELECT count(ID) AS orders_qt, SUM(total) AS summ_uah, order_date, WEEK(FROM_UNIXTIME(order_date, '%Y-%m-%d'),1) AS weekNo, MONTH(FROM_UNIXTIME(order_date, '%Y-%m-%d')) AS monthNo, basket
				FROM orders
				WHERE order_date BETWEEN '".$sql_date_from."' AND '".$sql_date_to."'
				AND keepInCrmResult='successful'
				GROUP BY ".$group_by_orders_SQL."
				ORDER BY order_date");
while($rs=$db->fetch()){
	switch($groupData){
		case 'day'	: 	$new_var=date("Y-m-d", $rs['order_date']);break;
		case 'week'	: 	$new_var=$rs['weekNo'];break;
		case 'month':	$new_var=$rs['monthNo'];break;
	}
	$orders[$new_var]['orders_qt_scsfl']	=	$rs['orders_qt'];
	$orders[$new_var]['summ_uah_scsfl']	=	$rs['summ_uah'];
}


?>
<style>
.tbl td {padding: 2px 5px;}
</style>
<table>
<tr valign="top">
<td width="25%">
<table class="tbl" cellpadding="0" cellspacing="0" border=0>
	<colgroup align="center"></colgroup>
	<colgroup align="center"></colgroup>
	<colgroup class="alcenter"></colgroup>
	<colgroup class="alcenter"></colgroup>
	<colgroup class="alcenter"></colgroup>
    <colgroup class="alright"></colgroup>
    <colgroup class="alright"></colgroup>
   	<colgroup class="alright"></colgroup>
	<thead>
	<tr align="center">
		<th><?
			switch($groupData){
			case 'day'	: 	echo "День";break;
			case 'week'	: 	echo "Тиждень";break;
			case 'month':	echo "Місяць";break;
		}?></th>
		<th>Кіл-ть<br />корзин</th>
		<th>Кіл-ть<br />змвлн</th>
		<th>CTR<br />Корз/Зам</th>
		<th>Кіл-ть<br />успіх</th>
		<th>CTR<br />Усі/Успіх</th>
		<th align="center">Сума<br />замовлень</th>
		<th align="center">Сума<br />успішних</th>
		<th align="center">Середній<br />чек</th>
		<th align="center">Середній<br />чек успіх</th>
	</tr>
	</thead>
	
	<tbody>
<?

$ttl_orders_summ=0;
$ttl_orders_summ_scsfl=0;
$ttl_orders_qt=0;
$ttl_orders_qt_scsfl=0;
$ttl_basket_qt=0;
$ttl_ctr=0;
$ttl_ctr_scsfl=0;
$ttl_average_bill=0;
$ttl_average_bill_scsfl=0;

foreach ($orders AS $k=>$v){
	$chart_labels[]=$v['bsk_date'];
	$chart_baskets[]=$v['bsk_qt'];
	$chart_orders[]=!isset($v['orders_qt'])?"0":$v['orders_qt'];
	$chart_orders_scsfl[]=!isset($v['orders_qt_scsfl'])?"0":$v['orders_qt_scsfl'];
	$chart_ctr[]=@ceil($v['orders_qt']/$v['bsk_qt']*100);
	$chart_ctr_scsfl[]=@ceil($v['orders_qt_scsfl']/$v['orders_qt']*100);
	$chart_orders_summ[]=!isset($v['summ_uah'])?"0":$v['summ_uah'];
	$chart_orders_summ_scsfl[]=!isset($v['summ_uah_scsfl'])?"0":$v['summ_uah_scsfl'];
	$chart_orders_average[]=@round($v['summ_uah']/$v['orders_qt'],2);
	$chart_orders_average_scsfl[]=@round($v['summ_uah_scsfl']/$v['orders_qt_scsfl'],2);
	
	$ttl_orders_summ+=@$v['summ_uah'];
	$ttl_orders_qt+=@$v['orders_qt'];
	$ttl_orders_summ_scsfl+=@$v['summ_uah_scsfl'];
	$ttl_orders_qt_scsfl+=@$v['orders_qt_scsfl'];
	$ttl_basket_qt+=$v['bsk_qt'];

?>
	<tr  align="center">
		<td nowrap><?=$v['bsk_date']?></td>
		<td><?=$v['bsk_qt']?></td>
		<td><?=!isset($v['orders_qt'])?"–":$v['orders_qt']?></td>
		<td><?=@ceil($v['orders_qt']/$v['bsk_qt']*100)?>%</td>
		<td><?=!isset($v['orders_qt_scsfl'])?"–":$v['orders_qt_scsfl']?></td>
		<td><?=@ceil($v['orders_qt_scsfl']/$v['orders_qt']*100)?>%</td>
		<td nowrap align="right"><?=!isset($v['summ_uah'])?"–":number_format($v['summ_uah'],2,',',' ');?></td>
		<td nowrap align="right"><?=!isset($v['summ_uah_scsfl'])?"–":number_format($v['summ_uah_scsfl'],2,',',' ');?></td>
		<td nowrap align="right"><?=@number_format(($v['summ_uah']/$v['orders_qt']),2,',',' ');?></td>
		<td nowrap align="right"><?=@number_format(($v['summ_uah_scsfl']/$v['orders_qt_scsfl']),2,',',' ');?></td>
	</tr>
<?
} //foreach
	$ttl_ctr=@ceil($ttl_orders_qt/$ttl_basket_qt*100);
	$ttl_average_bill=round($ttl_orders_summ/$ttl_orders_qt,2);
	$ttl_ctr_scsfl=@ceil($ttl_orders_qt_scsfl/$ttl_orders_qt*100);
	$ttl_average_bill_scsfl=round($ttl_orders_summ_scsfl/$ttl_orders_qt_scsfl,2);
?>
	<tr>
		<th>&nbsp;</th>
		<th><?=$ttl_basket_qt;?></th>
		<th><?=$ttl_orders_qt?></th>
		<th><?=$ttl_ctr?>%</th>
		<th><?=$ttl_orders_qt_scsfl?></th>
		<th><?=$ttl_ctr_scsfl?>%</th>
		<th nowrap><?=number_format($ttl_orders_summ,2,',',' ');?></th>
		<th nowrap><?=number_format($ttl_orders_summ_scsfl,2,',',' ');?></th>
		<th nowrap><?=number_format($ttl_average_bill,2,',',' ')?></th>
		<th nowrap><?=number_format($ttl_average_bill_scsfl,2,',',' ')?></th>
	</tr>
	</tbody>
</table>
<p>&nbsp;</p>
<p>Клієнти, які заповнили корзину, але не відправили замовлення з <?=date("Y-m-d", $sql_date_from)?> по <?=date("Y-m-d", $sql_date_to)?>.</p>
<?
$ii=0;
$db->query("SELECT * FROM orders_basket WHERE LENGTH(phone)>7 AND date_add BETWEEN '".$sql_date_from."' AND '".$sql_date_to."'");
while($rs=$db->fetch()){
	$db->query("SELECT * FROM orders WHERE SUBSTR(TRIM(phone), -7)='".substr($rs['phone'],-7)."' AND order_date BETWEEN '".($sql_date_from-86400)."' AND '".($sql_date_to+86400)."'", 1);
	
	
	
	if(!$db->num_rows(1)){
		
		echo "<p><b>".$rs['fio']." – ".$rs['phone']."</b></p>";
		if($rs['formIDs']!=''){
			$db->query("SELECT g.name AS nome, gf.dia, gf.hgt, gf.color, gf.price FROM goods_forms gf JOIN goods_ua g ON gf.goodID=g.ID WHERE gf.ID IN('".str_replace(",","','",$rs['formIDs'])."')");
			while($rs3 = $db->fetch(3)){
				echo "<ul>";
				echo "<li>".$rs3['nome']." ".$rs3['dia']."x".$rs3['hgt'].($rs3['color']>0?" ".$rs3['color']:"")." – ".$rs3['price']."</li>";
				echo "</ul>";
			}	
		}
		$ii++;
	}
}
?>
<p>Всього: <?=$ii?></p>

<hr>

<?
$qr = $db->query("SELECT * FROM orders WHERE order_date BETWEEN '".$sql_date_from."' AND '".$sql_date_to."'");
while($rs = $db->fetch()){
	$basket[] = unserialize(base64_decode($rs['basket']));
	
}
$ordered_goods=array();
foreach($basket AS $b){
	//$ordered_goods[$b['formID']] = 
	foreach($b AS $bb) {
	//	print_r($bb);
		if(!array_key_exists($bb['formID'], $ordered_goods)){
			$ordered_goods[$bb['formID']]['name'] = $bb['name'] . $bb['dia'] . "x" . $bb['hgt'];
			$ordered_goods[$bb['formID']]['cnt']	= $bb['cnt'];
			$ordered_goods[$bb['formID']]['sttl']	= $bb['sttl'];
		}else{
			$ordered_goods[$bb['formID']]['cnt']	+= $bb['cnt'];
			$ordered_goods[$bb['formID']]['sttl']	+= $bb['sttl'];
			
		}
	}
}
function cmp_cnt_desc($a, $b) {
    if ($a['cnt'] == $b['cnt']) return 0;
    return ($a['sttl'] < $b['sttl']) ? 1 : -1; // поменяй 1 и -1 местами для возрастания
}

uasort($ordered_goods, 'cmp_cnt_desc');
?>
<table class="tbl" cellpadding="0" cellspacing="0" border=0>
<?
	foreach($ordered_goods AS $o){
?>
<tr>
	<td><?=$o['name']?></td>
	<td><?=$o['cnt']?></td>
	<td align="right"><?=number_format($o['sttl'],2,',',' ');?></td>
</tr>
<?}?>
</table>


</td>
<td width="75%" valign="top">
<?
	$chart_labels_js='"'.implode('","',$chart_labels).'"';
	$chart_baskets_js=implode(',',$chart_baskets);
	$chart_orders_js=implode(',',$chart_orders);
	$chart_ctr_js=implode(',',$chart_ctr);
	$chart_orders_scsfl_js=implode(',',$chart_orders_scsfl);
	$chart_ctr_scsfl_js=implode(',',$chart_ctr_scsfl);
	$chart_orders_summ_js=implode(',',$chart_orders_summ);
	$chart_orders_average_js=implode(',',$chart_orders_average);
	$chart_orders_summ_scsfl_js=implode(',',$chart_orders_summ_scsfl);
	$chart_orders_average_scsfl_js=implode(',',$chart_orders_average_scsfl);
?>
<div id="your-id" style="height: 400px;"></div>
<p>&nbsp;</p>
<div id="your-id4" style="height: 400px;"></div>
<p>&nbsp;</p>
<div id="your-id2" style="height: 400px;"></div>
<p>&nbsp;</p>
<div id="your-id3" style="height: 400px;"></div>
		<script>
			document.addEventListener("DOMContentLoaded", function(){
				// Create liteChart.js Object
				let d = new liteChart("chart",{
					line: {
						width: 2,
						style: "straight",
						shadow: true,
					}
					
					
				});

				// Set labels
				d.setLabels([<?=$chart_labels_js?>]);

				// Set legends and values
				d.addLegend({"name": "Сума успішних", "stroke": "#3b95f7", "fill": "#fff", "values": [<?=$chart_orders_summ_scsfl_js?>]});
				d.addLegend({"name": "Сума замовлень", "stroke": "#CDDC39", "fill": "#fff", "values": [<?=$chart_orders_summ_js?>]});
			
				// Inject chart into DOM object
				let div = document.getElementById("your-id");
				d.inject(div);

				// Draw
				d.draw();
			});
		</script>
		<script>
			document.addEventListener("DOMContentLoaded", function(){
				// Create liteChart.js Object
				let d4 = new liteChart("chart4",{
					line: {
						width: 2,
						style: "straight",
						shadow: true,
					}
					
					
				});

				// Set labels
				d4.setLabels([<?=$chart_labels_js?>]);

				// Set legends and values
				d4.addLegend({"name": "Успішних", "stroke": "#DD0000", "fill": "#fff", "values": [<?=$chart_orders_scsfl_js?>]});
				d4.addLegend({"name": "Замовлень", "stroke": "#CDDC39", "fill": "#fff", "values": [<?=$chart_orders_js?>]});
				d4.addLegend({"name": "Корзин", "stroke": "#3b95f7", "fill": "#fff", "values": [<?=$chart_baskets_js?>]});
			

				// Inject chart into DOM object
				let div4 = document.getElementById("your-id4");
				d4.inject(div4);

				// Draw
				d4.draw();
			});
		</script>
		<script>
			document.addEventListener("DOMContentLoaded", function(){
				// Create liteChart.js Object
				let d2 = new liteChart("chart2",{
					line: {
						width: 2,
						style: "straight",
						shadow: true,
					}
				});

				// Set labels
				d2.setLabels([<?=$chart_labels_js?>]);

				// Set legends and values
				d2.addLegend({"name": "CTR Корзини / Замовленя", "stroke": "#CDDC39", "fill": "#fff", "values": [<?=$chart_ctr_js?>]});
				d2.addLegend({"name": "CTR Усі зам / Успішні", "stroke": "#3b95f7", "fill": "#fff", "values": [<?=$chart_ctr_scsfl_js?>]});

				// Inject chart into DOM object
				let div2 = document.getElementById("your-id2");
				d2.inject(div2);

				// Draw
				d2.draw();
			});
		</script>
		<script>
			document.addEventListener("DOMContentLoaded", function(){
				// Create liteChart.js Object
				let d3 = new liteChart("chart3",{
					line: {
						width: 2,
						style: "straight",
						shadow: true,
					}
				});

				// Set labels
				d3.setLabels([<?=$chart_labels_js?>]);

				// Set legends and values
				d3.addLegend({"name": "Ср.Чек", "stroke": "#3b95f7", "fill": "#fff", "values": [<?=$chart_orders_average_js?>]});
				d3.addLegend({"name": "Ср.Чек Успішні", "stroke": "#CDDC39", "fill": "#fff", "values": [<?=$chart_orders_average_scsfl_js?>]});
			//	d.addLegend({"name": "Night", "stroke": "#3b95f7", "fill": "#fff", "values": [200, 150, 240, 180, 150, 240, 230, 300, 200, 150, 270, 200]});

				// Inject chart into DOM object
				let div3 = document.getElementById("your-id3");
				d3.inject(div3);

				// Draw
				d3.draw();
			});
		</script>

		<script src="/admin/js/litechart/liteChart.min.js"></script>
</td>
</tr>
</table>
</body>
