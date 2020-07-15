<?php
header("Content-Type: text/xml; charset=UTF-8");
header("Access-Control-Allow-Origin: http://telepattani.com");
include('../../../data/config.php');
include("../../class/index.php");
$_call = new Tele($_cfg_tb, $_cfg_conn);
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
echo "<markers>\n";
$_call->get_mark();
echo "</markers>";
?>