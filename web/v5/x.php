<?php
@include('data/config.php');
@include($_cfg_path['class'].'index.php');

$_call = new Tele($_cfg_tb, $_cfg_conn);
$_id = ( empty($_GET['id']) ) ? null : $_GET['id'];
$_file = $_cfg_path['page']."page-".$_GET['page'].".php";
$_title = ( !empty($_GET['view']) ) ? " <SPAN CLASS=\"fs_big\">/ ".$_cfg_menu_sub[$_GET['page']][$_GET['view']]['title']."</SPAN>" : null;
$_title = $_cfg_menu_main[$_GET['page']]['title'].$_title;
$_stn = $_call->get_stn($_id);
$_refresh = '<META HTTP-EQUIV="refresh" CONTENT="2; URL=./?page='.$_GET['page'].'&view='.$_GET['view'].'">';

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
		<LINK HREF="<?php echo $_cfg_path['css'] ?>reset.css" REL="stylesheet" TYPE="text/css" />
		<LINK HREF="<?php echo $_cfg_path['css'] ?>style.css?v=150202" REL="stylesheet" TYPE="text/css" />
		<LINK HREF="<?php echo $_cfg_path['data'] ?>color.css" REL="stylesheet" TYPE="text/css" />
		<LINK TYPE="text/css" REL="stylesheet" HREF="<?php echo $_cfg_path['css'] ?>map.css" />
		<SCRIPT SRC="<?php echo $_cfg_path['script'] ?>jquery-1.11.2.min.js"></SCRIPT>
	</HEAD>

	<BODY>
		
		<!-- header -->
		<DIV ID="header"><IMG SRC="<?php echo $_cfg_path['img'] ?>logo.png" WIDTH="960" ALT="<?php $_cfg_name ?>"></DIV>
		
		<!-- body -->
		<DIV CLASS="body">
	

			<DIV CLASS="content">
				<DIV CLASS="title dc_pri">
					<H2 CLASS="fc_pri"><?php echo $_title ?></H2>
				</DIV>
				<DIV ID="map"><?php echo $_cfg_txt_load ?></DIV>
				<DIV ID="guide">
					<H4>ข้อมูลภูมิศาสตร์</H4>
					<UL ID="layers"></UL>
					<INPUT TYPE="hidden" ID="path" VALUE="<?php echo $_cfg_root.$_cfg_path['sys'] ?>map/" />
					<INPUT TYPE="hidden" ID="path-img" VALUE="<?php echo $_cfg_root.$_cfg_path['img'] ?>" />
					<INPUT TYPE="hidden" ID="path-zone" VALUE="<?php echo $_cfg_map ?>" />
					<HR>
					<div id="echo"></div>
				</DIV>
			</DIV>

		</DIV><!-- end body -->

		<SCRIPT TYPE="text/javascript" SRC="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=th-TH"></SCRIPT> 
		<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['sys'] ?>map/markerwithlabel.js"></SCRIPT>
		<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['sys'] ?>map/xmap.js"></SCRIPT>
		<SCRIPT TYPE="text/javascript">
		$(document).ready
		(
			function()
			{
				googleMap();

				$('#echo').append(
					$('#path').val() + '<br>' +
					$('#path-img').val() + '<br>' +
					$('#path-zone').val() + '<br>'
				);
			}
		);
		</SCRIPT>

	</BODY>
</HTML>