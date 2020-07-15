<?
include("MPDF57/mpdf.php");
ini_set("memory_limit","512M");

$conn = connDB("odbc");

$ss="SELECT STN_ID,STN_CODE,STN_NAME_THAI FROM TM_STN where STN_ID='$p_stn'";
$ress = odbc_exec($conn,$ss);
$namesta=odbc_fetch_array($ress);
$stationss=$namesta['STN_ID'];
$stationnew=$namesta['STN_CODE'];
$namethai=$namesta['STN_NAME_THAI'];
$Dname=iconv('TIS-620', 'UTF-8', $namethai);
//$Dname=$namethai;



//////////////////////////////////main//////////////////////////////////

if($p_format=="f_15")
{		
	$name="ราย 15 นาที";
}
else if($p_format=="f_hr")
{
	$name="รายชั่วโมง";
}
else if($p_format=="f_mean")
{
	$name="รายวัน-เฉลี่ย";
}
else if($p_format=="f_min")
{
	$name="รายวัน-ต่ำสุด";
}
else
{
	$name="รายวัน-สูงสุด";
}

/*ob_start();

if($w=="I")
{
	$rptway="ขาเข้า";
}
else if($w=="O")
{
	$rptway="ขาออก";
}
else{}*/
	

	$aname="ข้อมูล".$name;
	$an=str_replace(" ","",$aname);


	//header("Content-Type: application/pdf");
	//header("Cache-Control: no-cache");
	//header("Accept-Ranges: none");
	//header("Content-Disposition: attachment; filename=\"$an.pdf\"");  

//ob_start();
?>

<html xmlns="http://www.w3.org/TR/REC-html40">
<HEAD>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />

<SCRIPT TYPE="text/javascript">
function timedRefresh(timeoutPeriod)
{	
	setTimeout("window.location.reload(true);",timeoutPeriod);
}
</SCRIPT>
</HEAD>
	<style>
	.textNormal{
		font-size:10px;
		font-family:MS Sans Serif,Tahoma,sans-serif;
	}
	</style>
<BODY>
<?
///////////////////////////show data ////////////////////////////////////////
?>
		<TABLE style="width:100%;" border="1">
					<tr> 
						<th rowspan="2">วันที่</th>
						<?if($p_rain=="Y" && $nrf<>""){?><th colspan="<?=$nrf?>">ปริมาณน้ำฝน<Q CLASS="fs_small">(มม.)</Q></th><?}else{}?>
						<?if($p_water=="Y" && $nwl<>""){?><th colspan="<?=$nwl?>">ระดับน้ำ<Q CLASS="fs_small">(ม.รทก)</Q></th><?}else{}?>
						<?if($p_water=="Y" && $cwle=="Y"){?><th colspan="<?=$nwle?>">ระดับน้ำท้าย ปตร.<Q CLASS="fs_small">(ม.รทก)</Q></th><?}else{}?>
						<?if(($p_flow=="Y" && $nwl<>"") && ( !in_array($ssite, $_cfg_flow))){?><th colspan="<?=$nfl?>">อัตราการไหล<Q CLASS="fs_small">(ลบ.ม./วินาที)</Q></th><?}else{}?>
						<?if($p_flow=="Y" && $cwle=="Y"){?><th colspan="<?=$nwle?>">อัตราการไหลท้าย ปตร.<Q CLASS="fs_small">(ลบ.ม./วินาที)</Q></th><?}else{}?>
					</tr>
					<tr>
					<?
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$_code= $_value[6];
						$rf = C_rf($_value[1],$p_rain);

						if($rf=="show"){?><th rowspan="1"><?=$_code?></th><?}else{}
					}

					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$_code= $_value[6];
						$wl = C_wl($_value[2],$p_water);

						if($wl=="show"){?><th rowspan="1"><?=$_code?></th><?}else{}
					}

					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$_code= $_value[6];
						$wl_end= $_value[5];
						$wle = C_wle($_value[2],$p_water,$wl_end);

						if($wle=="show"){?><th rowspan="1"><?=$_code?></th><?}else{}
					}

					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$_code= $_value[6];
						$fl = C_fl($_value[2],$p_flow);

						if($fl=="show" && ( !in_array($ssite, $_cfg_flow))){?><th rowspan="1"><?=$_code?></th><?}else{}
					}

					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$_code= $_value[6];
						$wl_end= $_value[5];
						$fle = C_fle($_value[2],$p_flow,$wl_end);

						if($fle=="show"){?><th rowspan="1"><?=$_code?></th><?}else{}
					}
					?>
					</tr>
				</thead>

<?
if($p_format=="f_15")
{	
			
				$strQuery = "SELECT CONVERT(varchar(16),DT,121) DT ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
				}
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
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
				}
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname."	";
				}
				
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE 
					CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY 
						CONVERT(varchar(16),DT,121)
					ORDER BY 
						CONVERT(varchar(16),DT,121)	";

				//echo $strQuery;

					$objExec = odbc_exec($conn,$strQuery);
					while($objResult = odbc_fetch_array($objExec))
					{
						?>
							<tr>
								<td><?=$objResult['DT'];?></td>
								<?
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$rf = C_rf($_value[1],$p_rain);
									$nname = $_value[4];

									if($rf=="show"){?><td><?=numm($objResult['RF_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl = C_wl($_value[2],$p_water);
									$nname = $_value[4];

									if($wl=="show"){?><td><?=numm($objResult['WL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$wle = C_wle($_value[2],$p_water,$wl_end);
									$nname = $_value[4];

									if($wle=="show"){?><td><?=numm($objResult['WLE_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$fl = C_fl($_value[2],$p_flow);
									$nname = $_value[4];

									if($fl=="show" && ( !in_array($ssite, $_cfg_flow))){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$fle = C_fle($_value[2],$p_flow,$wl_end);
									$nname = $_value[4];

									if($fle=="show"){?><td><?=numm($objResult['FLE_'.$nname.''])?></td><?}else{}
								}
								?>
							</tr>
						<?
					}


}
else if($p_format=="f_hr")
{	
				$strQuery = "SELECT CONVERT(varchar(16),DT,121) DT ";	
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
				}
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
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
				}
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname."	";
				}
				
				$strQuery .=" FROM [dbo].[DATA_Backup]
							WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' 
								AND (DATEPART(MINUTE ,DT))='00'
							GROUP BY 
								CONVERT(varchar(16),DT,121)
							ORDER BY 
								CONVERT(varchar(16),DT,121)	";

				$objExec = odbc_exec($conn,$strQuery);
				while($objResult = odbc_fetch_array($objExec))
				{

						$starhour=date("Y-m-d H:15",strtotime('-1 hour',strtotime($objResult['DT'])));
						$endhour=date("Y-m-d H:00",strtotime($objResult['DT']));
						
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

						$sumrf =odbc_exec($conn,$sumrain);
						$sumrfh=odbc_fetch_array($sumrf);

						?>
							<tr>
								<td><?=$objResult['DT'];?></td>
								<?
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$rf = C_rf($_value[1],$p_rain);
									$nname = $_value[4];

									if($rf=="show"){?><td><?=numm($sumrfh['vhour_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl = C_wl($_value[2],$p_water);
									$nname = $_value[4];

									if($wl=="show"){?><td><?=numm($objResult['WL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$wle = C_wle($_value[2],$p_water,$wl_end);
									$nname = $_value[4];

									if($wle=="show"){?><td><?=numm($objResult['WLE_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$fl = C_fl($_value[2],$p_flow);
									$nname = $_value[4];

									if($fl=="show" && ( !in_array($ssite, $_cfg_flow))){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$fle = C_fle($_value[2],$p_flow,$wl_end);
									$nname = $_value[4];

									if($fle=="show"){?><td><?=numm($objResult['FLE_'.$nname.''])?></td><?}else{}
								}
								?>
							</tr>
						<?
					}
}
else if($p_format=="f_mean")
{	
				$start = strtotime($p_day1);
				$end = strtotime($p_day2);
				for ( $a = $start; $a <= $end; $a += 86400 )
				{	
					$dt=date("Y-m-d",$a);

					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,Sum(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,avg(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,avg(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,avg(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,avg(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname." ";
					}
					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				
					$objExec = odbc_exec($conn,$strQuery);
					//$checkrow=odbc_num_rows($objExec);
					$date_now = $dt.' 07:00';
					while($objResult = odbc_fetch_array($objExec))
					{
						?>
							<tr>
								<td><?=$date_now;?></td>
								<?
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$rf = C_rf($_value[1],$p_rain);
									$nname = $_value[4];

									if($rf=="show"){?><td><?=numm($objResult['RF_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl = C_wl($_value[2],$p_water);
									$nname = $_value[4];

									if($wl=="show"){?><td><?=numm($objResult['WL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$wle = C_wle($_value[2],$p_water,$wl_end);
									$nname = $_value[4];

									if($wle=="show"){?><td><?=numm($objResult['WLE_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$fl = C_fl($_value[2],$p_flow);
									$nname = $_value[4];

									if($fl=="show" && ( !in_array($ssite, $_cfg_flow))){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$fle = C_fle($_value[2],$p_flow,$wl_end);
									$nname = $_value[4];

									if($fle=="show"){?><td><?=numm($objResult['FLE_'.$nname.''])?></td><?}else{}
								}
								?>
							</tr>
						<?
					}	
				}
}
else if($p_format=="f_min")
{	
				$start = strtotime($p_day1);
				$end = strtotime($p_day2);
				for ( $a = $start; $a <= $end; $a += 86400 )
				{	
					$dt=date("Y-m-d",$a);

					$strQuery = "SELECT min(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,min(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,min(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,min(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,min(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,min(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname." ";
					}
					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				
					$objExec = odbc_exec($conn,$strQuery);
					//$checkrow=odbc_num_rows($objExec);
					$date_now = $dt.' 07:00';
					while($objResult = odbc_fetch_array($objExec))
					{
						?>
							<tr>
								<td><?=$date_now;?></td>
								<?
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$rf = C_rf($_value[1],$p_rain);
									$nname = $_value[4];

									if($rf=="show"){?><td><?=numm($objResult['RF_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl = C_wl($_value[2],$p_water);
									$nname = $_value[4];

									if($wl=="show"){?><td><?=numm($objResult['WL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$wle = C_wle($_value[2],$p_water,$wl_end);
									$nname = $_value[4];

									if($wle=="show"){?><td><?=numm($objResult['WLE_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$fl = C_fl($_value[2],$p_flow);
									$nname = $_value[4];

									if($fl=="show" && ( !in_array($ssite, $_cfg_flow))){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$fle = C_fle($_value[2],$p_flow,$wl_end);
									$nname = $_value[4];

									if($fle=="show"){?><td><?=numm($objResult['FLE_'.$nname.''])?></td><?}else{}
								}
								?>
							</tr>
						<?
					}	
				}
}
else if($p_format=="f_max")
{	
				$start = strtotime($p_day1);
				$end = strtotime($p_day2);
				for ( $a = $start; $a <= $end; $a += 86400 )
				{	
					$dt=date("Y-m-d",$a);

					$strQuery = "SELECT max(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,max(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,max(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,max(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,max(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
					}
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,max(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname." ";
					}
					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				
					$objExec = odbc_exec($conn,$strQuery);
					//$checkrow=odbc_num_rows($objExec);
					$date_now = $dt.' 07:00';
					while($objResult = odbc_fetch_array($objExec))
					{
						?>
							<tr>
								<td><?=$date_now;?></td>
								<?
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$rf = C_rf($_value[1],$p_rain);
									$nname = $_value[4];

									if($rf=="show"){?><td><?=numm($objResult['RF_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl = C_wl($_value[2],$p_water);
									$nname = $_value[4];

									if($wl=="show"){?><td><?=numm($objResult['WL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$wle = C_wle($_value[2],$p_water,$wl_end);
									$nname = $_value[4];

									if($wle=="show"){?><td><?=numm($objResult['WLE_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$fl = C_fl($_value[2],$p_flow);
									$nname = $_value[4];

									if($fl=="show" && ( !in_array($ssite, $_cfg_flow))){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$fle = C_fle($_value[2],$p_flow,$wl_end);
									$nname = $_value[4];

									if($fle=="show"){?><td><?=numm($objResult['FLE_'.$nname.''])?></td><?}else{}
								}
								?>
							</tr>
						<?
					}	
				}
}
else {}

///else///

?>
</table>
</BODY>
</HTML>
<?Php
$html = ob_get_contents();
ob_end_clean();

$mpdf = new mPDF("UTF-8",'', 10);


//$mpdf=new mPDF('','', 10, '', 15, 15, 16, 16, 9, 9, '');
$mpdf->SetAutoFont();
//$mpdf->SetFont('angsana','',12);
$mpdf->WriteHTML($html);
$mpdf->Output("$an.pdf",'D');
?>