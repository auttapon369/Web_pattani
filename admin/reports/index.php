<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="js/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="Includes/datetimepicker_css.js"></script>
 <script language="javascript" type="text/javascript" src="js/jquery.fixedtableheader.min.js"></script><!-- <script src="http://code.highcharts.com/highcharts.js"></script>  -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
</head>
<body>
<br>
<?
include('config.php');

// tool bar
include("Preport.php"); 

// view
	if($_REQUEST[search])
	{
		include("Pview.php");
	}
	else
	{
		
	}
?>

</body>
</html>