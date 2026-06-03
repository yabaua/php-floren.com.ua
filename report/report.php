<?php
header("content-type: text/html;charset=utf-8 \r\n");
require("auth.php");
if($_SESSION['admin_lvl']!='top'){
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
<h1>Звіт за товарами</h1>



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
<select name="classNames[]" id="classNames" multiple style="width:300px;height:200px;">
<?
	$qr=mysql_query("SELECT className FROM report_goods GROUP BY className;");
	while($rs=mysql_fetch_array($qr)){
		//if(!$rs['className']) $rs['className']='Головний екран'
		$selected='';
		if(isset($_REQUEST['classNames'])){
			if(in_array($rs['className'], $_REQUEST['classNames'])) $selected=' selected="selected"';
		}
?>
  <option value="<?=$rs['className']?>"<?=$selected?>><?=$rs['className']?></option>
<?}?>
</select>

<p>
<?
$groupData='gross';
if(isset($_REQUEST['groupData'])) $groupData=$_REQUEST['groupData'];
?>
<input type="radio" name="groupData" value="qt" id="qt" <?=($groupData=='qt'?' checked="true"':'')?>><label for="qt">В штуках</label>
<input type="radio" name="groupData" value="gross" id="gross" <?=($groupData=='gross'?' checked="true"':'')?>><label for="gross">В грошах</label>
</p>

<input style="padding: 6px 10px 5px 10px;margin-top:-2px; color: #FFFFFF; background: #5F1C13; text-decoration: none; border:none;" type="submit" name="change" value="Застосувати">
</form>


<?
if(isset($_REQUEST['classNames'])){
	$sql_className=implode("','", $_REQUEST['classNames']);
	  	$query="SELECT rg.className, rg.report_year, rg.report_month, SUM(rg.qt) AS qt,SUM(rg.gross) AS gross FROM report_goods rg
				WHERE rg.className IN ('".$sql_className."')
				GROUP BY rg.report_month, rg.report_year
				ORDER BY rg.report_year;";
		$qr=mysql_query($query);
		
		while($rs=mysql_fetch_array($qr)){
	
			$year=$rs['report_year'];
			$month=$rs['report_month'];
			$qt=$rs['qt']>0?$rs['qt']:'0';
			$gross=$rs['gross']>0?$rs['gross']:'0';
			
			$arr[$year][$month]= array('qt'=> $qt, 'gross'=> $gross);
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
		<th>Рік</th>
	</tr>
	
	<?
	//foreach($arr AS $k=>$v){
	$chartArr=array();
	$total_year_arr = array();
	for($y=2021;$y<=date("Y",time());$y++){
		$total_year=0;
		echo "<tr>";
		echo "<th>".$y."</th>";
		for($i=1;$i<=12;$i++){
			
			(strlen($i)<2)?$ii='0'.$i:$ii=$i;
			if(!isset($arr[$y][$ii]['qt'])) {
				echo '<td class="zero">&ndash;</td>';
				$chartArr[$y][$ii]=0;
			}
			else{
				$chartArr[$y][$ii]=$arr[$y][$ii][$groupData];
				$total_year +=	$arr[$y][$ii][$groupData];
				if($groupData=='qt') 	echo '<td align="center">'.$arr[$y][$ii][$groupData].'</td>';
				else 					echo '<td align="right">'.number_format($arr[$y][$ii][$groupData], '2', ',', ' ').'</td>';
				
				$max_value[]=$arr[$y][$ii][$groupData];
				
			}// qt or uah			
		} // for month's
		$total_year_arr[$y] = $total_year;
		echo '<th align="right"><nobr>' . number_format($total_year, '2', ',', ' ') . '</nobr></th>';
		echo "</tr>";
		
	}// for years

	// Percentage CurYear vs PrevYear
	$curY=date("Y",time());
	echo "<th>".$curY." vs ".($curY-1)."</th>";
		$chartArrPercent=array();
		for($i=1;$i<=12;$i++){
			(strlen($i)<2)?$ii='0'.$i:$ii=$i;
			$curYqt=	(isset($arr[$curY][$ii][$groupData])?$arr[$curY][$ii][$groupData]:0);
			$prevYqt=	(isset($arr[$curY-1][$ii][$groupData])?$arr[$curY-1][$ii][$groupData]:0);
			$percentData=round(( (!isset($prevYqt)||$prevYqt==0)?	"100"	: (	($curYqt<$prevYqt)? ("-".((1-$curYqt/$prevYqt)*100)) : (($curYqt/$prevYqt-1)*100)	)),2);
			echo '<td align="center">'.$percentData.'%</td>';
			$chartArrPercent[$ii]= ($percentData=='-100'?'0':$percentData);
		}
		
	//	print_r($chartArrPercent);$total_year_arr[$curY-1]
	
	$cur_year_percent='';
	if($total_year_arr[$curY]<$total_year_arr[$curY-1]){
		$cur_year_percent.= "– ";
		$cur_year_percent .= round(((1-$total_year_arr[$curY]/$total_year_arr[$curY-1])*100),2);
	}
	else {
		$cur_year_percent .= round((($total_year_arr[$curY]/$total_year_arr[$curY-1] - 1)*100) , 2);
	}
	$cur_year_percent.=" %";
	echo "<th>". $cur_year_percent . "</th>";
	echo "</tr><tr>";
	// Percentage PrevYear vs PrevPrevYear
	
	$prev_year_percent='';
	if($total_year_arr[$curY-1]<$total_year_arr[$curY-2]){
		$prev_year_percent.= "– ";
		$prev_year_percent .= round(((1-$total_year_arr[$curY-1]/$total_year_arr[$curY-2])*100),2);
	}
	else {
		$prev_year_percent .= round((($total_year_arr[$curY-1]/$total_year_arr[$curY-2] - 1)*100) , 2);
	}
	$prev_year_percent.=" %";
	
	$curY=date("Y",time());
	echo "<th>".($curY-1)." vs ".($curY-2)."</th>";
		$chartArrPercentPrevPeriod=array();
		for($i=1;$i<=12;$i++){
			(strlen($i)<2)?$ii='0'.$i:$ii=$i;
			$prevYqt=	(isset($arr[$curY-1][$ii][$groupData])?$arr[$curY-1][$ii][$groupData]:0);
			$prevPrevYqt=	(isset($arr[$curY-2][$ii][$groupData])?$arr[$curY-2][$ii][$groupData]:0);
			$percentData=round(( (!isset($prevPrevYqt)||$prevPrevYqt==0)?	"100"	: (	($prevYqt<$prevPrevYqt)? ("-".((1-$prevYqt/$prevPrevYqt)*100)) : (($prevYqt/$prevPrevYqt-1)*100)	)),2);
			echo '<td align="center">'.$percentData.'%</td>';
			$chartArrPercentPrevPeriod[$ii]= ($percentData=='-100'?'0':$percentData);
		}
		
	//	print_r($chartArrPercentPrevPeriod);
	echo "<th>".$prev_year_percent."</th>";
?>	
	</tr>				
</table>


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
		
        echo "{\r\n";
          echo "name: '".$curY." vs ".($curY-1)."',\r\n";
          echo "type: 'line',\r\n";
          echo "data: ['".str_replace("'null'", "null", implode("','",str_replace(",",".",($chartArrPercent))))."']\r\n";
		echo "}\r\n";
		echo ",";
		echo "{\r\n";
          echo "name: '".($curY-1)." vs ".($curY-2)."',\r\n";
          echo "type: 'line',\r\n";
          echo "data: ['".str_replace("'null'", "null", implode("','",str_replace(",",".",($chartArrPercentPrevPeriod))))."']\r\n";
		echo "}\r\n";
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
          text: 'Продажі по вибраних категріях товарів',
          align: 'left',
          offsetX: 110
        },
        xaxis: {
          categories: ['Січ','Лют','Бер','Кві','Тра','Чер','Лип','Сер','Вер','Жов','Лис','Гру'],
        },
        yaxis: [
        <?foreach($chartArr AS $k=>$v){?>
        {
            seriesName: '<?=$k?>',
            show: <?echo ($k==date("Y",time()))?"true":"false"?>,
            opposite: true,
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
          <?} // foreach?>

          {
            seriesName: <?echo "'".$curY." vs ".($curY-1)."',\r\n";?>
            max: 150,
            min: -40,
            axisTicks: {
              show: true,
            },
            axisBorder: {
              show: true,
              color: '#8b76d7'
            },
            labels: {
              style: {
                colors: '#8b76d7',
              }
            },
            title: {
              text: "Порівняння <?=$curY?> до <?=($curY-1)?>р (%)",
              style: {
                color: '#8b76d7',
              }
            },
            tooltip: {
              enabled: true
            }
          },
         
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