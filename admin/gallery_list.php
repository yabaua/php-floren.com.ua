<?
require("auth.php");
require("../include/strlib.php");

?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style_back.css">
</head>
<body style="margin-left:20px;">
<h3>Галерея</h3>

<form action="gallery_list.php" method="post">

<br />
<?
$qr=mysql_query("SELECT * FROM gallery_list ORDER BY galleryOrder DESC");
while($rs=mysql_fetch_array($qr)){
?>
<p><a href="gallery_item.php?ID=<?=$rs['ID']?>"><b><?=$rs['galleryName']?></b></a></p>


<div class="gallery-h holder">
<?
$qr_g=mysql_query("SELECT * FROM gallery_item WHERE galleryID='0' ORDER BY gItemOrder DESC");
for($i=0;$rs_g=mysql_fetch_array($qr_g);$i++){
?>
	<div class="gallery-item holder">
		<a href="gallery_item.php?ID=<?=$rs_g['ID']?>"><img src="/images/gallery/s/<?=$rs_g['imgURL']?>" width="160" height="121" alt="Сансевьерия в горшке Lechuza Cararo"></a>
		<p class="gallery-ttl"><?=$rs_g['plantName']?> в горшке <?=$rs_g['planterName']?></p>
	</div>
<?if($i%4==3){?>
</div><div class="gallery-h holder">
<?}//if?>
<?}//white?>
</div>


<?}?>
</body>
</html>