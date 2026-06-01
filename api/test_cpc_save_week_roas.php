<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/database.php');

$ym = $_POST['ym'];
$yw = $_POST['yw'];
$cost = (float)$_POST['ad_cost'];

$db->query("
    INSERT INTO crm_campaign_week_totals (ym, yw, ad_cost)
    VALUES ('$ym', '$yw', $cost)
    ON DUPLICATE KEY UPDATE ad_cost = $cost
");