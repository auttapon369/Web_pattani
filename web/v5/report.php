<?php
ob_start();
session_start();
set_time_limit(0);

if ( empty($_POST['stn']) )
{ 
	header('location:./?page=search');
}

@include('data/config.php');
@include($_cfg_path['class'].'index.php');

$conn = connDB("odbc");
$_call = new Tele($_cfg_tb, $_cfg_conn);
$p_stn = $_POST['stn'];
$p_rain = $_POST['s_rain'];	
$p_water = $_POST['s_water'];
$p_flow = $_POST['s_flow'];
$p_day1 = date("Y-m-d",strtotime($_POST['date1']));
$p_day2 = date("Y-m-d",strtotime($_POST['date2']));
$p_format = $_POST['format'];
$name_report = "<H3>".$_cfg_report_h_1."</H3>".$_call->dateReport($p_day1, $p_day2);
$num = count($p_stn);


/*echo "<pre>";
var_dump($p_stn);
echo "</pre>";
echo $p_rain."<BR>".$p_water."<BR>".$p_flow."<BR>".$p_day1."<BR>".$p_day2."<BR>".$p_format;
*/

//exit();
//$sta = explode("-", $p_stn);
//$ssite=$sta[0];

//$mi="-1"; // เริ่ม 00
$mi="-421"; // เริ่ม 07

function numm($n)
{
	if($n=="")
	{
		$s="-";
	}
	else
	{
		$s=number_format($n,2);
	}
	return $s;
}
function addValue($value,$cp)
{
	if($cp=="0")
	{
		$x = numm($value);
	}
	else
	{
		$x = "";
	}
	return $x;
}

function C_rf($check,$p_rain)
{
	if($check=="0")
	{
		$x = "no";
	}
	else
	{
		if($p_rain=="Y")
		{
			$x = "show";
		}
		else
		{ $x = "no"; }
	}
	return $x;
}
function C_wl($check,$p_water)
{
	if($check=="0")
	{
		$x = "no";
	}
	else
	{
		if($p_water=="Y")
		{
			$x = "show";
		}
		else
		{ $x = "no"; }
	}
	return $x;
}
function C_wle($check,$p_water,$wl_e)
{
	if($wl_e=="Y")
	{
		if($p_water=="Y")
		{
			$x = "show";
		}
		else
		{ $x = "no"; }
	}
	else
	{
		$x = "no";
	}
	return $x;
}
function C_fl($check,$p_flow)
{
	if($check=="0")
	{
		$x = "no";
	}
	else
	{
		if($p_flow=="Y")
		{
			$x = "show";
		}
		else
		{ $x = "no"; }
	}
	return $x;
}

function C_fle($check,$p_flow,$wl_e)
{
	if($wl_e=="Y")
	{
		if($p_flow=="Y")
		{
			$x = "show";
		}
		else
		{ $x = "no"; }
	}
	else
	{
		$x = "no";
	}
	return $x;
}

/*$rf=C_rf($ssite,$p_rain);
$wl=C_wl($ssite,$p_water);
$wle=C_wle($ssite,$p_water);
$fl=C_fl($ssite,$p_flow);
$fle=C_fle($ssite,$p_flow);*/


function cut($id)
{
	$sta = explode("_", $id);
	$ss[0]=$sta[0];

	//rf
	$ss[1]=$sta[2];

	//wl
	$ss[2]=$sta[3];

	//fl
	$ss[3]=$sta[4];

	$ns = explode(".", $ss[0]);
	$ss[4]=$ns[0].$ns[1];

	//wl_end
	$ss[5]=$sta[5];

	//codenamenew
	$ss[6]=$sta[1];

	return $ss;
}

if($p_stn=="")
{
	echo "กรุณาเลือกสถานี";
}
else
{

	foreach($p_stn as $id)
	{
		//echo $id;
		$_value = cut($id);
		$ssite = $_value[0];
		$rf=$_value[1];
		$wl=$_value[2];
		$fl=$_value[3];
		$wl_end=$_value[5];

		if($rf == "1") 
		{  
			$nrf += 1;  
		} 
		if($wl == "1") 
		{  
			$nwl += 1;  
		} 
		if($wl == "1" && ( !in_array($ssite, $_cfg_flow))) 
		{  
			$nfl += 1;  
		} 	
		
		if($wl_end=="Y")
		{
			$nwle+= 1; 
			$cwle="Y";
		}
	}

	 //echo "nfl= ".$nfl."<BR>";
	//echo "nrf= ".$nrf."<BR>";
	//echo "nwl= ".$nwl."<BR>";
	//echo "wl_end= ".$nwle."<BR>";
}
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
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['script'] ?>jquery-1.10.2.min.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['sys'] ?>stats/chart/highstock.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['sys'] ?>stats/chart/exporting.js"></SCRIPT>
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
	<H3 CLASS="fc_pri"><?php echo $_cfg_report_head ?></H3>
	<Q><?php echo $_call->dateReport($p_day1, $p_day2) ?></Q>
	<BR><BR>
	<?php
	if ( !empty($_GET['view']) )
	{
		$view = $_cfg_path['sys']."stats/".$_GET['view'].".php";
			
		if ( file_exists($view) )
		{
			include($view);
		}
		else
		{
			echo $_cfg_error_page;
		}
	}
	?>
	<BR><BR><BR><BR>
</BODY>
</HTML>