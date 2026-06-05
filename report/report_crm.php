<?php
header("content-type: text/html;charset=utf-8 \r\n");
require("auth.php");
if($_SESSION['admin_lvl']!='top'){
	unset($_SESSION['admin_name']);
	header("location:/report/index.html");
	exit();
}
include("../include/strlib.php");


$today_date_from	=	strtotime("today");
$today_date_from_plus_yesterday_evening	=	date("U",strtotime('yesterday 19:30:00'));
$today_date_to		=	date("U",strtotime(date("Y-m-dT23:59:00", time())));
$yesterday_date_from		=	strtotime("yesterday");
$month_start_day	=	strtotime("first day of ".date("M", (time())));
$minus_one_week_midnight	=	$ddd=date("U",strtotime('-1 week midnight'));
$minus_two_weeks_midnight	=	$ddd=date("U",strtotime('-2 week midnight'));
$minus_one_month_midnight	=	$ddd=date("U",strtotime('-1 month midnight'));

$mainResponsible_array=array(
				
				'2'=>'Анна Гарькава',
				'3'=>'Інна Коваленко',
				'4'=>'Катерина Малієва',
				'8'=>'Елла Шамсієва',
				'7'=>'Магазин Перемоги',
				'0'=>'Необроблений',
				'1'=>'Дмитро Жинжиков',
				'14'=>'Маргарита Шустик'
);
$funnelIDDs=array(
				'1'=>'Роздріб',
				'3'=>'Пересадка',
				'2'=>'Фітодизайн',
				'5'=>'Тендер',
				'4'=>'Флористика'
);

/*
echo "<br /><br />";
echo date("Y-m-d-H:i:s", $today_date_from);
echo "<br />".date("Y-m-d-H:i:s",$today_date_to);
echo "<br />".date("Y-m-d-H:i:s",$month_start_day);
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
</head>
<body>


<?include("top_menu.php")?>
<h1>Звіт по угодам в CRM</h1>

<?
//print_r( date_parse('2025-07-17T23:17:37.437Z'));
// echo "<br /><br />", $ddd=date("U",strtotime('yesterday 19:30:00'));
// echo "<br /><br />",date("Y-m-d::H:i:s", $ddd);
?>
<?
//=====================================================================
//=====================================================================
?>
<?
$orders_summ_today=0;
$orders_cnt_today=0;
$orders_summ_month=0;
$orders_cnt_month=0;
$person_array=array();
$funnel_array=array();

//======TODAY=======
$db->query("SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$today_date_from_plus_yesterday_evening."' AND '".$today_date_to."' AND orderResult!='failed'");
//	echo "SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$today_date_from_plus_yesterday_evening."' AND '".$today_date_to."' AND orderResult!='failed'";
while ($rs=$db->fetch()){
	$orders_summ_today+=$rs['orderTotal'];
	$orders_cnt_today++;
	if(array_key_exists($rs['mainResponsibleID'], $person_array)){
		$person_array[$rs['mainResponsibleID']]['ttl']['today']+=$rs['orderTotal'];
		$person_array[$rs['mainResponsibleID']]['cnt']['today']++;
	}else{
		$person_array[$rs['mainResponsibleID']]['ttl']['today']=$rs['orderTotal'];
		$person_array[$rs['mainResponsibleID']]['cnt']['today']=1;
	}
	if(array_key_exists($rs['orderFunnel'], $funnel_array)){
		$funnel_array[$rs['orderFunnel']]['ttl']['today']+=$rs['orderTotal'];
		$funnel_array[$rs['orderFunnel']]['cnt']['today']++;
	}else{
		$funnel_array[$rs['orderFunnel']]['ttl']['today']=$rs['orderTotal'];
		$funnel_array[$rs['orderFunnel']]['cnt']['today']=1;
	}
	
}
//=======MONTH
$db->query("SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$month_start_day."' AND '".$today_date_to."' AND orderResult!='failed'");
while ($rs=$db->fetch()){
	$orders_summ_month+=$rs['orderTotal'];
	$orders_cnt_month++;
	if(array_key_exists($rs['mainResponsibleID'], $person_array) && array_key_exists('month', $person_array[$rs['mainResponsibleID']]['ttl'])){
		$person_array[$rs['mainResponsibleID']]['ttl']['month']+=$rs['orderTotal'];
		$person_array[$rs['mainResponsibleID']]['cnt']['month']++;
	}else{
		$person_array[$rs['mainResponsibleID']]['ttl']['month']=$rs['orderTotal'];
		$person_array[$rs['mainResponsibleID']]['cnt']['month']=1;
	}
	if(array_key_exists($rs['orderFunnel'], $funnel_array) && array_key_exists('month', $funnel_array[$rs['orderFunnel']]['ttl'])){
		$funnel_array[$rs['orderFunnel']]['ttl']['month']+=$rs['orderTotal'];
		$funnel_array[$rs['orderFunnel']]['cnt']['month']++;
	}else{
		$funnel_array[$rs['orderFunnel']]['ttl']['month']=$rs['orderTotal'];
		$funnel_array[$rs['orderFunnel']]['cnt']['month']=1;
	}
}

?>
<h3>Сьогодні</h3>
<table class="tbl" cellpadding="0" cellspacing="0" border="0">
	<tr align="center">
		<td>&nbsp;</td>
		<td colspan="2"><b>Сьогодні</b></td>
		<td colspan="2"><b>Місяць</b></td>
	</tr>
	<?
	foreach($mainResponsible_array AS $k=>$v){
	?>
	<tr>
		<td width="120"><?=$v?></td>
		<td align="center" width="100"><?=(isset($person_array[$k]['cnt']['today']) ?	$person_array[$k]['cnt']['today']	: "–")?></td>
		<td align="right" width="120"><?=(isset($person_array[$k]['ttl']['today'])	?	number_format($person_array[$k]['ttl']['today'], '2', ',', ' ')	: "–")?></td>
		<td align="center" width="100"><?=(isset($person_array[$k]['cnt']['month']) ?	$person_array[$k]['cnt']['month']	: "–")?></td>
		<td align="right" width="120"><?=(isset($person_array[$k]['ttl']['month'])	?	number_format($person_array[$k]['ttl']['month'], '2', ',', ' ')	: "–")?></td>
	</tr>
	<?}// foreach?>
	<tr>
		<td>&nbsp;</td>
		<td align="center"><b><?=$orders_cnt_today?></b></td>
		<td align="right"><b><?=number_format($orders_summ_today, '2', ',', ' ')?></b></td>
		<td align="center"><b><?=$orders_cnt_month?></b></td>
		<td align="right"><b><?=number_format($orders_summ_month, '2', ',', ' ')?></b></td>
	</tr>
</table>
<table class="tbl" cellpadding="0" cellspacing="0" border="0">
	<?
	
	foreach($funnelIDDs AS $k=>$v){
	?>
	<tr>
		<td width="120"><?=$v?></td>
		<td align="center" width="100"><?=(isset($funnel_array[$k]['cnt']['today']) ?	$funnel_array[$k]['cnt']['today']	: "–")?></td>
		<td align="right" width="120"><?=(isset($funnel_array[$k]['ttl']['today'])	?	number_format($funnel_array[$k]['ttl']['today'], '2', ',', ' ')	: "–")?></td>
		<td align="center" width="100"><?=(isset($funnel_array[$k]['cnt']['month']) ?	$funnel_array[$k]['cnt']['month']	: "–")?></td>
		<td align="right" width="120"><?=(isset($funnel_array[$k]['ttl']['month'])	?	number_format($funnel_array[$k]['ttl']['month'], '2', ',', ' ')	: "–")?></td>
	</tr>
	<?}// foreach?>
</table>

<?
//=====================================================================
//=====================================================================
?>
<h3>Місяць</h3>
<?
$month_array=array();
for ($i = $minus_one_month_midnight; $i <= $yesterday_date_from; $i = strtotime('+1 day', $i)) {
    $month_array[] = date('Y-m-d', $i);
}
//print_r($month_array);

$sql_month_data=array();
$db->query("SELECT FROM_UNIXTIME(orderDate, '%Y-%m-%d') AS oDate,  COUNT(*) AS cnt, SUM(orderTotal) AS ttl FROM orders_crm WHERE orderDate BETWEEN '".$minus_one_month_midnight."' AND '".$today_date_from."' AND orderResult!='failed' GROUP BY FROM_UNIXTIME(orderDate, '%D') ORDER BY orderDate DESC;");


while($rs=$db->fetch()){
	$sql_month_data[$rs['oDate']]=$rs; 
}
//print_r($sql_month_data);
$ukr_day_names=array(
	'Monday'=>'Пн',
	'Tuesday'=>'Вт',
	'Wednesday'=>'Ср',
	'Thursday'=>'Чт',
	'Friday'=>'Пт',
	'Saturday'=>'Сб',
	'Sunday'=>'Нд'
);
$ukr_day_offs=array('Сб', 'Нд');
?>
<table class="tbl" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<? foreach ($month_array AS $v){	?>
		<td width="40" align="center"<?if(in_array($ukr_day_names[date("l", strtotime($v))], $ukr_day_offs)){?> bgcolor="#EEE7DF"<?}?>>
			<p><b><?=$ukr_day_names[date("l", strtotime($v))];?><br /><?=date("d.m", strtotime($v))?></b></p>
			<p><?=(isset($sql_month_data[$v])	?	$sql_month_data[$v]['cnt'] : "–")?></p>
			<p><nobr><?=(isset($sql_month_data[$v])	?	number_format($sql_month_data[$v]['ttl'], '2', ',', ' ')	: "–")?></nobr></p>
		</td>
		
		<?}?>
	</tr>
</table>



<?
//=====================================================================
//=====================================================================
?>


<?
$utm_array=array();
//=======MONTH
$db->query("SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$month_start_day."' AND '".$today_date_from."' AND orderResult!='failed' ORDER BY utm_source DESC, utm_medium DESC, utm_campaign DESC");
//echo "SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$month_start_day."' AND '".$today_date_to."' ORDER BY utm_source DESC, utm_medium DESC, utm_campaign DESC";
while($rs=$db->fetch()){
		$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['month'][]=$rs['orderTotal'];
		$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['week']=array();
}
//========WEEEK
$db->query("SELECT * FROM orders_crm WHERE orderDate BETWEEN '".$minus_one_week_midnight."' AND '".$today_date_from."' AND orderResult!='failed' ORDER BY utm_source DESC, utm_medium DESC, utm_campaign DESC");
//echo "SELECT COUNT(*), SUM(orderTotal) FROM orders_crm WHERE orderDate BETWEEN '1752699600' AND '1753304400'";
while($rs=$db->fetch()){
		$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['week'][]=$rs['orderTotal'];
		if(!isset($utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['month'])){
			$utm_array[$rs['utm_source']][$rs['utm_medium']][mb_strtolower($rs['utm_campaign'], 'UTF-8')]['month']=array();
		}
}

//print_r($utm_array);
?>

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
		//	echo '<br>'.$k.'=='.$kk;
			
			if($k=='google' && $kk=='cpc') {
		//		print_r($vvv);
		//		echo "<br>";
				$cpc_cnt_month+=count(array_filter($vvv['month']));	//count non-empty values
				$cpc_summ_month+=array_sum($vvv['month']);
				$cpc_cnt_week+=count(array_filter($vvv['week']));	//count non-empty values
				$cpc_summ_week+=array_sum($vvv['week']);
			}
		//	echo '<br>'.$cpc_summ.'<br><br>';
		$new_utm_arr[]['utm_source']=$utm_source;
		$new_utm_arr[count($new_utm_arr)-1]['utm_medium']=$utm_medium;
		$new_utm_arr[count($new_utm_arr)-1]['utm_campaign']=$utm_campaign;
		$new_utm_arr[count($new_utm_arr)-1]['cnt_k']['month']=$cnt_k_month;
		$new_utm_arr[count($new_utm_arr)-1]['sum_k']['month']=$sum_k_month;
		$new_utm_arr[count($new_utm_arr)-1]['cnt_k']['week']=$cnt_k_week;
		$new_utm_arr[count($new_utm_arr)-1]['sum_k']['week']=$sum_k_week;

}}}
/*
usort($new_utm_arr, function($a, $b){
    return ($a['sum_k'] - $b['sum_k']);
});
*/
foreach($new_utm_arr AS $k=>$v){
?>
<tr>
	<td><?=$v['utm_source']?></td>
	<td><?=$v['utm_medium']?></td>
	<td><?=$v['utm_campaign']?></td>
	<td align="center" width="80"><?=($v['cnt_k']['week']!=0	?	$v['cnt_k']['week']		:	'–')?></td>
	<td align="right" width="100"><?=($v['sum_k']['week']!=0	?	number_format($v['sum_k']['week'], '2', ',', ' ')	:	'–')?></td>
	<td align="center" width="80"><?=$v['cnt_k']['month']?></td>
	<td align="right" width="100"><?=number_format($v['sum_k']['month'], '2', ',', ' ')?></td>
</tr>
<?}//}}//foreach?>
<tr>
	<td colspan="3">Всього угод за минулий тиждень з <b><?=date("D d.m.Y",$minus_one_week_midnight)?></b> по <b><?=date("D d.m.Y",$today_date_from)?></b></td>
	<td align="center" width="80"><b><?=$global_cnt_week?></b></td>
	<td align="right" width="100"><b><?=number_format($global_summ_week, '2', ',', ' ')?></b></td>
	<td align="center" width="80"><b><?=$global_cnt_month?></b></td>
	<td align="right" width="100"><b><?=number_format($global_summ_month, '2', ',', ' ')?></b></td>
</tr>
<tr>
	<td colspan="3">CPC угод за минулий тиждень з <b><?=date("D d.m.Y",$minus_one_week_midnight)?></b> по <b><?=date("D d.m.Y",$today_date_from)?></b></td>
	<td align="center" width="80"><b><?=$cpc_cnt_week?></b></td>
	<td align="right" width="100"><b><?=number_format($cpc_summ_week, '2', ',', ' ')?></b></td>
	<td align="center" width="80"><b><?=$cpc_cnt_month?></b></td>
	<td align="right" width="100"><b><?=number_format($cpc_summ_month, '2', ',', ' ')?></b></td>
</tr>
</table>


<?
$source_array=array();
$db->query("SELECT * FROM orders_crm 
				WHERE orderDate BETWEEN '".$month_start_day."' AND '".$today_date_from."'
				AND orderResult!='failed'
				AND utm_source=''");
//echo "SELECT COUNT(*), SUM(orderTotal) FROM orders_crm WHERE orderDate BETWEEN '1752699600' AND '1753304400'";
while($rs=$db->fetch()){
		$source_array[$rs['orderSource']][]=$rs['orderTotal'];
}
$source_cnt_month=0;
$source_summ_month=0;
$new_source_arr=array();
foreach($source_array AS $k=>$v){
	$source_name=$k;
	$source_cnt_month+=count($v);		//	cnt total agreements
	$source_summ_month+=array_sum($v);	//	summ total agreements
	
	$new_source_arr[$source_name]=array('cnt'=>count($v), 'summ'=>array_sum($v));
}
?>
<table class="tbl" cellpadding="0" cellspacing="0" border="0">
<?
foreach($new_source_arr AS $k=>$v){
?>
<tr>
	<td><?=$k?></td>
	<td align="center" width="80"><?=$v['cnt']?></td>
	<td align="right" width="120"><?=number_format($v['summ'], '2', ',', ' ')?></td>
</tr>
<?}?>
<tr>
	<td>&nbsp;</td>
	<td align="center" width="80"><b><?=$source_cnt_month?></b></td>
	<td align="right" width="120"><b><?=number_format($source_summ_month, '2', ',', ' ')?></b></td>
</tr>
</table>
</body>