<?php
$_back = "../../../";
include($_back.'data/config.php');
include($_back.$_cfg_path['class'].'index.php');

if ( $_POST['type'] == "main" )
{
	$info_id = $_POST['id'];
	$info_img = $_cfg_root.$_cfg_path['img']."station/".$info_id.".jpg";
	$info_name = $_cfg_station[$info_id]['name'];
	$info_adr = $_cfg_station[$info_id]['address'];
	$info_utm = $_cfg_station[$info_id]['utm'];
	$info_tool_1 = $_cfg_station[$info_id]['tool'];
	$info_tool_2 = null;
	$info_tool_3 = null;
	$info_adsl = $_cfg_station[$info_id]['adsl'];
}
else if ( $_POST['type'] == "sub" )
{
	$_call = new Tele($_cfg_tb, $_cfg_conn);
	$_stn = $_call->get_stn($_POST['id']);
	$info_id = $_stn[0]['code'];
	$info_img = $_cfg_root.$_cfg_path['img']."station/thumb_".$_POST['id'].".jpg";
	$info_name = $_stn[0]['name'];
	$info_adr = $_stn[0]['detail'];
	$info_utm = $_stn[0]['n']."\"N&nbsp;&nbsp;".$_stn[0]['e']."\"E";
	$info_tool_1 = ( $_stn[0]['wl'] == "1" ) ? "Float Gauge และ Staff Gauge พร้อมกล้องวงจรปิด CCTV" : "ไม่มี";
	$info_tool_2 = ( $_stn[0]['rf'] == "1" ) ? "Tipping Bucket" : "ไม่มี";
	$info_tool_3 = "ไม่มี";
	$info_adsl = "ข้อมูลตรวจวัดทั้งหมดจะถูกส่งแบบอัตโนมัติไปยังสถานีหลักกรมชลประทาน สามเสน ผ่านเครือข่ายการสื่อสารแบบ GPRS";
}
else
{
	echo "<DIV CLASS=\"bc_white\">".$_cfg_txt_error."</DIV>";
	exit();
}
?>
<TABLE WIDTH="340" CLASS="bc_white dc_fade">
	<TR>
		<TH HEIGHT="255" COLSPAN="2" CLASS="left nopad bc_black fc_white"><IMG SRC="<?php echo $info_img ?>" WIDTH="100%" BORDER="0" ALT="no photo"></TH>
	</TR>
	<TR>
		<TH CLASS="right bc_fade">ชื่อสถานี</TH>
		<TD><?php echo $info_name ?></TD>
	</TR>
	<TR>
		<TH CLASS="right bc_fade">รหัสสถานี</TH>
		<TD><?php echo $info_id ?></TD>
	</TR>
	<TR>
		<TH CLASS="right bc_fade">ที่ตั้ง</TH>
		<TD><?php echo $info_adr ?></TD>
	</TR>
	<TR>
		<TH CLASS="right bc_fade">พิกัด UTM</TH>
		<TD><?php echo $info_utm ?></TD>
	</TR>

	<?php if ( $_POST['type'] == "main" ) { ?>
	
	<TR>
		<TH CLASS="right bc_fade">อุปกรณ์เครื่องมือ</TH>
		<TD><?php echo $info_tool_1 ?></TD>
	</TR>
	
	<?php } else if ( $_POST['type'] == "sub" ) { ?>
	
	<TR>
		<TH CLASS="right bc_fade">อุปกรณ์วัดระดับน้ำ</TH>
		<TD><?php echo $info_tool_1 ?></TD>
	</TR>
	<TR>
		<TH CLASS="right bc_fade">อุปกรณ์วัดน้ำฝน</TH>
		<TD><?php echo $info_tool_2 ?></TD>
	</TR>
	<TR>
		<TH CLASS="right bc_fade">อุปกรณ์วัดคุณภาพน้ำ</TH>
		<TD><?php echo $info_tool_3 ?></TD>
	</TR>

	<?php } else {} ?>

	<TR>
		<TH CLASS="right bc_fade">การสื่อสาร</TH>
		<TD><?php echo $info_adsl ?></TD>
	</TR>
</TABLE>