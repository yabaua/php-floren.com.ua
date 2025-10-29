<?php
/* Smarty version 5.5.2, created on 2025-09-23 09:39:24
  from 'file:category/plants.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68d2409c3815e2_83603227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2bd27c2c6f354a29029e4ea03caff8eaf94c0a1' => 
    array (
      0 => 'category/plants.tpl',
      1 => 1732533585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68d2409c3815e2_83603227 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/floren.com.ua/templates/category';
?><div class="catalog">

	<header class="catalog__header">

    <h1 class="products__title"><?php echo $_smarty_tpl->getValue('PAGE_TITLE');?>
</h1>
	
	<?php if ('TOP_SEO_TEXT') {?>
		<div class="article_body"><?php echo $_smarty_tpl->getValue('TOP_SEO_TEXT');?>
</div>
	<?php }?>

	<!--seoshield_formulas--kategorii-->
	
	<button class="filters__mobile-btn" data-modal-trg="5"><?php echo $_smarty_tpl->getValue('LINGVO')['show_filters'];?>
</button>
	</header>

	<ul class="products">
		<!--isset_listing_page-->
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('PROMO'), 'P');
$foreach7DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('P')->value) {
$foreach7DoElse = false;
?>
			
			<!--product_in_listingEX-->
			<!--dg_prod_in_lisintg_href:<?php echo $_smarty_tpl->getValue('LANGURL');?>
/product/<?php echo $_smarty_tpl->getValue('P')['ID'];?>
_<?php echo $_smarty_tpl->getValue('P')['link'];?>
/;;dg_prod_in_lisintg_anchor:<?php echo $_smarty_tpl->getValue('P')['name'];?>
-->
			<li class="product <?php if (($_smarty_tpl->getValue('P')['not_available'] === 1 && $_smarty_tpl->getValue('P')['preorder'] == 0) || $_smarty_tpl->getValue('P')['act'] == '0') {?>product_mark<?php }?>">

				<a href="<?php echo $_smarty_tpl->getValue('P')['product_path'];?>
" class="product__img">
					<?php if ($_smarty_tpl->getValue('P')['is_action']) {?><div style="position:absolute;right:3px;top:3px;width:90px;"><img src="/img/znizhka_s.png" width="90" height="39" alt="Знижка"></div><?php }?>
					<img width="150" src="<?php echo $_smarty_tpl->getValue('P')['img_path'];?>
" alt="Фото <?php echo $_smarty_tpl->getValue('P')['name'];?>
">
				</a>

				<a href="<?php echo $_smarty_tpl->getValue('P')['product_path'];?>
" class="product__link">
					<p class="product__headline break"><?php echo $_smarty_tpl->getValue('P')['name'];?>
</p>
				</a>
				<?php if ($_smarty_tpl->getValue('P')['not_available'] === 0) {?>

				<div class="product__buy">

					<div class="product__prices">
						<div class="goodcost"><?php echo $_smarty_tpl->getValue('LINGVO')['price'];?>
: </div><span class="goodprice"><?php echo $_smarty_tpl->getValue('P')['min_price'];?>
</span><span class="goodcur">грн</span>

						<?php if ($_smarty_tpl->getValue('P')['min_price'] != $_smarty_tpl->getValue('P')['max_price']) {?>
							<nobr><span class="goodprice dash"><?php echo $_smarty_tpl->getValue('P')['max_price'];?>
</span><span class="goodcur">грн</span></nobr>
						<?php }?>

					</div>
					
					<a href="<?php echo $_smarty_tpl->getValue('P')['product_path'];?>
" class="product__btn btn btn_default"><?php echo $_smarty_tpl->getValue('LINGVO')['button_buy'];?>
</a>

				</div>

					<div class="product__hide hide">

						<div class="info">

							<p class="info__headline"><?php echo $_smarty_tpl->getValue('LINGVO')['varianty'];?>
:</p>

							<ul class="info__list">
								<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('P')['forms'], 'F');
$foreach8DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('F')->value) {
$foreach8DoElse = false;
?>
									<li class="info__item">
										<span>
											<?php if ($_smarty_tpl->getValue('F')['dia']) {?>&#216; <?php echo $_smarty_tpl->getValue('F')['dia'];?>
 <?php }?>
											<?php if ($_smarty_tpl->getValue('F')['wdt']) {
echo $_smarty_tpl->getValue('F')['wdt'];?>
 
											<?php if ($_smarty_tpl->getValue('F')['depth']) {?>x <?php echo $_smarty_tpl->getValue('F')['depth'];?>
 <?php }
}?>
											<?php if ($_smarty_tpl->getValue('F')['hgt']) {?>x <?php echo $_smarty_tpl->getValue('F')['hgt'];
}?>
											<?php if ($_smarty_tpl->getValue('F')['measure_qt']) {
echo $_smarty_tpl->getValue('F')['measure_qt'];?>
 <?php echo $_smarty_tpl->getValue('F')['unit'];
}?>
										</span>
									</li>
								<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
							</ul>

							<?php if ($_smarty_tpl->getValue('P')['colors']) {?>

							<p class="info__headline info__headline_colors"><?php echo $_smarty_tpl->getValue('LINGVO')['colors'];?>
</p>

							<ul class="info__list">
								<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('P')['colors'], 'FC');
$foreach9DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('FC')->value) {
$foreach9DoElse = false;
?>
									<li class="info__item_color">
										<div>
											<img width="20" height="20" title="<?php echo $_smarty_tpl->getValue('FC')['name_ru'];?>
" src="/images/ins/preview/<?php echo $_smarty_tpl->getValue('FC')['image'];?>
" alt="Фото <?php echo $_smarty_tpl->getValue('FC')['name_ru'];?>
">
										</div>
									</li>
								<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
							</ul>

							<?php }?>

						</div>

					</div>
				<?php } elseif ($_smarty_tpl->getValue('P')['preorder'] == 1 && $_smarty_tpl->getValue('P')['act'] == 'Y') {?>
					<div class="product__notavailable"><?php echo $_smarty_tpl->getValue('LINGVO')['good_preorder'];?>
</div>
				<?php } else { ?>
					<div class="product__notavailable"><?php echo $_smarty_tpl->getValue('LINGVO')['not_available'];?>
</div>
				<?php }?>
				
			</li>

		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
	</ul>
</div>

<?php if ($_smarty_tpl->getValue('PAGE_MAX') > 1) {?>
	<div class="pagination">

		<?php if (!$_smarty_tpl->getValue('FROM_GOODS')) {?>

		<button type="button" id="readmore" class="pagination__btn" data-lang="<?php echo $_smarty_tpl->getValue('DBSUFIX');?>
" data-current-page="<?php echo $_smarty_tpl->getValue('CUR_PAGE');?>
" data-last-page="<?php echo $_smarty_tpl->getValue('LASTPAGE');?>
"><?php echo $_smarty_tpl->getValue('LINGVO')['show_more'];?>
</button>

		<?php }?>

		<ul class="pagination__pages">
			<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('PAGES'), 'P');
$foreach10DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('P')->value) {
$foreach10DoElse = false;
?>
				<li class="pagination__page">
					<?php if ($_smarty_tpl->getValue('FROM_GOODS')) {?>

					<a title="<?php echo $_smarty_tpl->getValue('LINGVO')['pages_goto'];?>
 <?php echo $_smarty_tpl->getValue('P')['page'];?>
" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/<?php echo $_smarty_tpl->getValue('URL')[0];?>
/<?php echo $_smarty_tpl->getValue('URL')[1];?>
/<?php if ($_smarty_tpl->getValue('URL')[2]) {
echo $_smarty_tpl->getValue('URL')[2];?>
/<?php }
if ($_smarty_tpl->getValue('P')['page'] != 1) {?>?p=<?php echo $_smarty_tpl->getValue('P')['page'];
}?>" class="pagination__link <?php if ($_smarty_tpl->getValue('P')['active']) {?>current<?php }?>"><?php echo $_smarty_tpl->getValue('P')['page'];?>
</a>

					<?php } else { ?>

					<a title="<?php echo $_smarty_tpl->getValue('LINGVO')['pages_goto'];?>
 <?php echo $_smarty_tpl->getValue('P')['page'];?>
" id="p<?php echo $_smarty_tpl->getValue('P')['page'];?>
" rel="<?php if ($_smarty_tpl->getValue('P')['prev']) {?>prev<?php }
if ($_smarty_tpl->getValue('P')['next']) {?>next<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/<?php echo $_smarty_tpl->getValue('ALIAS');
echo $_smarty_tpl->getValue('FILTERS_URL');
if ($_smarty_tpl->getValue('P')['page'] == 1) {?>/<?php } else { ?>/page<?php echo $_smarty_tpl->getValue('P')['page'];?>
/<?php }?>" class="pagination__link <?php if ($_smarty_tpl->getValue('P')['active']) {?>current<?php }?>"><?php echo $_smarty_tpl->getValue('P')['page'];?>
</a>

					<?php }?>

				</li>
			<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
		</ul>
		
	</div>
<?php }?>

<?php if ($_smarty_tpl->getValue('SHOW_COMMENTS')) {?>

<div class="comments" style="margin-top: 50px">

			<div class="comments__form">

				<?php if ($_SESSION['good_comment'] == $_smarty_tpl->getValue('PAGETYPE_SESSNAME')) {?>
					<span class="headline"><?php echo $_smarty_tpl->getValue('LINGVO')['your_rewie_added'];?>
</span>
				<?php } else { ?>
					<span class="headline"><?php echo $_smarty_tpl->getValue('LINGVO')['rewie_or_quastion'];?>
</span>

					<form method="post" action="" onsubmit="return check_form_blog_comment_add(this);">
						<input type="hidden" name="pageID" value="<?php echo $_smarty_tpl->getValue('CATEGORY_ID');?>
">
						<input type="hidden" name="pageType" value="goodCAT">

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
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('CATEGORY_ID');?>
,1);" title="1">1</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('CATEGORY_ID');?>
,2);" title="2">2</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('CATEGORY_ID');?>
,3);" title="3">3</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('CATEGORY_ID');?>
,4);" title="4">4</li>
									<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('CATEGORY_ID');?>
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
$foreach11DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('COMM')->value) {
$foreach11DoElse = false;
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
			<?php }?>
		</div>

<?php }
echo $_smarty_tpl->getValue('SCHEMA_OFFERS');?>

<?php if ($_smarty_tpl->getValue('CUR_PAGE') == 1) {?>
	<div class="product__descr">
			<?php echo $_smarty_tpl->getValue('CENTER_SEO_TEXT');?>

	</div>
<?php }?>

<?php echo '<script'; ?>
>
	var show_more_idds='<?php echo $_smarty_tpl->getValue('SHOW_MORE_IDDS');?>
';
	var productLingvo = {
            notAvailable: "<?php echo $_smarty_tpl->getValue('LINGVO')['not_available'];?>
",
			productSizes: "<?php echo $_smarty_tpl->getValue('LINGVO')['varianty'];?>
",
			productColors: "<?php echo $_smarty_tpl->getValue('LINGVO')['colors'];?>
",
			buttonBuy: "<?php echo $_smarty_tpl->getValue('LINGVO')['button_buy'];?>
",
			productPrice: "<?php echo $_smarty_tpl->getValue('LINGVO')['price'];?>
",
			showMore: "<?php echo $_smarty_tpl->getValue('LINGVO')['show_more'];?>
",
        };
<?php echo '</script'; ?>
>
<?php }
}
