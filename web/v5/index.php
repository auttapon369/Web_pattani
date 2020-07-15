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
		<LINK HREF="<?php echo $_cfg_path['img'] ?>favicon.ico" REL="shortcut icon" />
		<LINK HREF="<?php echo $_cfg_path['img'] ?>apple-touch-icon.png" REL="apple-touch-icon" />
		<LINK HREF="<?php echo $_cfg_path['css'] ?>reset.css" REL="stylesheet" TYPE="text/css" />
		<LINK HREF="<?php echo $_cfg_path['css'] ?>style.css?v=150202" REL="stylesheet" TYPE="text/css" />
		<LINK HREF="<?php echo $_cfg_path['data'] ?>color.css" REL="stylesheet" TYPE="text/css" />
		<SCRIPT SRC="<?php echo $_cfg_path['script'] ?>jquery-1.11.2.min.js"></SCRIPT>
		<TITLE><?php echo $_cfg_title ?></TITLE>
	</HEAD>

	<BODY>
		
		<!-- header -->
		<DIV ID="header"><IMG SRC="<?php echo $_cfg_path['img'] ?>logo.png" WIDTH="960" ALT="<?php $_cfg_name ?>"></DIV>
		
		<!-- body -->
		<DIV CLASS="body">
	
			<DIV CLASS="side-bar">
				<DIV ID="timer" CLASS="bc_black fc_white fs_small"><?php echo $_call->date_thai(date('Y-m-d H:i')) ?></DIV>
				<DIV ID="nav" CLASS="bc_white dc_fade shadow"><?php @include($_cfg_path['script'].'menu.php') ?></DIV>
				<DIV ID="xml" CLASS="bc_white shadow" STYLE="display:none">
				<?php
				foreach ( $_cfg_xml as $xml )
				{
					//$_call->data_xml($xml[0]);
				}
				?>
				</DIV>
			</DIV>

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

		</DIV><!-- end body -->

		<!-- footer -->
		<DIV ID="footer" CLASS="bc_fade">
		<?php
		for ( $i = 0; $i < count($_cfg_link); $i++ )
		{
			$s = ( $i == 0 ) ? "" : " | ";
			echo $s."<A HREF=\"".$_cfg_link[$i]['link']."\" TARGET=\"_blank\">".$_cfg_link[$i]['name']."</A>";
		}
		?>
		<SMALL><?php echo $_cfg_footer ?></SMALL>
		</DIV>

		<SCRIPT TYPE="text/javascript">
		$(document).ready
		(
			function()
			{
				if ( location.href.split("page=")[1].split("&")[0] == "map" )
				{
					$('#xml').show();
				}
			}
		);
		</SCRIPT>

	</BODY>
</HTML>