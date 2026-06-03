<div class="holder menu_buttons">
	<?if($_SESSION['admin_lvl']=='top'){?>
	<a href="/report/report.php">За товарами</a>
	<a href="/report/report_crm.php">Угоди в CRM</a>
	<a href="/report/ruh_tovariv.php">Рух товарів</a>
	<?}?>
	<?if($_SESSION['admin_lvl']=='middle' || $_SESSION['admin_lvl']=='top'){?>
	<a href="/report/report_source.php">Джерело Угоди</a>
	<a href="/report/report_basket.php">Корзини на сайті</a>
	<?}?>
	<?if($_SESSION['admin_lvl']=='cpcoutsource' || $_SESSION['admin_lvl']=='middle' || $_SESSION['admin_lvl']=='top'){?>
	<a href="/report/report_crm_cpc.php">CPC Угоди</a>
	<?}?>
	<a href="?logout">Вихід</a>
</div>
<p>&nbsp;</p>