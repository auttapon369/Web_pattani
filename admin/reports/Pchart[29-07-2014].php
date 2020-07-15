<a href="./?menu=charts&view=RF&site_id=<?=$site_id?>&type=<?=$type?>&date1=<?=$date1?>&date2=<?=$date2?>">กราฟน้ำฝน</a>
<a href="./?menu=charts&view=WL&site_id=<?=$site_id?>&type=<?=$type?>&date1=<?=$date1?>&date2=<?=$date2?>">กราฟระดับน้ำ</a>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 <!-- <script src="http://code.highcharts.com/highcharts.js"></script>  -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<?
	$site_id = $_GET['site_id'];
	$type = $_GET['type'];
	$date1 = $_GET['date1'];
	$date2 = $_GET['date2'];
	$dt1=date('Y-m',strtotime($date1));
	$dt2=date('Y-m',strtotime($date2));
	$dtyy=date('Y',strtotime($date1));
	$sta = explode("-", $site_id);
	$ssite=$sta[0];

	$namedt1=setdatetime(date($date1),"DD/MM/YYYY");
	$namedt2=setdatetime(date($date2),"DD/MM/YYYY");

	$ddate="select top 1 datepart(DD,DB.DT) dday,datepart(MM,DB.DT) dmm,datepart(YY,DB.DT) dyy ,convert(varchar(10),DB.DT,120) dt ,
	datepart(DD,DB1.DT) dday1,datepart(MM,DB1.DT) dmm1,datepart(YY,DB1.DT) dyy1 ,convert(varchar(10),DB1.DT,120) dt1
	from [KOLOK].[dbo].[DATA_Backup] DB,[KOLOK].[dbo].[DATA_Backup] DB1 where DB.DT='$date1' and DB1.DT='$date2'";
	$dda = mssql_query($ddate);
    $ndd=mssql_fetch_array($dda);
	$sday=$ndd['dday'];
	$smm=$ndd['dmm'];
	$syy=$ndd['dyy'];
	$dt=$ndd['dt'];
	$sday1=$ndd['dday1'];
	$smm1=$ndd['dmm1'];
	$syy1=$ndd['dyy1'];
	$dt1=$ndd['dt1'];

	$compare_T=DateDiff($date1,$date2);
	
	$dta = (int)$sday." ".dmonth($smm)."พ.ศ.".dyear($syy);
	$dta1 = (int)$sday1." ".dmonth($smm1)."พ.ศ.".dyear($syy1);

	if($compare_T < 1)
	{
		$namedateshow="วันที่  $dta";
	}
	else
	{
		$namedateshow="ระหว่างวันที่  $dta ถึง $dta1";
	}

	 function dmonth($ddlM)
	{
				if($ddlM=="01" or $ddlM=="1")	{	    $mm="มกราคม";}
				elseif($ddlM=="02" or $ddlM=="2")	{	$mm="กุมภาพันธ์ ";}
				elseif($ddlM=="03" or $ddlM=="3")	{	$mm="มีนาคม ";}
				elseif($ddlM=="04" or $ddlM=="4")	{	$mm="เมษายน ";}
				elseif($ddlM=="05" or $ddlM=="5")	{	$mm="พฤษภาคม ";}
				elseif($ddlM=="06" or $ddlM=="6")	{	$mm="มิถุนายน ";}
				elseif($ddlM=="07" or $ddlM=="7")	{	$mm="กรกฎาคม ";}
				elseif($ddlM=="08" or $ddlM=="8")	{	$mm="สิงหาคม ";}
				elseif($ddlM=="09" or $ddlM=="9")	{	$mm="กันยายน ";}
				elseif($ddlM=="10")	{	$mm="ตุลาคม ";}
				elseif($ddlM=="11")	{	$mm="พฤศจิกายน ";}
				else{	$mm=" ธันวาคม";}
		return $mm;
	}

	function dyear($ddly)
	{
				if($ddly=="2012"){$yy="2555";}
				elseif($ddly=="2013"){$yy="2556 ";}
				elseif($ddly=="2014"){$yy="2557 ";}
				elseif($ddly=="2015"){$yy="2558 ";}
				elseif($ddly=="2016"){$yy="2559 ";}
				elseif($ddly=="2017"){$yy="2560 ";}
				else{$ddly=" 2561";}		
				return $yy;
	}


	
	$ss="SELECT STN_ID,STN_CODE,STN_NAME_THAI FROM [KOLOK].[dbo].[TM_STN] where STN_ID='$ssite'";
    $ress = mssql_query($ss);
    $namesta=mssql_fetch_array($ress);
    $stationss=$namesta['STN_ID'];
	$sname=$namesta['STN_CODENEW'];
	$namethai=$namesta['STN_NAME_THAI'];
	$Dname=iconv('TIS-620', 'UTF-8', $namethai);

/*-----------------------------select data------------------------------------*/
	if($view=="RF")
	{
		$nametype="กราฟปริมาณน้ำฝน"; 
		$yname="มม.";
		$yaname="ปริมาณน้ำฝน มม.";
		$typess="column";
		$minva=0;
		$maxva=100;

		$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
		FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date2 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite' and sensor_id = '100' 
		group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";


		$result = mssql_query($strQuery); 
	  // while ($row_rs_tu01 = odbc_fetch_array($result));	
		$stagearray=array();
		$wt_arr=array();

		$stadate=strtotime($date1);
		while($row = mssql_fetch_array($result))
			{
				//$sname=date("d-m-y H:i",strtotime($row['adate']));
				$sname=strtotime($row['adate']);
				//echo "A".date("d-m-y H:i",$sname)." ";
				while ($stadate < $sname)
					{
						array_push($stagearray,$stadate);
						array_push($wt_arr, 'null');
						$stadate = $stadate + 900;
						
					}
				$stadate = $stadate + 900;
				array_push($stagearray,$sname);
				array_push($wt_arr,$row["avalue"]);
			}

		$categories=implode(",",$stagearray);
		$ponts_str=implode(",",$wt_arr);

			?>
			<br>
			<div id="container" class="span6" style="min-width: 1350px; height: 550px; margin: 0 auto"></div>
			<script type="text/javascript">
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
							renderTo: 'container',
							type: 'column',
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
							text: '<?php echo $nametype." ".$namedateshow;?>',
						
						style: {
							fontSize: '14px'
						}
						},
						subtitle: {
							text: ''
						},
						xAxis: {
							//tickInterval: <?php echo $rowx;?>,
							type: 'datetime',
							maxZoom: 2 * 3600000,
							//maxZoom: 20, 
							labels:{
								rotation:-45,
								align:'right',
								fontSize: '8px'
									},
							dateTimeLabelFormats: {
							day: '%e %B %Y',
							week:'%e %B %Y',
							month:'%B %Y',
							year:'%Y'
							}
							//categories: [<?php echo $categories;?>]
								
						},
						yAxis: {
							min: '<?php echo $minva;?>',
							title: {
								text: '<?php echo $yaname;?>'
							}
						},
						legend: {
							layout: 'vertical',
							backgroundColor: '#FFFFFF',
							align: 'left',
							verticalAlign: 'top',
							x: 20,
							y: -4,
							floating: true,
							shadow: true
						},
						tooltip: {
							formatter: function() {
							return  Highcharts.dateFormat('%e. %B %Y %H:%M',this.x) + '<br><b>' + this.y +'</b>'+'  มม.';
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
								enabled: true },								
							series: [{
								pointInterval:900 * 1000,
							name: 'สถานี <?php echo $Dname;?>',
							pointStart: Date.UTC(<?php echo $syy ;?>, <?php echo $smm-1 ;?>, <?php echo $sday ;?>),
							data: [<?php echo $ponts_str;?>]

						}]
					});
				});

			});
			</script>
	<?
	}
	else if($view=="WL")
	{
		$nametype="กราฟระดับน้ำ";
		$yname="เมตร.รทก.";
		$yaname="ระดับน้ำ เมตร.รทก.";
		$typess="line";

		
	   	$strQ="select min(case sensor_id when '200' then CONVERT(float,Value-0.01) end) avalue,max(case sensor_id when '200' then CONVERT(float,Value+0.01) end) bvalue FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date2 23:45' and STN_ID='$ssite' group BY SUBSTRING(convert(varchar, DT,20), 1, 4 ) order by SUBSTRING(convert(varchar, DT,20), 1, 4 )";		

		$ress = mssql_query($strQ);
		$mvalue=mssql_fetch_array($ress);
		$miva=$mvalue['avalue'];
		$mava=$mvalue['bvalue'];

		$minva=$miva; 
		$maxva=$mava;

		$stralarm="select stn_id,CONVERT(decimal(10,1),Alram_L1) a_L1,CONVERT(decimal(10,1),Alram_L2) a_L2,CONVERT(float,Alram_L2+10) alarm FROM [KOLOK].[dbo].[TM_STN] where STN_ID='$ssite' ";	
		$realarm = mssql_query($stralarm);
		$malarm=mssql_fetch_array($realarm);
		$A_L1=$malarm['a_L1'];
		$A_L2=$malarm['a_L2'];
		$A_alarm=$malarm['alarm'];	
			
		$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '200' then CONVERT(decimal(10,2),Value) end) avalue 
		FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date2 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite' and sensor_id = '200'   
		and Value < '$A_alarm' group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120)";

	   $result = mssql_query($strQuery); 
	  // while ($row_rs_tu01 = odbc_fetch_array($result));	
		$stagearray=array();
		$wt_arr=array();

		//$stadate=date("d-m-y H:i",strtotime($date1));
		$stadate=strtotime($date1);
		while($row = mssql_fetch_array($result))
			{
				//$sname=date("d-m-y H:i",strtotime($row['adate']));
				$sname=strtotime($row['adate']);
				//echo "A".date("d-m-y H:i",$sname)." ";
				while ($stadate < $sname)
					{
						array_push($stagearray,$stadate);
						array_push($wt_arr, 'null');
						//$stadate = date("d-m-y H:i",strtotime($stadate)+ 900);
						$stadate = $stadate + 900;
						//$stadate += 900;
						//echo "B".date("d-m-y H:i",$stadate)." ";
						//echo $stadate=date("d-m-y H:i",strtotime($ddates));
					}
				//$stadate=date("d-m-y H:i",strtotime($stadate)+ 900);
				$stadate = $stadate + 900;
				//$stadate += 900;
				//echo "C".date("d-m-y H:i",$stadate)." ";
				array_push($stagearray,$sname);
				array_push($wt_arr,$row["avalue"]);
			}
			$categories=implode(",",$stagearray);
			$ponts_str=implode(",",$wt_arr);



			?>

			<div id="WL" class="span6" style="min-width: 1350px; height: 550px; margin: 0 auto"></div>
			<script type="text/javascript">

			$(function () {
				var chart;
				$(document).ready(function() {

					Highcharts.setOptions({
					lang: {
						months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
				});

					$('#WL').highcharts({
						chart: {
							zoomType: 'x',
							spacingRight: 20,
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
							text: '<?php echo $nametype." ".$namedateshow;?>',
							x: -20, //center
						style: {
							fontSize: '14px'
						}
						},
						subtitle: {
						text: '<span style="color: #EEAD0E"> เฝ้าระวัง <?echo $A_L1;?> ม.รทก. </span> <br> <span style="color: #EE0000">วิกฤติ <? echo $A_L2;?> ม.รทก.</span>',
						//floating: true,
						//align: 'right',
						style: {
							fontSize: '12px'
							},
						verticalAlign: 'bottom',
						x: 420,
						y: -470
						},		
						xAxis: {
							type: 'datetime',
							maxZoom: 2 * 3600000, // 1 days
							title: {
								text: null
							},
							labels:{
							rotation:-45,
							align:'right',
							fontSize: '8px'
								},
							dateTimeLabelFormats: {
							day: '%e %B %Y',
							week:'%e %B %Y',
							month:'%B %Y',
							year:'%Y'
						}
						},
					   yAxis: {
							min: '<?php echo $minva;?>',
							title: {
								text: '<?php echo $yaname;?>'
							}/*,
							plotLines : [{
							value :  183.46,
							color : '#EEAD0E',
							dashStyle : 'dash',
							width : 2,
							label : {
								text : 'เฝ้าระวัง <?echo $A_L1;?> ม.รทก.',
								align: 'right',
								style: {
									color: '#EEAD0E'
									//fontWeight: 'bold'
							 }
							}
							}]*/
						},
						tooltip: {
							formatter: function() {
							return  Highcharts.dateFormat('%e. %B %Y %H:%M',this.x) + '<br><b>' + this.y +'</b>'+'  เมตร.รทก.';
						}
						},
						legend: {
							layout: 'vertical',
							backgroundColor: '#FFFFFF',
							align: 'left',
							verticalAlign: 'top',
							x: 10,
							y: -4,
							floating: true,
							shadow: true
						},

						/*plotOptions: {
							area: {
								fillColor: {
									linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
									stops: [
										[0, Highcharts.getOptions().colors[0]],
										[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
									]
								},
								lineWidth: 1,
								marker: {
									enabled: false
								},
								shadow: false,
								states: {
									hover: {
										lineWidth: 1
									}
								},
								threshold: null
							}
						},  */  
						scrollbar: {
							 enabled: true
						 },
						series: [{
							type: 'area',
							pointInterval:900 * 1000,
							name: 'สถานี <?php echo $Dname;?> ',
							lineWidth: 1,
							pointStart: Date.UTC(<?php echo $syy ;?>, <?php echo $smm-1 ;?>, <?php echo $sday ;?>),
							 data: [<?php echo $ponts_str;?>]

						}
						]
					});
				});

			});
			</script>

	<?
	}
	else{}

?>
<script type="text/javascript">
/*function showChart(id)
{
	$("#"+id).show();
	//alert(id);
}
//showChart("#RF");
</script>