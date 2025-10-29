<?php
/* Smarty version 5.5.2, created on 2025-10-29 19:15:19
  from 'file:nav_catalog.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_69024ba73492c9_55762680',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae5f79031894ac883c65459fa9db4122d6c0cba0' => 
    array (
      0 => 'nav_catalog.tpl',
      1 => 1761758116,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69024ba73492c9_55762680 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/php-floren.com.ua/templates';
?><aside class="catalog-page__nav">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('CATEGORY_LEFT'), 'C', false, 'I', 'C', array (
));
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('I')->value => $_smarty_tpl->getVariable('C')->value) {
$foreach0DoElse = false;
?>

		<?php if ($_smarty_tpl->getValue('C')['ID'] == 25) {?>
			<?php continue 1;?>
		<?php }?>
		
			<section class="catalog-page__nav_section">
                <h3><?php echo $_smarty_tpl->getValue('C')['name'];?>
</h3>
				<ul>
					<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('C')['category'], 'CC', false, NULL, 'CC', array (
));
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('CC')->value) {
$foreach1DoElse = false;
?>
					<li<?php if ($_smarty_tpl->getValue('CUR_CAT') == $_smarty_tpl->getValue('CC')['cur_alias']) {?> class="active"<?php }?>>
						<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/<?php echo $_smarty_tpl->getValue('C')['alias'];?>
/<?php echo $_smarty_tpl->getValue('CC')['cur_alias'];?>
/" class="underline"><?php echo $_smarty_tpl->getValue('CC')['name'];?>
</a>
					</li>
					<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
				</ul>
			</section>
		
	<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</aside><?php }
}
