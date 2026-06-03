<?
require($_SERVER['DOCUMENT_ROOT'].'/database.php');

if (!isset($_REQUEST['action']) || !isset($_REQUEST['ID']) || !isset($_REQUEST['md5'])) exit();

if ($_REQUEST['action']=='comment_aprove') {
	$db->query("UPDATE goods_voting SET act='1' WHERE ID='".$_REQUEST['ID']."' AND md5_del='".$_REQUEST['md5']."'");
	echo "UPDATE a_drug_comments SET act='Y' WHERE ID='".$_REQUEST['id']."' AND md5_del='".$_REQUEST['md5']."'";
}
if ($_REQUEST['action']=='comment_delete') {
	$db->query("DELETE FROM goods_voting WHERE ID='".$_REQUEST['ID']."' AND md5_del='".$_REQUEST['md5']."'");
	echo "DELETE FROM goods_voting WHERE ID='".$_REQUEST['ID']."' AND md5_del='".$_REQUEST['md5']."'";
}


if ($db->affected_rows()) echo '<BR><BR>OK';
  else echo '<BR><BR>ERROR';

?>
