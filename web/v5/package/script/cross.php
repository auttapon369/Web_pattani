<?php
header('Content-type: image/svg+xml');
include('../class/index.php');
$call_svg = new SVG();
$call_svg->crossSection($_GET['id'], $_GET['wl'], $_GET['lv1'], $_GET['lv2'], $_GET['bm'], $_GET['zg'], $_GET['bd'], $_GET['left'], $_GET['right']);
?>