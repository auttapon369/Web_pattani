<?
include('config.php');
$cssTH = "
	background-color:#97cbde !important;
";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
<ul id="content_menu">
	<!-- <li class="stn <? echo $sl_stnedit; ?>"><a href="index.php?menu=stnedit" class="menu_top">ข้อมูลสถานี</a></li>
	<li class="save <? echo $sl_station; ?>"><a href="index.php?menu=Psensor" class="menu_top">บันทึกข้อมูล</a></li> 
	<li class="stn <? echo $sl_alarmedit; ?>"><a href="index.php?menu=alarmedit" class="menu_top">ข้อมูลการเตือนภัย</a></li>  -->
</ul>
<div id="content">
<? 
if($_REQUEST['view']=="editalarm")
{
	if($_REQUEST[Submit])
	{ 
		include("editalarm_editdataupdate.php");
	}
	else
	{ 
		include("editalarm_editdata.php");
	}	
}
else
{
	include("editalarm.php");
}
?>
</div>
</body>
</html>