<?
include('auth.php');
require("../include/resize.php");
?>
<?
if(isset($_FILES['img'])){
	$q=mysql_query("SELECT max(p_order) AS mx FROM clients");
	$r=mysql_fetch_array($q);
	$img_name='client_'.time().".jpg";
	img_resize($_FILES['img']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/images/clients/'.$img_name, 100,60, 0xFFFFFF, 100, false, false);
	mysql_query("INSERT INTO clients SET img='".$img_name."', name='".$_REQUEST['c_name']."', link='".$_REQUEST['c_link']."', p_order='".($r['mx']+1)."'");
}
if(isset($_REQUEST['del']) && $_REQUEST['del']!=''){
	$qr=mysql_query("SELECT * FROM clients WHERE ID='".$_REQUEST['del']."'");
	$rs=mysql_fetch_array($qr);
	@unlink($_SERVER['DOCUMENT_ROOT'].'/images/clients/'.$rs['img']);
	mysql_query("DELETE FROM clients WHERE ID='".$_REQUEST['del']."'");
}
if(isset($_REQUEST['left'])){
	$res=mysql_query("select * from clients WHERE ID='".$_REQUEST['left']."'");
	$sm=mysql_fetch_array($res);
	$res2=mysql_query("select * from clients WHERE p_order<'".$sm['p_order']."' ORDER BY p_order DESC");
	if(!mysql_num_rows($res2)){
		$res2=mysql_query("SELECT * FROM clients ORDER BY p_order DESC LIMIT 1");
	}
	$sm2=mysql_fetch_array($res2);
	if (mysql_num_rows($res2)>0) {
		mysql_query("UPDATE clients SET p_order='".$sm2['p_order']."' WHERE ID='".$sm['ID']."'");
		mysql_query("UPDATE clients SET p_order='".$sm['p_order']."' WHERE ID='".$sm2['ID']."'");	
	}
	echo mysql_error();
//	header("location: /admin/clients.php");
}
if(isset($_REQUEST['right'])){
	$res=mysql_query("select * from clients WHERE ID='".$_REQUEST['right']."'");
	$sm=mysql_fetch_array($res);
	$res2=mysql_query("select * from clients WHERE p_order>'".$sm['p_order']."' ORDER BY p_order");
	if(!mysql_num_rows($res2)){
		$res2=mysql_query("SELECT * FROM clients ORDER BY p_order LIMIT 1");
	}
	$sm2=mysql_fetch_array($res2);
	if (mysql_num_rows($res2)>0) {
		mysql_query("UPDATE clients SET p_order='".$sm2['p_order']."' WHERE ID='".$sm['ID']."'");
		mysql_query("UPDATE clients SET p_order='".$sm['p_order']."' WHERE ID='".$sm2['ID']."'");	
	}
	echo mysql_error();
	//header("location: /admin/clients.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Клиенты</title>
	<style>
		*{margin:0;padding:0;}
		body{
			font:12px Arial,Tahoma, sans-serif;
			color:#111111;
			line-height:1.3;
		}
		.input{
			display:block;
			width:120px;
			border: 1px solid #C1C1C1;
			text-align: center;
			padding: 4px 0;
			cursor: hand;
			
			color: #0065DC;
			text-decoration: underline;
			background-color: #EFEFEF;
		}
		.img-h{
			width:100px;
			height:120px;
			position:relative;
		}
		.img-del{
			display:block;
			position:absolute;
			top:0;
			right:0;
			width:16px;
			height:16px;
			background:url('/img/basketdelbig.gif') no-repeat 0 0;
		}
		td{
			border:1px solid #E1E1E1;
			padding:4px;
		}
	</style>
</head>

<body>
<p>&nbsp;</p>
<table width="600" cellspacing="5" align="center" border="0">
	<tr align="center">
		<?
		$qr=mysql_query("SELECT * FROM clients ORDER BY p_order DESC");
		for($i=0;$rs=mysql_fetch_array($qr);$i++){
		?>
		<td>
			<div class="img-h">
				<a class="img-del" href="/admin/clients.php?del=<?=$rs['ID']?>"></a>
				<img src="/images/clients/<?=$rs['img']?>">
				<div style="font-size:12px;"><?=$rs['name']?></div>
				<div style="font-size:12px;"><?=$rs['link']?></div>
				<div align="center"><a href="/admin/clients.php/?right=<?=$rs['ID']?>">&larr;</a>&nbsp;<a href="/admin/clients.php?left=<?=$rs['ID']?>">&rarr;</a></div>
			</div>
		</td>
		<?if($i%10==9){?></tr><tr align="center"><?}?>
		<?}?>
	</tr>
</table>
<p>&nbsp;</p>
<table width="600" align="center" border="0">
	<tr align="center">
		<td>
			<form name="f1" method="post" enctype="multipart/form-data" action="clients.php">
				<input type="File" name="img">
				<input type="Text" name="c_name">
				<input type="Text" name="c_link">
				<input type="Submit" name="sbm" value="Добавить">
			</form>
		</td>
	</tr>
</table>
</body>
</html>
