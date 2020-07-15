<?php
$value = $_call->get_values($_id);

$link = $_cfg_path['script']."cross.php?id=".$_id."&wl=".$value['wl']."&lv1=".$_stn[0]['wl1']."&lv2=".$_stn[0]['wl2']."&bm=".$_stn[0]['bm']."&zg=".$_stn[0]['zg']."&bd=".$_stn[0]['bottom']."&left=".$_stn[0]['left']."&right=".$_stn[0]['right'];

$error = $_call->TimeDiff($value['date'], date('Y-m-d H:i'));
$rf = $_call->alarmCheck($value['rf_1h'], $_stn[0]['rf1'], $_stn[0]['rf2'], $error, "txt");
$wl = $_call->alarmCheck($value['wl'], $_stn[0]['wl1'], $_stn[0]['wl2'], $error, "txt");

$info_tool_1 = ( $_stn[0]['wl'] == "1" ) ? "Float Gauge และ Staff Gauge พร้อมกล้องวงจรปิด CCTV" : "ไม่มี";
$info_tool_2 = ( $_stn[0]['rf'] == "1" ) ? "Tipping Bucket" : "ไม่มี";
$info_tool_3 = ( $_stn[0]['fl'] == "1" ) ? "Flow Meter" : "ไม่มี";
//$info_adsl = "ข้อมูลตรวจวัดทั้งหมดจะถูกส่งแบบอัตโนมัติไปยังสถานีหลักกรมชลประทาน สามเสน ผ่านเครือข่ายการสื่อสารแบบ GPRS";
$info_adsl = "สื่อสารด้วยระบบ ";
$info_adsl .= ( $_stn[0]['adsl'] == "1" ) ? "ADSL / " : null;
$info_adsl .= ( $_stn[0]['sim'] == "1" ) ? "SIM Card (AIS)" : null;
$info_adsl .= ( $_stn[0]['sim'] == "2" ) ? "SIM Card (DTAC)" : null;
$info_adsl .= ( $_stn[0]['sim'] == "3" ) ? "SIM Card (AIS & DTAC)" : null;
$info_more = ( $_stn[0]['solar'] == "1" ) ? "ติดตั้งระบบ Solar Cell" : "-";

$img = $_cfg_path['img']."station/".$_id.".jpg";
$thumb = $_cfg_path['img']."station/thumb_".$_id.".jpg";
$cctv = new Imgs($_cfg_cctv);

if ( $_stn[0]['wl'] == 1 )
{
	if ( $_stn[0]['end'] == "Y" )
	{
		$cctv1 = $cctv->img_scan('../../img/cctv/'.$_id.'_UP/');
		$cctv2 = $cctv->img_scan('../../img/cctv/'.$_id.'_DOWN/');
	}
	else
	{
		$cctv1 = $cctv->img_scan('../../img/cctv/'.$_id.'/');
		$cctv2 = null;
	}
}
?>
<DIV ID="station">
	
	<!-- INFO -->
	<A HREF="<?php echo $img ?>" CLASS="fancybox"><IMG SRC="<?php echo $thumb ?>" WIDTH="340" ALT="loading..." /></A>
	<TABLE WIDTH="380" CLASS="tb_info dc_fade f_right">
		<TR>
			<TH CLASS="right bc_pri fc_white">รหัส</TH>
			<TD CLASS="fc_pri"><?php echo $_stn[0]['code'] ?></TD>
		</TR>
		<TR>
			<TH CLASS="right bc_pri fc_white">ชื่อสถานี</TH>
			<TD CLASS="fc_pri"><?php echo $_stn[0]['name'] ?></TD>
		</TR>
		<TR>
			<TH CLASS="right bc_fade">ที่ตั้ง</TH>
			<TD><?php echo $_stn[0]['detail'] ?></TD>
		</TR>
		<TR>
			<TH CLASS="right bc_fade">พิกัด UTM</TH>
			<TD><?php echo "N ".$_stn[0]['n'].", E ".$_stn[0]['e'] ?></TD>
		</TR>
		<TR>
			<TH CLASS="right bc_fade">อุปกรณ์วัดระดับน้ำ</TH>
			<TD><?php echo $info_tool_1 ?></TD>
		</TR>
		<TR>
			<TH CLASS="right bc_fade">อุปกรณ์วัดน้ำฝน</TH>
			<TD><?php echo $info_tool_2 ?></TD>
		</TR>
		<TR>
			<TH CLASS="right bc_fade">อุปกรณ์วัดอัตราการไหล</TH>
			<TD><?php echo $info_tool_3 ?></TD>
		</TR>
		<TR>
			<TH CLASS="right bc_fade">การสื่อสาร</TH>
			<TD><?php echo $info_adsl ?></TD>
		</TR>
		<TR>
			<TH CLASS="right bc_fade">หมายเหตุ</TH>
			<TD><?php echo $info_more ?></TD>
		</TR>
	</TABLE>


	<?php if ( $_stn[0]['rf'] == "1" ) { ?>
		

	<!-- RAIN -->
	<HR CLASS="dc_fade">
	<H3>ข้อมูล<?php echo $_cfg_data_type['rf'][0] ?></H3>
	<DIV ID="graph" CLASS="frames">graph loading...</DIV>
	<DIV CLASS="side">
		<TABLE WIDTH="100%" CLASS="tb_info dc_fade">
			<TR>
				<TH WIDTH="80" CLASS="right bc_pri fc_white">ฝน 15 นาที</TH>
				<TD CLASS="fc_pri"><?php echo $value['rf_15']." ".$_cfg_data_type['rf'][1] ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade">ฝน 1 ชม.</TH>
				<TD><?php echo $value['rf_1h']." ".$_cfg_data_type['rf'][1] ?></TD>
			</TR>		
			<TR>
				<TH CLASS="right bc_fade">ฝน 24 ชม.</TH>
				<TD><?php echo $value['rf_24']." ".$_cfg_data_type['rf'][1] ?></TD>
			</TR>
		</TABLE>
		<BR>
		<TABLE WIDTH="100%" CLASS="tb_info dc_fade">
			<TR>
				<TH WIDTH="80" CLASS="right bc_fade fc_warn">เฝ้าระวัง</TH>
				<TD><?php echo $_stn[0]['rf1']." ".$_cfg_data_type['rf'][1] ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade fc_danger">เตือนภัย</TH>
				<TD><?php echo $_stn[0]['rf2']." ".$_cfg_data_type['rf'][1] ?></TD>
			</TR>
		</TABLE>
		<BR>
		<TABLE WIDTH="100%" CLASS="tb_info dc_fade">
			<TR>
				<TH WIDTH="80" CLASS="right bc_fade">สถานการณ์</TH>
				<TD><?php echo $rf ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade">ข้อมูลวันที่</TH>
				<TD><?php echo $_call->date_simple($value['date'])." น."; ?></TD>
			</TR>
		</TABLE>
		<BR>
		<BUTTON ONCLICK="location.href='./?page=search'" CLASS="button bc_sec fc_white">ค้นหาข้อมูลย้อนหลัง คลิกที่นี่</BUTTON>
	</DIV>


	<?php } if ( $_stn[0]['wl'] == "1" ) { ?>


	<!-- WATER -->
	<HR CLASS="dc_fade">
	<H3>ข้อมูล<?php echo $_cfg_data_type['wl'][0] ?></H3>
	<IFRAME CLASS="frames" SRC="<?php echo $link ?>" FRAMEBORDER="0" SCROLLING="no"></IFRAME>
	<DIV CLASS="side">
		<TABLE WIDTH="100%" CLASS="tb_info dc_fade">

			<?php if ( $_stn[0]['end'] == "Y" ) { ?>

			<TR>
				<TH CLASS="right bc_pri fc_white">ระดับเหนือน้ำ</TH>
				<TD><?php echo $value['wl']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_pri fc_white">ระดับท้ายน้ำ</TH>
				<TD><?php echo $value['wle']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>

			<?php } else { ?>

			<TR>
				<TH CLASS="right bc_pri fc_white">ระดับน้ำ</TH>
				<TD><?php echo $value['wl']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>

			<?php } ?>

			<?php if ( !in_array($_id, $_cfg_flow) ) { ?>

			<TR>
				<TH WIDTH="80" CLASS="right bc_fade">อัตราการไหล</TH>
				<TD><?php echo $value['fl'] ?> ลบ.ม./วินาที</TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade">ความจุลำน้ำ</TH>
				<TD><?php echo $value['ca'] ?> %</TD>
			</TR>
			
			<?php } ?>

		</TABLE>
		<BR>
		<TABLE WIDTH="100%" CLASS="tb_info dc_fade">
			<TR>
				<TH WIDTH="80" CLASS="right bc_fade">ตลิ่งซ้าย</TH>
				<TD><?php echo $_stn[0]['left']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade">ตลิ่งขวา</TH>
				<TD><?php echo $_stn[0]['right']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade">ท้องคลอง</TH>
				<TD><?php echo $_stn[0]['bottom']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade">Zero Guage</TH>
				<TD><?php echo $_stn[0]['zg']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade">B.M.</TH>
				<TD><?php echo $_stn[0]['bm']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>
		</TABLE>
		<BR>
		<TABLE WIDTH="100%" CLASS="tb_info dc_fade">
			<TR>
				<TH WIDTH="80" CLASS="right bc_fade fc_warn">เฝ้าระวัง</TH>
				<TD><?php echo $_stn[0]['wl1']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade fc_danger">เตือนภัย</TH>
				<TD><?php echo $_stn[0]['wl2']." ".$_cfg_data_type['wl'][1] ?></TD>
			</TR>
		</TABLE>
		<BR>
		<TABLE WIDTH="100%" CLASS="tb_info dc_fade">
			<TR>
				<TH WIDTH="80" CLASS="right bc_fade">สถานการณ์</TH>
				<TD><?php echo $wl ?></TD>
			</TR>
			<TR>
				<TH CLASS="right bc_fade">ข้อมูลวันที่</TH>
				<TD><?php echo $_call->date_simple($value['date'])." น."; ?></TD>
			</TR>
		</TABLE>
		<BR>
		<A HREF="<?php echo $link ?>" data-fancybox-type="iframe" CLASS="button bc_black fc_white zoom">ขยายภาพตัดลำน้ำ คลิกที่นี่</A>
		<BUTTON ONCLICK="location.href='./?page=search'" CLASS="button bc_sec fc_white">ค้นหาข้อมูลย้อนหลัง คลิกที่นี่</BUTTON>
		<BUTTON ONCLICK="location.href='./?page=cctv'" CLASS="button bc_sec fc_white">ค้นหา CCTV ย้อนหลัง คลิกที่นี่</BUTTON>
	</DIV>

	<?php if ( !in_array($_id, $_cfg_block_cctv) ) { ?>
	<BR>
	<A CLASS="fancybox margin" HREF="<?php echo $cctv1 ?>"><IMG SRC="<?php echo $cctv1 ?>" WIDTH="340" TITLE="เหนือน้ำ" /></A>
	
	<?php if ( $_stn[0]['end'] == "Y" ) { ?>

	<A CLASS="fancybox margin" HREF="<?php echo $cctv2 ?>"><IMG SRC="<?php echo $cctv2 ?>" WIDTH="340" TITLE="ท้ายน้ำ" /></A>

	<?php } } } ?>

</DIV>

<INPUT TYPE="hidden" ID="inp-path" VALUE="<?php echo $_cfg_path['sys']."stats/rain-graph.php"; ?>">
<INPUT TYPE="hidden" ID="inp-date" VALUE="<?php echo $value['date'] ?>">

<LINK HREF="<?php echo $_cfg_root.$_cfg_path['script'] ?>fancybox/source/jquery.fancybox.css" REL="stylesheet" TYPE="text/css" />
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_root.$_cfg_path['script'] ?>fancybox/source/jquery.fancybox.js?v=2.1.5"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_root.$_cfg_path['sys'] ?>stats/chart/highstock.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_root.$_cfg_path['sys'] ?>stats/chart/exporting.js"></SCRIPT>
<SCRIPT TYPE="text/javascript">
$(document).ready
(		
	function()
	{
		$('.fancybox').fancybox
		(
			{
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers :
				{
					overlay : null
				}
			}
		);
		$(".zoom").fancybox
		(
			{
				maxWidth	: 1080,
				maxHeight	: 800,
				fitToView	: false,
				width			: '80%',
				height		: '80%',
				autoSize		: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			}
		);


		if ( $('#graph').length > 0 )
		{
/*
			var d = new Date();
			var month = d.getMonth()+1;
			var day = d.getDate();
			var output = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;
*/
			$.post
			(
				$('#inp-path').val(),
				{
					id: location.href.split("&id=")[1],
					view: 'RF',
					format: '15MIN',
					date1: $('#inp-date').val(),
					date2: $('#inp-date').val()
				},
				function(data)
				{
					$('#graph').html(data);
				}
			);
		}
	}
);
</SCRIPT>