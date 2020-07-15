<?php
class General
{	
	// --------------------------------------------------------------------------------------- DATE
	
	// define
	private $month= array
	(
		"TH_ABBR" => array(1=>"ม.ค.", 2=>"ก.พ.", 3=>"มี.ค.", 4=>"เม.ย.", 5=>"พ.ค.", 6=>"มิ.ย.", 7=>"ก.ค.", 8=>"ส.ค.", 9=>"ก.ย.", 10=>"ต.ค.", 11=>"พ.ย.", 12=>"ธ.ค."),
		"TH_FULL" => array(1=>"มกราคม", 2=>"กุมภาพันธ์", 3=>"มีนาคม", 4=>"เมษายน", 5=>"พฤษภาคม", 6=>"มิถุนายน", 7=>"กรกฎาคม", 8=>"สิงหาคม", 9=>"กันยายน", 10=>"ตุลาคม", 11=>"พฤศจิกายน", 12=>"ธันวาคม"),
		"EN_ABBR" => array(1=>"Jan", 2=>"Feb", 3=>"Mar", 4=>"Apr", 5=>"May", 6=>"Jun",7=>"Jul", 8=>"Aug",9=>"Sep", 10=>"Oct", 11=>"Nov", 12=>"Dec"),
		"EN_FULL" => array(1=>"January", 2=>"Febuary", 3=>"March", 4=>"April", 5=>"May", 6=>"June", 7=>"July", 8=>"August", 9=>"September", 10=>"October", 11=>"November", 12=>"December")
	);


	// simple
	public function date_simple($text = null)
	{
		if ( !empty($text) )
		{
			$date = explode('-', $text);
			$dt = explode(' ', $date[2]);
			$y = substr(($date[0] + (int)543), 2);
			$m = $date[1];
			$d = $dt[0];
			$t = $dt[1];

			$text = $d."/".$m."/".$y.", ".$t;
		}

		return $text;
	}


	// thai full
	public function date_thai($text = null)
	{
		if ( !empty($text) )
		{
			$date = explode('-', $text);
			$dt = explode(' ', $date[2]);
			$y = $date[0] + (int)543;
			$m = $this->month['TH_FULL'][intval($date[1])];
			$d = (int)$dt[0];
			$t = $dt[1];
			
			$text = "วันที่ ".$d." ".$m." ".$y.", ".$t." น.";
		}

		return $text;
	}


	// report
	public function dateReport($d1, $d2)
	{
		$x1 = explode("-", $d1);
		$day1 = (int)$x1[2];
		$month1 = $this->month['TH_FULL'][intval($x1[1])];
		$year1 = $x1[0] + 543;

		$x2 = explode("-", $d2);
		$day2 = (int)$x2[2];
		$month2 = $this->month['TH_FULL'][intval($x2[1])];
		$year2 = $x2[0] + 543;

		if ( $d1 == $d2 )
		{
			$x = "ณ วันที่ ".$day1." ".$month1." ".$year1;
		}
		else
		{
			$x = "ระหว่างวันที่ ";

			if ( $month1 == $month2 )
			{
				$x .= $day1." - ".$day2." ".$month1." ".$year1;
			}
			else
			{
				if ( $year1 == $year2 )
				{
					$x .= $day1." ".$month1." - ".$day2." ".$month2." ".$year1;
				}
				else
				{
					$x .= $day1." ".$month1." ".$year1." - ".$day2." ".$month2." ".$year2;
				}
			}
		}

		return $x;
	}


	// compare
	public function TimeDiff($strTime1, $strTime2)
	{
		// 1 Hour =  60*60
		return (strtotime($strTime2) - strtotime($strTime1)) / ( 60 * 60 );
	}
	
	


	// -------------------------------------------------------------------------------------- OTHER

	// thai lang
	public function convTH($text, $method)
	{
		if ( $method == "in" )
		{
			$text = iconv('UTF-8', 'TIS-620', $text);
		}
		if ( $method == "out" )
		{
			$text = iconv('TIS-620', 'UTF-8', $text);
		}

		return $text;
	}


	// alarm
	public function alarmCheck($value, $limit1, $limit2, $error, $type = null)
	{
		$x = array("green", "ปกติ");

		if ( $error > 2 AND $error < 3 )
		{
			$x = array("black", "ขัดข้องไม่เกิน 3 ชม.");
		}
		else if ( $error > 3 AND $error < (24*3) )
		{
			$x = array("gray", "ขัดข้องไม่เกิน 3 วัน");
		}
		else if ( $error > (24*3) )
		{
			$x = array("white", "ขัดข้องเกิน 3 วัน");
		}
		else
		{			
			$x = ( $value > $limit1 ) ? array("yellow", "เฝ้าระวัง") : $x;
			$x = ( $value > $limit2 ) ? array("red", "เตือนภัย") : $x;
		}
		
		if ( $type == "txt" )
		{
			return $x[1];
		}
		else
		{			
			return $x[0];
		}
	}




	// empty
	public function emptyCheck($value, $p = 2)
	{
		$x = ( trim($value) != null ) ? number_format($value, $p) : null;

		return $x;
	}




	// scandir
	public function findItem($loc, $type, $format)
	{
		//global $path;
		$dir = $loc."/";
	  
		// Open the folder
		$dir_handle = @opendir($dir) or die("Unable to open $dir");
	  
		// Loop through the files
		while (($file = readdir($dir_handle)) !== false)
		{
			if ($file == "." || $file == ".." ) continue;
			$file_utf8 = $this->convTH($file, 'out');
			$filename = basename ($file_utf8, $type);

			if ( $format == "list" )
			{
				echo '<LI CLASS="fc_sec"><A HREF="'.$dir.$file_utf8.'" TARGET="_blank" CLASS="fc_black">'.$filename.'</A></LI>';
			}
			else if ( $format == "option" )
			{
				echo '<OPTION VALUE="'.$dir.$file_utf8.'" TARGET="_blank">'.$filename.'</OPTION>';
			}
			else
			{
				echo '';
			}
		}

		// Close
		closedir($dir_handle);
	}


	// read xml
	function data_xml($xml)
	{
		$xml5 = file($xml);		// กำหนด url ของ rss ไฟล์ที่ต้องการ
		$xmlDATA = "";			// สรัางตัวแปรสำหรับเก็บค่า xml ทั้งหมด
		
		foreach ( $xml5 as $key => $value )
		{
			//$xmlDATA .= $value;
			$xmlDATA .= $this->convTH($value, 'out');
		}

		$data1 = explode("<item>", $xmlDATA);
		$iTitle = array(); 			// ตัวแปร Array สำหรับเก็บหัวข้อข่าว
		$iLink = array(); 			// ตัวแปร Array สำหรับเก็บลิ้งค์
		$iDesc = array(); 			// ตัวแปร Array สำหรับเก็บรายละเอียดแบบย่อ
		$ipubDate = array(); 	// ตัวแปร Array สำหรับเก็บวันที่

		foreach ( $data1 as $key => $value )
		{ 
			// วนลูป เพื่อเก็บค่าต่างๆ ไว้ในตัวแปรด้านบนที่กำหนด
			if ( $key > 0 )
			{
				$value = str_replace("</item>", "", $value);
				$iTitle[$key] = strip_tags(substr($value,strpos($value,"<title>"),strpos($value,"</title>")));
				$iLink[$key] = strip_tags(substr($value,strpos($value,"<link>"),strpos($value,"</link>")-strpos($value,"<link>")));
				$iDesc[$key] = str_replace("<![CDATA[","",str_replace("]]>","",substr($value,strpos($value,"<description>"),strpos($value,"</description>")-strpos($value,"<description>"))));
				$ipubDate[$key] = strip_tags(substr($value,strpos($value,"<pubDate>"),strpos($value,"</pubDate>")-strpos($value,"<pubDate>")));
			}
			if ( $key == 1 )
			{
				echo "<a href=\"".$iLink[$key]."\" target=\"_blank\" class=\"fc_pri\"><b>".$iTitle[$key]."</b></a><br>". $iDesc[$key]."<br><br>";
			}
		}
	}



	// read csv
	function data_csv($file,$starow)
	{
		$row = 1;
		$CSVfp =fopen($file , "r");
		if($CSVfp !== FALSE) 
		{
			while(($data = fgetcsv($CSVfp,1000,","))!==FALSE)
			{
			   $num = count($data);
			   //echo "{$num} ไฟล์ในบรรทัดที่ {$row} <br>";
			   $row++;
			   if($row > $starow)
			   //if(eregi('/^[a-z0-9]+$/', $data))
			   {
				   echo "<TR>";
					for($c=0;$c<$num;$c++)
					{
						  //$x=preg_replace('/\D/','',$data[$c]);
						  //echo "<TD CLASS='fc_norm'>".$x."</TD>";
						  if( strpos($this->convTH($data[$c], 'out'),'ปกติ') !== FALSE)
						  {
							$fc = "fc_norm";
						  }
						  else if( strpos($this->convTH($data[$c], 'out'),'เฝ้าระวัง') !== FALSE)
						  {
							$fc = "fc_warn";
						  }
						  else if( strpos($this->convTH($data[$c], 'out'),'วิกฤติ') !== FALSE)
						  {
							$fc = "fc_danger";
						  }
						  else
						  {
							$fc = "";
						  }
						  
						  $array_st = array('เฝ้าระวัง','ปกติ', 'วิกฤติ', 'เพิ่มขึ้น', 'ลดลง', 'ทรงตัว' );
						  //$array_st2 = explode(',', $array_st);
							
						  //echo $this->convTH($data[$c], 'out')."<br>";
						  //echo strpos($data[$c],'-')."<br>";

						  if( in_array($this->convTH($data[$c], 'out'), $array_st))
						  {
							$align = "center";
							$cnum=$this->convTH($data[$c], 'out');
						  }
						  else if( is_numeric(trim($data[$c])))
						  {
							$align = "right";
							$cnum  = number_format(trim($data[$c]),2);
						  }
						  else if( is_string($data[$c]) == TRUE && strpos($data[$c],'-') !== 0)
						  {
							$align = "left";
							$cnum=$this->convTH($data[$c], 'out');
						  }
						  else if(strpos($data[$c],'-') == 0 )
						  {
							$align = "right";
							$cnum  = $this->convTH($data[$c], 'out');
						  }
						  else 
						  {
							$align = "";
						  }

						  echo "<TD CLASS='".$fc." ".$align."'>".$cnum."</TD>";
					   }
				   echo "</TR>";
			   }
			}
		}
		fclose($CSVfp);

	}

	function data_txt($file)
	{
		$row = 1;
		$objtxt = fopen($file, "r");

		while ( ( $data = fgets($objtxt, 1000) ) !== FALSE )
		{
			/*$row++;
			if($row > 4)
			{
				$data=$this->convTH($data, 'out');
				$array_ = explode(') ', $data);

				//print_r($array_num);
				$array_1 = explode(' ', $array_[1]);

				//$num= ( count($array_)>1)? $array_[0] : "";
				//preg_match('#[0-9]#',$data ,$matches);
				//print_r($matches);

				//$data=str_replace ( "("..")", "<span style='font-weight: bold'>".$num."</span>"  ,$data);

				$sta= ( count($array_1)>1)? $array_1[1] : "";
				$data=str_replace ( $sta, "<span style='font-weight: bold'>".$sta."</span>"  ,$data);

				$text.=$data;
			}		*/
			
			if($row >= 4)
				$text.=$data;
			$row++;
		}

		$text=$this->convTH($text, 'out');
		
		$text = preg_replace("/(\(\d+\).+)(ต\.)/", "<br><br><div class='paper_inside'><span style='font-weight: bold'>$1</span>$2", $text);
		$text = preg_replace("/(.+)(\s\:)/", "<span style='font-weight: bold'>$1</span>$2", $text);
		$text = preg_replace("/(มีระดับน้ำเตือนภัยอยู่ที่)/", "<br>$1", $text);
		$text = preg_replace("/(การดำเนินการ.+)/", "$1</div>", $text);
		//echo $text;
		$text=nl2br($text);
		
		//$text=str_replace ( 'แนวโน้ม', "<span style='font-weight: bold'>แนวโน้ม</span>"  ,$text);
		//$text=str_replace ( 'การดำเนินการ', "<span style='font-weight: bold'>การดำเนินการ</span>"  ,$text);
		echo $text;

		fclose($objtxt);
	}


	// UTM
	public function UTMtoLL($f, $f1, $j)
	{
		 $d = 0.99960000000000004;
		 $d1 = 6378137;
		 $d2 = 0.0066943799999999998;
	   
		 $d4 = (1 - sqrt(1-$d2))/(1 + sqrt(1 - $d2));
		 $d15 = $f1 - 500000;
		 $d16 = $f;
		 $d11 = (($j - 1) * 6 - 180) + 3;
	   
		 $d3 = $d2/(1 - $d2);
		 $d10 = $d16 / $d;
		 $d12 = $d10 / ($d1 * (1 - $d2/4 - (3 * $d2 *$d2)/64 - (5 * pow($d2,3))/256));
		 $d14 = $d12 + ((3*$d4)/2 - (27*pow($d4,3))/32) * sin(2*$d12) + ((21*$d4*$d4)/16 - (55 * pow($d4,4))/32) * sin(4*$d12) + ((151 * pow($d4,3))/96) * sin(6*$d12);
		 $d13 = $d14 * 180 / M_PI;
		 $d5 = $d1 / sqrt(1 - $d2 * sin($d14) * sin($d14));
		 $d6 = tan($d14)*tan($d14);
		 $d7 = $d3 * cos($d14) * cos($d14);
		 $d8 = ($d1 * (1 - $d2))/pow(1-$d2*sin($d14)*sin($d14),1.5);
	   
		 $d9 = $d15/($d5 * $d);
		 $d17 = $d14 - (($d5 * tan($d14))/$d8)*((($d9*$d9)/2-(((5 + 3*$d6 + 10*$d7) - 4*$d7*$d7-9*$d3)*pow($d9,4))/24) + (((61 +90*$d6 + 298*$d7 + 45*$d6*$d6) - 252*$d3 -3 * $d7 *$d7) * pow($d9,6))/720); 
		 $d17 = $d17 * 180 / M_PI;
		 $d18 = (($d9 - ((1 + 2 * $d6 + $d7) * pow($d9,3))/6) + (((((5 - 2 * $d7) + 28*$d6) - 3 * $d7 * $d7) + 8 * $d3 + 24 * $d6 * $d6) * pow($d9,5))/120)/cos($d14);
		 $d18 = $d11 + $d18 * 180 / M_PI;
		 $arr = array ( $d18,$d17);
	   
		 return $arr;
	}
}
?>