<?
ini_set('max_execution_time',60); // 60 seconds for max execution time
$view = $_REQUEST['view'];
$site_id = $_REQUEST['site_id'];
$type = $_REQUEST['type'];
$date1 = $_REQUEST['date1'];
$date2 = $_REQUEST['date2'];
$dtmm1=date('Y-m',strtotime($date1));
$dtmm2=date('Y-m',strtotime($date2));
$dtyy=date('Y',strtotime($date1));
$sta = explode("-", $site_id);
$ssite=$sta[0];	

$tdt = explode("-",$date1);
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


?>
<div id="content">
<a href="./?view=table&site_id=<?=$site_id?>&type=<?=$type?>&date1=<?=$date1?>&date2=<?=$date2?>&search=search" class="btn">ตารางข้อมูล</a>
<? if($ssite=="Tkol.1" || $ssite=="Tkol.5" || $ssite=="Tkol.16" || $ssite=="Tkol.17" || $ssite=="Tkol.18" || $ssite=="Tkol.24" || $ssite=="Tkol.25")
	{}
else{
?>
<a href="./?view=RF&site_id=<?=$site_id?>&type=<?=$type?>&date1=<?=$date1?>&date2=<?=$date2?>&search=search" class="btn" >กราฟน้ำฝน</a>
<?
}?>
<!-- /////////////////////WL////////////////////////// -->
<? if($ssite=="Tkol.8" || $ssite=="Tkol.9" || $ssite=="Tkol.10" || $ssite=="Tkol.13" || $ssite=="Tkol.15" || $ssite=="Tkol.22" || $ssite=="Tkol.23")
	{}
else{
?>
<a href="./?view=WL&site_id=<?=$site_id?>&type=<?=$type?>&date1=<?=$date1?>&date2=<?=$date2?>&search=search" class="btn">กราฟระดับน้ำ</a>
<?
}?>
<a href="exportexcel.php?view=export&site_id=<?=$site_id?>&type=<?=$type?>&date1=<?=$date1?>&date2=<?=$date2?>&search=search" class="btn">Excel Download</a>
</div>
<?   
	$namedt1=setdatetime(date($date1),"DD/MM/YYYY");
	$namedt2=setdatetime(date($date2),"DD/MM/YYYY");

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

	if($type=="DS")
	{
		$ddate="select top 1 datepart(DD,DB.DT) dday,datepart(MM,DB.DT) dmm,datepart(YY,DB.DT) dyy ,convert(varchar(10),DB.DT,120) dt ,
		datepart(DD,DB1.DT) dday1,datepart(MM,DB1.DT) dmm1,datepart(YY,DB1.DT) dyy1 ,convert(varchar(10),DB1.DT,120) dt1
		from [KOLOK].[dbo].[DATA_Backup] DB,[KOLOK].[dbo].[DATA_Backup] DB1 where DB.DT='$date1' and DB1.DT='$date1' and DB.STN_ID='$ssite'";
	}
	elseif($type=="DB")
	{
		$ddate="select top 1 datepart(DD,DB.DT) dday,datepart(MM,DB.DT) dmm,datepart(YY,DB.DT) dyy ,convert(varchar(10),DB.DT,120) dt ,
		datepart(DD,DB1.DT) dday1,datepart(MM,DB1.DT) dmm1,datepart(YY,DB1.DT) dyy1 ,convert(varchar(10),DB1.DT,120) dt1
		from [KOLOK].[dbo].[DATA_Backup] DB,[KOLOK].[dbo].[DATA_Backup] DB1 where DB.DT='$date1' and DB1.DT='$date2' and DB.STN_ID='$ssite'";
	}
	else if($type=="MS")
	{
		$ddate="select top 1 datepart(DD,DB.DT) dday,datepart(MM,DB.DT) dmm,datepart(YY,DB.DT) dyy ,convert(varchar(10),DB.DT,120) dt ,
		datepart(DD,DB1.DT) dday1,datepart(MM,DB1.DT) dmm1,datepart(YY,DB1.DT) dyy1 ,convert(varchar(10),DB1.DT,120) dt1
		from [KOLOK].[dbo].[DATA_Backup] DB,[KOLOK].[dbo].[DATA_Backup] DB1 where CONVERT(varchar(7),DB.DT,120)='$dtmm1' and CONVERT(varchar(7),DB1.DT,120)='$dtmm1'
		 and DB.STN_ID='$ssite' order by DB.DT";
	}
	else if($type=="MB")
	{
		$ddate="select top 1 datepart(DD,DB.DT) dday,datepart(MM,DB.DT) dmm,datepart(YY,DB.DT) dyy ,convert(varchar(10),DB.DT,120) dt ,
		datepart(DD,DB1.DT) dday1,datepart(MM,DB1.DT) dmm1,datepart(YY,DB1.DT) dyy1 ,convert(varchar(10),DB1.DT,120) dt1
		from [KOLOK].[dbo].[DATA_Backup] DB,[KOLOK].[dbo].[DATA_Backup] DB1 where CONVERT(varchar(7),DB.DT,120)='$dtmm1' and CONVERT(varchar(7),DB1.DT,120)='$dtmm2'
		 and DB.STN_ID='$ssite' order by DB.DT";
	}
	else
	{
		$ddate="select top 1 datepart(DD,DT) dday,datepart(MM,DT) dmm,datepart(YY,DT) dyy ,convert(varchar(10),DT,120) dt
		from [KOLOK].[dbo].[DATA_Backup] DB where CONVERT(varchar(4),DB.DT,120)='$dtyy' and STN_ID='$ssite' order by DT";
	}

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
	
	if($type=="DS" or $type=="MS" or $type=="YS")
	{
		$compare_T=0;
	}
	else
	{
		$compare_T=DateDiff($date1,$date2);
	}
	
	$dta = (int)$sday." ".dmonth($smm)." ".dyear($syy);
	$dta1 = (int)$sday1." ".dmonth($smm1)." ".dyear($syy1);
	$ndtm = dmonth($smm)." ".dyear($syy);
	$ndtm1 = dmonth($smm1)." ".dyear($syy1);
	$ndty = dyear($syy);
	$ndty1 = dyear($syy1);

	if($compare_T < 1)
	{
		if($type=="DS")
		{
			$namedateshow="วันที่  $dta";
		}
		elseif($type=="MS")
		{
			$namedateshow="เดือน  $ndtm";
		}
		elseif($type=="YS")
		{
			$namedateshow="ปี  $ndty";
		}
		else{}

	}
	else
	{
		if($type=="DB")
		{
			$namedateshow="ระหว่างวันที่  $dta ถึง $dta1";
		}
		elseif($type=="MB")
		{
			$namedateshow="ระหว่างเดือน  $ndtm ถึง $ndtm1";
		}
		else{}
	}
	
	$ss="SELECT STN_ID,STN_CODE,STN_NAME_THAI FROM [KOLOK].[dbo].[TM_STN] where STN_ID='$ssite'";
    $ress = mssql_query($ss);
    $namesta=mssql_fetch_array($ress);
    $stationss=$namesta['STN_ID'];
	$sname=$namesta['STN_CODE'];
	$namethai=$namesta['STN_NAME_THAI'];
	$Dname=iconv('TIS-620', 'UTF-8', $namethai);

/*--------------------------select data--------------------------------------*/
if($view=="table")
{
	$minrf=array();
	$hourrf=array();
	$wl=array();
	$wle=array();
	$wlavg=array();
	$wlmin=array();
	$wlmax=array();
	$wleavg=array();
	$wlemin=array();
	$wlemax=array();
	$timerf=array();
	$timeavg=array();
	$timemin=array();
	$timemax=array();
	$timeavge=array();
	$timemine=array();
	$timemaxe=array();
	if($type =="DS" or $type =="DB")
	{
		if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
		{
		?>
	
				<table CLASS="datatable" align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="2" >ปริมาณน้ำฝน (มม.)</td>
					<td rowspan="2">ระดับน้ำ (เมตร รทก.)</td>
					<td rowspan="2">ระดับน้ำท้าย ปตร. (เมตร รทก.)</td>
				</tr>
				<tr class="tr_head">
				<td >15 นาที</td>
				<td >1 ชั่วโมง</td>
				</tr>	
				<tbody>
		<?
				if($type =="DS")
				{
						$sss="select distinct CONVERT(varchar(20),DT,120) AS adate,
						sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf ,
						sum(case sensor_id when '200' then CONVERT(decimal(38,2),(Value )) end) wl,
						sum(case sensor_id when '201' then CONVERT(decimal(38,2),(Value )) end) wle
						FROM [KOLOK].[dbo].[DATA_Backup]  WHERE DT BETWEEN '".$date1." 00:00' AND '".$date1." 23:50' and STN_ID='".$ssite."' 
						group BY CONVERT(varchar(20),DT,120) order by CONVERT(varchar(20),DT,120)";
				}
				
				else if($type =="DB")
				{
						$sss="select distinct CONVERT(varchar(20),DT,120) AS adate,
						sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf ,
						sum(case sensor_id when '200' then CONVERT(decimal(38,2),(Value )) end) wl,
						sum(case sensor_id when '201' then CONVERT(decimal(38,2),(Value )) end) wle
						FROM [KOLOK].[dbo].[DATA_Backup]  WHERE DT BETWEEN '".$date1." 00:00' AND '".$date2." 23:50' and STN_ID='".$ssite."' 
						group BY CONVERT(varchar(20),DT,120) order by CONVERT(varchar(20),DT,120)";
				}
				else{}

				$rs_check =mssql_query($sss);
				$checkrow=mssql_num_rows($rs_check);					
				if($checkrow=="0" )
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=mssql_fetch_array($rs_check))
					{
						$sqltm="select * from [KOLOK].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = mssql_query($sqltm);
						$row = mssql_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]); 
						$starhour=date("Y-m-d H:00",strtotime($r_check['adate']));
						$endhour=date("Y-m-d H:45",strtotime($r_check['adate']));
						$vmin=date("i",strtotime($r_check['adate']));

						$sumrain="SELECT Sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) vhour
						FROM [KOLOK].[dbo].[DATA_Backup] WHERE STN_ID='".$ssite."' and DT between '".$starhour." ' and '".$endhour."' ";

						$sumrf =mssql_query($sumrain);
						$sumrfh=mssql_fetch_array($sumrf);

						array_push($minrf,$r_check['rf']);
						array_push($hourrf,$sumrfh['vhour']);
						array_push($wl,$r_check['wl']);
						array_push($wle,$r_check['wle']);
				?>
							<tr >
								<td><?=$STN_ID?></td>
								<td><?=$STN_NAME_THAI?></td>
								<td><? echo ShortThaiDate($r_check['adate'],1,$STN_ID,"no")?></td>
								<td><?=checkrf($r_check['rf'],$STN_ID,0)?></td>
								<td><?if($vmin=="45"){ echo checkrf($sumrfh['vhour'],$STN_ID,0);}?></td>
								<td><?=checkna($r_check['wl'],$STN_ID,1)?></td>
								<td><?=checkna($r_check['wle'],$STN_ID,1)?></td>
							</tr>
					<?
					}	//end while	 
					$min15=min($minrf);
					$max15=max($minrf);
					$min1h=min($hourrf);
					$max1h=max($hourrf);
					$minwl=min($wl);
					$maxwl=max($wl);
					$minwle=min($wle);
					$maxwle=max($wle);
					$totalrf= array_sum($minrf);
					$totalrfh= array_sum($hourrf);
					$totalwl= array_sum($wl);
					$totalwle= array_sum($wle);
					$avgrf= array_sum($minrf)/ count($minrf);
					$avgrfh= array_sum($hourrf)/ count($hourrf);
					$avgwl= array_sum($wl) / count($wl);
					$avgwle= array_sum($wle) / count($wle);
				}
			?> 
		</tbody>
		<tfoot>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">MIN</td>
			<td><?=checkrf($min15,$STN_ID,1)?></td>
			<td><?=checkrf($min1h,$STN_ID,1)?></td>
			<td><?=checkna($minwl,$STN_ID,1)?></td>
			<td><?=checkna($minwle,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">MAX</td>
			<td><?=checkrf($max15,$STN_ID,1)?></td>
			<td><?=checkrf($max1h,$STN_ID,1)?></td>
			<td><?=checkna($maxwl,$STN_ID,1)?></td>
			<td><?=checkna($maxwle,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">SUM</td>
			<td><?=checkrf($totalrf,$STN_ID,1)?></td>
			<td><?=checkrf($totalrfh,$STN_ID,1)?></td>
			<td>n/a</td>
			<td>n/a</td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">Average</td>
			<td>n/a</td>
			<td>n/a</td>
			<td><?=checkna($avgwl,$STN_ID,1)?></td>
			<td><?=checkna($avgwle,$STN_ID,1)?></td>
		</tr>
		</tfoot>
		</table>
	<?
		}
		else
		{
		?>
	
				<table CLASS="datatable" align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="2" >ปริมาณน้ำฝน (มม.)</td>
					<td rowspan="2">ระดับน้ำ (เมตร รทก.)</td>
				</tr>
				<tr class="tr_head">
				<td >15 นาที</td>
				<td >1 ชั่วโมง</td>
				</tr>	
				<tbody>
			<?
				if($type =="DS")
				{
						$sss="select distinct CONVERT(varchar(20),DT,120) AS adate,
						sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf ,
						sum(case sensor_id when '200' then CONVERT(decimal(38,2),(Value )) end) wl
						FROM [KOLOK].[dbo].[DATA_Backup]  WHERE DT BETWEEN '".$date1." 00:00' AND '".$date1." 23:50' and STN_ID='".$ssite."' 
						group BY CONVERT(varchar(20),DT,120) order by CONVERT(varchar(20),DT,120)";
				}
				
				else if($type =="DB")
				{
						$sss="select distinct CONVERT(varchar(20),DT,120) AS adate,
						sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf ,
						sum(case sensor_id when '200' then CONVERT(decimal(38,2),(Value )) end) wl
						FROM [KOLOK].[dbo].[DATA_Backup]  WHERE DT BETWEEN '".$date1." 00:00' AND '".$date2." 23:50' and STN_ID='".$ssite."' 
						group BY CONVERT(varchar(20),DT,120) order by CONVERT(varchar(20),DT,120)";
				}
				else{}

				$rs_check =mssql_query($sss);
				$checkrow=mssql_num_rows($rs_check);					
				if($checkrow=="0" )
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=mssql_fetch_array($rs_check))
					{
						$sqltm="select * from [KOLOK].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = mssql_query($sqltm);
						$row = mssql_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]); 
						$starhour=date("Y-m-d H:00",strtotime($r_check['adate']));
						$endhour=date("Y-m-d H:45",strtotime($r_check['adate']));
						$vmin=date("i",strtotime($r_check['adate']));

						$sumrain="SELECT Sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) vhour
						FROM [KOLOK].[dbo].[DATA_Backup] WHERE STN_ID='".$ssite."' and DT between '".$starhour." ' and '".$endhour."' ";

						$sumrf =mssql_query($sumrain);
						$sumrfh=mssql_fetch_array($sumrf);

						array_push($minrf,$r_check['rf']);
						array_push($hourrf,$sumrfh['vhour']);
						array_push($wl,$r_check['wl']);
				?>
							<tr >
								<td><?=$STN_ID?></td>
								<td><?=$STN_NAME_THAI?></td>
								<td><? echo ShortThaiDate($r_check['adate'],1,$STN_ID,"no")?></td>
								<td><?=checkrf($r_check['rf'],$STN_ID,1)?></td>
								<td><?if($vmin=="45"){ echo checkrf($sumrfh['vhour'],$STN_ID,1);}?></td>
								<td><?=checkna($r_check['wl'],$STN_ID,1)?></td>
							</tr>
					<?
					}	//end while	 
					$min15=min($minrf);
					$max15=max($minrf);
					$min1h=min($hourrf);
					$max1h=max($hourrf);
					$minwl=min($wl);
					$maxwl=max($wl);
					$totalrf= array_sum($minrf);
					$totalrfh= array_sum($hourrf);
					$totalwl= array_sum($wl);
					$avgrf= array_sum($minrf)/ count($minrf);
					$avgrfh= array_sum($hourrf)/ count($hourrf);
					$avgwl= array_sum($wl) / count($wl);
				}
			?> 
		</tbody>
		<tfoot>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">MIN</td>
			<td><?=checkrf($min15,$STN_ID,1)?></td>
			<td><?=checkrf($min1h,$STN_ID,1)?></td>
			<td><?=checkna($minwl,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">MAX</td>
			<td><?=checkrf($max15,$STN_ID,1)?></td>
			<td><?=checkrf($max1h,$STN_ID,1)?></td>
			<td><?=checkna($maxwl,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">SUM</td>
			<td><?=checkrf($totalrf,$STN_ID,1)?></td>
			<td><?=checkrf($totalrfh,$STN_ID,1)?></td>
			<td>n/a</td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">Average</td>
			<td>n/a</td>
			<td>n/a</td>
			<td><?=checkna($avgwl,$STN_ID,1)?></td>
		</tr>
		</tfoot>
		</table>
	<?
		}
	}
	//////////////////////////////month/////////////////////////////////
	else if($type =="MS" or $type =="MB")
	{
		if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
		{
		?>
		<div>
		<table align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="1" >ปริมาณน้ำฝน (มม.)</td>
					<td colspan="3">ระดับน้ำ เมตร (รทก.)</td>
					<td colspan="3">ระดับน้ำท้าย ปตร. (เมตร รทก.)</td>
				</tr>
				<tr class="tr_head">
				<td >น้ำฝนสะสมรายวัน</td>
				<td >เฉลี่ยรายวัน</td>
				<td >ต่ำสุดรายวัน</td>
				<td >สูงสุดรายวัน</td>
				<td >เฉลี่ยรายวัน</td>
				<td >ต่ำสุดรายวัน</td>
				<td >สูงสุดรายวัน</td>
				</tr>		
			<tbody>
			<?
			
				if($type =="MS")
				{
					$sss="select distinct CONVERT(varchar(10),DT,120) AS adate,
					sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmax,
					min(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmin,
					CONVERT(decimal(38,2),avg(case sensor_id when '201' then Value end)) wleavg,
					max(case sensor_id when '201' then CONVERT(decimal(38,2),Value ) end) wlemax,
					min(case sensor_id when '201' then CONVERT(decimal(38,2),Value ) end) wlemin
					FROM [KOLOK].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm1."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(10),DT,120) 
					order by CONVERT(varchar(10),DT,120) ";
				}
				
				else if($type =="MB")
				{
					$sss="select distinct CONVERT(varchar(10),DT,120) AS adate,
					sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmax,
					min(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmin,
					CONVERT(decimal(38,2),avg(case sensor_id when '201' then Value end)) wleavg,
					max(case sensor_id when '201' then CONVERT(decimal(38,2),Value ) end) wlemax,
					min(case sensor_id when '201' then CONVERT(decimal(38,2),Value ) end) wlemin
					FROM [KOLOK].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(10),DT,120) 
					order by CONVERT(varchar(10),DT,120)";
				}
				else
				{
				}
				
				$rs_check =mssql_query($sss);
				$row = 1;
				$checkrow=mssql_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=mssql_fetch_array($rs_check))
					{
						$sqltm="select * from [KOLOK].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = mssql_query($sqltm);
						$row = mssql_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]);

						array_push($minrf,$r_check['rf00']);
						array_push($wlavg,$r_check['wlavg']);
						array_push($wlmin,$r_check['wlmin']);
						array_push($wlmax,$r_check['wlmax']);
						array_push($wleavg,$r_check['wleavg']);
						array_push($wlemin,$r_check['wlemin']);
						array_push($wlemax,$r_check['wlemax']);
					
						$timerf[$r_check['adate']]= $r_check['rf00'];
						$timeavg[$r_check['adate']] = $r_check['wlavg'];
						$timemin[$r_check['adate']] = $r_check['wlmin'];
						$timemax[$r_check['adate']] = $r_check['wlmax'];
						$timeavge[$r_check['adate']] = $r_check['wleavg'];
						$timemine[$r_check['adate']] = $r_check['wlemin'];
						$timemaxe[$r_check['adate']] = $r_check['wlemax'];
	
						

				?>
						<tr class="tr_list">
							<td><?=$STN_ID?></td>
							<td><?=$STN_NAME_THAI?></td>
							<td><? echo ShortThaiDate($r_check['adate'],2,$STN_ID,"no")?></td>
							<td><?=checkrf($r_check['rf00'],$STN_ID,0)?></td>
							<td><?=checkna($r_check['wlavg'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmin'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmax'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wleavg'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlemin'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlemax'],$STN_ID,1)?></td>
						</tr>
				<?
						$row++;
						}	//end while	
						$dtminrf = array_search(min($timerf),$timerf);
						$dtmaxrf = array_search(max($timerf),$timerf);
						$dtmin_avg = array_search(min($timeavg),$timeavg);
						$dtmax_avg = array_search(max($timeavg),$timeavg);
						$dtmin_min = array_search(min($timemin),$timemin);
						$dtmax_min = array_search(max($timemin),$timemin);
						$dtmin_max = array_search(min($timemax),$timemax);
						$dtmax_max = array_search(max($timemax),$timemax);
						$dtmin_avge = array_search(min($timeavge),$timeavge);
						$dtmax_avge = array_search(max($timeavge),$timeavge);
						$dtmin_mine = array_search(min($timemine),$timemine);
						$dtmax_mine = array_search(max($timemine),$timemine);
						$dtmin_maxe = array_search(min($timemaxe),$timemaxe);
						$dtmax_maxe = array_search(max($timemaxe),$timemaxe);
						$min15=min($minrf);
						$max15=max($minrf);
						$wlavg_min=min($wlavg);
						$wlavg_max=max($wlavg);
						$wlmin_min=min($wlmin);
						$wlmin_max=max($wlmin);
						$wlmax_min=min($wlmax);
						$wlmax_max=max($wlmax);
						$wleavg_min=min($wleavg);
						$wleavg_max=max($wleavg);
						$wlemin_min=min($wlemin);
						$wlemin_max=max($wlemin);
						$wlemax_min=min($wlemax);
						$wlemax_max=max($wlemax);
						$totalrf= array_sum($minrf);
						$avg_wl= array_sum($wlavg)/ count($wlavg);
						$min_wl= array_sum($wlmin)/ count($wlmin);
						$max_wl= array_sum($wlmax) / count($wlmax);
						$avg_wle= array_sum($wleavg)/ count($wleavg);
						$min_wle= array_sum($wlemin)/ count($wlemin);
						$max_wle= array_sum($wlemax) / count($wlemax);
					}
			?>
			</tbody>
			<tfoot>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MIN</td>
				<td><?=checkrf($min15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_min,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_min,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_min,$STN_ID,1)?></td>
				<td><?=checkna($wleavg_min,$STN_ID,1)?></td>
				<td><?=checkna($wlemin_min,$STN_ID,1)?></td>
				<td><?=checkna($wlemax_min,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MIN</td>
				<td><? echo ShortThaiDate($dtminrf,2,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmin_avg,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_min,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_max,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_avge,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_mine,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_maxe,2,$STN_ID,"wl")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MAX</td>
				<td><?=checkrf($max15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_max,$STN_ID,1)?></td>
				<td><?=checkna($wleavg_max,$STN_ID,1)?></td>
				<td><?=checkna($wlemin_max,$STN_ID,1)?></td>
				<td><?=checkna($wlemax_max,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MAX</td>
				<td><? echo ShortThaiDate($dtmaxrf,2,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmax_avg,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_min,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_max,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_avge,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_mine,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_maxe,2,$STN_ID,"wl")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">SUM</td>
				<td><?=checkrf($totalrf,$STN_ID,0)?></td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">Average</td>
				<td>-</td>
				<td><?=checkna($avg_wl,$STN_ID,1)?></td>
				<td><?=checkna($min_wl,$STN_ID,1)?></td>
				<td><?=checkna($max_wl,$STN_ID,1)?></td>
				<td><?=checkna($avg_wle,$STN_ID,1)?></td>
				<td><?=checkna($min_wle,$STN_ID,1)?></td>
				<td><?=checkna($max_wle,$STN_ID,1)?></td>
			</tr>
		</tfoot>
		</table>
		</div>
	<?}
		else
		{?>
		<div>
		<table align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="1" >ปริมาณน้ำฝน (มม.)</td>
					<td colspan="3">ระดับน้ำ เมตร (รทก.)</td>
				</tr>
				<tr class="tr_head">
				<td >น้ำฝนสะสมรายวัน</td>
				<td >เฉลี่ยรายวัน</td>
				<td >ต่ำสุดรายวัน</td>
				<td >สูงสุดรายวัน</td>
				</tr>		
			<tbody>
			<?
			
				if($type =="MS")
				{
					$sss="select distinct CONVERT(varchar(10),DT,120) AS adate,
					sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmax,
					min(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmin
					FROM [KOLOK].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm1."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(10),DT,120) 
					order by CONVERT(varchar(10),DT,120) ";
				}
				
				else if($type =="MB")
				{
					$sss="select distinct CONVERT(varchar(10),DT,120) AS adate,
					sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmax,
					min(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmin
					FROM [KOLOK].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(10),DT,120) 
					order by CONVERT(varchar(10),DT,120)";
				}
				else
				{
				}
				
				$rs_check =mssql_query($sss);
				$row = 1;
				$checkrow=mssql_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=mssql_fetch_array($rs_check))
					{
						$sqltm="select * from [KOLOK].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = mssql_query($sqltm);
						$row = mssql_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]);

						array_push($minrf,$r_check['rf00']);
						array_push($wlavg,$r_check['wlavg']);
						array_push($wlmin,$r_check['wlmin']);
						array_push($wlmax,$r_check['wlmax']);
					
						$timerf[$r_check['adate']]= $r_check['rf00'];
						$timeavg[$r_check['adate']] = $r_check['wlavg'];
						$timemin[$r_check['adate']] = $r_check['wlmin'];
						$timemax[$r_check['adate']] = $r_check['wlmax'];
	
						

				?>
						<tr class="tr_list">
							<td><?=$STN_ID?></td>
							<td><?=$STN_NAME_THAI?></td>
							<td><? echo ShortThaiDate($r_check['adate'],2,$STN_ID,"no")?></td>
							<td><?=checkrf($r_check['rf00'],$STN_ID,0)?></td>
							<td><?=checkna($r_check['wlavg'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmin'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmax'],$STN_ID,1)?></td>
						</tr>
				<?
						$row++;
						}	//end while	
						$dtminrf = array_search(min($timerf),$timerf);
						$dtmaxrf = array_search(max($timerf),$timerf);
						$dtmin_avg = array_search(min($timeavg),$timeavg);
						$dtmax_avg = array_search(max($timeavg),$timeavg);
						$dtmin_min = array_search(min($timemin),$timemin);
						$dtmax_min = array_search(max($timemin),$timemin);
						$dtmin_max = array_search(min($timemax),$timemax);
						$dtmax_max = array_search(max($timemax),$timemax);
						$min15=min($minrf);
						$max15=max($minrf);
						$wlavg_min=min($wlavg);
						$wlavg_max=max($wlavg);
						$wlmin_min=min($wlmin);
						$wlmin_max=max($wlmin);
						$wlmax_min=min($wlmax);
						$wlmax_max=max($wlmax);
						$totalrf= array_sum($minrf);
						$avg_wl= array_sum($wlavg)/ count($wlavg);
						$min_wl= array_sum($wlmin)/ count($wlmin);
						$max_wl= array_sum($wlmax) / count($wlmax);
					}
			?>
			</tbody>
			<tfoot>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MIN</td>
				<td><?=checkrf($min15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_min,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_min,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_min,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MIN</td>
				<td><? echo ShortThaiDate($dtminrf,2,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmin_avg,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_min,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_max,2,$STN_ID,"wl")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MAX</td>
				<td><?=checkrf($max15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_max,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MAX</td>
				<td><? echo ShortThaiDate($dtmaxrf,2,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmax_avg,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_min,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_max,2,$STN_ID,"wl")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">SUM</td>
				<td><?=checkrf($totalrf,$STN_ID,0)?></td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">Average</td>
				<td>n/a</td>
				<td><?=checkna($avg_wl,$STN_ID,1)?></td>
				<td><?=checkna($min_wl,$STN_ID,1)?></td>
				<td><?=checkna($max_wl,$STN_ID,1)?></td>
			</tr>
		</tfoot>
		</table>
		</div>
		<?}
	}
	///////////////////////////////year/////////////////////////////////
	else if($type =="YS" )
	{
		if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
		{
		?>
		<div>
		<table align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="1" >ปริมาณน้ำฝน (มม.)</td>
					<td colspan="3">ระดับน้ำ เมตร (รทก.)</td>
					<td colspan="3">ระดับน้ำท้าย ปตร. (เมตร รทก.)</td>
				</tr>
				<tr class="tr_head">
				<td >น้ำฝนสะสมรายเดือน</td>
				<td >เฉลี่ยรายเดือน</td>
				<td >ต่ำสุดรายเดือน</td>
				<td >สูงสุดรายเดือน</td>
				<td >เฉลี่ยรายเดือน</td>
				<td >ต่ำสุดรายเดือน</td>
				<td >สูงสุดรายเดือน</td>
				</tr>		
			<tbody>
			<?
		
				if($type =="YS")
				{
					$sss="select distinct CONVERT(varchar(7),DT,120) AS adate,
					sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmax,
					min(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmin,
					CONVERT(decimal(38,2),avg(case sensor_id when '201' then Value end)) wleavg,
					max(case sensor_id when '201' then CONVERT(decimal(38,2),Value ) end) wlemax,
					min(case sensor_id when '201' then CONVERT(decimal(38,2),Value ) end) wlemin
					FROM [KOLOK].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(7),DT,120) 
					order by CONVERT(varchar(7),DT,120)  ";
				}
				
				else
				{
				}
				
				$rs_check =mssql_query($sss);
				$row = 1;
				$checkrow=mssql_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=mssql_fetch_array($rs_check))
					{
						$sqltm="select * from [KOLOK].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = mssql_query($sqltm);
						$row = mssql_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]);
						array_push($minrf,$r_check['rf00']);
						array_push($wlavg,$r_check['wlavg']);
						array_push($wlmin,$r_check['wlmin']);
						array_push($wlmax,$r_check['wlmax']);
						array_push($wleavg,$r_check['wleavg']);
						array_push($wlemin,$r_check['wlemin']);
						array_push($wlemax,$r_check['wlemax']);

						$timerf[$r_check['adate']] = $r_check['rf00'];
						$timeavg[$r_check['adate']] = $r_check['wlavg'];
						$timemin[$r_check['adate']] = $r_check['wlmin'];
						$timemax[$r_check['adate']] = $r_check['wlmax'];
						$timeavge[$r_check['adate']] = $r_check['wleavg'];
						$timemine[$r_check['adate']] = $r_check['wlemin'];
						$timemaxe[$r_check['adate']] = $r_check['wlemax'];
				?>
						<tr class="tr_list">
							<td><?=$STN_ID?></td>
							<td><?=$STN_NAME_THAI?></td>
							<td><? echo ShortThaiDate($r_check['adate'],3,$STN_ID,"no")?></td>
							<td><?=checkna($r_check['rf00'],$STN_ID,0)?></td>
							<td><?=checkna($r_check['wlavg'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmin'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmax'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wleavg'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlemin'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlemax'],$STN_ID,1)?></td>
						</tr>
				<?
						$row++;
						}	//end while	
						
						$dtminrf = array_search(min($timerf),$timerf);
						$dtmaxrf = array_search(max($timerf),$timerf);
						$dtmin_avg = array_search(min($timeavg),$timeavg);
						$dtmax_avg = array_search(max($timeavg),$timeavg);
						$dtmin_min = array_search(min($timemin),$timemin);
						$dtmax_min = array_search(max($timemin),$timemin);
						$dtmin_max = array_search(min($timemax),$timemax);
						$dtmax_max = array_search(max($timemax),$timemax);
						$dtmin_avge = array_search(min($timeavge),$timeavge);
						$dtmax_avge = array_search(max($timeavge),$timeavge);
						$dtmin_mine = array_search(min($timemine),$timemine);
						$dtmax_mine = array_search(max($timemine),$timemine);
						$dtmin_maxe = array_search(min($timemaxe),$timemaxe);
						$dtmax_maxe = array_search(max($timemaxe),$timemaxe);
						$min15=min($minrf);
						$max15=max($minrf);
						$wlavg_min=min($wlavg);
						$wlavg_max=max($wlavg);
						$wlmin_min=min($wlmin);
						$wlmin_max=max($wlmin);
						$wlmax_min=min($wlmax);
						$wlmax_max=max($wlmax);
						$wleavg_min=min($wleavg);
						$wleavg_max=max($wleavg);
						$wlemin_min=min($wlemin);
						$wlemin_max=max($wlemin);
						$wlemax_min=min($wlemax);
						$wlemax_max=max($wlemax);
						$totalrf= array_sum($minrf);
						$avg_wl= array_sum($wlavg)/ count($wlavg);
						$min_wl= array_sum($wlmin)/ count($wlmin);
						$max_wl= array_sum($wlmax) / count($wlmax);
						$avg_wle= array_sum($wleavg)/ count($wleavg);
						$min_wle= array_sum($wlemin)/ count($wlemin);
						$max_wle= array_sum($wlemax) / count($wlemax);
					}
			?>
			</tbody>
			<tfoot>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MIN</td>
				<td><?=checkna($min15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_min,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_min,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_min,$STN_ID,1)?></td>
				<td><?=checkna($wleavg_min,$STN_ID,1)?></td>
				<td><?=checkna($wlemin_min,$STN_ID,1)?></td>
				<td><?=checkna($wlemax_min,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MIN</td>
				<td><? echo ShortThaiDate($dtminrf,3,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmin_avg,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_min,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_max,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_avge,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_mine,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_maxe,3,$STN_ID,"wl")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MAX</td>
				<td><?=checkna($max15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_max,$STN_ID,1)?></td>
				<td><?=checkna($wleavg_max,$STN_ID,1)?></td>
				<td><?=checkna($wlemin_max,$STN_ID,1)?></td>
				<td><?=checkna($wlemax_max,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MAX</td>
				<td><? echo ShortThaiDate($dtmaxrf,3,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmax_avg,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_min,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_max,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_avge,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_mine,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_maxe,3,$STN_ID,"wl")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">SUM</td>
				<td><?echo number_format($totalrf,2);?></td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">Average</td>
				<td>n/a</td>
				<td><?=checkna($avg_wl,$STN_ID,1)?></td>
				<td><?=checkna($min_wl,$STN_ID,1)?></td>
				<td><?=checkna($max_wl,$STN_ID,1)?></td>
				<td><?=checkna($avg_wle,$STN_ID,1)?></td>
				<td><?=checkna($min_wle,$STN_ID,1)?></td>
				<td><?=checkna($max_wle,$STN_ID,1)?></td>
			</tr>
		</tfoot>
		</table>
		</div>
		<?
		}
		else
		{
		?>
		<div>
		<table align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="1" >ปริมาณน้ำฝน (มม.)</td>
					<td colspan="3">ระดับน้ำ เมตร (รทก.)</td>
				</tr>
				<tr class="tr_head">
				<td >น้ำฝนสะสมรายเดือน</td>
				<td >เฉลี่ยรายเดือน</td>
				<td >ต่ำสุดรายเดือน</td>
				<td >สูงสุดรายเดือน</td>
				</tr>		
			<tbody>
			<?
		
				if($type =="YS")
				{
					$sss="select distinct CONVERT(varchar(7),DT,120) AS adate,
					sum(case sensor_id when '100' then CONVERT(decimal(38,2),Value) end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmax,
					min(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmin
					FROM [KOLOK].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(7),DT,120) 
					order by CONVERT(varchar(7),DT,120)  ";
				}
				
				else
				{
				}
				
				$rs_check =mssql_query($sss);
				$row = 1;
				$checkrow=mssql_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=mssql_fetch_array($rs_check))
					{
						$sqltm="select * from [KOLOK].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = mssql_query($sqltm);
						$row = mssql_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]);
						array_push($minrf,$r_check['rf00']);
						array_push($wlavg,$r_check['wlavg']);
						array_push($wlmin,$r_check['wlmin']);
						array_push($wlmax,$r_check['wlmax']);

						$timerf[$r_check['adate']] = $r_check['rf00'];
						$timeavg[$r_check['adate']] = $r_check['wlavg'];
						$timemin[$r_check['adate']] = $r_check['wlmin'];
						$timemax[$r_check['adate']] = $r_check['wlmax'];
				?>
						<tr class="tr_list">
							<td><?=$STN_ID?></td>
							<td><?=$STN_NAME_THAI?></td>
							<td><? echo ShortThaiDate($r_check['adate'],3,$STN_ID,"no")?></td>
							<td><?=checkna($r_check['rf00'],$STN_ID,0)?></td>
							<td><?=checkna($r_check['wlavg'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmin'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmax'],$STN_ID,1)?></td>
						</tr>
				<?
						$row++;
						}	//end while	
						
						$dtminrf = array_search(min($timerf),$timerf);
						$dtmaxrf = array_search(max($timerf),$timerf);
						$dtmin_avg = array_search(min($timeavg),$timeavg);
						$dtmax_avg = array_search(max($timeavg),$timeavg);
						$dtmin_min = array_search(min($timemin),$timemin);
						$dtmax_min = array_search(max($timemin),$timemin);
						$dtmin_max = array_search(min($timemax),$timemax);
						$dtmax_max = array_search(max($timemax),$timemax);
						$min15=min($minrf);
						$max15=max($minrf);
						$wlavg_min=min($wlavg);
						$wlavg_max=max($wlavg);
						$wlmin_min=min($wlmin);
						$wlmin_max=max($wlmin);
						$wlmax_min=min($wlmax);
						$wlmax_max=max($wlmax);
						$totalrf= array_sum($minrf);
						$avg_wl= array_sum($wlavg)/ count($wlavg);
						$min_wl= array_sum($wlmin)/ count($wlmin);
						$max_wl= array_sum($wlmax) / count($wlmax);
					}
			?>
			</tbody>
			<tfoot>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MIN</td>
				<td><?=checkna($min15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_min,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_min,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_min,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MIN</td>
				<td><? echo ShortThaiDate($dtminrf,3,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmin_avg,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_min,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_max,3,$STN_ID,"wl")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MAX</td>
				<td><?=checkna($max15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_max,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MAX</td>
				<td><? echo ShortThaiDate($dtmaxrf,3,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmax_avg,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_min,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_max,3,$STN_ID,"wl")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">SUM</td>
				<td><?echo number_format($totalrf,2);?></td>
				<td>n/a</td>
				<td>n/a</td>
				<td>n/a</td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">Average</td>
				<td>n/a</td>
				<td><?=checkna($avg_wl,$STN_ID,1)?></td>
				<td><?=checkna($min_wl,$STN_ID,1)?></td>
				<td><?=checkna($max_wl,$STN_ID,1)?></td>
			</tr>
		</tfoot>
		</table>
		</div>
		<?
		}
			}
	else{}
}
else if($view=="RF")
	{
		$nametype="กราฟปริมาณน้ำฝน"; 
		$yname="มม.";
		$yaname="ปริมาณน้ำฝน มม.";
		$typess="column";
		$minva=0;
		$maxva=100;
		
		$a=0;
		if($type =="DS")
		{
			$p_date=date("Y-m-d",strtotime($date1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;
			$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date1 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite' and sensor_id = '100' 
			group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
		}
		elseif($type =="DB")
		{
			$p_date=date("Y-m-d",strtotime($date1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;
			$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date2 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite' and sensor_id = '100' 
			group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
		}
		elseif($type =="MS")
		{
			$p_date=date("Y-m",strtotime($date1));
			$p_date2=date("Y-m",strtotime($date2));
			$maxZ= 24 * 3600000;
			$pointIn= 24 * 3600 * 1000; // 1 day
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%e. %B %Y";
			$minva = $maxva = null;
			$a=60*24;
			$b=86400;
			$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm1."' and datepart(MINUTE,DT) % 15 = 0 and 
			STN_ID='$ssite' and sensor_id = '100' group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
		}
		elseif($type =="MB")
		{
			$p_date=date("Y-m",strtotime($date1));
			$p_date2=date("Y-m",strtotime($date2));
			$maxZ= 24 * 3600000;
			$pointIn= 24 * 3600 * 1000; // 1 day
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%e. %B %Y";
			$minva = $maxva = null;
			$a=60*24;
			$b=86400;
			$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' and datepart(MINUTE,DT) % 15 = 0 and 
			STN_ID='$ssite' and sensor_id = '100' group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
		}
		elseif($type =="YS")
		{
			$p_date=date("Y",strtotime($date1));
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%B %Y";
			$minva = $maxva = null;
			$strQuery="select DISTINCT CONVERT(varchar(7),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' and datepart(MINUTE,DT) % 15 = 0 and 
			STN_ID='$ssite' and sensor_id = '100' group BY CONVERT(varchar(7),DT,120) order by CONVERT(varchar(7),DT,120)";
		}
		else{}


		$result = mssql_query($strQuery); 
	  // while ($row_rs_tu01 = odbc_fetch_array($result));	

		$stagearray=array();
		$wt_arr=array();
			
		$stadatey=date("Y",strtotime($date1));
		if($type =="YS")
		{
			$stadatem="01";
		}
		else
		{
			$stadatem=date("m",strtotime($date1));
		}
		if($type =="MS" || $type =="MB" || $type =="YS")
		{
			$stadated="01";
		}
		else
		{
			$stadated=date("d",strtotime($date1));
		}
		$stadateh=date("H",strtotime($date1));
		$stadatei=date("i",strtotime($date1));
		$sm=$stadatey."-".$stadatem;
		
		if($type =="DS" || $type =="DB")
		{
			$stadate=strtotime($date1);
			$enddate=strtotime($date2)+86400;
		}
		elseif($type =="MS" || $type =="MB")
		{
			$date_y=date("Y",strtotime($date1));
			$date_m=date("m",strtotime($date1));
			$info = cal_days_in_month( CAL_GREGORIAN , $date_m , $date_y ) ;
			$stadate=strtotime(date("Y-m",strtotime($date1))."-01");
			$enddate=strtotime(date("Y-m",strtotime($date2))."-".$info."")+86400;
		}
		elseif($type =="YS")
		{
			$stadate=strtotime(date("Y",strtotime($date1))."-01-01");
			$enddate=strtotime(date("Y",strtotime($date1))."-12-31")+86400;
		}
		else{}	

		while($stadate < $enddate)
		{

			if ($row = mssql_fetch_array($result))
			{
				
				if($type =="DS" || $type =="DB" || $type =="MS" || $type =="MB")
				{
					$sname=strtotime($row['adate']);
				}
				elseif($type =="YS")
				{
					$sname=strtotime($row['adate']."-01");
				}
				else{}
				
				while($stadate < $sname)
				{
					array_push($wt_arr,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					if ($p_format=="0" or $p_format=="1")
					{
						$stadatei+=$a;
						$stadate+=$a*60;
					}
					else
					{
						
						$info = cal_days_in_month( CAL_GREGORIAN , $stadatem , $stadatey ) ;
						$stadate += ($info * 24 * 60 * 60);
						$stadatey=date("Y",$stadate);
						$stadatem=date("m",$stadate);
						$stadated=date("d",$stadate);
						$stadateh=date("H",$stadate);
						$stadatei=date("i",$stadate);
					}
				
				}

				if($row["avalue"]==null){$val="null";}else{$val=$row["avalue"];}
				array_push($wt_arr,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."), ".$val."]");

				if ($type =="DS" || $type =="DB" || $type =="MS" || $type =="MB")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}
				else
				{
				
					$info = cal_days_in_month( CAL_GREGORIAN ,$stadatem ,$stadatey ) ;
					$stadate += ($info * 24 * 60 * 60);
					$stadatey=date("Y",$stadate);
					$stadatem=date("m",$stadate);
					$stadated=date("d",$stadate);
					$stadateh=date("H",$stadate);
					$stadatei=date("i",$stadate);
				}
			
			}
			else
			{
				array_push($wt_arr,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
				if ($type =="DS" || $type =="DB" || $type =="MS" || $type =="MB")
					{
						$stadatei+=$a;
						$stadate+=$a*60;
					}
					else
					{
						$info = cal_days_in_month( CAL_GREGORIAN ,$stadatem , $stadatey ) ;
						$stadate += ($info * 24 * 60 * 60);
						$stadatey=date("Y",$stadate);
						$stadatem=date("m",$stadate);
						$stadated=date("d",$stadate);
						$stadateh=date("H",$stadate);
						$stadatei=date("i",$stadate);
					}
				
			}
		}
		$ponts_str=implode(",",$wt_arr);

			?>
			<br>
			<div id="graph" ></div>
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
							renderTo: 'graph',
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
							text: '<?php echo $nametype." ".$namedateshow;?>',
						
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
							series: [{
								//pointInterval:900 * 1000,
								name: 'สถานี <?php echo $Dname;?>',
								//pointStart: Date.UTC(<? echo $syy+543 ;?>, <? echo $smm-1 ;?>, <? echo $sday ;?>),
								data: [<? echo $ponts_str;?>]

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
		$wlH="หน้า ปตร.";
		$wlL="ท้าย ปตร.";

		$stralarm="select stn_id,CONVERT(decimal(10,1),Alram_L1) a_L1,CONVERT(decimal(10,1),Alram_L2) a_L2,CONVERT(float,Alram_L2+10) alarm FROM [KOLOK].[dbo].[TM_STN] where STN_ID='$ssite' ";	
		$realarm = mssql_query($stralarm);
		$malarm=mssql_fetch_array($realarm);
		$A_L1=$malarm['a_L1'];
		$A_L2=$malarm['a_L2'];
		$A_alarm=$malarm['alarm'];	
			
		$a=0;
		if($type =="DS")
		{
			$p_date=date("Y-m-d",strtotime($date1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;
			if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
			{
				$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '200' then CONVERT(decimal(38,2),Value) end) avalue,sum(case sensor_id when '201' then CONVERT(decimal(38,2),Value) end) bvalue  FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date1 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite'  group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
			}
			else
			{
				$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '200' then CONVERT(decimal(38,2),Value) end) avalue 
				FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date1 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite'  group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
			}
		}
		elseif($type =="DB")
		{
			$p_date=date("Y-m-d",strtotime($date1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;
			if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
			{
				$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '200' then CONVERT(decimal(38,2),Value) end) avalue,sum(case sensor_id when '201' then CONVERT(decimal(38,2),Value) end) bvalue FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date2 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite'   group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
			}
			else
			{
				$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '200' then CONVERT(decimal(38,2),Value) end) avalue 
				FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date2 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite'   group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
			}
		}
		elseif($type =="MS")
		{
			$p_date=date("Y-m",strtotime($date1));
			$p_date2=date("Y-m",strtotime($date2));
			$maxZ= 24 * 3600000;
			$pointIn= 24 * 3600 * 1000; // 1 day
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%e. %B %Y";
			$minva = $maxva = null;
			$a=60*24;
			$b=86400;
			if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
			{
				$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,CONVERT(decimal(10,2), avg(case sensor_id when '200' then value end)) avalue,,CONVERT(decimal(10,2), avg(case sensor_id when '201' then value end)) bvalue  FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm1."' and datepart(MINUTE,DT) % 15 = 0 and 
				STN_ID='$ssite'   group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
			}
			else
			{
				$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,CONVERT(decimal(10,2), avg(case sensor_id when '200' then value end)) avalue 
				FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm1."' and datepart(MINUTE,DT) % 15 = 0 and 
				STN_ID='$ssite'  group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
			}
		}
		elseif($type =="MB")
		{
			$p_date=date("Y-m",strtotime($date1));
			$p_date2=date("Y-m",strtotime($date2));
			$maxZ= 24 * 3600000;
			$pointIn= 24 * 3600 * 1000; // 1 day
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%e. %B %Y";
			$minva = $maxva = null;
			$a=60*24;
			$b=86400;
			if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
			{
				$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,CONVERT(decimal(10,2), avg(case sensor_id when '200' then value end)) avalue,CONVERT(decimal(10,2), avg(case sensor_id when '201' then value end)) bvalue FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' and datepart(MINUTE,DT) % 15 = 0 and 
				STN_ID='$ssite'  group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
			}
			else
			{
				$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,CONVERT(decimal(10,2), avg(case sensor_id when '200' then value end)) avalue 
				FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' and datepart(MINUTE,DT) % 15 = 0 and 
				STN_ID='$ssite' group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
			}
		}
		elseif($type =="YS")
		{
			$p_date=date("Y",strtotime($date1));
			$p_date2=date("Y",strtotime($date2));
			$mmdate=date("m",strtotime($date1))-1;
			$formatdd="%B %Y";
			$minva = $maxva = null;
			if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
			{
				$strQuery="select DISTINCT CONVERT(varchar(7),DT,120) adate,CONVERT(decimal(10,2), avg(case sensor_id when '200' then value end)) avalue,CONVERT(decimal(10,2), avg(case sensor_id when '201' then value end)) bvalue FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' and datepart(MINUTE,DT) % 15 = 0 and 
				STN_ID='$ssite' and Value <> 0 group BY CONVERT(varchar(7),DT,120) order by CONVERT(varchar(7),DT,120)";
			}
			else
			{
				$strQuery="select DISTINCT CONVERT(varchar(7),DT,120) adate,CONVERT(decimal(10,2), avg(case sensor_id when '200' then value end)) avalue 
				FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' and datepart(MINUTE,DT) % 15 = 0 and 
				STN_ID='$ssite' and Value <> 0 group BY CONVERT(varchar(7),DT,120) order by CONVERT(varchar(7),DT,120)";
			}
		}
		else{}

	   $result = mssql_query($strQuery); 
	  // while ($row_rs_tu01 = odbc_fetch_array($result));	

		$stagearray=array();
		$wt_arr=array();
		$wt_arr2=array();
		
		$stadatey=date("Y",strtotime($date1));
		if($type=="YS")
		{
			$stadatem="01";
		}
		else
		{
			$stadatem=date("m",strtotime($date1));
		}
		if($type=="MS" || $type=="MB" || $type=="YS")
		{
			$stadated="01";
		}
		else
		{
			$stadated=date("d",strtotime($date1));
		}
		$stadateh=date("H",strtotime($date1));
		$stadatei=date("i",strtotime($date1));
		$sm=$stadatey."-".$stadatem;
		
		if($type=="DS" || $type=="DB")
		{
			$stadate=strtotime($date1);
			$enddate=strtotime($date2)+86400;
		}
		elseif($type=="MS" || $type=="MB")
		{
			$date_y=date("Y",strtotime($date1));
			$date_m=date("m",strtotime($date1));
			$info = cal_days_in_month( CAL_GREGORIAN , $date_m , $date_y ) ;
			$stadate=strtotime(date("Y-m",strtotime($date1))."-01");
			$enddate=strtotime(date("Y-m",strtotime($date2))."-".$info."")+86400;
		}
		elseif($type=="YS")
		{
			$stadate=strtotime(date("Y",strtotime($date1))."-01-01");
			$enddate=strtotime(date("Y",strtotime($date2))."-12-31")+86400;
		}
		else{}	

		while($stadate < $enddate)
		{

			if ($row = mssql_fetch_array($result))
			{
				
				if($type=="DS" || $type=="DB" || $type=="MS" || $type=="MB")
				{
					$sname=strtotime($row['adate']);
				}
				elseif($type=="YS")
				{
					$sname=strtotime($row['adate']."-01");
				}
				else{}
				
				while($stadate < $sname)
				{
					array_push($wt_arr,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					array_push($wt_arr2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					if ($type=="DS" || $type=="DB" || $type=="MS" || $type=="MB")
					{
						$stadatei+=$a;
						$stadate+=$a*60;
					}
					else
					{
						
						$info = cal_days_in_month( CAL_GREGORIAN , $stadatem , $stadatey ) ;
						$stadate += ($info * 24 * 60 * 60);
						$stadatey=date("Y",$stadate);
						$stadatem=date("m",$stadate);
						$stadated=date("d",$stadate);
						$stadateh=date("H",$stadate);
						$stadatei=date("i",$stadate);
					}
				
				}
				if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
				{
					if($row["avalue"]==null){$val="null";}else{$val=$row["avalue"];}
					if($row["bvalue"]==null){$val2="null";}else{$val2=$row["bvalue"];}
					array_push($wt_arr,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."), ".$val."]");
					array_push($wt_arr2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."), ".$val2."]");
				}
				else
				{
					if($row["avalue"]==null){$val="null";}else{$val=$row["avalue"];}
					array_push($wt_arr,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."), ".$val."]");
				}

				if ($type=="DS" || $type=="DB" || $type=="MS" || $type=="MB")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}
				else
				{
				
					$info = cal_days_in_month( CAL_GREGORIAN ,$stadatem ,$stadatey ) ;
					$stadate += ($info * 24 * 60 * 60);
					$stadatey=date("Y",$stadate);
					$stadatem=date("m",$stadate);
					$stadated=date("d",$stadate);
					$stadateh=date("H",$stadate);
					$stadatei=date("i",$stadate);
				}
			
			}
			else
			{
				array_push($wt_arr,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
				array_push($wt_arr2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
				if ($type=="DS" || $type=="DB" || $type=="MS" || $type=="MB")
					{
						$stadatei+=$a;
						$stadate+=$a*60;
					}
					else
					{
						$info = cal_days_in_month( CAL_GREGORIAN ,$stadatem , $stadatey ) ;
						$stadate += ($info * 24 * 60 * 60);
						$stadatey=date("Y",$stadate);
						$stadatem=date("m",$stadate);
						$stadated=date("d",$stadate);
						$stadateh=date("H",$stadate);
						$stadatei=date("i",$stadate);
					}
				
			}
		}
		if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
		{
			$ponts_str=implode(",",$wt_arr);
			$ponts_str2=implode(",",$wt_arr2);
		}
		else
		{
			$ponts_str=implode(",",$wt_arr);
		}
		?>

			<div id="graph" class="span6" style="min-width: 1350px; height: 530px; margin: 0 auto"></div>
			<?if($ssite=="Tkol.18" || $ssite=="Tkol.19" || $ssite=="Tkol.25")
			{?>
			<script type="text/javascript">

			$(function () {				 
				$(document).ready(function() {
					Highcharts.setOptions({
					lang: {	months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
					});
					var chart = new Highcharts.Chart({
						chart: {
							renderTo: 'graph',
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
							text: '<? echo $nametype." ".$namedateshow;?>',
							x: -20, //center
						style: {
							fontSize: '14px'
						}
						},
						legend: {
							layout: 'vertical',
							align: 'left',
							verticalAlign: 'top',
							x: 100,
							y: 35,
							floating: true,
							borderWidth: 1,
							backgroundColor: '#FFFFFF'
						},
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
							maxPadding: 0.5,
							title: {text: '<? echo $yaname;?>'}}
						],
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
						series: [{
							type: 'line',
							name: '<? echo $wlH;?>',
							data: [<? echo $ponts_str;?>],
						
							dashStyle:'shortdot'
								},
							{
							type: 'line',
							name: '<? echo $wlL;?>',
							data: [<? echo $ponts_str2;?>],							
							dashStyle:'solid'
						}]
					});
						
				});

			});
			</script>
			<?}
			else
			{?>
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
							renderTo: 'graph',
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
							text: '<? echo $nametype." ".$namedateshow;?>',
						
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
							minPadding: 2,
							maxPadding: 2,
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
							//series:{marker:{enabled:false}}
						},
						exporting: {
							url: 'http://telekolok.com/exporting_server/index.php'
						},
						scrollbar: {
							 enabled: true
						},
						series: [{
							//pointInterval:900 * 1000,
							name: 'สถานี <?php echo $Dname;?>',
							//pointStart: Date.UTC(<? echo $syy+543 ;?>, <? echo $smm-1 ;?>, <? echo $sday ;?>),
							data: [<? echo $ponts_str;?>]

						}]
					});
				});

			});
			</script>
			<?	
			}
	}
	else
	{}
?>
<?
/*------------------------function----------------------------------*/
function ShortThaiDate($txt,$ss,$ssite,$ty)
{
	global $ThaiSubMonth;
	$Year = substr(substr($txt, 0, 4)+543, -4);
	$Month = substr($txt, 5, 2);
	$DayNo = substr($txt, 8, 2);
	$T = substr($txt, 11, 5);
	
	if($ty=="rf")
	{
		if($ssite=="Tkol.1" || $ssite=="Tkol.5" || $ssite=="Tkol.16" || $ssite=="Tkol.17" || $ssite=="Tkol.18" || $ssite=="Tkol.24" || $ssite=="Tkol.25")
		{
			$x="n/a";
		}
		else
		{
			if($ss==1)
			{
				$x = $DayNo."/".$Month."/".$Year." "."เวลา ".$T." น.";
			}
			else if($ss==2)
			{
				$x = $DayNo."/".$Month."/".$Year;
			}
			else 
			{
				$x = $Month."/".$Year;
			}
		}
	}
	elseif($ty=="wl")
	{
		if($ssite=="Tkol.8" || $ssite=="Tkol.9" || $ssite=="Tkol.10" || $ssite=="Tkol.13" || $ssite=="Tkol.15" || $ssite=="Tkol.22" || $ssite=="Tkol.23")
		{
			$x="n/a";
		}
		else
		{
			if($ss==1)
			{
				$x = $DayNo."/".$Month."/".$Year." "."เวลา ".$T." น.";
			}
			else if($ss==2)
			{
				$x = $DayNo."/".$Month."/".$Year;
			}
			else 
			{
				$x = $Month."/".$Year;
			}
		}
	}
	else
	{
		if($ss==1)
		{
			$x = $DayNo."/".$Month."/".$Year." "."เวลา ".$T." น.";
		}
		else if($ss==2)
		{
			$x = $DayNo."/".$Month."/".$Year;
		}
		else 
		{
			$x = $Month."/".$Year;
		}
	}
	return $x;
}

function checkrf($n,$ssite,$mm)
{
	if($ssite=="Tkol.1" || $ssite=="Tkol.5" || $ssite=="Tkol.16" || $ssite=="Tkol.17" || $ssite=="Tkol.18" || $ssite=="Tkol.24" || $ssite=="Tkol.25")
	{
		$s="n/a";
	}
	else
	{
		$s=number_format($n,2);
	}
	return $s;
}

function checkna($n,$ssite,$mm)
{
	if($ssite=="Tkol.8" || $ssite=="Tkol.9" || $ssite=="Tkol.10" || $ssite=="Tkol.13" || $ssite=="Tkol.15" || $ssite=="Tkol.22" || $ssite=="Tkol.23")
	{
			if($mm=="0")
			{
				$s=number_format($n,2);
			}
			else
			{
				$s="n/a";
			}
	}
	elseif($n=="")
	{
		$s="-";
	}
	else
	{
		$s=number_format($n,2);
	}
	return $s;
}


?>
<script type="text/javascript">
$(document).ready(function()
{
	//alert("aa");
	$('.datatable').fixedtableheader({ headerrowsize:2 });


});
</script>