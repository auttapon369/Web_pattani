<?
class Tele Extends General
{			
	// define
	protected static $db;
	private $tb_stn;
	private $tb_daily;
	private $tb_bk;
	private $tb_flow;
	private $tb_user;

	
	// constructor
	public function __construct($table, $conn = null)
	{
		$this->tb_stn = $table['stn'];
		$this->tb_daily = $table['daily'];
		$this->tb_dailytime = $table['dailytime'];
		$this->tb_bk = $table['backup'];
		$this->tb_flow = $table['q'];
		$this->tb_user = $table['user'];

		if ( $conn['sql'] == "odbc" )
		{
			self::$db = new sqlODBC($conn);
		}
		else if ( $conn['sql'] == "ms" )
		{
			self::$db = new sqlMS($conn);
		}
		else
		{
			return;
		}
	}




	// ------------------------------------------------------------------------------------ STATION
	
	public function get_stn($id = null)
	{		
		if ( !empty($id) ) { self::$db->where("STN_ID", $id); }
		self::$db->order("LOC_ID");
		$res = self::$db->get($this->tb_stn);
		$arr = array();

		for ( $i = 0; $i < count($res); $i++ )
		{
			$arr[] = array
			(
				'id'				=>	$res[$i]['STN_ID'],
				'code'			=>	$res[$i]['STN_CODE'],
				'name'		=>	$this->convTH($res[$i]['STN_NAME_THAI'], 'out'),
				'detail'		=>	$this->convTH($res[$i]['STN_DETAIL'], 'out'),
				'end'			=>	$res[$i]['stn_front_end'],
				'n'				=>	round($res[$i]['UTM_N'], 2),
				'e'				=>	round($res[$i]['UTM_E'], 2),
				'adsl'			=>	$res[$i]['ADSL'],
				'sim'			=>	$res[$i]['SIM'],
				'solar'			=>	$res[$i]['Solar_cell'],
				'rf'				=>	$res[$i]['Check_rf'],
				'wl'				=>	$res[$i]['Check_wl'],
				'fl'				=>	$res[$i]['Check_fl'],
				'rf1'			=>	$this->emptyCheck($res[$i]['alarm_RF1']),
				'rf2'			=>	$this->emptyCheck($res[$i]['alarm_RF2']),
				'wl1'			=>	$this->emptyCheck($res[$i]['alarm_WL1']),
				'wl2'			=>	$this->emptyCheck($res[$i]['alarm_WL2']),
				'bm'			=>	$this->emptyCheck($res[$i]['cross_bm']),
				'zg'			=>	$this->emptyCheck($res[$i]['cross_zg']),
				'bottom'		=>	$this->emptyCheck($res[$i]['cross_bottom']),
				'left'			=>	$this->emptyCheck($res[$i]['cross_left']),
				'right'			=>	$this->emptyCheck($res[$i]['cross_right'])
			);
		}

		return $arr;
	}

	// list
	public function get_stn_list($type = null, $block = null)
	{		
		$_stn = $this->get_stn();

		for ( $i = 0; $i < count($_stn); $i++ )
		{
			if ( $type == "check" )
			{
				echo "<LI><INPUT TYPE=\"checkbox\" NAME=\"stn[]\" VALUE=\"".$_stn[$i]['id']."_".$_stn[$i]['code']."_".$_stn[$i]['rf']."_".$_stn[$i]['wl']."_".$_stn[$i]['fl']."_".$_stn[$i]['end']."\" /> ".$_stn[$i]['code']." ".$_stn[$i]['name']."</LI>\n";
			}
			else if ( $type == "option" )
			{
				if ( $i == 0 )
				{
					echo "<OPTION VALUE=\"0\">รูปภาพจากสถานีทั้งหมด</OPTION>";
				}
				if ( $_stn[$i]['wl'] == 1 && !in_array($_stn[$i]['id'], $block) )
				{
					if ( $_stn[$i]['end'] == "Y" )
					{
						echo "<OPTION VALUE=\"".$_stn[$i]['id']."_UP\">".$_stn[$i]['code']." หน้า ".$_stn[$i]['name']."</OPTION>";
						echo "<OPTION VALUE=\"".$_stn[$i]['id']."_DOWN\">".$_stn[$i]['code']." ท้าย ".$_stn[$i]['name']."</OPTION>";
					}
					else
					{
						echo "<OPTION VALUE=\"".$_stn[$i]['id']."\">".$_stn[$i]['code']." ".$_stn[$i]['name']."</OPTION>";
					}
				}
			}
			else if ( $type == "info" )
			{
				echo "<LI CLASS=\"fc_sec\"><A HREF=\"javascript:info('sub', '".$_stn[$i]['id']."')\" CLASS=\"fc_black\">".$_stn[$i]['code']." ".$_stn[$i]['name']."</A></LI>\n";
			}
			else
			{
				echo "<LI><A HREF=\"./?page=station&id=".$_stn[$i]['id']."\">".$_stn[$i]['code']." ".$_stn[$i]['name']."</A></LI>\n";
			}
		}

		unset($_stn);
	}




	// -------------------------------------------------------------------------------------- VALUE
	
	public function get_values($id)
	{
		$sql = "EXECUTE ".$this->tb_daily." @id = '".$id."', @t = 1";
		$res = self::$db->get('none', $sql);
		//$fl = $this->get_flow($res[0]['STN_ID'], $res[0]['WL']);
		//$fle = $this->get_flow($res[0]['STN_ID'], $res[0]['WL_E']);

		$arr = array
		(
				'id'						=>	$res[0]['STN_ID'],
				'rf_15'				=>	$this->emptyCheck($res[0]['RF_15MIN']),
				'rf_00'				=>	$this->emptyCheck($res[0]['RF_D00']),
				'rf_77'				=>	$this->emptyCheck($res[0]['RF_D77']),
				'rf_1h'				=>	$this->emptyCheck($res[0]['RF_1H']),
				'rf_24'				=>	$this->emptyCheck($res[0]['RF_24H']),
				'rf_48'				=>	$this->emptyCheck($res[0]['RF_48H']),
				'rf_72'				=>	$this->emptyCheck($res[0]['RF_72H']),
				'wl'						=>	$this->emptyCheck($res[0]['WL']),
				'wl_min'				=>	$this->emptyCheck($res[0]['WL_MIN']),
				'wl_max'				=>	$this->emptyCheck($res[0]['WL_MAX']),
				'wl_min_time'		=>	$res[0]['WLMIN_TIME'],
				'wl_max_time'		=>	$res[0]['WLMAX_TIME'],
				'wle'					=>	$this->emptyCheck($res[0]['WL_E']),
				'wle_min'				=>	$this->emptyCheck($res[0]['WL_E_MIN']),
				'wle_max'			=>	$this->emptyCheck($res[0]['WL_E_MAX']),
				'wle_min_time'		=>	$res[0]['WL_E_MIN_TIME'],
				'wle_max_time'	=>	$res[0]['WL_E_MAX_TIME'],
				'fl'						=>	$this->emptyCheck($res[0]['FLOW']),
				'fle'					=>	$this->emptyCheck($res[0]['FLOW_E']),
				'ca'					=>	$this->emptyCheck($res[0]['CAPACITY']),
				'date'					=>	$res[0]['dateRF']
		);

		//print_r($arr);
		return $arr;
	}


	public function get_values_time($id, $time)
	{		
		$sql = "EXECUTE ".$this->tb_dailytime." @id = '".$id."', @t = '".$time."'";
		$res = self::$db->get('none', $sql);

		$arr = array
		(
			'wl'				=>	$this->emptyCheck($res[0]['WL']),
			'diff'			=>	$this->emptyCheck($res[0]['diff']),
			'q'				=>	$this->emptyCheck($res[0]['Q']),
			'a'				=>	$this->emptyCheck($res[0]['A'])
		);

		//print_r($arr);
		return $arr;
	}


	// flow
	public function get_flow($id, $wl)
	{		
		//$wl = (int) number_format($wl, 2);
		$sql = "SELECT * FROM ".$this->tb_flow." WHERE STN_ID = '".$id."' AND WL = '".$wl."'";
		$res = self::$db->get('none', $sql);
		$val = ( $res ) ? $res[0]['Q'] : 0;
		
		return $val;
	}











	// ---------------------------------------------------------------------------------------- MAP
	public function get_mark()
	{
		$_stn = $this->get_stn();
		
		//for ( $i = 0; $i < 4; $i++ )
		for ( $i = 0; $i < count($_stn); $i++ )
		{
			$point = $this->UTMtoLL($_stn[$i]['n'], $_stn[$i]['e'], 47);
			$val = $this->get_values($_stn[$i]['id']);
			$event = $this->get_event($_stn[$i]['id'], $val['date']);
			$error = $this->TimeDiff($val['date'], date('Y-m-d H:i'));
			$ic_rf = "rf_".$this->alarmCheck($val['rf_1h'], $_stn[$i]['rf1'], $_stn[$i]['rf2'], $error);
			$ic_wl = "wl_".$this->alarmCheck($val['wl'], $_stn[$i]['wl1'], $_stn[$i]['wl2'], $error);
			$ic_rf = ( $_stn[$i]['rf'] == 1 ) ? $ic_rf." " : null;
			$ic_wl = ( $_stn[$i]['wl'] == 1 ) ? $ic_wl." " : null;
			$alarm = $ic_rf.$ic_wl."i24";
			$conn = "bc_white";
			//$blink = ( strpos($ic_rf, 'red') !== false OR strpos($ic_wl, 'red') !== false ) ? 1 : null;

			echo "<marker"
						." id=\"".$_stn[$i]['id']."\""
						." code=\"".$_stn[$i]['code']."\""
						." name=\"".$_stn[$i]['name']."\""
						." address=\"".$_stn[$i]['detail']."\""
						." lat=\"".$point[1]."\""
						." lng=\"".$point[0]."\""
						." rf=\"".$_stn[$i]['rf']."\""
						." wl=\"".$_stn[$i]['wl']."\""
						." date=\"".$this->date_thai($val['date'])."\""
						." ac=\"".$event[0]."\""
						." li=\"".$event[1]."\""
						." dr=\"".$event[2]."\""
						." conn=\"".$conn."\""
						." alarm=\"".$alarm."\""
						." rf_77=\"".$val['rf_77']."\""
						." rf_1=\"".$val['rf_1h']."\""
						." rf_24=\"".$val['rf_24']."\""
						." rf_48=\"".$val['rf_48']."\""
						." rf_72=\"".$val['rf_72']."\""
						." wl_val=\"".$val['wl']."\""
						." wl_left=\"".$_stn[$i]['left']."\""
						." wl_right=\"".$_stn[$i]['right']."\""
						." wl_lv1=\"".$_stn[$i]['wl1']."\""
						." wl_lv2=\"".$_stn[$i]['wl2']."\""
						." flow=\"".$val['fl']."\""
					." />\n";
			
			//flush();
			//ob_flush();
		}
	}


	// -------------------------------------------------------------------------------------- EVENT
	public function get_event($id, $time)
	{
		$sql =	"SELECT 
						DT, 
						SUM(CASE sensor_id WHEN '601' THEN Value END) li, 
						SUM(CASE sensor_id WHEN '701' THEN Value END) dr, 
						SUM(CASE sensor_id WHEN '702' THEN Value END) ac 
					FROM 
						".$this->tb_bk." 
					WHERE 
						STN_ID = '".$id."' 
						AND DT = '".$time."' 
					GROUP BY 
						DT";

		$res = self::$db->get('none', $sql);
		$x = array($res[0]['ac'], $res[0]['li'], $res[0]['dr']);
		//$x = array(1, 1, 1);

		
		return $x;
	}
	
	
	
	
	// -------------------------------------------------------------------------------------- LOGIN
	public function get_login($user, $pass)
	{
		self::$db->where("username", $user);
		self::$db->where("password", $pass);
		$res = self::$db->get($this->tb_user);

		return $res[0]['ID'];
	}


/*
	public function __destruct()
	{
		self::$db = null;
	}
*/

}
?>