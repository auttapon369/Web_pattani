<DIV ID="show">Page not found.</DIV>
<?php
$_b = "../../../";
include($_b.'data/config.php');
include($_b.'package/class/index.php');
$conn = connDB("odbc");
$call = new General();
$_id = ( !empty($_POST['id']) ) ? $_POST['id'] : "Tpat.5";
$_view = ( !empty($_POST['id']) ) ? $_POST['view'] : "RF";
$_format = ( !empty($_POST['id']) ) ? $_POST['format'] : "15MIN";
$date1 = explode(" ", $_POST['date1']);
$date2 = explode(" ", $_POST['date2']);
$_date1 = ( !empty($_POST['id']) ) ? $date1[0] : date('Y-m-d');
$_date2 = ( !empty($_POST['id']) ) ? $date2[0] : $_date1;

//echo $_id." / ".$_view." / ".$_format." / ".$_date1." / ".$_date2."<BR>";

//$nametype="กราฟ".$_cfg_data_type["rf"][0]." ".$call->dateReport($_date1, $_date2);
$nametype="กราฟ".$_cfg_data_type["rf"][0];
$yname=$_cfg_data_type["rf"][1];
$yaname=$_cfg_data_type["rf"][0]." (".$_cfg_data_type["rf"][1].")";
$typess="column";
$minva=0;
$maxva=100;
$colorgraph = $_cfg_color_sec;

if ( $_format=="15MIN" )
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
	
/*
	$se_Pt='
			{
			type: "column",
			name: "'.$_id.'",
			data: ['.$ponts_Pt.'],
			color: "#228B22",
			lineWidth: 1,
			dashStyle:"solid"
			
			}';
*/
}
?>
<!--
<SCRIPT TYPE="text/javascript" SRC="<?php //echo $_cfg_root.$_cfg_path['js'] ?>jquery-1.10.2.min.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php //echo $_cfg_root.$_cfg_path['js'] ?>chart/highstock.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php //echo $_cfg_root.$_cfg_path['js'] ?>chart/exporting.js"></SCRIPT>
-->
<SCRIPT TYPE="text/javascript">
var chart;
$(document).ready
(
	function()
	{
		Highcharts.setOptions
		(
			{
				lang: { months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'] }
			}
		);

		chart = new Highcharts.Chart
		(
			{
				chart:
				{
					height: 320,
					spacingLeft: 0,
					backgroundColor: 'rgba(255, 255, 255, 0.1)',
					type: 'column',
					renderTo: 'show',
					zoomType: 'x',
					resetZoomButton:
					{
						position:
						{
							//verticalAlign: 'top',
							//align: 'right',
							x: 0,
							y: -30
						}
					}
				},
				credits:
				{
					enabled: false
				},
				title:
				{
					//text: "<? echo $nametype;?>",
					text: " ",
					style:
					{
						fontSize: '18px'
					}
				},
				legend: {
					layout: 'vertical',
					align: 'left',
					verticalAlign: 'top',
					x: 0,
					y: 400,
					floating: true,
					borderWidth: 1,
					backgroundColor: '#FFFFFF'
				},
				subtitle:
				{
					text: ""
				},
				xAxis:
				{
					type: 'datetime',
					minRange: '<? echo $a;?>' * 60 * 1000 * 6,
					minTickInterval: '<? echo $a;?>' * 60 * 1000,
					title:
					{
						text: null
					},
					labels:
					{
						rotation: -45,
						align: 'right',
						fontSize: '8px'
					},
					dateTimeLabelFormats:
					{
						second: '%H:%M:%S',
						minute: '%H:%M',
						hour: '%H:%M',
						day: '%e %B %Y',
						week:'%e %B %Y',
						month:'%B %Y',
						year:'%Y'
					}
				},
				yAxis:
				{
					min: '<? echo $minva;?>',
					title:
					{
						margin: 20,
						text: '<? echo $yaname;?>'
					}
				},
				tooltip:
				{
					formatter: function()
					{
						return Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+'  มม.';
					}
				},
				plotOptions:
				{
					column:
					{
						pointPadding: 0.2,
						borderWidth: 0
					},
					series:
					{
						marker:
						{
							enabled: false,
							lineWidth: 0
						}
					}
				},
				scrollbar:
				{
					enabled: true
				},
				series:
				[
					{
						type: "column",
						//name: "<? echo $_id ?>",
						//name: "",
						data: [<? echo $ponts_Pt ?>],
						lineWidth: 1,
						dashStyle: "solid",
						color: "<? echo $colorgraph ?>"
					}
				],
				exporting:
				{
					enabled: false,
					url: 'http://telepattani.com/exporting_server/index.php'
				}
			}
		);
	}
);
</SCRIPT>