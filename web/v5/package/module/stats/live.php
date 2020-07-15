<TABLE width="100%" CLASS="tb_report fs_small">
	<THEAD CLASS="bc_fade dc_black">
		<TR>
			<TH ROWSPAN="2">สถานีโทรมาตร</TH>
			<TH ROWSPAN="2">วัน, เวลา (น.)</TH>
			<TH COLSPAN="3"><?php echo $_cfg_data_type['rf'][0]." (".$_cfg_data_type['rf'][1].")"; ?></TH>
			<TH COLSPAN="3"><?php echo $_cfg_data_type['wl'][0]." (".$_cfg_data_type['wl'][1].")"; ?></TH>
			<TH ROWSPAN="2"><?php echo $_cfg_data_type['fl'][0]."<br>(".$_cfg_data_type['fl'][1].")"; ?></TH>
			<TH ROWSPAN="2"><?php echo $_cfg_data_type['ca'][0]."<br>(".$_cfg_data_type['ca'][1].")"; ?></TH>
			<TH COLSPAN="2">สถานการณ์</TH>
		</TR>
		<TR>
			<TH>15 นาที</TH>
			<TH>1 ชม.</TH>
			<TH>24 ชม.</TH>
			<TH>เตือนภัย</TH>
			<TH>หน้า</TH>
			<TH>ท้าย</TH>
			<TH>ฝน</TH>
			<TH>น้ำ</TH>
		</TR>
	</THEAD>
	<TBODY CLASS="dc_fade">	
	<?php 
	for ( $i = 0; $i < count($_stn); $i++ )
	{
		$n = $i + 1;
		$val = $_call->get_values($_stn[$i]['id']);
		$error = $_call->TimeDiff($val['date'], date('Y-m-d H:i'));
		$ef_lost = ( $error > 2 ) ? "fc_gray" : null;
		$ic_rf = "rf_".$_call->alarmCheck($val['rf_1h'], $_stn[$i]['rf1'], $_stn[$i]['rf2'], $error);
		$ic_wl = "wl_".$_call->alarmCheck($val['wl'], $_stn[$i]['wl1'], $_stn[$i]['wl2'], $error);

		// rf
		if ( $_stn[$i]['rf'] == 1 )
		{
			$ic_rf = "<DIV CLASS=\"icon ".$ic_rf."\"></DIV>";
			//$bc_rf = null;
			$val_rf = $val['rf_15'];
			$val_rf_1 = $val['rf_1h'];
			$val_rf_24 = $val['rf_24'];
		}
		else
		{
			$ic_rf = null;
			//$bc_rf = "bc_gray";
			$val_rf = "-";
			$val_rf_1 = "-";
			$val_rf_24 = "-";
		}

		// wl
		if ( $_stn[$i]['wl'] == 1 )
		{
			$ic_wl = "<DIV CLASS=\"icon ".$ic_wl."\"></DIV>";
			//$bc_wl = null;
			$lv1_wl = $_stn[$i]['wl1'];
			$val_wl = $val['wl'];
			$val_wle = ( $_stn[$i]['end'] == "Y" ) ? $val['wle'] : "-";
			$val_fl = ( !in_array($_stn[$i]['id'], $_cfg_flow) ) ? $val['fl'] : '-';
			$val_ca = ( !in_array($_stn[$i]['id'], $_cfg_flow) ) ? $val['ca'] : '-';
		}
		else
		{
			$ic_wl = null;
			//$bc_wl = "bc_gray";
			$lv1_wl = "-";
			$val_wl = "-";
			$val_wle = "-";
			$val_fl = "-";
			$val_ca = "-";
		}

		//$bc_wle = ( $_stn[$i]['end'] == "Y" ) ? null : "bc_gray";

		echo "<TR CLASS=\"".$ef_lost."\">\n";
		echo "\t<TD CLASS=\"left nowrap\"><A HREF=\"./?page=station&id=".$_stn[$i]['id']."\">".$_stn[$i]['code']." ".$_stn[$i]['name']."</A></TD>";
		echo "<TD CLASS=\"center nowrap\" ID=\"DT".$n."\"><SPAN>".$_call->date_simple($val['date'])."</SPAN></TD>";
		echo "<TD CLASS=\"right ".$bc_rf."\" ID=\"RF_15MIN".$n."\"><SPAN>".$val_rf."</SPAN></TD>";
		echo "<TD CLASS=\"right ".$bc_rf."\" ID=\"RF_1H".$n."\"><SPAN>".$val_rf_1."</SPAN></TD>";
		echo "<TD CLASS=\"right ".$bc_rf."\" ID=\"RF_24H".$n."\"><SPAN>".$val_rf_24."</SPAN></TD>";
		echo "<TD CLASS=\"right ".$bc_wl."\">".$lv1_wl."</TD>";
		echo "<TD CLASS=\"right ".$bc_wl."\" ID=\"WL".$n."\"><SPAN>".$val_wl."</SPAN></TD>";
		echo "<TD CLASS=\"right ".$bc_wle."\" ID=\"WL_E".$n."\"><SPAN>".$val_wle."</SPAN></TD>";
		echo "<TD CLASS=\"right ".$bc_wl."\" ID=\"FLOW".$n."\">".$val_fl."</TD>";
		echo "<TD CLASS=\"right ".$bc_wl."\" ID=\"CAPACITY".$n."\">".$val_ca."</TD>";
		echo "<TD CLASS=\"center\">".$ic_rf."</TD>";
		echo "<TD CLASS=\"center\">".$ic_wl."</TD>\n";
		echo "</TR>\n";
		
		flush();
		ob_flush();
	}
	unset($i);
	?>
	</TBODY>
</TABLE>