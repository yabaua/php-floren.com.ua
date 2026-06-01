<?
$hleb=array();
$hleb[0]['link']='/';
$hleb[0]['name']=$lingvo['main_page'];
$hleb[1]['link']='';
$hleb[1]['name']=$lingvo['our_clients'];

$smarty->assign("CONTENT_TPL",'clients.tpl');
$smarty->assign("META_REL_CANONICAL",'<link rel="canonical" href="https://floren.com.ua'.$lang_url.'/clients/" />');
$db->query("SELECT * FROM clients ORDER BY p_order DESC");
while($f=$db->fetch()){
	$clients[]=$f;
}
$smarty->assign("CLIENTS", $clients);


$smarty->assign("HLEB",$hleb);
?>