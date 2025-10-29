<?php
/* Smarty version 5.5.2, created on 2025-09-23 10:36:04
  from 'file:left_col.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68d24de4a2db43_85736731',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15e258eb1e1fd0f0928062c23bd2a176898f2f0b' => 
    array (
      0 => 'left_col.tpl',
      1 => 1758612962,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68d24de4a2db43_85736731 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/floren.com.ua/templates';
?><div class="filters">

	<div class="filters__wrapper">
	<button class="close-btn"></button>

<?php if ($_smarty_tpl->getValue('CUR_CAT') == 'publications') {?>
	<div class="filters__info">
		<p class="filters__name"><?php echo $_smarty_tpl->getValue('LINGVO')['nav'];?>
</p>
		<ul class="filters__list">

			<li class="filters__item"><a class="filters__link" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/publications/">Все</a></li>

			<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('PUB_CATEGORIES'), 'PC', false, NULL, 'PC', array (
));
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('PC')->value) {
$foreach0DoElse = false;
?>
				<li class="filters__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/publications/?cat=<?php echo $_smarty_tpl->getValue('PC')['alias'];?>
" class="filters__link <?php if ($_smarty_tpl->getValue('PC')['act'] == '1') {?>filters__link_active<?php }?>"><?php echo $_smarty_tpl->getValue('PC')['name'];?>
</a></li>
			<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

		</ul>
	</div>

<?php } elseif ($_smarty_tpl->getValue('CUR_CAT') == '777' || $_smarty_tpl->getValue('CUR_CAT') == 'phytodesign' || $_smarty_tpl->getValue('URL')[0] == 'phytodesign') {?>

		<div class="filters__info">
			<section class="filters__container">

				<p class="filters__name "><a class="filters__link <?php if ($_smarty_tpl->getValue('URL')[0] == 'phytodesign') {?>filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/phytodesign/"><?php echo $_smarty_tpl->getValue('LINGVO')['phytodesign'];?>
</a></p>
				<ul class="filters__list">
					<li class="filters__item">
						<a class="filters__link<?php if ($_smarty_tpl->getValue('URL')[1] == 'phytodesign-kvartiri') {?> filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/phytodesign-kvartiri/"><?php echo $_smarty_tpl->getValue('LINGVO')['phytodesign_kvartiri'];?>
</a>
					</li>

					<li class="filters__item">
						<a class="filters__link<?php if ($_smarty_tpl->getValue('URL')[1] == 'phytodesign-ofisa') {?> filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/phytodesign-ofisa/"><?php echo $_smarty_tpl->getValue('LINGVO')['phytodesign_ofisa'];?>
</a>
					</li>
				</ul>
			
			</section>

			<section class="filters__container">

				<p class="filters__name"><a class="filters__link<?php if ($_smarty_tpl->getValue('URL')[1] == 'vertikalnoe-ozelenenie') {?> filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/vertikalnoe-ozelenenie/"><?php echo $_smarty_tpl->getValue('LINGVO')['vertikalnoe_ozelenenie'];?>
</a></p>
				<ul class="filters__list">
					<li class="filters__item">
						<a class="filters__link<?php if ($_smarty_tpl->getValue('URL')[1] == 'green-wall') {?> filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/green-wall/"><?php echo $_smarty_tpl->getValue('LINGVO')['green_wall'];?>
</a>
					</li>
					<li class="filters__item">
						<a class="filters__link<?php if ($_smarty_tpl->getValue('URL')[1] == 'vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami') {?> filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami/"><?php echo $_smarty_tpl->getValue('LINGVO')['metall_ozel'];?>
</a>
					</li>
					<li class="filters__item">
						<a class="filters__link <?php if ($_smarty_tpl->getValue('URL')[1] == 'ozelenenie-stabilizirovannim-mhom') {?> filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/ozelenenie-stabilizirovannim-mhom/"><?php echo $_smarty_tpl->getValue('LINGVO')['ozelenenie_moss'];?>
</a>
					</li>
				</ul>

			</section>

			<section class="filters__container">
				<p class="filters__name"><a class="filters__link<?php if ($_smarty_tpl->getValue('URL')[1] == 'ozelenenie_letney_ploschadki') {?> filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/ozelenenie_letney_ploschadki/"><?php echo $_smarty_tpl->getValue('LINGVO')['ozelenenie_terras'];?>
</a></p>
			</section>

			<section class="filters__container">
				<p class="filters__name"><a class="filters__link<?php if ($_smarty_tpl->getValue('URL')[1] == 'peregorodki-iz-rasteniy') {?> filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/peregorodki-iz-rasteniy/"><?php echo $_smarty_tpl->getValue('LINGVO')['zonirovanie'];?>
</a></p>
			</section>
			
			<section class="filters__container">
				<p class="filters__name"><a class="filters__link<?php if ($_smarty_tpl->getValue('URL')[1] == 'ozelenenie-iskusstvennimi-rasteniyami') {?> filters__link_active<?php }?>" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/ozelenenie-iskusstvennimi-rasteniyami/"><?php echo $_smarty_tpl->getValue('LINGVO')['ozelenenie_iskusstvennimi_rasteniyami'];?>
</a></p>
			</section>
		</div>

	<!-- links_block -->

<?php } else { ?>


	<?php if ($_smarty_tpl->getValue('FILTERS')) {?>

				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('FILTERS'), 'F');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('F')->value) {
$foreach1DoElse = false;
?>

						<section class="filters__container">

							<p class="filters__name"><?php echo $_smarty_tpl->getValue('F')['groupName'];?>
</p>
							
							<ul class="filters__list">

								<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('F')['sub_filters'], 'SUBF');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('SUBF')->value) {
$foreach2DoElse = false;
?>

									<?php if ($_smarty_tpl->getValue('SUBF')['cnt'] == 0 || $_smarty_tpl->getValue('SUBF')['disable'] == 1 && $_smarty_tpl->getValue('SUBF')['act'] != 1) {?>
										<li class="filters__item">
											<span class="filters__link namedisabled"><?php echo $_smarty_tpl->getValue('SUBF')['gfName'];?>
 <?php if ($_smarty_tpl->getValue('SUBF')['cnt']) {?>(<?php echo $_smarty_tpl->getValue('SUBF')['cnt'];?>
)<?php }?></span>
										</li>
									<?php } else { ?>
										<li class="filters__item">

											<?php if ($_smarty_tpl->getValue('CATEGORY_ID') == '80' || $_smarty_tpl->getValue('FROM_GOODS') == 1) {?>
												
												<a class="filters__link" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/<?php echo $_smarty_tpl->getValue('URL')[0];?>
/<?php echo $_smarty_tpl->getValue('URL')[1];?>
/<?php echo $_smarty_tpl->getValue('SUBF')['link'];
echo $_smarty_tpl->getValue('SUBF')['need_slash'];?>
"<?php if ($_smarty_tpl->getValue('SUBF')['act'] == 1) {?> class="active"<?php }?>><?php echo $_smarty_tpl->getValue('SUBF')['gfName'];
if ($_smarty_tpl->getValue('SUBF')['act'] != 1) {?> (<?php echo $_smarty_tpl->getValue('SUBF')['cnt'];?>
) <?php }
if ($_smarty_tpl->getValue('SUBF')['act'] == 1) {?><span class="delfilter">&nbsp;&#10060;</span><?php }?></a>

											<?php } else { ?>
										
												<a class="filters__link" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/<?php echo $_smarty_tpl->getValue('URL')[0];?>
/<?php echo $_smarty_tpl->getValue('SUBF')['link'];
echo $_smarty_tpl->getValue('SUBF')['need_slash'];?>
"<?php if ($_smarty_tpl->getValue('SUBF')['act'] == 1) {?> class="active"<?php }?>><?php echo $_smarty_tpl->getValue('SUBF')['gfName'];
if ($_smarty_tpl->getValue('SUBF')['act'] != 1) {?> (<?php echo $_smarty_tpl->getValue('SUBF')['cnt'];?>
) <?php }
if ($_smarty_tpl->getValue('SUBF')['act'] == 1) {?><span class="delfilter">&nbsp;&#10060;</span><?php }?></a>

											<?php }?>
											
											<?php if ($_smarty_tpl->getValue('SUBF')['act'] == 1) {?> <!--dg_selected_filter_title:<?php echo $_smarty_tpl->getValue('F')['groupName'];?>
;;dg_selected_filter_name:<?php echo $_smarty_tpl->getValue('SUBF')['gfName'];?>
--> <?php }?>
										</li>
									<?php }?>

								<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
							</ul>
						</section>

				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>


				<?php if ($_smarty_tpl->getValue('DEPT') !== 'florist') {?>
				

				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('CATEGORY_LEFT'), 'C', false, 'I', 'C', array (
));
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('I')->value => $_smarty_tpl->getVariable('C')->value) {
$foreach3DoElse = false;
?>
			
					<?php if ($_smarty_tpl->getValue('C')['ID'] == 25) {?>
						<?php continue 1;?>
					<?php }?>

					
					<section class="filters__container">
						<span class="filters__name"><?php if (($_smarty_tpl->getValue('URL')[0] == 'komnatnie-rasteniya' && $_smarty_tpl->getValue('C')['alias'] == 'komnatnie-rasteniya')) {
echo $_smarty_tpl->getValue('LINGVO')['kind_plant'];
} else {
echo $_smarty_tpl->getValue('C')['name'];
}?></span>

						<ul class="filters__list">

						<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('C')['category'], 'CC', false, NULL, 'CC', array (
));
$foreach4DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('CC')->value) {
$foreach4DoElse = false;
?>
								<li class="filters__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/<?php echo $_smarty_tpl->getValue('C')['alias'];?>
/<?php echo $_smarty_tpl->getValue('CC')['cur_alias'];?>
/" class="filters__link <?php if ($_smarty_tpl->getValue('CUR_CAT') == $_smarty_tpl->getValue('CC')['cur_alias']) {?>filters__link_active<?php }?>"><?php echo $_smarty_tpl->getValue('CC')['name'];?>
</a></li>
						<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
						
						</ul>

					</section>

				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

				<?php }?>

	<?php } else { ?>

	<?php if ($_smarty_tpl->getValue('HIDE_LEFT_COL') != 'HIDE') {?>

			<div class="filters__info noline">

			<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('CATEGORY_LEFT'), 'C', false, 'I', 'C', array (
));
$foreach5DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('I')->value => $_smarty_tpl->getVariable('C')->value) {
$foreach5DoElse = false;
?>

				<?php if ($_smarty_tpl->getValue('C')['ID'] == 25) {?>
					<?php continue 1;?>
				<?php }?>
				
					<section class="filters__container<?php if ($_smarty_tpl->getValue('URL')[0] == 'planters') {?> first<?php }?>">
						<p class="filters__name"><?php echo $_smarty_tpl->getValue('C')['name'];?>
</p>

						<ul class="filters__list">
							<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('C')['category'], 'CC', false, NULL, 'CC', array (
));
$foreach6DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('CC')->value) {
$foreach6DoElse = false;
?>
								<li class="filters__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/<?php echo $_smarty_tpl->getValue('C')['alias'];?>
/<?php echo $_smarty_tpl->getValue('CC')['cur_alias'];?>
/" class="filters__link<?php if ($_smarty_tpl->getValue('CUR_CAT') == $_smarty_tpl->getValue('CC')['cur_alias']) {?> filters__link_active<?php }?>"><?php echo $_smarty_tpl->getValue('CC')['name'];?>
</a></li>
							<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
						</ul>
					</section>
				
			<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

			</div>

	<?php }?>

	<!-- links_block -->
	
	<?php }?>

<?php }?>

	</div>
</div>



<?php if ($_smarty_tpl->getValue('SEO_TEXT') != '') {?>
	<div class="left_text">
		<?php echo nl2br((string) $_smarty_tpl->getValue('SEO_TEXT'), (bool) 1);?>

	</div>
<?php }?>










<?php }
}
