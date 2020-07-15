<?php
$sql_num_door = 'SELECT MAX(c_door_water) as n FROM ['.$_cfg_conn['db'].'].[dbo].[control]';
$res_num_door = odbc_exec($conn, $sql_num_door);
$num_door = odbc_fetch_array($res_num_door);

$sql_num_sand = 'SELECT MAX(c_door_sand) as n FROM ['.$_cfg_conn['db'].'].[dbo].[control]';
$res_num_sand = odbc_exec($conn, $sql_num_sand);
$num_sand = odbc_fetch_array($res_num_sand);

$num = $num_door['n'] + $num_sand['n'];

$sql_stn = 'SELECT * FROM ['.$_cfg_conn['db'].'].[dbo].[control] ORDER BY c_id';
$res_stn = odbc_exec($conn, $sql_stn);

$sql_log = 'SELECT DISTINCT cl_date FROM ['.$_cfg_conn['db'].'].[dbo].[control_log] ORDER BY cl_date DESC';
$res_log = odbc_exec($conn, $sql_log);

$bg = ( empty($_GET['view']) ) ? " STYLE=\"background-color:yellow\"" : null;
?>
<TABLE CLASS="tb_form" BORDER="1">
		<THEAD CLASS="bc_pri dc_fade">
			<TR>
				<TH ROWSPAN="3"<?php echo $bg ?>>ปตร. / ทรบ.</TH>
				<TH COLSPAN="<?php echo $num ?>"<?php echo $bg ?>>ระยะยกบาน <SPAN CLASS="fs_small">(หน่วย : เมตร)</SPAN></TH>
			</TR>
			<TR>
			<?php
			if ( $num_door['n'] > 0 )
			{
				echo "<TH COLSPAN=\"".$num_door['n']."\"".$bg.">ประตูระบายน้ำ</TH>";
			}
			if ( $num_sand['n'] > 0 )
			{
				echo "<TH COLSPAN=\"".$num_sand['n']."\"".$bg.">ประตูระบายทราย</TH>";
			}
			?>
			</TR>
			<TR>
			<?php
			for ( $i = 1; $i <= $num_door['n']; $i++ )
			{
				echo "<TH".$bg.">บานที่ ".$i."</TH>\n";
			}
			for ( $i = 1; $i <= $num_sand['n']; $i++ )
			{
				echo "<TH".$bg.">บานที่ ".$i."</TH>\n";
			}
			?>
			</TR>
		</THEAD>
		<TBODY CLASS="bc_fade dc_fade">
		<?php
		while ( $arr_stn = odbc_fetch_array($res_stn) )
		{
			$sql_no = "SELECT TOP ".( $arr_stn['c_door_water'] + $arr_stn['c_door_sand'] )." * FROM [".$_cfg_conn['db']."].[dbo].[control_log] WHERE c_id = '".$arr_stn['c_id']."' ORDER BY cl_update DESC, cl_no";
			$res_no = odbc_exec($conn, $sql_no);

			echo "<TR>\n";
			echo "<TH ALIGN=\"left\" CLASS=\"bc_fade left\">".$_call->convTH($arr_stn['c_name'], "out")."</TH>\n";

			$n = 0;
			while ( $arr_no = odbc_fetch_array($res_no) )
			{
				$n++;
				
				if ( $_GET['view'] == "door" )
				{
					echo "<TD><INPUT TYPE=\"text\" NAME=\"d_".$arr_stn['c_id']."_".$arr_no['cl_no']."\" VALUE=\"".$arr_no['cl_value']."\" /></TD>\n";
				}
				else
				{
					echo "<TD ALIGN=\"center\">".$arr_no['cl_value']."</TD>\n";
				}
			}

			if ( $n < $num )
			{
				for ( $i = 0; $i < ( $num - $n ); $i++ )
				{
					$gray = ( empty($_GET['view']) ) ? "STYLE=\"background-color:gray\"" : null;
					echo "<TD CLASS=\"bc_black\"".$gray.">&nbsp;</TD>\n";
				}
			}

			echo "</TR>\n";
		}
		?>
		</TBODY>
</TABLE>