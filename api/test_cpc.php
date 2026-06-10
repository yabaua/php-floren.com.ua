<?php
header("content-type: text/html; charset=utf-8");
require_once($_SERVER['DOCUMENT_ROOT'].'/database.php');

function formatMonth($ym) {

    $months = [
        '01' => 'Січень',
        '02' => 'Лютий',
        '03' => 'Березень',
        '04' => 'Квітень',
        '05' => 'Травень',
        '06' => 'Червень',
        '07' => 'Липень',
        '08' => 'Серпень',
        '09' => 'Вересень',
        '10' => 'Жовтень',
        '11' => 'Листопад',
        '12' => 'Грудень'
    ];

    [$year, $month] = explode('-', $ym);

    return $months[$month] . ' ' . $year;
}

function formatWeekRange($yw) {

    [$year, $week] = explode('-', $yw);

    $dto = new DateTime();
    $dto->setISODate((int)$year, (int)$week);

    $start = clone $dto;
    $end = clone $dto;

    $end->modify('+6 days');

    return $start->format('d.m') . ' - ' . $end->format('d.m');
}

function calcRoas($sum, $cost) {
    return $cost > 0 ? round(($sum / $cost) * 100) : 0;
}

function getMonthFromWeek($yw) {
    [$year, $week] = explode('-', $yw);

    $dto = new DateTime();
    $dto->setISODate((int)$year, (int)$week);

    return $dto->format('Y-m');
}

$sql = "
SELECT
    t.yw,
    t.utm_campaign,
    t.orders_count,
    t.orders_sum,
    COALESCE(r.ad_cost, 0) AS ad_cost,
    COALESCE(r.roas, 0) AS roas

FROM (
    SELECT
        DATE_FORMAT(FROM_UNIXTIME(orderDate), '%x-%v') AS yw,
        utm_campaign,
        COUNT(*) AS orders_count,
        SUM(orderTotal) AS orders_sum
    FROM orders_crm
    WHERE utm_medium = 'cpc' AND orderResult != 'failed'
    GROUP BY yw, utm_campaign
) t

LEFT JOIN crm_campaign_week_stats r
    ON r.yw = t.yw
   AND r.utm_campaign = t.utm_campaign

ORDER BY t.yw DESC;
";

$result = $db->query($sql);

$data = [];
$months = [];
$weeksByMonth = [];
$campaignsByMonth = [];

$weekTotals = [];

$res2 = $db->query("
    SELECT ym, yw, ad_cost
    FROM crm_campaign_week_totals
", 1);

while ($row2 = $db->fetch(1)) {
    $weekTotals[$row2['ym']][$row2['yw']] = $row2['ad_cost'];
}

$campaignRevenueByMonth = [];

while ($row = $db->fetch()) {

    $yw = $row['yw'];
		$ym = getMonthFromWeek($yw);
    $camp = $row['utm_campaign'];
    
    $campaignRevenueByMonth[$ym][$camp] =
    ($campaignRevenueByMonth[$ym][$camp] ?? 0) + $row['orders_sum'];

    $months[$ym] = true;
    $weeksByMonth[$ym][$yw] = true;
    $campaignsByMonth[$ym][$camp] = true;

    $data[$ym][$camp][$yw] = [
		    'orders_sum' => $row['orders_sum'],
		    'orders_count' => $row['orders_count'],
		    'ad_cost' => $row['ad_cost'],
		    'roas' => $row['roas']
		];
}

$months = array_keys($months);
rsort($months);

foreach ($campaignRevenueByMonth as $ym => $campaigns) {

    arsort($campaigns); // DESC по выручке

    $campaignsByMonth[$ym] = $campaigns;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>ROAS Matrix</title>

<style>
body{font-family:Arial;background:#f5f5f5;padding:20px;}
.month-block{background:#fff;margin-bottom:30px;padding:20px;border-radius:10px;overflow-x:auto;}
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #ddd;padding:8px;vertical-align:top;min-width:140px;}
th{background:#eee;position:sticky;top:0;}
input{width:100px;padding:4px;}
.roas{font-weight:bold;margin-top:4px;}
.small{font-size:12px;color:#666;}
.cell-empty {
    color: #bbb;
    background: #fafafa;
}

.roas-bad {
    background: #ffe5e5;
    color: #b30000;
}

.roas-good {
    background: #e6ffed;
    color: #0a7a2f;
}

.roas-neutral {
    background: #fff;
}
</style>
</head>

<body>

<h1>ROAS Matrix (Month → Week)</h1>

<?php foreach ($months as $ym): ?>

<div class="month-block">
<h2><?= formatMonth($ym) ?></h2>

<table>

<tr>
    <th>Campaign</th>

    <?php foreach (array_keys($weeksByMonth[$ym] ?? []) as $yw): ?>
        <th><?= formatWeekRange($yw) ?></th>
    <?php endforeach; ?>

</tr>

<?php foreach ($campaignsByMonth[$ym] ?? [] as $camp => $_): ?>

<tr>
    <td><?= htmlspecialchars($camp) ?></td>

    <?php foreach (array_keys($weeksByMonth[$ym] ?? []) as $yw):

        $cell = $data[$ym][$camp][$yw] ?? null;
        $sum = $cell['orders_sum'] ?? 0;
        $savedCost = $cell['ad_cost'] ?? 0;
				$roas = $cell['roas'] ?? ($savedCost > 0 ? round(($sum / $savedCost) * 100) : 0);
				
				$isEmpty = ($sum == 0 && $savedCost == 0);
				$isBad = (!$isEmpty && $savedCost > 0 && $sum == 0);
				$isGood = ($roas > 500);
    ?>


		<td
		    class="<?=
		        $isEmpty ? 'cell-empty' : (
		        $isGood ? 'roas-good' : (
		        $isBad ? 'roas-bad' : 'roas-neutral'
		        ))
		    ?>"
		>
        <div><?= number_format((float)$sum, 2, '.', ' ') ?></div>

        <input
            type="number"
            step="0.01"
            class="ad-cost"
            value="<?= $savedCost > 0 ? $savedCost : '' ?>"
            data-ym="<?= $ym ?>"
            data-yw="<?= $yw ?>"
            data-campaign="<?= htmlspecialchars($camp) ?>"
        >

        <div class="roas"><?= (int)$roas ?></div>
    </td>

    <?php endforeach; ?>

</tr>

<?php endforeach; ?>

<tr style="background:#f3f3f3;font-weight:bold;">
    <td>TOTAL REVENUE</td>

    <?php foreach (array_keys($weeksByMonth[$ym] ?? []) as $yw):

        $weekSum = 0;

        foreach ($campaignsByMonth[$ym] ?? [] as $camp => $_) {

            $cell = $data[$ym][$camp][$yw] ?? null;

            if ($cell) {
                $weekSum += $cell['orders_sum'];
            }
        }
    ?>

    <td><?= number_format($weekSum, 2, '.', ' ') ?></td>

    <?php endforeach; ?>
</tr>

<tr style="background:#e6e6e6;font-weight:bold;">
    <td>WEEK COST</td>

    <?php foreach (array_keys($weeksByMonth[$ym] ?? []) as $yw): ?>

    <td>
        <input
            type="number"
            step="0.01"
            class="week-cost"
            value="<?= $weekTotals[$ym][$yw] ?? 0 ?>"
            data-ym="<?= $ym ?>"
            data-yw="<?= $yw ?>"
        >
    </td>

    <?php endforeach; ?>
</tr>

<tr style="background:#d9d9d9;font-weight:bold;">
    <td>WEEK ROAS</td>

    <?php foreach (array_keys($weeksByMonth[$ym] ?? []) as $yw):

        $weekSum = 0;

        foreach ($campaignsByMonth[$ym] ?? [] as $camp => $_) {
            $cell = $data[$ym][$camp][$yw] ?? null;
            $weekSum += $cell['orders_sum'] ?? 0;
        }

        $weekCost = $weekTotals[$ym][$yw] ?? 0;
        $weekRoas = $weekCost > 0 ? round(($weekSum / $weekCost) * 100) : 0;
    ?>

    <td><?= $weekRoas ?>%</td>

    <?php endforeach; ?>
</tr>

</table>

<?php
$monthSum = 0;
$monthCost = 0;

foreach (array_keys($weeksByMonth[$ym] ?? []) as $yw) {

    foreach ($campaignsByMonth[$ym] ?? [] as $camp => $_) {

        $cell = $data[$ym][$camp][$yw] ?? null;

        $monthSum += $cell['orders_sum'] ?? 0;
    }

    $monthCost += $weekTotals[$ym][$yw] ?? 0;
}

$monthRoas = calcRoas($monthSum, $monthCost);

?>

<div style="margin-top:10px;padding:10px;background:#eee;border-radius:8px;font-weight:bold;">
    MONTH TOTAL:
    <?= number_format($monthSum, 2, '.', ' ') ?> |
    Cost: <?= number_format($monthCost, 2, '.', ' ') ?> |
    ROAS: <?= $monthRoas ?>%
</div>

</div>

<?php endforeach; ?>

<script>
document.querySelectorAll('.ad-cost').forEach(input => {

    let timer;

    input.addEventListener('keyup', function () {

        const td = this.closest('td');

        const sumText = td.querySelector('div').innerText || '0';
        const sum = parseFloat(sumText.replace(/\s/g, ''));

        const cost = parseFloat(this.value || 0);

        const roas = cost > 0 ? Math.round((sum / cost) * 100) : 0;

        td.querySelector('.roas').innerText = roas + '%';

        clearTimeout(timer);

        timer = setTimeout(async () => {

            const formData = new FormData();
            formData.append('ym', this.dataset.ym);
            formData.append('yw', this.dataset.yw);
            formData.append('utm_campaign', this.dataset.campaign);
            formData.append('ad_cost', this.value);
            formData.append('roas', roas);

            await fetch('test_cpc_save_roas.php', {
                method: 'POST',
                body: formData
            });

        }, 500);
    });

});
document.querySelectorAll('.week-cost').forEach(input => {

    let timer;

    input.addEventListener('keyup', function () {

        clearTimeout(timer);

        timer = setTimeout(async () => {

            const formData = new FormData();
            formData.append('ym', this.dataset.ym);
            formData.append('yw', this.dataset.yw);
            formData.append('ad_cost', this.value);

            await fetch('test_cpc_save_week_roas.php', {
                method: 'POST',
                body: formData
            });

        }, 500);

    });

});

</script>

</body>
</html>