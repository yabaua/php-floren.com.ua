<?php
/* Smarty version 5.5.2, created on 2025-10-27 13:03:51
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68ff519725d4d4_19287225',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8535013e7d6ea6f7b677c2345f88e19b117d770' => 
    array (
      0 => 'index.tpl',
      1 => 1672674362,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68ff519725d4d4_19287225 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/floren.com.ua2/templates';
echo $_smarty_tpl->getValue('CONTENT');?>

<span class="headline"><?php echo $_smarty_tpl->getValue('LINGVO')['our_clients'];?>
</span>

<div class="main__slider">
	<div class="i-slider-logo-partners">&nbsp;</div>
</div>

<?php echo $_smarty_tpl->getValue('CONTENT2');?>



<style type="text/css">
.instagram-indx p{padding:2px 7px;font-size:12px;margin:0 !important;}
</style>

<p class="main__headline lastCasesArrows" style="position:relative;"><?php echo $_smarty_tpl->getValue('LINGVO')['last_photos'];?>
</p>
<div class="row instagram-indx" style="margin:20px 0 0 0;">
<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('LASTPHOTOS'), 'LPH', false, NULL, 'LPH', array (
));
$foreach4DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('LPH')->value) {
$foreach4DoElse = false;
?>
	<div class="instagram-item">
		<span href="/images/lastphotos/b/<?php echo $_smarty_tpl->getValue('LPH')['photo_url'];?>
" class="image" target="_blank" data-fancybox="indxGallery"><img src="/images/lastphotos/s/<?php echo $_smarty_tpl->getValue('LPH')['photo_url'];?>
" width="160" height="160" alt="<?php echo $_smarty_tpl->getValue('LPH')['photo_name'];?>
" /></span>
		<p>Дата: <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('LPH')['date_add'],"%d.%m.%Y");?>
</p>
		<p><?php echo $_smarty_tpl->getValue('LPH')['photo_dsc'];?>
</p>
	</div>
<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
	<div class="instagram-item">
		<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gallery/" class="image"><div style="width:160px;height:160px;padding-top:80px;text-align:center;"><?php echo $_smarty_tpl->getValue('LINGVO')['show_more'];?>
 ...</div></a>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</div>
</div>

<p>&nbsp;</p>

<?php echo $_smarty_tpl->getValue('CONTENT3');?>


<p>&nbsp;</p>
<?php }
}
