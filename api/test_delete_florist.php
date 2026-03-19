<?


exit();


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
?>