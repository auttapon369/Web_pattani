<div id="map" class="f_left" style="width:400px;height:560px"><?php echo $_cfg_txt_load ?></div>
<div class="f_right" style="width:330px">
	<table width="100%" class="tb_report fs_small">
		<thead class="bc_fade">
			<tr>
				<th>รหัสสถานี</th>
				<th>ชื่อสถานี</th>
				<th>ปริมาณน้ำฝนวันนี้<br>(มม./วัน)</th>
				<th>สถานะการณ์</th>
			</tr>
		</thead>
		<tbody class="dc_fade">
		<?php $_call->data_csv($_cfg_path_today."table1.csv",5) ?>
		</tbody>
	</table>
	<div>
		<?php @include($_cfg_path['script'].'symbol.html') ?>
	</div>
</div>
<div class="clearfix">
	<br>
	<table width="100%" class="tb_report fs_small">
		<caption></caption>
		<thead class="bc_fade">
			<tr>
				<th rowspan="3">สถานี</th>
				<th rowspan="3">ลำน้ำ</th>
				<th rowspan="3">ระดับเตือนภัย<br>(ม.รทก.)</th>
				<th colspan="5">ระดับน้ำ (ม.รทก.)</th>
				<th colspan="6">ผลการพยากรณ์</th>
			</tr>
			<tr>
				<th rowspan="2">ย้อนหลัง<br>1 วัน</th>
				<th rowspan="2">ปัจจุบัน</th>
				<th colspan="3">พยากรณ์ล่วงหน้า</th>
				<th rowspan="2">สูงสุด</th>
				<th rowspan="2">วันเวลา</th>
				<th rowspan="2">ระดับน้ำท่วม<br>(ม.)</th>
				<th rowspan="2">ช่วงเวลา<br>(วัน)</th>
				<th rowspan="2">จาก</th>
				<th rowspan="2">ถึง</th>
			</tr>
			<tr>
				<th>1 วัน</th>
				<th>2 วัน</th>
				<th>3 วัน</th>
			</tr>
		</thead>
		<tbody class="dc_fade">
		<?php $_call->data_csv($_cfg_path_today."table2.csv",2) ?>
		</tbody>
	</table>
</div>
<INPUT TYPE="hidden" ID="path" VALUE="<?php echo $_cfg_root.$_cfg_path['sys'] ?>map/" />
<INPUT TYPE="hidden" ID="path-img" VALUE="<?php echo $_cfg_root.$_cfg_path['img'] ?>" />
<INPUT TYPE="hidden" ID="path-zone" VALUE="<?php echo $_cfg_map ?>" />
<LINK TYPE="text/css" REL="stylesheet" HREF="<?php echo $_cfg_path['css'] ?>map.css" />
<SCRIPT TYPE="text/javascript" SRC="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=th-TH"></SCRIPT> 
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['sys'] ?>map/markerwithlabel.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['sys'] ?>map/gmap.js"></SCRIPT>
<SCRIPT TYPE="text/javascript">
$(document).ready
(		
	function()
	{	
		googleMap();
	}
);
</SCRIPT>