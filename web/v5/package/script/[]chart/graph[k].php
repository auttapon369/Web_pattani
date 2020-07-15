<?php
// include
$_b = "../../../";
include($_b.'data/config.php');
include($_b.'package/class/index.php');

$conn = connDB("odbc");

// var
/*
$_id = $_POST['id'];
$_view = $_POST['view'];
$_format = $_POST['format'];
$_date1 = $_POST['date1'];
$_date2 = $_POST['date2'];
*/
$_id = "Tpat.5";
$_view = "RF";
$_format = "15MIN";
$_date1 = date('Y-m-d');
$_date2 = $_date1;


// echo
//echo $_id." / ".$_view." / ".$_format." / ".$_date1." / ".$_date2."<BR>";

?>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_b.$_cfg_path['js'] ?>jquery-1.10.2.min.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_b.$_cfg_path['js'] ?>chart/highstock.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_b.$_cfg_path['js'] ?>chart/exporting.js"></SCRIPT>
<DIV ID="show">Soon...</DIV>

<?
$nametype="กราฟ".$_cfg_data_type["rf"][0]; 
$yname=$_cfg_data_type["rf"][1];
$yaname=$_cfg_data_type["rf"][0]." ".$_cfg_data_type["rf"][1];
$typess="column";
$minva=0;
$maxva=100;

if($_format=="15MIN")
{
	$p_date=date("Y-m-d",strtotime($_date1));
	$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
	$pointIn= 900 * 1000; // 15 min
	$mmdate=date("m",strtotime($_date1))-1;
	$formatdd="%e. %B %Y %H:%M";
	$minva = $maxva = null;
	$a=15;
	$b=900;

	$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate,Sum(case when STN_ID='".$_id."' and sensor_id='100' then Value  end) RF FROM [dbo].[DATA_Backup]  WHERE CONVERT(varchar(16),DT,121) between '".$_date1." 00:00' and '".$_date2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
	GROUP BY CONVERT(varchar(16),DT,121) ORDER BY CONVERT(varchar(16),DT,121)";


	$result = odbc_exec($conn,$strQuery);
	//$checkrow=mssql_num_rows($result);

	$stagearray=array();
	$wt_pt=array();
	
	
	$stadatey=date("Y",strtotime($_date1));	
	$stadatem=date("m",strtotime($_date1));	
	$stadated=date("d",strtotime($_date1));

	$stadateh=date("H",strtotime($_date1));
	$stadatei=date("i",strtotime($_date1));
			
	$sm=$stadatey."-".$stadatem;
	
	if ($_format=="15MIN")
	{
		$stadate=strtotime($_date1);
		$enddate=strtotime($_date2)+86400;
	}
	else{}

	while($stadate < $enddate)
	{

		if ($row = odbc_fetch_array($result))
		{
			
			$sname=strtotime($row['adate']);
			
			while($stadate < $sname)
			{
				
				array_push($wt_pt,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
				
				if ($_format=="f_15")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}
			
			}

			
			if($row['RF']==null){$val_pt="null";}else{$val_pt=$row['RF'];}
			array_push($wt_pt,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt."]");

			
			if ($_format=="15MIN")
			{
				$stadatei+=$a;
				$stadate+=$a*60;
			}
		
		}
		else
		{
				
			array_push($wt_pt,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
			
			if ($_format=="15MIN")
			{
				$stadatei+=$a;
				$stadate+=$a*60;
			}						
		}
	}
	
	
	$ponts_Pt=implode(",",$wt_pt);
	
  
	$se_Pt='
			{
			type: "column",
			name: "'.$_id.'",
			data: ['.$ponts_Pt.'],
			color: "#228B22",
			lineWidth: 1,
			dashStyle:"solid"
			
			}';
}
else
{}
?>
<script type="text/javascript">
//alert("aa");
$(function () {
	var chart;
	$(document).ready(function() {
		Highcharts.setOptions({
		lang: {
			months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
	});
		chart = new Highcharts.Chart({
			chart: {
				zoomType: 'x',
				renderTo: 'show',
				type: 'column',
				spacingLeft: 25 ,
				resetZoomButton: {
					position: {
					// align: 'right', // by default
					 // verticalAlign: 'top', // by default
					x: -30,
					y: -20
					}
				}
			},
			credits: {
			enabled: false
			},
			title: {
				text: '<? echo $nametype;?>',
			
			style: {
				fontSize: '14px'
			}
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				type: 'datetime',
				//maxZoom: <? echo $maxZ;?>,
				minRange: '<? echo $a;?>' * 60 * 1000 * 6,
				minTickInterval: '<? echo $a;?>' * 60 * 1000,
				title: {
					text: null
				},
				labels:{
				rotation:-45,
				align:'right',
				fontSize: '8px'
					},
				dateTimeLabelFormats: {
				second: '%H:%M:%S',
				minute: '%H:%M',
				hour: '%H:%M',
				day: '%e %B %Y',
				week:'%e %B %Y',
				month:'%B %Y',
				year:'%Y'
			}
			},
			yAxis: {
				min: '<? echo $minva;?>',
				title: {
					text: '<? echo $yaname;?>'
				}
			},
			tooltip: {
				formatter: function() {
				return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+'  มม.';
			}
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				},
				series: {
				marker: {
					enabled:false,
					lineWidth: 0
				}
				}
				},
				scrollbar: {
				 enabled: true
				},
				series: [
					 <?php echo $se_Pt?>
					]
				,
				exporting: {
			 url: 'http://telepattani.com/exporting_server/index.php'
		  }
		});
	});

});
</script>