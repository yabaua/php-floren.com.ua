<?php
//if ($_SERVER["SERVER_NAME"]=="n.floren.com.ua"){
	$DB_HOST='floren.mysql.tools';
	$DB_CHARSET='utf8';
	// main base
	$DB_USER='floren_utf2025';
	$DB_PASS='i4d4XB48bV';
	$DB_NAME='floren_utf2025';
/*
}else{
	$DB_HOST="localhost";
	$DB_CHARSET='UTF-8';
	// main base
	$DB_USER='root';
	$DB_PASS='root';
	$DB_NAME='floren';
}
*/

require($_SERVER['DOCUMENT_ROOT']."/include/db_mysql.php");
try {
    $db = new DB2();
    $db->connect();

    $sql = "SELECT alias, txt_ua FROM lingvo WHERE page='general'";
    $db->query($sql);
} catch (mysqli_sql_exception $e) {
    echo "❌ Ошибка MySQL: " . $e->getMessage() . "<br>";
    echo "📜 Стек вызовов: <pre>" . $e->getTraceAsString() . "</pre>";
    exit;
}
//ALTER TABLE `floren_db2025`.`partners` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;

/*
//TEST CODE
$host = "floren.mysql.tools";
$user = "floren_db2025";
$password = "m9286DRfUv";
$database = "floren_db2025";
$db_charset = "utf8";

$db = new mysqli($host, $user, $password, $database);

if ($db->connect_errno) {
    die("Помилка підключення: " . $db->connect_error);
}

$db->set_charset($db_charset);

echo "Підключення успішне з кодуванням $db_charset";
$sql = "SELECT alias, txt_ua FROM lingvo WHERE page='general'";
print_r($db->query($sql)->num_rows);

$db->close();
*/
?>