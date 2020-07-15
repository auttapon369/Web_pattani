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
	$wlavg=array();
	$wlmin=array();
	$wlmax=array();
	$timerf=array();
	$timeavg=array();
	$timemin=array();
	$timemax=array();
	if($type =="DS" or $type =="DB")
	{
	?>
				<table CLASS="datatable" align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="2" >ปริมาณน้ำฝน (มม.)</td>
					<td rowspan="2">ระดับน้ำ เมตร (รทก.)</td>
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
								<td><? echo ShortThaiDate($r_check['adate'],1)?></td>
								<td><?=checkna($r_check['rf'],$STN_ID,0)?></td>
								<td><?if($vmin=="45"){ echo checkna($sumrfh['vhour'],$STN_ID,0);}?></td>
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
			<td><?=checkna($min15,$STN_ID,0)?></td>
			<td><?=checkna($min1h,$STN_ID,0)?></td>
			<td><?=checkna($minwl,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">MAX</td>
			<td><?=checkna($max15,$STN_ID,0)?></td>
			<td><?=checkna($max1h,$STN_ID,0)?></td>
			<td><?=checkna($maxwl,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">SUM</td>
			<td><?echo number_format($totalrf,2);?></td>
			<td><?echo number_format($totalrf,2);?></td>
			<td>-</td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">Average</td>
			<td>-</td>
			<td>-</td>
			<td><?echo number_format($avgwl,2);?></td>
		</tr>
		</tfoot>
		</table>
	<?}
	else if($type =="MS" or $type =="MB")
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
							<td><? echo ShortThaiDate($r_check['adate'],2)?></td>
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
				<td><? echo ShortThaiDate($dtminrf,2)?></td>
				<td><? echo ShortThaiDate($dtmin_avg,2)?></td>
				<td><? echo ShortThaiDate($dtmin_min,2)?></td>
				<td><? echo ShortThaiDate($dtmin_max,2)?></td>
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
				<td><? echo ShortThaiDate($dtmaxrf,2)?></td>
				<td><? echo ShortThaiDate($dtmax_avg,2)?></td>
				<td><? echo ShortThaiDate($dtmax_min,2)?></td>
				<td><? echo ShortThaiDate($dtmax_max,2)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">SUM</td>
				<td><?echo number_format($totalrf,2);?></td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">Average</td>
				<td>-</td>
				<td><?=checkna($avg_wl,$STN_ID,1)?></td>
				<td><?=checkna($min_wl,$STN_ID,1)?></td>
				<td><?=checkna($max_wl,$STN_ID,1)?></td>
			</tr>
		</tfoot>
		</table>
		</div>
	<?}
	else if($type =="YS" )
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
							<td><? echo ShortThaiDate($r_check['adate'],3)?></td>
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
				<td><? echo ShortThaiDate($dtminrf,3)?></td>
				<td><? echo ShortThaiDate($dtmin_avg,3)?></td>
				<td><? echo ShortThaiDate($dtmin_min,3)?></td>
				<td><? echo ShortThaiDate($dtmin_max,3)?></td>
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
				<td><? echo ShortThaiDate($dtmaxrf,3)?></td>
				<td><? echo ShortThaiDate($dtmax_avg,3)?></td>
				<td><? echo ShortThaiDate($dtmax_min,3)?></td>
				<td><? echo ShortThaiDate($dtmax_max,3)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">SUM</td>
				<td><?echo number_format($totalrf,2);?></td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">Average</td>
				<td>-</td>
				<td><?=checkna($avg_wl,$STN_ID,1)?></td>
				<td><?=checkna($min_wl,$STN_ID,1)?></td>
				<td><?=checkna($max_wl,$STN_ID,1)?></td>
			</tr>
		</tfoot>
		</table>
		</div>
	<?}
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
		
		if($type =="DS")
		{
			$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date1 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite' and sensor_id = '100' 
			group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
		}
		elseif($type =="DB")
		{
			$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date2 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite' and sensor_id = '100' 
			group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
		}
		elseif($type =="MS")
		{
			$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm1."' and datepart(MINUTE,DT) % 15 = 0 and 
			STN_ID='$ssite' and sensor_id = '100' group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
		}
		elseif($type =="MB")
		{
			$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' and datepart(MINUTE,DT) % 15 = 0 and 
			STN_ID='$ssite' and sensor_id = '100' group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
		}
		elseif($type =="YS")
		{
			$strQuery="select DISTINCT CONVERT(varchar(7),DT,120) adate,sum(case sensor_id when '100' then CONVERT(decimal(10,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' and datepart(MINUTE,DT) % 15 = 0 and 
			STN_ID='$ssite' and sensor_id = '100' group BY CONVERT(varchar(7),DT,120) order by CONVERT(varchar(7),DT,120)";
		}
		else{}


		$result = mssql_query($strQuery); 
	  // while ($row_rs_tu01 = odbc_fetch_array($result));	
		$stagearray=array();
		$wt_arr=array();
		
		/*------------------------------Daily----------------------------*/
		if($type =="DS" or $type =="DB")
		{
			$stadate=strtotime($date1);
			$maxZ= 1 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=$smm-1;
			$formatdd="%e. %B %Y %H:%M";
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
		}
		elseif($type =="MS" or $type =="MB")
		{
			$stadate=date("d-m-Y",strtotime($date1));
			$maxZ= 24 * 3600000;
			$pointIn= 24 * 3600 * 1000; // 1 day
			$mmdate=$smm-1;
			$formatdd="%e. %B %Y ";
			while($row = mssql_fetch_array($result))
				{
					$sname=date("d-m-Y",strtotime($row['adate']));
					array_push($stagearray,$sname);
					array_push($wt_arr,$row["avalue"]);
				}
				$categories=implode(",",$stagearray);
				$ponts_str=implode(",",$wt_arr);
		}
		else
		{
			$stadate=date("m-Y",strtotime($date1));
			$maxZ=  30 * 24 * 3600000;
			$pointIn= 30 * 24 * 3600 * 1000; // 1 month
			$mmdate=$smm;
			$formatdd="%B %Y";
			while($row = mssql_fetch_array($result))
				{
					$sname=date("m-Y",strtotime($row['adate']));
					array_push($stagearray,$sname);
					array_push($wt_arr,$row["avalue"]);
				}
				$categories=implode(",",$stagearray);
				$ponts_str=implode(",",$wt_arr);
		}


			?>
			<br>
			<div id="container" class="span6" style="min-width: 1350px; height: 530px; margin: 0 auto"></div>
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
							maxZoom: <?php echo $maxZ;?>,
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
							return  Highcharts.dateFormat('<?php echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+'  มม.';
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
							pointInterval:<?php echo $pointIn;?>,
							name: 'สถานี <?php echo $Dname;?>',
							pointStart: Date.UTC(<?php echo $syy+543 ;?>, <?php echo $smm-1 ;?>, <?php echo $sday ;?>),
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

		$stralarm="select stn_id,CONVERT(decimal(10,1),Alram_L1) a_L1,CONVERT(decimal(10,1),Alram_L2) a_L2,CONVERT(float,Alram_L2+10) alarm FROM [KOLOK].[dbo].[TM_STN] where STN_ID='$ssite' ";	
		$realarm = mssql_query($stralarm);
		$malarm=mssql_fetch_array($realarm);
		$A_L1=$malarm['a_L1'];
		$A_L2=$malarm['a_L2'];
		$A_alarm=$malarm['alarm'];	
			
		if($type =="DS")
		{
			$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '200' then CONVERT(decimal(38,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date1 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite' and sensor_id = '200' 
			  group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
		}
		elseif($type =="DB")
		{
			$strQuery="select DISTINCT CONVERT(varchar(16),DT,120) adate,sum(case sensor_id when '200' then CONVERT(decimal(38,2),Value) end) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE DT BETWEEN '$date1 00:00' AND '$date2 23:45' and datepart(MINUTE,DT) % 15 = 0 and STN_ID='$ssite' and sensor_id = '200' 
			  group BY CONVERT(varchar(16),DT,120) order by CONVERT(varchar(16),DT,120) ";
		}
		elseif($type =="MS")
		{
			$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,CONVERT(decimal(10,2), avg(case sensor_id when '200' then value end)) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm1."' and datepart(MINUTE,DT) % 15 = 0 and 
			STN_ID='$ssite' and sensor_id = '200'   group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
		}
		elseif($type =="MB")
		{
			$strQuery="select DISTINCT CONVERT(varchar(10),DT,120) adate,CONVERT(decimal(10,2), avg(case sensor_id when '200' then value end)) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' and datepart(MINUTE,DT) % 15 = 0 and 
			STN_ID='$ssite' and sensor_id = '200'  group BY CONVERT(varchar(10),DT,120) order by CONVERT(varchar(10),DT,120) ";
		}
		elseif($type =="YS")
		{
			$strQuery="select DISTINCT CONVERT(varchar(7),DT,120) adate,CONVERT(decimal(10,2), avg(case sensor_id when '200' then value end)) avalue 
			FROM [KOLOK].[dbo].[DATA_Backup] WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' and datepart(MINUTE,DT) % 15 = 0 and 
			STN_ID='$ssite' and sensor_id = '200'  and Value <> 0 group BY CONVERT(varchar(7),DT,120) order by CONVERT(varchar(7),DT,120)";
		}
		else{}

	   $result = mssql_query($strQuery); 
	  // while ($row_rs_tu01 = odbc_fetch_array($result));	
		$stagearray=array();
		$wt_arr=array();
		$da_arr=array();

		/*------------------------------Daily----------------------------*/
		if($type =="DS" or $type =="DB" or $type =="MS" or $type =="MB")
		{
			if($type =="DS" or $type =="DB")
			{
			//$stadate=date("d-m-y H:i",strtotime($date1));
			$stadate=strtotime($date1);
				$maxZ= 3 * 3600000;
				$pointIn= 900 * 1000; // 15 min
				$mmdate=$smm-1;
				$formatdd="%e. %B %Y %H:%M";
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
					//$stadate += 900;
					//echo "C".date("d-m-y H:i",$stadate)." ";
					array_push($stagearray,$sname);
					array_push($wt_arr,$row["avalue"]);
				}
				$minva=min($wt_arr);
				$maxva=max($wt_arr);
				$div=($maxva-$minva)/80;
				$minva=$minva-$div*10;
				$maxva=$minva+$div*10;
				$categories=implode(",",$stagearray);
				$ponts_str=implode(",",$wt_arr);
			}
			elseif($type =="MS" or $type =="MB")
			{
				$stadate=date("d-m-Y",strtotime($date1));
				$maxZ= 12 * 24 * 3600000;
				$pointIn=  24 * 3600 * 1000; // 1 day
				$mmdate=$smm-1;
				$formatdd="%e. %B %Y ";
				while($row = mssql_fetch_array($result))
					{
						$sname=date("d-m-Y",strtotime($row['adate']));
						array_push($stagearray,$sname);
						array_push($wt_arr,$row["avalue"]);
					}
					$minva=min($wt_arr);
					$maxva=max($wt_arr);
					$div=($maxva-$minva)/80;
					$minva=$minva-$div*10;
					$maxva=$minva+$div*10;
					$categories=implode(",",$stagearray);
					$ponts_str=implode(",",$wt_arr);
			}
			?>

			<div id="WL" class="span6" style="min-width: 1350px; height: 530px; margin: 0 auto"></div>
			<script type="text/javascript">

			$(function () {
				var chart;
				$(document).ready(function() {

					Highcharts.setOptions({
					lang: {
						months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']}
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
						y: -460
						},		
						xAxis: {
							type: 'datetime',
							maxZoom: <?php echo $maxZ;?>,
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
							//min: '<?php echo $minva;?>',
							minPadding: 0.5,
							maxPadding: 0.5,
							title: {
								text: '<?php echo $yaname;?>'
							}
						},
						tooltip: {
							formatter: function() {
							return  Highcharts.dateFormat('<?php echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+'  เมตร.รทก.';
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

						plotOptions: {
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
						},    
						scrollbar: {
							 enabled: true
						 },
						series: [{
							type: 'area',
							pointInterval:<?php echo $pointIn;?>,
							name: 'สถานี <?php echo $Dname;?> ',
							pointStart: Date.UTC(<?php echo $syy+543 ;?>,<?php echo $smm-1 ;?>, <?php echo $sday ;?>),
							 data: [<?php echo $ponts_str;?>]

						}
						]
					});
				});

			});
			</script>

	<?
		}
		else if($type =="YS")
		{
			$sta=date("m",strtotime("1"));
			$stadate=date("Y",strtotime($date1));
			$maxZ= 365 * 24 * 3600000;
			$formatdd="%B %Y";
			$mm=0;
			while($row = mssql_fetch_array($result))
				{
					$smouth=date("m",strtotime($row['adate']));
					$sm=$smouth-1;
					$syear=$stadate+543;
					array_push($stagearray,$sname);
					array_push($wt_arr,$row["avalue"]);
					while($mm<$sm)
					{
						array_push($da_arr,"[ Date.UTC(".$syear.",".$mm."),  null]");
						$mm+=1;
					}
						array_push($da_arr,"[ Date.UTC(".$syear.",".$sm."),  ".$row["avalue"]."]");
						$mm+=1;
				}
					while($mm<12)
					{
						array_push($da_arr,"[ Date.UTC(".$syear.",".$mm."),  null]");
						$mm+=1;
					}

				$minva=min($wt_arr);
				$maxva=max($wt_arr);
				$div=($maxva-$minva)/80;
				$minva=$minva-$div*10;
				$maxva=$maxva+$div*10;
				$categories=implode(",",$stagearray);
				$ponts_str=implode(",",$wt_arr);
				$da=implode(",",$da_arr);
				
				?>

			<div id="WL" class="span6" style="min-width: 1350px; height: 530px; margin: 0 auto"></div>
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
							//zoomType: 'x',
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
						y: -460
						},		
						xAxis: {
							type: 'datetime',
							//maxZoom: <?php echo $maxZ;?>,
							//min: Date.UTC(<?php echo $stadate;?>),
							//minTickInterval:12,
							//tickInterval: 1,
							title: {
								text: null
							},
							labels:{
							rotation:-45,
							align:'right',
							fontSize: '8px'
							},
							dateTimeLabelFormats: {
							//day: '%e %B %Y',
							//week:'%e %B %Y',
							month:'%B %Y',
							year:'%Y'
						}
						},
					   yAxis: {
							//min: '<?php echo $minva;?>',
							minPadding: 0.5,
							maxPadding: 0.5,
							title: {
								text: '<?php echo $yaname;?>'
							}
						},
						tooltip: {
							formatter: function() {
							return  Highcharts.dateFormat('<?php echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+'  เมตร.รทก.';
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

						plotOptions: {
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
						},    
						scrollbar: {
							 enabled: true
						 },
						series: [{
							type: 'area',
							//pointInterval:<?php echo $pointIn;?>,
							name: 'สถานี <?php echo $Dname;?> ',
							//pointStart: Date.UTC(<?php echo $syy ;?>,<?php echo $smm-1 ;?>, <?php echo $sday ;?>),
							 data: [ <?php echo $da;?> ]
							//data: [ [Date.UTC(2013,2), 0.00],[Date.UTC(2013,3), 167.59],[Date.UTC(2013,4), 178.61],[Date.UTC(2013,5), 178.37],[Date.UTC(2013,6), 179.58],[Date.UTC(2013,7), 180.82],[Date.UTC(2013,8), 183.36],[Date.UTC(2013,9), 183.44] ]

						}
						]
					});
				});

			});
			//alert("aa");
			</script>
		<?
		}
		else{}

	}
	else
	{}
?>
<?
/*------------------------function----------------------------------*/
function ShortThaiDate($txt,$ss)
{
	global $ThaiSubMonth;
	$Year = substr(substr($txt, 0, 4)+543, -4);
	$Month = substr($txt, 5, 2);
	$DayNo = substr($txt, 8, 2);
	$T = substr($txt, 11, 5);
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
	return $x;
}

function checkna($n,$ssite,$mm)
{
	if($ssite=="TNU1" || $ssite=="TNY1" || $ssite=="TSL1" || $ssite=="TSL2" || $ssite=="TSU1" || $ssite=="TSU2")
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