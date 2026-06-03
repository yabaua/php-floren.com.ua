<?require("auth.php");?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style_back.css?v=12">
	<link href="https://fonts.googleapis.com/css?family=Lato:900&display=swap" rel="stylesheet">
	<script src="/admin/ckeditor/ckeditor.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body style="margin-left:20px;">
<?
//============================

include("top_menu.php");

//============================
?>
<?
$date_from	=	!isset($_REQUEST['nDateFrom'])?date("Y-m-d", (time()-30*24*60*60)):$_REQUEST['nDateFrom'];
$date_to	=	!isset($_REQUEST['nDateTo'])?date("Y-m-d", (time())):$_REQUEST['nDateTo'];

$groupData='showQT';
if(isset($_REQUEST['groupData'])) $groupData=$_REQUEST['groupData'];
?>
<h1>Звіт</h1>

<script>
$("#classNames").change(function () {
      if($("select option:selected").length > 3) {
          alert('3 max');
      }
  });
</script>
<form name="report" method="post" enctype="multipart/form-data">
<select name="classNames[]" id="classNames" multiple style="width:300px;height:200px;">
<?
	$qr=mysql_query("SELECT className FROM report_goods GROUP BY className;");
	while($rs=mysql_fetch_array($qr)){
		//if(!$rs['className']) $rs['className']='Головний екран'
		$checked='';
		if(isset($_REQUEST['classNames'])){
			if(in_array($rs['className'], $_REQUEST['classNames'])) $checked=' checked="true"';
		}
?>
  <option value="<?=$rs['className']?>"<?=$checked?>><?=$rs['className']?></option>
<?}?>
</select>

<p>
<?
$groupData='showUAH';
if(isset($_REQUEST['groupData'])) $groupData=$_REQUEST['groupData'];
?>
<input type="radio" name="groupData" value="showQT" id="showQT" <?=($groupData=='showQT'?' checked="true"':'')?>><label for="showQT">В штуках</label>
<input type="radio" name="groupData" value="showUAH" id="showUAH" <?=($groupData=='showUAH'?' checked="true"':'')?>><label for="showUAH">В грошах</label>
</p>

<input style="padding: 6px 10px 5px 10px;margin-top:-2px; color: #FFFFFF; background: #5F1C13; text-decoration: none; border:none;" type="submit" name="change" value="Застосувати">
</form>


<?
if(isset($_REQUEST['classNames'])){
	$sql_className=implode("','", $_REQUEST['classNames']);
	 	$query="SELECT rg.className, rg.report_year, rg.report_month, SUM(rg.qt) AS qt,SUM(rg.gross) AS gross FROM report_goods rg
				WHERE rg.className IN ('".$sql_className."')
				GROUP BY rg.report_month, rg.report_year;";
		$qr=mysql_query($query);
		
		while($rs=mysql_fetch_array($qr)){
	
			$year=$rs['report_year'];
			$month=$rs['report_month'];
			$qt=$rs['qt']>0?$rs['qt']:'–';
			$gross=$rs['gross']>0?$rs['gross']:'–';
			
			$arr[$year][$month]= array('qt'=> $qt, 'gross'=> $gross);
			//$arr[]=$rs;
		}
	
	
//	print_r($arr);
	?>
	<style>
	.tbl td {padding: 2px 5px;}
	</style>
	<table class="tbl" cellpadding="0" cellspacing="0" border=0>
	<tr>
		<th>&nbsp</th>
		
		<th collspan="2">Січ</th>
		<th collspan="2">Лют</th>
		<th collspan="2">Бер</th>
		<th collspan="2">Кві</th>
		<th collspan="2">Тра</th>
		<th collspan="2">Чер</th>
		<th collspan="2">Лип</th>
		<th collspan="2">Сер</th>
		<th collspan="2">Вер</th>
		<th collspan="2">Жов</th>
		<th collspan="2">Лис</th>
		<th collspan="2">Гру</th>
	</tr>
	
	<?foreach($arr AS $k=>$v){
		echo "<tr>";
		echo "<th>".$k."</th>";
		foreach($v AS $kk=>$vv){
			echo "<td>";
			 if($groupData=='showQT') echo $vv['qt'];
			 else echo number_format($vv['gross'], '2', ',', ' ');
			echo "</td>";
		}
		echo "</tr>";
	}
}// if build report
?>
</table>
</body>