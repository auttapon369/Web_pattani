<?php
include('../../../data/config.php');
include('../../class/index.php');

$_call = new Tele($_cfg_tb, $_cfg_conn);
$_cctv = new Imgs($_cfg_cctv);

if ( !empty($_POST) AND $_POST['p_stn'] != "0" )
{
	$img = $_cctv->img_ftp($_POST['p_stn'], date('Y-m-d', strtotime($_POST['p_date'])), $_POST['p_time']);
	
	echo "<UL>";

	for ( $i =0; $i < count($img); $i++ )
	{
		echo "<LI CLASS=\"bc_fade\">";
		echo "<A CLASS=\"fancybox\" REL=\"gallery1\" HREF=\"".$img[$i]['path'].$img[$i]['img']."\"><IMG SRC=\"".$img[$i]['path']."_".$img[$i]['img']."\" ALT=\"Photo Loading...\" /></A>";
		echo "<SPAN CLASS=\"num bc_black fc_white fs_small\">".$img[$i]['num']."</SPAN>";
		echo "<SPAN CLASS=\"time bc_black fc_white fs_small\">".$img[$i]['time']."</SPAN>";
		echo "</LI>";
	}

	echo "</UL>";
}
/*
else
{
	$_stn = $_call->get_stn();

	echo "<UL>";

	for ( $i = 0; $i < count($_stn); $i++ )
	{
		if ( $_stn[$i]['wl'] == 1 )
		{
			$val = $_call->get_values($_stn[$i]['id']);
			//$local = "../../../../../img/cctv/".$_stn[$i]['id'];
			$local = "../../img/cctv/".$_stn[$i]['id'];
			$txt = ( $_stn[$i]['end'] == "Y" ) ? "หน้า" : null;
			$path = ( $_stn[$i]['end'] == "Y" ) ? $local."_UP/" : $local."/";
			$note = ( $_stn[$i]['end'] == "Y" ) ? "<SPAN CLASS=\"ms fc_white\">".$txt." ปตร.</SPAN>" : null;
			$double = ( $_stn[$i]['end'] == "Y" ) ? 2 : 1;

			for ( $a = 0; $a < $double; $a++ )
			{
				$wl = ( $a > 0 ) ? "wle" : "wl";
				$fl = ( $a > 0 ) ? "fle" : "fl";
				$txt = ( $a > 0 ) ? "ท้าย" : $txt;
				$time = $_call->date_thai($val['date']);
				$title = "<B>".$_stn[$i]['code']." ".$txt."".$_stn[$i]['name']."</B> ".$_stn[$i]['detail']."<BR>".$time." ระดับน้ำ ".$val[$wl]." ม.รทก. อัตราการไหล ".$val[$fl]." ลบ.ม./วินาที";
				$note = ( $a > 0 ) ? "<SPAN CLASS=\"ms fc_white\">".$txt." ปตร.</SPAN>" : $note;
				$path = ( $a > 0 ) ? $local."_DOWN/" : $path;
				$img = $_cctv->get_cctv($path);

				echo "<LI CLASS=\"bc_fade ".$img['alarm']."\">";
				echo "<A ID=\"id".$_stn[$i]['id']."\" CLASS=\"fancybox\" REL=\"gallery1\" HREF=\"".$img['img']."\" TITLE=\"".$title."\"><IMG SRC=\"".$img['img']."\" /></A>";
				echo "<SPAN CLASS=\"title bc_black fc_white\"><B>".$_stn[$i]['code']."</B> ".$_stn[$i]['name']."<Q CLASS=\"fs_small\">".$_stn[$i]['detail']."</Q></SPAN>";
				echo "<SPAN CLASS=\"time fc_white fs_small\">".$_call->date_simple($img['time'])." น.</SPAN>";
				echo $note;
				echo "</LI>";
			}
		}
	}

	echo "</UL>";
}
*/
?>
<SCRIPT TYPE="text/javascript">
$(document).ready
(
	function()
	{
		/*$(".fancybox").fancybox
		(
			{
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers :
				{
					title :
					{
						type : 'inside'
					},
					overlay :
					{
						css :
						{
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			}
		);*/
	}
);
</SCRIPT>