<TABLE WIDTH="100%" CLASS="tb_report fs_small">
	<THEAD CLASS="bc_pri dc_fade">
		<TR>
			<!--<TH ROWSPAN="2">ลำดับ</TH>-->
			<TH ROWSPAN="2">รหัส</TH>
			<TH ROWSPAN="2">ชื่อสถานี</TH>
			<TH ROWSPAN="2">ที่ตั้ง</TH>
			<TH COLSPAN="2">พิกัดตำแหน่งที่ตั้ง</TH>
			<TH COLSPAN="5">อุปกรณ์ที่ติดตั้ง</TH>
		</TR>
		<TR>
			<TH WIDTH="50">ตะวันออก</TH>
			<TH WIDTH="50">เหนือ</TH>
			<TH WIDTH="40">ฝน</TH>
			<TH WIDTH="40">ระดับน้ำ</TH>
			<TH WIDTH="40">ท้ายน้ำ</TH>
			<TH WIDTH="40">กล้อง</TH>
			<TH WIDTH="40">โซล่าเซลล์</TH>
		</TR>
	</THEAD>
	<TBODY CLASS="dc_fade">	
	<?php 
	for ( $i = 0; $i < count($_stn); $i++ )
	{
		$n = $i + 1;
		$rf = ( $_stn[$i]['rf'] == 1 ) ? "•" : "-";
		$wl = ( $_stn[$i]['wl'] == 1 ) ? "•" : "-";
		$end = ( $_stn[$i]['end'] == "Y" ) ? "•" : "-";
		$solar = ( $_stn[$i]['solar'] == 1 ) ? "•" : "-";
		
		echo "<TR>\n";
		//echo "<TD>".$n."</TD>\n";
		echo "<TD>".$_stn[$i]['code']."</TD>\n";
		echo "<TD CLASS=\"left\">".$_stn[$i]['name']."</TD>\n";
		echo "<TD CLASS=\"left wrap\">".$_stn[$i]['detail']."</TD>\n";
		echo "<TD>".$_stn[$i]['n']."</TD>\n";
		echo "<TD>".$_stn[$i]['e']."</TD>\n";
		echo "<TD>".$rf."</TD>\n";
		echo "<TD>".$wl."</TD>\n";
		echo "<TD>".$end."</TD>\n";
		echo "<TD>".$wl."</TD>\n";
		echo "<TD>".$solar."</TD>\n";
		echo "</TR>\n";
	}
	?>
	</TBODY>
</TABLE>