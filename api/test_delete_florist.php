<?


//exit();


error_reporting(E_ALL);
header("content-type: text/html;charset=utf-8 \r\n");
	$DB_HOST="floren.mysql.ukraine.com.ua";
	$DB_CHARSET='utf8';
	// main base
	$DB_USER='floren_utf2025';
	$DB_PASS='i4d4XB48bV';
	$DB_NAME='floren_utf2025';

require("../include/db_mysql.php");
require("../include/resize.php");

$db = new DB2();
$db->connect();
/*
// STEP 1
$db->query("SELECT id FROM links_block WHERE url LIKE '/florist/%'");
while($rs=$db->fetch()){
	echo $rs['id'] . "=>>>>>";
	$db->query("SELECT id, selected_links FROM links_block_pages WHERE selected_links LIKE '%,".$rs['id'].",%'", 1);
	while($rs2=$db->fetch(1)){
		$selected_links = explode(",", $rs2['selected_links']);
		print_r($selected_links);
		$selected_links = array_diff($selected_links, [$rs['id']]);
		$new_data = implode(",", $selected_links);
		echo $new_data;
	//	echo "<br>===========<br>";
		echo "UPDATE links_block_pages SET selected_links='".$new_data."' WHERE id='".$rs2['id']."'";
		$db->query("UPDATE links_block_pages SET selected_links='".$new_data."' WHERE id='".$rs2['id']."'", 2);
		echo "<br>===========<br>";
	}

}

// STEP 2
$db->query("SELECT id FROM links_block WHERE url LIKE '/florist/%'");
while($rs=$db->fetch()){
	echo $rs['id'] . "=>>>>>";
	$db->query("SELECT id, selected_links FROM links_block_pages WHERE selected_links LIKE '".$rs['id'].",%'", 1);
	while($rs2=$db->fetch(1)){
		$selected_links = explode(",", $rs2['selected_links']);
		print_r($selected_links);
		$selected_links = array_diff($selected_links, [$rs['id']]);
		$new_data = implode(",", $selected_links);
		echo $new_data;
	//	echo "<br>===========<br>";
		echo "UPDATE links_block_pages SET selected_links='".$new_data."' WHERE id='".$rs2['id']."'";
		$db->query("UPDATE links_block_pages SET selected_links='".$new_data."' WHERE id='".$rs2['id']."'", 2);
		echo "<br>===========<br>";
	}

}


// STEP 3

$db->query("SELECT id FROM links_block WHERE url LIKE '/florist/%'");
while($rs=$db->fetch()){
	echo $rs['id'] . "=>>>>>";
	$db->query("SELECT id, selected_links FROM links_block_pages WHERE selected_links LIKE '%,".$rs['id']."'", 1);
	while($rs2=$db->fetch(1)){
		$selected_links = explode(",", $rs2['selected_links']);
		print_r($selected_links);
		$selected_links = array_diff($selected_links, [$rs['id']]);
		$new_data = implode(",", $selected_links);
		echo $new_data;
	//	echo "<br>===========<br>";
		echo "UPDATE links_block_pages SET selected_links='".$new_data."' WHERE id='".$rs2['id']."'";
		$db->query("UPDATE links_block_pages SET selected_links='".$new_data."' WHERE id='".$rs2['id']."'", 2);
		echo "<br>===========<br>";
	}

}

// STEP 4
$db->query("SELECT id FROM links_block WHERE url LIKE '/florist/%'");
while($rs=$db->fetch()){
	echo $rs['id'] . "=>>>>>";
	$db->query("SELECT id, selected_links FROM links_block_pages WHERE selected_links = '".$rs['id']."'", 1);
	while($rs2=$db->fetch(1)){
		$selected_links = explode(",", $rs2['selected_links']);
		print_r($selected_links);
		$selected_links = array_diff($selected_links, [$rs['id']]);
		$new_data = implode(",", $selected_links);
		echo $new_data;
	//	echo "<br>===========<br>";
		echo "UPDATE links_block_pages SET selected_links='".$new_data."' WHERE id='".$rs2['id']."'";
		$db->query("UPDATE links_block_pages SET selected_links='".$new_data."' WHERE id='".$rs2['id']."'", 2);
		echo "<br>===========<br>";
	}
}

$db->query("DELETE FROM links_block WHERE url LIKE '/florist/%'");
$db->query("DELETE FROM links_block_pages WHERE selected_links = ''");
*/
//STEP 5
$logFile = $_SERVER['DOCUMENT_ROOT'] . '/api/delete_images.log';
$dryRun  = true; // <-- переключи на false для реального удаления

function writeLog($message) {
    global $logFile;
    $date = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$date] $message" . PHP_EOL, FILE_APPEND);
}

// базовые директории
$baseDirB = realpath($_SERVER['DOCUMENT_ROOT'] . "/images/ins/b/");
$baseDirS = realpath($_SERVER['DOCUMENT_ROOT'] . "/images/ins/s/");

if (!$baseDirB || !$baseDirS) {
    die("ERROR: base directories not found");
}

function safeDelete($fileRelative, $baseDir, $label) {
    global $dryRun;

    if (empty($fileRelative)) return;

    $fileRelative = trim($fileRelative);
    if ($fileRelative === '') return;

    $fullPath = realpath($baseDir . "/" . $fileRelative);

    // файл не существует
    if ($fullPath === false) {
        writeLog("NOT FOUND ($label): $baseDir/$fileRelative");
        return;
    }

    // защита: файл должен быть внутри нужной директории
    if (strpos($fullPath, $baseDir) !== 0) {
        writeLog("SECURITY BLOCKED ($label): $fullPath");
        return;
    }

    if ($dryRun) {
        writeLog("DRY RUN ($label): $fullPath");
    } else {
        if (unlink($fullPath)) {
            writeLog("DELETED ($label): $fullPath");
        } else {
            writeLog("ERROR deleting ($label): $fullPath");
        }
    }
}

$db->query("SELECT * FROM goods WHERE classID IN (77,78,79,80)");
echo $db->num_rows();
$cnt=0;
while ($rs = $db->fetch()) {
	$cnt++;
    writeLog("=== $cnt GOODS ID: {$rs['ID']} ===");

    // --- основное изображение ---
    safeDelete($rs['image'], $baseDirB, 'main_b');
    safeDelete($rs['image'], $baseDirS, 'main_s');

    // --- дополнительные изображения ---
    if (!empty($rs['images'])) {

        $images_array = explode(",", $rs['images']);

        foreach ($images_array as $v) {
            safeDelete($v, $baseDirB, 'extra_b');
            safeDelete($v, $baseDirS, 'extra_s');
        }
    }
}
echo $cnt;
?>