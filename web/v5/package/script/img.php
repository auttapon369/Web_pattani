<?php
header('content-type: image/jpeg');

@include('../../data/config.php');
@include('../../'.$_cfg_path['class'].'index.php');

$_cctv = new Imgs($_cfg_cctv);

$local = "../../../../img/cctv/".$_GET['id']."/";
$img = $_cctv->img_scan($local);

readfile($img);
?>