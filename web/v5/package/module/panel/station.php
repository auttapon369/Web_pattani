<?php
if ( $_POST['update'] )
{
	for ( $i=0; $i < count($_stn); $i++ )
	{
		$c = 0;
		$up = array();

		if ( $_POST['name'][$i] != $_POST['name_h'][$i] )
		{
			//$text =$_POST['name'][$i];
			$text =iconv('UTF-8', 'TIS-620', $_POST['name'][$i]);
			$up[] = "STN_NAME_THAI = '".$text."'";
			$c++;
		}
		if ( $_POST['detail'][$i] != $_POST['detail_h'][$i] )
		{
			$up[] = "STN_DETAIL = '".$_POST['detail'][$i]."'";
			$c++;
		}
		if ( $_POST['n'][$i] != $_POST['n_h'][$i] )
		{
			$up[] = "UTM_N = '".$_POST['n'][$i]."'";
			$c++;
		}
		if ( $_POST['e'][$i] != $_POST['e_h'][$i] )
		{
			$up[] = "UTM_E = '".$_POST['e'][$i]."' ";
			$c++;
		}
		

		if ( $c > 0 )
		{
			$a = 0;

			//$update .= $c." > ";

			$update .= "UPDATE ".$_cfg_tb['stn']." SET ";
			foreach ( $up as $x )
			{
				$update .= ( $a > 0 ) ? ", ".$x : $x;
				$a++;
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
	//@mssql_close();
}
else
{
?>
<FORM METHOD="post" ONSUBMIT="return confirmation()">
<TABLE WIDTH="100%" CLASS="tb_form">
	<THEAD CLASS="bc_pri dc_fade">
		<TR>
			<TH WIDTH="50" ROWSPAN="2">รหัส</TH>
			<TH WIDTH="150" ROWSPAN="2">ชื่อสถานี</TH>
			<TH ROWSPAN="2">ที่ตั้ง</TH>
			<TH COLSPAN="2">พิกัด</TH>
		</TR>
		<TR>
			<TH WIDTH="75">N</TH>
			<TH WIDTH="75">E</TH>
		</TR>
	</THEAD>
	<TBODY CLASS="bc_fade dc_fade">
	<?php
	for ( $i = 0; $i < count($_stn); $i++ )
	{
			echo "<TR>\n";
			echo "<TH CLASS=\"bc_fade\">".$_stn[$i]['code']."</TH>\n";
			echo "<TD><INPUT TYPE=\"text\" NAME=\"name[]\" VALUE=\"".$_stn[$i]['name']."\" CLASS=\"left\" /><INPUT TYPE=\"hidden\" NAME=\"name_h[]\" VALUE=\"".$_stn[$i]['name']."\" /></TD>\n";
			echo "<TD><INPUT TYPE=\"text\" NAME=\"detail[]\" VALUE=\"".$_stn[$i]['detail']."\" CLASS=\"left\" /><INPUT TYPE=\"hidden\" NAME=\"detail_h[]\" VALUE=\"".$_stn[$i]['detail']."\" /></TD>\n";
			echo "<TD><INPUT TYPE=\"text\" NAME=\"n[]\" VALUE=\"".$_stn[$i]['n']."\" SIZE=\"10\" /><INPUT TYPE=\"hidden\" NAME=\"n_h[]\" VALUE=\"".$_stn[$i]['n']."\" /></TD>\n";
			echo "<TD><INPUT TYPE=\"text\" NAME=\"e[]\" VALUE=\"".$_stn[$i]['e']."\" SIZE=\"10\" /><INPUT TYPE=\"hidden\" NAME=\"e_h[]\" VALUE=\"".$_stn[$i]['e']."\" /></TD>\n";
			echo "</TR>\n";
	}
	?>
	</TBODY>
</TABLE>
<BR>
<INPUT TYPE="submit" NAME="update" STYLE="height: 50px" CLASS="button bc_sec fc_white fs_big f_right" VALUE="บันทึกการแก้ไขข้อมูล" />
</FORM>
<?
}
?>