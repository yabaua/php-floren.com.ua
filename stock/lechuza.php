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
    <title>Залишки товарів Lechuza</title>
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
	<a href="/stock/lechuza.php?brand=Lechuza" target="main">Lechuza</a>
	<a href="/stock/lechuza.php?brand=Elho" target="main">Elho</a>
	<a href="/stock/lechuza.php?brand=Lamela" target="main">Lamela</a>
	<a href="/stock/lechuza.php?brand=Click and Grow" target="main">Click and Grow</a>
	<a href="/stock/lechuza.php?brand=Edelman" target="main">Edelman</a>
</div>


<table cellpadding="0" cellspacing="0" class="tbl">
	<thead class="adm-table__head">
				<th>Артикул</th>
				<th>Назва</th>
				<th>Київ</th>
				<th>Одеса</th>
				<th>Ціна</th>
    </thead>
    <tbody id="listTable">
    <?
    	$brand='Lechuza';
    	if(isset($_REQUEST['brand']) && $_REQUEST['brand']!='') $brand=$_REQUEST['brand'];
			$query = "SELECT * FROM vendors_lechuza WHERE brand='".$brand."' ORDER BY stock1 DESC, stock2 DESC, name";
			$db->query($query);
			while($f=$db->fetch()){
		?>
       <tr>
			<td class="barcode"><?=$f['articul']?></td>
			<td class="good_name"><?=$f['name']?></td>
			<td align="center" class="<?=$f['stock1']>0 ? 'full' : 'zero';?>"><?=$f['stock1']?></td>
			<td align="center" class="<?=$f['stock2']>0 ? 'full' : 'zero';?>"><?=$f['stock2']?></td>
			<td align="right"><?=number_format(($f['price']), '2', ',', ' ')?></td>
		</tr>
		<?}?>
    </tbody>
</table>
</html>