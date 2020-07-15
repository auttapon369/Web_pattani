<?php
if ( file_exists($_cfg_path['sys']."stats/live.php") AND file_exists($_cfg_path['sys']."stats/board.php") )
{
	if ( $_GET['view'] == "board" )
	{
		include($_cfg_path['sys']."stats/board.php");
	}
	else if ( $_GET['view'] == "now" )
	{
		include($_cfg_path['sys']."stats/live.php");
?>
		<BR>
		<?php @include($_cfg_path['script'].'symbol.html') ?>

		<INPUT TYPE="hidden" ID="ws-ip" VALUE="<?php echo $_cfg_ws_ip ?>" />

		<SCRIPT TYPE="text/javascript">
		function openConnection()
		{
			// uses global 'conn' object
			if ( conn.readyState === undefined || conn.readyState > 1 )
			{
				conn = new WebSocket($('#ws-ip').val());

				conn.onopen = function ()
				{
					conn.send("Connection Established Confirmation");
				};

				conn.onmessage = function (event)
				{
					var msg = JSON.parse(event.data);
					var target = msg.Column + msg.StationID;
					
					$('#'+target).addClass('bc_black fc_white');
					$('#'+target+' span').hide();
					$('#'+target+' span').html(msg.Value);
					$('#'+target+' span').delay('500').fadeIn();
				};

				conn.onerror = function (event)
				{
					openConnection();
					//alert("Web Socket Error");
				};
				
				conn.onclose = function (event)
				{
					//alert("Web Socket Closed");
				};
			}
		}

		$(document).ready
		(
			function ()
			{
				conn = {}, window.WebSocket = window.WebSocket || window.MozWebSocket;
				openConnection();

				setInterval
				(
					function()
					{	
						if ( $('.tb_report td.bc_black').length > 10 )
						{
							$('.tb_report td').removeClass('bc_black fc_white');
						}
					},
					15000
				);

			}
		);
		</SCRIPT>
	<?php
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
?>