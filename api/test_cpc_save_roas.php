<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/database.php');

$ym = $_POST['ym'] ?? '';
$yw = $_POST['yw'] ?? '';
$campaign = $_POST['utm_campaign'] ?? '';
$ad_cost = (float)($_POST['ad_cost'] ?? 0);
$roas = (float)($_POST['roas'] ?? 0);

if (!$ym || !$yw || !$campaign) {
    exit('missing data');
}

$db->query("
INSERT INTO crm_campaign_week_stats (ym, yw, utm_campaign, ad_cost, roas)
VALUES (
    '".$ym."',
    '".$yw."',
    '".$campaign."',
    $ad_cost,
    $roas
)
ON DUPLICATE KEY UPDATE
ad_cost = VALUES(ad_cost),
roas = VALUES(roas)
");

echo "OK";