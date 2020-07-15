<?
$server = "192.168.103.12";
$user = "sa";
$pass = "ata+ee&c";
$db_name = "PATTANI";
$dsn = "Driver={SQL Server};Server=$server;Database=$db_name";
//$connection = mssql_connect($server, $user, $pass);
$connection = odbc_connect($dsn, $user, $pass);
$ary_month = array(
	"TH_ABBR" => array(1=>"01", 2=>"02", 3=>"03", 4=>"04", 5=>"05", 6=>"06", 7=>"07", 8=>"08", 9=>"09", 10=>"10", 11=>"11", 12=>"12"),
	"TH_FULL" => array(1=>"มกราคม", 2=>"กุมภาพันธ์", 3=>"มีนาคม", 4=>"เมษายน", 5=>"พฤษภาคม", 6=>"มิถุนายน", 7=>"กรกฎาคม", 8=>"สิงหาคม", 9=>"กันยายน", 10=>"ตุลาคม", 11=>"พฤศจิกายน", 12=>"ธันวาคม"),
	"EN_ABBR" => array(1=>"Jan", 2=>"Feb", 3=>"Mar", 4=>"Apr", 5=>"May", 6=>"Jun",7=>"Jul", 8=>"Aug",9=>"Sep", 10=>"Oct", 11=>"Nov", 12=>"Dec"),
	"EN_FULL" => array(1=>"January", 2=>"Febuary", 3=>"March", 4=>"April", 5=>"May", 6=>"June", 7=>"July", 8=>"August", 9=>"September", 10=>"October", 11=>"November", 12=>"December")
);
global $connection;
global $ary_month;
include("function.php");
?>