<?php
header("content-type: text/html;charset=utf-8 \r\n");
require($_SERVER['DOCUMENT_ROOT'] . "/database.php");

function priceToFloat($str) {
    // убираем любые пробелы
    $str = str_replace([" ", "\xc2\xa0", "\t"], "", $str);

    // меняем запятую на точку
    $str = str_replace(",", ".", $str);

    return floatval($str);
}

/**
 * Получаем все листы и их GID из htmlview
 */
function getSheets($docId) {
    $url = "https://docs.google.com/spreadsheets/d/$docId/htmlview";
    $html = file_get_contents($url);
    if (!$html) return [];

    $sheets = [];

    // Парсим JS items.push({name:"...", gid:"..."})
    if (preg_match_all('/items\.push\(\{name:\s*"([^"]+)",[^}]*gid:\s*"([^"]+)"/', $html, $matches)) {
        foreach ($matches[1] as $i => $name) {
            $gid = $matches[2][$i];
            $sheets[] = [
                'name' => $name,
                'gid' => $gid
            ];
        }
    }

    return $sheets;
}

/**
 * Скачиваем CSV листа по GID
 */
function downloadCsv($docId, $gid, $brand_name) {
    global $db;
    $url = "https://docs.google.com/spreadsheets/d/$docId/export?format=csv&gid=$gid";
    $csv = file_get_contents($url);
    $csv = array_map("str_getcsv", file($url));

    // Заголовки
    $headers = array_map('trim', $csv[0]);
    $columnsCount = count($headers);
    unset($csv[0]);
    $db->query("DELETE FROM vendors_lechuza WHERE brand='".$brand_name."'");
    $i=0;
    foreach ($csv as $row) {
        // Пропуск пустых строк
        if (!$row || (count($row) === 1 && trim($row[0]) === "")) continue;
    
        // Приводим строку к количеству колонок
        $rowCount = count($row);
    
        if ($rowCount < $columnsCount) {
            // добавляем пустые значения
            $row = array_pad($row, $columnsCount, "");
        } elseif ($rowCount > $columnsCount) {
            // обрезаем лишние
            $row = array_slice($row, 0, $columnsCount);
        }
    
        // превращаем строку в ассоциативный массив
        $data = array_combine($headers, $row);
    
        // Экранируем
        foreach ($data as $k => $v) {
              $data[$k] = $v;
        }
        
        if(preg_replace('/\D/', '', $data['Артикул'])==''){
          continue;
        }else{
        $query="INSERT INTO vendors_lechuza SET
          brand='".$brand_name."',
          name='".str_replace("'", "", $data['Товар'])."',
          articul='".$data['Артикул']."',
          price='".priceToFloat($data['Ціна'])."',
          stock1='".$data['м. Київ']."',
          stock2='".$data['м. Одеса']."'
          ";
        
          $db->query($query);
          $i++;
        }
    }		
}

// Получаем все листы

$docId = '1-PHVgf0oMzlkNkWRtHzrB10jaWYJtDWg';
$sheets = getSheets($docId);

$needed_brands = array("Lechuza", "Elho", "Lamela", "Click and Grow", "Edelman");
foreach ($sheets as $sheet) {
    echo "Лист: {$sheet['name']} | GID: {$sheet['gid']}\n";
      if(in_array($sheet['name'], $needed_brands)){
        $brand_name = $sheet['name'];
        $data = downloadCsv($docId, $sheet['gid'], $brand_name);
      }
/*
    echo "Строк: " . count($data) . "\n";
    // Пример: вывести первые 3 строки
    for ($i=0; $i<min(3, count($data)); $i++) {
        print_r($data[$i]);
    }
*/
    echo "-----------------------------<br /><br />";
}






echo "Импорт завершён. Товаров 123-".$i;
?>