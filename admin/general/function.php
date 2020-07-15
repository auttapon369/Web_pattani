<?
function getSiteList($STN_Code)
{        
	global $connection;
	$sql = "SELECT STN_ID,STN_CODE,STN_NAME_THAI FROM [KOLOK].[dbo].[TM_STN] order by STN_CODE";
	$result = mssql_query($sql);
	$sta = explode("-", $STN_Code);
	$ssite = $sta[0];
	while($row = mssql_fetch_array($result))
	{
		$nane = iconv('TIS-620', 'UTF-8', $row['STN_NAME_THAI']);
		if($ssite==$row['STN_ID']) { $sl = "selected"; } else { $sl = ""; }
		echo "<option value=\"".$row['STN_ID']."-".$nane."\" ".$sl.">".$row['STN_ID']."-".$nane."</option>";
	}
}
function datetimedata($STN_Code)
{        
	global $connection;
	$sql = "SELECT distinct top 180 convert(varchar(16),(DT),120) DT FROM [KOLOK].[dbo].[DATA_Backup] order by dt desc";
	$result = odbc_exec($connection,$sql);
	while($row = odbc_fetch_array($result))
	{
		echo "<option value=\"".$row['DT'].">".$row['DT']."</option>";
	}
}
function setdatetime($input, $output, $digit_only = false, $month_idx="TH_ABBR")
{
	global $ary_month;
	if($input == "0000-00-00 00:00" or $input == "0000-00-00" or $input == "") return "";
	$input = str_replace("/", "-", $input);
	list($ary_date, $ary_time) = explode(' ', $input);
	list($year, $month, $day) = explode('-', $ary_date);
	@list($hour, $min, $sec) = explode(':', $ary_time);
	$thai = (strtoupper(substr($month_idx,0,2)) == "TH")? true : false;
	$year = ($thai)? ($year+543) : $year;
	$ary_tmp = array();
	$ary_tmp['YYYY'] = $year;
	$ary_tmp['YY'] = substr($year, 2, 2);
	$ary_tmp['MM'] = ($digit_only)? $month : $ary_month[$month_idx][intval($month)];
	$ary_tmp['DD'] = $day;
	$ary_tmp['HR'] = $hour;
	$ary_tmp['MN'] = $min;
	$ary_tmp['SC'] = $sec;
	return str_replace(array_keys($ary_tmp), array_values($ary_tmp), $output);
}
function DateDiff($strDate1,$strDate2)
{
	return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
}
function TimeDiff($strTime1,$strTime2)
{
	return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
}
function DateTimeDiff($strDateTime1,$strDateTime2)
{
	return (strtotime($strDateTime2) - strtotime($strDateTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
}
function Decimal($value)
{
	$aa=$value;
	if($aa==""){ $aa = "-"; }
	else{ $aa = number_format($aa, 2, '.', '');}  
	return $aa;
}
function checkValue($value,$comp)
{
	if($comp > 2){ $x = "-"; }
	else{ $x = Decimal($value); }
	return $x;
}
function checkWL($value,$cWL,$comp,$type)
{
	if($cWL == 0)
	{ 
		$x = "n/a";
	}
	else if($cWL == 1)
	{			
		if($type == 2)
		{
			if($comp > 2)
			{ 
				$x = "-"; 
			}
			else
			{ 
				$x = Decimal($value); 
			}
		}			
		else
		{ 
			$x = Decimal($value); 
		}
	}
	else{}
	return $x;
}

?>