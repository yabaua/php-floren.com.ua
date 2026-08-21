<?php
header("content-type: text/html;charset=utf-8 \r\n");
setlocale(LC_ALL, 'uk_UA.UTF-8', 'uk_UA', 'uk', 'ukr');
require("auth.php");
//require($_SERVER['DOCUMENT_ROOT'] . "database.php");
$allow_adm_lvl=array('middle', 'cpcoutsource', 'top');
if(!in_array($_SESSION['admin_lvl'], $allow_adm_lvl)){
	unset($_SESSION['admin_name']);
	header("location:/report/index.html");
	exit();
}
include("../include/strlib.php");


function transliterateCampName($st) {
	$st_=mb_strtolower($st, 'UTF-8');
	$st_=str_replace('ь', '', str_replace('ъ', '', $st_));
	$st_=str_replace("/", "_", $st_);
	$st_=str_replace("|", "_", $st_);
	$st_ = strtr($st_, array(
        "ё"=>"yo","ж"=>"zh","ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"sch",
        "ю"=>"yu","я"=>"ya",

        "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","з"=>"z",
        "и"=>"y","й"=>"y","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o",
        "п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ы"=>"y","э"=>"e","і"=>"i","ї"=>"i","є"=>"ie"
    ));
	$st_=preg_replace("/[^0-9a-z _ - ]/","",$st_);
	$st_=str_replace("quot", "", $st_);
	return substr(str_replace(' ', '',$st_), 0, 50); 
}

$today_date_from	=	strtotime("today");
$today_date_from_plus_yesterday_evening	=	date("U",strtotime('yesterday 19:30:00'));
$today_date_to		=	date("U",strtotime(date("Y-m-dT23:59:00", time())));
$yesterday_date_from		=	strtotime("yesterday");
$month_start_day	=	strtotime("first day of ".date("M", (time())));
$minus_one_week_midnight	=	$ddd=date("U",strtotime('-1 week midnight'));
$minus_two_weeks_midnight	=	$ddd=date("U",strtotime('-2 week midnight'));
$minus_one_month_midnight	=	$ddd=date("U",strtotime('-1 month midnight'));
/*
function get_data($start_time, $end_time){
	$orders_summ=0;
	$orders_cnt=0;
	$person_array=array();
	$funnel_array=array();
	$db->query("SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$start_time."' AND '".$end_time."'");
	while ($rs=mysql_fetch_array($qr)){
		$orders_summ+=$rs['orderTotal'];
		$orders_cnt++;
		if(array_key_exists($rs['mainResponsibleID'], $person_array)){
			$person_array[$rs['mainResponsibleID']]['ttl']+=$rs['orderTotal'];
			$person_array[$rs['mainResponsibleID']]['cnt']++;
		}else{
			$person_array[$rs['mainResponsibleID']]['ttl']=$rs['orderTotal'];
			$person_array[$rs['mainResponsibleID']]['cnt']=1;
		}
		if(array_key_exists($rs['orderFunnel'], $funnel_array)){
			$funnel_array[$rs['orderFunnel']]['ttl']+=$rs['orderTotal'];
			$funnel_array[$rs['orderFunnel']]['cnt']++;
		}else{
			$funnel_array[$rs['orderFunnel']]['ttl']=$rs['orderTotal'];
			$funnel_array[$rs['orderFunnel']]['cnt']=1;
		}
	}
//	return 
}

*/



/*
$person_array=array(
				'46556'=>array('name'=>'Анна Гарькава', 'ttl'=>0, 'cnt'=>0),
				'46557'=>array('name'=>'Інна Коваленко', 'ttl'=>0, 'cnt'=>0),
				'59142'=>array('name'=>'Елла Шамсієва', 'ttl'=>0, 'cnt'=>0),
				'134757'=>array('name'=>'Анна Ткаченко', 'ttl'=>0, 'cnt'=>0)
);
*/
$mainResponsible_array=array(
				
				'2'=>'Анна Гарькава',
				'3'=>'Інна Коваленко',
				'8'=>'Елла Шамсієва',
				'7'=>'Катерина Малієва',
				'14'=>'Маргарита Шустик'
);
$funnelIDDs=array(
				'1'=>'Роздріб',
				'3'=>'Пересадка',
				'2'=>'Фітодизайн',
				'5'=>'Тендер',
				'4'=>'Флористика'
);


//echo "<br /><br />";
//echo date("Y-m-d-H:i:s", $today_date_from);
//echo "<br />".date("Y-m-d-H:i:s",$today_date_from);
/*echo "<br />".date("Y-m-d-H:i:s",$month_start_day);
echo "<br /><br />";
*/



?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Звіт</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?=time()?>" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>


<?include("top_menu.php")?>
<h1>Звіт по CPC угодам в CRM</h1>


<?
$utm_array=array();
$rand_date_from='';
$rand_date_to='';
if(isset($_REQUEST['rand_date_from']) && $_REQUEST['rand_date_from']!=''){
	$rand_date_from=$_REQUEST['rand_date_from'];
}
if(isset($_REQUEST['rand_date_to']) && $_REQUEST['rand_date_to']!=''){
	$rand_date_to=$_REQUEST['rand_date_to'];
}
if($rand_date_from){
	$rdf=strtotime($rand_date_from);
	$rdt=strtotime($rand_date_to);
//	echo $rdf, "-", $rdt;
//	echo "<br />", date("Y-m-d-H:i:s", $rdf), "==", date("Y-m-d-H:i:s", $rdt);
		$query="SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$rdf."' AND '".$rdt."' AND utm_medium='cpc' AND orderResult!='failed' ORDER BY utm_source DESC, utm_medium DESC, utm_campaign DESC";
//		echo $query;
		$db->query($query);
		while($rs=$db->fetch()){
			$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['rdm'][]=$rs['orderTotal'];
			$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['month']=array();
			$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['week']=array();
		}

}
//print_r($utm_array);
// AND utm_medium='cpc'
//=======MONTH
$db->query("SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$month_start_day."' AND '".$today_date_to."' AND utm_medium='cpc' AND orderResult!='failed' ORDER BY utm_source DESC, utm_medium DESC, utm_campaign DESC");
//echo "SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$month_start_day."' AND '".$today_date_to."' AND utm_medium='cpc' AND orderResult!='failed' ORDER BY utm_source DESC, utm_medium DESC, utm_campaign DESC";
/*
if we will count with SQL

SELECT
utm_source, utm_medium, utm_campaign, count(`keepInCrmID`), SUM(orderTotal)
FROM orders_crm
WHERE
orderDate BETWEEN '1759266000' AND '1760389140'
GROUP BY utm_campaign
ORDER BY utm_source DESC, utm_medium DESC, SUM(orderTotal), utm_campaign DESC
*/

while($rs=$db->fetch()){
		$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['month'][]=$rs['orderTotal'];
		$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['week']=array();
		if(!isset($utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['rdm']) && $rand_date_from){
			$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['rdm']=array();
		}
}
//========WEEEK
$db->query("SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$minus_one_week_midnight."' AND '".$today_date_from."' AND utm_medium='cpc' AND orderResult!='failed' ORDER BY utm_source DESC, utm_medium DESC, utm_campaign DESC");
//echo "SELECT COUNT(*), SUM(orderTotal) FROM orders_crm WHERE orderDate BETWEEN '1752699600' AND '1753304400'";
while($rs=$db->fetch()){
		$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['week'][]=$rs['orderTotal'];
		if(!isset($utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['month'])){
			$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['month']=array();
		}
		if(!isset($utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['rdm']) && $rand_date_from){
			$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['rdm']=array();
		}
}

//print_r($utm_array);
?>
<form name="rand_date_form" action="report_crm_cpc.php" method="get">
<div class="holder">
	<div style="float:left;width:150px;">
		<input type="text" name="rand_date_from" id="rand_date_from" placeholder="dd.mm.yyyy" value="<?=$rand_date_from?>" />
	</div>
	<div style="float:left;width:150px;">
		<input type="text" name="rand_date_to" id="rand_date_to" placeholder="dd.mm.yyyy"  value="<?=$rand_date_to?>" />
	</div>
	<div style="float:left;width:150px;">
		<input type="submit" name="rand_date_sbm">
	</div>
</div>
<div class="holder">
	<div style="float:left;width:150px;">&nbsp;</div>
	<div style="float:left;width:150px;">
		<select id="rand_date_select" onchange="setDates(this.value)">
		<option></option>
		<?
		$db->query("SELECT DISTINCT(date_add) FROM orders_crm_roas ORDER BY date_add DESC");
		while($rs=$db->fetch()){
		?>
		<?//=date("d.m.Y", strtotime("first day of ".date("F Y", $rs['date_add'])))? >|<?=date("d.m.Y", $rs['date_add'])?>
		<option value="<?=date("d.m.Y", strtotime("first day of ".date("F Y", $rs['date_add'])))?>|<?=date("d.m.Y", $rs['date_add'])?>">
			<?=date("d.m.Y", $rs['date_add'])?>
		</option>
		<?} // while?>	
		</select>
	</div>
	<div style="float:left;width:150px;">&nbsp;</div>
</div>
</form>
<br />
<table class="tbl" cellpadding="0" cellspacing="0" border="0">
<?
$utm_source='';
$utm_medium='';
$utm_campaign='';
//==
$global_cnt_month=0;
$global_summ_month=0;
$cpc_cnt_month=0;
$cpc_summ_month=0;
//==
$global_cnt_week=0;
$global_summ_week=0;
$cpc_cnt_week=0;
$cpc_summ_week=0;
//==
$global_cnt_rdm=0;
$global_summ_rdm=0;
$cpc_cnt_rdm=0;
$cpc_summ_rdm=0;
//==
foreach($utm_array AS $k=>$v){
	$utm_source=$k;
	foreach($v AS $kk=>$vv){
		$utm_medium=$kk;
			$cnt_k_month=0;
			$sum_k_month=0;
			foreach($vv AS $kkk=>$vvv){
				$utm_campaign=$kkk;
				
				$cnt_k_month=count($vvv['month']);
				$sum_k_month=array_sum($vvv['month']);
				$global_cnt_month+=count($vvv['month']);
				$global_summ_month+=array_sum($vvv['month']);
				$cnt_k_week=count(array_filter($vvv['week']));	//count non-empty values
				$sum_k_week=array_sum($vvv['week']);
				$global_cnt_week+=count(array_filter($vvv['week']));	//count non-empty values
				$global_summ_week+=array_sum($vvv['week']);
				if($rand_date_from){
					$cnt_k_rdm=count(array_filter($vvv['rdm']));	//count non-empty values
					$sum_k_rdm=array_sum($vvv['rdm']);
					$global_cnt_rdm+=count(array_filter($vvv['rdm']));	//count non-empty values
					$global_summ_rdm+=array_sum($vvv['rdm']);
				}
		//	echo '<br>'.$k.'=='.$kk;
			
			if($k=='google' && $kk=='cpc') {
		//		print_r($vvv);
		//		echo "<br>";
				$cpc_cnt_month+=count(array_filter($vvv['month']));	//count non-empty values
				$cpc_summ_month+=array_sum($vvv['month']);
				$cpc_cnt_week+=count(array_filter($vvv['week']));	//count non-empty values
				$cpc_summ_week+=array_sum($vvv['week']);
				if($rand_date_from){
					$cpc_cnt_rdm+=count(array_filter($vvv['rdm']));	//count non-empty values
					$cpc_summ_rdm+=array_sum($vvv['rdm']);
				}
			}
		//	echo '<br>'.$cpc_summ.'<br><br>';
$new_utm_arr[]['utm_source']=$utm_source;
$new_utm_arr[count($new_utm_arr)-1]['utm_medium']=$utm_medium;
$new_utm_arr[count($new_utm_arr)-1]['utm_campaign']=$utm_campaign;
$new_utm_arr[count($new_utm_arr)-1]['cnt_k']['month']=$cnt_k_month;
$new_utm_arr[count($new_utm_arr)-1]['sum_k']['month']=$sum_k_month;
$new_utm_arr[count($new_utm_arr)-1]['cnt_k']['week']=$cnt_k_week;
$new_utm_arr[count($new_utm_arr)-1]['sum_k']['week']=$sum_k_week;
if($rand_date_from){
	$new_utm_arr[count($new_utm_arr)-1]['cnt_k']['rdm']=$cnt_k_rdm;
	$new_utm_arr[count($new_utm_arr)-1]['sum_k']['rdm']=$sum_k_rdm;
}

}}}
//print_r($new_utm_arr);

$roasOnDate=array();
$db->query("SELECT * FROM orders_crm_roas ORDER BY date_add DESC LIMIT 1");
$rs_roas_date=$db->fetch();

$db->query("SELECT * FROM orders_crm_roas WHERE date_add='".$rs_roas_date['date_add']."'");
while($rs2=$db->fetch()){
	$roasOnDate[$rs2['campName']]=array('roas'=>$rs2['roasOnDate'], 'cpcCost'=>$rs2['cpcCost']);
	if($rand_date_from){
		$roasOnRandDate[$rs2['campName']]=array();
	}
}
//print_r($roasOnDate);
/*
usort($new_utm_arr, function($a, $b){
    return ($a['sum_k'] - $b['sum_k']);
});
*/
if($rand_date_from){
	$roasOnRandDate=array();

	$db->query("SELECT * FROM orders_crm_roas WHERE date_add='".strtotime($rand_date_to)."'");
	while($rs2=$db->fetch()){
		$roasOnRandDate[$rs2['campName']]=array('roas'=>$rs2['roasOnDate'], 'cpcCost'=>$rs2['cpcCost']);
	}
}
?>
<script>

function setDates(val) {
    const [from, to] = val.split('|');
    document.getElementById('rand_date_from').value = from;
    document.getElementById('rand_date_to').value = to;
}

function calcRoas(cpcCo, elName){
	//let value = idd.val();
//	console.log(value);
	//console.log(elName);

	let gross	=	parseFloat($('#gross_'+elName).html().replace(/\s/g, ''));
	cpcCost		=	parseFloat(cpcCo.replace(/\s/g, ''));
	roas		=	parseInt(gross / cpcCost * 100);
	$('#roas_'+elName).html(roas);
	
//	console.log(gross);
//	console.log(cpcCost);
	
	$.post('/report/report_crm_cpc_dbroas.php?r=3',{campName:elName, cpcCost:cpcCost, roas:roas, gross:gross}, function(data) {});
}
</script>
<tr>
	<td colspan="3">&nbsp;</td>
	<td colspan="2">Ост. Тиждень</td>
	<?if($rand_date_from){?>
	<td colspan="4"><?echo date("d.M.Y", $rdf), " &ndash; ", date("d.M.Y", $rdt);?></td>
	<?}?>
	<td colspan="2">Цей місяць</td>
	<td colspan="2">ROAS на <?=date("d.m.Y", $rs_roas_date['date_add'])?></td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
	<td>Кіл-ть</td>
	<td>Сума</td>
	<?if($rand_date_from){?>
	<td>Кіл-ть</td>
	<td>Сума</td>
	<td align="middle" width="80">Витрати CPC</td>
	<td align="middle" width="80">ROAS</td>
	<?}?>
	<td>Кіл-ть</td>
	<td>Сума</td>
	<td align="middle" width="80">Витрати CPC</td>
	<td align="middle" width="80">ROAS<br /></td>
</tr>
<?
foreach($new_utm_arr AS $k=>$v){
$roasFieldName=$v['utm_source']."_".$v['utm_medium']."_".transliterateCampName($v['utm_campaign']);
?>
<tr>
	<td><?=$v['utm_source']?></td>
	<td><?=$v['utm_medium']?></td>
	<td><?=$v['utm_campaign']?></td>
	<td align="center" width="80"><?=($v['cnt_k']['week']!=0	?	$v['cnt_k']['week']		:	'–')?></td>
	<td align="right" width="100"><?=($v['sum_k']['week']!=0	?	number_format($v['sum_k']['week'], '2', ',', ' ')	:	'–')?></td>
	<?if($rand_date_from){?>
	<td align="center" width="80"><?=($v['cnt_k']['rdm']!=0	?	$v['cnt_k']['rdm']		:	'–')?></td>
	<td align="right" width="100"><?=($v['sum_k']['rdm']!=0	?	number_format($v['sum_k']['rdm'], '2', ',', ' ')	:	'–')?></td>
	<td align="right"><?=@number_format($roasOnRandDate[$roasFieldName]['cpcCost'], '2', ',', ' ')?></td>
	<td align="right"><?=(@$roasOnRandDate[$roasFieldName]['roas'])?></td>
	<?}?>
	<td align="center" width="80"><?=$v['cnt_k']['month']?></td>
	<td align="right" width="100" id="gross_<?=$roasFieldName?>"><?=number_format($v['sum_k']['month'], '2', ',', ' ')?></td>
	<td align="middle" width="80">
		<input type="text" style="width:80px;text-align:right" name="<?=$roasFieldName?>" onkeyup="calcRoas(this.value, this.name)" value="<?=@$roasOnDate[$roasFieldName]['cpcCost']?>"/></td>
	<td width="80" align="right" id="roas_<?=@$roasFieldName?>"><?=(@$roasOnDate[$roasFieldName]['roas'])?></td>
</tr>
<?}//}}//foreach?>
<tr>
	<td colspan="3">CPC угод за минулий тиждень з <b><?=date("D d.m.Y",$minus_one_week_midnight)?></b> по <b><?=date("D d.m.Y",$today_date_from)?></b></td>
	<td align="center" width="80"><b><?=$global_cnt_week?></b></td>
	<td align="right" width="100"><b><?=number_format($global_summ_week, '2', ',', ' ')?></b></td>
	<?if($rand_date_from){?>
	<td align="center" width="80"><b><?=$global_cnt_rdm?></b></td>
	<td align="right" width="100"><b><?=number_format($global_summ_rdm, '2', ',', ' ')?></b></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<?}?>
	<td align="center" width="80">&nbsp;</td>
	<td align="right" width="100">&nbsp;</td>
	<td align="center" width="80">&nbsp;</td>
	<td align="right" width="80">&nbsp;</td>
</tr>
<tr>
	<td colspan="3">CPC угод за поточний місяць</td>
	<td align="center" width="80">&nbsp;</td>
	<td align="right" width="100">&nbsp;</td>
	<?if($rand_date_from){?>
	<td align="center" width="80">&nbsp;</td>
	<td align="right" width="100">&nbsp;</td>
	<td align="right"><?=number_format($roasOnRandDate['google_cpc_month']['cpcCost'], '2', ',', ' ')?></td>
	<td align="right"><?=$roasOnRandDate['google_cpc_month']['roas']?></td>
	<?}?>
	<td align="center" width="80"><b><?=$cpc_cnt_month?></b></td>
	<td align="right" width="100"><b id="gross_google_cpc_month"><?=number_format($cpc_summ_month, '2', ',', ' ')?></b></td>
	<td align="center" width="80"><input type="text" style="width:80px;text-align:right;" name="google_cpc_month" onkeyup="calcRoas(this.value, this.name)" value="<?=$roasOnDate['google_cpc_month']['cpcCost']?>" /></td>
	<td align="right" width="80" id="roas_google_cpc_month"><?=$roasOnDate['google_cpc_month']['roas']?></td>
</tr>
</table>

<p>&nbsp</p>
<p>&nbsp</p>
<p>Замовлення з початку місяця</p>
<?
$db->query("SELECT * FROM orders_crm o WHERE orderResult!='failed' AND orderDate>'".$month_start_day."'");
$phone_orders_general=array();
$phone_orders_cpc=array();
$chat_orders_general=array();
$chat_orders_cpc=array();
while ($f=$db->fetch()){
	if(in_array($f['orderSource'], array('Новий / Дзвінок', 'Існуючий / Дзвінок')))
		$phone_orders_general[]=$f['orderTotal'];
	if(in_array($f['orderSource'], array('Новий / Дзвінок', 'Існуючий / Дзвінок')) && $f['utm_medium']=='cpc')
		$phone_orders_cpc[]=$f['orderTotal'];
	if(in_array($f['orderSource'], array('Новий / Чат на сайті', 'Існуючий / Чат на сайті')))
		$chat_orders_general[]=$f['orderTotal'];
	if(in_array($f['orderSource'], array('Новий / Чат на сайті', 'Існуючий / Чат на сайті')) && $f['utm_medium']=='cpc')
		$chat_orders_cpc[]=$f['orderTotal'];
}
?>
<table class="tbl" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<th>Замовлення</th>
		<th>Кіль-ть</th>
		<th>Сума</th>
		<th>Сер.Чек :)</th>
	</tr>
	<tr>
		<td>Замовлення за телефоном Всі</td>
		<td align="center"><?=count($phone_orders_general)?></td>
		<td align="right"><?=number_format(array_sum($phone_orders_general), 2, ',', ' ')?></td>
		<td align="right"><?=count($phone_orders_general)	?	number_format(ceil(array_sum($phone_orders_general)/count($phone_orders_general)), 2, ',', ' ') : '–'?></td>
	</tr>
	<tr>
		<td>Замовлення за телефоном CPC</td>
		<td align="center"><?=count($phone_orders_cpc)?></td>
		<td align="right"><?=number_format(array_sum($phone_orders_cpc), 2, ',', ' ')?></td>
		<td align="right"><?=count($phone_orders_cpc)	?	number_format(ceil(array_sum($phone_orders_cpc)/count($phone_orders_cpc)), 2, ',', ' ') : '–'?></td>
	</tr>
	<tr>
		<td>Замовлення з чату Всі</td>
		<td align="center"><?=count($chat_orders_general)?></td>
		<td align="right"><?=number_format(array_sum($chat_orders_general), 2, ',', ' ')?></td>
		<td align="right"><?=count($chat_orders_general)	?	number_format(ceil(array_sum($chat_orders_general)/count($chat_orders_general)), 2, ',', ' ') : '–'?></td>
	</tr>
	<tr>
		<td>Замовлення з чату CPC</td>
		<td align="center"><?=count($chat_orders_cpc)?></td>
		<td align="right"><?=number_format(array_sum($chat_orders_cpc), 2, ',', ' ')?></td>
		<td align="right"><?=count($chat_orders_cpc)	?	number_format(ceil(array_sum($chat_orders_cpc)/count($chat_orders_cpc)), 2, ',', ' ') : '–'?></td>
	</tr>
</table>
</body>