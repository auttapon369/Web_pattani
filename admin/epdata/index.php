<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="js/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="js/tcal.css" />
<script type="text/javascript" src="js/tcal.js"></script>
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