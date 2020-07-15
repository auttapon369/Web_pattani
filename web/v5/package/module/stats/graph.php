<!--<script type="text/javascript" src="../../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="chart/highstock.js"></script>
<script type="text/javascript" src="chart/exporting.js"></script>-->

<?

$conn = connDB("odbc");

$tdt = explode("-",$datetime);
if($tdt[1]=='02' AND $tdt[2]>28)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='04' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='06' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='09' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='11' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}


//$chcount = 0;
foreach($p_stn as $id)
{
	$_value = cut($id);
	$ssite = $_value[0];
	$nname = $_value[4];

	$s_rf = C_rf($_value[1],$p_rain);
	$s_wl = C_wl($_value[2],$p_water);
	$s_fl = C_fl($_value[3],$p_flow);

	//$chcount++;
	//echo $ssite."-".$chcount."<BR>";
}

//$chcount = 0;

$colors = array('','#228B22', '#528B8B', '#A0522D', '#483D8B', '#2F4F4F' , '#8B658B' , '#CD9B9B' , '#CD5555' , '#CD6839' , '#CD2626' , '#EE9A00' , '#CD6600' , '#CD0000' , '#CD1076' , '#8B4789' , '#C71585' , '#ECAB53' , '#008080' , '#00BB00' , '#778899' , '#97FFFF' , '#FFE4B5' , '#4876FF' , '#B0E0E6' , '#7CFC00' , '#2E8B57');

$v = array();
$e = array();
$rain = array();
$water = array();

foreach ( $p_stn as $index => $value )
{
		$n = $index + 1;
		$arr = explode('_', $value);
		$x = explode('.', $arr[0]);
		array_push($v, $x[1]);

		$v1 = "tn".$x[1];
		$$v1 = $arr[0];

		$v2 = "_namec".$x[1];
		$$v2 = $arr[1];

		$v3 = "_nrow".$x[1];
		$$v3 = str_replace('.', '', $arr[0]);

		$v4 = "cnumtn".$x[1];
		$$v4 = $n;

		/*-------check rain--------------*/
		if( $arr[2] == "1" )
		{
			array_push($rain, $x[1]);

			$v5 = "rf_tn".$x[1];
			$$v5 = array();
		}
		/*-------check water--------------*/

		if( $arr[3] == "1" )
		{
			array_push($water, $x[1]);

			$v6 = "wl_tn".$x[1];
			$$v6 = array();
		}

		//if( !in_array($arr[0], $_cfg_flow))
		//{	
			$v8 = "fl_tn".$x[1];
			$$v8 = array();
		//}
		
		/*-------check rain end--------------*/
		if( $arr[5] == "Y" )
		{
			array_push($e, $x[1]);

			$v7 = "wle_tn".$x[1];
			$$v7 = array();

			$v9 = "fle_tn".$x[1];
			$$v9 = array();
		}

}

if($p_rain=="Y")
{
	$nametype="กราฟ".$_cfg_data_type["rf"][0]; 
	$yname=$_cfg_data_type["rf"][1];
	$yaname=$_cfg_data_type["rf"][0]." ".$_cfg_data_type["rf"][1];
	$typess="column";
	$minva=0;
	$maxva=100;
    
	if($p_format=="f_15")
	{
		
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
				}
				
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY CONVERT(varchar(16),DT,121) ORDER BY CONVERT(varchar(16),DT,121)";
		
		$result = odbc_exec($conn,$strQuery);
		//$checkrow=mssql_num_rows($result);

		$stagearray=array();

		$stadatey=date("Y",strtotime($p_day1));	
		$stadatem=date("m",strtotime($p_day1));	
		$stadated=date("d",strtotime($p_day1));

		$stadateh=date("H",strtotime($p_day1));
		$stadatei=date("i",strtotime($p_day1));
				
		$sm=$stadatey."-".$stadatem;
		
		if ($p_format=="f_15")
		{
			$stadate=strtotime($p_day1);
			$enddate=strtotime($p_day2)+86400;
		}
		else{}

		while($stadate < $enddate)
		{

			if ($row = odbc_fetch_array($result))
			{
				
				$sname=strtotime($row['adate']);
				
				while($stadate < $sname)
				{
					foreach ( $v as $i )
					{
						if ( in_array($i, $rain) )
						{
							$x = "rf_tn".$i;
							array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						}
					}

					if ($p_format=="f_15")
					{
						$stadatei+=$a;
						$stadate+=$a*60;
					}
					

				}

				foreach ( $v as $i )
				{
					$vv = "val_tn".$i;
					$r = "_nrow".$i;
					$x = "rf_tn".$i;
					
					if ( in_array($i, $rain) )
					{
						if($row['RF_'.$$r.'']==null){$$vv ="null";}else{$$vv =$row['RF_'.$$r.''];}
						array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vv."]");
					}
				}

				if ($p_format=="f_15")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}
			
			}
			else
			{
				foreach ( $v as $i )
				{
					if ( in_array($i, $rain) )
					{
						$x = "rf_tn".$i;
						array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
				}

				if ($p_format=="f_15")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}						
			}
		}

	}
	else if($p_format=="f_hr")
	{
		$p_date=date("Y-m-d",strtotime($p_day1));
		$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
		$pointIn= 3600 * 1000; // 15 min
		$mmdate=date("m",strtotime($p_day1))-1;
		$formatdd="%e. %B %Y %H:%M";
		$minva = $maxva = null;
		$a=60;
		$b=3600;


		$start = strtotime($p_day1);
		$end = strtotime($p_day2)+86400;


		for ( $tt = $start; $tt <= $end; $tt += 3600 )
		{	
			$dt=date("Y-m-d H:i",$tt);

			$starhour=date("Y-m-d H:15",strtotime('-1 hour',strtotime($dt)));
			$endhour=date("Y-m-d H:00",strtotime($dt));

			//echo $starhour."<BR>";
			//echo $endhour."<BR>";

			$sumrain = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
			foreach($p_stn as $id)
			{
				$_value = cut($id);
				$ssite = $_value[0];
				$nname = $_value[4];

				$sumrain .=" ,CONVERT(decimal(38,2),SUM(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end)) vhour_".$nname." ";
			}					
			$sumrain .="FROM [dbo].[DATA_Backup] WHERE CONVERT(varchar(16),DT,121) between '".$starhour."' and '".$endhour."'";
				
			//echo $sumrain;
			$sumrf =odbc_exec($conn,$sumrain);
			
			//echo $dt."_";
			//echo $row['vhour_'.$_nrow2.'']."<BR>";
			
			$stadatey=date("Y",strtotime($dt));	
			$stadatem=date("m",strtotime($dt));	
			$stadated=date("d",strtotime($dt));
			$stadateh=date("H",strtotime($dt));
			$stadatei=date("i",strtotime($dt));
					
			$sm=$stadatey."-".$stadatem;

			$row=odbc_fetch_array($sumrf);

			foreach ( $v as $i )
			{
				$vv = "val_tn".$i;
				$r = "_nrow".$i;
				$x = "rf_tn".$i;
				
				if ( in_array($i, $rain))
				{
					if($row['vhour_'.$$r.'']==null){$$vv ="null";}else{$$vv =$row['vhour_'.$$r.''];}
					array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vv."]");
				}
			}

		}//for

	}
	else
	{

		$p_date=date("Y-m-d 07:00",strtotime($p_day1));
		$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
		$pointIn=  24 * 3600 * 1000; // 15 min
		$mmdate=date("m",strtotime($p_day1))-1;
		$formatdd="%e. %B %Y %H:%M";
		$minva = $maxva = null;
		$a=1440;
		$b=86400;

		$start = strtotime($p_day1);
		$end = strtotime($p_day2);
		
		$stagearray=array();
		for ( $tt = $start; $tt <= $end; $tt += 86400 )
		{	
			$dt=date("Y-m-d",$tt);
			
			if($p_format=="f_mean")
			{
				$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=" ,Sum(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
				}					
				$strQuery .=" FROM 	[dbo].[DATA_Backup]
						WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
						and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
			}
			elseif($p_format=="f_min")
			{
				$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=" ,min(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
				}					
				$strQuery .=" FROM 	[dbo].[DATA_Backup]
						WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
						and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
			}
			elseif($p_format=="f_max")
			{
				$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=" ,max(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
				}					
				$strQuery .=" FROM 	[dbo].[DATA_Backup]
						WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
						and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
			}
			else{}
		
			//echo $strQuery;
			$result = odbc_exec($conn,$strQuery);
			//$checkrow=odbc_num_rows($objExec);
			$date_now = $dt.' 07:00';
			

			$stadatey=date("Y",strtotime($date_now));	
			$stadatem=date("m",strtotime($date_now));	
			$stadated=date("d",strtotime($date_now));
			$stadateh=date("H",strtotime($date_now));
			$stadatei=date("i",strtotime($date_now));
					
			$sm=$stadatey."-".$stadatem;
			
			$stadate=strtotime($date_now);
			$enddate=strtotime($date_now)+86400;
			$row = odbc_fetch_array($result);

			foreach ( $v as $i )
			{
				$vv = "val_tn".$i;
				$r = "_nrow".$i;
				$x = "rf_tn".$i;
				
				if ( in_array($i, $rain) )
				{
					if($row['RF_'.$$r.'']==null){$$vv ="null";}else{$$vv =$row['RF_'.$$r.''];}
					array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vv."]");
				}
			}

		}
	}
		
	$se = array();
	foreach ( $v as $i )
	{
		//$ponts_tn1=implode(",",$wt_tn1);
		if ( in_array($i, $rain) )
		{
			$x = "rf_tn".$i;
			$p = "ponts_tn".$i;
			$$p = implode(",", $$x);
			$n = "_namec".$i;
			$s = '{
				type: "column",
				name: "'.$$n.'",
				data: ['.$$p.'],
				color: "'.$colors[$i].'",
				lineWidth: 1,
				dashStyle:"solid"
			}';

			array_push($se, $s);
		}
	}
	$ss = implode(",", $se);

	?>
	<BR>
	<div id="graphRF" style="<?echo $st;?>"></div>
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
					renderTo: 'graphRF',
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
					series: [<?php echo $ss?>]
					,
					exporting: {
				 url: 'http://telekpattani.com/exporting_server/index.php'
			  }
			});
		});

	});
	</script>
	<?	
}

if($p_water=="Y")
{
	$nametype="กราฟ".$_cfg_data_type["wl"][0]; 
	$yname=$_cfg_data_type["wl"][1];
	$yaname=$_cfg_data_type["wl"][0]." ".$_cfg_data_type["wl"][1];
	$typess="line";
	$wlH="หน้า ปตร.";
	$wlL="ท้าย ปตร.";

	if($p_format=="f_15" || $p_format=="f_hr")
	{
		if($p_format=="f_15")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
				}
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
				}
							
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE 
					CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY 
						CONVERT(varchar(16),DT,121)
					ORDER BY 
						CONVERT(varchar(16),DT,121)	";
		}
		elseif($p_format=="f_hr")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=60;
			$b=3600;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";	
			foreach($p_stn as $id)
			{
				$_value = cut($id);
				$ssite = $_value[0];
				$nname = $_value[4];

				$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
			}
			foreach($p_stn as $id)
			{
				$_value = cut($id);
				$ssite = $_value[0];
				$nname = $_value[4];

				$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
			}				
			$strQuery .=" FROM [dbo].[DATA_Backup]
						WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:00' 
							AND (DATEPART(MINUTE ,DT))='00'
						GROUP BY 
							CONVERT(varchar(16),DT,121)
						ORDER BY 
							CONVERT(varchar(16),DT,121)	";
		}
		else{}

		//echo $strQuery;
		$result = odbc_exec($conn,$strQuery);
		//$checkrow=mssql_num_rows($result);

		$stagearray=array();
		
				$stadatey=date("Y",strtotime($p_day1));	
				$stadatem=date("m",strtotime($p_day1));	
				$stadated=date("d",strtotime($p_day1));

				$stadateh=date("H",strtotime($p_day1));
				$stadatei=date("i",strtotime($p_day1));
						
				$sm=$stadatey."-".$stadatem;
				
				if ($p_format=="f_15" or $p_format=="f_hr")
				{
					$stadate=strtotime($p_day1);
					$enddate=strtotime($p_day2)+86400;
				}
				else{}
		
				while($stadate < $enddate)
				{

					if ($row = odbc_fetch_array($result))
					{
						
						$sname=strtotime($row['adate']);
						
						while($stadate < $sname)
						{
							foreach ( $v as $i )
							{
								if ( in_array($i, $water))
								{
									$x = "wl_tn".$i;
									array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								}

								if ( in_array($i, $e) )
								{
									$y = "wle_tn".$i;
									array_push($$y,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								}
							}

							if ($p_format=="f_15" or $p_format=="f_hr")
							{
								$stadatei+=$a;
								$stadate+=$a*60;
							}
						
						}

						foreach ( $v as $i )
						{
							if ( in_array($i, $water))
							{
								$vv = "val_tn".$i;
								$r = "_nrow".$i;
								$x = "wl_tn".$i;
								
								if($row['WL_'.$$r.'']==null){$$vv ="null";}else{$$vv =$row['WL_'.$$r.''];}
								array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vv."]");
							}
							if ( in_array($i, $e) )
							{
								$ve = "vale_tn".$i;
								$re = "_nrow".$i;
								$y = "wle_tn".$i;

								if($row['WLE_'.$$re.'']==null){$$ve ="null";}else{$$ve =$row['WLE_'.$$re.''];}
								array_push($$y,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$ve."]");
							}
						}

						if ($p_format=="f_15" or $p_format=="f_hr")
						{
							$stadatei+=$a;
							$stadate+=$a*60;
						}
					
					}
					else
					{
						foreach ( $v as $i )
						{
							if ( in_array($i, $water))
							{
								$x = "wl_tn".$i;
								array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if ( in_array($i, $e) )
							{
								$y = "wle_tn".$i;
								array_push($$y,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
						}
						
						if ($p_format=="f_15" or $p_format=="f_hr")
						{
							$stadatei+=$a;
							$stadate+=$a*60;
						}							
					}
				}
	}
	else
	{

			$p_date=date("Y-m-d 07:00",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn=  24 * 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=1440;
			$b=86400;

			$start = strtotime($p_day1);
			$end = strtotime($p_day2);

			for ( $tt = $start; $tt <= $end; $tt += 86400 )
			{	
				$dt=date("Y-m-d",$tt);
				
				if($p_format=="f_mean")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_min")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_max")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				else{}
			
				//echo $strQuery;
				$result = odbc_exec($conn,$strQuery);
				//$checkrow=odbc_num_rows($objExec);
				$date_now = $dt.' 07:00';
				

				$stadatey=date("Y",strtotime($date_now));	
				$stadatem=date("m",strtotime($date_now));	
				$stadated=date("d",strtotime($date_now));
				$stadateh=date("H",strtotime($date_now));
				$stadatei=date("i",strtotime($date_now));
						
				$sm=$stadatey."-".$stadatem;
				
				$stadate=strtotime($date_now);
				$enddate=strtotime($date_now)+86400;
				$row = odbc_fetch_array($result);
		
				foreach ( $v as $i )
				{
					if ( in_array($i, $water))
					{
						$vv = "val_tn".$i;
						$r = "_nrow".$i;
						$x = "wl_tn".$i;
						
						if($row['WL_'.$$r.'']==null){$$vv ="null";}else{$$vv =$row['WL_'.$$r.''];}
						array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vv."]");
					}
					if ( in_array($i, $e) )
					{
						$ve = "vale_tn".$i;
						$re = "_nrow".$i;
						$y = "wle_tn".$i;

						if($row['WLE_'.$$re.'']==null){$$ve ="null";}else{$$ve =$row['WLE_'.$$re.''];}
						array_push($$y,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$ve."]");
					}
				}		

			}
		}

		$se = array();
		$see = array();
		foreach ( $v as $i )
		{
			if ( in_array($i, $water))
			{
				$x = "wl_tn".$i;
				$p = "ponts_tn".$i;
				$$p = implode(",", $$x);
				$n = "_namec".$i;
				$s = '{
					type: "line",
					name: "'.$$n.'",
					data: ['.$$p.'],
					color: "'.$colors[$i].'",
					lineWidth: 1,
					dashStyle:"solid"
				}';

				array_push($se, $s);
			}
			if ( in_array($i, $e) )
			{
				$y = "wle_tn".$i;
				$pe = "pontse_tn".$i;
				$$pe = implode(",", $$y);
				$n = "_namec".$i;
				$en = '{
					type: "line",
					name: "'.$$n."_E".'",
					data: ['.$$pe.'],
					color: "'.$colors[$i].'",
					lineWidth: 1,
					dashStyle:"shortdot"
				}';
				array_push($see, $en);
			}
		}
		$ss = implode(",", $se);
		$sss = implode(",", $see);

		?>
		<BR>
		<div id="graphWL" style="<?echo $st;?>"></div>
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
							renderTo: 'graphWL',
							type: 'line',
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
							day: '%e %B %Y',
							week:'%e %B %Y',
							month:'%B %Y',
							year:'%Y'
						}
						},
						yAxis: {
							//min: '<? echo $minva;?>',
							minRange: 0.1,
							minTickInterval: 0.1,
							minPadding: 0,
							maxPadding: 0,
							title: {
								text: '<? echo $yaname;?>'
							}
						},
						tooltip: {
							formatter: function() {
							return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+' <? echo $yname;?>';
						}
						},
						plotOptions: {
							series:{marker:{enabled:false}}
						},
						scrollbar: {
							 enabled: true
						},
						series: [
								 <?php echo $ss?>,
								  <?php echo $sss?>
								 ]
							,
							exporting: {
                         url: 'http://telekpattani.com/exporting_server/index.php'
                      }
					});
				});

			});
			</script>
		<?	
}


if($p_flow=="Y")
{
	$nametype="กราฟ".$_cfg_data_type["fl"][0]; 
	$yname=$_cfg_data_type["fl"][1];
	$yaname=$_cfg_data_type["fl"][0]." ".$_cfg_data_type["fl"][1];
	$typess="line";
	$flH=$_cfg_data_type_3[0];
	$flL="อัตราการไหล ท้าย ปตร.";

	$yname2=$_cfg_data_type["wl"][1];
	$yaname2=$_cfg_data_type["wl"][0]." ".$_cfg_data_type["wl"][1];
	$wlH=$_cfg_data_type["wl"][0];
	$wlL="ท้าย ปตร.";
    
	if($p_format=="f_15" || $p_format=="f_hr")
	{
		if($p_format=="f_15")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];
					
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname." ";
				}
				
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY CONVERT(varchar(16),DT,121)	ORDER BY CONVERT(varchar(16),DT,121)";
		}
		elseif($p_format=="f_hr")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=60;
			$b=3600;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";	
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];
					
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname."	";
				}
				
				$strQuery .=" FROM [dbo].[DATA_Backup]
							WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:00' 
								AND (DATEPART(MINUTE ,DT))='00'
							GROUP BY 
								CONVERT(varchar(16),DT,121)
							ORDER BY 
								CONVERT(varchar(16),DT,121)	";
		}
		else{}

		$result = odbc_exec($conn,$strQuery);
		//$checkrow=mssql_num_rows($result);

		$stadatey=date("Y",strtotime($p_day1));	
		$stadatem=date("m",strtotime($p_day1));	
		$stadated=date("d",strtotime($p_day1));

		$stadateh=date("H",strtotime($p_day1));
		$stadatei=date("i",strtotime($p_day1));
				
		$sm=$stadatey."-".$stadatem;
		
		if ($p_format=="f_15" or $p_format=="f_hr")
		{
			$stadate=strtotime($p_day1);
			$enddate=strtotime($p_day2)+86400;
		}
		else{}

		while($stadate < $enddate)
		{

			if ($row = odbc_fetch_array($result))
			{
				$sname=strtotime($row['adate']);
				
				while($stadate < $sname)
				{
					foreach ( $v as $i )
					{
						$_tn = "tn".$i;
						if( !in_array($$_tn, $_cfg_flow))
						{	
							if ( in_array($i, $water))
							{
								$x = "wl_tn".$i;
								$f = "fl_tn".$i;

								array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($$f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if ( in_array($i, $e) )
							{
								$xe = "wle_tn".$i;
								$fe = "fle_tn".$i;
								array_push($$xe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($$fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
						}
					}

					if ($p_format=="f_15" or $p_format=="f_hr")
					{
						$stadatei+=$a;
						$stadate+=$a*60;
					}
				
				}
				
				foreach ( $v as $i )
				{
					$_tn = "tn".$i;
					if( !in_array($$_tn, $_cfg_flow))
					{	
						if ( in_array($i, $water))
						{
							$vv = "val_tn".$i;
							$vf = "valf_tn".$i;
							$r = "_nrow".$i;
							$x = "wl_tn".$i;
							$f = "fl_tn".$i;
							
							if($row['WL_'.$$r.'']==null){$$vv="null";}else{$$vv=$row['WL_'.$$r.''];}
							array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vv."]");
							if($row['FL_'.$$r.'']==null){$$vf="null";}else{$$vf=$row['FL_'.$$r.''];}
							array_push($$f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vf."]");
						}
						if ( in_array($i, $e) )
						{
							$vve = "vale_tn".$i;
							$vfe = "valfe_tn".$i;
							$re = "_nrow".$i;
							$xe = "wle_tn".$i;
							$fe = "fle_tn".$i;

							if($row['WLE_'.$$re.'']==null){$$vve="null";}else{$$vve=$row['WLE_'.$$re.''];}
							array_push($$xe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vve."]");
							if($row['FLE_'.$$re.'']==null){$$vfe="null";}else{$$vfe=$row['FLE_'.$$re.''];}
							array_push($$fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vfe."]");
						}
					}
				}

				if ($p_format=="f_15" or $p_format=="f_hr")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}
			
			}
			else
			{
				foreach ( $v as $i )
				{
					$_tn = "tn".$i;
					if( !in_array($$_tn, $_cfg_flow))
					{	
						if ( in_array($i, $water))
						{
							$x = "wl_tn".$i;
							$f = "fl_tn".$i;

							array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							array_push($$f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						}
						if ( in_array($i, $e) )
						{
							$xe = "wle_tn".$i;
							$fe = "fle_tn".$i;
							array_push($$xe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							array_push($$fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						}
					}
				}
				
				if ($p_format=="f_15" or $p_format=="f_hr")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}							
			}
		}
		
	}
	else
	{

			$p_date=date("Y-m-d 07:00",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn=  24 * 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=1440;
			$b=86400;

			$start = strtotime($p_day1);
			$end = strtotime($p_day2);

			for ( $tt = $start; $tt <= $end; $tt += 86400 )
			{	
				$dt=date("Y-m-d",$tt);
				
				if($p_format=="f_mean")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end)) FL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end)) FLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_min")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end)) FL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end)) FLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_max")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end)) FL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end)) FLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				else{}
			
				$result = odbc_exec($conn,$strQuery);
				//$checkrow=odbc_num_rows($objExec);
				$date_now = $dt.' 07:00';
				

				$stadatey=date("Y",strtotime($date_now));	
				$stadatem=date("m",strtotime($date_now));	
				$stadated=date("d",strtotime($date_now));
				$stadateh=date("H",strtotime($date_now));
				$stadatei=date("i",strtotime($date_now));
						
				$sm=$stadatey."-".$stadatem;
				
				$stadate=strtotime($date_now);
				$enddate=strtotime($date_now)+86400;
				$row = odbc_fetch_array($result);
		
				foreach ( $v as $i )
				{
					$_tn = "tn".$i;
					if( !in_array($$_tn, $_cfg_flow))
					{	
						if ( in_array($i, $water))
						{
							$vv = "val_tn".$i;
							$vf = "valf_tn".$i;
							$r = "_nrow".$i;
							$x = "wl_tn".$i;
							$f = "fl_tn".$i;
							
							if($row['WL_'.$$r.'']==null){$$vv="null";}else{$$vv=$row['WL_'.$$r.''];}
							array_push($$x,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vv."]");
							if($row['FL_'.$$r.'']==null){$$vf="null";}else{$$vf=$row['FL_'.$$r.''];}
							array_push($$f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vf."]");
						}
						if ( in_array($i, $e) )
						{
							$vve = "vale_tn".$i;
							$vfe = "valfe_tn".$i;
							$re = "_nrow".$i;
							$xe = "wle_tn".$i;
							$fe = "fle_tn".$i;

							if($row['WLE_'.$$re.'']==null){$$vve="null";}else{$$vve=$row['WLE_'.$$re.''];}
							array_push($$xe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vve."]");
							if($row['FLE_'.$$re.'']==null){$$vfe="null";}else{$$vfe=$row['FLE_'.$$re.''];}
							array_push($$fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$$vfe."]");
						}
					}
				}
			}
		}

		$se = array();
		$see = array();
		foreach ( $v as $i )
		{
			$_tn = "tn".$i;
			if( !in_array($$_tn, $_cfg_flow))
			{	
				if ( in_array($i, $water))
				{
					$x = "wl_tn".$i;
					$p = "ponts_tn".$i;
					$$p = implode(",", $$x);

					$f = "fl_tn".$i;
					$pf = "ponts_tnf".$i;
					$$pf = implode(",", $$f);

					$n = "_namec".$i;
					$s = '{	
							type: "line",
							name: "'.$$n.'",
							data: ['.$$pf.'],
							color: "#C71585",
							lineWidth: 1,
							dashStyle:"shortdot"
							
							},
							{
							type: "line",
							name: "'.$$n."_WL".'",
							data: ['.$$p.'],
							color: "'.$colors[$i].'",
							yAxis: 1,
							lineWidth: 1,
							dashStyle:"solid"
						  }';

					array_push($se, $s);
				}
				if ( in_array($i, $e) )
				{
					$xe = "wle_tn".$i;
					$pe = "ponts_tne".$i;
					$$pe = implode(",", $$xe);

					$fe = "fle_tn".$i;
					$pfe = "ponts_tnfe".$i;
					$$pfe = implode(",", $$fe);

					$n = "_namec".$i;
					$en = '{	
							type: "line",
							name: "'.$$n."_E".'",
							data: ['.$$pfe.'],
							color: "'.$colors[$i].'",
							lineWidth: 1,
							dashStyle:"Dash"
							
							},
							{
							type: "line",
							name: "'.$$n."_WLE".'",
							data: ['.$$pe.'],
							color: "'.$colors[$i].'",
							yAxis: 1,
							lineWidth: 1,
							dashStyle:"LongDash"
						  }';
					array_push($see, $en);
				}
			}
		}

		$ss = implode(",", $se);
		$sss = implode(",", $see);

		?>
		<BR>
		<div id="graphFL" ></div>
			<script type="text/javascript">
			$(function () {				 
				$(document).ready(function() {
					Highcharts.setOptions({
					lang: {	months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
					});
					var chart = new Highcharts.Chart({
						chart: {
							renderTo: 'graphFL',
							zoomType: 'x',
							//height: 500,
						    //marginBottom: 110,
							spacingRight: 20,
							spacingLeft: 20 ,
								resetZoomButton: {
								position: {
								//align: 'right', // by default
								//verticalAlign: 'top', // by default
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
							x: -20, //center
						style: {
							fontSize: '14px'
						}
						},
						/*legend: {
							layout: 'vertical',
							align: 'left',
							verticalAlign: 'top',
							x: 100,
							y: 35,
							floating: true,
							borderWidth: 1,
							backgroundColor: '#FFFFFF'
						},*/
						subtitle: {
						style: {
							fontSize: '12px'
							},
						verticalAlign: 'bottom',
						x: 420,
						y: -460
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
							day: '%e %B %Y',
							week:'%e %B %Y',
							month:'%B %Y',
							year:'%Y'
						}
						},
					   yAxis: [{
							//min: '<? echo $minva;?>',
				
							//minPadding: 0.5,
							//maxPadding: 0.5,
							title: {
								text: '<?php echo $yaname;?>'
							 }
							 }
							,
							{
							//minPadding: 0.5,
							//maxPadding: 0.5,
								title: {
									text: '<?php echo $yaname2;?>'
								},
									opposite: true
							}
						],
						tooltip: {
							formatter: function() {	
								var a=undefined;
								var b='WL';
								var c='E';
								var d='WLE';

								var x = this.point.series.name;
								var sname = x.split('_');
								//alert(this.point.series.name);
								//alert(a);
								if(sname[1] ==a || sname[1] ==c)
								{
									return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+' <? echo $yname;?>';
								}
								else
								{
									return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+' <? echo $yname2;?>';
								}
							}
						},
						plotOptions: {							
							series:{marker:{enabled:false}}
						},    
						scrollbar: {
							 enabled: true
						 },
						series: [
								 <?php echo $ss?>,
								  <?php echo $sss?>
								 ]
							,
							exporting: {
                         url: 'http://telekpattani.com/exporting_server/index.php'
                      }
					});
						
				});

			});
			</script>
<?}?>