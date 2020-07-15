<DIV ID="map"><?php echo $_cfg_txt_load ?></DIV>
	
<DIV ID="guide">

	<H4>ข้อมูลภูมิศาสตร์</H4>
	<UL ID="layers"></UL>
	<HR CLASS="dc_fade">

	<H4>สัญลักษณ์</H4>
	<?php @include($_cfg_path['script'].'symbol.html') ?>
	<HR CLASS="dc_fade">

	<H4>เหตุการณ์</H4>
	<UL>
		<LI><DIV CLASS="icon ac"></DIV> AC Surge (alert)</LI>
		<LI><DIV CLASS="icon li"></DIV> ไฟฟ้าขัดข้อง</LI>
		<LI><DIV CLASS="icon dr"></DIV> ประตูเปิด</LI>
	</UL>
	<HR CLASS="dc_fade">

	<H4>ความลึกน้ำท่วม (เมตร)</H4>
	<UL>
		<LI><DIV CLASS="icon" STYLE="background-color:#fe0000"></DIV> Above 5.2</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#ff5500"></DIV> 4.8 - 5.2</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#fdaa02"></DIV> 4.4 - 4.8</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#fefe00"></DIV> 4.0 - 4.4</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#aaff01"></DIV> 3.6 - 4.0</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#55ff00"></DIV> 3.2 - 3.6</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#00ff00"></DIV> 2.8 - 3.2</LI>	
		<LI><DIV CLASS="icon" STYLE="background-color:#00e436"></DIV> 2.4 - 2.8</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#00c570"></DIV> 2.0 - 2.4</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#00a6a6"></DIV> 1.6 - 2.0</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#0170c1"></DIV> 1.2 - 1.6</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#0037dc"></DIV> 0.8 - 1.2</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#0000fe"></DIV> 0.4 - 0.8</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#2b00d4"></DIV> 0.0 - 0.4</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#5000a8"></DIV> -0.4 - 0.0</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#800080"></DIV> Below - 0.4</LI>
		<LI><DIV CLASS="icon" STYLE="background-color:#ffffff"></DIV> Undifined Value</LI>
	</UL>
</DIV>

<INPUT TYPE="hidden" ID="path" VALUE="<?php echo $_cfg_root.$_cfg_path['sys'] ?>map/" />
<INPUT TYPE="hidden" ID="path-img" VALUE="<?php echo $_cfg_root.$_cfg_path['img'] ?>" />
<INPUT TYPE="hidden" ID="path-zone" VALUE="<?php echo $_cfg_map ?>" />

<LINK TYPE="text/css" REL="stylesheet" HREF="<?php echo $_cfg_root.$_cfg_path['css'] ?>map.css" />
<SCRIPT TYPE="text/javascript" SRC="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=th-TH"></SCRIPT> 
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_root.$_cfg_path['sys'] ?>map/markerwithlabel.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_root.$_cfg_path['sys'] ?>map/gmap.js"></SCRIPT>
<SCRIPT TYPE="text/javascript">
$(document).ready
(		
	function()
	{	
		googleMap();
	}
);
</SCRIPT>