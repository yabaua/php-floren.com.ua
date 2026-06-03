{if $ERROR}
<p style="color:red">
	<b>{$LINGVO.oups_error}</b>
	<br />
<p>
{/if}
{if $ERROR}
	<ul class="errors">
	{foreach item=E from=$ERROR}
		<li>{$E}</li>
	{/foreach}
	</ul>
{/if}


<div class="layot__holder">
	<aside class="layout__aside modal_left modal_hide" data-modal="5">
		<p class="filters__name">Особистий кабінет</p>
		<ul class="filters__list">
			<li class="filters__item"><a href="{$LANGURL}/cabinet/"{if !$URL[1]} class="filters__link"{/if}>Мій обліковий запис</a></li>
			<li class="filters__item"><a href="{$LANGURL}/cabinet/myorders/"{if $URL[1]=='myorders'} class="filters__link"{/if}>Мої замовлення</a></li>
			<li class="filters__item"><a href="{$LANGURL}/cabinet/wishlist/"{if $URL[1]=='wishlist'} class="filters__link"{/if}>Мії лист бажань</a></li>
		</ul>
	</aside>
	<main class="layout__main">
	{**	/////////////////////////////// 	  CABINET    ///////////////////////////////	**}
	{if $URL[1]==''}

	<h1 style="margin:0 auto">Персональна інформація</h1>
	<form name="register" action="{$LANGURL}/login/" method="POST">
	<input type="hidden" name="action_type" value="registration">
	<div>
		<ul class="basket__contacts">
			<li class="basket__field">
				<span>Змінити</span>
				<input type="text" name="fio" id="fio" autocomplete="off" tabindex="1" value="{$USER_DATA.fio}" required>
				<label for="user_name">{$LINGVO.fb_name}</label>
			</li>
			<li class="basket__field">
				<span>Змінити</span>
				<input type="email" name="email" id="email" autocomplete="off" tabindex="2" value="{$USER_DATA.email}" required>
				<label for="email">e-mail</label>
			</li>
			<li class="basket__field">
	        {literal}
	            <input type="hidden" name="phone" data-field>
	            <span>Змінити</span>
	            <input type="tel" class="inp-wdt" id="phone" autocomplete="off" tabindex="5" data-valid value="+380{/literal}{$USER_DATA.phone}{literal}">
	            <label for="phone">Телефон</label>	           
	        {/literal}
	        </li>
		</ul>
		<input type="submit" id="basket_submit" class="button_accent" tabindex="6" name="send_bsk" value="{$LINGVO.user_login}" align="center">
	</div>
	</form>
	
	
	
	
	
	{/if}
	{**	/////////////////////////////// 	END  CABINET    ///////////////////////////////	**}	
	{if $URL[1]=='myorders'}
{literal}
<style>


.order__info {

}

.order__header {
	margin-bottom: 40px;
}

.order__img {
	width: 120px;
	float:left;
	

}

.order__img img {
	width: 120px;
}

.order__summary {
	padding: 15px;
	margin-top: 0;
}

.order__summary li {
	list-style: none;
	padding-bottom: 5px;
	font-size: 13px;
	text-align:right;
	border:0;
}

.order__sum {
	color: #498C09;
	font-weight: 700;

}

.products {
	padding-left: 0;
	width: 100%;
}

.products__item {
	display: block;
	padding: 15px;
	border: 1px solid #e8e8f4;
	margin-bottom: 10px;
}

.products__details {
	padding-left: 30px;
}

.products__headline {
	font-size: 16px;
}

.products__info {
	font-size: 12px;
}

.qnt {
	font-size: 16px;
	padding-left: 4px;
}

.products__ttl {
	font-weight: 700;
	font-size: 15px;
}




.order__data {
	padding: 15px;
	border: 1px solid #e8e8f4;
}
	.order__data div{
		float:left;
		padding-left: 10px;
		margin-top:10px;
	}
	
.order__list {
	margin-top: 0;
	display: block;
}

.order__text {
	padding-left: 0px;
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

@media (min-width: 1200px) {
		.order__data div{
			width:235px;			
		}
		.order__text b, .order__text .stagb { /** seoshield changes b to .stagb **/
			display:block;
			clear:both;
		}
	}
@media (max-width: 1200px) {
	
	.order__container {
		width: 100%;
	}



	.order__info {

	}

	.products {
		width: 100%;
	}
}

.order__line{
	border-top:2px solid #CCCCCC;
	border-bottom:2px solid #CCCCCC;
	margin:1px 0;
	display:block;
	overflow: hidden;
	cursor: pointer;
	cursor: hand;
}
	.order__line li{
		width:20%;
		float:left;	
		padding:9px 0;
		display:block;
		list-style: none;
		font-weight: 700;
		font-size: 15px;
		
	}
	.order__line_active{
		background: #EEEEEE;
	}
	.order__line li:last-child{
		font-size: 30px;
		padding:4px 10px;
		text-align:right;
		font-weight: 300;
		line-height:1em;
	}
</style>

<script>
function showOrderData(idd){
	if ($("#orderData"+idd).css('display') == 'none'){
		$("#orderData"+idd).show('slow');
		$("#orderLine"+idd).addClass('order__line_active');
		$("#plus"+idd).html('–');
	}else{
		$("#orderData"+idd).hide();
		$("#orderLine"+idd).removeClass('order__line_active');
		$("#plus"+idd).html('+');
	}
}
</script>

{/literal}	
	
	
	
	
	<h1>Мої замовлення</h1>

		{foreach from=$USER_ORDERS item=UO name=UO}
		<ul class="order__line" id="orderLine{$UO.id}" onclick="showOrderData({$UO.id})">
			<li>{$UO.order_date|date_format:"%d.%m.%Y"}</li>
			<li>{$UO.keepInCRMStage}</li>
			<li>{$UO.total} грн.</li>
			<li>{$UO.keepInCrmStage}</li>
			<li id="plus{$UO.id}">+</li>
		</ul>
		<div style="display:none;" id="orderData{$UO.id}">
			<p><b>Тип оплаты:</b> {$UO.payment}. {if $UO.payment_status=='success'}Оплачено{elseif $UO.keepInCrmStageID=='136655'}Оплатити зараз{/if}</p>
			<ul class="order__list products">
			{foreach from=$UO.goods item=UOG name=UOG}
				<li class="products__item">
					<a class="order__img" href="https://floren.com.ua{$UOG.href}">
	
					<img src="https://floren.com.ua{if $UOG.img != 0}/images/ins/s/{$UOG.img}{elseif $UOG.color != 0}/images/ins/s/{$UOG.link}_{$UOG.color}.jpg{else}/images/ins/s/{$UOG.image}{/if}">
				
					</a>
	
					<div class="products__details">
	
						<a class="products__headline" href="https://floren.com.ua{$UOG.href}?>" target="_blank">{$UOG.name}</a>
						<span class="qnt">({$UOG.cnt} шт)</span>
	
						<p class="products__info">
							{if $UOG.barcode}Штрихкод: {$UOG.barcode}<br>{/if}
							{if $UOG.color}{$UOG.color_name_ru}, {$UOG.color}<br>{/if}
							{if $UOG.dia}Диаметр: {$UOG.dia} см<br>{/if}
							{if $UOG.wdt}Ширина: {$UOG.wdt} см<br>{/if}
							{if $UOG.debth}Глубина: {$UOG.debth} см<br>{/if}
							{if $UOG.hgt}Высота: {$UOG.hgt} см<br>{/if}
							{if $UOG.measure_qt}{$UOG.mg_name_ru}: {$UOG.measure_qt} {$UOG.unit}<br>{/if}
							<span>Цена товара: {$UOG.price}&nbsp;грн</span>
						</p>
	
						
						<span style="font-size: 13px">Итого: </span><span class="products__ttl">{$UOG.sttl}&nbsp;грн</span>
	
					</div>
				</li>
			{/foreach}
	
		</ul>
		<div class="order__info">
	
			{foreach from=$UO.userData item=UOD name=UOD}
			<ul class="order__summary">
				{if $UOD.peresadka}
					<li><b>Услуга пересадки:</b>	{$UOD.peresadka}}</li>
				{/if}
				<li><b>Сумма заказа:</b> {$UOD.basket_totalprice}</li>
				<li><b>Стоимость доставки:</b> {$UOD.cost_delivery}</li>
				<li class="order__sum"><b>Итоговая стоимость:</b> {$UOD.to_pay}</li>
			</ul>
		</div>
		<div class="order__data holder">
			<div>
				<p class="products__ttl">Контактные данные</p>
	
				<ul class="order__text">
					<li><b>Контактное лицо:</b> {$UOD.fio}</li>
					<li><b>Телефон:</b> {$UOD.phone}</li>
					<li><b>Email:</b> {if $UOD.email}{$UOD.email}{else}–{/if}</li>
				</ul>
			</div>
			<div>
				<p class="products__ttl">Данные получателя</p>
				<ul class="order__text">
					{if $UOD.recipient}
							<li><b>Получатель заказа:</b> Я получатель</li>
					{else}
						<li><b>ФИО получателя:</b> {if $UOD.r_fio}{$UOD.r_fio}{else}–{/if}</li>
						<li><b>Телефон получателя:</b> {if $UOD.r_phone}{$UOD.r_phone}{else}–{/if}</li>
					{/if}
				</ul>	
			</div>
			<div>
				<p class="products__ttl">Способ доставки</p>
				<ul class="order__text">
					<li><b>Способ доставки:</b> {if $UOD.delivery_way}{$UOD.delivery_way}{else}–{/if}</li>
					{if $UOD.delivery_way=="Самовывоз из магазина"}
						<li><b>Дата самовывоза:</b> {$UOD.picup_date}</li>
						<li><b>Время самовывоза:</b> {$UOD.picup_time}</li>
						{if $UOD.picup_addr=='m1'}
							<li><b>Адрес самовывоза:</b> пр. Победы, 70</li>
						{/if}
						{if $UOD.picup_addr=='m2'}
							<li><b>Адрес самовывоза:</b> ул. Анны Ахматовой </li>
						{/if}
					{/if}
					{if $UOD.delivery_way=="Доставка Новой Почтой"}
						<li><b>Город:</b> {$UOD.np_city}</li>
						<li><b>Номер отделения:</b> {$UOD.np_number}</li>
					{/if}
					{if $UOD.delivery_way=="Доставка курьером"}
						<li><b>Город:</b> {$UOD.courier_city}</li>
						{if $UOD.courier_anonym}
							<li><b>Дополнительная опция доставки:</b> {$UOD.courier_anonym}</li>
						{/if}
						<li><b>Дата доставки:</b>{if $UOD.courier_date} {$UOD.courier_date}{else}–{/if}</li>
						{if $UOD.courier_fast}
							<li><b>Тип доставки:</b> {$UOD.courier_fast}</li>
						{/if}
						{if $UOD.courier_exact}
	
							<li><b>Тип доставки:</b> {$UOD.courier_exact}</li>
							<li><b>Время доставки: часы:</b> {$UOD.courier_hour}</li>
							<li><b>Время доставки: минуты:</b> {$UOD.courier_min}</li>
						{/if}
						{if $UOD.courier_time}
							<li><b>Тип доставки:</b> плановая доставка</li>
							{if $UOD.courier_time== 'early'}
								<li><b>Время доставки: </b> ранняя доставка, до 10:00</li>
							{elseif $UOD.courier_time=='late'}
								<li><b>Время доставки: </b> поздняя доставка, с 18:00 до 20:00</li>
							{else}
								<li><b>Время доставки: </b>  {$UOD.courier_time}</li>
							{/if}
						{/if}			
						<li><b>Адрес доставки:</b> {$UOD.courier_address}</li>
						<li><b>Номер дома:</b> {$UOD.courier_dom}</li>
						<li><b>Номер квартиры:</b> {$UOD.courier_flat}</li>
						<li><b>Наличие лифта:</b> {if $UOD.courier_elevator}{$UOD.courier_elevator}{else}—{/if}</li>
	
					{/if}
	
				</ul>
			</div>
		</div>
		<p class="products__ttl">Дополнительно</p>
		<ul class="order__text">
			<li><b>Дополнительная консультация:</b> {if $UOD.additional_consulting}{$UOD.additional_consulting}{else}–{/if}</li>
			<li><b>Комментарий к заказу:</b> {if $UOD.comment}{$UOD.comment}{else}–{/if}</li>
		</ul>
		{/foreach}
	</div> {** ORDER FULL INFO **}
	{/foreach}

		
	{/if}	
	</main>
</div>