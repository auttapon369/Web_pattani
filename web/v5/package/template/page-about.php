<?php
if ( $_GET['view'] == "station" )
{
?>
	<BR>
	<H3>สถานีหลัก</H3>
	<UL CLASS="list-item">
	<?php
	foreach ( $_cfg_station as $key => $val )
	{
		echo "<LI CLASS=\"fc_sec\"><A HREF=\"javascript:info('main', '".$key."')\" CLASS=\"fc_black\">".$key." ".$val['name']."</A></LI>\n";
	}
	?>	
	</UL>
	<BR>
	<H3>สถานีสนาม</H3>
	<UL CLASS="list-item">
	<?php $_call->get_stn_list('info') ?>
	</UL>

	<DIV ID="info" CLASS="bc_fade"></DIV>
	<INPUT TYPE="hidden" ID="path" VALUE="<?php echo $_cfg_path['sys']."station/" ?>">

	<SCRIPT TYPE="text/javascript">
	function info(view, target)
	{
		$.post
		(
			$('#path').val()+"info.php",
			{
				id: target,
				type: view
			},
			function(data, status)
			{
				//alert("Data: " + data + "\nStatus: " + status);
				$('#info').html(data);
				$('#info').show();
			}
		);
	}
	$(document).ready
	(
		function()
		{
			$('body').click
			(
				function()
				{
					$('#info').fadeOut();
				}
			);
		}
	);
	</SCRIPT>
<?php
}
else if ( $_GET['view'] == "project" )
{
	for ( $i = 0; $i < count($_cfg_about); $i++ )
	{
		// IMG
		if ( !empty($_cfg_about[$i]['img']) )
		{
			echo "<IMG SRC=\"".$_cfg_root.$_cfg_path['img'].$_cfg_about[$i]['img']."\" WIDTH=\"100%\" />";
			echo "<BR>";
		}

		// TITLE
		echo "<BR>";
		echo "<H3>".$_cfg_about[$i]['title']."</H3>\n";
		
		// CONTENT
		if ( !empty($_cfg_about[$i]['content']) )
		{
			for ( $ia = 0; $ia < count($_cfg_about[$i]['content']); $ia++ )
			{
				echo "<P>".$_cfg_about[$i]['content'][$ia]."</P>\n";
			}
		}

		// LIST
		if ( !empty($_cfg_about[$i]['list']) )
		{
			echo "<UL CLASS=\"list-num\">\n";

			for ( $ib = 0; $ib < count($_cfg_about[$i]['list']); $ib++ )
			{
				echo "<LI>".$_cfg_about[$i]['list'][$ib]."</LI>\n";
			}

			echo "</UL>\n";
		}

		// FILE
		if ( !empty($_cfg_about[$i]['file']) )
		{
			if ( file_exists($_cfg_path['sys']."station/".$_cfg_about[$i]['file']) )
			{
				include($_cfg_path['sys']."station/".$_cfg_about[$i]['file']);
			}
			else
			{
				echo $_cfg_txt_error;
			}
		}

		echo "<BR>";
	}

	unset($i);
	unset($ia);
	unset($ib);
}
else
{
	echo $_cfg_txt_error;
}
?>