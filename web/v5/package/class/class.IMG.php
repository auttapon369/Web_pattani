<?
class Imgs
{			
	// define
	private $_ip;
	private $_user;
	private $_pass;
	private $_path;
	

	// constructor
	public function __construct($img)
	{
		$this->_ip = $img['ip'];
		$this->_user = $img['user'];
		$this->_pass = $img['pass'];
		$this->_path = $img['path'];
	}


	// FTP
	public function img_ftp($id, $date, $max = null)
	{
		// config
		$arr = explode("-", $date);
		$replace = $arr[0].$arr[1].$arr[2];
		$dir = $id."/".$arr[0]."/".(int)$arr[1]."/".(int)$arr[2];
		$min = ( $max == 600 ) ? $max - 600 : 600;
		$min = ( $max == 2400 ) ? $max - 500 : $min;
		$total = 1;
		$temp = array();

		// conn
		$ftp_connection = @ftp_connect($this->_ip);
		if ( !$ftp_connection ) die('could not connect.');
			 
		// login
		$ftp_login = ftp_login($ftp_connection, $this->_user, $this->_pass);
		if ( !$ftp_login ) die('could not login, try again');

		// enter passive mode
		//$ftp_passive = @ftp_pasv($ip, true);
		//if ( !$ftp_passive ) die('could not enable passive mode.');


		// scan
		if ( @ftp_chdir($ftp_connection, $dir) )
		{
			//echo ftp_pwd($ftp_connection)."is Dir<BR>";
				if($min == 600 AND $max <= 1900)
			{
			$current = ftp_nlist($ftp_connection, '*');
			}
			else
			{
			$current = ftp_nlist($ftp_connection, '*r.jpg');
			}
					
			foreach ( $current as $file )
			{
				$time = str_replace($replace, "", $file);
				
				if ( (int)$time > $min AND (int)$time < $max )
				{
					$temp[] = array
					(
						'img'		=>	$file,
						'path'		=>	$this->_path."/".$dir."/",
						'num'		=>	$total++,
						'time'		=>	(int)substr($time, 0, 2).":".substr($time, 2, 2)." น."
					);
				}
			}

			if ( $total == 0 )
			{
				//echo '<SPAN>ไม่พบรูปภาพในช่วงเวลานี้</SPAN>';
			}
		}
		else
		{
			//echo $dir;
			//echo '<SPAN>ไม่พบรูปภาพในวันที่ ('.$date.'), ลองค้นหาในวันอื่นๆ</SPAN>';
		}
	
		@ftp_close($ftp_connection);


		return $temp;
	}


	// SCAN
	public function img_scan($local)
	{
		if ( $local != "" )
		{
			$total = 0;
			$img = array();
			$allowed_type = array("jpg","jpeg","gif","png");
			$allowed_size = 5000;

			// scan
			foreach ( scandir($local) as $key => $value )
			{	
				$file = $local.$value;
				$parts = explode(".", $value);
				$ext = strtolower(array_pop($parts));
				if ( in_array($ext, $allowed_type) AND filesize($file) > $allowed_size )
				{
					$img[] = array(filemtime($file), $file);
					$total++;
				}
			}

			// found img
			if ( $total > 0 )
			{
				$recent = max($img);
				return $recent[1];
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


	// DETAILS
	public function img_details($img)
	{
		$css = ( date('Y-m-d', filemtime($img)) < date('Y-m-d') ) ? "red" : "green";
		$time = date('Y-m-d H:i', filemtime($img));
		$r = "?r=".rand(10,1000);
		
		$arr = array
		(
			'time'		=>	$time,
			'color'		=>	$css
		);

		return $arr;
	}
}
?>