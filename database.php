<?php
//if ($_SERVER["SERVER_NAME"]=="n.floren.com.ua"){
	$DB_HOST='floren.mysql.tools';
	$DB_CHARSET='utf8mb4';
	// main base
	$DB_USER='floren_db2025';
	$DB_PASS='m9286DRfUv';
	$DB_NAME='floren_db2025';
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

?>