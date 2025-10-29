<?php
/* Smarty version 5.5.2, created on 2025-09-23 10:39:43
  from 'file:services.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68d24ebf49d467_82857825',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0bac0acb071586e0ebaec6479de033c637459221' => 
    array (
      0 => 'services.tpl',
      1 => 1708941577,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68d24ebf49d467_82857825 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/floren.com.ua/templates';
echo '<script'; ?>
 type="application/ld+json">
{
"@context": "http://schema.org",
"@type": "Offer",
"availability": "http://schema.org/InStock",
"itemOffered": "Service",
"name": "<?php echo $_smarty_tpl->getValue('SERVICE')['meta_title'];?>
",
"description": "<?php echo $_smarty_tpl->getValue('SERVICE')['meta_description'];?>
",
"url": "https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/<?php echo $_smarty_tpl->getValue('URL')[1];?>
/", 
"price": "<?php echo $_smarty_tpl->getValue('SERVICE')['schema_price'];?>
",
"priceCurrency": "UAH"
}
<?php echo '</script'; ?>
>



<?php if ((true && (true && null !== ($_smarty_tpl->getValue('URL')[2] ?? null))) && $_smarty_tpl->getValue('URL')[2] == 'cb') {?>
	<?php echo '<script'; ?>
>show_popup('call_back_general', 'Обратная связь', 'hotlink')<?php echo '</script'; ?>
>
<?php }?>
<div>
<!--seoshield_formulas--uslugi-->
	<h1><?php echo $_smarty_tpl->getValue('SERVICE')['title'];?>
</h1>
	<div class="article_body" style="margin:0;"><?php echo $_smarty_tpl->getValue('SERVICE')['body'];?>
</div>

<p>&nbsp;</p>
<div class="row margT20">
	<h2><?php echo $_smarty_tpl->getValue('LINGVO')['title_care_feedback'];?>
</h2>
			<div class="col-md-7">
			
				<?php if ($_smarty_tpl->getValue('GOOD_FEEDBACK')) {?>
				<div class="row" style="margin-bottom:20px;">
					<div class="feed-back-comments">
						<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GOOD_FEEDBACK'), 'COMM');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('COMM')->value) {
$foreach0DoElse = false;
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
				<?php }?> 			</div> 		    <div class="vote-holder pull-right col-md-5">
				<div class="box box-Lgreen-fill">
				<i class="t1"></i><i class="t2"></i>
					<div class="box-content box-content-p15" id="comments">
					<?php if ($_SESSION['good_comment'] == $_smarty_tpl->getValue('PAGETYPE_SESSNAME')) {?>
						<h3><?php echo $_smarty_tpl->getValue('LINGVO')['your_rewie_added'];?>
</h3>
					<?php } else { ?>
						<div class="h3"><?php echo $_smarty_tpl->getValue('LINGVO')['rewie_or_quastion'];?>
</div>
						<form method="post" action="" onsubmit="return check_form_blog_comment_add(this);">
	  						<input type="hidden" name="pageID" value="<?php echo $_smarty_tpl->getValue('SERVICE')['ID'];?>
">
	  						<input type="hidden" name="pageType" value="service">
							<p>
								<?php echo $_smarty_tpl->getValue('LINGVO')['fb_name_false'];?>
:<b class="redstar">*</b><br />
								<span class="error_block" id="error_n_good_comment_name"><?php echo $_smarty_tpl->getValue('LINGVO')['fb_name_false'];?>
<br /></span>
								<input type="Text" name="n_good_comment_name" class="inp-ins" style="">
							</p>
							<p>
								<?php echo $_smarty_tpl->getValue('LINGVO')['fb_phone'];?>
:<b class="redstar">*</b><br />
								<span class="error_block" id="error_n_good_comment_email"><?php echo $_smarty_tpl->getValue('LINGVO')['fb_phone'];?>
<br /></span>
								<input type="Text" name="n_good_comment_email" class="inp-ins" style="">
							</p>
							<p>
								<?php echo $_smarty_tpl->getValue('LINGVO')['fb_stars'];?>
:<br />
								<input type="Hidden" id="starsChosed" name="vote" value="5" />
								<input type="Hidden" id="starsClicked" name="starsClicked1" value="0" />
									<ul class="holder" id="stars" style="background-position: 0px -105px;">
										<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('SERVICE')['ID'];?>
,1);" title="1">1</li>
										<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('SERVICE')['ID'];?>
,2);" title="2">2</li>
										<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('SERVICE')['ID'];?>
,3);" title="3">3</li>
										<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('SERVICE')['ID'];?>
,4);" title="4">4</li>
										<li onmouseover="stars_over(this)" onmouseout="stars_out()" onclick="voting(<?php echo $_smarty_tpl->getValue('SERVICE')['ID'];?>
,5);" title="5">5</li>
									</ul>
							</p>
							<p>
								Комментарий:<b class="redstar">*</b><br />
								<span class="error_block" id="error_n_good_message"><?php echo $_smarty_tpl->getValue('LINGVO')['fb_comment'];?>
<br /></span>
	                			<textarea name="n_good_message" class="inp-ins" style="height:70px;"></textarea>
							</p>
	            			<div align="right" style="padding-top:5px;">
								<input type="submit" name="n_comment_add" value="<?php echo $_smarty_tpl->getValue('LINGVO')['send'];?>
" class="inp-but" />
							</div>
						</form>
					<?php }?>
					</div>
				<i class="t2"></i><i class="t1"></i>
				</div>
			</div></div> 
</div><?php }
}
