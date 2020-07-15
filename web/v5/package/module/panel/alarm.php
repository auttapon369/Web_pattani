<?php
if ( $_POST['update'] )
{
		for ( $i=0; $i < count($_stn); $i++ )
		{
			$al = 0;
			$up = array();

			if ( $_POST['RF1'][$i] != $_POST['RF1_h'][$i] )
			{
				$up[] = "alarm_RF1 = '".$_POST['RF1'][$i]."'";
				$al++;
			}
			if ( $_POST['RF2'][$i] != $_POST['RF2_h'][$i] )
			{
				$up[] = "alarm_RF2 = '".$_POST['RF2'][$i]."'";
				$al++;
			}
			if ( $_POST['WL1'][$i] != $_POST['WL1_h'][$i] )
			{
				$up[] = "alarm_WL1 = '".$_POST['WL1'][$i]."'";
				$al++;
			}
			if ( $_POST['WL2'][$i] != $_POST['WL2_h'][$i] )
			{
				$up[] = "alarm_WL2 = '".$_POST['WL2'][$i]."' ";
				$al++;
			}
			

			if ( $al > 0 )
			{
				$n = 0;

				//$update .= $c." > ";

				$update .= "UPDATE ".$_cfg_tb['stn']." SET ";
				foreach ( $up as $x )
				{
					$update .= ( $n > 0 ) ? ", ".$x : $x;
					$n++;
				}

				$update .= " WHERE STN_ID = '".$_stn[$i]['id']."'";
				//$update .= "<br>";
			}
/*
			else
			{
				$update .= "no change<br>";
			}
*/

			unset($up);	
		}

	//echo $update;
	$res = odbc_exec($conn,$update);

	if ( $res )
	{
		echo $_cfg_form_success;
	}
	else
	{
		echo $_cfg_form_error;
	}

	echo $_refresh;
}
else
{
?>
<FORM METHOD="post" ONSUBMIT="return confirmation()">
	<TABLE CLASS="tb_form">
		<THEAD CLASS="bc_pri dc_fade">
			<TR>
				<TH ROWSPAN="2">รหัสสถานี</TH>
				<TH ROWSPAN="2">ชื่อสถานี</TH>
				<TH COLSPAN="2">ระดับเตือนภัยปริมาณน้ำฝน </TH>
				<TH COLSPAN="2">ระดับเตือนภัยระดับน้ำ </TH>
			</TR>
			<TR>
				<TH>เฝ้าระวัง</TH>
				<TH>วิกฤติ</TH>
				<TH>เฝ้าระวัง</TH>
				<TH>วิกฤติ</TH>
			</TR>
		</THEAD>
		<TBODY CLASS="bc_fade dc_fade">
		<?php
		for ( $i = 0; $i < count($_stn); $i++ )
		{
			$c_rf=$_stn[$i]['rf'];
			$c_wl=$_stn[$i]['wl'];

			echo "<TR>\n";
			//echo "<TD><A HREF=\"./?sys=alarm&view=editalarm&stn=".$arr_stn['STN_ID']."\"><IMG SRC=\"../img/ic_edit.png\" WIDTH=\"16\" ALT=\"แก้ไข\"></A></TD>\n"; 

			echo "<TH CLASS=\"bc_fade\">".$_stn[$i]['code']."</TH>\n";
			echo "<TD CLASS=\"bc_fade left\">".$_stn[$i]['name']."</TD>\n";
			
			if($c_rf=="1")
			{
				echo "<TD><INPUT TYPE=\"text\" NAME=\"RF1[]\" VALUE=\"".$_stn[$i]['rf1']."\" /><INPUT TYPE=\"hidden\" NAME=\"RF1_h[]\" VALUE=\"".$_stn[$i]['rf1']."\" /></TD>\n";
				echo "<TD><INPUT TYPE=\"text\" NAME=\"RF2[]\" VALUE=\"".$_stn[$i]['rf2']."\" /><INPUT TYPE=\"hidden\" NAME=\"RF2_h[]\" VALUE=\"".$_stn[$i]['rf2']."\" /></TD>\n";
			}
			else
			{
				echo "<TD CLASS=\"bc_black\"><INPUT TYPE=\"hidden\" NAME=\"RF1[]\" VALUE=\"\" /><INPUT TYPE=\"hidden\" NAME=\"RF1_h[]\" VALUE=\"\" /></TD>\n";
				echo "<TD CLASS=\"bc_black\"><INPUT TYPE=\"hidden\" NAME=\"RF2[]\" VALUE=\"\" /><INPUT TYPE=\"hidden\" NAME=\"RF2_h[]\" VALUE=\"\" /></TD>\n";
			}

			if($c_wl=="1")
			{
				echo "<TD><INPUT TYPE=\"text\" NAME=\"WL1[]\" VALUE=\"".numa($_stn[$i]['wl1'])."\" /><INPUT TYPE=\"hidden\" NAME=\"WL1_h[]\" VALUE=\"".$_stn[$i]['wl1']."\" /></TD>\n";
				echo "<TD><INPUT TYPE=\"text\" NAME=\"WL2[]\" VALUE=\"".numa($_stn[$i]['wl2'])."\" /><INPUT TYPE=\"hidden\" NAME=\"WL2_h[]\" VALUE=\"".$_stn[$i]['wl2']."\" /></TD>\n";
			}
			else
			{
				echo "<TD CLASS=\"bc_black\"><INPUT TYPE=\"hidden\" NAME=\"WL1[]\" VALUE=\"\" /><INPUT TYPE=\"hidden\" NAME=\"WL1_h[]\" VALUE=\"\" /></TD>\n";
				echo "<TD CLASS=\"bc_black\"><INPUT TYPE=\"hidden\" NAME=\"WL2[]\" VALUE=\"\" /><INPUT TYPE=\"hidden\" NAME=\"WL2_h[]\" VALUE=\"\" /></TD>\n";
			}

			echo "</TR>\n";
		}
		?>
		</TBODY>
	</TABLE>
	<BR>
	<INPUT TYPE="submit" NAME="update" STYLE="height: 50px" CLASS="button bc_sec fc_white fs_big f_right" VALUE="บันทึกการแก้ไขข้อมูล" />
</FORM>
<?php
}
?>