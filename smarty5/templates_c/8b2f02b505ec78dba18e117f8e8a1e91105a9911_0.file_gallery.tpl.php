<?php
/* Smarty version 5.5.2, created on 2025-09-23 10:39:48
  from 'file:gallery.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68d24ec4330f26_77959164',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b2f02b505ec78dba18e117f8e8a1e91105a9911' => 
    array (
      0 => 'gallery.tpl',
      1 => 1672674362,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68d24ec4330f26_77959164 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/floren.com.ua/templates';
?><div>
<h1>�������</h1>

<div class="article_body">
<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?>
	<p>���������� �������� �������� ���� ������ �������. ��������� ������� ������� ������� �� ���� ���������. ��������� ��������� �������� �����, � ����� �����������, ��� ���� ������ ������ ����. ������� ������ ���� ������� � ����������� ������ ���� �������. ��������� �����������, �� ���� ����� ���� ������� � ����� ��� ����������� �������.</p>
<?php } else { ?>
	<p>���������� �������� ������������ ���������� �������. ���������� ��������� �������� � ����������� �� ������� ���������. ������ ��������� ������������� �����, � ����� �����������, ����� ������� ����� ������ �����. �������� ������ ���� �������� � ����������� ������� ���� ����������. ���������� �������������, ��� ����� ����� ���� �������� �� �������� ��� ����������������� �����.</p>
<?php }?>
</div>

<ul class="photogallery">
	<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GALLERY1'), 'G', false, NULL, 'G', array (
));
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('G')->value) {
$foreach0DoElse = false;
?>
	<li class="photogallery__item">
		<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gallery/<?php echo $_smarty_tpl->getValue('G')['alias'];?>
/" style="background:url('/images/gallery/start_objects/<?php echo $_smarty_tpl->getValue('G')['alias'];?>
.jpg') no-repeat 0 0" class="photogallery__link">
			<p><?php echo $_smarty_tpl->getValue('G')['galleryName'];?>
</p>
		</a>
	</li>
	<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</ul>
<p>&nbsp;</p>
<div class="article_body">
<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?>
	<h2>���������� ��������� ������� �� ������� � ���� ������</h2>
	<p>������� � �� ����������� ����� ������� ����-���� �����'�� ���� ������� � ����������. ������� ��������� ����������� ��������� � �������� � ������� ���� �����������. ��������� ������ ����� � ��������� ���������, ���� � ������, ���������� � ����� ����, ���������� ����� � �� �� �������� ������� �� ������������ ������ �����'�� ����-��� ��������, �������, �����, ������, ��������� �� ��������.</p>
<?php } else { ?>
	<h2>������� ���������� � ���� ������</h2>
	<p>�������� � ��� ����� ������� ������ ������� ����� �������� ����� ������� � ����������. �������� ������� ������������� ����������� ��������� � ������ ��� �����������.  ��������������� ����������� ����� � ���������� ����������, ���� � �������, ���������� �� ����� ������, ���������� ���� - ��� ��� �������� ������ �� �������������� �������� �������� ����� ��������, ����, �����, ���������, ��������� ��� ��������.</p>
<?php }?>
</div>
<ul class="photogallery">
	<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('GALLERY2'), 'G', false, NULL, 'G', array (
));
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('G')->value) {
$foreach1DoElse = false;
?>
	<li class="photogallery__item">
		<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gallery/<?php echo $_smarty_tpl->getValue('G')['alias'];?>
/" style="background:url('/images/gallery/start_objects/<?php echo $_smarty_tpl->getValue('G')['alias'];?>
.jpg') no-repeat 0 0" class="photogallery__link">
			<p><?php echo $_smarty_tpl->getValue('G')['galleryName'];?>
</p>
		</a>
	</li>
	<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</ul>
<p>&nbsp;</p>
<div class="row" style="margin:20px auto">
<div class="col-md-1">&nbsp;</div>

<div class="col-md-5" style="padding-top:40px;">
<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?>
<p>��� ����������� ���� ������? ������� � ��� ������� ������� � ��� ������ ������ ������ ���������� ��'���� ��� �����������. �������� ������������� ���������������� ���. ����� �������� � �������: �����, �����, ����� �� �����.</p>
<?php } else { ?>
<p>��� ����������� ���� ������? �������� � ��� �������� ������� � ����� ����� ����� ������ �������� ����� ��� ������� �� ��������. ��������� ������������� ������������������ ���. ����� �������� � ��������: ������, �����, ������� � ������.</p>
<?php }?>
</div>

<div class="col-md-6"><a class="ozel_but" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/contacts/" onclick="show_popup('call_back_general', '�����������', 'Button Btn');return false;"><?php echo $_smarty_tpl->getValue('LINGVO')['order_consultation'];?>
!</a>

<p style="maring-top:5px;font-size:14px;clear:both;"><?php echo $_smarty_tpl->getValue('LINGVO')['also_call'];?>
:<br>
(044) 599-25-33<br>
(099) 238-26-44</p>
</div>
</div>
<p>&nbsp;</p>

</div><?php }
}
