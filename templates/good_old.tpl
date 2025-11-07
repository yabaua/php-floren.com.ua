{$SCHEMA_SCRIPT}

<script>
/**
    	const firstColor={if $G_CUR_COLOR!=''}'{$G_CUR_COLOR}'{else}null{/if};
		const firstMod={if $G_CUR_gfsID!=''}'{$G_CUR_gfsID}'{else}null{/if};
    	const jsonSizes = {$G_SIZES_JSON};
		const measures = {$FORM_MEASURES_JSON}; // +
    	const jsonGoodOne = {$G_ONE_JSON};
    	const jsonGoodForms = {$G_FORMS_JSON};
		const modColors = {literal}{}{/literal}; //+
		const goodPageUrl = '{$LANG}';
		const notAvailableText = '{$LINGVO.not_available}'; // +
		const showVideoText = '{$LINGVO.show_video}'; // +
		const isPlant = {$PLANT_GOOD};
		const isBetonPot = {$BETON_GOOD};
		const isWoodPot = {$WOOD_GOOD};
		
		

		{foreach item=K name=K from=$G_COLOR}
			{if count($K.alias) != 0 }
			modColors['{$K.alias}'] = [`{$K.color_name_ru}`, `{$K.color_name_ua}`];
			{/if}
		{/foreach}
**/
</script>

<div class="plant">

<!--this_is_product-->
  <div class="plant__container">

    <div class="plant__column_left">
		<div class="plant__img" href="{$MAIN_IMAGE}" data-fancybox="{$GOOD_ONE.ID}">
			<img decoding="async" src="{$MAIN_IMAGE}" alt="{$GOOD_ONE.name_alter} {$GOOD_ONE.name}" title="{$GOOD_ONE.name_alter} {$GOOD_ONE.name}"/>
			
			{** if $PLANT_GOOD}
			Фото актуальне<br />Реальне фото саме вашої рослини надійшлемо в месенджер
			{/if **}
		</div>

		{if $GOOD_IMAGES}
		<div class="plant__more">
			{foreach item=GI name=GI from=$GOOD_IMAGES}
				<div href="/images/ins/b/{$GI}" data-fancybox="{$GOOD_ONE.ID}" title="{$GOOD_ONE.name} фото {$smarty.foreach.GI.iteration}" class="plant__img_small">
					<img decoding="async" src="/images/ins/s/{$GI}" alt="{$GOOD_ONE.name} фото {$smarty.foreach.GI.iteration}" title="{$GOOD_ONE.name} фото {$smarty.foreach.GI.iteration}">
				</div>
			{/foreach}
			
			{if $G_SIZES|@count > 0}
				{foreach from=$G_SIZES item=v_size key=v_k}
					{if $v_size.formID==$G_CUR_gfsID && $v_size.video!=''}
						<div style="margin-top:10px;">
							<iframe id="m_video"  src="https://www.youtube.com/embed/{$v_size.video}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						 </div>
					{/if}
				{/foreach}
			{/if}
		</div>

    {/if}

    </div>

    <div class="plant__column_right">
	  <h1 class="plant__headline">{$GOOD_H1}</h1>
      <div class="plant__code" style="position:relative">{if $GOOD_IS_ACTION}<div style="position:absolute;right:3px;top:-10px;width:150px;"><img src="/img/znizhka_b.png" width="150" height="67" alt="Знижка"></div>{/if}
{$LINGVO.artikul}: {$CUR_GFSID}</div>
    	<div class="plant__modify{if !$G_SIZES|@count} hide{/if}">
        <p class="plant__size">{$LINGVO.varianty}:</p>
		<input type="hidden" name="plant-id" value="">
		<input type="hidden" name="plant-dia" value="{$G_CUR_dia}">
		<input type="hidden" name="plant-wdt" value="{$G_CUR_wdt}">
		<input type="hidden" name="plant-hgt" value="{$G_CUR_hgt}">
		<input type="hidden" name="plant-depth" value="{$G_CUR_dept}">
		<input type="hidden" name="plant-price" value="{$G_CUR_PRICE}">
		<input type="hidden" name="plant-oldprice" value="">
		<input type="hidden" name="plant-measure-qt" value="">
		<input type="hidden" name="plant-measure-name" value="">
		<input type="hidden" name="plant-fid" value="{$G_CUR_gfsID}">
		<input type="hidden" name="plant-color" value="{$G_CUR_COLOR}">
		<input type="hidden" name="plant-img" value="	">
		<input type="hidden" name="plant-first-fid" value="{if $G_CUR_gfsID!=''}{$G_CUR_gfsID}{else}null{/if}">
		<input type="hidden" name="plant-first-color" value="{if $G_CUR_COLOR!=''}{$G_CUR_COLOR}{else}null{/if}">

		<ul class="plant__list">
			{if $G_SIZES|@count > 0}
			
				{foreach from=$G_SIZES item=size key=k}
						<li class="plant__item{if $size.active=='1'} active{/if}">
							<a class="size_picker" href="{$size.hrefID}">
								<span{if $size.price==0} style="color:#999999;"{/if}>{$size.measure},&nbsp;</span>
								<span class="plant__price">{$size.price}&nbsp;&#8372;</span>
								{if $size.old_price && $size.old_price!=0}<span class="plant__oldprice">{$size.old_price}&nbsp;&#8372;</span>{/if}
								{$GOOD_PREORDER}
								{if $PLANT_GOOD}
									{if $size.db_1c_availability>0}
										<span style="font-size:8pt;margin-left:10px;margin-top:-4px;background:#f1f7ea;padding:4px 6px;color:#498d0a">{$LINGVO.good_available}</span>
									{elseif $size.visibility==0}
										<span style="font-size:8pt;margin-left:10px;margin-top:-4px;background:#F1F1F1;padding:4px 6px;color:#999999">{$LINGVO.good_not_available}</span>
									{elseif $GOOD_ONE.preorder==1}
										<span style="font-size:8pt;margin-left:10px;margin-top:-4px;background:#F1F1F1;padding:4px 6px;color:#999999">{$LINGVO.good_preorder}</span>
									
									{else}
										<span style="font-size:8pt;margin-left:10px;margin-top:-4px;background:#F1F1F1;padding:4px 6px;color:#999999">{$LINGVO.good_not_available}</span>
									{/if}
								{/if}
							</a>
						{if $size.video!=''}
						<div class="plant__video" title="Подивитись відео" data-modal-trg="{$size.videoID}"><svg enable-background="new 0 0 128 128" id="Social_Icons" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="_x34__stroke"><g id="Youtube_1_"><rect clip-rule="evenodd" fill="none" fill-rule="evenodd" height="128" width="128"></rect><path clip-rule="evenodd" d="M126.72,38.224c0,0-1.252-8.883-5.088-12.794    c-4.868-5.136-10.324-5.16-12.824-5.458c-17.912-1.305-44.78-1.305-44.78-1.305h-0.056c0,0-26.868,0-44.78,1.305    c-2.504,0.298-7.956,0.322-12.828,5.458C2.528,29.342,1.28,38.224,1.28,38.224S0,48.658,0,59.087v9.781    c0,10.433,1.28,20.863,1.28,20.863s1.248,8.883,5.084,12.794c4.872,5.136,11.268,4.975,14.116,5.511    c10.24,0.991,43.52,1.297,43.52,1.297s26.896-0.04,44.808-1.345c2.5-0.302,7.956-0.326,12.824-5.462    c3.836-3.912,5.088-12.794,5.088-12.794S128,79.302,128,68.868v-9.781C128,48.658,126.72,38.224,126.72,38.224z M50.784,80.72    L50.78,44.501l34.584,18.172L50.784,80.72z" fill="#e0dcdc" fill-rule="evenodd" id="Youtube"></path></g></g></svg></div>
						{/if}
						</li>
				{/foreach}
			{/if}
		</ul>
{**
		{if $IS_ADMIN && $F_AVAILABILITY|@count > 0}
			<div class="plant__adm">
				{foreach from=$F_AVAILABILITY item=f}
					<p class="plant__hidden">{$f}</p>
				{/foreach}
			</div>
		{/if}
**}		
		<div class="plant__holder{if $G_COLOR|@count == 0} hide{/if}">
			<p class="lechuza-caption"><b>{$LINGVO.choose_color}:</b></p>
			<ul class="plant__colors">
				{foreach from=$G_COLOR item=C key=k}

						<li class="{$C.colorClass}" {$C.previewImg} title="{$C.colorTitle}"><a href="{$C.hrefID}"><p align="center" class="plant__color_caption"><nobr>{$C.colorTitle}</nobr></p></a></li>
				{/foreach}
			</ul>
			
		</div>	
	
		<div class="plant__summary">
			<div><span class="plant__mark">{$LINGVO.selected_good}: </span><span>{if $PLANT_GOOD}{$GOOD_ONE.name}{else}{if $GOOD_ONE.name_alter}{$GOOD_ONE.name_alter} {/if}{$GOOD_ONE.name}{/if}</span></div>
			<div><span class="plant__mark">{$GOOD_ONE.measure_name}: </span><span id="sizes" data-prop>{$CUR_MEASURE_TTL}</span></div>
			{if $CUR_COLOR_TTL}
			<div class="plant__colorblock"><span class="plant__mark">{$LINGVO.color}: </span><span id="color" data-prop-color>{$CUR_COLOR_TTL}</span></div>
			{/if}
			{if $PLANT_GOOD && $CUR_AVAILABILITY==0 && $CUR_VISIBILITY!=0 && $GOOD_ONE.preorder!=0}<p style="margin:5px 0;padding:10px;font-size:12px;border: 1px solid #ffa900;background-color: rgba(255, 169, 0, 0.1);">{$LINGVO.good_preorder_long_long_text}</p>{/if}
	  	</div> 

		<div class="price">
				{if !$CUR_PRICE || $CUR_PRICE==0 || $CUR_VISIBILITY==0}
					<p class="notavailable_text">{$LINGVO.not_available}</p>
				{else}
					<span class="price__value">{$CUR_PRICE}</span><span class="price__currency">&nbsp;грн</span>{if $CUR_OLD_PRICE && $CUR_OLD_PRICE!=0}<span class="plant__oldprice">{$CUR_OLD_PRICE}&nbsp;грн</span>{/if}
					{if $PLANT_GOOD && $CUR_AVAILABILITY==0}&nbsp;&nbsp;{$LINGVO.good_preorder_long}{/if}
				{/if}
		</div>
		
		<div class="price-buttons">
		{if !$CUR_PRICE || $CUR_PRICE==0 || ($GOOD_ONE.preorder==0 && $GOOD_ONE.availability!=1) || $CUR_VISIBILITY==0}
			<button class="button_accent button_product" onclick="checkProductParams('{$LINGVO.notify_availability}');return false">{$LINGVO.notify_availability}</button>
			<button class="button_frame" onclick="checkProductParams('{$LINGVO.find_alter}');return false">{$LINGVO.find_alter}</button>		
		{else}
			<button class="button_accent" onclick="add2cart_product('{$CUR_GFSID}', '{$CUR_PRICE}', '{if $PLANT_GOOD}{$GOOD_ONE.name}{else}{if $GOOD_ONE.name_alter}{$GOOD_ONE.name_alter}{/if}{$GOOD_ONE.name}{/if} {$CUR_GA4_MEASURE_TTL}{if $CUR_COLOR_TTL} {$CUR_COLOR_TTL}{/if}')">{$LINGVO.add_prod}</button>
			<button class="button_frame" onclick="show_popup('call_back_general', '{$LINGVO.advice_prof} — {if $PLANT_GOOD}{$GOOD_ONE.name}{else}{if $GOOD_ONE.name_alter}{$GOOD_ONE.name_alter} {/if}{$GOOD_ONE.name}{/if}', 'Button 1');return false">{$LINGVO.advice}</button>
		{/if}
		</div>
			
      </div>

{literal}
<script>
function checkProductParams(text){

	var clsHolder = $(".plant__holder");
	var productVal = text + ': ' + '{/literal}{if $PLANT_GOOD}{$GOOD_ONE.name}{else}{if $GOOD_ONE.name_alter}{$GOOD_ONE.name_alter} {/if}{$GOOD_ONE.name}{/if}{literal}';
	var productSize = $("#sizes").html() || '';
	var productColor = '';

	if (clsHolder.length && !clsHolder.hasClass("hide")) {
		productColor = ', ' + $(".plant__color.active").attr("title");
	}
	
	var productMod = productSize ? '(' + productSize + productColor + ') ' : '';
	productValResult = productVal + ' ' + productMod;
	show_popup('call_back_general', productValResult , 'Button');
}
{/literal}

</script>

	  <div class="plant__notavailable {if $G_SIZES|@count} hide{/if}">
		<p class="notavailable_text">{$LINGVO.not_available}</p>
	  	<button class="button_accent button_product" onclick="checkProductParams('{$LINGVO.notify_availability}');return false">{$LINGVO.notify_availability}</button>
        <button class="button_frame" onclick="checkProductParams('{$LINGVO.find_alter}');return false">{$LINGVO.find_alter}</button>
	  </div>

      <div class="tabs">

        <ul class="tabs__header">
          <li class="tabs__headline" data-tab='0'>{$LINGVO.poleznaya_info}</li>
          <li class="tabs__headline" data-tab='1'>Доставка</li>
          <li class="tabs__headline" data-tab='2'>Оплата</li>
        </ul>

        <ul class="tabs__body">
          <li class="tabs__content" data-tabcontent="0">
            <p class="tab__mob hide">{$LINGVO.poleznaya_info}</p>

            <ul class="tab__info" data-accord>

				{if $PLANT_GOOD}
					<li class="tab__caption">{$LINGVO.info_height}</li>
					<li class="tab__caption">{$LINGVO.info_planters}</li>
					<li class="tab__caption">{$LINGVO.info_original_quality}</li>
					<li class="tab__caption">{$LINGVO.send_photo}</li>
					<li class="tab__caption">{$LINGVO.info_good_delivery}</li>
				{/if}

				{if $SPECIAL_CERAMIC_GOOD}
					<li class="tab__caption">{$LINGVO.handmade}</li>
					<li class="tab__caption">{$LINGVO.also_we_have_sizes}</li>
					<li class="tab__caption">{$LINGVO.also_we_have_colors}</li>
				{/if}

				{if $CERAMIC_GOOD}
					<li class="tab__caption">{$LINGVO.made_ua}</li>
					<li class="tab__caption">{$LINGVO.quality_ceramics}</li>
					<li class="tab__caption">{$LINGVO.many_colors}</li>
					<li class="tab__caption">{$LINGVO.perfect_forms}</li>
				{/if}

				{if $LECHUZA_GOOD}
					<li class="tab__caption">{$LINGVO.info_original_quality}</li>
					<li class="tab__caption">{$LINGVO.made_de}</li>
					<li class="tab__caption">{$LINGVO.quality_plastik}</li>
					<li class="tab__caption">{$LINGVO.autopoliv}</li>
					<li class="tab__caption">{$LINGVO.water_level}</li>
					<li class="tab__caption">{$LINGVO.good_design}</li>
					<li class="tab__caption">{$LINGVO.uf_rays}</li>
				{/if}

				{if $LAMELA_GOOD}

					<li class="tab__caption">{$LINGVO.made_pl}</li>
					<li class="tab__caption">{$LINGVO.hight_quality_plastik}</li>
					<li class="tab__caption">{$LINGVO.kashpo_type}</li>
					<li class="tab__caption">{$LINGVO.inner_kashpo}</li>

				{/if}

            </ul>
            
          </li>
          
          <li class="tabs__content" data-tabcontent="1">
            <p class="tab__mob hide">Доставка</p>
            <ul class="delivery-info" data-accord>
              
              <li class="delivery-info__item delivery-info__item_ico_magazin">
			  	<div class="delivery-info__address">
					<span>{$LINGVO.pickup_kiev}:</span>
					<ul class="delivery-info__list" type="disc">
						<li>{$LINGVO.address_street}</li>
						{** <li>{$LINGVO.address_akhmatova}</li> **}
					</ul>
				</div>
                <p class="delivery-info__value">{$LINGVO.free}</p>
              </li>
              <li class="delivery-info__item delivery-info__item_ico_currier">
                <p>{$LINGVO.currier_50}:<br /><a href="{$LANGURL}/delivery/" target="_blank" class="delivery-info__subtext">{$LINGVO.more}</a></p>
                <p class="delivery-info__value">{$LINGVO.txt_vid} {DELIVERY_OPTIONS.courier_std} грн</p>
              </li>
              <li class="delivery-info__item delivery-info__item_ico_np">
                <p>{$LINGVO.pickup_from_np}:<br /><a href="{$LANGURL}/novaposhta/" target="_blank" class="delivery-info__subtext">{$LINGVO.more}</a></p>
                <p class="delivery-info__value">от 80 грн</p>
              </li>
            </ul>
            
          </li>
          
          <li class="tabs__content" data-tabcontent="2">
            <p class="tab__mob hide">Оплата</p>
            
            <div class="tabs__details">
              <ul class="tabs__payment" type="disc" data-accord>
                <li>{$LINGVO.bsk_cash}</li>
                <li>{$LINGVO.bsk_pay_now}</li>
                <li>{$LINGVO.bsk_beznal}</li>
              </ul>
            </div>
          </li>
        </ul>

      </div>

	</div>

  </div>
  
  <div class="plant__content">
    <ul class="plant__services">
      <li class="plant__service">
       	{if $PLANT_GOOD} <div class="plant__icon"><img src="/images/content/pdf-1.png" alt=""></div>
        <span class="plant__pdf" onclick="show_popup('call_back_online', '{$LINGVO.download_service}', 'Button 4');return false">{$LINGVO.download_service}</span>{else}

		<div class="plant__icon"><img src="/images/content/pdf-1.png" alt=""></div>
        <span class="plant__pdf" onclick="showPDF('Services', '{$LINGVO.download_pot} - {$GOOD_ONE.name}', 'PdfGoodStep1');return false">{$LINGVO.download_pot
}</span>

		{/if}
      </li>
      <li class="plant__service plant__service_big">
        <div class="plant__icon"><img src="/images/content/pot-1.png" alt=""></div>
        <a href="{$LANGURL}/services/peresadka/">{$LINGVO.service_peresedka}</a>
      </li>
      <li class="plant__service">
        <div class="plant__icon"><img src="/images/content/care-1.png" alt=""></div>
        <a href="{$LANGURL}/services/house_plant_care/">{$LINGVO.uhod_flower}</a>
      </li>
    </ul>
    
    <div class="tabs-descr">

    <ul class="tabs__header">
		{if $GOOD_ONE.body}<li class="tabs__headline" data-tab='0'>{$LINGVO.descr}</li>{/if}
		<li class="tabs__headline" data-tab='1'>{$LINGVO.accessory}</li>
		{if $GOOD_TECH}<li class="tabs__headline" data-tab='2'>{$LINGVO.plant_care}</li>{/if}
		<li class="tabs__headline" data-tab='3'>{$LINGVO.rewies}</li>
    </ul>

    <ul class="tabs__body">
		{if $GOOD_ONE.body}
		<li class="tabs__content" data-tabcontent="0">
			<p class="tab__mob hide">{$LINGVO.descr}</p>
			<div data-accord-2>
				{$GOOD_ONE.body}
			</div>
		</li>
		{/if}

        <li class="tabs__content" data-tabcontent="1">
    	<p class="tab__mob hide">{$LINGVO.accessory}</p>

		<div data-accord-2>

		{if $GOODS_BOARD_ACCESSORIES && !$ACCESSORY_GOOD}
			<span class="headline additional-goods__headline">{$LINGVO.grunt}</span>
			
			<ul class="additional-goods__list">
				{foreach item=GB name=GB from=$GOODS_BOARD_ACCESSORIES}
					<li class="additional-goods__item">
						<a href="{$LANGURL}/product/{$GB.ID}_{$GB.link}/" class="additional-goods__img" title="{$GB.name|replace:'"':''}"><img src="/images/ins/s/{$GB.image}" height="150" alt="{$GB.name|replace:'"':''}" /></a>
						<a href="{$LANGURL}/product/{$GB.ID}_{$GB.link}/" class="additional-goods__name" title="{$LINGVO.button_buy} {$GB.name|replace:'"':''}">{$GB.name}</a>
						<div class="additional-goods__price">{if $GB.min_price==$GB.max_price}{$GB.min_price}{else}{$GB.min_price}&nbsp;&ndash;&nbsp;{$GB.max_price}{/if}&nbsp;<span class="uah">грн.</span></div>
					</li>
				{/foreach}
			</ul>
		{/if}

		{* {if $PLANT_GOOD} *}

		<span class="headline additional-goods__headline indent">{$LINGVO.other_in_cat}: {$GOOD_ONE.className}</h2>

		<ul class="additional-goods__list">
			{foreach item=GB name=GB from=$GOODS_BOARD}
				<li class="additional-goods__item">
					<a href="{$GB.new_link}" class="additional-goods__img" title="{$GB.name|replace:'"':''}"><img src="/images/ins/s/{$GB.image}" height="150" alt="{$GB.name|replace:'"':''}" /></a>
					<a href="{$GB.new_link}" class="additional-goods__name" title="{$LINGVO.button_buy} {$GB.name|replace:'"':''}">{$GB.name}</a>
					<div class="additional-goods__price">{if $GB.min_price==$GB.max_price}{$GB.min_price}{else}{$GB.min_price}&nbsp;&ndash;&nbsp;{$GB.max_price}{/if}&nbsp;<span class="uah">грн.</span></div>
				</li>
			{/foreach}
		</ul>

	{* {/if} *}

	{* {if !$LECHUZA_GOOD} *}

		<div class="additional-goods">
			<span class="headline additional-goods__headline indent">{$LINGVO.see_also}</span>
			<ul class="additional-goods__list">
				{foreach item=GBL name=GBL from=$GOODS_BOARD_LECHUZA}
					<li class="additional-goods__item">
						<a href="{$GBL.new_link}" class="additional-goods__img" title="{$GBL.name|replace:'"':''}"><img src="{$GBL.image}" height="150" alt="{$GBL.name|replace:'"':''}"  /></a>
						<a href="{$GBL.new_link}" class="additional-goods__name" title="Купить {$GBL.name|replace:'"':''}">{$GBL.name}</a>
						<div class="additional-goods__price">{if $GBL.min_price==$GBL.max_price}{$GBL.min_price}{else}{$GBL.min_price}&nbsp;&ndash;&nbsp;{$GBL.max_price}{/if}&nbsp;<span class="uah">грн.</span></div>
					</li>
				{/foreach}
			</ul>
		</div>

	{* {/if} *}

	</div>

    </li>

	{if $GOOD_TECH}
		<li class="tabs__content" data-tabcontent="2">
			<p class="tab__mob hide">{$LINGVO.plant_care}</p>

			<ul class="tabs__techs" data-accord-2>
				{foreach item=GT from=$GOOD_TECH}
					<li class="tabs__tech">
							<p class="tabs__techcaption">{$GT.name}</p>
							<p class="tabs__techdescr">{$GT.val} {$GT.measure}</p>
					</li>
				{/foreach}
			</ul>


		</li>
	{/if}

	<li class="tabs__content" data-tabcontent="3">
	<p class="tab__mob hide">{$LINGVO.rewies}</p>


		<div class="comments" data-accord-2>

			<div class="comments__form">

				{if $smarty.session.good_comment==$PAGETYPE_SESSNAME}
					<span class="headline">{$LINGVO.your_rewie_added}</span>
				{else}
					<span class="headline">{$LINGVO.rewie_or_quastion}</span>

					<form method="post" action="" onsubmit="return check_form_blog_comment_add(this);">
						<input type="hidden" name="pageID" value="{$GOOD_ONE.ID}">
						<input type="hidden" name="pageType" value="good">

						<div class="comments__container">
							<div class="comments__label">
								<p>{$LINGVO.fb_name}:<span class="redstar">*</span></p>
								<span class="error_block" id="error_n_good_comment_name">{$LINGVO.fb_name_false}</span>
							</div>

							<input type="Text" name="n_good_comment_name" class="inp-ins comments__field">
						</div>

						<div class="comments__container">
							<div class="comments__label">
								<p>{$LINGVO.fb_phone}:<span class="redstar">*</span></p>
								<span class="error_block" id="error_n_good_comment_email">{$LINGVO.fb_phone_false}</span>
							</div>

							<input type="Text" name="n_good_comment_email" class="inp-ins comments__field">
						</div>

						<div class="comments__container">
							<div class="comments__label">
								<p>{$LINGVO.fb_comment}:<span class="redstar">*</span></p>
								<span class="error_block" id="error_n_good_message">{$LINGVO.fb_comment}</span>
							</div>
							<textarea name="n_good_message" class="inp-ins comments__field" style="height:60px;" ></textarea>
						</div>

						<div class="comments__container">
							<div class="comments__label">
								<span>{$LINGVO.fb_stars}:</span>
								<input type="Hidden" id="starsChosed" name="vote" value="5" />
								<input type="Hidden" id="starsClicked" name="starsClicked1" value="0" />
								<ul class="holder" id="stars" style="background-position: 0px -105px;">
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting({$GOOD_ONE.ID},1);" title="1">1</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting({$GOOD_ONE.ID},2);" title="2">2</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting({$GOOD_ONE.ID},3);" title="3">3</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting({$GOOD_ONE.ID},4);" title="4">4</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting({$GOOD_ONE.ID},5);" title="5">5</li>
								</ul>
							</div>
							<input type="submit" name="n_comment_add" value="{$LINGVO.send}" class="inp-but" />
						</div>
					</form>
			</div>
		
			<ul class="comments__list">

				{if $GOOD_FEEDBACK}
				<div class="row" style="margin-bottom:20px;">
					<div class="feed-back-comments">
						{foreach item=COMM from=$GOOD_FEEDBACK}
						<div class="box box-gray">
							<i class="t1"></i><i class="t2"></i>
							<div class="box-content">
								<div class="board-text">{$COMM.message|nl2br}</div>
								<ul class="board-stuff">
									<li>{$COMM.date_add|date_format:"%d.%m.%Y"}</dt>
									<li>{$COMM.u_name|escape}</dt>
									<li><div class="stars-mini stars-mini-{$COMM.vote|escape}">{$COMM.vote|escape}</div></dt>
								</ul>
							</div>
							<i class="t2"></i><i class="t1"></i>
						</div>
						{/foreach}
					</div>
				</div>
				{else}
				<div class="feed-back-comments">
					<div class="box box-gray">
						<i class="t1"></i><i class="t2"></i>
						<div class="box-content">
							<div class="board-text">{$LINGVO.no_rewies_yet}</div>
							<ul class="board-stuff">
								<li>{$smarty.now|date_format:"%d.%m.%Y"}</dt>
								<li>Флорен</dt>
								<li><div class="stars-mini stars-mini-5">5</div></dt>
							</ul>
						</div>
						<i class="t2"></i><i class="t1"></i>
					</div>
				</div>
				{/if}

			</ul>
			
		</div>
	{/if}

	</li>

    </ul>

  </div>
    
  </div>

	{if $GOOD_PLANT}

	<div class="see-also">
			<span class="headline">{$LINGVO.see_also}:</span>

			<ul class="see-also__list">
				{foreach item=GB name=GB from=$GOODS_BOARD}
					<li class="see-also__item see-also__item_notavailable">
					<a href="{$GB.new_link}" class="imglink" title="{$GB.name|replace:'"':''}">
						<img src="/images/ins/s/{$GB.image}" height="100" alt="{$GB.name|replace:'"':''}" />
					</a>
					<div class="see-also__details">
						<a href="{$GB.new_link}" class="imgname" title="{$LINGVO.button_buy} {$GB.name|replace:'"':''}">{$GB.name}</a>
						<div class="promo-price">{if $GB.min_price==$GB.max_price}{$GB.min_price}{else}{$GB.min_price}&nbsp;&ndash;&nbsp;{$GB.max_price}{/if}&nbsp;<span class="uah">грн.</span></div>
					</div>
					</li>
				{/foreach}
			</ul>
	</div>

	{/if}

</div>

<div class="plant__videos">
	{if $G_SIZES}
		{foreach from=$GO_FORMS item=size}
			{if $size.video}
				<div data-modal="{$size.fid}" class="modal modal_center modal_hide">
					<button class="close-btn"></button>
					<div>
						<p class="modal__headline">{if $PLANT_GOOD}{$GOOD_ONE.name}{else}{if $GOOD_ONE.name_alter}{$GOOD_ONE.name_alter} {/if}{$GOOD_ONE.name}{/if}, {$FORM_MEASURES[$size.fid]}</p>
						<iframe id="m_video" width="100%" height="500" src="https://www.youtube.com/embed/{$size.video}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			{/if}
		{/foreach}
	{/if}
</div>