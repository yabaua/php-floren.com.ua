<?php
if (!isset($_REQUEST['ID'])){
	header("location:goods_list.php");
	exit();
}else
	$ID=$_REQUEST['ID'];


function check_availability($name) {

	global $ID, $db;

	$prod_req = $db->query("SELECT g.act, g.availability, min(NULLIF(gf.price, 0)) AS min_price, max(gf.price) AS max_price FROM $name g LEFT JOIN goods_forms gf ON g.ID=gf.goodID WHERE g.ID=".$ID." AND gf.visibility=1", 33);
	$prod_res = $db->fetch(33);

	$is_active = $prod_res['act'] === 'Y' ? 1 : 0;
	$zero_price = intval($prod_res['min_price']) === 0 && intval($prod_res['max_price']) === 0 ? 1 : 0;

	if (!$is_active || $zero_price) {
		$available = 0;
	} else {
		$available = 1;
	}

	if ($prod_res['availability'] != $available) {
		$db->query("UPDATE $name SET availability=".$available." WHERE ID=".$ID, 44);
	}

}

