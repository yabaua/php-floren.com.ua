<?php
/* Smarty version 5.5.2, created on 2025-10-27 13:03:51
  from 'file:nav_phytodesign.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68ff51972384d6_44783103',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '611b48dbbbd85e9f51081414eb0b50d23311b6e4' => 
    array (
      0 => 'nav_phytodesign.tpl',
      1 => 1743074942,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68ff51972384d6_44783103 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/floren.com.ua2/templates';
?><div class="main-menu">
	<div class="mobile-menu__btns">
		<button class="mobile-menu__btn" data-modal-trg="8"><span><?php echo $_smarty_tpl->getValue('LINGVO')['goods_services'];?>
</span></button>
		<button class="mobile-menu__search" data-modal-trg="4"></button>
		<div style="position:relative">
			<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('BASKET')) > 0) {?>
				<a class="mobile-menu__bsk" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/basket/"></a>
				<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/basket/" class="header__counter header__counter_mobile"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('BASKET'));?>
</a>
			<?php } else { ?>
				<span class="mobile-menu__bsk"></span>
			<?php }?>
		</div>
	</div>
	<div class="main-menu__container modal_left modal_hide" data-modal="8">
		<button class="close-btn"></button>
		<div class="header__lang lang lang_products-btn">
			<span class="lang__caption"><?php echo $_smarty_tpl->getValue('LINGVO')['lang'];?>
:</span>
			<a href="<?php echo $_smarty_tpl->getValue('LANG_SELECTOR_UA');?>
" class="lang__ua<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?> lang__active<?php }?>">UA</a>
			<a href="<?php echo $_smarty_tpl->getValue('LANG_SELECTOR_RU');?>
" class="lang__ru<?php if ($_smarty_tpl->getValue('LANG') == 'ru') {?> lang__active<?php }?>">RU</a>
		</div>
		<ul class="hero-menu">
			<li class="hero-menu__item">
				<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/phytodesign/" class="hero-menu__link"><?php echo $_smarty_tpl->getValue('LINGVO')['phytodesign'];?>

					<span class="hero-menu__subtext"><?php echo mb_strtolower((string) $_smarty_tpl->getValue('LINGVO')['ozelenenie_ofisov'], 'UTF-8');?>
</span>
				</a>
			</li>

			<li class="hero-menu__item" data-menu="1">
				<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/" class="hero-menu__link nowprap"><?php echo $_smarty_tpl->getValue('LINGVO')['plants'];?>
 <span class="hero-menu__subtext"><?php echo $_smarty_tpl->getValue('LINGVO')['dlya_ofisa_i_kvartiri'];?>
</span></a>
				
				<div class="hero-menu__list" data-submenu="1">
					<ul class="hero-menu__sub-menu sub-menu">
						<li class="sub-menu__item sub-menu__item_hide"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/"><?php echo $_smarty_tpl->getValue('LINGVO')['all_plants'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/orchids/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_orchids'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/decorative/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_decorative'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/palms/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_palms'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/citrus/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_citrus'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/bloom/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_bloom'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/sansevieriya/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_sansevieriya'];?>
</a></li>
					</ul>
					<ul class="hero-menu__sub-menu sub-menu">
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/ficus/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_ficus'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/dracaena/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_dracaena'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/cactus/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_cactus'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/liana/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_liana'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/product/546_fikus_microcarpa__mikrokarpa/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_bonsai'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/sukkulenty/"><?php echo $_smarty_tpl->getValue('LINGVO')['sukkulenty'];?>
</a></li>
					</ul>
					<ul class="hero-menu__sub-menu sub-menu">
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/yucca/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_yukka'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/bulbs/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_bulbs'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/khvoynyye/"><?php echo $_smarty_tpl->getValue('LINGVO')['khvoynyye'];?>
</a></li>
					</ul>
					<ul class="hero-menu__sub-menu sub-menu">
						<li class="sub-menu__item sub-menu__item_mark"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gift-card/">– <?php echo $_smarty_tpl->getValue('LINGVO')['gift_card'];?>
</a></li>
						<li class="sub-menu__item sub-menu__item_mark"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/compositions/click-grow/">– <?php echo $_smarty_tpl->getValue('LINGVO')['umniy_sad'];?>
 Click & Grow</a></li>
						<li class="sub-menu__item sub-menu__item_mark"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/iskusstvennie-cvety/">– <?php echo $_smarty_tpl->getValue('LINGVO')['iskusstvennie_cvety'];?>
</a></li>
						<li class="sub-menu__item sub-menu__item_mark"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/peregorodki-iz-rasteniy/">– <?php echo $_smarty_tpl->getValue('LINGVO')['peregorodki_iz_rasteniy'];?>
</a></li>
						<li class="sub-menu__item sub-menu__item_mark"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/aksessuary/">– <?php echo $_smarty_tpl->getValue('LINGVO')['accessory'];?>
</a></li>
					</ul>
				</div>

			</li>

			<li class="hero-menu__item hero-menu__item_relative" data-menu="2">
				<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/" class="hero-menu__link"><?php echo $_smarty_tpl->getValue('LINGVO')['planters'];?>
<span class="hero-menu__subtext"><?php echo $_smarty_tpl->getValue('LINGVO')['dlya_rasteniy'];?>
</span></a>
				
				<div class="hero-menu__list" data-submenu="2">
					<ul class="hero-menu__sub-menu sub-menu">
						<li class="sub-menu__item sub-menu__item_hide"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/"><?php echo $_smarty_tpl->getValue('LINGVO')['all_pots'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/ceramic/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_ceramic'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/lechuza/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_lechuza'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/lamela/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_lamela'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/elho/"><?php echo $_smarty_tpl->getValue('LINGVO')['planters'];?>
 ELHO</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/wood-planters/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_wood_planters'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/metal-pots/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_metall_planters'];?>
</a></li>
						<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/beton/"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_beton'];?>
</a></li>
						<li class="sub-menu__item sub-menu__item_mark"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/aksessuary/"><?php echo $_smarty_tpl->getValue('LINGVO')['accessory'];?>
</a></li>
					</ul>
				</div>

			</li>
			<li class="hero-menu__item">
					<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/house_plant_care/" class="hero-menu__link"><?php echo $_smarty_tpl->getValue('LINGVO')['care'];?>
 <span class="hero-menu__subtext"><?php echo $_smarty_tpl->getValue('LINGVO')['za_rasteniyami'];?>
</span></a>
			</li>

			<li class="hero-menu__item">
					<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gallery/" class="hero-menu__link"><?php echo $_smarty_tpl->getValue('LINGVO')['gallery'];?>
 <span class="hero-menu__subtext"><?php echo $_smarty_tpl->getValue('LINGVO')['photo_gallery'];?>
</span></a>
			</li>
			
			<li class="hero-menu__item" data-menu="3">
				<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/" class="hero-menu__link"><?php echo $_smarty_tpl->getValue('LINGVO')['services'];?>
 <span class="hero-menu__subtext"><?php echo $_smarty_tpl->getValue('LINGVO')['order_service'];?>
</span></a>
				<div class="hero-menu__list" data-submenu="3">
					
					<div class="hero-menu__column">
						<div>
							<span class="hero-menu__subheader"><?php echo $_smarty_tpl->getValue('LINGVO')['phytodesign'];?>
</span>
							<ul class="hero-menu__sub-menu sub-menu">
								<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/phytodesign/"><?php echo $_smarty_tpl->getValue('LINGVO')['phytodesign'];?>
</a></li>
								<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/peresadka/"><?php echo $_smarty_tpl->getValue('LINGVO')['peresadka_rasteniy'];?>
</a></li>
								<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/shipping/"><?php echo $_smarty_tpl->getValue('LINGVO')['perevozka_rasteniy'];?>
</a></li>
								<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/arenda_rasteniy/"><?php echo $_smarty_tpl->getValue('LINGVO')['arenda_rasteniy'];?>
</a></li>
								<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/peregorodki-iz-rasteniy/"><?php echo $_smarty_tpl->getValue('LINGVO')['peregorodki_iz_rasteniy'];?>
</a></li>
								<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/house_plant_care/"><?php echo $_smarty_tpl->getValue('LINGVO')['care'];?>
 <?php echo $_smarty_tpl->getValue('LINGVO')['za_rasteniyami'];?>
</a></li>
								<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/novogodnee_oformlenie/"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_new_year'];?>
 </a></li>
							</ul>
						</div>
					</div>

					<div class="hero-menu__column">
						<span class="hero-menu__subheader"><?php echo $_smarty_tpl->getValue('LINGVO')['exterernie_raboti'];?>
</span>
						<ul class="hero-menu__sub-menu sub-menu">
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/ozelenenie_letney_ploschadki/"><?php echo $_smarty_tpl->getValue('LINGVO')['ozelenenie_kafe'];?>
</a></li>
						</ul>
					</div>

					<div class="hero-menu__column">
						<span class="hero-menu__subheader"><?php echo $_smarty_tpl->getValue('LINGVO')['vertikalnoe_ozelenenie'];?>
</span>
						<ul class="hero-menu__sub-menu sub-menu">
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/green-wall/"><?php echo $_smarty_tpl->getValue('LINGVO')['green_wall'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/vertikalnoe-ozelenenie/"><?php echo $_smarty_tpl->getValue('LINGVO')['vertikalnoe_ozelenenie_kv_of'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/ozelenenie-stabilizirovannim-mhom/"><?php echo $_smarty_tpl->getValue('LINGVO')['ozelenenie_moss'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami/"><?php echo $_smarty_tpl->getValue('LINGVO')['metall_ozel'];?>
</a></li>
						</ul>
					</div>

					<div class="hero-menu__column">
						<span class="hero-menu__subheader"><?php echo $_smarty_tpl->getValue('LINGVO')['landscape'];?>
</span>
						<ul class="hero-menu__sub-menu sub-menu">
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/landscape/"><?php echo $_smarty_tpl->getValue('LINGVO')['landscape'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/blagoustroistvo/"><?php echo $_smarty_tpl->getValue('LINGVO')['ozelenenie_i_blago'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/blagoustroistvo/posadka-krupnomerov/"><?php echo $_smarty_tpl->getValue('LINGVO')['posadka_krupnomerov'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/blagoustroistvo/klumbi/"><?php echo $_smarty_tpl->getValue('LINGVO')['klumbi'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/blagoustroistvo/alpiyskaya-gorka/"><?php echo $_smarty_tpl->getValue('LINGVO')['alpiyskaya_gorka'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/blagoustroistvo/zhivaya-izgorod/"><?php echo $_smarty_tpl->getValue('LINGVO')['zhivaya_izgorod'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gazon/"><?php echo $_smarty_tpl->getValue('LINGVO')['gazon'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gazon/rulonniy-gazon/"><?php echo $_smarty_tpl->getValue('LINGVO')['rulonniy_gazon'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gazon/posevnoi-gazon/"><?php echo $_smarty_tpl->getValue('LINGVO')['posevnoi_gazon'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gazon/avtopoliv/"><?php echo $_smarty_tpl->getValue('LINGVO')['avtopoliv'];?>
</a></li>
							<li class="sub-menu__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/uhod/"><?php echo $_smarty_tpl->getValue('LINGVO')['uhod'];?>
</a></li>
						</ul>
					</div>

				</div>
			</li>
		</ul>
	</div>
</div>

<div data-modal="4" class="modal modal_center modal_hide">
	<button class="close-btn"></button>
	<div>
		<p class="modal__headline"><?php echo $_smarty_tpl->getValue('LINGVO')['site_search'];?>
</p>
		<form style="display: flex;" name="f1" method="post" action="https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/search/">					
			<input type="text" name="srch" class="search-bar__input<?php if (!$_smarty_tpl->getValue('SRCH_ROW') || $_smarty_tpl->getValue('SRCH_ROW') == '') {?> search-bar__input_gray<?php }?>" value="<?php if ($_smarty_tpl->getValue('SRCH_ROW')) {
echo $_smarty_tpl->getValue('SRCH_ROW');
} else {
echo $_smarty_tpl->getValue('LINGVO')['search_default_txt'];
}?>" onblur="this.value = this.value.replace(/^(\s*)/, '').replace(/(\s*)$/, ''); if (this.value==''){ this.value='<?php echo $_smarty_tpl->getValue('LINGVO')['search_default_txt'];?>
';this.className='search-bar__input search-bar__input_gray'}" onfocus='if (this.value=="<?php echo $_smarty_tpl->getValue('LINGVO')['search_default_txt'];?>
"){ this.value="";this.className="search-bar__input"}' />
			
			<button type="submit" class="search-bar__btn"></button>
		</form>
	</div>
</div><?php }
}
