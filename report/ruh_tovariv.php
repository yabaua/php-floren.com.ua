<?php
header("content-type: text/html;charset=utf-8 \r\n");
require("auth.php");
if($_SESSION['admin_lvl']!='top'){
	unset($_SESSION['admin_name']);
	header("location:/report/index.html");
	exit();
}
include("../include/strlib.php");
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

<?
$months_names =  array('01'=>"Січ",'02'=>"Лют", '03'=>"Бер", '04'=>"Кві",'05'=>"Тра", '06'=>"Чер",'07'=>"Лип",'08'=>"Сер", '09'=>"Вер", '10'=>"Жов", '11'=>"Лис", '12'=>"Гру");


$year=date('Y', time());
if(isset($_REQUEST['ch_year'])) $year=$_REQUEST['ch_year'];

$curMonth=strlen(date('m',time()))==2?date('m',time()):'0'.(date('m',time()));
$month=array($curMonth);
if(isset($_REQUEST['ch_month'])) $month=$_REQUEST['ch_month'];
?>

<form action="ruh_tovariv.php" id="editForm" method="post">
<input type="hidden" name="action" value="search" />



<div style="background-color: orange; width: 40%; text-align: center;" id="message"></div>

<div class="holder" style="padding:5px;">
<?
for($i=1;$i<=12;$i++){
(strlen($i)<2)?$ii='0'.$i:$ii=$i;

?>
	
	<div class="checkbox-wrapper-16">
	  <label class="checkbox-wrapper">
	    <input name="ch_month[]" value="<?=$ii;?>" type="checkbox" class="checkbox-input"<?=(in_array($ii, $month)?' checked="true"':'')?> />
	    <span class="checkbox-tile">
	      <span class="checkbox-label"><?=$months_names[$ii]?></span>
	    </span>
	  </label>
	</div>
<?} // for?>
  
</div>

<div style="background-color: orange; width: 40%; text-align: center;" id="message"></div>

	<div class="holder" style="padding:5px;">
	<div class="checkbox-wrapper-16">
	  <label class="checkbox-wrapper">
	    <input name="ch_year" value="2022" type="radio" class="checkbox-input"<?=($year=='2022')?' checked="true"':''?> />
	    <span class="checkbox-tile">
	      <span class="checkbox-label">2022</span>
	    </span>
	  </label>
	</div>
	<div class="checkbox-wrapper-16">
	  <label class="checkbox-wrapper">
	    <input name="ch_year" value="2023" type="radio" class="checkbox-input"<?=($year=='2023')?' checked="true"':''?>  />
	    <span class="checkbox-tile">
	      <span class="checkbox-label">2023</span>
	    </span>
	  </label>
	</div>
	<div class="checkbox-wrapper-16">
	  <label class="checkbox-wrapper">
	    <input name="ch_year" value="2024" type="radio" class="checkbox-input"<?=($year=='2024')?' checked="true"':''?> />
	    <span class="checkbox-tile">
	      <span class="checkbox-label">2024</span>
	    </span>
	  </label>
	</div>
	<div class="checkbox-wrapper-16">
	  <label class="checkbox-wrapper">
	    <input name="ch_year" value="2025" type="radio" class="checkbox-input"<?=($year=='2025')?' checked="true"':''?> />
	    <span class="checkbox-tile">
	      <span class="checkbox-label">2025</span>
	    </span>
	  </label>
	</div>
  
</div>

<?
$query_string = '';
if(isset($_REQUEST['good_name']))
	$query_string = $_REQUEST['good_name'];
	
$searchtype='';
if(isset($_REQUEST['searchtype'])) $searchtype=$_REQUEST['searchtype'];
?>

<script>
function selectByClass(){
	document.getElementById('searchByGroup').checked=true;
	document.getElementById('good_name').value='';
}
function selectByName(){
	document.getElementById('searchByName').checked=true;
	options = document.getElementsByTagName("option");
    	for ( i=0; i<options.length; i++){
    		options[i].selected = false;
    	}
}

function selectAll(){
    	options = document.getElementsByTagName("option");
    	for ( i=0; i<options.length; i++){
    		options[i].selected = "true";
    	}
    	selectByClass();
    }
function selectNone(){
    	options = document.getElementsByTagName("option");
    	for ( i=0; i<options.length; i++){
    		options[i].selected = false;
    	}
    }

</script>
<div class="holder">
	<div class="radio-wrapper-9">
	  <input id="searchByName" type="radio" name="searchtype" value="searchByName"<?=($searchtype=='searchByName')?' checked="true"':''?> />
	  <label for="searchByName">Пошук по назві</label>
	</div>
    <div>
            <input type="text" id="good_name" name="good_name" value="<?=$query_string?>" class="input_type" style="width: 300px;max-width:70%;" autocomplete="off" tabindex="1" onfocus="selectByName()" /> 
	</div>
</div>

<div class="holder">
	<div class="radio-wrapper-9">
	  <input id="searchByGroup" type="radio" name="searchtype" value="searchByGroup"<?=($searchtype=='searchByGroup')?' checked="true"':''?> />
	  <label for="searchByGroup">Дані по групах</label>
	</div>
</div>
<div style="width:300px;overflow:hidden;padding:4px 0;">
	<div onclick="selectAll()" style="display:block;cursor:pointer;width:100px;float:left">Обрати всі</div>
	<div onclick="selectNone()" style="display:block;cursor:pointer;width:100px;float:right;text-align:right;">Очистити</div>
</div>
<select name="classNames[]" onfocus="selectByClass()" id="classNames" multiple style="width:300px;height:200px;">
<?
	$qr=mysql_query("SELECT className FROM goods_1c_class GROUP BY className;");
	while($rs=mysql_fetch_array($qr)){
		//if(!$rs['className']) $rs['className']='Головний екран'
		$selected='';
		if(isset($_REQUEST['classNames'])){
			if(in_array($rs['className'], $_REQUEST['classNames'])) $selected=' selected="selected"';
		}
?>
  <option value="<?=$rs['className']?>"<?=$selected?>><?=$rs['className']?></option>
<?}?>
</select>
<p>&nbsp;</p>
<input type="submit" style="width: 100px;max-width:19%;" class="button" value="Пошук" tabindex="2"/>

</form>

<?
if (isset($_REQUEST['action']) && $_REQUEST['action']=="search"){



if($searchtype!='') {
		
		$sqlYear=$year;
		$sqlMonth="report_month IN ('".implode("','",$month)."')";
		
		
		$sqlSearchType= "";
		if($searchtype=='searchByName' && strlen($query_string)>3 && !strpos($query_string, "%")>0){
			$sqlSearchType="g.name LIKE '%".mysql_real_escape_string($query_string)."%' OR g.barcode LIKE '%".mysql_real_escape_string($query_string)."%'";

		} elseif($searchtype=='searchByGroup' && isset($_REQUEST['classNames'])) {
	     	$sql_className=implode("','", $_REQUEST['classNames']);
	     	$sqlSearchType = "g.className IN ('".$sql_className."')";
		}
		else{
			echo "Нічого не знайдено 3";
			exit();
		}
		
		$query=
		
		$query = "SELECT g.*, SUM(rg.qt) AS sell_qt, SUM(rg.gross) AS sell_gross
	        FROM goods_1c_class g
	        LEFT JOIN report_goods rg ON g.barcode=rg.barcode AND (rg.report_year='".$sqlYear."' AND rg.".$sqlMonth.")
	        WHERE ".$sqlSearchType."
	        GROUP BY g.barcode";
	        
	//	echo $query;
		$goods_list=array();
		$db->query($query);
		while($rs=$db->fetch()){
		//	if($searchtype!='searchByName' && $rs['sell_gross']==0) continue;
			
			$goods_list[$rs['barcode']]['name']			= 	$rs['name'];
			$goods_list[$rs['barcode']]['sell_qt']		= 	$rs['sell_qt'];
			$goods_list[$rs['barcode']]['sell_gross']	=	$rs['sell_gross'];
			$rs['sell_qt']<1	?	$goods_list[$rs['barcode']]['sell_qt_class']='zero' : $goods_list[$rs['barcode']]['sell_qt_class']='sell_full' ;
			
		}
	    $query = "SELECT g.*, SUM(rgz.qt) AS zakupki_qt, SUM(rgz.gross) AS zakupki_gross, AVG(rgz.price) AS avg_price
	        FROM goods_1c_class g
	        LEFT JOIN report_goods_zakupki rgz ON g.barcode=rgz.barcode AND (rgz.report_year='".$sqlYear."' AND rgz.".$sqlMonth.")
	        WHERE ".$sqlSearchType."
	        GROUP BY g.barcode";
	    $db->query($query);
		while($rs=$db->fetch()){
		//	if(!isset($goods_list[$rs['barcode']])) continue;
			
			$goods_list[$rs['barcode']]['zakupki_qt']	= $rs['zakupki_qt'];
			$goods_list[$rs['barcode']]['zakupki_gross']	= $rs['zakupki_gross'];
			$goods_list[$rs['barcode']]['zakupki_price'] = round($rs['avg_price'], 2);
			$rs['zakupki_qt']<1		?	$goods_list[$rs['barcode']]['zakupki_qt_class']='zero' : $goods_list[$rs['barcode']]['zakupki_qt_class']='full' ;	
		}    
	    $query = "SELECT g.*, SUM(rgs.qt) AS writeoff_qt, SUM(rgs.gross) AS writeoff_gross
	        FROM goods_1c_class g
	        LEFT JOIN report_goods_spisanie rgs ON g.barcode=rgs.barcode AND (rgs.report_year='".$sqlYear."' AND rgs.".$sqlMonth.")
	        WHERE ".$sqlSearchType."
	        GROUP BY g.barcode";
	    $db->query($query);
		while($rs=$db->fetch()){
		//	if(!isset($goods_list[$rs['barcode']])) continue;
			$goods_list[$rs['barcode']]['writeoff_qt']	= $rs['writeoff_qt'];
			$goods_list[$rs['barcode']]['writeoff_gross']	= $rs['writeoff_gross'];
			$rs['writeoff_qt']<1	?	$goods_list[$rs['barcode']]['writeoff_qt_class']='zero' : $goods_list[$rs['barcode']]['writeoff_qt_class']='writeoff_full' ;
		}    
	    $query = "SELECT g.*, g1c.f1_stock+g1c.f2_stock AS stock,g1c.price
	        FROM goods_1c_class g
	        LEFT JOIN goods_1c g1c ON g.barcode=g1c.barcode
	        WHERE ".$sqlSearchType."
	        GROUP BY g.barcode";
	    $db->query($query);
		while($rs=$db->fetch()){
		//	if(!isset($goods_list[$rs['barcode']])) continue;
			$goods_list[$rs['barcode']]['stock']=$rs['stock'];
			$goods_list[$rs['barcode']]['price']=$rs['price'];
			$rs['stock']==0		?	$goods_list[$rs['barcode']]['stock_class']='zero' : $goods_list[$rs['barcode']]['stock_class']='full' ; ;
		}
		
		foreach($goods_list AS $k=>$v){
				$goods_list[$k]['delta']=$v['sell_gross']-$v['zakupki_gross'];
		}
		
		if(count($goods_list)){
		
		foreach($goods_list AS $k=>$v){
			$goods_list_delta[$k]=$v['delta'];	
		}
		arsort($goods_list_delta);
		/*
		foreach($goods_list AS $k=>$v){
				$goods_list[$k]['delta']=$v['sell_gross']-$v['zakupki_gross'];
				
				$barcode	= array_column($goods_list_new, $k);
				$name		= array_column($goods_list_new, $v['name']);
				$price		= array_column($goods_list_new, $v['price']);
				$stock		= array_column($goods_list_new, $v['stock']);

		}
		*/
		
	

?>

<table cellpadding="0" cellspacing="0" class="tbl">
	<thead class="adm-table__head">
				<th>Штрих Код</th>
				<th>Назва</th>
				<th>Закуп.</th>
				<th>Роздр.</th>
				<th>Націнка</th>
				<th>На складі</th>
				<th>Закуплено</th>
				<th>Продано</th>
				<th>Списано</th>
				<th>Гроші</th>
				<th>Рентаб</th>
    </thead>
    <tbody id="listTable">
    <?
    	$summ_delta=0;
    	$summ_sell=0;
    	$summ_zakupki=0;
    	$summ_writeoff=0;
    	$summ_sklad_opt=0;
    	$summ_sklad_rozdrib=0;
    	
    	
    	foreach ($goods_list_delta AS $k=>$v){
    		
    		if(
    			!$goods_list[$k]['sell_gross']
    			&&
    			!$goods_list[$k]['zakupki_gross']
    			&&
    			!$goods_list[$k]['writeoff_gross']
    		) continue;
    		
    		$summ_delta+=$v;
    		$summ_sell+=$goods_list[$k]['sell_gross'];
    		$summ_zakupki+=$goods_list[$k]['zakupki_gross'];
    		$summ_sklad_opt+=$goods_list[$k]['stock']*$goods_list[$k]['zakupki_price'];
    		$summ_sklad_rozdrib+=$goods_list[$k]['stock']*$goods_list[$k]['price'];
    		$summ_writeoff+=$goods_list[$k]['writeoff_gross'];
    		
    		$rentability=0;
    		if($goods_list[$k]['sell_gross']!=0){
    			$rentability=($goods_list[$k]['sell_gross']-$goods_list[$k]['zakupki_gross'])/$goods_list[$k]['sell_gross']*100;
    			$rentability=number_format(($rentability), '1', ',', ' ');
    		}
    			if($rentability>50)			$rentability_string='<b class="sell_full">'.$rentability.'%</b>';
    			elseif($rentability<0)		$rentability_string='<b class="writeoff_full">'.$rentability.'%</b>';
    			elseif ($rentability==0)	$rentability_string='-';
    			else 						$rentability_string='<b>'.$rentability.'%</b>';
    		
    		$writeoff_percent=0;
    		if($goods_list[$k]['zakupki_gross']>0)
    			$writeoff_percent=$goods_list[$k]['writeoff_gross']/$goods_list[$k]['zakupki_gross']*100;
    			
    		
    ?>
       <tr>
			<td class="barcode"><?=$k?></td>
			<td class="good_name"><?=$goods_list[$k]['name']?></td>
			<td align="right"><?=$goods_list[$k]['zakupki_price']?></td>
			<td align="right"><?=$goods_list[$k]['price']?></td>
			<td align="right"><?=$goods_list[$k]['zakupki_price'] >0 ? round((($goods_list[$k]['price']-$goods_list[$k]['zakupki_price'])/$goods_list[$k]['zakupki_price']*100)) : 0?>%</td>
			<td align="center" class="<?=$goods_list[$k]['stock_class']?>"><b><?=($goods_list[$k]['stock']>0?$goods_list[$k]['stock']:'-')?></b></td>
			<td align="center" class="<?=$goods_list[$k]['zakupki_qt_class']?>"><b><?=($goods_list[$k]['zakupki_qt']>0?$goods_list[$k]['zakupki_qt']:'-')?></b></td>
			<td align="center" class="<?=$goods_list[$k]['sell_qt_class']?>"><b><?=($goods_list[$k]['sell_qt']>0?$goods_list[$k]['sell_qt']:'-')?></b></td>
			<td align="center" class="<?=$goods_list[$k]['writeoff_qt_class']?>"><b><?=($goods_list[$k]['writeoff_qt']>0?$goods_list[$k]['writeoff_qt']:'-')?><?=$writeoff_percent>0?(' | '.number_format(($writeoff_percent), '1', ',', ' ').'%'):'';?></b></td>
			<td align="right"><?=number_format(($v), '2', ',', ' ')?></td>
			<td align="right"><?=$rentability_string?></td>
		</tr>
	<?}?>
		<tr align="center" valign="center">
			<td colspan="5"><b>Загалом:</b></td>
			<td><b>Опт:<?=number_format(($summ_sklad_opt), '2', ',', ' ')?><br />Роз:<?=number_format(($summ_sklad_rozdrib), '2', ',', ' ')?></b></td>
			<td><b><?=number_format(($summ_zakupki), '2', ',', ' ')?></b></td>
			<td class="sell_full"><b><?=number_format(($summ_sell), '2', ',', ' ')?></b><br /><b><?=number_format((($summ_sell-$summ_zakupki)/$summ_sell*100), '1', ',', ' ')?>%</td>
			<td class="writeoff_full"><b><?=number_format(($summ_writeoff), '2', ',', ' ')?></b><br /><b><?=number_format(($summ_writeoff/$summ_zakupki*100), '1', ',', ' ')?>%</b></td>
			<td><b><?=number_format(($summ_delta), '2', ',', ' ')?></b></td>
			<td>&nbsp;</td>
		</tr>
    </tbody>
</table>
<?
	}else{
		echo "Нічого не знайдено";
	}// if something find in DB
}else{
		echo "Нічого не знайдено 2";
}//if > 0 and !%
?>
<?}//php?>



</html>