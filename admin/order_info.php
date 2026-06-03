<?php
header("content-type: text/html;charset=utf-8 \r\n");
require($_SERVER['DOCUMENT_ROOT'] . '/database.php');


$orderID=$_REQUEST['id'];
$db->query("SELECT * FROM orders WHERE hash='".$orderID."'");
$rs = $db->fetch();
// echo base64_decode($rs['post']);
$order = unserialize(base64_decode($rs['basket']));
$post = unserialize(base64_decode($rs['post']));

// print_r($post);
// print_r($order);

if(isset($_REQUEST['add_comment']) && $_REQUEST['new_comment']!=''){
	
	$comment=$_REQUEST['new_comment'];
	
	if (!get_magic_quotes_gpc())
		$comment=addslashes($comment);

	mysql_query("INSERT INTO orders_comment SET 
					adminID='".$_SESSION['admin']['ID']."',
					orderID='".$orderID."',
					date_add='".time()."',
					comment='".$comment."'
				");
	header("location:order_info.php?id=".$orderID);
}?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>:: ADMIN ::</title>
<style>
body
{
	background-image: url('../img/bg_top.gif');
	background-repeat: repeat-x;
	background-position: top;
}
body, td
{
	font-family: Arial, Verdana, Tahoma;
	font-size: 9pt;
	color: #161615;
}
.inp_ins
{
	font-family: Arial, Verdana, Tahoma;
	font-size: 9pt;
	color: #161615;
	width:120px;
	height: 20px;
	background-color: #FFFFFF;
	border-top: 1px solid #48525D;
	border-left: 1px inset #48525D;
	border-right: 1px inset #A5BAD4;
	border-bottom: 1px inset #A5BAD4;
}
.pt08
{
	font-size:8pt;
}
a, a:link, a:active, a:visited
{
	color: #0065DC;
	text-decoration: underline;
}
a:hover
{
	color: #E87A05;
	text-decoration: underline;
}
select
{
	color:#314978;
	font-size:9pt;
	font-weight:bold;
	background-Color:#E2F0FF;
}

.order {
	margin-top: 20px;
	padding: 15px;
}

.order__container {
	width: 1200px;
	margin: 0 auto;
}

.order__wrapper {
	display: flex;
}

.order__info {
	width: 50%;
	margin-left: 20px;
}

.order__header {
	margin-bottom: 40px;
}

.order__img {
	width: 120px;

}

.order__img img {
	width: 100%;
}

.order__summary {
	padding-left: 0;
}

.order__summary li {
	list-style: none;
	padding-bottom: 5px;
	font-size: 16px;
	
}

.order__sum {
	color: #498C09;
	font-weight: 700;
	margin-top: 15px;
}

.products {
	padding-left: 0;
	width: 50%;
}

.products__item {
	display: flex;
	padding: 15px;
	border: 1px solid #e8e8f4;
	margin-bottom: 10px;
}

.products__details {
	padding-left: 30px;
}

.products__headline {
	font-size: 18px;
}

.products__info {
	font-size: 13px;
}

.qnt {
	font-size: 16px;
	padding-left: 4px;
}

.products__ttl {
	font-weight: 700;
	font-size: 16px;
}

.order__summary {
	padding: 15px;
	border: 1px solid #e8e8f4;
	margin-top: 0;
}


.order__data {
	padding: 15px;
	border: 1px solid #e8e8f4;
}

.order__data h3 {
	font-size: 16px;
}

.order__list {
	margin-top: 0;
}

.order__text {
	padding-left: 20px;
	border-bottom: 1px solid #e8e8f4;
	padding-bottom: 20px;
}

.order__text:last-child {
	border-bottom: none;
}

.order__text li {
	list-style: none;
	font-size: 13px;
	margin-bottom: 6px;
	
}

@media (max-width: 1200px) {
	
	.order__container {
		width: 100%;
	}

	.order__wrapper {
		flex-direction: column;
	}

	.order__info {
		width: 100%;
	}

	.products {
		width: 100%;
	}
}

</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="noindex, nofollow">

	<script src="/admin/js/jquery-1.10.2.js"></script>
	<script src="/admin/js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
	<link rel="STYLESHEET" type="text/css" href="css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
	<link rel="STYLESHEET" type="text/css" href="css/ui-lightness/jquery-ui-1.10.4.custom.css">
</head>

<body topmargin="50" leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" bottommargin="0" bgcolor="#FFFFFF">
<div class="order"></div>

	<div class="order__container">

	<h1 class="order__header">Заказ № <?=$rs['id']?></h1>
	<?php  if($post['payment_way'] == 'visa') { ?> 
		<p style="color: #498C09; font-weight: bold;">Статус: <?php  if ($rs['payment_status']=="success") {?> Заказ оплачен <?php } elseif ($rs['payment_status']=="hold_wait") {?>Заказ оплачен. Требуется списание после доставки<?php } else {?>Оплата не прошла<?php }?></p>
	<?php }?>

	
	<div class="order__wrapper">

	<ul class="order__list products">
		<?php 
			foreach($order AS $k=>$v) {
		?>
			<li class="products__item">
				<?php 
					$img_url='';
					if(isset($v['img']) && $v['img'] != 0){
						$img_url="/images/ins/s/". $v['img'];
					}elseif (isset($v['color']) && $v['color'] != 0) {
						$img_url="/images/ins/s/" . $v['link'] . "_" . $v['color'] .".jpg";
					}elseif($v['classID']==49){
						$img_url="/images/compositions/s/" . $v['image'];
					} else {
						$img_url="/images/ins/s/" . $v['image'];
					}
				?>
				<a class="order__img" href="https://floren.com.ua<?=$v['href']?>">
					<img src="https://floren.com.ua<?=$img_url?>">
				</a>

				<div class="products__details">

					<a class="products__headline" href="https://floren.com.ua<?=$v['href']?>" target="_blank"><?=$v['name']?>
						<?php if(isset($post['name_alter'])){ ?> <?=$v['name_alter']?><?php }?></a><span class="qnt">(<?=$v['cnt']?> шт)</span>

					<p class="products__info">
						<?php if(isset($v['barcode']) && $v['barcode']){ ?>Штрихкод: <?=$v['barcode']?><br><?php }?>
						<?php if(isset($v['color']) && $v['color']){ ?><?=$v['color_name_ru']?>, <?=$v['color']?><br><?php }?>
						<?php if(isset($v['dia']) && $v['dia']){ ?>Диаметр: <?=$v['dia']?> см<br><?php }?>
						<?php if(isset($v['wdt']) && $v['wdt']){ ?>Ширина: <?=$v['wdt']?> см<br><?php }?>
						<?php if(isset($v['depth']) && $v['depth']){ ?>Глубина: <?=$v['depth']?> см<br><?php }?>
						<?php if(isset($v['hgt']) && $v['hgt']){ ?>Высота: <?=$v['hgt']?> см<br><?php }?>
						<?php if(isset($v['measure_qt']) && $v['measure_qt']){ ?><?=$v['mg_name_ru']?>: <?=$v['measure_qt']?> <?=$v['unit']?><br><?php }?>
						<span>Цена товара: <?=$v['price']?>&nbsp;грн</span>
					</p>

					
					<span style="font-size: 16px">Итого: </span><span class="products__ttl"><?=$v['sttl']?>&nbsp;грн</span>

				</div>
			</li>
		<?php }?>

	</ul>

	<div class="order__info">
		
		<ul class="order__summary">
				
			<?php  if(isset($post['peresadka'])){ ?>
	
				<li><b>Услуга пересадки:</b> <?=$post['peresadka']?></li>
	
			<?php }?>	
	
			<li><b>Сумма заказа:</b> <?=$post['basket_totalprice']?></li>
			<li><b>Стоимость доставки:</b> <?=$post['cost_delivery']?></li>
			<li class="order__sum"><b>Итоговая стоимость:</b> <?=$post['to_pay']?></li>
		
		</ul>

		<div class="order__data">
			<h3>Контактные данные</h3>

			<ul class="order__text">
				<li><b>Контактное лицо:</b> <?=$post['fio']?></li>
				<li><b>Телефон:</b> <?=$post['phone']?></li>
				<li><b>Email:</b> <?php  if($post['email']) { ?> <?=$post['email']?> <?php } else {?> не заполнено<?php }?></li>
			</ul>

			<h3>Данные получателя</h3>
			
			<ul class="order__text">
				<?php  if(isset($post['recipient']) && $post['recipient']){ ?>

					<li><b>Получатель заказа:</b> Я получатель</li>

				<?php } else {?>

					<li><b>ФИО получателя:</b> <?php  if($post['r_fio']) { ?> <?=$post['r_fio']?> <?php } else {?> не заполнено<?php }?></li>
					<li><b>Телефон получателя:</b> <?php  if($post['r_phone']) { ?> <?=$post['r_phone']?> <?php } else {?> не заполнено<?php }?></li>

				<?php }?>
			</ul>	

			<h3>Способ доставки</h3>

			<ul class="order__text">

				<li><b>Способ доставки:</b> <?php  if(isset($post['delivery_way'])) {?><?=$post['delivery_way']?><?php } else {?>не заполнено<?php }?></li>

				<?php if(isset($post['delivery_way']) && $post['delivery_way'] == "Самовывоз из магазина") { ?>
					
					<li><b>Дата самовывоза:</b> <?=$post['picup_date']?></li>
					<li><b>Время самовывоза:</b> <?=$post['picup_time']?></li>
					<?php  if(isset($post['picup_addr']) && $post['picup_addr'] == 'm1') { ?>
						<li><b>Адрес самовывоза:</b> пр. Победы, 70</li>
					<?php }?>

					<?php  if(isset($post['picup_addr']) && $post['picup_addr'] == 'm2') { ?>
						<li><b>Адрес самовывоза:</b> ул. Анны Ахматовой, 30</li>
					<?php }?>

				<?php }?>

				<?php  if(isset($post['delivery_way']) && $post['delivery_way'] == "Доставка Новой Почтой") { ?>

					<li><b>Город:</b> <?=$post['np_city']?></li>
					<li><b>Номер отделения:</b> <?=$post['np_number']?></li>

				<?php }?>

				<?php  if(isset($post['delivery_way']) && $post['delivery_way'] == "Доставка курьером") { ?>

					<li><b>Город:</b> <?=$post['courier_city']?></li>
					
					<?php  if(isset($post['courier_anonym']) && $post['courier_anonym']) { ?>
						<li><b>Дополнительная опция доставки:</b> <?=$post['courier_anonym']?></li>
					<?php }?>


					<li><b>Дата доставки:</b><?php  if(isset($post['courier_date']) && $post['courier_date']) { ?> <?=$post['courier_date']?> <?php } else {?> не указано <?php }?></li>

					<?php  if(isset($post['courier_fast']) && $post['courier_fast']) { ?>
						<li><b>Тип доставки:</b> <?=$post['courier_fast']?></li>
					<?php }?>

					<?php  if(isset($post['courier_exact']) && $post['courier_exact']) { ?>

						<li><b>Тип доставки:</b> <?=$post['courier_exact']?></li>
						<li><b>Время доставки: часы:</b> <?=$post['courier_hour']?></li>
						<li><b>Время доставки: минуты:</b> <?=$post['courier_min']?></li>

					<?php }?>

					<?php  if(isset($post['courier_time']) && $post['courier_time']) { ?>

					<li><b>Тип доставки:</b> плановая доставка</li>

					<?php  if($post['courier_time'] == 'early') { ?>
					
						<li><b>Время доставки: </b> ранняя доставка, до 10:00</li>

					<?php } elseif ($post['courier_time'] == 'late') {?>
						<li><b>Время доставки: </b> поздняя доставка, с 18:00 до 20:00</li>

					<?php } else {?>

						<li><b>Время доставки: </b>  <?=$post['courier_time']?></li>

					<?php }?>
					<?php }?>

					

					<li><b>Адрес доставки:</b> <?=$post['courier_address']?></li>
					<li><b>Номер дома:</b> <?=$post['courier_dom']?></li>
					<li><b>Номер квартиры:</b> <?=$post['courier_flat']?></li>
					<li><b>Наличие лифта:</b> <?php  if(isset($post['courier_elevator']) && $post['courier_elevator']) { ?> <?=$post['courier_elevator']?> <?php } else {?> — <?php }?> </li>

				<?php }?>

			</ul>

			<h3>Способ оплаты</h3>

			<ul class="order__text">
				<li><b>Тип оплаты:</b>

					<?php  if($post['payment_way'] == 'visa') { ?> Картой на сайте VISA / Mastercard <?php } elseif ($post['payment_way'] == 'beznal') {?> Безналичный расчет для юридических лиц <?php } else {?> <?=$post['payment_way']?><?php }?></td>

				</li>
			</ul>

			<h3>Дополнительная информация</h3>

			<ul class="order__text">

				<li><b>Дополнительная консультация:</b> <?php if (isset($post['additional_consulting'])) { ?> <?=$post['additional_consulting']?> <?php } else {?> не заполнено <?php }?></li>
				<li><b>Комментарий к заказу:</b> <?php  if($post['comment']) { ?> <?=$post['comment']?> <?php } else {?> не заполнено <?php }?></li>
			</ul>

		</div>

		</div>


	</div>
	</div>

</div>

</body>
</html>