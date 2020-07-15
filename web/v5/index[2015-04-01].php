<?php
//ob_start();
session_start();

if ( empty($_GET['page']) )
{
	header('location:./?page=map');
}

@include('data/config.php');
@include($_cfg_path['class'].'index.php');
@include($_cfg_path['script'].'browser.php');

$_call = new Tele($_cfg_tb, $_cfg_conn);
$_id = ( empty($_GET['id']) ) ? null : $_GET['id'];
$_file = $_cfg_path['page']."page-".$_GET['page'].".php";
$_title = ( !empty($_GET['view']) ) ? " <SPAN CLASS=\"fs_big\">/ ".$_cfg_menu_sub[$_GET['page']][$_GET['view']]['title']."</SPAN>" : null;
$_title = $_cfg_menu_main[$_GET['page']]['title'].$_title;
$_stn = $_call->get_stn($_id);
$_refresh = '<META HTTP-EQUIV="refresh" CONTENT="2; URL=./?page='.$_GET['page'].'&view='.$_GET['view'].'">';

//echo "<pre>";
//var_dump($_stn);
//echo "</pre>";
?>
<!DOCTYPE HTML>
<HTML LANG="th-TH">
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<META NAME="author" CONTENT="Expert Engineering & Com." />
<META NAME="keywords" CONTENT="<?php echo $_cfg_key ?>" />
<META NAME="description" CONTENT="<?php echo $_cfg_desc ?>" />
<META NAME="robots" CONTENT="all" />
<META NAME="copyright" CONTENT="Expert Engineering & Com." />
<LINK HREF="<?php echo $_cfg_root.$_cfg_path['img'] ?>favicon.ico" REL="shortcut icon" />
<LINK HREF="<?php echo $_cfg_root.$_cfg_path['img'] ?>apple-touch-icon.png" REL="apple-touch-icon" />
<link href="<?php echo $_cfg_root.$_cfg_path['css'] ?>reset.css" REL="stylesheet" TYPE="text/css" />
<link href="<?php echo $_cfg_root.$_cfg_path['css'] ?>style.css?v=150202" REL="stylesheet" TYPE="text/css" />
<link href="<?php echo $_cfg_root.$_cfg_path['data'] ?>color.css" REL="stylesheet" TYPE="text/css" />
<!--<script src="http://code.jquery.com/jquery-2.1.3.min.js" TYPE="text/javascript"></script>-->
<script src="<?php echo $_cfg_root.$_cfg_path['script'] ?>jquery-1.11.2.min.js"></script>
<title><?php echo $_cfg_title ?></title>
</head>

<BODY>
<DIV ID="header" CLASS="bc_gray"><IMG SRC="<?php echo $_cfg_path['img'] ?>logo.png" WIDTH="914" ALT="<?php $_cfg_name ?>"></DIV>
<DIV CLASS="body">
	
	<!-- sidebar -->
	<DIV CLASS="side-bar">
		
		<!-- time -->
		<DIV ID="timer" CLASS="bc_black fc_white fs_small"><?php echo $_call->date_thai(date('Y-m-d H:i')) ?></DIV>

		<!-- menu -->
		<DIV ID="nav" CLASS="bc_white dc_fade shadow"><?php @include($_cfg_path['script'].'menu.php') ?></DIV>
		
		<!-- xml -->
		<INPUT TYPE="hidden" ID="path-xml" VALUE="<?php echo $_cfg_path['sys']."xml/weather.php" ?>">
		<DIV ID="xml" CLASS="bc_white shadow" STYLE="display:none"><?php echo $_cfg_txt_load ?></DIV>

	</DIV>


	<!-- content -->
	<DIV CLASS="content">
		<DIV CLASS="title dc_pri">
			<H2 CLASS="fc_pri"><?php echo $_title ?></H2>
		</DIV>
		<?php
		if ( !empty($_GET['page']) )
		{
			if ( file_exists($_file) )
			{
				include($_file);
			}
			else
			{
				echo $_cfg_txt_error;
			}
		}
		?>
	</DIV>
</DIV>

<!-- footer -->
<DIV ID="footer" CLASS="bc_fade">
	<!--
	<A HREF="http://www.tmd.go.th/weather_map.php" TARGET="_blank"><IMG SRC="<?php //echo $_cfg_path['img'] ?>banner/banner01.gif" WIDTH="130" ALT="TMD"></A>
	<A HREF="http://wx.hamweather.com/?country=th&state=&place=trang&from=wxdir" TARGET="_blank"><IMG SRC="<?php //echo $_cfg_path['img'] ?>banner/banner02.gif" WIDTH="130" ALT="HAM"></A>
	<A HREF="http://water.rid.go.th/" TARGET="_blank"><IMG SRC="<?php //echo $_cfg_path['img'] ?>banner/banner03.gif" WIDTH="130" ALT="WATER"></A>
	<A HREF="http://hydro-8.com/" TARGET="_blank"><IMG SRC="<?php //echo $_cfg_path['img'] ?>banner/banner04.gif" WIDTH="130" ALT="HYDROLOGY"></A>
	<A HREF="http://irrigation.rid.go.th/rid16/web2012/" TARGET="_blank"><IMG SRC="<?php //echo $_cfg_path['img'] ?>banner/banner05.gif" WIDTH="130" ALT="RI16"></A>
	<A HREF="http://ridceo.rid.go.th/trang/" TARGET="_blank"><IMG SRC="<?php //echo $_cfg_path['img'] ?>banner/banner06.gif" WIDTH="130" ALT="TRANG"></A>
	-->
	<?php
	for ( $i = 0; $i < count($_cfg_link); $i++ )
	{
		$s = ( $i == 0 ) ? "" : " | ";
		echo $s."<A HREF=\"".$_cfg_link[$i]['link']."\" TARGET=\"_blank\">".$_cfg_link[$i]['name']."</A>";
	}
	?>
	<SPAN><?php echo $_cfg_footer ?></SPAN>
</DIV>

<SCRIPT TYPE="text/javascript">
$(document).ready
(
	function()
	{
		if ( location.href.split("page=")[1].split("&")[0] == "map" )
		{
			$('#xml').show();
			$('#xml').load($('#path-xml').val());
		}
	}
);
</SCRIPT>
</BODY>
</HTML>