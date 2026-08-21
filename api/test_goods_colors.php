<?php

require($_SERVER['DOCUMENT_ROOT'] . "/database.php"); // або твій файл підключення до БД

echo '<meta charset="utf-8">';


// ======================================================
// GOODS FORMS — ПОШУК ВІДСУТНІХ КОМБІНАЦІЙ РОЗМІР + КОЛІР
// ======================================================

$goods = array();

$db->query("
    SELECT
        gf.*,
        g.name AS good_name,
        gc.name_ru AS color_name
    FROM goods_forms gf

    LEFT JOIN goods g
        ON g.ID = gf.goodID

    LEFT JOIN goods_colors gc
        ON gc.alias = gf.color

    WHERE gf.color IS NOT NULL
      AND gf.color != ''
      AND gf.color != '0'

    ORDER BY gf.goodID, gf.ID
");


while ($rs = $db->fetch()) {

    $goodID = $rs['goodID'];

    /*
     * Унікальний ключ розміру.
     * Такий самий принцип використовується в good.php.
     */
    $sizeKey =
        $rs['dia'] . '_' .
        $rs['wdt'] . '_' .
        $rs['hgt'] . '_' .
        $rs['depth'] . '_' .
        $rs['measure_qt'];


    // Назва товару
    $goods[$goodID]['name'] = $rs['good_name'];


    // Всі кольори, які взагалі існують у цього товару
    $goods[$goodID]['colors'][$rs['color']] = array(
        'alias' => $rs['color'],
        'name'  => $rs['color_name']
    );


    // Всі розміри товару
    $goods[$goodID]['sizes'][$sizeKey] = array(
        'dia'        => $rs['dia'],
        'wdt'        => $rs['wdt'],
        'hgt'        => $rs['hgt'],
        'depth'      => $rs['depth'],
        'measure_qt' => $rs['measure_qt']
    );


    // Існуюча комбінація розмір + колір
    $goods[$goodID]['matrix'][$sizeKey][$rs['color']] = $rs['ID'];
}


// ======================================================
// ВИВІД
// ======================================================

echo '
<style>

body{
    font-family: Arial;
    font-size:14px;
    padding:30px;
}

.good{
    margin-bottom:35px;
    border-bottom:1px solid #ccc;
    padding-bottom:25px;
}

.good-title{
    font-size:20px;
    font-weight:bold;
    margin-bottom:15px;
}

.good-title span{
    color:#888;
    font-size:13px;
    font-weight:normal;
}

table{
    border-collapse:collapse;
}

th,
td{
    border:1px solid #ddd;
    padding:7px 10px;
}

th{
    background:#eee;
}

.missing{
    background:#ffdede;
    font-weight:bold;
}

.ok{
    background:#e2f5df;
}

</style>
';


$problemGoods = 0;
$missingTotal = 0;


foreach ($goods as $goodID => $good) {

    $missing = array();


    foreach ($good['sizes'] as $sizeKey => $size) {

        foreach ($good['colors'] as $colorAlias => $color) {

            if (
                !isset($good['matrix'][$sizeKey]) ||
                !isset($good['matrix'][$sizeKey][$colorAlias])
            ) {

                $missing[$sizeKey][$colorAlias] = true;
                $missingTotal++;

            }

        }

    }


    /*
     * Якщо всі комбінації існують —
     * товар взагалі не показуємо.
     */
    if (empty($missing)) {
        continue;
    }


    $problemGoods++;


    echo '<div class="good">';

    echo '
        <div class="good-title">
            '.$good['name'].'
            <span>ID: '.$goodID.'</span>
        </div>
    ';


    echo '<table>';

    echo '<tr>';
    echo '<th>Розмір</th>';

    foreach ($good['colors'] as $colorAlias => $color) {

        $colorTitle = $color['name']
            ? $color['name']
            : $colorAlias;

        echo '<th>'.$colorTitle.'<br><small>'.$colorAlias.'</small></th>';
    }

    echo '</tr>';


    foreach ($good['sizes'] as $sizeKey => $size) {

        $sizeTitle = array();

        if ($size['dia'] != '') {
            $sizeTitle[] = 'Ø '.$size['dia'];
        }

        if ($size['wdt'] != '') {
            $sizeTitle[] = 'W '.$size['wdt'];
        }

        if ($size['depth'] != '') {
            $sizeTitle[] = 'D '.$size['depth'];
        }

        if ($size['hgt'] != '') {
            $sizeTitle[] = 'H '.$size['hgt'];
        }

        if ($size['measure_qt'] != '') {
            $sizeTitle[] = $size['measure_qt'];
        }


        echo '<tr>';

        echo '<td>'.implode(' × ', $sizeTitle).'</td>';


        foreach ($good['colors'] as $colorAlias => $color) {

            if (isset($good['matrix'][$sizeKey][$colorAlias])) {

                echo '
                    <td class="ok">
                        ✓
                        <small>
                            ID '.$good['matrix'][$sizeKey][$colorAlias].'
                        </small>
                    </td>
                ';

            } else {

                echo '
                    <td class="missing">
                        НЕМАЄ
                    </td>
                ';

            }

        }

        echo '</tr>';
    }


    echo '</table>';

    echo '</div>';
}


echo '
<hr>

<b>Товарів з проблемами:</b> '.$problemGoods.'
<br>
<b>Відсутніх комбінацій:</b> '.$missingTotal.'
';