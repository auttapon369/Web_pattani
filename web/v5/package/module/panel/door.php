<?php
if ( $_REQUEST['update'] )
{

	/*
	echo $_POST['day']."<BR>";
	echo $_POST['month']."<BR>";
	echo $_POST['year']."<BR>";
	echo $_POST['timeH']."<BR>";
	echo $_POST['timeM']."<BR>";
	*/

	// Var
	$update = date('Y-m-d H:i:s');
	$date = $_POST['date'].' '.$_POST['timeH'].':'.$_POST['timeM'].':00';
	//$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'].' '.$_POST['timeH'].':'.$_POST['timeM'].':00';
	$now = 0;


	// Insert
	$sql = "INSERT INTO [".$_cfg_conn['db']."].[dbo].control_log (cl_no,cl_update,cl_date,cl_type,cl_value,c_id) VALUES";


	// Total
	$sql_total = 'SELECT SUM(c_door_water) total FROM ['.$_cfg_conn['db'].'].[dbo].control';
	$res_total =odbc_exec($conn, $sql_total);
	$arr_total = odbc_fetch_array($res_total);
	$total = $arr_total['total'];


	// Select
	$sql_stn = 'SELECT c_id, c_door_water FROM ['.$_cfg_conn['db'].'].[dbo].control ORDER BY c_id';
	$res_stn = odbc_exec($conn, $sql_stn);


	while ( $arr_stn = odbc_fetch_array($res_stn) )
	{	
		$id = $arr_stn['c_id'];
		$count = $arr_stn['c_door_water'];

		for ( $i = 1; $i <= $count; $i++ )
		{
			$door = 'd_'.$id.'_'.$i;
			$value = trim($_POST[$door]);
			$value = ( empty($value) ) ? 0 : $value;
			$now++;

			//echo $door.' == '.$_POST[$door]."<BR>";

			$sql .= " ('".$i."', '".$update."', '".$date."', 'W', '".$value."', '".$id."')";
			$sql .= ( $now == $total ) ? '' : ',';
		}
	}

	// END Insert
	
	//echo $sql ;
	$res = odbc_exec($conn,$sql);

	// Echo
	if ( $res )
	{
		include("excels_save.php");
		echo $_cfg_form_success;
		
	}
	else
	{
		echo $_cfg_form_error;
	}

	echo $_refresh;

	//@odbc_close();
}
else
{
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
?>
<FORM METHOD="post" ONSUBMIT="return confirmation()">
	
	<?php include($_cfg_path['sys']."panel/door-table.php"); ?>

	<DIV CLASS="filter dc_gray">
		<TABLE>
			<TR>
				<TD>
					<LABEL CLASS="fc_sec fs_small">เลือกวันที่</LABEL>
					<SPAN><INPUT TYPE="text" NAME="date" VALUE="<? echo date('Y-m-d') ?>" CLASS="tcal" /></SPAN>
				</TD>
				<TD>
					<LABEL CLASS="fc_sec fs_small">เลือกช่วงเวลา</LABEL>
					<SELECT NAME="timeH" CLASS="bc_fade">
					<?php
					for ( $i = 0; $i < 24; $i++ )
					{
						$value = sprintf('%02d', $i);
						$select = ( date('H') == $value ) ? ' SELECTED' : '';
						echo '<OPTION VALUE="'.$value.'"'.$select.'>'.$value.'</OPTION>';
					}
					?>
					</SELECT>
					<SELECT name="timeM" CLASS="bc_fade">
					<?php
					for ( $i = 0; $i < 12; $i++ )
					{
						$n = $i * 5;
						$value = sprintf('%02d', $n);
						echo '<OPTION VALUE="'.$value.'">'.$value.'</OPTION>';
					}
					?>
					</SELECT>	
				</TD>
				<TD>
					<LABEL CLASS="fs_small">&nbsp;</LABEL>
					<INPUT TYPE="submit" NAME="update" STYLE="height: 20px" CLASS="button bc_sec fc_white" VALUE="บันทึกข้อมูล" />
					&nbsp;&nbsp;&nbsp;&nbsp;** คลิกตัวเลขในตาราง เพื่อแก้ไขค่าตัวเลขใหม่
				</TD>
			</TR>
		</TABLE>
	</DIV>
</FORM>
<BR>
<H3>รายการบันทึกย้อนหลัง</H3>
<UL CLASS="list-recent dc_fade">
<?php
	while ( $arr_log = odbc_fetch_array($res_log) )
	{
		echo "<LI><A HREF=\"".$_cfg_path_page."excels.php?date=".date('Y-m-d H:i', strtotime($arr_log['cl_date']))."\"><IMG SRC=\"".$_cfg_root.$_cfg_path['img']."ic_excel.png\" WIDTH=\"32\" ALT=\"excel\" target=\"_blank\"> water_door_".date('Y_m_d', strtotime($arr_log['cl_date'])).".xls</A><Q>".date('Y-m-d H:i', strtotime($arr_log['cl_date']))."</Q></LI>\n";
	}
?>
</UL>
<?php
}
?>