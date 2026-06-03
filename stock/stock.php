<?php
header("content-type: text/html;charset=utf-8 \r\n");
require("../database.php");
include("../include/strlib.php");
session_start();
setlocale(LC_ALL, "ru_RU.UTF-8");
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Залишки товарів</title>
</head>
<body>
<style>
body{
    font: normal 1em/1 Arial, helvetica, sans-serif;
    line-height: 1.42857143;
}
.holder{
    overflow:hidden;
    padding-top:10px;
}
.button {
	text-align:center;
	color: #4D4D4D;
	border:1px solid #CABCAA;
	background: #EEE7DF;
	font-size:19px;
	font-weight:normal;
	padding:2px 5px;
	cursor:pointer;
	cursor:hand;
}
.input_type, .inp{
	font-family: arial, tahoma;
	height:26px;
	font-size: 15px;
	padding:0 5px;
	color: #4D4D4D;
	border:1px solid #CABCAA;
}
   .tbl{
	border-top:1px solid #CEC2B3;
	border-left:1px solid #CEC2B3;
}
	.tbl td, .tbl th{
		border-bottom:1px solid #CEC2B3;
		border-right:1px solid #CEC2B3;
		padding:3px 10px;
	}
	.good_name b{
		color:#5F1C13 !important;
		font-weight:bold;
		}
	.tbl th{
		background:#EEE7DF;
	}
	.zero{
		color:#AFAFAF;	
	}
	.full{
		font-weight:bold;	
	}
	.writeoff_full{
		font-weight:bold;
		color:#DD0000;
	}
	.barcode{
		color:#777777;	
	}
			.barcode b{
				color:#5F1C13 !important;
				font-weight:bold;
			}

@media (max-width:768px){
   	.tbl th, .barcode {font-size: .7em}
}
.menu_buttons{
	padding:10px 0;
}
.menu_buttons a {
	display:block;
	float:left;
	margin-right:10px;
	padding:4px 10px;
	color:#FFFFFF;
	background:#5F1C13;
	text-decoration:none;
}
</style>

<div class="holder menu_buttons">
	<a href="/stock/stock.php" target="main">Наші Залишки</a>
	<a href="/stock/lechuza.php" target="main">Lechuza</a>
	<a href="/stock/to_order.php" target="main">Товари Під Замовлення</a>
</div>
<form action="stock.php" id="editForm" method="post">
<input type="hidden" name="action" value="search" />
<div style="background-color: orange; width: 40%; text-align: center;" id="message"></div>
<?
$db->query("SELECT * FROM admins WHERE login='adm'");
$rs=$db->fetch();
?>
<p style="font-size:.8em;">1С віддав залишки за <?=date("Y.m.d, H:i", $rs['1c_file_updated_at'])?> ми завантажили їх <?=date("Y.m.d, H:i", $rs['www_stock_updated_at'])?></p>
<?
$query_string = '';
if(isset($_REQUEST['good_name']))
	$query_string = $_REQUEST['good_name'];
?>
<div class="holder">
    <p>Назва або штрихкод:</p>
    <p>
            <input type="text" id="good_name" name="good_name" value="<?=$query_string?>" class="input_type" style="width: 300px;max-width:70%;" autocomplete="off" tabindex="1" /> <input type="submit" style="width: 100px;max-width:19%;" class="button" value="Пошук" tabindex="2"/>
    </p>
</div>
</form>

<?
if (isset($_REQUEST['action']) && $_REQUEST['action']=="search"){



if(!strlen($query_string)<3 /*&& !strpos($query_string, "%")>0*/) {
		$sqlYear=date('Y', time());
		$curMonth=strlen(date('m',time()))==2?date('m',time()):'0'.(date('m',time()));
		$prevMonth=strlen(date('m',time())-1)==2?date('m',time()):'0'.(date('m',time())-1);
		
		$sqlMonth="report_month IN ('".$curMonth."', '".$prevMonth."')";

		$query = "SELECT g.*
	        FROM goods_1c g
	        WHERE g.name LIKE '%".mysql_real_escape_string($query_string)."%' OR g.barcode LIKE '%".mysql_real_escape_string($query_string)."%'
	        GROUP BY g.barcode
	        ORDER BY g.f2_stock DESC,g.f1_stock DESC, g.price DESC";
		
		$goods_list=array();
		$db->query($query);
		while($rs=$db->fetch()){
			$goods_list[$rs['ID']]=$rs;
			/*
			$qqq=substr($rs['name'], stripos($rs['name'], $query_string), strlen($query_string));
			
			$goods_list[$rs['ID']]['new_name']		=str_replace($qqq, '<b>'.$qqq.'</b>', $rs['name']);
			$goods_list[$rs['ID']]['new_barcode']	=str_replace($query_string, '<b>'.$query_string.'</b>', $rs['barcode']);
			*/
			
			$encoding = 'UTF-8';
			$pos = mb_stripos($rs['name'], $query_string, 0, $encoding);
			if ($pos !== false) {
		    $qqq = mb_substr($rs['name'], $pos, mb_strlen($query_string, $encoding), $encoding);
		    $goods_list[$rs['ID']]['new_name'] =	str_replace($qqq, '<b>'.$qqq.'</b>', $rs['name']);
			}else{
				$goods_list[$rs['ID']]['new_name'] = $rs['name'];
			}
			
			
			$goods_list[$rs['ID']]['new_barcode'] = str_replace($query_string, '<b>'.$query_string.'</b>', $rs['barcode']);
			
			$rs['f1_stock']==0		?	$goods_list[$rs['ID']]['f1_class']='zero' : $goods_list[$rs['ID']]['f1_class']='full' ;
			$rs['f2_stock']==0		?	$goods_list[$rs['ID']]['f2_class']='zero' : $goods_list[$rs['ID']]['f2_class']='full' ;
			
		}
		
		if(count($goods_list)){
?>

<table cellpadding="0" cellspacing="0" class="tbl">
	<thead class="adm-table__head">
				<th>Штрих Код</th>
				<th>Назва</th>
				<th>Ціна</th>
				<th>Основний</th>
				<th>Склад Ф2</th>
				<th>Резерв</th>
    </thead>
    <tbody id="listTable">
    <?
    	foreach ($goods_list AS $k=>$v){
    ?>
       <tr>
			<td class="barcode"><?=$v['new_barcode']?></td>
			<td class="good_name"><?=$v['new_name']?></td>
			<td align="right"><?=number_format(($v['price']), '2', ',', ' ')?></td>
			<td align="center" class="<?=$v['f1_class']?>"><?=$v['f1_stock']?></td>
			<td align="center" class="<?=$v['f2_class']?>"><?=$v['f2_stock']?></td>
			<td align="center"><b><?=($v['rezerv']>0?$v['rezerv']:'')?></b></td>
		</tr>
	<?}?>
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