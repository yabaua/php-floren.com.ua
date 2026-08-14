<?php

header("content-type: text/html; charset=utf-8");

require_once($_SERVER['DOCUMENT_ROOT'] . '/database.php');

$servicesDir = $_SERVER['DOCUMENT_ROOT'] . '/templates/services/';

$db->query("
    SELECT alias
    FROM services
");

while ($rs = $db->fetch()) {

    $alias = $rs['alias'];

    $file = $servicesDir . 'ru_' . $alias . '.tpl';

    if (!is_file($file)) {
        echo '❌ Файл не найден: ' . htmlspecialchars($file) . '<br>';
        continue;
    }

    $body = file_get_contents($file);

    if ($body === false) {
        echo '❌ Не удалось прочитать файл: ' . htmlspecialchars($file) . '<br>';
        continue;
    }

    $db->query("
        UPDATE services
        SET body = '" . $db->escape($body) . "'
        WHERE alias = '" . $db->escape($alias) . "'" , 1
     );

    echo '✅ Обновлено: ' . htmlspecialchars($alias) . '<br>';
}

echo '<br><strong>Готово.</strong>';