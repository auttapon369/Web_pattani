<?
$conn = connDB("odbc");
?>

<TABLE CLASS="tb_report tb_margin bc_white">
	<THEAD CLASS="bc_pri fc_white dc_black">
					<tr> 
						<th rowspan="3">วันที่</th>
					</tr>
					<tr> 
						<?if($p_rain=="Y" && $nrf<>""){?><th colspan="<?=$nrf?>">ปริมาณน้ำฝน<Q CLASS="fs_small">(มม.)</Q></th><?}else{}?>
						<?if($p_water=="Y" && $nwl<>""){?><th colspan="<?=$nwl?>">ระดับน้ำ<Q CLASS="fs_small">(ม.รทก)</Q></th><?}else{}?>
						<?if($p_water=="Y" && $cwle=="Y"){?><th colspan="<?=$nwle?>">ระดับน้ำท้าย ปตร.<Q CLASS="fs_small">(ม.รทก)</Q></th><?}else{}?>
						<?if($p_flow=="Y" && $nwl<>""){?><th colspan="<?=$nfl?>">อัตราการไหล<Q CLASS="fs_small">(ลบ.ม./วินาที)</Q></th><?}else{}?>
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

						if($fl=="show"){?><th rowspan="1"><?=$_code?></th><?}else{}
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

									if($fl=="show"){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
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

									if($fl=="show"){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
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
									$wle = C_wle($_value[2],$p_water,$ssite);
									$nname = $_value[4];

									if($wle=="show"){?><td><?=numm($objResult['WLE_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$fl = C_fl($_value[2],$p_flow);
									$nname = $_value[4];

									if($fl=="show"){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
								}
								foreach($p_stn as $id)
								{
									$_value = cut($id);
									$ssite = $_value[0];
									$wl_end= $_value[5];
									$fle = C_fle($_value[2],$p_flow,$ssite);
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

									if($fl=="show"){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
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

									if($fl=="show"){?><td><?=numm($objResult['FL_'.$nname.''])?></td><?}else{}
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