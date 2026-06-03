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
    
    <script src="/admin/js/jquery-1.10.2.js"></script>
	<script src="/admin/js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
	<link rel="STYLESHEET" type="text/css" href="/admin/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
	<link rel="STYLESHEET" type="text/css" href="/admin/css/ui-lightness/jquery-ui-1.10.4.custom.css">
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
.cancel_but {
    width: 15px;
    height: 15px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: red;
}
</style>
<script>
function cancel_good(ID){
/*
	if($('#collected'+crmID).html()=="Ні"){
		$('#collected'+crmID).html("Так");
		$('#collected'+crmID).attr("class", "collectedYes");
		$('#tr'+crmID).attr("class", "orderRow trCollectedYes");
		$.post('/crm/callback_collected.php',{crmID:crmID, val:1}); 
	}else{
		$('#collected'+crmID).html("Ні");
		$('#collected'+crmID).attr("class", "collectedNo");
		$('#tr'+crmID).attr("class", "orderRow");
		$.post('/crm/callback_collected.php',{crmID:crmID, val:0}); 
	}
*/
	$.post('/stock/callback_good.php', {ID: ID, action: 'cancel'}, function(response) {
	    console.log(response);
	    if (response === '1') {
	        $("#tr" + ID).hide();
	    } else {
	      //  alert(response);
	    }
	});
	$("#tr" + ID).slideUp(500);
}
</script>
<div class="holder menu_buttons">
	<a href="/stock/stock.php" target="main">Наші Залишки</a>
	<a href="/stock/lechuza.php" target="main">Lechuza</a>
	<a href="/stock/to_order.php" target="main">Товари Під Замовлення</a>
</div>

<table cellpadding="0" cellspacing="0" class="tbl">
	<thead class="adm-table__head">
				<th>Штрих Код</th>
				<th>Назва</th>
				<th>Кількість</th>
				<th>Ціна</th>
				<th>Хто замовив</th>
				<th>Угода</th>
				<th>Дата</th>
				<th>Замовлено</th>
    </thead>
    <tbody id="listTable">
    <?php
		$db->query("SELECT *, cg4o.ID AS IDD FROM crm_goods4order cg4o 
								LEFT JOIN crm_users cu ON cg4o.who_ordered = cu.keepInCrmID
								LEFT JOIN orders_crm oc ON keepInCrmAgreementID=oc.keepInCrmID
								WHERE cg4o.done!=1 AND cg4o.canceled!=1
								ORDER BY cg4o.orderDate DESC, cg4o.title");
		while($v=$db->fetch()){
		?>
       <tr id="tr<?=$v['IDD']?>">
			<td class="barcode"><?=$v['barcode']?></td>
			<td class="good_name"><?=$v['title']?></td>
			<td class="good_name"><?=$v['amount']?></td>
			<td align="right"><?=number_format(($v['price']), '2', ',', ' ')?></td>
			<td align="center" class="<?=$v['f1_class']?>"><?=$v['fio']?></td>
			<td align="center"><a href="/crm/?hash=<?=$v['hash']?>"><?=$v['keepInCrmAgreementTitle']?></a></td>
			<td align="center"><?=date("d.m.Y", $v['orderDate'])?></td>
			<td align="center"><div class="cancel_but" onclick="cancel_good(<?=$v['IDD']?>)">&#10006;</div></td>
		</tr>
	<?php
	}
	?>
    </tbody>
</table>

</body>
</html>