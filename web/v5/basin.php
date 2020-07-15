<?php
@include('data/config.php');
@include($_cfg_path['class'].'index.php');
$_call = new Tele($_cfg_tb, $_cfg_conn);
$date = date('Y-m-d H:')."00";
$datethai = $_call->date_thai($date);
$d = explode('-', str_replace(' ', '-', $date));
$t = explode(':', $d[3]);
//$path = $_cfg_path['data']."temp/".$d[0]."/".(int)$d[1]."/".(int)$d[2]."/".(int)$t[0]."/table6.txt";
$path = $_cfg_path['data']."temp/2015/4/7/14/table6.txt";
?>
<!DOCTYPE HTML>
<HTML LANG="th-TH">
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<LINK HREF="<?php echo $_cfg_path['img'] ?>favicon.ico" REL="shortcut icon" />
<LINK HREF="<?php echo $_cfg_path['img'] ?>apple-touch-icon.png" REL="apple-touch-icon" />
<LINK HREF="<?php echo $_cfg_path['css'] ?>reset.css" REL="stylesheet" TYPE="text/css" />
<LINK HREF="<?php echo $_cfg_path['css'] ?>style.css" REL="stylesheet" TYPE="text/css" />
<LINK HREF="<?php echo $_cfg_path['data'] ?>color.css" REL="stylesheet" TYPE="text/css" />
<TITLE><?php echo $_cfg_title ?></TITLE>
</HEAD>
<BODY CLASS="body-report">
	<div class="head">
		<img src="<?php echo $_cfg_path['img'] ?>icon.png" width="100" alt="กรมชลประทาน">
		<br>
		<h5 class="nowrap"><?php echo $_cfg_desc ?></h5>
		<small><?php echo $_cfg_footer ?></small>
		<hr>
	</div>
	<H3 CLASS="fc_pri">สรุปรายงานการเตือนภัยและสถานการณ์น้ำในลุ่มน้ำ<?php echo $_cfg_name ?></H3>
	<Q><?php echo $datethai ?></Q>
	<BR><BR>
	<div class="frame"><?php $_call->data_txt($path) ?></div>
	<BR><BR>
</BODY>
</HTML>