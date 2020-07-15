<?
$site_id = $_GET['site_id'];
$type = $_GET['type'];
$date1 = $_GET['date'];
$date2 = $_GET['date2'];
$dtmm1=date('Y-m',strtotime($date1));
$dtmm2=date('Y-m',strtotime($date2));
$dtyy=date('Y',strtotime($date1));
//$sta = explode("-", $site_id);
//$ssite=$sta[0];


function numm($n)
{
	if($n=="")
	{
		$s=" ";
	}
	else
	{
		$s=number_format($n,3);
	}
	return $s;
}

$filName = "report.csv";
$objWrite = fopen("report.csv", "w");

////////////////config/////////////////////////
if($type=="SK")
{
	$sev="192.168.10.64";
	$db="SONGKHAM";
}
elseif($type=="KL")
{
	$sev="192.168.10.74";
	$db="KOLOK";
}
elseif($type=="PN")
{
	$sev="192.168.103.12";
	$db="PATTANI";
}
else
{
	$sev="202.176.90.142";
	$db="Pranburi";
}

$server = "".$sev."";
$user = "sa";
$pass = "ata+ee&c";
$db_name = "".$db."";
$dsn = "Driver={SQL Server};Server=$server;Database=$db_name";
$conn = odbc_connect($dsn, $user, $pass);

////////////////////////////////////////////////
if($type=="SK")
{
	$sql="select STN_ID,CONVERT(varchar(16),dt,120) DT
	,sum(case sensor_id when '100' then Value end) RF  
	,CONVERT(decimal(38,3),sum(case sensor_id when '200' then Value end)) WL  
	FROM [dbo].[DATA_Backup] 
	WHERE DT BETWEEN '$date1' and '$date2 23:50' 
	and STN_ID='$site_id' and datepart(MINUTE,DT) % 15 = 0 GROUP BY STN_ID,DT order by DT";

	$results = odbc_exec($conn,$sql);

	fwrite($objWrite, "STN_ID,DT,RF,WL\r\n");
	while($row = odbc_fetch_array($results))
	{	
		$STN_ID=$row['STN_ID'];
		$DT=$row['DT'];
		$RF=$row['RF'];
		$WL=numm($row['WL']);
		fwrite($objWrite, "$STN_ID,$DT,$RF,$WL\r\n");
	}
	fclose($objWrite);
}
elseif($type=="KL")
{
	if($site_id=="Tkol.18" || $site_id=="Tkol.19" || $site_id=="Tkol.25")
	{
		$sqlkl="select STN_ID,CONVERT(varchar(16),dt,120) DT
		,sum(case sensor_id when '100' then Value end) RF  
		,CONVERT(decimal(38,3),sum(case sensor_id when '200' then Value end)) WL  
		,CONVERT(decimal(38,3),sum(case sensor_id when '201' then Value end)) WL_E  
		FROM [dbo].[DATA_Backup] 
		WHERE DT BETWEEN '$date1' and '$date2 23:50' 
		and STN_ID='$site_id' and datepart(MINUTE,DT) % 15 = 0 GROUP BY STN_ID,DT order by DT";

		$ex_kl= odbc_exec($conn,$sqlkl);

		fwrite($objWrite, "STN_ID,DT,RF,WL,WL_E\r\n");
		while($rowkl = odbc_fetch_array($ex_kl))
		{	
			$STN_ID=$rowkl['STN_ID'];
			$DT=$rowkl['DT'];
			$RF=$rowkl['RF'];
			$WL=numm($rowkl['WL']);
			$WL_E=numm($rowkl['WL_E']);
			fwrite($objWrite, "$STN_ID,$DT,$RF,$WL,$WL_E\r\n");
		}
		fclose($objWrite);
	}
	else
	{
		$sqlkl="select STN_ID,CONVERT(varchar(16),dt,120) DT
		,sum(case sensor_id when '100' then Value end) RF  
		,CONVERT(decimal(38,3),sum(case sensor_id when '200' then Value end)) WL  
		FROM [dbo].[DATA_Backup] 
		WHERE DT BETWEEN '$date1' and '$date2 23:50' 
		and STN_ID='$site_id' and datepart(MINUTE,DT) % 15 = 0 GROUP BY STN_ID,DT order by DT";

		$ex_kl = odbc_exec($conn,$sqlkl);
		
		fwrite($objWrite, "STN_ID,DT,RF,WL\r\n");
		while($rowkl = odbc_fetch_array($ex_kl))
		{	
			$STN_ID=$rowkl['STN_ID'];
			$DT=$rowkl['DT'];
			$RF=$rowkl['RF'];
			$WL=numm($rowkl['WL']);
			fwrite($objWrite, "$STN_ID,$DT,$RF,$WL\r\n");
		}
		fclose($objWrite);
	}
}
elseif($type=="PN")
{
	if($site_id=="Tpat.5" || $site_id=="Tpat.7" )
	{
		$sqlpt="select STN_ID,CONVERT(varchar(16),dt,120) DT
		,sum(case sensor_id when '100' then Value end) RF  
		,CONVERT(decimal(38,3),sum(case sensor_id when '200' then Value end)) WL  
		,CONVERT(decimal(38,3),sum(case sensor_id when '300' then Value end)) FLOW  
		,CONVERT(decimal(38,3),sum(case sensor_id when '301' then Value end)) VELOCITY  
		,CONVERT(decimal(38,3),sum(case sensor_id when '302' then Value end)) AREA  
		FROM [dbo].[DATA_Backup] 
		WHERE DT BETWEEN '$date1' and '$date2 23:50' 
		and STN_ID='$site_id' and datepart(MINUTE,DT) % 15 = 0 GROUP BY STN_ID,DT order by DT";

		$ex_pt= odbc_exec($conn,$sqlpt);

		fwrite($objWrite, "STN_ID,DT,RF,WL,FLOW,VELOCITY,AREA\r\n");
		while($rowpt = odbc_fetch_array($ex_pt))
		{	
			$STN_ID=$rowpt['STN_ID'];
			$DT=$rowpt['DT'];
			$RF=$rowpt['RF'];
			$WL=numm($rowpt['WL']);
			$FLOW=numm($rowpt['FLOW']);
			$VELOCITY=numm($rowpt['VELOCITY']);
			$AREA=numm($rowpt['AREA']);
			fwrite($objWrite, "$STN_ID,$DT,$RF,$WL,$FLOW,$VELOCITY,$AREA\r\n");
		}
		fclose($objWrite);
	}
	elseif($site_id=="Tpat.12")
	{
		$sqlpt="select STN_ID,CONVERT(varchar(16),dt,120) DT
		,sum(case sensor_id when '100' then Value end) RF  
		,CONVERT(decimal(38,3),sum(case sensor_id when '200' then Value end)) WL  
		,CONVERT(decimal(38,3),sum(case sensor_id when '201' then Value end)) WL_E  
		FROM [dbo].[DATA_Backup] 
		WHERE DT BETWEEN '$date1' and '$date2 23:50' 
		and STN_ID='$site_id' and datepart(MINUTE,DT) % 15 = 0 GROUP BY STN_ID,DT order by DT";

		$ex_pt= odbc_exec($conn,$sqlpt);

		fwrite($objWrite, "STN_ID,DT,RF,WL,WL_E\r\n");
		while($rowpt = odbc_fetch_array($ex_pt))
		{	
			$STN_ID=$rowpt['STN_ID'];
			$DT=$rowpt['DT'];
			$RF=$rowpt['RF'];
			$WL=numm($rowpt['WL']);
			$WL_E=numm($rowpt['WL_E']);
			fwrite($objWrite, "$STN_ID,$DT,$RF,$WL,$WL_E\r\n");
		}
		fclose($objWrite);
	}
	else
	{
		$sqlpt="select STN_ID,CONVERT(varchar(16),dt,120) DT
		,sum(case sensor_id when '100' then Value end) RF  
		,CONVERT(decimal(38,3),sum(case sensor_id when '200' then Value end)) WL  
		FROM [dbo].[DATA_Backup] 
		WHERE DT BETWEEN '$date1' and '$date2 23:50' 
		and STN_ID='$site_id' and datepart(MINUTE,DT) % 15 = 0 GROUP BY STN_ID,DT order by DT";

		$ex_pt = odbc_exec($conn,$sqlpt);

		fwrite($objWrite, "STN_ID,DT,RF,WL\r\n");
		while($rowpt = odbc_fetch_array($ex_pt))
		{	
			$STN_ID=$rowpt['STN_ID'];
			$DT=$rowpt['DT'];
			$RF=$rowpt['RF'];
			$WL=numm($rowpt['WL']);
			fwrite($objWrite, "$STN_ID,$DT,$RF,$WL\r\n");
		}
		fclose($objWrite);
	}
}
else
{
	if($site_id=="03")
	{
		$sqlpt="select STN_ID,CONVERT(varchar(16),dt,120) DT
		,sum(case sensor_id when '100' then Value end) RF  
		,CONVERT(decimal(38,3),sum(case sensor_id when '200' then Value end)) WL  
		,CONVERT(decimal(38,3),sum(case sensor_id when '300' then Value end)) FLOW  
		FROM [dbo].[DATA_Backup] 
		WHERE DT BETWEEN '$date1' and '$date2 23:50' 
		and STN_ID='$site_id' and datepart(MINUTE,DT) % 15 = 0 GROUP BY STN_ID,DT order by DT";

		$ex_pt= odbc_exec($conn,$sqlpt);

		fwrite($objWrite, "STN_ID,DT,RF,WL,FLOW\r\n");
		while($rowpt = odbc_fetch_array($ex_pt))
		{	
			$STN_ID=$rowpt['STN_ID'];
			$DT=$rowpt['DT'];
			$RF=$rowpt['RF'];
			$WL=numm($rowpt['WL']);
			$FLOW=numm($rowpt['FLOW']);
			fwrite($objWrite, "$STN_ID,$DT,$RF,$WL,$FLOW\r\n");
		}
		fclose($objWrite);
	}
	else
	{
		$sql="select STN_ID,CONVERT(varchar(16),dt,120) DT
		,sum(case sensor_id when '100' then Value end) RF  
		,CONVERT(decimal(38,3),sum(case sensor_id when '200' then Value end)) WL  
		FROM [dbo].[DATA_Backup] 
		WHERE DT BETWEEN '$date1' and '$date2 23:50' 
		and STN_ID='$site_id' and datepart(MINUTE,DT) % 15 = 0 GROUP BY STN_ID,DT order by DT";

		$results = odbc_exec($conn,$sql);

		fwrite($objWrite, "STN_ID,DT,RF,WL\r\n");
		while($row = odbc_fetch_array($results))
		{	
			$STN_ID=$row['STN_ID'];
			$DT=$row['DT'];
			$RF=$row['RF'];
			$WL=numm($row['WL']);
			fwrite($objWrite, "$STN_ID,$DT,$RF,$WL\r\n");
		}
		fclose($objWrite);
	}
}

$dt=date("d.m.Y",strtotime($date1));
$dt2=date("d.m.Y",strtotime($date2));
$name=$site_id."_".$dt."-".$dt2;
$an=str_replace(" ","",$name);

header("Content-Disposition: attachment; filename=$an.csv"); 
readfile($filName);
?>