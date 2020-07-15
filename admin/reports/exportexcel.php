<?php
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
	
	$server = "192.168.103.12"; //database location
	//$server = "110.164.126.120"; //database location
	$user = "sa"; //database username
	$pass = "ata+ee&c"; //database password
	$db_name = "PATTANI"; //database name

	$dsn = "Driver={SQL Server};Server=$server;Database=$db_name";
	//$connection = mssql_connect($server, $user, $pass);
	$connection = odbc_connect($dsn, $user, $pass);
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
		from [PATTANI].[dbo].[DATA_Backup] DB,[PATTANI].[dbo].[DATA_Backup] DB1 where DB.DT='$date1' and DB1.DT='$date2' and DB.STN_ID='$ssite'";
	}
	else if($type=="MS")
	{
		$ddate="select top 1 datepart(DD,DB.DT) dday,datepart(MM,DB.DT) dmm,datepart(YY,DB.DT) dyy ,convert(varchar(10),DB.DT,120) dt ,
		datepart(DD,DB1.DT) dday1,datepart(MM,DB1.DT) dmm1,datepart(YY,DB1.DT) dyy1 ,convert(varchar(10),DB1.DT,120) dt1
		from [PATTANI].[dbo].[DATA_Backup] DB,[PATTANI].[dbo].[DATA_Backup] DB1 where CONVERT(varchar(7),DB.DT,120)='$dtmm1' and CONVERT(varchar(7),DB1.DT,120)='$dtmm2'
		 and DB.STN_ID='$ssite' order by DB.DT";
	}
	else
	{
		$ddate="select top 1 datepart(DD,DT) dday,datepart(MM,DT) dmm,datepart(YY,DT) dyy ,convert(varchar(10),DT,120) dt
		from [PATTANI].[dbo].[DATA_Backup] DB where CONVERT(varchar(4),DB.DT,120)='$dtyy' and STN_ID='$ssite' order by DT";
	}

	$dda = odbc_exec($connection,$ddate);
    $ndd=odbc_fetch_array($dda);
	$sday=$ndd['dday'];
	$smm=$ndd['dmm'];
	$syy=$ndd['dyy'];
	$dt=$ndd['dt'];
	$sday1=$ndd['dday1'];
	$smm1=$ndd['dmm1'];
	$syy1=$ndd['dyy1'];
	$dt1=$ndd['dt1'];
	
	
	$compare_T=DateDiff($date1,$date2);
	
	$dta = (int)$sday."-".$smm."-".$syy;
	$dta1 = (int)$sday1."-".$smm1."-".$syy1;
	$ndtm = $smm."-".$syy;
	$ndtm1 = $smm1."-".$syy1;
	$ndty = $syy;
	$ndty1 = $syy1;

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
		if($type=="DS")
		{
			$namedateshow="ระหว่างวันที่  $dta ถึง $dta1";
		}
		elseif($type=="MS")
		{
			$namedateshow="ระหว่างเดือน  $ndtm ถึง $ndtm1";
		}
		else{}
	}
	
	$ss="SELECT STN_ID,STN_CODE,STN_NAME_THAI FROM [PATTANI].[dbo].[TM_STN] where STN_ID='$ssite'";
    $ress = odbc_exec($connection,$ss);
    $namesta=odbc_fetch_array($ress);
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

	$flow=array();
	$flowavg=array();
	$flowmin=array();
	$flowmax=array();
	$timeavgflow=array();
	$timeminflow=array();
	$timemaxflow=array();

	$velocity=array();
	$velocityavg=array();
	$velocitymin=array();
	$velocitymax=array();
	$timeavgvelocity=array();
	$timeminvelocity=array();
	$timemaxvelocity=array();

	$area=array();
	$areaavg=array();
	$areamin=array();
	$areamax=array();
	$timeavgarea=array();
	$timeminarea=array();
	$timemaxarea=array();

	if($type =="DS" or $type =="DB")
	{
		if($ssite=="Tpat.12")
		{
		?>
	
				<table CLASS="datatable" align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="1" >ปริมาณน้ำฝน (มม.)</td>
					<td colspan="1">ระดับน้ำ (เมตร รทก.)</td>
					<td colspan="1">ระดับน้ำท้าย ปตร. (เมตร รทก.)</td>
				</tr>
				<tr class="tr_head">
				<td >15 นาที</td>
				<td >15 นาที</td>
				<td >15 นาที</td>
				</tr>	
				<tbody>
		<?
				if($type =="DS")
				{
						$sss="select distinct CONVERT(varchar(20),DT,120) AS adate,
						sum(case sensor_id when '100' then Value end) rf ,
						sum(case sensor_id when '200' then Value end) wl,
						sum(case sensor_id when '201' then Value end) wle
						FROM [PATTANI].[dbo].[DATA_Backup]  WHERE DT BETWEEN '".$date1." 00:00' AND '".$date2." 23:50' and STN_ID='".$ssite."' 
						group BY CONVERT(varchar(20),DT,120) order by CONVERT(varchar(20),DT,120)";
				}
				else{}

				$rs_check =odbc_exec($connection,$sss);
				$checkrow=odbc_num_rows($rs_check);					
				if($checkrow=="0" )
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=odbc_fetch_array($rs_check))
					{
						$sqltm="select * from [PATTANI].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = odbc_exec($connection,$sqltm);
						$row = odbc_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_ID1 = $row["STN_CODE"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]); 
						
						if ( $r_check['rf'] != "" )
						{
							array_push($minrf,$r_check['rf']);
						}
						if ( $r_check['wl'] != "" )
						{
							array_push($wl,$r_check['wl']);
						}
						if ( $r_check['wle'] != "" )
						{
							array_push($wle,$r_check['wle']);
						}
				?>
							<tr >
								<td><?=$STN_ID1?></td>
								<td><?=$STN_NAME_THAI?></td>
								<td><? echo ShortThaiDate($r_check['adate'],1,$STN_ID,"no")?></td>
								<td><?=checkrf($r_check['rf'],$STN_ID,0)?></td>
								<td><?=checkna($r_check['wl'],$STN_ID,1)?></td>
								<td><?=checkna($r_check['wle'],$STN_ID,1)?></td>
							</tr>
					<?
					}	//end while	 

					if (!empty($minrf)) 
					{
						$min15=min($minrf);
						$max15=max($minrf);
						$avgrf= array_sum($minrf)/ count($minrf);
						$totalrf= array_sum($minrf);
					}
					
					if (!empty($wl)) 
					{
						$minwl=min($wl);
						$maxwl=max($wl);
						$totalwl= array_sum($wl);					
						$avgwl= array_sum($wl) / count($wl);
					}
					if (!empty($wle)) 
					{
						$minwle=min($wle);
						$maxwle=max($wle);
						
						$totalwle= array_sum($wle);
						$avgwle= array_sum($wle) / count($wle);
					}
				}
			?> 
		</tbody>
		<tfoot>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">MIN</td>
			<td><?=checkrf($min15,$STN_ID,1)?></td>
			<td><?=checkna($minwl,$STN_ID,1)?></td>
			<td><?=checkna($minwle,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">MAX</td>
			<td><?=checkrf($max15,$STN_ID,1)?></td>
			<td><?=checkna($maxwl,$STN_ID,1)?></td>
			<td><?=checkna($maxwle,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">SUM</td>
			<td><?=checkrf($totalrf,$STN_ID,1)?></td>
			<td>n/a</td>
			<td>n/a</td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">Average</td>
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
					<td colspan="1" >ปริมาณน้ำฝน (มม.)</td>
					<td colspan="1">ระดับน้ำ (เมตร รทก.)</td>
					<td colspan="3">ปริมาณน้ำ</td>
				</tr>
				<tr class="tr_head">
				<td >15 นาที</td>
				<td >15 นาที</td>
				<td >อัตราการไหล<br><span> (ลบ.ม./วินาที)</span></td>
				<td >ความเร็ว<br><span> (ม./วินาที)</span></td>
				<td >พื้นที่หน้าตัด<br><span> (ตร.ม./วินาที)</span></td>
				</tr>	
				<tbody>
			<?
				if($type =="DS")
				{
						$sss="select distinct CONVERT(varchar(20),DT,120) AS adate,
						sum(case sensor_id when '100' then Value end) rf ,
						sum(case sensor_id when '200' then Value end) wl,
						sum(case sensor_id when '300' then Value end) flow,
						sum(case sensor_id when '301' then Value end) velocity,
						sum(case sensor_id when '302' then Value end) area
						FROM [PATTANI].[dbo].[DATA_Backup]  WHERE DT BETWEEN '".$date1." 00:00' AND '".$date2." 23:50' and STN_ID='".$ssite."' 
						group BY CONVERT(varchar(20),DT,120) order by CONVERT(varchar(20),DT,120)";
				}
				else{}

				$rs_check =odbc_exec($connection,$sss);
				$checkrow=odbc_num_rows($rs_check);					
				if($checkrow=="0" )
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=odbc_fetch_array($rs_check))
					{
						$sqltm="select * from [PATTANI].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = odbc_exec($connection,$sqltm);
						$row = odbc_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_ID1 = $row["STN_CODE"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]); 
						
						if ( $r_check['rf'] != "" )
						{
							array_push($minrf,$r_check['rf']);
						}
						if ( $r_check['wl'] != "" )
						{
							array_push($wl,$r_check['wl']);
						}
						if ( $r_check['flow'] != "" )
						{
							array_push($flow,$r_check['flow']);
						}
						if ( $r_check['velocity'] != "" )
						{
							array_push($velocity,$r_check['velocity']);
						}
						if ( $r_check['area'] != "" )
						{
							array_push($area,$r_check['area']);
						}
				?>
							<tr >
								<td><?=$STN_ID1?></td>
								<td><?=$STN_NAME_THAI?></td>
								<td><? echo ShortThaiDate($r_check['adate'],1,$STN_ID,"no")?></td>
								<td><?=checkrf($r_check['rf'],$STN_ID,1)?></td>
								<td><?=checkna($r_check['wl'],$STN_ID,1)?></td>
								<td><?=checkflow($r_check['flow'],$STN_ID,1)?></td>
								<td><?=checkflow($r_check['velocity'],$STN_ID,1)?></td>
								<td><?=checkflow($r_check['area'],$STN_ID,1)?></td>
							</tr>
					<?
					}	//end while	 

					if (!empty($minrf)) 
					{
						$min15=min($minrf);
						$max15=max($minrf);
						$avgrf= array_sum($minrf)/ count($minrf);
						$totalrf= array_sum($minrf);
					}
					if (!empty($wl)) 
					{
						$minwl=min($wl);
						$maxwl=max($wl);
						$totalwl= array_sum($wl);					
						$avgwl= array_sum($wl) / count($wl);
					}
					if (!empty($flow)) 
					{
						$minflow=min($flow);
						$maxflow=max($flow);
						$totalflow= array_sum($flow);					
						$avgflow= array_sum($flow) / count($flow);
					}
					if (!empty($velocity)) 
					{
						$minvelocity=min($velocity);
						$maxvelocity=max($velocity);
						$totalvelocity= array_sum($velocity);					
						$avgvelocity= array_sum($velocity) / count($velocity);
					}
					if (!empty($area)) 
					{
						$minarea=min($area);
						$maxarea=max($area);
						$totalarea= array_sum($area);					
						$avgarea= array_sum($area) / count($area);
					}
				}
			?> 
		</tbody>
		<tfoot>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">MIN</td>
			<td><?=checkrf($min15,$STN_ID,1)?></td>
			<td><?=checkna($minwl,$STN_ID,1)?></td>
			<td><?=checkflow($minflow,$STN_ID,1)?></td>
			<td><?=checkflow($minvelocity,$STN_ID,1)?></td>
			<td><?=checkflow($minarea,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">MAX</td>
			<td><?=checkrf($max15,$STN_ID,1)?></td>
			<td><?=checkna($maxwl,$STN_ID,1)?></td>
			<td><?=checkflow($maxflow,$STN_ID,1)?></td>
			<td><?=checkflow($maxvelocity,$STN_ID,1)?></td>
			<td><?=checkflow($maxarea,$STN_ID,1)?></td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">SUM</td>
			<td><?=checkrf($totalrf,$STN_ID,1)?></td>
			<td>n/a</td>
			<td>n/a</td>
			<td>n/a</td>
			<td>n/a</td>
		</tr>
		<tr class="tr_list" bgcolor='#EEEED1'>
			<td colspan="3">Average</td>
			<td>n/a</td>
			<td><?=checkna($avgwl,$STN_ID,1)?></td>
			<td><?=checkflow($avgflow,$STN_ID,1)?></td>
			<td><?=checkflow($avgvelocity,$STN_ID,1)?></td>
			<td><?=checkflow($avgarea,$STN_ID,1)?></td>
		</tr>
		</tfoot>
		</table>
	<?
		}
	}
	//////////////////////////////month/////////////////////////////////
	else if($type =="MS" or $type =="MB")
	{
		if($ssite=="Tpat.12")
		{
		?>
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
					sum(case sensor_id when '100' then Value end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then Value end) wlmax,
					min(case sensor_id when '200' then Value end) wlmin,
					CONVERT(decimal(38,2),avg(case sensor_id when '201' then Value end)) wleavg,
					max(case sensor_id when '201' then Value end) wlemax,
					min(case sensor_id when '201' then Value end) wlemin
					FROM [PATTANI].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(10),DT,120) 
					order by CONVERT(varchar(10),DT,120)";
				}
				else
				{
				}
				
				$rs_check =odbc_exec($connection,$sss);
				$row = 1;
				$checkrow=odbc_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=odbc_fetch_array($rs_check))
					{
						$sqltm="select * from [PATTANI].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = odbc_exec($connection,$sqltm);
						$row = odbc_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_ID1 = $row["STN_CODE"];
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
							<td><?=$STN_ID1?></td>
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
	<?}
			elseif($ssite=="Tpat.5" || $ssite=="Tpat.7")
		{?>
		<div>
		<table align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="1" >ปริมาณน้ำฝน (มม.)</td>
					<td colspan="3">ระดับน้ำ เมตร (รทก.)</td>
					<td colspan="3">อัตราการไหล  (ลบ.ม./วินาที)</td>
					<td colspan="3">ความเร็ว (ม./วินาที)</td>
					<td colspan="3">พื้นที่หน้าตัด (ตร.ม./วินาที)</td>
				</tr>
				<tr class="tr_head">
				<td >น้ำฝนสะสมรายวัน</td>
				<td >เฉลี่ย</td>
				<td >ต่ำสุด</td>
				<td >สูงสุด</td>
				<td >เฉลี่ย</td>
				<td >ต่ำสุด</td>
				<td >สูงสุด</td>
				<td >เฉลี่ย</td>
				<td >ต่ำสุด</td>
				<td >สูงสุด</td>
				<td >เฉลี่ย</td>
				<td >ต่ำสุด</td>
				<td >สูงสุด</td>
				</tr>		
			<tbody>
			<?
			
				if($type =="MS")
				{
					$sss="select distinct CONVERT(varchar(10),DT,120) AS adate,
					sum(case sensor_id when '100' then Value end) rf00 ,
					avg(case sensor_id when '200' then Value end) wlavg,
					max(case sensor_id when '200' then Value end) wlmax,
					min(case sensor_id when '200' then Value end) wlmin,
					avg(case sensor_id when '300' then Value end) flowavg,
					max(case sensor_id when '300' then Value end) flowmax,
					min(case sensor_id when '300' then Value end) flowmin,
					avg(case sensor_id when '301' then Value end) velocityavg,
					max(case sensor_id when '301' then Value end) velocitymax,
					min(case sensor_id when '301' then Value end) velocitymin,
					avg(case sensor_id when '302' then Value end) areaavg,
					max(case sensor_id when '302' then Value end) areamax,
					min(case sensor_id when '302' then Value end) areamin
					FROM [PATTANI].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(10),DT,120) 
					order by CONVERT(varchar(10),DT,120)";
				}
				else
				{
				}
				
				$rs_check =odbc_exec($connection,$sss);
				$row = 1;
				$checkrow=odbc_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=odbc_fetch_array($rs_check))
					{
						$sqltm="select * from [PATTANI].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = odbc_exec($connection,$sqltm);
						$row = odbc_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_ID1 = $row["STN_CODE"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]);

						array_push($minrf,$r_check['rf00']);
						array_push($wlavg,$r_check['wlavg']);
						array_push($wlmin,$r_check['wlmin']);
						array_push($wlmax,$r_check['wlmax']);

						array_push($flowavg,$r_check['flowavg']);
						array_push($flowmin,$r_check['flowmin']);
						array_push($flowmax,$r_check['flowmax']);

						array_push($velocityavg,$r_check['velocityavg']);
						array_push($velocitymin,$r_check['velocitymin']);
						array_push($velocitymax,$r_check['velocitymax']);

						array_push($areaavg,$r_check['areaavg']);
						array_push($areamin,$r_check['areamin']);
						array_push($areamax,$r_check['areamax']);
					
						$timerf[$r_check['adate']]= $r_check['rf00'];
						$timeavg[$r_check['adate']] = $r_check['wlavg'];
						$timemin[$r_check['adate']] = $r_check['wlmin'];
						$timemax[$r_check['adate']] = $r_check['wlmax'];

						$timeavgflow[$r_check['adate']] = $r_check['flowavg'];
						$timeminflow[$r_check['adate']] = $r_check['flowmin'];
						$timemaxflow[$r_check['adate']] = $r_check['flowmax'];

						$timeavgvelocity[$r_check['adate']] = $r_check['velocityavg'];
						$timeminvelocity[$r_check['adate']] = $r_check['velocitymin'];
						$timemaxvelocity[$r_check['adate']] = $r_check['velocitymax'];

						$timeavgarea[$r_check['adate']] = $r_check['areaavg'];
						$timeminarea[$r_check['adate']] = $r_check['areamin'];
						$timemaxarea[$r_check['adate']] = $r_check['areamax'];
	
						

				?>
						<tr class="tr_list">
							<td><?=$STN_ID1?></td>
							<td><?=$STN_NAME_THAI?></td>
							<td><? echo ShortThaiDate($r_check['adate'],2,$STN_ID,"no")?></td>
							<td><?=checkrf($r_check['rf00'],$STN_ID,0)?></td>
							<td><?=checkna($r_check['wlavg'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmin'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmax'],$STN_ID,1)?></td>

							<td><?=checkflow($r_check['flowavg'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['flowmin'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['flowmax'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['velocityavg'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['velocitymin'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['velocitymax'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['areaavg'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['areamin'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['areamax'],$STN_ID,1)?></td>
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

						$dtmin_avgflow = array_search(min($timeavgflow),$timeavgflow);
						$dtmax_avgflow = array_search(max($timeavgflow),$timeavgflow);
						$dtmin_minflow = array_search(min($timeminflow),$timeminflow);
						$dtmax_minflow = array_search(max($timeminflow),$timeminflow);
						$dtmin_maxflow = array_search(min($timemaxflow),$timemaxflow);
						$dtmax_maxflow = array_search(max($timemaxflow),$timemaxflow);

						$dtmin_avgvelocity = array_search(min($timeavgvelocity),$timeavgvelocity);
						$dtmax_avgvelocity = array_search(max($timeavgvelocity),$timeavgvelocity);
						$dtmin_minvelocity = array_search(min($timeminvelocity),$timeminvelocity);
						$dtmax_minvelocity = array_search(max($timeminvelocity),$timeminvelocity);
						$dtmin_maxvelocity = array_search(min($timemaxvelocity),$timemaxvelocity);
						$dtmax_maxvelocity = array_search(max($timemaxvelocity),$timemaxvelocity);

						$dtmin_avgarea = array_search(min($timeavgarea),$timeavgarea);
						$dtmax_avgarea = array_search(max($timeavgarea),$timeavgarea);
						$dtmin_minarea = array_search(min($timeminarea),$timeminarea);
						$dtmax_minarea = array_search(max($timeminarea),$timeminarea);
						$dtmin_maxarea = array_search(min($timemaxarea),$timemaxarea);
						$dtmax_maxarea = array_search(max($timemaxarea),$timemaxarea);

						$min15=min($minrf);
						$max15=max($minrf);

						$wlavg_min=min($wlavg);
						$wlavg_max=max($wlavg);
						$wlmin_min=min($wlmin);
						$wlmin_max=max($wlmin);
						$wlmax_min=min($wlmax);
						$wlmax_max=max($wlmax);

						$flowavg_min=min($flowavg);
						$flowavg_max=max($flowavg);
						$flowmin_min=min($flowmin);
						$flowmin_max=max($flowmin);
						$flowmax_min=min($flowmax);
						$flowmax_max=max($flowmax);

						$velocityavg_min=min($velocityavg);
						$velocityavg_max=max($velocityavg);
						$velocitymin_min=min($velocitymin);
						$velocitymin_max=max($velocitymin);
						$velocitymax_min=min($velocitymax);
						$velocitymax_max=max($velocitymax);

						$areaavg_min=min($areaavg);
						$areaavg_max=max($areaavg);
						$areamin_min=min($areamin);
						$areamin_max=max($areamin);
						$areamax_min=min($areamax);
						$areamax_max=max($areamax);


						$totalrf= array_sum($minrf);
						$avg_wl= array_sum($wlavg)/ count($wlavg);
						$min_wl= array_sum($wlmin)/ count($wlmin);
						$max_wl= array_sum($wlmax) / count($wlmax);

						$avg_flow= array_sum($flowavg)/ count($flowavg);
						$min_flow= array_sum($flowmin)/ count($flowmin);
						$max_flow= array_sum($flowmax) / count($flowmax);

						$avg_velocity= array_sum($velocityavg)/ count($velocityavg);
						$min_velocity= array_sum($velocitymin)/ count($velocitymin);
						$max_velocity= array_sum($velocitymax) / count($velocitymax);

						$avg_area= array_sum($areaavg)/ count($areaavg);
						$min_area= array_sum($areamin)/ count($areamin);
						$max_area= array_sum($areamax) / count($areamax);
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

				<td><?=checkflow($flowavg_min,$STN_ID,1)?></td>
				<td><?=checkflow($flowmin_min,$STN_ID,1)?></td>
				<td><?=checkflow($flowmax_min,$STN_ID,1)?></td>

				<td><?=checkflow($velocityavg_min,$STN_ID,1)?></td>
				<td><?=checkflow($velocitymin_min,$STN_ID,1)?></td>
				<td><?=checkflow($velocitymax_min,$STN_ID,1)?></td>

				<td><?=checkflow($areaavg_min,$STN_ID,1)?></td>
				<td><?=checkflow($areamin_min,$STN_ID,1)?></td>
				<td><?=checkflow($areamax_min,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MIN</td>
				<td><? echo ShortThaiDate($dtminrf,2,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmin_avg,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_min,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_max,2,$STN_ID,"wl")?></td>

				<td><? echo ShortThaiDate($dtmin_avgflow,2,$STN_ID,"flow")?></td>
				<td><? echo ShortThaiDate($dtmin_minflow,2,$STN_ID,"flow")?></td>
				<td><? echo ShortThaiDate($dtmin_maxflow,2,$STN_ID,"flow")?></td>

				<td><? echo ShortThaiDate($dtmin_avgvelocity,2,$STN_ID,"locity")?></td>
				<td><? echo ShortThaiDate($dtmin_minvelocity,2,$STN_ID,"locity")?></td>
				<td><? echo ShortThaiDate($dtmin_maxvelocity,2,$STN_ID,"locity")?></td>

				<td><? echo ShortThaiDate($dtmin_avgarea,2,$STN_ID,"area")?></td>
				<td><? echo ShortThaiDate($dtmin_minarea,2,$STN_ID,"area")?></td>
				<td><? echo ShortThaiDate($dtmin_maxarea,2,$STN_ID,"area")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MAX</td>
				<td><?=checkrf($max15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_max,$STN_ID,1)?></td>

				<td><?=checkflow($flowavg_max,$STN_ID,1)?></td>
				<td><?=checkflow($flowmin_max,$STN_ID,1)?></td>
				<td><?=checkflow($flowmax_max,$STN_ID,1)?></td>

				<td><?=checkflow($velocityavg_max,$STN_ID,1)?></td>
				<td><?=checkflow($velocitymin_max,$STN_ID,1)?></td>
				<td><?=checkflow($velocitymax_max,$STN_ID,1)?></td>

				<td><?=checkflow($areaavg_max,$STN_ID,1)?></td>
				<td><?=checkflow($areamin_max,$STN_ID,1)?></td>
				<td><?=checkflow($areamax_max,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MAX</td>
				<td><? echo ShortThaiDate($dtmaxrf,2,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmax_avg,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_min,2,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_max,2,$STN_ID,"wl")?></td>

				<td><? echo ShortThaiDate($dtmax_avgflow,2,$STN_ID,"flow")?></td>
				<td><? echo ShortThaiDate($dtmax_minflow,2,$STN_ID,"flow")?></td>
				<td><? echo ShortThaiDate($dtmax_maxflow,2,$STN_ID,"flow")?></td>

				<td><? echo ShortThaiDate($dtmax_avgvelocity,2,$STN_ID,"locity")?></td>
				<td><? echo ShortThaiDate($dtmax_minvelocity,2,$STN_ID,"locity")?></td>
				<td><? echo ShortThaiDate($dtmax_maxvelocity,2,$STN_ID,"locity")?></td>

				<td><? echo ShortThaiDate($dtmax_avgarea,2,$STN_ID,"area")?></td>
				<td><? echo ShortThaiDate($dtmax_minarea,2,$STN_ID,"area")?></td>
				<td><? echo ShortThaiDate($dtmax_maxarea,2,$STN_ID,"area")?></td>
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

				<td><?=checkflow($avg_flow,$STN_ID,1)?></td>
				<td><?=checkflow($min_flow,$STN_ID,1)?></td>
				<td><?=checkflow($max_flow,$STN_ID,1)?></td>

				<td><?=checkflow($avg_velocity,$STN_ID,1)?></td>
				<td><?=checkflow($min_velocity,$STN_ID,1)?></td>
				<td><?=checkflow($max_velocity,$STN_ID,1)?></td>

				<td><?=checkflow($avg_area,$STN_ID,1)?></td>
				<td><?=checkflow($min_area,$STN_ID,1)?></td>
				<td><?=checkflow($max_area,$STN_ID,1)?></td>
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
					sum(case sensor_id when '100' then Value end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then Value end) wlmax,
					min(case sensor_id when '200' then Value end) wlmin
					FROM [PATTANI].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(7),DT,120) BETWEEN '".$dtmm1."' AND '".$dtmm2."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(10),DT,120) 
					order by CONVERT(varchar(10),DT,120)";
				}
				else
				{
				}
				
				$rs_check =odbc_exec($connection,$sss);
				$row = 1;
				$checkrow=odbc_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=odbc_fetch_array($rs_check))
					{
						$sqltm="select * from [PATTANI].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = odbc_exec($connection,$sqltm);
						$row = odbc_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_ID1 = $row["STN_CODE"];
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
							<td><?=$STN_ID1?></td>
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
		if($ssite=="Tpat.12")
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
					sum(case sensor_id when '100' then Value end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then Value end) wlmax,
					min(case sensor_id when '200' then Value end) wlmin,
					CONVERT(decimal(38,2),avg(case sensor_id when '201' then Value end)) wleavg,
					max(case sensor_id when '201' then Value end) wlemax,
					min(case sensor_id when '201' then Value end) wlemin
					FROM [PATTANI].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(7),DT,120) 
					order by CONVERT(varchar(7),DT,120)  ";
				}
				
				else
				{
				}
				
				$rs_check =odbc_exec($connection,$sss);
				$row = 1;
				$checkrow=odbc_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=odbc_fetch_array($rs_check))
					{
						$sqltm="select * from [PATTANI].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = odbc_exec($connection,$sqltm);
						$row = odbc_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_ID1 = $row["STN_CODE"];
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
							<td><?=$STN_ID1?></td>
							<td><?=$STN_NAME_THAI?></td>
							<td><? echo ShortThaiDate($r_check['adate'],3,$STN_ID,"no")?></td>
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
		elseif($ssite=="Tpat.5" || $ssite=="Tpat.7")
		{?>
		<div>
		<table align="center" border="1">
				<tr class="tr_head">
					<td rowspan="2">รหัสสถานี </td>
					<td rowspan="2">ชื่อสถานี </td>
					<td rowspan="2" >วันที่ - เวลา</td>
					<td colspan="1" >ปริมาณน้ำฝน (มม.)</td>
					<td colspan="3">ระดับน้ำ เมตร (รทก.)</td>
					<td colspan="3">อัตราการไหล  (ลบ.ม./วินาที)</td>
					<td colspan="3">ความเร็ว (ม./วินาที)</td>
					<td colspan="3">พื้นที่หน้าตัด (ตร.ม./วินาที)</td>
				</tr>
				<tr class="tr_head">
				<td >น้ำฝนสะสมรายวัน</td>
				<td >เฉลี่ย</td>
				<td >ต่ำสุด</td>
				<td >สูงสุด</td>
				<td >เฉลี่ย</td>
				<td >ต่ำสุด</td>
				<td >สูงสุด</td>
				<td >เฉลี่ย</td>
				<td >ต่ำสุด</td>
				<td >สูงสุด</td>
				<td >เฉลี่ย</td>
				<td >ต่ำสุด</td>
				<td >สูงสุด</td>
				</tr>		
			<tbody>
			<?
			
				if($type =="YS")
				{
					$sss="select distinct CONVERT(varchar(7),DT,120) AS adate,
					sum(case sensor_id when '100' then Value end) rf00 ,
					avg(case sensor_id when '200' then Value end) wlavg,
					max(case sensor_id when '200' then Value end) wlmax,
					min(case sensor_id when '200' then Value end) wlmin,
					avg(case sensor_id when '300' then Value end) flowavg,
					max(case sensor_id when '300' then Value end) flowmax,
					min(case sensor_id when '300' then Value end) flowmin,
					avg(case sensor_id when '301' then Value end) velocityavg,
					max(case sensor_id when '301' then Value end) velocitymax,
					min(case sensor_id when '301' then Value end) velocitymin,
					avg(case sensor_id when '302' then Value end) areaavg,
					max(case sensor_id when '302' then Value end) areamax,
					min(case sensor_id when '302' then Value end) areamin
					FROM [PATTANI].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(7),DT,120) 
					order by CONVERT(varchar(7),DT,120) ";
				}
				else
				{
				}
				
				$rs_check =odbc_exec($connection,$sss);
				$row = 1;
				$checkrow=odbc_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=odbc_fetch_array($rs_check))
					{
						$sqltm="select * from [PATTANI].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = odbc_exec($connection,$sqltm);
						$row = odbc_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_ID1 = $row["STN_CODE"];
						$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]);

						array_push($minrf,$r_check['rf00']);
						array_push($wlavg,$r_check['wlavg']);
						array_push($wlmin,$r_check['wlmin']);
						array_push($wlmax,$r_check['wlmax']);

						array_push($flowavg,$r_check['flowavg']);
						array_push($flowmin,$r_check['flowmin']);
						array_push($flowmax,$r_check['flowmax']);

						array_push($velocityavg,$r_check['velocityavg']);
						array_push($velocitymin,$r_check['velocitymin']);
						array_push($velocitymax,$r_check['velocitymax']);

						array_push($areaavg,$r_check['areaavg']);
						array_push($areamin,$r_check['areamin']);
						array_push($areamax,$r_check['areamax']);
					
						$timerf[$r_check['adate']]= $r_check['rf00'];
						$timeavg[$r_check['adate']] = $r_check['wlavg'];
						$timemin[$r_check['adate']] = $r_check['wlmin'];
						$timemax[$r_check['adate']] = $r_check['wlmax'];

						$timeavgflow[$r_check['adate']] = $r_check['flowavg'];
						$timeminflow[$r_check['adate']] = $r_check['flowmin'];
						$timemaxflow[$r_check['adate']] = $r_check['flowmax'];

						$timeavgvelocity[$r_check['adate']] = $r_check['velocityavg'];
						$timeminvelocity[$r_check['adate']] = $r_check['velocitymin'];
						$timemaxvelocity[$r_check['adate']] = $r_check['velocitymax'];

						$timeavgarea[$r_check['adate']] = $r_check['areaavg'];
						$timeminarea[$r_check['adate']] = $r_check['areamin'];
						$timemaxarea[$r_check['adate']] = $r_check['areamax'];
	
						

				?>
						<tr class="tr_list">
							<td><?=$STN_ID1?></td>
							<td><?=$STN_NAME_THAI?></td>
							<td><? echo ShortThaiDate($r_check['adate'],3,$STN_ID,"no")?></td>
							<td><?=checkrf($r_check['rf00'],$STN_ID,0)?></td>
							<td><?=checkna($r_check['wlavg'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmin'],$STN_ID,1)?></td>
							<td><?=checkna($r_check['wlmax'],$STN_ID,1)?></td>

							<td><?=checkflow($r_check['flowavg'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['flowmin'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['flowmax'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['velocityavg'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['velocitymin'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['velocitymax'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['areaavg'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['areamin'],$STN_ID,1)?></td>
							<td><?=checkflow($r_check['areamax'],$STN_ID,1)?></td>
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

						$dtmin_avgflow = array_search(min($timeavgflow),$timeavgflow);
						$dtmax_avgflow = array_search(max($timeavgflow),$timeavgflow);
						$dtmin_minflow = array_search(min($timeminflow),$timeminflow);
						$dtmax_minflow = array_search(max($timeminflow),$timeminflow);
						$dtmin_maxflow = array_search(min($timemaxflow),$timemaxflow);
						$dtmax_maxflow = array_search(max($timemaxflow),$timemaxflow);

						$dtmin_avgvelocity = array_search(min($timeavgvelocity),$timeavgvelocity);
						$dtmax_avgvelocity = array_search(max($timeavgvelocity),$timeavgvelocity);
						$dtmin_minvelocity = array_search(min($timeminvelocity),$timeminvelocity);
						$dtmax_minvelocity = array_search(max($timeminvelocity),$timeminvelocity);
						$dtmin_maxvelocity = array_search(min($timemaxvelocity),$timemaxvelocity);
						$dtmax_maxvelocity = array_search(max($timemaxvelocity),$timemaxvelocity);

						$dtmin_avgarea = array_search(min($timeavgarea),$timeavgarea);
						$dtmax_avgarea = array_search(max($timeavgarea),$timeavgarea);
						$dtmin_minarea = array_search(min($timeminarea),$timeminarea);
						$dtmax_minarea = array_search(max($timeminarea),$timeminarea);
						$dtmin_maxarea = array_search(min($timemaxarea),$timemaxarea);
						$dtmax_maxarea = array_search(max($timemaxarea),$timemaxarea);

						$min15=min($minrf);
						$max15=max($minrf);

						$wlavg_min=min($wlavg);
						$wlavg_max=max($wlavg);
						$wlmin_min=min($wlmin);
						$wlmin_max=max($wlmin);
						$wlmax_min=min($wlmax);
						$wlmax_max=max($wlmax);

						$flowavg_min=min($flowavg);
						$flowavg_max=max($flowavg);
						$flowmin_min=min($flowmin);
						$flowmin_max=max($flowmin);
						$flowmax_min=min($flowmax);
						$flowmax_max=max($flowmax);

						$velocityavg_min=min($velocityavg);
						$velocityavg_max=max($velocityavg);
						$velocitymin_min=min($velocitymin);
						$velocitymin_max=max($velocitymin);
						$velocitymax_min=min($velocitymax);
						$velocitymax_max=max($velocitymax);

						$areaavg_min=min($areaavg);
						$areaavg_max=max($areaavg);
						$areamin_min=min($areamin);
						$areamin_max=max($areamin);
						$areamax_min=min($areamax);
						$areamax_max=max($areamax);


						$totalrf= array_sum($minrf);
						$avg_wl= array_sum($wlavg)/ count($wlavg);
						$min_wl= array_sum($wlmin)/ count($wlmin);
						$max_wl= array_sum($wlmax) / count($wlmax);

						$avg_flow= array_sum($flowavg)/ count($flowavg);
						$min_flow= array_sum($flowmin)/ count($flowmin);
						$max_flow= array_sum($flowmax) / count($flowmax);

						$avg_velocity= array_sum($velocityavg)/ count($velocityavg);
						$min_velocity= array_sum($velocitymin)/ count($velocitymin);
						$max_velocity= array_sum($velocitymax) / count($velocitymax);

						$avg_area= array_sum($areaavg)/ count($areaavg);
						$min_area= array_sum($areamin)/ count($areamin);
						$max_area= array_sum($areamax) / count($areamax);
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

				<td><?=checkflow($flowavg_min,$STN_ID,1)?></td>
				<td><?=checkflow($flowmin_min,$STN_ID,1)?></td>
				<td><?=checkflow($flowmax_min,$STN_ID,1)?></td>

				<td><?=checkflow($velocityavg_min,$STN_ID,1)?></td>
				<td><?=checkflow($velocitymin_min,$STN_ID,1)?></td>
				<td><?=checkflow($velocitymax_min,$STN_ID,1)?></td>

				<td><?=checkflow($areaavg_min,$STN_ID,1)?></td>
				<td><?=checkflow($areamin_min,$STN_ID,1)?></td>
				<td><?=checkflow($areamax_min,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MIN</td>
				<td><? echo ShortThaiDate($dtminrf,3,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmin_avg,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_min,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_max,3,$STN_ID,"wl")?></td>

				<td><? echo ShortThaiDate($dtmin_avgflow,3,$STN_ID,"flow")?></td>
				<td><? echo ShortThaiDate($dtmin_minflow,3,$STN_ID,"flow")?></td>
				<td><? echo ShortThaiDate($dtmin_maxflow,3,$STN_ID,"flow")?></td>

				<td><? echo ShortThaiDate($dtmin_avgvelocity,3,$STN_ID,"locity")?></td>
				<td><? echo ShortThaiDate($dtmin_minvelocity,3,$STN_ID,"locity")?></td>
				<td><? echo ShortThaiDate($dtmin_maxvelocity,3,$STN_ID,"locity")?></td>

				<td><? echo ShortThaiDate($dtmin_avgarea,3,$STN_ID,"area")?></td>
				<td><? echo ShortThaiDate($dtmin_minarea,3,$STN_ID,"area")?></td>
				<td><? echo ShortThaiDate($dtmin_maxarea,3,$STN_ID,"area")?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">MAX</td>
				<td><?=checkrf($max15,$STN_ID,0)?></td>
				<td><?=checkna($wlavg_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmin_max,$STN_ID,1)?></td>
				<td><?=checkna($wlmax_max,$STN_ID,1)?></td>

				<td><?=checkflow($flowavg_max,$STN_ID,1)?></td>
				<td><?=checkflow($flowmin_max,$STN_ID,1)?></td>
				<td><?=checkflow($flowmax_max,$STN_ID,1)?></td>

				<td><?=checkflow($velocityavg_max,$STN_ID,1)?></td>
				<td><?=checkflow($velocitymin_max,$STN_ID,1)?></td>
				<td><?=checkflow($velocitymax_max,$STN_ID,1)?></td>

				<td><?=checkflow($areaavg_max,$STN_ID,1)?></td>
				<td><?=checkflow($areamin_max,$STN_ID,1)?></td>
				<td><?=checkflow($areamax_max,$STN_ID,1)?></td>
			</tr>
			<tr class="tr_list" bgcolor='#EEEED1'>
				<td colspan="3">TIME MAX</td>
				<td><? echo ShortThaiDate($dtmaxrf,3,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmax_avg,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_min,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_max,3,$STN_ID,"wl")?></td>

				<td><? echo ShortThaiDate($dtmax_avgflow,3,$STN_ID,"flow")?></td>
				<td><? echo ShortThaiDate($dtmax_minflow,3,$STN_ID,"flow")?></td>
				<td><? echo ShortThaiDate($dtmax_maxflow,3,$STN_ID,"flow")?></td>

				<td><? echo ShortThaiDate($dtmax_avgvelocity,3,$STN_ID,"locity")?></td>
				<td><? echo ShortThaiDate($dtmax_minvelocity,3,$STN_ID,"locity")?></td>
				<td><? echo ShortThaiDate($dtmax_maxvelocity,3,$STN_ID,"locity")?></td>

				<td><? echo ShortThaiDate($dtmax_avgarea,3,$STN_ID,"area")?></td>
				<td><? echo ShortThaiDate($dtmax_minarea,3,$STN_ID,"area")?></td>
				<td><? echo ShortThaiDate($dtmax_maxarea,3,$STN_ID,"area")?></td>
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

				<td><?=checkflow($avg_flow,$STN_ID,1)?></td>
				<td><?=checkflow($min_flow,$STN_ID,1)?></td>
				<td><?=checkflow($max_flow,$STN_ID,1)?></td>

				<td><?=checkflow($avg_velocity,$STN_ID,1)?></td>
				<td><?=checkflow($min_velocity,$STN_ID,1)?></td>
				<td><?=checkflow($max_velocity,$STN_ID,1)?></td>

				<td><?=checkflow($avg_area,$STN_ID,1)?></td>
				<td><?=checkflow($min_area,$STN_ID,1)?></td>
				<td><?=checkflow($max_area,$STN_ID,1)?></td>
			</tr>
		</tfoot>
		</table>
		</div>
		<?}
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
					sum(case sensor_id when '100' then Value end) rf00 ,
					CONVERT(decimal(38,2),avg(case sensor_id when '200' then Value end)) wlavg,
					max(case sensor_id when '200' then Value end) wlmax,
					min(case sensor_id when '200' then Value end) wlmin
					FROM [PATTANI].[dbo].[DATA_Backup]  WHERE CONVERT(varchar(4),DT,120) BETWEEN '".$dtyy."' AND '".$dtyy."' 
					and STN_ID='".$ssite."' 
					group BY CONVERT(varchar(7),DT,120) 
					order by CONVERT(varchar(7),DT,120)  ";
				}
				
				else
				{
				}
				
				$rs_check =odbc_exec($connection,$sss);
				$row = 1;
				$checkrow=odbc_num_rows($rs_check);
					
				if($checkrow=="0")
				{
					echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
				}
				else
				{
					while($r_check=odbc_fetch_array($rs_check))
					{
						$sqltm="select * from [PATTANI].[dbo].[TM_STN]  WHERE STN_ID='".$ssite."' order by STN_CODE";
						$result = odbc_exec($connection,$sqltm);
						$row = odbc_fetch_array($result);
						$STN_ID = $row["STN_ID"];
						$STN_ID1 = $row["STN_CODE"];
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
							<td><?=$STN_ID1?></td>
							<td><?=$STN_NAME_THAI?></td>
							<td><? echo ShortThaiDate($r_check['adate'],3,$STN_ID,"no")?></td>
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
				<td><? echo ShortThaiDate($dtminrf,3,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmin_avg,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_min,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmin_max,3,$STN_ID,"wl")?></td>
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
				<td><? echo ShortThaiDate($dtmaxrf,3,$STN_ID,"rf")?></td>
				<td><? echo ShortThaiDate($dtmax_avg,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_min,3,$STN_ID,"wl")?></td>
				<td><? echo ShortThaiDate($dtmax_max,3,$STN_ID,"wl")?></td>
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
	else{}

function checkrf($n,$ssite,$mm)
{
	if($ssite=="Tpat.1" || $ssite=="Tpat.2" || $ssite=="Tpat.6" || $ssite=="Tpat.7" || $ssite=="Tpat.12")
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
	if($ssite=="Tpat.16" || $ssite=="Tpat.18" || $ssite=="Tpat.19" || $ssite=="20" || $ssite=="Tpat.22" || $ssite=="Tpat.23" || $ssite=="Tpat.24")
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
function checkflow($n,$ssite,$mm)
{
	if($ssite=="Tpat.5" || $ssite=="Tpat.7")
	{
		if($n=="" && $n!="0")
		{
			$s="-";
		}
		else
		{
			if($mm=="1")
			{
				$s=number_format($n,2);
			}
			else
			{
				$s="n/a";
			}
		}
	}
	else
	{
		$s="n/a";
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

function ShortThaiDate($txt,$ss,$ssite,$ty)
{
	global $ThaiSubMonth;
	$Year = substr(substr($txt, 0, 4), -4);
	$Month = substr($txt, 5, 2);
	$DayNo = substr($txt, 8, 2);
	$T = substr($txt, 11, 5);
	
	if($ty=="rf")
	{
		if($ssite=="Tpat.1" || $ssite=="Tpat.2" || $ssite=="Tpat.6" || $ssite=="Tpat.7" || $ssite=="Tpat.12")
		{
			$x="n/a";
		}
		else
		{
			if($ss==1)
			{
				$x = $Year."-".$Month."-".$DayNo." ".$T;
			}
			else if($ss==2)
			{
				$x = $Year."-".$Month."-".$DayNo;
			}
			else 
			{
				$x = $Year."-".$Month;
			}
		}
	}
	elseif($ty=="wl")
	{
		if($ssite=="Tpat.16" || $ssite=="Tpat.18" || $ssite=="Tpat.19" || $ssite=="20" || $ssite=="Tpat.22" || $ssite=="Tpat.23" || $ssite=="Tpat.24")
		{
			$x="n/a";
		}
		else
		{
			if($ss==1)
			{
				$x = $Year."-".$Month."-".$DayNo." ".$T;
			}
			else if($ss==2)
			{
				$x = $Year."-".$Month."-".$DayNo;
			}
			else 
			{
				$x = $Year."-".$Month;
			}
		}
	}
	else
	{
			if($ss==1)
			{
				$x = $Year."-".$Month."-".$DayNo." ".$T;
			}
			else if($ss==2)
			{
				$x = $Year."-".$Month."-".$DayNo;
			}
			else 
			{
				$x = $Year."-".$Month;
			}
	}
	return $x;
}
?>
</BODY>
</HTML>