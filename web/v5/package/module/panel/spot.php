<?php
if ( !empty($_GET['action']) )
{
	//echo $_cfg_spot.$_GET['id']."/".$_GET['action'];
	$curl = curl_init($_cfg_spot.$_GET['id']."/".$_GET['action']);
	$res = curl_exec($curl);
	curl_close($curl);

	echo $_refresh;
}
else
{
?>
<FORM METHOD="post">
	<TABLE WIDTH="100%" CLASS="tb_form">
		<THEAD CLASS="bc_pri dc_fade">
			<TR>
				<TH WIDTH="50">รหัส</TH>
				<TH>ชื่อสถานี</TH>
				<TH WIDTH="150">Spotlight</TH>
			</TR>
		</THEAD>
		<TBODY CLASS="bc_fade dc_fade">
		<?php
		for ( $i = 0; $i < count($_stn); $i++ )
		{
			if ( $_stn[$i]['wl'] == "1" )
			{
				echo "<TR>\n";
				echo "<TH CLASS=\"bc_fade\">".$_stn[$i]['code']."</TH>\n";
				echo "<TD CLASS=\"left\">".$_stn[$i]['name']."</TD>\n";
				echo "<TD><a class=\"button bc_norm fc_white\" href=\"./?page=".$_GET['page']."&view=".$_GET['view']."&action=on&id=".$_stn[$i]['id']."\">เปิด</a> <a class=\"button bc_danger fc_white\" href=\"./?page=".$_GET['page']."&view=".$_GET['view']."&action=off&id=".$_stn[$i]['id']."\">ปิด</a></TD>\n";
				echo "</TR>\n";
			}
		}
		?>
		</TBODY>
	</TABLE>
</FORM>
<?
}
?>