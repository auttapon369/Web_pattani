<FORM NAME="search" METHOD="post" TARGET="_blank" ONSUBMIT="return confirmation()">
<DIV CLASS="filter dc_gray">
	<LABEL CLASS="fc_sec fs_small"><?php echo $_cfg_label['stn'] ?></LABEL>
	<UL CLASS="check-list"><?php $_call->get_stn_list('check') ?></UL>
	<TABLE>
		<TR>
			<TD>
				<LABEL CLASS="fc_sec fs_small"><?php echo $_cfg_label['type'] ?></LABEL>
				<INPUT TYPE="checkbox" NAME="s_rain" VALUE="Y" CHECKED /> <?php echo $_cfg_data_type['rf'][0] ?>
				<BR>
				<INPUT TYPE="checkbox" NAME="s_water" VALUE="Y" CHECKED /> <?php echo $_cfg_data_type['wl'][0] ?>
				<BR>
				<INPUT TYPE="checkbox" NAME="s_flow" VALUE="Y" /> <?php echo $_cfg_data_type['fl'][0] ?>
			</TD>
			<TD>
				<LABEL CLASS="fc_sec fs_small"><?php echo $_cfg_label['time'] ?></LABEL>
				<INPUT TYPE="text" NAME="date1" VALUE="<?php echo date("d-m-Y", strtotime("-1 month")) ?>" CLASS="tcal" />
				<BR>
				<INPUT TYPE="text" NAME="date2" VALUE="<?php echo date('d-m-Y') ?>" CLASS="tcal" />
			</TD>
			<TD>
				<LABEL CLASS="fc_sec fs_small"><?php echo $_cfg_label['data'] ?></LABEL>
				<SELECT NAME="format" CLASS="bc_fade">
				<?php
				foreach ( $_cfg_select['report'] as $array )
				{
					echo "<OPTION VALUE=\"".$array[0]."\" ".$array[2].">".$array[1]."</OPTION>\n";
				}
				?>
				</SELECT>
			</TD>
			<TD>
				<LABEL CLASS="fc_sec fs_small"><?php echo $_cfg_label['format'] ?></LABEL>
				<BUTTON ONCLICK="showData('graph')" CLASS="button bc_sec fc_white"><?php echo $_cfg_btn['graph'] ?></BUTTON>
				<BUTTON ONCLICK="showData('table')" CLASS="button bc_sec fc_white"><?php echo $_cfg_btn['table'] ?></BUTTON>
			</TD>
			<TD>
				<LABEL CLASS="fc_sec fs_small"><?php echo $_cfg_label['download'] ?></LABEL>
				<BUTTON ONCLICK="showData('excel')" CLASS="button bc_gray fc_white"><?php echo $_cfg_btn['excel'] ?></BUTTON>
				<BUTTON ONCLICK="showData('pdf')" CLASS="button bc_gray fc_white"><?php echo $_cfg_btn['pdf'] ?></BUTTON>
			</TD>
		</TR>
	</TABLE>
</DIV>
<INPUT TYPE="hidden" ID="path" VALUE="report.php?view=" />
</FORM>
<LINK HREF="<?php echo $_cfg_root.$_cfg_path['script'] ?>tcal/tcal.css" REL="stylesheet" TYPE="text/css" />
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_root.$_cfg_path['script'] ?>tcal/tcal.js"></script>
<SCRIPT TYPE="text/javascript">
function showData(data)
{
	var target = $('#path').val() + data;

	$('form[name=search]').attr('action', target);
	$('form[name=search]').submit();
}
function confirmation()
{
	if ( $('input[name="stn[]"]:checked').length == 0 )
	{
		alert("คุณยังไม่ได้เลือกสถานี");
		return false;
	}
}
</SCRIPT>