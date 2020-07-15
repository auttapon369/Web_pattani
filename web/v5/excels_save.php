<?
//include("config.php");
//$date = $_GET['date'];
//$date = "2015-04-29 12:40";

//$sta = explode("-", $station);
//$ssite=$sta[0];

//include('data/config.php');

//$conn = connDB("odbc");

/*$host = "192.168.102.12";
$username = "sa";
$password = "ata+ee&c";
$dbname = "KOLOK";
$hosting = "Driver={SQL Server}; Server=$host; Database=$dbname";

$conn = mssql_connect($host, $username, $password);
$conodbc = odbc_connect($hosting, $username, $password);*/


//////////////////////////////////main//////////////////////////////////
	
	$dateshow=date('Y_m_d H:i', strtotime($date));
	$aname="gate"."_".$date;
	$an=str_replace(" ","-",trim($aname)).".xls"; 
	//header("Content-Type: application/vnd.ms-excel");
	//header("Content-Disposition: attachment; filename=$an.xls");

?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"

xmlns:x="urn:schemas-microsoft-com:office:excel"

xmlns="http://www.w3.org/TR/REC-html40">
<HEAD>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
	<TITLE>แสดงผลข้อมูล</TITLE>
	<style>
	.xl29
	{mso-style-parent:style0;
	font-family:Tahoma, sans-serif;
	mso-font-charset:0;
	mso-number-format:Fixed;
	text-align:center;
	border:.5pt solid black;
	background:white;
	mso-pattern:auto none;
	white-space:normal;}
	</style>
</HEAD>
<BODY>
<?php
$file="C:\\Tpat_model\\gateopen-manual\\".str_replace(":","-",$an);
$sql_num_door = 'SELECT MAX(c_door_water) as n FROM ['.$_cfg_conn['db'].'].[dbo].[control]';
$res_num_door = odbc_exec($conn, $sql_num_door);
$num_door = odbc_fetch_array($res_num_door);

$sql_num_sand = 'SELECT MAX(c_door_sand) as n FROM ['.$_cfg_conn['db'].'].[dbo].[control]';
$res_num_sand = odbc_exec($conn, $sql_num_sand);
$num_sand = odbc_fetch_array($res_num_sand);

$num = $num_door['n'] + $num_sand['n'];

$sql_stn = 'SELECT * FROM ['.$_cfg_conn['db'].'].[dbo].[control] ORDER BY c_id';
$res_stn = odbc_exec($conn, $sql_stn);

$sql_log = 'SELECT DISTINCT cl_date FROM ['.$_cfg_conn['db'].'].[dbo].[control_log] ORDER BY cl_date DESC';
$res_log = odbc_exec($conn, $sql_log);

$bg = ( empty($_GET['view']) ) ? " STYLE=\"background-color:yellow\"" : null;

$data .='<TABLE CLASS="tb_form" BORDER="1">';
		$data .='<THEAD CLASS="bc_pri dc_fade">';
			$data .='<TR>';
				$data .='<TH ROWSPAN="3" '.$bg.' >ปตร. / ทรบ.</TH>';
				$data .='<TH COLSPAN="'.$num.'" $bg>ระยะยกบาน <SPAN CLASS="fs_small">(หน่วย : เมตร)</SPAN></TH>';
			$data .='</TR>';
			$data .='<TR>';
			
			if ( $num_door['n'] > 0 )
			{
				$data .= "<TH COLSPAN=\"".$num_door['n']."\"".$bg.">ประตูระบายน้ำ</TH>";
			}
			if ( $num_sand['n'] > 0 )
			{
				$data .= "<TH COLSPAN=\"".$num_sand['n']."\"".$bg.">ประตูระบายทราย</TH>";
			}
			
			$data .='</TR>';
			$data .='<TR>';
			
			for ( $i = 1; $i <= $num_door['n']; $i++ )
			{
				$data .= "<TH".$bg.">บานที่ ".$i."</TH>\n";
			}
			for ( $i = 1; $i <= $num_sand['n']; $i++ )
			{
				$data .= "<TH".$bg.">บานที่ ".$i."</TH>\n";
			}
			
			$data .='</TR>';
		$data .='</THEAD>';
		$data .='<TBODY CLASS="bc_fade dc_fade">';
		
		while ( $arr_stn = odbc_fetch_array($res_stn) )
		{
			$sql_no = "SELECT TOP ".( $arr_stn['c_door_water'] + $arr_stn['c_door_sand'] )." * FROM [".$_cfg_conn['db']."].[dbo].[control_log] WHERE c_id = '".$arr_stn['c_id']."' ORDER BY cl_update DESC, cl_no";
			$res_no = odbc_exec($conn, $sql_no);

			$data .= "<TR>\n";
			$data .= "<TH ALIGN=\"left\" CLASS=\"bc_fade left\">".iconv("TIS-620","UTF-8",$arr_stn['c_name'])."</TH>\n";

			$n = 0;
			while ( $arr_no = odbc_fetch_array($res_no) )
			{
				$n++;
				
				
					
					$data .= "<TD ALIGN=\"center\">".$arr_no['cl_value']."</TD>\n";
				
			}

			if ( $n < $num )
			{
				for ( $i = 0; $i < ( $num - $n ); $i++ )
				{
					$gray = ( empty($_GET['view']) ) ? "STYLE=\"background-color:gray\"" : null;
					$data .= "<TD CLASS=\"bc_black\"".$gray.">&nbsp;</TD>\n";
				}
			}

			$data .= "</TR>\n";
		}
		
		$data .='</TBODY>';
$data .='</TABLE>';
	file_put_contents($file,$data);
	?>
</BODY>
</HTML>