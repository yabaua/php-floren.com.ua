<?php
header("content-type: text/html;charset=utf-8 \r\n");
require("auth.php");
$allow_adm_lvl=array('top','middle');
if(!in_array($_SESSION['admin_lvl'], $allow_adm_lvl)){
	unset($_SESSION['admin_name']);
	header("location:/report/index.html");
	exit();
}
include("../include/strlib.php");


$date_from	=	!isset($_REQUEST['nDateFrom'])?date("Y-m-d", (time()-30*24*60*60)):$_REQUEST['nDateFrom'];
$date_to	=	!isset($_REQUEST['nDateTo'])?date("Y-m-d", (time())):$_REQUEST['nDateTo'];

$groupData='showQT';
if(isset($_REQUEST['groupData'])) $groupData=$_REQUEST['groupData'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Звіт</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?=time()?>" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>


<?include("top_menu.php")?>
<h1>Звіт за Джерелом Угоди</h1>



<form name="report" method="post" enctype="multipart/form-data">
<script>
function selectAll(){
    	options = document.getElementsByTagName("option");
    	for ( i=0; i<options.length; i++){
    		options[i].selected = "true";
    	}
    }
function selectNone(){
    	options = document.getElementsByTagName("option");
    	for ( i=0; i<options.length; i++){
    		options[i].selected = false;
    	}
    }
</script>
<div style="width:300px;overflow:hidden;padding:4px 0;">
	<div onclick="selectAll()" style="display:block;cursor:pointer;width:100px;float:left">Обрати всі</div>
	<div onclick="selectNone()" style="display:block;cursor:pointer;width:100px;float:right;text-align:right;">Очистити</div>
</div>
<select name="sourceNames[]" id="sourceNames" multiple style="width:300px;height:200px;">
<?
	$qr=mysql_query("SELECT sourceName FROM report_source GROUP BY sourceName;");
	while($rs=mysql_fetch_array($qr)){
		//if(!$rs['sourceName']) $rs['sourceName']='Головний екран'
		$selected='';
		if(isset($_REQUEST['sourceNames'])){
			if(in_array($rs['sourceName'], $_REQUEST['sourceNames'])) $selected=' selected="selected"';
		}
?>
  <option value="<?=$rs['sourceName']?>"<?=$selected?>><?=$rs['sourceName']?></option>
<?}?>
</select>

<p>
<?
$groupData='gross';
if(isset($_REQUEST['groupData'])) $groupData=$_REQUEST['groupData'];
?>
<input type="radio" name="groupData" value="qt" id="qt" <?=($groupData=='qt'?' checked="true"':'')?>><label for="qt">В штуках</label>
<input type="radio" name="groupData" value="gross" id="gross" <?=($groupData=='gross'?' checked="true"':'')?>><label for="gross">В грошах</label>
<input type="radio" name="groupData" value="avgbill" id="avgbill" <?=($groupData=='avgbill'?' checked="true"':'')?>><label for="avgbill">Ср. Чек</label>
</p>

<input style="padding: 6px 10px 5px 10px;margin-top:-2px; color: #FFFFFF; background: #5F1C13; text-decoration: none; border:none;" type="submit" name="change" value="Застосувати">
</form>


<?
if(isset($_REQUEST['sourceNames'])){
	$sql_sourceName=implode("','", $_REQUEST['sourceNames']);
		$orderField='sourceName';
	  	$query="SELECT rg.sourceName, rg.report_year, rg.report_month, SUM(rg.qt) AS qt,SUM(rg.gross) AS gross, SUM(rg.gross)/SUM(rg.qt) AS avgbill FROM report_source rg
				WHERE rg.sourceName IN ('".$sql_sourceName."') AND report_year='2025'
				GROUP BY sourceName, rg.report_month
				ORDER BY ".$orderField.";";
		$qr=mysql_query($query);
		
		while($rs=mysql_fetch_array($qr)){
	
			$sourceName=$rs['sourceName'];
			$month=$rs['report_month'];
			$qt=$rs['qt']>0?$rs['qt']:'0';
			$gross=$rs['gross']>0?$rs['gross']:'0';
			$avgbill=$rs['avgbill']>0?$rs['avgbill']:'0';
			
			$arr[$sourceName][$month]= array('qt'=> $qt, 'gross'=> $gross, 'avgbill'=> $avgbill);
			//$arr[]=$rs;
		}
	
	
//	print_r($arr);
	?>
	<table class="tbl tbl12mnth" cellpadding="0" cellspacing="0" width="92%" border="0">
	<tr>
		<th>&nbsp</th>
		
		<th>Січ</th>
		<th>Лют</th>
		<th>Бер</th>
		<th>Кві</th>
		<th>Тра</th>
		<th>Чер</th>
		<th>Лип</th>
		<th>Сер</th>
		<th>Вер</th>
		<th>Жов</th>
		<th>Лис</th>
		<th>Гру</th>
	</tr>
	
	<?
	//foreach($arr AS $k=>$v){
	$chartArr=array();
	foreach($arr AS $sN=>$sVal){
		echo "<tr>";
		echo "<th>".$sN."</th>";
		for($i=1;$i<=12;$i++){
			
			(strlen($i)<2)?$ii='0'.$i:$ii=$i;
			if(!isset($arr[$sN][$ii]['qt'])) {
				echo '<td class="zero" align="center">&ndash;</td>';
				$chartArr[$sN][$ii]=0;
			}
			else{
				$chartArr[$sN][$ii]=$arr[$sN][$ii][$groupData];
				if($groupData=='qt') 	echo '<td align="center">'.$arr[$sN][$ii][$groupData].'</td>';
				else 					echo '<td align="right">'.number_format($arr[$sN][$ii][$groupData], '2', ',', ' ').'</td>';
				
				$max_value[]=$arr[$sN][$ii][$groupData];
			}// qt or uah
		} // for month's
		echo "</tr>";
		
	}// for years


		
	//	print_r($chartArrPercent);

?>					
</table>



<?

	$sql_sourceName=implode("','", $_REQUEST['sourceNames']);
		$orderField='sourceName';
	  	$query2="SELECT rg.sourceName, rg.report_year, rg.report_month, SUM(rg.qt) AS qt,SUM(rg.gross) AS gross, SUM(rg.gross)/SUM(rg.qt) AS avgbill FROM report_source rg
				WHERE rg.sourceName IN ('".$sql_sourceName."') AND report_year='2026'
				GROUP BY sourceName, rg.report_month
				ORDER BY ".$orderField.";";
				
				echo $query;
		$qr2=mysql_query($query2);
		
		while($rs2=mysql_fetch_array($qr2)){
	
			$sourceName=$rs2['sourceName'];
			$month=$rs2['report_month'];
			$qt=$rs2['qt']>0?$rs2['qt']:'0';
			$gross=$rs2['gross']>0?$rs2['gross']:'0';
			$avgbill=$rs2['avgbill']>0?$rs2['avgbill']:'0';
			
			$arr[$sourceName][$month]= array('qt'=> $qt, 'gross'=> $gross, 'avgbill'=> $avgbill);
			//$arr[]=$rs;
		}
	
	
//	print_r($arr);
	?>
	<table class="tbl tbl12mnth" cellpadding="0" cellspacing="0" width="92%" border="0">
	<tr>
		<th>&nbsp</th>
		
		<th>Січ</th>
		<th>Лют</th>
		<th>Бер</th>
		<th>Кві</th>
		<th>Тра</th>
		<th>Чер</th>
		<th>Лип</th>
		<th>Сер</th>
		<th>Вер</th>
		<th>Жов</th>
		<th>Лис</th>
		<th>Гру</th>
	</tr>
	
	<?
	//foreach($arr AS $k=>$v){
	$chartArr=array();
	foreach($arr AS $sN=>$sVal){
		echo "<tr>";
		echo "<th>".$sN."</th>";
		for($i=1;$i<=12;$i++){
			
			(strlen($i)<2)?$ii='0'.$i:$ii=$i;
			if(!isset($arr[$sN][$ii]['qt'])) {
				echo '<td class="zero" align="center">&ndash;</td>';
				$chartArr[$sN][$ii]=0;
			}
			else{
				$chartArr[$sN][$ii]=$arr[$sN][$ii][$groupData];
				if($groupData=='qt') 	echo '<td align="center">'.$arr[$sN][$ii][$groupData].'</td>';
				else 					echo '<td align="right">'.number_format($arr[$sN][$ii][$groupData], '2', ',', ' ').'</td>';
				
				$max_value[]=$arr[$sN][$ii][$groupData];
			}// qt or uah
		} // for month's
		echo "</tr>";
		
	}// for years


		
	//	print_r($chartArrPercent);

?>					
</table>







<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="chart"></div>

<script>
      
      var options = {
        series: [
       	<?
       	
       	$iter=0;
       	$cnt=count($chartArr);
       	foreach($chartArr AS $k=>$v){
	       	echo "{\r\n";
	        	echo "name: '".$k."',\r\n";
	          	echo "type: 'bar',\r\n";
	          	echo "data: ['".implode("','",$v)."']\r\n";
	        echo "}\r\n";
	        if($iter+1!=$cnt) echo ",";
	    	$iter++;	    	
		}// foreach		
        
		echo ",";
		?>
        ],
          chart: {
          height: 350,
          type: 'line',
          stacked: false
        },
        dataLabels: {
          enabled: true,
          enabledOnSeries: [<?=count($chartArr)+1?>]
        },
        stroke: {
          width: [<?for($it=1;$it<=$cnt;$it++) echo "1,";?> 2]
        },
        title: {
          text: 'Продажі за вибраними Джерелами угоди',
          align: 'left',
          offsetX: 110
        },
        xaxis: {
          categories: ['Січ','Лют','Бер','Кві','Тра','Чер','Лип','Сер','Вер','Жов','Лис','Гру'],
        },
        yaxis: [
        <?
        $yaxis_iteration=0;
        foreach($chartArr AS $k=>$v){
        ?>
        {
            seriesName: '<?=$k?>',
            show: <?echo ($yaxis_iteration==0)?"true":"false"?>,
            opposite: false,
            max: <?echo round(ceil(max($max_value)*1.1),-((strlen(ceil(max($max_value)*1.1))-2)));?>,
            axisTicks: {
              show: true,
            },
            
            
            axisBorder: {
              show: true,
              color: '#008FFB'
            },
            labels: {
              style: {
                colors: '#008FFB',
              }
            },
            title: {
              text: "<?=$k?>",
              style: {
                color: '#008FFB',
              }
            },
            tooltip: {
              enabled: true
            }
          },
          <?
          	$yaxis_iteration++;
          	} // foreach
          ?>

          
         
        ],
        tooltip: {
          fixed: {
            enabled: true,
            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
            offsetY: 30,
            offsetX: 60
          },
        },
        legend: {
          horizontalAlign: 'left',
          offsetX: 40
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
    </script>
<?}// if build report	?>
</body>