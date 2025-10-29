<?php
/* Smarty version 5.5.2, created on 2025-09-23 10:40:30
  from 'file:good_one.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68d24eee5ba507_43104963',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '601147435684e0ac9c00371ced091000932beaf6' => 
    array (
      0 => 'good_one.tpl',
      1 => 1750922617,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68d24eee5ba507_43104963 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/floren.com.ua/templates';
echo $_smarty_tpl->getValue('SCHEMA_SCRIPT');?>


<?php echo '<script'; ?>
>
/**
    	const firstColor=<?php if ($_smarty_tpl->getValue('G_CUR_COLOR') != '') {?>'<?php echo $_smarty_tpl->getValue('G_CUR_COLOR');?>
'<?php } else { ?>null<?php }?>;
		const firstMod=<?php if ($_smarty_tpl->getValue('G_CUR_gfsID') != '') {?>'<?php echo $_smarty_tpl->getValue('G_CUR_gfsID');?>
'<?php } else { ?>null<?php }?>;
    	const jsonSizes = <?php echo $_smarty_tpl->getValue('G_SIZES_JSON');?>
;
		const measures = <?php echo $_smarty_tpl->getValue('FORM_MEASURES_JSON');?>
; // +
    	const jsonGoodOne = <?php echo $_smarty_tpl->getValue('G_ONE_JSON');?>
;
    	const jsonGoodForms = <?php echo $_smarty_tpl->getValue('G_FORMS_JSON');?>
;
		const modColors = {}; //+
		const goodPageUrl = '<?php echo $_smarty_tpl->getValue('LANG');?>
';
		const notAvailableText = '<?php echo $_smarty_tpl->getValue('LINGVO')['not_available'];?>
'; // +
		const showVideoText = '<?php echo $_smarty_tpl->getValue('LINGVO')['show_video'];?>
'; // +
		const isPlant = <?php echo $_smarty_tpl->getValue('PLANT_GOOD');?>
;
		const isBetonPot = <?php echo $_smarty_tpl->getValue('BETON_GOOD');?>
;
		const isWoodPot = <?php echo $_smarty_tpl->getValue('WOOD_GOOD');?>
;
		
		

		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('G_COLOR'), 'K', false, NULL, 'K', array (
));
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('K')->value) {
$foreach0DoElse = false;
?>
			<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('K')['alias']) != 0) {?>
			modColors['<?php echo $_smarty_tpl->getValue('K')['alias'];?>
'] = [`<?php echo $_smarty_tpl->getValue('K')['color_name_ru'];?>
`, `<?php echo $_smarty_tpl->getValue('K')['color_name_ua'];?>
`];
			<?php }?>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
**/
<?php echo '</script'; ?>
>

<div class="plant">

<!--this_is_product-->
  <div class="plant__container">

    <div class="plant__column_left">
		<div class="plant__img" href="<?php echo $_smarty_tpl->getValue('MAIN_IMAGE');?>
" data-fancybox="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
">
			<img decoding="async" src="<?php echo $_smarty_tpl->getValue('MAIN_IMAGE');?>
" alt="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['name_alter'];?>
 <?php echo $_smarty_tpl->getValue('GOOD_ONE')['name'];?>
" title="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['name_alter'];?>
 <?php echo $_smarty_tpl->getValue('GOOD_ONE')['name'];?>
"/>
			
					</div>

		<?php if ($_smarty_tpl->getValue('GOOD_IMAGES')) {?>
		<div class="plant__more">
			<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GOOD_IMAGES'), 'GI', false, NULL, 'GI', array (
  'iteration' => true,
));
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('GI')->value) {
$foreach1DoElse = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_GI']->value['iteration']++;
?>
				<div href="/images/ins/b/<?php echo $_smarty_tpl->getValue('GI');?>
" data-fancybox="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
" title="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['name'];?>
 фото <?php echo ($_smarty_tpl->getValue('__smarty_foreach_GI')['iteration'] ?? null);?>
" class="plant__img_small">
					<img decoding="async" src="/images/ins/s/<?php echo $_smarty_tpl->getValue('GI');?>
" alt="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['name'];?>
 фото <?php echo ($_smarty_tpl->getValue('__smarty_foreach_GI')['iteration'] ?? null);?>
" title="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['name'];?>
 фото <?php echo ($_smarty_tpl->getValue('__smarty_foreach_GI')['iteration'] ?? null);?>
">
				</div>
			<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			
			<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('G_SIZES')) > 0) {?>
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('G_SIZES'), 'v_size', false, 'v_k');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('v_k')->value => $_smarty_tpl->getVariable('v_size')->value) {
$foreach2DoElse = false;
?>
					<?php if ($_smarty_tpl->getValue('v_size')['formID'] == $_smarty_tpl->getValue('G_CUR_gfsID') && $_smarty_tpl->getValue('v_size')['video'] != '') {?>
						<div style="margin-top:10px;">
							<iframe id="m_video"  src="https://www.youtube.com/embed/<?php echo $_smarty_tpl->getValue('v_size')['video'];?>
" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						 </div>
					<?php }?>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			<?php }?>
		</div>

    <?php }?>

    </div>

    <div class="plant__column_right">
	  <h1 class="plant__headline"><?php echo $_smarty_tpl->getValue('GOOD_H1');?>
</h1>
      <div class="plant__code" style="position:relative"><?php if ($_smarty_tpl->getValue('GOOD_IS_ACTION')) {?><div style="position:absolute;right:3px;top:-10px;width:150px;"><img src="/img/znizhka_b.png" width="150" height="67" alt="Знижка"></div><?php }
echo $_smarty_tpl->getValue('LINGVO')['artikul'];?>
: <?php echo $_smarty_tpl->getValue('CUR_GFSID');?>
</div>
    	<div class="plant__modify<?php if (!$_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('G_SIZES'))) {?> hide<?php }?>">
        <p class="plant__size"><?php echo $_smarty_tpl->getValue('LINGVO')['varianty'];?>
:</p>
		<input type="hidden" name="plant-id" value="">
		<input type="hidden" name="plant-dia" value="<?php echo $_smarty_tpl->getValue('G_CUR_dia');?>
">
		<input type="hidden" name="plant-wdt" value="<?php echo $_smarty_tpl->getValue('G_CUR_wdt');?>
">
		<input type="hidden" name="plant-hgt" value="<?php echo $_smarty_tpl->getValue('G_CUR_hgt');?>
">
		<input type="hidden" name="plant-depth" value="<?php echo $_smarty_tpl->getValue('G_CUR_dept');?>
">
		<input type="hidden" name="plant-price" value="<?php echo $_smarty_tpl->getValue('G_CUR_PRICE');?>
">
		<input type="hidden" name="plant-oldprice" value="">
		<input type="hidden" name="plant-measure-qt" value="">
		<input type="hidden" name="plant-measure-name" value="">
		<input type="hidden" name="plant-fid" value="<?php echo $_smarty_tpl->getValue('G_CUR_gfsID');?>
">
		<input type="hidden" name="plant-color" value="<?php echo $_smarty_tpl->getValue('G_CUR_COLOR');?>
">
		<input type="hidden" name="plant-img" value="	">
		<input type="hidden" name="plant-first-fid" value="<?php if ($_smarty_tpl->getValue('G_CUR_gfsID') != '') {
echo $_smarty_tpl->getValue('G_CUR_gfsID');
} else { ?>null<?php }?>">
		<input type="hidden" name="plant-first-color" value="<?php if ($_smarty_tpl->getValue('G_CUR_COLOR') != '') {
echo $_smarty_tpl->getValue('G_CUR_COLOR');
} else { ?>null<?php }?>">

		<ul class="plant__list">
			<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('G_SIZES')) > 0) {?>
			
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('G_SIZES'), 'size', false, 'k');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('k')->value => $_smarty_tpl->getVariable('size')->value) {
$foreach3DoElse = false;
?>
						<li class="plant__item<?php if ($_smarty_tpl->getValue('size')['active'] == '1') {?> active<?php }?>">
							<a class="size_picker" href="<?php echo $_smarty_tpl->getValue('size')['hrefID'];?>
">
								<span<?php if ($_smarty_tpl->getValue('size')['price'] == 0) {?> style="color:#999999;"<?php }?>><?php echo $_smarty_tpl->getValue('size')['measure'];?>
,&nbsp;</span>
								<span class="plant__price"><?php echo $_smarty_tpl->getValue('size')['price'];?>
&nbsp;&#8372;</span>
								<?php if ($_smarty_tpl->getValue('size')['old_price'] && $_smarty_tpl->getValue('size')['old_price'] != 0) {?><span class="plant__oldprice"><?php echo $_smarty_tpl->getValue('size')['old_price'];?>
&nbsp;&#8372;</span><?php }?>
								<?php echo $_smarty_tpl->getValue('GOOD_PREORDER');?>

								<?php if ($_smarty_tpl->getValue('PLANT_GOOD')) {?>
									<?php if ($_smarty_tpl->getValue('size')['db_1c_availability'] > 0) {?>
										<span style="font-size:8pt;margin-left:10px;margin-top:-4px;background:#f1f7ea;padding:4px 6px;color:#498d0a"><?php echo $_smarty_tpl->getValue('LINGVO')['good_available'];?>
</span>
									<?php } elseif ($_smarty_tpl->getValue('size')['visibility'] == 0) {?>
										<span style="font-size:8pt;margin-left:10px;margin-top:-4px;background:#F1F1F1;padding:4px 6px;color:#999999"><?php echo $_smarty_tpl->getValue('LINGVO')['good_not_available'];?>
</span>
									<?php } elseif ($_smarty_tpl->getValue('GOOD_ONE')['preorder'] == 1) {?>
										<span style="font-size:8pt;margin-left:10px;margin-top:-4px;background:#F1F1F1;padding:4px 6px;color:#999999"><?php echo $_smarty_tpl->getValue('LINGVO')['good_preorder'];?>
</span>
									
									<?php } else { ?>
										<span style="font-size:8pt;margin-left:10px;margin-top:-4px;background:#F1F1F1;padding:4px 6px;color:#999999"><?php echo $_smarty_tpl->getValue('LINGVO')['good_not_available'];?>
</span>
									<?php }?>
								<?php }?>
							</a>
						<?php if ($_smarty_tpl->getValue('size')['video'] != '') {?>
						<div class="plant__video" title="Подивитись відео" data-modal-trg="<?php echo $_smarty_tpl->getValue('size')['videoID'];?>
"><svg enable-background="new 0 0 128 128" id="Social_Icons" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="_x34__stroke"><g id="Youtube_1_"><rect clip-rule="evenodd" fill="none" fill-rule="evenodd" height="128" width="128"></rect><path clip-rule="evenodd" d="M126.72,38.224c0,0-1.252-8.883-5.088-12.794    c-4.868-5.136-10.324-5.16-12.824-5.458c-17.912-1.305-44.78-1.305-44.78-1.305h-0.056c0,0-26.868,0-44.78,1.305    c-2.504,0.298-7.956,0.322-12.828,5.458C2.528,29.342,1.28,38.224,1.28,38.224S0,48.658,0,59.087v9.781    c0,10.433,1.28,20.863,1.28,20.863s1.248,8.883,5.084,12.794c4.872,5.136,11.268,4.975,14.116,5.511    c10.24,0.991,43.52,1.297,43.52,1.297s26.896-0.04,44.808-1.345c2.5-0.302,7.956-0.326,12.824-5.462    c3.836-3.912,5.088-12.794,5.088-12.794S128,79.302,128,68.868v-9.781C128,48.658,126.72,38.224,126.72,38.224z M50.784,80.72    L50.78,44.501l34.584,18.172L50.784,80.72z" fill="#e0dcdc" fill-rule="evenodd" id="Youtube"></path></g></g></svg></div>
						<?php }?>
						</li>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			<?php }?>
		</ul>
		
		<div class="plant__holder<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('G_COLOR')) == 0) {?> hide<?php }?>">
			<p class="lechuza-caption"><b><?php echo $_smarty_tpl->getValue('LINGVO')['choose_color'];?>
:</b></p>
			<ul class="plant__colors">
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('G_COLOR'), 'C', false, 'k');
$foreach4DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('k')->value => $_smarty_tpl->getVariable('C')->value) {
$foreach4DoElse = false;
?>

						<li class="<?php echo $_smarty_tpl->getValue('C')['colorClass'];?>
" <?php echo $_smarty_tpl->getValue('C')['previewImg'];?>
 title="<?php echo $_smarty_tpl->getValue('C')['colorTitle'];?>
"><a href="<?php echo $_smarty_tpl->getValue('C')['hrefID'];?>
"><p align="center" class="plant__color_caption"><nobr><?php echo $_smarty_tpl->getValue('C')['colorTitle'];?>
</nobr></p></a></li>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ul>
			
		</div>	
	
		<div class="plant__summary">
			<div><span class="plant__mark"><?php echo $_smarty_tpl->getValue('LINGVO')['selected_good'];?>
: </span><span><?php if ($_smarty_tpl->getValue('PLANT_GOOD')) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
} else {
if ($_smarty_tpl->getValue('GOOD_ONE')['name_alter']) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name_alter'];?>
 <?php }
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
}?></span></div>
			<div><span class="plant__mark"><?php echo $_smarty_tpl->getValue('GOOD_ONE')['measure_name'];?>
: </span><span id="sizes" data-prop><?php echo $_smarty_tpl->getValue('CUR_MEASURE_TTL');?>
</span></div>
			<?php if ($_smarty_tpl->getValue('CUR_COLOR_TTL')) {?>
			<div class="plant__colorblock"><span class="plant__mark"><?php echo $_smarty_tpl->getValue('LINGVO')['color'];?>
: </span><span id="color" data-prop-color><?php echo $_smarty_tpl->getValue('CUR_COLOR_TTL');?>
</span></div>
			<?php }?>
			<?php if ($_smarty_tpl->getValue('PLANT_GOOD') && $_smarty_tpl->getValue('CUR_AVAILABILITY') == 0 && $_smarty_tpl->getValue('CUR_VISIBILITY') != 0 && $_smarty_tpl->getValue('GOOD_ONE')['preorder'] != 0) {?><p style="margin:5px 0;padding:10px;font-size:12px;border: 1px solid #ffa900;background-color: rgba(255, 169, 0, 0.1);"><?php echo $_smarty_tpl->getValue('LINGVO')['good_preorder_long_long_text'];?>
</p><?php }?>
	  	</div> 

		<div class="price">
				<?php if (!$_smarty_tpl->getValue('CUR_PRICE') || $_smarty_tpl->getValue('CUR_PRICE') == 0 || $_smarty_tpl->getValue('CUR_VISIBILITY') == 0) {?>
					<p class="notavailable_text"><?php echo $_smarty_tpl->getValue('LINGVO')['not_available'];?>
</p>
				<?php } else { ?>
					<span class="price__value"><?php echo $_smarty_tpl->getValue('CUR_PRICE');?>
</span><span class="price__currency">&nbsp;грн</span><?php if ($_smarty_tpl->getValue('CUR_OLD_PRICE') && $_smarty_tpl->getValue('CUR_OLD_PRICE') != 0) {?><span class="plant__oldprice"><?php echo $_smarty_tpl->getValue('CUR_OLD_PRICE');?>
&nbsp;грн</span><?php }?>
					<?php if ($_smarty_tpl->getValue('PLANT_GOOD') && $_smarty_tpl->getValue('CUR_AVAILABILITY') == 0) {?>&nbsp;&nbsp;<?php echo $_smarty_tpl->getValue('LINGVO')['good_preorder_long'];
}?>
				<?php }?>
		</div>
		
		<div class="price-buttons">
		<?php if (!$_smarty_tpl->getValue('CUR_PRICE') || $_smarty_tpl->getValue('CUR_PRICE') == 0 || ($_smarty_tpl->getValue('GOOD_ONE')['preorder'] == 0 && $_smarty_tpl->getValue('GOOD_ONE')['availability'] != 1) || $_smarty_tpl->getValue('CUR_VISIBILITY') == 0) {?>
			<button class="button_accent button_product" onclick="checkProductParams('<?php echo $_smarty_tpl->getValue('LINGVO')['notify_availability'];?>
');return false"><?php echo $_smarty_tpl->getValue('LINGVO')['notify_availability'];?>
</button>
			<button class="button_frame" onclick="checkProductParams('<?php echo $_smarty_tpl->getValue('LINGVO')['find_alter'];?>
');return false"><?php echo $_smarty_tpl->getValue('LINGVO')['find_alter'];?>
</button>		
		<?php } else { ?>
			<button class="button_accent" onclick="add2cart_product('<?php echo $_smarty_tpl->getValue('CUR_GFSID');?>
', '<?php echo $_smarty_tpl->getValue('CUR_PRICE');?>
', '<?php if ($_smarty_tpl->getValue('PLANT_GOOD')) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
} else {
if ($_smarty_tpl->getValue('GOOD_ONE')['name_alter']) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name_alter'];
}
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
}?> <?php echo $_smarty_tpl->getValue('CUR_GA4_MEASURE_TTL');
if ($_smarty_tpl->getValue('CUR_COLOR_TTL')) {?> <?php echo $_smarty_tpl->getValue('CUR_COLOR_TTL');
}?>')"><?php echo $_smarty_tpl->getValue('LINGVO')['add_prod'];?>
</button>
			<button class="button_frame" onclick="show_popup('call_back_general', '<?php echo $_smarty_tpl->getValue('LINGVO')['advice_prof'];?>
 — <?php if ($_smarty_tpl->getValue('PLANT_GOOD')) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
} else {
if ($_smarty_tpl->getValue('GOOD_ONE')['name_alter']) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name_alter'];?>
 <?php }
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
}?>', 'Button 1');return false"><?php echo $_smarty_tpl->getValue('LINGVO')['advice'];?>
</button>
		<?php }?>
		</div>
			
      </div>


<?php echo '<script'; ?>
>
function checkProductParams(text){

	var clsHolder = $(".plant__holder");
	var productVal = text + ': ' + '<?php if ($_smarty_tpl->getValue('PLANT_GOOD')) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
} else {
if ($_smarty_tpl->getValue('GOOD_ONE')['name_alter']) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name_alter'];?>
 <?php }
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
}?>';
	var productSize = $("#sizes").html() || '';
	var productColor = '';

	if (clsHolder.length && !clsHolder.hasClass("hide")) {
		productColor = ', ' + $(".plant__color.active").attr("title");
	}
	
	var productMod = productSize ? '(' + productSize + productColor + ') ' : '';
	productValResult = productVal + ' ' + productMod;
	show_popup('call_back_general', productValResult , 'Button');
}


<?php echo '</script'; ?>
>

	  <div class="plant__notavailable <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('G_SIZES'))) {?> hide<?php }?>">
		<p class="notavailable_text"><?php echo $_smarty_tpl->getValue('LINGVO')['not_available'];?>
</p>
	  	<button class="button_accent button_product" onclick="checkProductParams('<?php echo $_smarty_tpl->getValue('LINGVO')['notify_availability'];?>
');return false"><?php echo $_smarty_tpl->getValue('LINGVO')['notify_availability'];?>
</button>
        <button class="button_frame" onclick="checkProductParams('<?php echo $_smarty_tpl->getValue('LINGVO')['find_alter'];?>
');return false"><?php echo $_smarty_tpl->getValue('LINGVO')['find_alter'];?>
</button>
	  </div>

      <div class="tabs">

        <ul class="tabs__header">
          <li class="tabs__headline" data-tab='0'><?php echo $_smarty_tpl->getValue('LINGVO')['poleznaya_info'];?>
</li>
          <li class="tabs__headline" data-tab='1'>Доставка</li>
          <li class="tabs__headline" data-tab='2'>Оплата</li>
        </ul>

        <ul class="tabs__body">
          <li class="tabs__content" data-tabcontent="0">
            <p class="tab__mob hide"><?php echo $_smarty_tpl->getValue('LINGVO')['poleznaya_info'];?>
</p>

            <ul class="tab__info" data-accord>

				<?php if ($_smarty_tpl->getValue('PLANT_GOOD')) {?>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['info_height'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['info_planters'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['info_original_quality'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['send_photo'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['info_good_delivery'];?>
</li>
				<?php }?>

				<?php if ($_smarty_tpl->getValue('SPECIAL_CERAMIC_GOOD')) {?>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['handmade'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['also_we_have_sizes'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['also_we_have_colors'];?>
</li>
				<?php }?>

				<?php if ($_smarty_tpl->getValue('CERAMIC_GOOD')) {?>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['made_ua'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['quality_ceramics'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['many_colors'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['perfect_forms'];?>
</li>
				<?php }?>

				<?php if ($_smarty_tpl->getValue('LECHUZA_GOOD')) {?>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['info_original_quality'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['made_de'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['quality_plastik'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['autopoliv'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['water_level'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['good_design'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['uf_rays'];?>
</li>
				<?php }?>

				<?php if ($_smarty_tpl->getValue('LAMELA_GOOD')) {?>

					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['made_pl'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['hight_quality_plastik'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['kashpo_type'];?>
</li>
					<li class="tab__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['inner_kashpo'];?>
</li>

				<?php }?>

            </ul>
            
          </li>
          
          <li class="tabs__content" data-tabcontent="1">
            <p class="tab__mob hide">Доставка</p>
            <ul class="delivery-info" data-accord>
              
              <li class="delivery-info__item delivery-info__item_ico_magazin">
			  	<div class="delivery-info__address">
					<span><?php echo $_smarty_tpl->getValue('LINGVO')['pickup_kiev'];?>
:</span>
					<ul class="delivery-info__list" type="disc">
						<li><?php echo $_smarty_tpl->getValue('LINGVO')['address_street'];?>
</li>
											</ul>
				</div>
                <p class="delivery-info__value"><?php echo $_smarty_tpl->getValue('LINGVO')['free'];?>
</p>
              </li>
              <li class="delivery-info__item delivery-info__item_ico_currier">
                <p><?php echo $_smarty_tpl->getValue('LINGVO')['currier_50'];?>
:<br /><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/delivery/" target="_blank" class="delivery-info__subtext"><?php echo $_smarty_tpl->getValue('LINGVO')['more'];?>
</a></p>
                <p class="delivery-info__value">от 200 грн</p>
              </li>
              <li class="delivery-info__item delivery-info__item_ico_np">
                <p><?php echo $_smarty_tpl->getValue('LINGVO')['pickup_from_np'];?>
:<br /><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/novaposhta/" target="_blank" class="delivery-info__subtext"><?php echo $_smarty_tpl->getValue('LINGVO')['more'];?>
</a></p>
                <p class="delivery-info__value">от 80 грн</p>
              </li>
            </ul>
            
          </li>
          
          <li class="tabs__content" data-tabcontent="2">
            <p class="tab__mob hide">Оплата</p>
            
            <div class="tabs__details">
              <ul class="tabs__payment" type="disc" data-accord>
                <li><?php echo $_smarty_tpl->getValue('LINGVO')['bsk_cash'];?>
</li>
                <li><?php echo $_smarty_tpl->getValue('LINGVO')['bsk_pay_now'];?>
</li>
                <li><?php echo $_smarty_tpl->getValue('LINGVO')['bsk_beznal'];?>
</li>
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
       	<?php if ($_smarty_tpl->getValue('PLANT_GOOD')) {?> <div class="plant__icon"><img src="/images/content/pdf-1.png" alt=""></div>
        <span class="plant__pdf" onclick="show_popup('call_back_online', '<?php echo $_smarty_tpl->getValue('LINGVO')['download_service'];?>
', 'Button 4');return false"><?php echo $_smarty_tpl->getValue('LINGVO')['download_service'];?>
</span><?php } else { ?>

		<div class="plant__icon"><img src="/images/content/pdf-1.png" alt=""></div>
        <span class="plant__pdf" onclick="showPDF('Services', '<?php echo $_smarty_tpl->getValue('LINGVO')['download_pot'];?>
 - <?php echo $_smarty_tpl->getValue('GOOD_ONE')['name'];?>
', 'PdfGoodStep1');return false"><?php echo $_smarty_tpl->getValue('LINGVO')['download_pot'];?>
</span>

		<?php }?>
      </li>
      <li class="plant__service plant__service_big">
        <div class="plant__icon"><img src="/images/content/pot-1.png" alt=""></div>
        <a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/peresadka/"><?php echo $_smarty_tpl->getValue('LINGVO')['service_peresedka'];?>
</a>
      </li>
      <li class="plant__service">
        <div class="plant__icon"><img src="/images/content/care-1.png" alt=""></div>
        <a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/house_plant_care/"><?php echo $_smarty_tpl->getValue('LINGVO')['uhod_flower'];?>
</a>
      </li>
    </ul>
    
    <div class="tabs-descr">

    <ul class="tabs__header">
		<?php if ($_smarty_tpl->getValue('GOOD_ONE')['body']) {?><li class="tabs__headline" data-tab='0'><?php echo $_smarty_tpl->getValue('LINGVO')['descr'];?>
</li><?php }?>
		<li class="tabs__headline" data-tab='1'><?php echo $_smarty_tpl->getValue('LINGVO')['accessory'];?>
</li>
		<?php if ($_smarty_tpl->getValue('GOOD_TECH')) {?><li class="tabs__headline" data-tab='2'><?php echo $_smarty_tpl->getValue('LINGVO')['plant_care'];?>
</li><?php }?>
		<li class="tabs__headline" data-tab='3'><?php echo $_smarty_tpl->getValue('LINGVO')['rewies'];?>
</li>
    </ul>

    <ul class="tabs__body">
		<?php if ($_smarty_tpl->getValue('GOOD_ONE')['body']) {?>
		<li class="tabs__content" data-tabcontent="0">
			<p class="tab__mob hide"><?php echo $_smarty_tpl->getValue('LINGVO')['descr'];?>
</p>
			<div data-accord-2>
				<?php echo $_smarty_tpl->getValue('GOOD_ONE')['body'];?>

			</div>
		</li>
		<?php }?>

        <li class="tabs__content" data-tabcontent="1">
    	<p class="tab__mob hide"><?php echo $_smarty_tpl->getValue('LINGVO')['accessory'];?>
</p>

		<div data-accord-2>

		<?php if ($_smarty_tpl->getValue('GOODS_BOARD_ACCESSORIES') && !$_smarty_tpl->getValue('ACCESSORY_GOOD')) {?>
			<span class="headline additional-goods__headline"><?php echo $_smarty_tpl->getValue('LINGVO')['grunt'];?>
</span>
			
			<ul class="additional-goods__list">
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GOODS_BOARD_ACCESSORIES'), 'GB', false, NULL, 'GB', array (
));
$foreach5DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('GB')->value) {
$foreach5DoElse = false;
?>
					<li class="additional-goods__item">
						<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/product/<?php echo $_smarty_tpl->getValue('GB')['ID'];?>
_<?php echo $_smarty_tpl->getValue('GB')['link'];?>
/" class="additional-goods__img" title="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GB')['name'],'"','');?>
"><img src="/images/ins/s/<?php echo $_smarty_tpl->getValue('GB')['image'];?>
" height="150" alt="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GB')['name'],'"','');?>
" /></a>
						<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/product/<?php echo $_smarty_tpl->getValue('GB')['ID'];?>
_<?php echo $_smarty_tpl->getValue('GB')['link'];?>
/" class="additional-goods__name" title="<?php echo $_smarty_tpl->getValue('LINGVO')['button_buy'];?>
 <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GB')['name'],'"','');?>
"><?php echo $_smarty_tpl->getValue('GB')['name'];?>
</a>
						<div class="additional-goods__price"><?php if ($_smarty_tpl->getValue('GB')['min_price'] == $_smarty_tpl->getValue('GB')['max_price']) {
echo $_smarty_tpl->getValue('GB')['min_price'];
} else {
echo $_smarty_tpl->getValue('GB')['min_price'];?>
&nbsp;&ndash;&nbsp;<?php echo $_smarty_tpl->getValue('GB')['max_price'];
}?>&nbsp;<span class="uah">грн.</span></div>
					</li>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ul>
		<?php }?>

		
		<span class="headline additional-goods__headline indent"><?php echo $_smarty_tpl->getValue('LINGVO')['other_in_cat'];?>
: <?php echo $_smarty_tpl->getValue('GOOD_ONE')['className'];?>
</h2>

		<ul class="additional-goods__list">
			<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GOODS_BOARD'), 'GB', false, NULL, 'GB', array (
));
$foreach6DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('GB')->value) {
$foreach6DoElse = false;
?>
				<li class="additional-goods__item">
					<a href="<?php echo $_smarty_tpl->getValue('GB')['new_link'];?>
" class="additional-goods__img" title="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GB')['name'],'"','');?>
"><img src="/images/ins/s/<?php echo $_smarty_tpl->getValue('GB')['image'];?>
" height="150" alt="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GB')['name'],'"','');?>
" /></a>
					<a href="<?php echo $_smarty_tpl->getValue('GB')['new_link'];?>
" class="additional-goods__name" title="<?php echo $_smarty_tpl->getValue('LINGVO')['button_buy'];?>
 <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GB')['name'],'"','');?>
"><?php echo $_smarty_tpl->getValue('GB')['name'];?>
</a>
					<div class="additional-goods__price"><?php if ($_smarty_tpl->getValue('GB')['min_price'] == $_smarty_tpl->getValue('GB')['max_price']) {
echo $_smarty_tpl->getValue('GB')['min_price'];
} else {
echo $_smarty_tpl->getValue('GB')['min_price'];?>
&nbsp;&ndash;&nbsp;<?php echo $_smarty_tpl->getValue('GB')['max_price'];
}?>&nbsp;<span class="uah">грн.</span></div>
				</li>
			<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
		</ul>

	
	
		<div class="additional-goods">
			<span class="headline additional-goods__headline indent"><?php echo $_smarty_tpl->getValue('LINGVO')['see_also'];?>
</span>
			<ul class="additional-goods__list">
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GOODS_BOARD_LECHUZA'), 'GBL', false, NULL, 'GBL', array (
));
$foreach7DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('GBL')->value) {
$foreach7DoElse = false;
?>
					<li class="additional-goods__item">
						<a href="<?php echo $_smarty_tpl->getValue('GBL')['new_link'];?>
" class="additional-goods__img" title="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GBL')['name'],'"','');?>
"><img src="<?php echo $_smarty_tpl->getValue('GBL')['image'];?>
" height="150" alt="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GBL')['name'],'"','');?>
"  /></a>
						<a href="<?php echo $_smarty_tpl->getValue('GBL')['new_link'];?>
" class="additional-goods__name" title="Купить <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GBL')['name'],'"','');?>
"><?php echo $_smarty_tpl->getValue('GBL')['name'];?>
</a>
						<div class="additional-goods__price"><?php if ($_smarty_tpl->getValue('GBL')['min_price'] == $_smarty_tpl->getValue('GBL')['max_price']) {
echo $_smarty_tpl->getValue('GBL')['min_price'];
} else {
echo $_smarty_tpl->getValue('GBL')['min_price'];?>
&nbsp;&ndash;&nbsp;<?php echo $_smarty_tpl->getValue('GBL')['max_price'];
}?>&nbsp;<span class="uah">грн.</span></div>
					</li>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ul>
		</div>

	
	</div>

    </li>

	<?php if ($_smarty_tpl->getValue('GOOD_TECH')) {?>
		<li class="tabs__content" data-tabcontent="2">
			<p class="tab__mob hide"><?php echo $_smarty_tpl->getValue('LINGVO')['plant_care'];?>
</p>

			<ul class="tabs__techs" data-accord-2>
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GOOD_TECH'), 'GT');
$foreach8DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('GT')->value) {
$foreach8DoElse = false;
?>
					<li class="tabs__tech">
							<p class="tabs__techcaption"><?php echo $_smarty_tpl->getValue('GT')['name'];?>
</p>
							<p class="tabs__techdescr"><?php echo $_smarty_tpl->getValue('GT')['val'];?>
 <?php echo $_smarty_tpl->getValue('GT')['measure'];?>
</p>
					</li>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ul>


		</li>
	<?php }?>

	<li class="tabs__content" data-tabcontent="3">
	<p class="tab__mob hide"><?php echo $_smarty_tpl->getValue('LINGVO')['rewies'];?>
</p>


		<div class="comments" data-accord-2>

			<div class="comments__form">

				<?php if ($_SESSION['good_comment'] == $_smarty_tpl->getValue('PAGETYPE_SESSNAME')) {?>
					<span class="headline"><?php echo $_smarty_tpl->getValue('LINGVO')['your_rewie_added'];?>
</span>
				<?php } else { ?>
					<span class="headline"><?php echo $_smarty_tpl->getValue('LINGVO')['rewie_or_quastion'];?>
</span>

					<form method="post" action="" onsubmit="return check_form_blog_comment_add(this);">
						<input type="hidden" name="pageID" value="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
">
						<input type="hidden" name="pageType" value="good">

						<div class="comments__container">
							<div class="comments__label">
								<p><?php echo $_smarty_tpl->getValue('LINGVO')['fb_name'];?>
:<span class="redstar">*</span></p>
								<span class="error_block" id="error_n_good_comment_name"><?php echo $_smarty_tpl->getValue('LINGVO')['fb_name_false'];?>
</span>
							</div>

							<input type="Text" name="n_good_comment_name" class="inp-ins comments__field">
						</div>

						<div class="comments__container">
							<div class="comments__label">
								<p><?php echo $_smarty_tpl->getValue('LINGVO')['fb_phone'];?>
:<span class="redstar">*</span></p>
								<span class="error_block" id="error_n_good_comment_email"><?php echo $_smarty_tpl->getValue('LINGVO')['fb_phone_false'];?>
</span>
							</div>

							<input type="Text" name="n_good_comment_email" class="inp-ins comments__field">
						</div>

						<div class="comments__container">
							<div class="comments__label">
								<p><?php echo $_smarty_tpl->getValue('LINGVO')['fb_comment'];?>
:<span class="redstar">*</span></p>
								<span class="error_block" id="error_n_good_message"><?php echo $_smarty_tpl->getValue('LINGVO')['fb_comment'];?>
</span>
							</div>
							<textarea name="n_good_message" class="inp-ins comments__field" style="height:60px;" ></textarea>
						</div>

						<div class="comments__container">
							<div class="comments__label">
								<span><?php echo $_smarty_tpl->getValue('LINGVO')['fb_stars'];?>
:</span>
								<input type="Hidden" id="starsChosed" name="vote" value="5" />
								<input type="Hidden" id="starsClicked" name="starsClicked1" value="0" />
								<ul class="holder" id="stars" style="background-position: 0px -105px;">
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
,1);" title="1">1</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
,2);" title="2">2</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
,3);" title="3">3</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
,4);" title="4">4</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
,5);" title="5">5</li>
								</ul>
							</div>
							<input type="submit" name="n_comment_add" value="<?php echo $_smarty_tpl->getValue('LINGVO')['send'];?>
" class="inp-but" />
						</div>
					</form>
			</div>
		
			<ul class="comments__list">

				<?php if ($_smarty_tpl->getValue('GOOD_FEEDBACK')) {?>
				<div class="row" style="margin-bottom:20px;">
					<div class="feed-back-comments">
						<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GOOD_FEEDBACK'), 'COMM');
$foreach9DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('COMM')->value) {
$foreach9DoElse = false;
?>
						<div class="box box-gray">
							<i class="t1"></i><i class="t2"></i>
							<div class="box-content">
								<div class="board-text"><?php echo nl2br((string) $_smarty_tpl->getValue('COMM')['message'], (bool) 1);?>
</div>
								<ul class="board-stuff">
									<li><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('COMM')['date_add'],"%d.%m.%Y");?>
</dt>
									<li><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('COMM')['u_name'], ENT_QUOTES, 'UTF-8', true);?>
</dt>
									<li><div class="stars-mini stars-mini-<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('COMM')['vote'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('COMM')['vote'], ENT_QUOTES, 'UTF-8', true);?>
</div></dt>
								</ul>
							</div>
							<i class="t2"></i><i class="t1"></i>
						</div>
						<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
					</div>
				</div>
				<?php } else { ?>
				<div class="feed-back-comments">
					<div class="box box-gray">
						<i class="t1"></i><i class="t2"></i>
						<div class="box-content">
							<div class="board-text"><?php echo $_smarty_tpl->getValue('LINGVO')['no_rewies_yet'];?>
</div>
							<ul class="board-stuff">
								<li><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%d.%m.%Y");?>
</dt>
								<li>Флорен</dt>
								<li><div class="stars-mini stars-mini-5">5</div></dt>
							</ul>
						</div>
						<i class="t2"></i><i class="t1"></i>
					</div>
				</div>
				<?php }?>

			</ul>
			
		</div>
	<?php }?>

	</li>

    </ul>

  </div>
    
  </div>

	<?php if ($_smarty_tpl->getValue('GOOD_PLANT')) {?>

	<div class="see-also">
			<span class="headline"><?php echo $_smarty_tpl->getValue('LINGVO')['see_also'];?>
:</span>

			<ul class="see-also__list">
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GOODS_BOARD'), 'GB', false, NULL, 'GB', array (
));
$foreach10DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('GB')->value) {
$foreach10DoElse = false;
?>
					<li class="see-also__item see-also__item_notavailable">
					<a href="<?php echo $_smarty_tpl->getValue('GB')['new_link'];?>
" class="imglink" title="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GB')['name'],'"','');?>
">
						<img src="/images/ins/s/<?php echo $_smarty_tpl->getValue('GB')['image'];?>
" height="100" alt="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GB')['name'],'"','');?>
" />
					</a>
					<div class="see-also__details">
						<a href="<?php echo $_smarty_tpl->getValue('GB')['new_link'];?>
" class="imgname" title="<?php echo $_smarty_tpl->getValue('LINGVO')['button_buy'];?>
 <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('GB')['name'],'"','');?>
"><?php echo $_smarty_tpl->getValue('GB')['name'];?>
</a>
						<div class="promo-price"><?php if ($_smarty_tpl->getValue('GB')['min_price'] == $_smarty_tpl->getValue('GB')['max_price']) {
echo $_smarty_tpl->getValue('GB')['min_price'];
} else {
echo $_smarty_tpl->getValue('GB')['min_price'];?>
&nbsp;&ndash;&nbsp;<?php echo $_smarty_tpl->getValue('GB')['max_price'];
}?>&nbsp;<span class="uah">грн.</span></div>
					</div>
					</li>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ul>
	</div>

	<?php }?>

</div>

<div class="plant__videos">
	<?php if ($_smarty_tpl->getValue('G_SIZES')) {?>
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GO_FORMS'), 'size');
$foreach11DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('size')->value) {
$foreach11DoElse = false;
?>
			<?php if ($_smarty_tpl->getValue('size')['video']) {?>
				<div data-modal="<?php echo $_smarty_tpl->getValue('size')['fid'];?>
" class="modal modal_center modal_hide">
					<button class="close-btn"></button>
					<div>
						<p class="modal__headline"><?php if ($_smarty_tpl->getValue('PLANT_GOOD')) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
} else {
if ($_smarty_tpl->getValue('GOOD_ONE')['name_alter']) {
echo $_smarty_tpl->getValue('GOOD_ONE')['name_alter'];?>
 <?php }
echo $_smarty_tpl->getValue('GOOD_ONE')['name'];
}?>, <?php echo $_smarty_tpl->getValue('FORM_MEASURES')[$_smarty_tpl->getValue('size')['fid']];?>
</p>
						<iframe id="m_video" width="100%" height="500" src="https://www.youtube.com/embed/<?php echo $_smarty_tpl->getValue('size')['video'];?>
" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			<?php }?>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
	<?php }?>
</div><?php }
}
