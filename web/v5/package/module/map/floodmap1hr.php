<?php

$select_box=array();
if($_GET['q']=='data')
{
$startDate = time();

$start=date('Y-m-d '.'09:00', strtotime('-3 day', $startDate));
$end=date('Y-m-d '.'09:00', strtotime('4 day', $startDate));
//$start="2014-11-15 07:00";
//$end="2014-12-03 07:00";

$startFor=strtotime($start);
$endFor=strtotime($end);
$i=0;
					while($startFor<=$endFor)
					{
						
								echo"<option value='".$i."'>".date('Y-m-d H-i',$startFor)."</option>";
								$startFor=$startFor+43200;
					$i++;											
					}	

}				
elseif($_GET['q']=='step')
{
					$startDate = time();
					if($_GET['n']==null)
					{$i=0;}
					else{$i=$_GET['n'];}
					$start=date('Y-m-d '.'09:00', strtotime('-3 day', $startDate));
					$end=date('Y-m-d '.'09:00', strtotime('4 day', $startDate));
					//$start="2014-11-15 07:00";
					//$end="2014-12-03 07:00";

					$startFor=strtotime($start);
					$endFor=strtotime($end);
					while($startFor<=$endFor)
					{								
						array_push($select_box,date('Y-m-d-H-i',$startFor));
						$startFor=$startFor+43200;									
					}	
					
					$file_png='Floodmap '.$select_box[$i].'.png';

					$link_file='<href>http://www.telepattani.com/web/v5/package/module/map/floodmap.php?path='.str_replace(" ","%20",$file_png).'</href>';
					// Creates an array of strings to hold the lines of the KML file.
					$kml = array('<?xml version="1.0" encoding="UTF-8"?>');
					$kml[] = '<kml xmlns="http://www.opengis.net/kml/2.2">';					
					$kml[] = '<GroundOverlay>';
					$kml[] = '<name>';
					$kml[] = 'Floodmap1hr';
					$kml[] = '</name>';
					$kml[] = '<description>';
					$kml[] = '2014-11-18 16:38:34';
					$kml[] = '</description>';
					$kml[] = '<Icon>';
					$kml[] = $link_file;
					$kml[] = '</Icon>';
					$kml[] = '<LatLonBox>';
					$kml[] = '<north>';
					$kml[] = '6.902082';
					$kml[] = '</north>';
					$kml[] = '<south>';
					$kml[] = '6.509125';
					$kml[] = '</south>';
					$kml[] = '<east>';
					$kml[] = '101.472388';
					$kml[] = '</east>';
					$kml[] = '<west>';
					$kml[] = '101.058644';
					$kml[] = '</west>';					
					$kml[] = '</LatLonBox>';
					$kml[] = '</GroundOverlay>';			
					$kml[] = '</kml>';
					$kmlOutput = join("\n", $kml);
					header('Content-type: application/vnd.google-earth.kml+xml');
					header('Content-Disposition: attachment; filename="floodmap.kml"');
					echo $kmlOutput;

}

					
function explode_name($file)
{
	$name1=explode('.',$file);
	$name2=explode(' ',$name1[0]);
	return $name2[1];
}

?>