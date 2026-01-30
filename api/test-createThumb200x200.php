<?php


function logNotFound($filename, $logFile)
{
    $line = date('Y-m-d H:i:s') . " | NOT FOUND: gmcxml-$filename\n";
    file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
}

function createThumb($src, $dest, $w, $h)
{
		
    [$width, $height, $type] = getimagesize($src);

    switch ($type) {
        case IMAGETYPE_JPEG:
            $img = imagecreatefromjpeg($src);
            break;
        case IMAGETYPE_PNG:
            $img = imagecreatefrompng($src);
            break;
        case IMAGETYPE_WEBP:
            $img = imagecreatefromwebp($src);
            break;
        default:
            return false;
    }

    $srcRatio = $width / $height;
    $dstRatio = $w / $h;

    if ($srcRatio > $dstRatio) {
        $newHeight = $height;
        $newWidth = $height * $dstRatio;
        $srcX = ($width - $newWidth) / 2;
        $srcY = 0;
    } else {
        $newWidth = $width;
        $newHeight = $width / $dstRatio;
        $srcX = 0;
        $srcY = ($height - $newHeight) / 2;
    }

    $thumb = imagecreatetruecolor($w, $h);

    imagecopyresampled(
        $thumb,
        $img,
        0, 0,
        $srcX, $srcY,
        $w, $h,
        $newWidth, $newHeight
    );

    imagejpeg($thumb, $dest, 90);

    imagedestroy($img);
    imagedestroy($thumb);

    return true;
}

set_time_limit(0);
ini_set('memory_limit', '512M');
$root = '/Users/ТВОЙ_ПОЛЬЗОВАТЕЛЬ/Sites/floren.com.ua';

$smallDir = $_SERVER['DOCUMENT_ROOT'] . '/images/ins/s/';
$bigDir   = $_SERVER['DOCUMENT_ROOT'] . '/images/ins/b/';
$destDir  = $_SERVER['DOCUMENT_ROOT'] . '/images/ins/200/';
$logFile  = $_SERVER['DOCUMENT_ROOT'] . '/images/ins/not_found.log';
$stateFile = $_SERVER['DOCUMENT_ROOT'] . '/images/ins/state.json';

$batchSize = 100; // ← сколько за один запуск

if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}

$files = glob($smallDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);
$total = count($files);

$state = file_exists($stateFile)
    ? json_decode(file_get_contents($stateFile), true)
    : ['offset' => 0];

$offset = (int)$state['offset'];

$processed = 0;

for ($i = $offset; $i < $total && $processed < $batchSize; $i++) {

		$smallFile = $files[$i];
    $name = basename($files[$i]);
    $bigFile = $bigDir . 'gmcxml-' . $name;

    if (!file_exists($bigFile)) {
        logNotFound($name, $logFile);
        continue;
    }
    
    [$width, $height] = getimagesize($smallFile);
    if ($width > 200 || $height > 200) {
        // если хотя бы одна сторона больше — пропускаем
        continue;
    }

    $dest = $destDir . $name;

		if (file_exists($dest)) {
		    continue;
		}

    if (createThumb($bigFile, $dest, 200, 200)) {
        $processed++;
    }
}

$state['offset'] = $i;
file_put_contents($stateFile, json_encode($state));

echo "Processed: $processed / $batchSize | Offset: {$state['offset']} / $total<br>";echo 'DONE' . date("Y.m.d - h:i:s", time());
?>