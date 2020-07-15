<?
//include("config.php");
$date = $_GET['date'];

//$sta = explode("-", $station);
//$ssite=$sta[0];

@include('data/config.php');
@include($_cfg_path['class'].'index.php');

$_call = new Tele($_cfg_tb, $_cfg_conn);

$conn = connDB("odbc");

/*$host = "192.168.102.12";
$username = "sa";
$password = "ata+ee&c";
$dbname = "KOLOK";
$hosting = "Driver={SQL Server}; Server=$host; Database=$dbname";

$conn = mssql_connect($host, $username, $password);
$conodbc = odbc_connect($hosting, $username, $password);*/


//////////////////////////////////main//////////////////////////////////
	
	$dateshow=date('Y_m_d H:i', strtotime($date));
	$aname="water_door"."_".$date;
	$an=str_replace("","",$aname); 
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$an.xls");

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
<?

include($_cfg_path['sys']."panel/door-table.php");

?>
		
</BODY>
</HTML>