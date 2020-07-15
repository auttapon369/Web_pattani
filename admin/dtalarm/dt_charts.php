<html>
<head>
<title></title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 <!-- <script src="http://code.highcharts.com/highcharts.js"></script>  -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

</head>
<body>
<?
	$site_id = $_POST['site_id'];
	$type = $_POST['type'];
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	$sta = explode("-", $site_id);
	$ssite=$sta[0];	

	if($ssite =="" )
	{
		echo "<p align=\"center\"><font color=\"red\">กรุณาเลือกสถานี</font></p>"; 
	}
	else if($ssite <>"" and $type =="900")
	{
		echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>"; 
	}

		if($type=="501")
		{	$sensor="สถานะ AIS";	
			$aa="*** 1=ปกติ,0=ผิดปกติ";}
		elseif($type=="502")
		{	$sensor="สถานะ DTAC";
			$aa="*** 1=ปกติ,0=ผิดปกติ";}
		elseif($type=="601")
		{	$sensor="สถานะ PEA";	
			$aa="***0=ปกติ,1=ผิดปกติ";}
		elseif($type=="701")
		{	$sensor="สถานะประตู";	
			$aa="***0=ปิด,1=เปิด";}
		elseif($type=="702")
		{	$sensor="สถานะ ACSurge";	
			$aa="***0=ปกติ,1=ผิดปกติ";}
		elseif($type=="703")
		{	$sensor="สถานะ Battary";
			$aa="***0=ปกติ,1=ผิดปกติ";}
		else{}

	$ss="SELECT STN_ID,STN_NAME_THAI FROM [PATTANI].[dbo].[TM_STN] where STN_ID='$ssite'";
    $ress = mssql_query($ss);
    $namesta=mssql_fetch_array($ress);
    $stationss=$namesta['STN_ID'];
	//$sname=$namesta['STN_CODENEW'];
	$namethai=$namesta['STN_NAME_THAI'];
	$Dname=iconv('TIS-620', 'UTF-8', $namethai);

	$ddate="select top 1 datepart(DD,DB.DT) dday,datepart(MM,DB.DT) dmm,datepart(YY,DB.DT) dyy ,convert(varchar(10),DB.DT,120) dt ,
	datepart(DD,DB1.DT) dday1,datepart(MM,DB1.DT) dmm1,datepart(YY,DB1.DT) dyy1 ,convert(varchar(10),DB1.DT,120) dt1
	from [PATTANI].[dbo].[DATA_Backup] DB,[PATTANI].[dbo].[DATA_Backup] DB1 where DB.DT='$date1' and DB1.DT='$date2'";
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
	
		$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '$type' then CONVERT(decimal(10,2),Value) end) avalue 
		FROM [PATTANI].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date1 23:59' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite' 
		and sensor_id = '$type' group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120)  ";

		
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

			<div id="container" class="span6" style="min-width: 400px; height: 450px; margin: 0 auto"></div>
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
							title: {
							enabled: true,
							text: '<?php echo $aa;?>'
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
							//categories: [<?php echo $categories;?>]
								
						},
						yAxis: {
							//min: '<?php echo $minva;?>',
							title: {
								text: '<?php echo $sensor;?>'
							}
						},
						legend: {
							layout: 'vertical',
							backgroundColor: '#FFFFFF',
							align: 'left',
							verticalAlign: 'top',
							x: 50,
							y: -4,
							floating: true,
							shadow: true
						},
						tooltip: {
							formatter: function() {
							return  Highcharts.dateFormat('%e. %B %Y %H:%M',this.x) + '<br><b>' + this.y +'</b>'+'';
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