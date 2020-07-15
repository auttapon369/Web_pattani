<?php
/*
if ( $_GET['view'] == "station" )
{

}
else if ( $_GET['view'] == "alarm" )
{
	if ( file_exists($_cfg_path['sys']."stats/live.php") )
	{
		include($_cfg_path['sys']."stats/live.php");
	}
	else
	{
		echo $_cfg_txt_error;
	}
}
else
{
	echo $_cfg_txt_error;
}
*/
$conn = connDB("odbc");
$file = $_cfg_path['sys']."panel/".$_GET['view'].".php";

if ( file_exists($file) )
{
	include($file);
}
else
{
	echo $_cfg_txt_error;
}

function numa($value)
{
	$aa = $value;

	if ( $aa == "" )
	{
		$aa = ""; 
	}
	else
	{ 
		$aa = number_format($aa, 2, '.', '');
	}

	return $aa;
}
?>
<LINK HREF="<?php echo $_cfg_root.$_cfg_path['script'] ?>tcal/tcal.css" REL="stylesheet" TYPE="text/css" />
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_root.$_cfg_path['script'] ?>tcal/tcal.js"></SCRIPT>
<SCRIPT TYPE="text/javascript">
$(document).ready
(		
	function()
	{
		var x = new Date();
		var d = x.getDate();
		var m = x.getMonth();
		var y = x.getFullYear();
		
		$('#inp_day').prop('selectedIndex',d-1);
		$('#inp_month').prop('selectedIndex',m);
		$('#inp_year').val(y);
	}
);
function confirmation()
{
	var answer = confirm("คุณต้องการบันทึกข้อมูลนี้ใช่หรือไม่?");
	if (answer)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</SCRIPT> 