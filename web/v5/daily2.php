<?php
@include('data/config.php');
@include($_cfg_path['class'].'index.php');
//@include($_cfg_path['script'].'browser.php');
$_call = new Tele($_cfg_tb, $_cfg_conn);
$time = ( empty($_GET['t']) ) ? $_cfg_time : $_GET['t'];
$datetime = $_cfg_day." ".$time;
$datethai = $_call->date_thai($datetime);
?>
<!DOCTYPE HTML>
<HTML LANG="th-TH">
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE><?php echo $_cfg_title ?></TITLE>
<LINK HREF="<?php echo $_cfg_path['img'] ?>favicon.ico" REL="shortcut icon" />
<LINK HREF="<?php echo $_cfg_path['img'] ?>apple-touch-icon.png" REL="apple-touch-icon" />
<LINK HREF="<?php echo $_cfg_path['css'] ?>reset.css" REL="stylesheet" TYPE="text/css" />
<LINK HREF="<?php echo $_cfg_path['css'] ?>style.css" REL="stylesheet" TYPE="text/css" />
<LINK HREF="<?php echo $_cfg_path['data'] ?>color.css" REL="stylesheet" TYPE="text/css" />
<LINK HREF="<?php echo $_cfg_path['data'] ?>report.css" REL="stylesheet" TYPE="text/css" />
</HEAD>
<BODY>


<!-- control -->
<div class="control bc_pri fc_white hide">
	<form method="get" class="body center">
		<label>รายงานสถานการณ์ประจำวัน, เวลา <input type="text" id="dtm" name="t" value="<?php echo $time ?>" size="3" readonly /> <input type="submit" value="ตกลง"></label>
	</form>
</div>


<!-- first page -->
<div class="paper_first_page shadow">
	<div class="head">
		<img src="<?php echo $_cfg_path['img'] ?>icon.png" width="100" alt="กรมชลประทาน">
		<br>
		<h5><?php echo $_cfg_desc ?></h5>
		<small><?php echo $_cfg_footer ?></small>
		<hr>
	</div>
	<h3 class="center clearfix">รายงานสถานการณ์น้ำประจำ<?php echo $datethai ?></h3>
	<br>
	<h4>1. สภาพภูมิอากาศ</h4>
	<br>
	<div class="fs_small">
	<?php
	foreach ( $_cfg_xml as $xml )
	{
		if ( $xml[1] == 1 )
		{
			$_call->data_xml($xml[0]);
		}
	}
	?>
	</div>
</div>


<!-- page 2 -->
<div class="paper shadow">
	<h4>2. สภาพฝน</h4>
	<br>
	<table width="100%" class="tb_report fs_small">
		<caption>ปริมาณฝนสะสมและการคาดการณ์ (มม.) รายสถานี <?php echo $datethai ?></caption>
		<thead class="bc_fade">
			<tr>
				<th>สถานี</th>
				<th>ฝน 1 วัน</th>
				<th>ฝน 2 วัน</th>
				<th>ฝน 3 วัน</th>
				<th>ล่วงหน้า 1 วัน</th>
				<th>ล่วงหน้า 2 วัน</th>
				<th>ล่วงหน้า 3 วัน</th>
				<th>สถานี</th>
			</tr>
		</thead>
		<tbody>
		<?php $_call->data_csv($_cfg_path_today."table3.csv", 4) ?>
		</tbody>
	</table>
	<br>
	<ol class="fs_small">
		<h5>คำอธิบาย</h5>
		<li>ปริมาณฝนสะสม ฝน 1 วัน หมายถึง ปริมาณฝนตรวจวัดสะสม ตั้งแต่ ณ วัน-เวลา ย้อนหลังไป 24 ชั่วโมง จากวัน –เวลา ที่จัดทำรายงานนี้</li>
		<li>ปริมาณฝนสะสม ฝน 2 วัน หมายถึง ปริมาณฝนตรวจวัดสะสม ตั้งแต่ ณ วัน-เวลา ย้อนหลังไป 48 ชั่วโมง จากวัน –เวลา ที่จัดทำรายงานนี้</li>
		<li>ปริมาณฝนสะสม ฝน 3 วัน หมายถึง ปริมาณฝนตรวจวัดสะสม ตั้งแต่ ณ วัน-เวลา ย้อนหลังไป 72 ชั่วโมง จากวัน –เวลา ที่จัดทำรายงานนี้</li>
		<li>คาดการณ์ฝนสะสม ล่วงหน้า 1 วัน หมายถึง ปริมาณฝนสะสม ตั้งแต่ ณ วัน-เวลา ล่วงหน้าไป 24 ชั่วโมง จากวัน –เวลา ที่จัดทำรายงานนี้</li>
		<li>คาดการณ์ฝนสะสม ล่วงหน้า 2 วัน หมายถึง ปริมาณฝนสะสม ตั้งแต่ ณ วัน-เวลา ล่วงหน้าไป 48 ชั่วโมง จากวัน –เวลา ที่จัดทำรายงานนี้</li>
		<li>คาดการณ์ฝนสะสม ล่วงหน้า 3 วัน หมายถึง ปริมาณฝนสะสม ตั้งแต่ ณ วัน-เวลา ล่วงหน้าไป 72 ชั่วโมง จากวัน –เวลา ที่จัดทำรายงานนี้</li>
	</ol>
</div>


<!-- page 3 -->
<div class="paper shadow center">
	<h3 class="center">แผนที่แสดงตำแหน่งที่ตั้งสถานีโทรมาตร<?php echo $_cfg_name ?> และปริมาณฝนสะสม</h3>
	<div class="box_rain">
	<?php
	$row = 1;
	if ( ($f = fopen($_cfg_path_today."table3.csv", "r")) !== FALSE ) 
	{
		while ( ($data = fgetcsv($f, 1000, ",")) !== FALSE )
		{		
			if ( $row > 3 )
			{
				$cls = str_replace(".", "", $data[7]);
				//echo $data[3]."/ ".$data[6]."/ ".$data[7]."<br>";
				echo "<span class=\"abs ".$cls."\">".$data[3]."/ ".$data[6]."</span>";
			}
			$row++;
		}
		fclose($f);
	}
	?>
	</div>
</div>


<!-- page 4 -->
<div class="paper shadow">
	<h4>3. สภาพน้ำท่า</h4>
	<br>
	<table width="100%" class="tb_report fs_small">
		<caption>สภาพน้ำท่าตรวจวัด ณ <?php echo $datethai ?></caption>
		<thead class="bc_fade">
			<tr>
				<th rowspan="2">แม่น้ำ</th>
				<th rowspan="2">สถานี</th>
				<th rowspan="2">ระดับเตือนภัย<br/>(ม.รทก)</th>
				<th rowspan="2">ความจุ<br/>(ม.<sup>3</sup>/วินาที)</th>
				<th rowspan="2">ระดับน้ำ<br/>(ม.รทก)</th>
				<th colspan="2">ปริมาณน้ำ (ม.<sup>3</sup>/วินาที)</th>
				<th rowspan="2">ต่ำ (-) สูง (+)<br/>กว่าระดับเตือนภัย</th>
				<th rowspan="2">อยู่ใน<br/>เกณฑ์</th>
				<th rowspan="2">แนวโน้ม</th>
			</tr>
			<tr>
				<th>วันนี้</th>
				<th>เมื่อวาน</th>
			</tr>
		</thead>
		<tbody>
		<?php $_call->data_csv($_cfg_path_today."table4.csv", 4) ?>
		</tbody>
	</table>
	<br><br>
	<table width="100%" class="tb_report fs_small">
		<caption>ระดับน้ำคาดการณ์ ณ <?php echo $datethai ?></caption>
		<thead class="bc_fade">
			<tr>
				<th rowspan="2">แม่น้ำ</th>
				<th rowspan="2">สถานี</th>
				<th rowspan="2">ระดับเตือนภัย<br/>(ม.รทก)</th>
				<th colspan="4">ระดับน้ำ (ม.รทก)</th>
				<th rowspan="2">ต่ำ (-) สูง (+)<br/>กว่าระดับเตือนภัย</th>
				<th rowspan="2">อยู่ใน<br/>เกณฑ์</th>
				<th rowspan="2">แนวโน้ม</th>
			</tr>
			<tr>
				<th>1 วัน</th>
				<th>3 วัน</th>
				<th>5 วัน</th>
				<th>7 วัน</th>
			</tr>
		</thead>
		<tbody>
		<?php $_call->data_csv($_cfg_path_today."table5.csv", 4) ?>
		</tbody>
	</table>
	<br>
	<ol class="fs_small">
		<h5>คำอธิบาย</h5>
		<li>ระดับเตือนภัย หมายถึง ระดับน้ำที่เริ่มทำให้เกิดน้ำท่วม</li>
		<li>วันนี้ หมายถึง ข้อมูล ณ วัน-เวลา ที่จัดทำรายงานนี้</li>
		<li>เมื่อวาน หมายถึง ข้อมูล ณ วัน-เวลา ย้อนหลังไป 24 ชั่วโมง จากวัน –เวลา ที่จัดทำรายงานนี้</li>
		<li>ต่ำ/สูงกว่าระดับเตือนภัย หมายถึง ความลึกน้ำ (เมตร) ของระดับน้ำ ณ วัน-เวลา ที่จัดทำรายนี้เทียบกับระดับเตือนภัย</li>
		<li>เกณฑ์ปกติ หมายถึง ระดับน้ำ ณ วัน-เวลา ที่จัดทำรายงาน ต่ำกว่าระดับเตือนภัยมากกว่า 1.5 เมตร</li>
		<li>เกณฑ์เฝ้าระวัง หมายถึง ระดับน้ำ ณ วัน-เวลา ที่จัดทำรายงาน ต่ำกว่าระดับเตือนภัยในช่วง 0-1.5 เมตร</li>
		<li>เกณฑ์เตือนภัย หมายถึง ระดับน้ำ ณ วัน-เวลา ที่จัดทำรายงาน เท่ากับหรือมากกว่าระดับเตือนภัย</li>
	</ol>
</div>


<!-- page 5 -->
<div class="paper shadow">
	<h4>4. คาดการณ์พื้นที่น้ำท่วมสูงสุด</h4>
	<div class="center clearfix">
		<img src="<?php echo $_cfg_path_today."flood.jpg" ?>">
	</div>
</div>


<!-- page 6 -->
<div class="paper shadow center">
	<h3>ผังสถานการณ์น้ำในลุ่มน้ำ<?php echo $_cfg_name ?></h3>
	<small><?php echo $datethai ?></small>
	<div class="box_river">
	<?php
	foreach ( $_call->get_stn() as $value )
	{
		if ( $value['wl'] == 1 AND $value['id'] != "Tpat.26" )
		{
			$arr = explode('.', $value['id']);
			$n = $arr[1];
			//$_call->data_table($file4);
			$val = $_call->get_values_time($value['id'], $datetime);
			$ic_wl = "ta_".$_call->alarmCheck($val['wl'], $value['wl1'], $value['wl2'], 0);

			echo '<table border="1" class="tb_box fs_small t'.$n.'">';
			echo '<tr class="fc_pri"><td>ระดับน้ำ</td><td>'.$val['wl'].'</td><td>ม.รทก.</td></tr>';
			echo '<tr class="fc_pri"><td>สูง/ต่ำ กว่าระดับเตือนภัย</td><td>'.($val['diff']).'</td><td>เมตร</td></tr>';
			
			if ( !in_array($value['id'], $_cfg_flow) )
			{
				echo '<tr class="fc_warn"><td>อัตราการไหล</td><td>'.$val['q'].'</td><td>ม.<sup>3</sup>/วินาที</td></tr>';
				echo '<tr class="fc_warn"><td>ความจุลำน้ำ</td><td>'.$val['a'].'</td><td>%</td></tr>';
			}

			echo '</table>';
			echo '<div class="i'.$n.'" style="position:absolute; text-align:center"><div class="icon '.$ic_wl.'"></div><br> '.$value['code'].'</div>';
			echo "\n";
		
		}
	}
	?>
	</div>
</div>


<!-- page 7 -->
<div class="paper shadow center">
	<h3>สรุปรายงานการเตือนภัยและสถานการณ์น้ำในลุ่มน้ำ<?php echo $_cfg_name ?></h3>
	<small><?php echo $datethai ?></small>
	<div class="left fs_small"><?php $_call->data_txt($_cfg_path_today."table6.txt") ?></div>
</div>


<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['script'] ?>jquery-1.10.2.min.js"></SCRIPT>

<link href="http://203.185.128.79/trang/js/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="http://203.185.128.79/trang/js/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="http://203.185.128.79/trang/js/jquery-ui.js"></script>
<script src="http://203.185.128.79/trang/js/jquery-ui-timepicker-addon.js"></script>
<script src="http://203.185.128.79/trang/js/jquery-ui-timepicker-th.js"></script>

<script type="text/javascript">
$(document).ready
(
	function()
	{
		var my_date = new Date ();
		console.log('begin');
		console.log('clear data');
		$("#dtm").timepicker
		(
			$.extend
			(
				{
					timeFormat: 'HH:00',
					hourMax: my_date.getHours ()
				},
				$.datepicker.regional['th']
			)
		);

	}
);
</script>
</BODY>
</HTML>