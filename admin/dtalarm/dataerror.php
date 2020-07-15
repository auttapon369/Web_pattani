<?
include('config.php');
$cssTH = "
	background-color:#97cbde !important;
";
?>

	<div class="filter" align="center">
		<form id="dataerror" name="dataerror" method="post" action="" >
		    <span>สถานี :		
				<select name="site_id" id="site_id" class="inpSize" >
					<option value="" >เลือกสถานี</option>
					<? 
						getSiteList($_POST['site_id']);					
					?>
				</select>			
			</span>
			<span>ระบุประเภท :
				<select id="type" name="type" class="inpSize">
					<option value="501" id="sta_ais"<? if($_POST['type'] == "501"){ echo"selected"; } ?>>Communication 1</option>
					<option value="502" id="sta_dtac"<? if($_POST['type'] == "502"){ echo"selected"; } ?>>Communication 2</option>
					<option value="701" id="sta_door"<? if($_POST['type'] == "701"){ echo"selected"; } ?>>สถานะประตู</option>
					<option value="702" id="sta_acs"<? if($_POST['type'] == "702"){ echo"selected"; } ?>>สถานะ ACSurge</option>
					<option value="703" id="sta_bat"<? if($_POST['type'] == "703"){ echo"selected"; } ?>>สถานะ Battary</option>
					<option value="601" id="sta_pea"<? if($_POST['type'] == "601"){ echo"selected"; } ?>>สถานะ PEA</option>
					<option value="900" id="sta_temp"<? if($_POST['type'] == "900"){ echo"selected"; } ?>>ดูทั้งหมด</option>
				</select>
			</span>
			<span>ระบุเวลา :
				ตั้งแต่ <input id="date1" name="date1" type="text"  size="10" value="<?if($_POST['date1']==""){echo date('Y-m-d');} else{echo $_POST['date1'];}?>"/><a href="javascript:NewCssCal('date1','yyyymmdd','false')" class="img"><img src="img/ic_calendar.jpg"  alt="PickDate" /></a> 
				ถึง <input id="date2" name="date2" type="text" size="10" value="<?if($_POST['date2']==""){echo date('Y-m-d');} else{echo $_POST['date2'];}?>"/><a href="javascript:NewCssCal('date2','yyyymmdd','false')" class="img"><img src="img/ic_calendar.jpg"  alt="PickDate" /></a>
			</span>
			<span>
				<input type="submit" name="search" id="search" value="ค้นหา" class="btnShow" />
				<input type="button" name="button" id="button" value="refresh"  onclick="window.location.href='index.php'"/>
				<input type="submit" name="Schart" id="Schart" value="กราฟ" class="btnShow" />
			</span>	
		</form>
	</div>

	<?
	if(isset($_REQUEST[Schart]))
	{
		include('dt_charts.php');
	}
	else
	{
	?>

	<table align="center">
		<thead>
			<tr class="tr_head" style="<?=$cssTH?>">
				<th>รหัสสถานี </th>
				<th>ชื่อสถานี </th>
				<th>วันที่ - เวลา</th>
				<th>รายการเปลี่ยนแปลง </th>
				<th>สถานะ</th>
			</tr>
		</thead>
		<tbody>
		<?
		if(isset($_REQUEST[search]))
		{
			$site_id = $_POST['site_id'];
			$type = $_POST['type'];
			$date1 = $_POST['date1'];
			$date2 = $_POST['date2'];
			$sta = explode("-", $site_id);
			$ssite=$sta[0];	
			
			if($ssite <>"" and $type <>"900")
			{
				$sss="select sensor_id,STN_ID, CONVERT(varchar(16),DT,120) DT, Value from [PATTANI].[dbo].[ERROR_TOOL]  WHERE STN_ID='".$ssite."' and sensor_id='".$type."' and dt between '".$date1." 00:00' and '".$date2." 23:59' order by DT desc";
			}
			
			else if($ssite <>"" and $type =="900")
			{
				$sss="select sensor_id,STN_ID, CONVERT(varchar(16),DT,120) DT, Value from [PATTANI].[dbo].[ERROR_TOOL] WHERE  STN_ID='".$ssite."' and dt between '".$date1." 00:00' and '".$date2." 23:59' order by DT desc,sensor_id";
			}
			else if($ssite =="" and $type <>"900")
			{
				$sss="select sensor_id,STN_ID, CONVERT(varchar(16),DT,120) DT, Value from [PATTANI].[dbo].[ERROR_TOOL] WHERE  sensor_id='".$type."' and dt between '".$date1." 00:00' and '".$date2." 23:59' order by DT desc,STN_ID ";
			}
			
			else
			{
				$sss="select sensor_id,STN_ID, CONVERT(varchar(16),DT,120) DT, Value from [PATTANI].[dbo].[ERROR_TOOL] WHERE dt between '".$date1." 00:00' and '".$date2." 23:59' order by DT desc,STN_ID ,sensor_id";
			}
		}
		else
		{
			$sss="select top 100 sensor_id,STN_ID, CONVERT(varchar(16),DT,120) DT, Value from [PATTANI].[dbo].[ERROR_TOOL] order by DT desc,STN_ID ,sensor_id";
		}
			
			$rs_check =odbc_exec($connection,$sss);
			$row = 1;
			$checkrow=odbc_num_rows($rs_check);
				
			if($checkrow=="0" AND isset($_REQUEST[search]))
			{
				echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
			}
			else
			{
				while($r_check=odbc_fetch_array($rs_check))
				{
					$sid=$r_check['sensor_id'];
					$STN_ID = $r_check["STN_ID"];	

					$sqltm="select STN_NAME_THAI from [PATTANI].[dbo].[TM_STN]  WHERE STN_ID='".$STN_ID."' ";
					$result = odbc_exec($connection,$sqltm);
					$row = odbc_fetch_array($result);
					$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]);

					$checkpr= checkss_id($sid,$r_check['Value']);
					$namessid = $checkpr[0];
					$aldata = $checkpr[1];
			?>
					<tr class="tr_list">
						<td><?=$r_check['STN_ID']?></td>
						<td><?=$STN_NAME_THAI?></td>
						<td><?=ShortThaiDate($r_check['DT'])?></td>
						<td><?=$namessid ?></td>
						<td><?=$aldata?></td>
					</tr>
			<?
					$row++;
					}	//end while	
				}
		?>
		</tbody>
	</table>
	<?}?>
<?
function ShortThaiDate($txt)
{
	global $ThaiSubMonth;
	$Year = substr(substr($txt, 0, 4)+543, -4);
	$Month = substr($txt, 5, 2);
	$DayNo = substr($txt, 8, 2);
	$T = substr($txt, 11, 5);
	$x = $DayNo."/".$Month."/".$Year." "."เวลา ".$T." น.";
	return $x;
}

function checkss_id($sid,$value)
{
	global $connection;
	$sqlssid="SELECT  Sensor_Type, Type_Name, Type_NameTH  FROM  [PATTANI].[dbo].[TM_sensor]  WHERE Sensor_Type='".$sid."' ";
	$ressid = odbc_exec($connection,$sqlssid);
	$row = odbc_fetch_array($ressid);

	$SSID_THAI = iconv('TIS-620', 'UTF-8', $row["Type_NameTH"]);
	$x[0] = $SSID_THAI;

	if($value=="1")
	{
		if($sid=="501" || $sid=="502")
		{
			$x[1] = "<font color=\"green\">ปกติ</font>";
		}
		elseif($sid=="701")
		{
			$x[1] = "<font color=\"red\">เปิด</font>";
		}
		else
		{
			$x[1] = "<font color=\"red\">ผิดปกติ</font>";
		}
	}
	elseif($value=="0")
	{
		if($sid=="601" || $sid=="602" || $sid=="702" || $sid=="703" ||$sid=="704" || $sid=="705")
		{
			$x[1] = "<font color=\"green\">ปกติ</font>";
		}
		elseif($sid=="701")
		{
			$x[1] = "<font color=\"green\">ปิด</font>";
		}
		else
		{
			$x[1] = "<font color=\"red\">ผิดปกติ</font>";
		}

	}
	else{}



	/*if($sid=="501" || $sid=="502")
	{
		if($value=="1")
		{
			$x[1] = "<font color=\"green\">ปกติ</font>";
		}
		else
		{
			$x[1] = "<font color=\"red\">ผิดปกติ</font>";
		}
	}
	elseif($sid=="601" || $sid=="602" || $sid=="702" || $sid=="703" ||$sid=="704" || $sid=="705")
	{
		if($value=="0")
		{
			$x[1] = "<font color=\"green\">ปกติ</font>";
		}
		else
		{
			$x[1] = "<font color=\"red\">ผิดปกติ</font>";
		}
	}
	elseif($sid=="701")
	{
		if($value=="0")
		{
			$x[1] = "<font color=\"green\">ปิด</font>";
		}
		else
		{
			$x[1] = "<font color=\"red\">เปิด</font>";
		}
	}
	else{}*/
	return $x;
}
?>

