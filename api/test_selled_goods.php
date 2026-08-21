<?php
header('Content-Type: text/html; charset=utf-8');

require_once($_SERVER['DOCUMENT_ROOT'] . '/database.php');

// =========================
// СОРТУВАННЯ
// =========================
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'sum';
$dir  = isset($_GET['dir']) ? strtolower($_GET['dir']) : 'desc';

$allowedSort = array(
    'name'  => 'g.name',
    'price' => 'sold_price',
    'sum'   => 'sold_sum'
);

if (!isset($allowedSort[$sort])) {
    $sort = 'sum';
}

if ($dir !== 'asc' && $dir !== 'desc') {
    $dir = 'desc';
}

$orderBy = $allowedSort[$sort] . ' ' . strtoupper($dir);

function sortUrl($column, $currentSort, $currentDir) {
    if ($currentSort === $column) {
        $newDir = ($currentDir === 'asc') ? 'desc' : 'asc';
    } else {
        $newDir = ($column === 'name') ? 'asc' : 'desc';
    }

    return '?sort=' . urlencode($column) . '&dir=' . urlencode($newDir);
}

function sortArrow($column, $currentSort, $currentDir) {
    if ($currentSort !== $column) {
        return '';
    }

    return ($currentDir === 'asc') ? ' ↑' : ' ↓';
}

// =========================
// ОСТАННІЙ МІСЯЦЬ ПРОДАЖІВ
// =========================
$db->query("
    SELECT
        report_year,
        report_month
    FROM report_goods
    WHERE qt > 0
    ORDER BY
        CAST(report_year AS UNSIGNED) DESC,
        CAST(report_month AS UNSIGNED) DESC
    LIMIT 1
");

$lastReport = $db->fetch();

$report_year  = isset($lastReport['report_year']) ? $lastReport['report_year'] : '';
$report_month = isset($lastReport['report_month']) ? $lastReport['report_month'] : '';

$rows = array();
$totalQt = 0;
$totalSum = 0;

// =========================
// ПРОДАЖІ
// =========================
if ($report_year !== '' && $report_month !== '') {
    $sql = "
        SELECT
            gf.ID AS formID,
            g.ID AS goodID,
            g.name,
            g.link,
            gf.dia,
            gf.hgt,
            gf.color,
            SUM(rg.qt) AS sold_qt,
            SUM(rg.gross) AS sold_sum,
            CASE
                WHEN SUM(rg.qt) > 0 THEN SUM(rg.gross) / SUM(rg.qt)
                ELSE 0
            END AS sold_price
        FROM report_goods rg
        INNER JOIN goods_forms2_1c gf1c
            ON gf1c.barcode = rg.barcode
        INNER JOIN goods_forms gf
            ON gf.ID = gf1c.fID
        INNER JOIN goods_ua g
            ON g.ID = gf.goodID
        WHERE
            rg.report_year = '".$db->escape($report_year)."'
            AND rg.report_month = '".$db->escape($report_month)."'
            AND rg.qt > 0
        GROUP BY
            gf.ID,
            g.ID,
            g.name,
            g.link,
            gf.dia,
            gf.hgt,
            gf.color
        ORDER BY ".$orderBy."
    ";

    $db->query($sql);

    while ($rs = $db->fetch()) {
        $rows[] = $rs;
        $totalQt += (int)$rs['sold_qt'];
        $totalSum += (float)$rs['sold_sum'];
    }
}

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Продажі товарів за останній місяць</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 24px;
            font-family: Arial, Helvetica, sans-serif;
            background: #f6f7f9;
            color: #222;
        }

        .page {
            max-width: 1400px;
            margin: 0 auto;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 18px;
        }

        h1 {
            margin: 0 0 6px;
            font-size: 28px;
        }

        .period {
            color: #666;
            font-size: 14px;
        }

        .summary {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .summary-item {
            background: #fff;
            border: 1px solid #e2e5e9;
            border-radius: 10px;
            padding: 10px 14px;
            min-width: 140px;
        }

        .summary-item span {
            display: block;
            font-size: 12px;
            color: #777;
            margin-bottom: 4px;
        }

        .summary-item b {
            font-size: 18px;
        }

        .table-wrap {
            background: #fff;
            border: 1px solid #e2e5e9;
            border-radius: 12px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th,
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #eceff2;
            text-align: left;
            vertical-align: middle;
            font-size: 14px;
        }

        th {
            background: #f3f5f7;
            font-weight: 600;
            white-space: nowrap;
        }

        th a {
            color: #222;
            text-decoration: none;
            display: block;
        }

        th a:hover {
            color: #1f5fbf;
            text-decoration: none;
        }

        th.sort-active {
            background: #e8edf3;
        }

        tbody tr:hover {
            background: #fafbfc;
        }

        td.num,
        th.num {
            text-align: right;
            white-space: nowrap;
        }

        th.num a {
            text-align: right;
        }

        .name {
            min-width: 320px;
        }

        .meta {
            margin-top: 4px;
            font-size: 12px;
            color: #777;
        }

        td a {
            color: #1f5fbf;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        tfoot td {
            font-weight: 700;
            background: #fafafa;
        }

        .empty {
            padding: 30px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>

<div class="page">

    <div class="top">
        <div>
            <h1>Продажі товарів за останній місяць</h1>

            <div class="period">
                <?php if ($report_year !== '' && $report_month !== '') { ?>
                    Період: <?=h($report_month)?>.<?=h($report_year)?>
                <?php } else { ?>
                    Немає даних про продажі
                <?php } ?>
            </div>
        </div>

        <div class="summary">
            <div class="summary-item">
                <span>Кількість</span>
                <b><?=number_format($totalQt, 0, '.', ' ')?></b>
            </div>

            <div class="summary-item">
                <span>Сума</span>
                <b><?=number_format($totalSum, 2, '.', ' ')?> грн</b>
            </div>
        </div>
    </div>

    <?php if (count($rows)) { ?>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Form ID</th>

                        <th class="name <?=$sort === 'name' ? 'sort-active' : ''?>">
                            <a href="<?=sortUrl('name', $sort, $dir)?>">
                                Назва<?=sortArrow('name', $sort, $dir)?>
                            </a>
                        </th>

                        <th>Посилання</th>

                        <th class="num">
                            Кількість
                        </th>

                        <th class="num <?=$sort === 'price' ? 'sort-active' : ''?>">
                            <a href="<?=sortUrl('price', $sort, $dir)?>">
                                Ціна<?=sortArrow('price', $sort, $dir)?>
                            </a>
                        </th>

                        <th class="num <?=$sort === 'sum' ? 'sort-active' : ''?>">
                            <a href="<?=sortUrl('sum', $sort, $dir)?>">
                                Сума<?=sortArrow('sum', $sort, $dir)?>
                            </a>
                        </th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($rows as $rs) {

                    $url = 'https://floren.com.ua/product/'
                         . $rs['goodID']
                         . '_'
                         . $rs['link']
                         . '/'
                         . $rs['formID']
                         . '/';

                    $params = array();

                    if ($rs['dia'] !== '' && $rs['dia'] !== '0') {
                        $params[] = 'Ø ' . $rs['dia'];
                    }

                    if ($rs['hgt'] !== '' && $rs['hgt'] !== '0') {
                        $params[] = 'H ' . $rs['hgt'];
                    }

                    if ($rs['color'] !== '' && $rs['color'] !== '0') {
                        $params[] = $rs['color'];
                    }
                ?>

                    <tr>
                        <td><?=h($rs['goodID'])?></td>

                        <td><?=h($rs['formID'])?></td>

                        <td class="name">
                            <strong><?=h($rs['name'])?></strong>

                            <?php if (count($params)) { ?>
                                <div class="meta">
                                    <?=h(implode(' / ', $params))?>
                                </div>
                            <?php } ?>
                        </td>

                        <td>
                            <a
                                href="<?=h($url)?>"
                                target="_blank"
                                rel="noopener"
                            >Відкрити</a>
                        </td>

                        <td class="num">
                            <?=number_format((int)$rs['sold_qt'], 0, '.', ' ')?>
                        </td>

                        <td class="num">
                            <?=number_format((float)$rs['sold_price'], 2, '.', ' ')?> грн
                        </td>

                        <td class="num">
                            <?=number_format((float)$rs['sold_sum'], 2, '.', ' ')?> грн
                        </td>
                    </tr>

                <?php } ?>

                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4">Разом</td>

                        <td class="num">
                            <?=number_format($totalQt, 0, '.', ' ')?>
                        </td>

                        <td></td>

                        <td class="num">
                            <?=number_format($totalSum, 2, '.', ' ')?> грн
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    <?php } else { ?>

        <div class="table-wrap">
            <div class="empty">Продажів не знайдено.</div>
        </div>

    <?php } ?>

</div>

</body>
</html>