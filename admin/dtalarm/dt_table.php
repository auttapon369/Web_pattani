<table align="center">
		<thead>
			<tr class="tr_head" style="<?=$cssTH?>">
				<th>รหัสสถานี </th>
				<th>ชื่อสถานี </th>
				<th>วันที่ - เวลา</th>
				<th>รายการอุปกรณ์ </th>
				<th>สถานะอุปกรณ์</th>
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
			
			if($type =="601" or $type =="602")
			{
				echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>"; 
			}
			
			else if($ssite <>"" and $type <>"800")
			{
				$sss="select sensor_id,STN_ID, DT, Value from [KOLOK].[dbo].[ERROR_TOOL]  WHERE STN_ID='".$ssite."' and sensor_id='".$type."' and dt between '".$date1." 00:00' and '".$date2." 23:59' order by DT desc";
			}
			
			else if($ssite <>"" and $type =="800")
			{
				$sss="select sensor_id,STN_ID, DT, Value from [KOLOK].[dbo].[ERROR_TOOL] WHERE  STN_ID='".$ssite."' and dt between '".$date1." 00:00' and '".$date2." 23:59' order by DT desc,sensor_id";
			}
			else if($ssite =="" and $type <>"800")
			{
				$sss="select sensor_id,STN_ID, DT, Value from [KOLOK].[dbo].[ERROR_TOOL] WHERE  sensor_id='".$type."' and dt between '".$date1." 00:00' and '".$date2." 23:59' order by DT desc,STN_ID ";
			}
			
			else
			{
				$sss="select sensor_id,STN_ID, DT, Value from [KOLOK].[dbo].[ERROR_TOOL] WHERE dt between '".$date1." 00:00' and '".$date2." 23:59' order by DT desc,STN_ID ,sensor_id";
			}
		}
		else
		{
			$sss="select top 100 sensor_id,STN_ID, DT, Value from [KOLOK].[dbo].[ERROR_TOOL] order by DT desc,STN_ID ,sensor_id";
		}
			
			$rs_check =mssql_query($sss);
			$row = 1;
			$checkrow=mssql_num_rows($rs_check);
				
			if($checkrow=="0" AND isset($_REQUEST[search]))
			{
				echo "<p align=\"center\"><font color=\"red\">ไม่พบข้อมูล</font></p>";
			}
			else
			{
				while($r_check=mssql_fetch_array($rs_check))
				{
					$sid=$r_check['sensor_id'];
					$STN_ID = $r_check["STN_ID"];	

					$sqltm="select STN_NAME_THAI from [KOLOK].[dbo].[TM_STN]  WHERE STN_ID='".$STN_ID."' ";
					$result = mssql_query($sqltm);
					$row = mssql_fetch_array($result);
					$STN_NAME_THAI = iconv('TIS-620', 'UTF-8', $row["STN_NAME_THAI"]);
		
					if($sid=="501")
					{
						$sensor="สถานะ AIS";
						if($r_check['Value'] == 1) { $aldata = "<font color=\"green\">ปกติ</font>";} else {$aldata = "<font color=\"red\">ผิดปกติ</font>"; }
					}
					elseif($sid=="502")
					{
						$sensor="สถานะ DTAC";
						if($r_check['Value'] == 1) { $aldata = "<font color=\"green\">ปกติ</font>";} else {$aldata = "<font color=\"red\">ผิดปกติ</font>"; }
					}
					elseif($sid=="601")
					{
						$sensor="Volt IN(PEA)";
						if($r_check['Value'] == 0) { $aldata = "<font color=\"green\">ปกติ</font>";} else {$aldata = "<font color=\"red\">ผิดปกติ</font>"; }
					}
					elseif($sid=="602")
					{
						$sensor="Volt Out(UPS)";
						if($r_check['Value'] == 0) { $aldata = "<font color=\"green\">ปกติ</font>";} else {$aldata = "<font color=\"red\">ผิดปกติ</font>"; }
					}
					elseif($sid=="701")
					{
						$sensor="สถานะประตู";
						if($r_check['Value'] == 0) { $aldata = "<font color=\"green\">เปิด</font>";} else {$aldata = "<font color=\"red\">ปิด</font>"; }
					}
					elseif($sid=="702")
					{
						$sensor="ACSurge";
						if($r_check['Value'] == 0) { $aldata = "<font color=\"green\">ปกติ</font>";} else {$aldata = "<font color=\"red\">ผิดปกติ</font>"; }
					}
					elseif($sid=="703")
					{
						$sensor="Battary Low";
						if($r_check['Value'] == 0) { $aldata = "<font color=\"green\">ปกติ</font>";} else {$aldata = "<font color=\"red\">ผิดปกติ</font>"; }
					}
					elseif($sid=="704")
					{
						$sensor="PEA";
						if($r_check['Value'] == 0) { $aldata = "<font color=\"green\">ปกติ</font>";} else {$aldata = "<font color=\"red\">ผิดปกติ</font>"; }
					}
					elseif($sid=="705")
					{
						$sensor="UPS fail";
						if($r_check['Value'] == 0) { $aldata = "<font color=\"green\">ปกติ</font>";} else {$aldata = "<font color=\"red\">ผิดปกติ</font>"; }
					}
					else{}
			?>
					<tr class="tr_list">
						<td><?=$r_check['STN_ID']?></td>
						<td><?=$STN_NAME_THAI?></td>
						<td><?=ShortThaiDate($r_check['DT'])?></td>
						<td><?=$sensor ?></td>
						<td><?=$aldata?></td>
					</tr>
			<?
					$row++;
					}	//end while	
				}
		?>
		</tbody>
	</table>