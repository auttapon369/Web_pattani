<DIV CLASS="filter dc_gray">
	<TABLE>
		<TR>
			<TD>
				<LABEL CLASS="fc_sec fs_small"><?php echo $_cfg_label['stn'] ?></LABEL>
				<SELECT ID="inp_stn" CLASS="bc_fade"><?php $_call->get_stn_list('option', $_cfg_block_cctv) ?></SELECT>
			</TD>
			<TD STYLE="display:none" CLASS="hide">					
				<LABEL CLASS="fc_sec fs_small"><?php echo $_cfg_label['date'] ?></LABEL>
				<INPUT ID="inp_date" TYPE="text" CLASS="tcal" VALUE="<?php echo date('d-m-Y') ?>" READONLY />
			</TD>
			<TD STYLE="display:none" CLASS="hide">
				<LABEL CLASS="fc_sec fs_small"><?php echo $_cfg_label['time'] ?></LABEL>
				<SELECT ID="inp_time" CLASS="bc_fade">
				<?php
				foreach ( $_cfg_select['time'] as $array )
				{
					echo "<OPTION VALUE=\"".$array[0]."\" ".$array[2].">".$array[1]."</OPTION>\n";
				}
				?>
				</SELECT>
			</TD>
			<TD>
				<LABEL CLASS="fs_small">&nbsp;</LABEL>
				<BUTTON ID="search" CLASS="button bc_sec fc_white"><?php echo $_cfg_btn['search'] ?></BUTTON>
			</TD>
		</TR>
	</TABLE>
</DIV>
<DIV ID="cctv">
	<UL>
	<?php
	$_cctv = new Imgs($_cfg_cctv);

	for ( $i = 0; $i < count($_stn); $i++ )
	{
			if ( $_stn[$i]['wl'] == 1 && !in_array($_stn[$i]['id'], $_cfg_block_cctv) )
			{
				$val = $_call->get_values($_stn[$i]['id']);
				$n = explode(".", $_stn[$i]['id']);
				$n = $n[1];
				$pop = ( $_stn[$i]['end'] == "Y" ) ? $n."_UP" : $n;
				$path = ( $_stn[$i]['end'] == "Y" ) ? "_UP" : null;
				$note = ( $_stn[$i]['end'] == "Y" ) ? "<SPAN CLASS=\"ms fc_white\">หน้า ปตร.</SPAN>" : null;
				$double = ( $_stn[$i]['end'] == "Y" ) ? 2 : 1;

				for ( $a = 0; $a < $double; $a++ )
				{
					$pop = ( $a > 0 ) ? $n."_DOWN" : $pop;
					$wl = ( $a > 0 ) ? "wle" : "wl";
					$fl = ( $a > 0 ) ? "fle" : "fl";
					$time = $_call->date_thai($val['date']);
					$note = ( $a > 0 ) ? "<SPAN CLASS=\"ms fc_white\">ท้าย ปตร.</SPAN>" : $note;
					$title = "<B>".$_stn[$i]['code']." ".$txt."".$_stn[$i]['name']."</B>";
					$info = $_stn[$i]['detail']."<BR>".$time." ระดับน้ำ ".$val[$wl]." ม.รทก";
					$info = ( !in_array($_stn[$i]['id'], $_cfg_flow) ) ? $info." อัตราการไหล ".$val[$fl]." ลบ.ม./วินาที" : $info;
					$path = ( $a > 0 ) ? "_DOWN" : $path;
					//$img = $_cfg_path['script']."img.php?id=".$_stn[$i]['id'].$path;
					$local = "../../img/cctv/".$_stn[$i]['id'].$path."/";
					$img = $_cctv->img_scan($local);
					$desc = $_cctv->img_details($img);
					$img = str_replace('../..','',$img);

					echo "<LI CLASS=\"bc_fade ".$desc['color']."\">";

					echo "<A ID=\"id".$pop."\" CLASS=\"fancybox\" HREF=\"".$img."\" TITLE=\"".$title." ".$info."\"><IMG SRC=\"".$img."\" /></A>";
		
					echo "<SPAN CLASS=\"title bc_black fc_white\">".$title."<Q CLASS=\"fs_small\">".$_stn[$i]['detail']."</Q></SPAN>";
					
					echo "<SPAN CLASS=\"time fc_white fs_small\">".$_call->date_simple($desc['time'])." น.</SPAN>";
					
					echo $note;

					echo "</LI>";
				}
			}
	}
	?>
	</UL>
</DIV>
<INPUT TYPE="hidden" ID="path" VALUE="<?php echo $_cfg_path['sys'] ?>cctv/index.php" />
<LINK HREF="<?php echo $_cfg_path['script'] ?>fancybox/source/jquery.fancybox.css" REL="stylesheet" TYPE="text/css" />
<LINK HREF="<?php echo $_cfg_path['script'] ?>tcal/tcal.css" REL="stylesheet" TYPE="text/css" />
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['script'] ?>fancybox/source/jquery.fancybox.js?v=2.1.5"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="<?php echo $_cfg_path['script'] ?>tcal/tcal.js"></script>
<SCRIPT TYPE="text/javascript">
$(document).ready
(		
	function()
	{	
		// default
		$("#inp_stn").prop('selectedIndex', 0);
		//$('#cctv').load($('#path').val());

		// search
		$('#search').click
		(
			function()
			{	
				if ( $("#inp_stn").val() == 0 )
				{
					//alert('reset');
					window.location.replace("./?page=cctv");
				}
				else
				{	
					$('#cctv').html('');
					$("#cctv").append("<div class='loader'></div>");
					loadCCTV();
				}
			}
		);

		// change
		$('#inp_stn').change
		(
			function()
			{	
				change();
			}
		);

		// fancy
		$(".fancybox").fancybox
		(
			{
				helpers	:
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
				},
				fitToView	: true,
				maxWidth	: 720,
				maxHeight	: 600,
				width			: '60%',
				height		: '60%',
				closeClick	: true,
				autoSize		: true,
				openEffect	: 'none',
				closeEffect	: 'none'
			}
		);

		// trigger
		var url;
		if ( url = location.href.split("id=")[1] )
		{
			$("#id"+url.split(".")[1]).trigger('click');
		}
	}
);

function change()
{
	if ( $('#inp_stn option:selected').val() == "0" )
	{
		$('.hide').hide();
	}
	else
	{
		$('.hide').show();
	}
}

function loadCCTV()
{
	$(".loader").show();
	$.post
	(
		$('#path').val(),
		{ 
			p_time: $('#inp_time').val(),
			p_date: $('#inp_date').val(),
			p_stn: $('#inp_stn').val()
		},
		function(data)
		{
			$('#cctv').html(data);
			$('.loader').fadeOut();
		}
	);
}
</SCRIPT>