<!--<script type="text/javascript" src="../../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="chart/highstock.js"></script>
<script type="text/javascript" src="chart/exporting.js"></script>-->

<?

$conn = connDB("odbc");

$tdt = explode("-",$datetime);
if($tdt[1]=='02' AND $tdt[2]>28)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='04' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='06' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='09' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='11' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}


$chcount = 0;
foreach($p_stn as $id)
{
	$_value = cut($id);
	$ssite = $_value[0];
	$nname = $_value[4];

	$s_rf = C_rf($_value[1],$p_rain);
	$s_wl = C_wl($_value[2],$p_water);
	$s_fl = C_fl($_value[3],$p_flow);

	$chcount++;
	//echo $ssite."-".$chcount."<BR>";
}



$chcount = 0;
if(in_array('Tpat.1-0-1-0', $p_stn))
{
  $Pt1="Tpat.1";

  $_stn = $_call->get_stn($Pt1);
  $_namec1 = $_stn[0]['code'];

  $ns = explode(".", $Pt1);
  $_nrow1=$ns[0].$ns[1];

  $chcount++;
  $cnumPt1=$chcount;
}
if(in_array('Tpat.2-0-1-0', $p_stn))
{
  $Pt2="Tpat.2";
  $_stn = $_call->get_stn($Pt2);
  $_namec2 = $_stn[0]['code'];
  $ns = explode(".", $Pt2);
  $_nrow2=$ns[0].$ns[1];
  $chcount++;
  $cnumPt2=$chcount;
}
if(in_array('Tpat.3-1-1-0', $p_stn))
{
  $Pt3="Tpat.3";
   $_stn = $_call->get_stn($Pt3);
  $_namec3 = $_stn[0]['code'];
  $ns = explode(".", $Pt3);
  $_nrow3=$ns[0].$ns[1];
  $chcount++;
  $cnumPt3=$chcount;
}
if(in_array('Tpat.4-1-1-0', $p_stn))
{
	$Pt4="Tpat.4";
  $_stn = $_call->get_stn($Pt4);
  $_namec4 = $_stn[0]['code'];
  $ns = explode(".", $Pt4);
  $_nrow4=$ns[0].$ns[1];
  $chcount++;
  $cnumPt4=$chcount;
}
if(in_array('Tpat.5-1-1-1', $p_stn))
{
	$Pt5="Tpat.5";
	 $_stn = $_call->get_stn($Pt5);
  $_namec5 = $_stn[0]['code'];
  $ns = explode(".", $Pt5);
  $_nrow5=$ns[0].$ns[1];
  $chcount++;
  $cnumPt5=$chcount;
}
if(in_array('Tpat.6-0-1-0', $p_stn))
{
	$Pt6="Tpat.6";
	 $_stn = $_call->get_stn($Pt6);
  $_namec6 = $_stn[0]['code'];
  $ns = explode(".", $Pt6);
  $_nrow6=$ns[0].$ns[1];
  $chcount++;
  $cnumPt6=$chcount;
}
if(in_array('Tpat.7-0-1-1', $p_stn))
{
	$Pt7="Tpat.7";
	 $_stn = $_call->get_stn($Pt7);
  $_namec7 = $_stn[0]['code'];
  $ns = explode(".", $Pt7);
  $_nrow7=$ns[0].$ns[1];
  $chcount++;
  $cnumPt7=$chcount;
}
if(in_array('Tpat.8-1-1-0', $p_stn))
{
	$Pt8="Tpat.8";
	 $_stn = $_call->get_stn($Pt8);
  $_namec8 = $_stn[0]['code'];
  $ns = explode(".", $Pt8);
  $_nrow8=$ns[0].$ns[1];
  $chcount++;
  $cnumPt8=$chcount;
}
if(in_array('Tpat.9-1-1-0', $p_stn))
{
	$Pt9="Tpat.9";
	 $_stn = $_call->get_stn($Pt9);
  $_namec9 = $_stn[0]['code'];
  $ns = explode(".", $Pt9);
  $_nrow9=$ns[0].$ns[1];
  $chcount++;
  $cnumPt9=$chcount;
}
if(in_array('Tpat.10-1-1-0', $p_stn))
{
	$Pt10="Tpat.10";
	 $_stn = $_call->get_stn($Pt10);
  $_namec10 = $_stn[0]['code'];
  $ns = explode(".", $Pt10);
  $_nrow10=$ns[0].$ns[1];
  $chcount++;
  $cnumPt10=$chcount;
}
if(in_array('Tpat.11-1-1-0', $p_stn))
{
	$Pt11="Tpat.11";
	 $_stn = $_call->get_stn($Pt11);
  $_namec11 = $_stn[0]['code'];
  $ns = explode(".", $Pt11);
  $_nrow11=$ns[0].$ns[1];
  $chcount++;
  $cnumPt11=$chcount;
}
if(in_array('Tpat.12-0-1-0', $p_stn))
{
	$Pt12="Tpat.12";
	 $_stn = $_call->get_stn($Pt12);
  $_namec12 = $_stn[0]['code'];
  $ns = explode(".", $Pt12);
  $_nrow12=$ns[0].$ns[1];
  $chcount++;
  $cnumPt12=$chcount;
}
if(in_array('Tpat.13-1-1-0', $p_stn))
{
	$Pt13="Tpat.13";
	 $_stn = $_call->get_stn($Pt13);
  $_namec13 = $_stn[0]['code'];
  $ns = explode(".", $Pt13);
  $_nrow13=$ns[0].$ns[1];
  $chcount++;
  $cnumPt13=$chcount;
}
if(in_array('Tpat.14-1-1-0', $p_stn))
{
	$Pt14="Tpat.14";
	 $_stn = $_call->get_stn($Pt14);
  $_namec14 = $_stn[0]['code'];
  $ns = explode(".", $Pt14);
  $_nrow14=$ns[0].$ns[1];
  $chcount++;
  $cnumPt14=$chcount;
}
if(in_array('Tpat.15-1-1-0', $p_stn))
{
	$Pt15="Tpat.15";
	 $_stn = $_call->get_stn($Pt15);
  $_namec15 = $_stn[0]['code'];
  $ns = explode(".", $Pt15);
  $_nrow15=$ns[0].$ns[1];
  $chcount++;
  $cnumPt15=$chcount;
}
if(in_array('Tpat.16-1-0-0', $p_stn))
{
	$Pt16="Tpat.16";
	 $_stn = $_call->get_stn($Pt16);
  $_namec16 = $_stn[0]['code'];
  $ns = explode(".", $Pt16);
  $_nrow16=$ns[0].$ns[1];
  $chcount++;
  $cnumPt16=$chcount;
}
if(in_array('Tpat.17-1-1-0', $p_stn))
{
	$Pt17="Tpat.17";
	 $_stn = $_call->get_stn($Pt17);
  $_namec17 = $_stn[0]['code'];
  $ns = explode(".", $Pt17);
  $_nrow17=$ns[0].$ns[1];
  $chcount++;
  $cnumPt17=$chcount;
}
if(in_array('Tpat.18-1-0-0', $p_stn))
{
	$Pt18="Tpat.18";
	 $_stn = $_call->get_stn($Pt18);
  $_namec18 = $_stn[0]['code'];
  $ns = explode(".", $Pt18);
  $_nrow18=$ns[0].$ns[1];
  $chcount++;
  $cnumPt18=$chcount;
}
if(in_array('Tpat.19-1-0-0', $p_stn))
{
	$Pt19="Tpat.19";
	 $_stn = $_call->get_stn($Pt19);
  $_namec19 = $_stn[0]['code'];
  $ns = explode(".", $Pt19);
  $_nrow19=$ns[0].$ns[1];
  $chcount++;
  $cnumPt19=$chcount;
}
if(in_array('Tpat.20-1-0-0', $p_stn))
{
	$Pt20="Tpat.20";
	 $_stn = $_call->get_stn($Pt20);
  $_namec20 = $_stn[0]['code'];
  $ns = explode(".", $Pt20);
  $_nrow20=$ns[0].$ns[1];
  $chcount++;
  $cnumPt20=$chcount;
}
if(in_array('Tpat.21-1-1-0', $p_stn))
{
	$Pt21="Tpat.21";
	 $_stn = $_call->get_stn($Pt21);
  $_namec21 = $_stn[0]['code'];
  $ns = explode(".", $Pt21);
  $_nrow21=$ns[0].$ns[1];
  $chcount++;
  $cnumPt21=$chcount;
}
if(in_array('Tpat.22-1-0-0', $p_stn))
{
	$Pt22="Tpat.22";
	 $_stn = $_call->get_stn($Pt22);
  $_namec22 = $_stn[0]['code'];
  $ns = explode(".", $Pt22);
  $_nrow22=$ns[0].$ns[1];
  $chcount++;
  $cnumPt22=$chcount;
}
if(in_array('Tpat.23-1-0-0', $p_stn))
{
	$Pt23="Tpat.23";
	 $_stn = $_call->get_stn($Pt23);
  $_namec23 = $_stn[0]['code'];
  $ns = explode(".", $Pt23);
  $_nrow23=$ns[0].$ns[1];
  $chcount++;
  $cnumPt23=$chcount;
}
if(in_array('Tpat.24-1-0-0', $p_stn))
{
	$Pt24="Tpat.24";
	 $_stn = $_call->get_stn($Pt24);
  $_namec24 = $_stn[0]['code'];
  $ns = explode(".", $Pt24);
  $_nrow24=$ns[0].$ns[1];
  $chcount++;
  $cnumPt24=$chcount;
}
if(in_array('Tpat.25-1-1-0', $p_stn))
{
	$Pt25="Tpat.25";
	 $_stn = $_call->get_stn($Pt25);
  $_namec25 = $_stn[0]['code'];
  $ns = explode(".", $Pt25);
  $_nrow25=$ns[0].$ns[1];
  $chcount++;
  $cnumPt25=$chcount;
}
if(in_array('Tpat.26-1-1-0', $p_stn))
{
	$Pt26="Tpat.26";
	$_stn = $_call->get_stn($Pt26);
  $_namec26 = $_stn[0]['code'];
  $ns = explode(".", $Pt26);
  $_nrow26=$ns[0].$ns[1];
  $chcount++;
  $cnumPt26=$chcount;
}



if($p_rain=="Y")
{
	$nametype="กราฟ".$_cfg_data_type["rf"][0]; 
	$yname=$_cfg_data_type["rf"][1];
	$yaname=$_cfg_data_type["rf"][0]." ".$_cfg_data_type["rf"][1];
	$typess="column";
	$minva=0;
	$maxva=100;
    
	if($p_format=="f_15")
	{
		
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
				}
				
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY CONVERT(varchar(16),DT,121)	ORDER BY CONVERT(varchar(16),DT,121)";
		

		$result = odbc_exec($conn,$strQuery);
		//$checkrow=mssql_num_rows($result);

		$stagearray=array();
		$wt_pt1=array();
		$wt_pt2=array();
		$wt_pt3=array();
		$wt_pt4=array();
		$wt_pt5=array();
		$wt_pt6=array();
		$wt_pt7=array();
		$wt_pt8=array();
		$wt_pt9=array();
		$wt_pt10=array();
		$wt_pt11=array();
		$wt_pt12=array();	
		$wt_pt13=array();
		$wt_pt14=array();
		$wt_pt15=array();
		$wt_pt16=array();
		$wt_pt17=array();
		$wt_pt18=array();
		$wt_pt19=array();
		$wt_pt20=array();
		$wt_pt21=array();
		$wt_pt22=array();
		$wt_pt23=array();
		$wt_pt24=array();
		$wt_pt25=array();
		$wt_pt26=array();
		
				$stadatey=date("Y",strtotime($p_day1));	
				$stadatem=date("m",strtotime($p_day1));	
				$stadated=date("d",strtotime($p_day1));

				$stadateh=date("H",strtotime($p_day1));
				$stadatei=date("i",strtotime($p_day1));
						
				$sm=$stadatey."-".$stadatem;
				
				if ($p_format=="f_15")
				{
					$stadate=strtotime($p_day1);
					$enddate=strtotime($p_day2)+86400;
				}
				else{}
		
				while($stadate < $enddate)
				{

					if ($row = odbc_fetch_array($result))
					{
						
						$sname=strtotime($row['adate']);
						
						while($stadate < $sname)
						{
							if(isset($Pt1))
							{ 
								array_push($wt_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt2))
							{ 
								array_push($wt_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt3))
							{ 
								array_push($wt_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt4))
							{ 
								array_push($wt_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt5))
							{ 
								array_push($wt_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt6))
							{ 
								array_push($wt_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt7))
							{ 
								array_push($wt_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt8))
							{ 
								array_push($wt_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt9))
							{ 
								array_push($wt_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt10))
							{ 
								array_push($wt_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt11))
							{ 
								array_push($wt_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt12))
							{ 
								array_push($wt_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt13))
							{ 
								array_push($wt_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt14))
							{ 
								array_push($wt_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt15))
							{ 
								array_push($wt_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt16))
							{ 
								array_push($wt_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt17))
							{ 
								array_push($wt_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt18))
							{ 
								array_push($wt_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt19))
							{ 
								array_push($wt_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt20))
							{ 
								array_push($wt_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt21))
							{ 
								array_push($wt_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt22))
							{ 
								array_push($wt_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt23))
							{ 
								array_push($wt_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt24))
							{ 
								array_push($wt_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt25))
							{ 
								array_push($wt_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt26))
							{ 
								array_push($wt_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}

							if ($p_format=="f_15")
							{
								$stadatei+=$a;
								$stadate+=$a*60;
							}
						
						}

						if(isset($Pt1))
						{ 
							if($row['RF_'.$_nrow1.'']==null){$val_pt1="null";}else{$val_pt1=$row['RF_'.$_nrow1.''];}
							array_push($wt_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt1."]");
						}
						if(isset($Pt2))
						{ 
							if($row['RF_'.$_nrow2.'']==null){$val_pt2="null";}else{$val_pt2=$row['RF_'.$_nrow2.''];}
							array_push($wt_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt2."]");
						}
						if(isset($Pt3))
						{ 
							if($row['RF_'.$_nrow3.'']==null){$val_pt3="null";}else{$val_pt3=$row['RF_'.$_nrow3.''];}
							array_push($wt_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt3."]");
						}
						if(isset($Pt4))
						{ 
							if($row['RF_'.$_nrow4.'']==null){$val_pt4="null";}else{$val_pt4=$row['RF_'.$_nrow4.''];}
							array_push($wt_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt4."]");
						}
						if(isset($Pt5))
						{ 
							if($row['RF_'.$_nrow5.'']==null){$val_pt5="null";}else{$val_pt5=$row['RF_'.$_nrow5.''];}
							array_push($wt_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt5."]");
						}
						if(isset($Pt6))
						{ 
							if($row['RF_'.$_nrow6.'']==null){$val_pt6="null";}else{$val_pt6=$row['RF_'.$_nrow6.''];}
							array_push($wt_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt6."]");
						}
						if(isset($Pt7))
						{ 
							if($row['RF_'.$_nrow7.'']==null){$val_pt7="null";}else{$val_pt7=$row['RF_'.$_nrow7.''];}
							array_push($wt_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt7."]");
						}
						if(isset($Pt8))
						{ 
							if($row['RF_'.$_nrow8.'']==null){$val_pt8="null";}else{$val_pt8=$row['RF_'.$_nrow8.''];}
							array_push($wt_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt8."]");
						}
						if(isset($Pt9))
						{ 
							if($row['RF_'.$_nrow9.'']==null){$val_pt9="null";}else{$val_pt9=$row['RF_'.$_nrow9.''];}
							array_push($wt_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt9."]");
						}
						if(isset($Pt10))
						{ 
							if($row['RF_'.$_nrow10.'']==null){$val_pt10="null";}else{$val_pt10=$row['RF_'.$_nrow10.''];}
							array_push($wt_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt10."]");
						}
						if(isset($Pt11))
						{ 
							if($row['RF_'.$_nrow11.'']==null){$val_pt11="null";}else{$val_pt11=$row['RF_'.$_nrow11.''];}
							array_push($wt_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt11."]");
						}
						if(isset($Pt12))
						{ 
							if($row['RF_'.$_nrow12.'']==null){$val_pt12="null";}else{$val_pt12=$row['RF_'.$_nrow12.''];}
							array_push($wt_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12."]");
						}
						if(isset($Pt13))
						{ 
							if($row['RF_'.$_nrow13.'']==null){$val_pt13="null";}else{$val_pt13=$row['RF_'.$_nrow13.''];}
							array_push($wt_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt13."]");
						}
						if(isset($Pt14))
						{ 
							if($row['RF_'.$_nrow14.'']==null){$val_pt14="null";}else{$val_pt14=$row['RF_'.$_nrow14.''];}
							array_push($wt_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt14."]");
						}
						if(isset($Pt15))
						{ 
							if($row['RF_'.$_nrow15.'']==null){$val_pt15="null";}else{$val_pt15=$row['RF_'.$_nrow15.''];}
							array_push($wt_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt15."]");
						}
						if(isset($Pt16))
						{ 
							if($row['RF_'.$_nrow16.'']==null){$val_pt16="null";}else{$val_pt16=$row['RF_'.$_nrow16.''];}
							array_push($wt_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt16."]");
						}
						if(isset($Pt17))
						{ 
							if($row['RF_'.$_nrow17.'']==null){$val_pt17="null";}else{$val_pt17=$row['RF_'.$_nrow17.''];}
							array_push($wt_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt17."]");
						}
						if(isset($Pt18))
						{ 
							if($row['RF_'.$_nrow18.'']==null){$val_pt18="null";}else{$val_pt18=$row['RF_'.$_nrow18.''];}
							array_push($wt_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt18."]");
						}
						if(isset($Pt19))
						{ 
							if($row['RF_'.$_nrow19.'']==null){$val_pt19="null";}else{$val_pt19=$row['RF_'.$_nrow19.''];}
							array_push($wt_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt19."]");
						}
						if(isset($Pt20))
						{ 
							if($row['RF_'.$_nrow20.'']==null){$val_pt20="null";}else{$val_pt20=$row['RF_'.$_nrow20.''];}
							array_push($wt_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt20."]");
						}
						if(isset($Pt21))
						{ 
							if($row['RF_'.$_nrow21.'']==null){$val_pt21="null";}else{$val_pt21=$row['RF_'.$_nrow21.''];}
							array_push($wt_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt21."]");
						}
						if(isset($Pt22))
						{ 
							if($row['RF_'.$_nrow22.'']==null){$val_pt22="null";}else{$val_pt22=$row['RF_'.$_nrow22.''];}
							array_push($wt_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt22."]");
						}
						if(isset($Pt23))
						{ 
							if($row['RF_'.$_nrow23.'']==null){$val_pt23="null";}else{$val_pt23=$row['RF_'.$_nrow23.''];}
							array_push($wt_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt23."]");
						}
						if(isset($Pt24))
						{ 
							if($row['RF_'.$_nrow24.'']==null){$val_pt24="null";}else{$val_pt24=$row['RF_'.$_nrow24.''];}
							array_push($wt_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt24."]");
						}
						if(isset($Pt25))
						{ 
							if($row['RF_'.$_nrow25.'']==null){$val_pt25="null";}else{$val_pt25=$row['RF_'.$_nrow25.''];}
							array_push($wt_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt25."]");
						}
						if(isset($Pt26))
						{ 
							if($row['RF_'.$_nrow26.'']==null){$val_pt26="null";}else{$val_pt26=$row['RF_'.$_nrow26.''];}
							array_push($wt_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt26."]");
						}

						if ($p_format=="f_15")
						{
							$stadatei+=$a;
							$stadate+=$a*60;
						}
					
					}
					else
					{
						if(isset($Pt1))
							{ 
								array_push($wt_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt2))
							{ 
								array_push($wt_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt3))
							{ 
								array_push($wt_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt4))
							{ 
								array_push($wt_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt5))
							{ 
								array_push($wt_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt6))
							{ 
								array_push($wt_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt7))
							{ 
								array_push($wt_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt8))
							{ 
								array_push($wt_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt9))
							{ 
								array_push($wt_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt10))
							{ 
								array_push($wt_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt11))
							{ 
								array_push($wt_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt12))
							{ 
								array_push($wt_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt13))
							{ 
								array_push($wt_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt14))
							{ 
								array_push($wt_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt15))
							{ 
								array_push($wt_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt16))
							{ 
								array_push($wt_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt17))
							{ 
								array_push($wt_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt18))
							{ 
								array_push($wt_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt19))
							{ 
								array_push($wt_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt20))
							{ 
								array_push($wt_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt21))
							{ 
								array_push($wt_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt22))
							{ 
								array_push($wt_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt23))
							{ 
								array_push($wt_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt24))
							{ 
								array_push($wt_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt25))
							{ 
								array_push($wt_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt26))
							{ 
								array_push($wt_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}

							if ($p_format=="f_15")
							{
								$stadatei+=$a;
								$stadate+=$a*60;
							}						
					}
				}
				
				if(isset($Pt1))
				{ 
					$ponts_Pt1=implode(",",$wt_pt1);
				}
				if(isset($Pt2))
				{ 
					$ponts_Pt2=implode(",",$wt_pt2);
				}
				if(isset($Pt3))
				{ 
					$ponts_Pt3=implode(",",$wt_pt3);
				}
				if(isset($Pt4))
				{ 
					$ponts_Pt4=implode(",",$wt_pt4);
				}
				if(isset($Pt5))
				{ 
					$ponts_Pt5=implode(",",$wt_pt5);
				}
				if(isset($Pt6))
				{ 
					$ponts_Pt6=implode(",",$wt_pt6);
				}
				if(isset($Pt7))
				{ 
					$ponts_Pt7=implode(",",$wt_pt7);
				}
				if(isset($Pt8))
				{ 
					$ponts_Pt8=implode(",",$wt_pt8);
				}
				if(isset($Pt9))
				{ 
					$ponts_Pt9=implode(",",$wt_pt9);
				}
				if(isset($Pt10))
				{ 
					$ponts_Pt10=implode(",",$wt_pt10);
				}
				if(isset($Pt11))
				{ 
					$ponts_Pt11=implode(",",$wt_pt11);
				}
				if(isset($Pt12))
				{ 
					$ponts_Pt12=implode(",",$wt_pt12);
				}
				if(isset($Pt13))
				{ 
					$ponts_Pt13=implode(",",$wt_pt13);
				}
				if(isset($Pt14))
				{ 
					$ponts_Pt14=implode(",",$wt_pt14);
				}
				if(isset($Pt15))
				{ 
					$ponts_Pt15=implode(",",$wt_pt15);
				}
				if(isset($Pt16))
				{ 
					$ponts_Pt16=implode(",",$wt_pt16);
				}
				if(isset($Pt17))
				{ 
					$ponts_Pt17=implode(",",$wt_pt17);
				}
				if(isset($Pt18))
				{ 
					$ponts_Pt18=implode(",",$wt_pt18);
				}
				if(isset($Pt19))
				{ 
					$ponts_Pt19=implode(",",$wt_pt19);
				}
				if(isset($Pt20))
				{ 
					$ponts_Pt20=implode(",",$wt_pt20);
				}
				if(isset($Pt21))
				{ 
					$ponts_Pt21=implode(",",$wt_pt21);
				}
				if(isset($Pt22))
				{ 
					$ponts_Pt22=implode(",",$wt_pt22);
				}
				if(isset($Pt23))
				{ 
					$ponts_Pt23=implode(",",$wt_pt23);
				}
				if(isset($Pt24))
				{ 
					$ponts_Pt24=implode(",",$wt_pt24);
				}
				if(isset($Pt25))
				{ 
					$ponts_Pt25=implode(",",$wt_pt25);
				}
				if(isset($Pt26))
				{ 
					$ponts_Pt26=implode(",",$wt_pt26);
				}

			  if(isset($Pt1))
			   {
						 $se_Pt1='
								{
								type: "column",
								name: "'.$_namec1.'",
								data: ['.$ponts_Pt1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Pt2))
			   {
						 $se_Pt2='
								{
								type: "column",
								name: "'.$_namec2.'",
								data: ['.$ponts_Pt2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt3))
			   {
						 $se_Pt3='
								{
								type: "column",
								name: "'.$_namec3.'",
								data: ['.$ponts_Pt3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt4))
			   {
						 $se_Pt4='
								{
								type: "column",
								name: "'.$_namec4.'",
								data: ['.$ponts_Pt4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt5))
			   {
						 $se_Pt5='
								{
								type: "column",
								name: "'.$_namec5.'",
								data: ['.$ponts_Pt5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt6))
			   {
						 $se_Pt6='
								{
								type: "column",
								name: "'.$_namec6.'",
								data: ['.$ponts_Pt6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt7))
			   {
						 $se_Pt7='
								{
								type: "column",
								name: "'.$_namec7.'",
								data: ['.$ponts_Pt7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt8))
			   {
						 $se_Pt8='
								{
								type: "column",
								name: "'.$_namec8.'",
								data: ['.$ponts_Pt8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt9))
			   {
						 $se_Pt9='
								{
								type: "column",
								name: "'.$_namec9.'",
								data: ['.$ponts_Pt9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt10))
			   {
						 $se_Pt10='
								{
								type: "column",
								name: "'.$_namec10.'",
								data: ['.$ponts_Pt10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt11))
			   {
						 $se_Pt11='
								{
								type: "column",
								name: "'.$_namec11.'",
								data: ['.$ponts_Pt11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt12))
			   {
						 $se_Pt12='
								{
								type: "column",
								name: "'.$_namec12.'",
								data: ['.$ponts_Pt12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt13))
			   {
						 $se_Pt13='
								{
								type: "column",
								name: "'.$_namec13.'",
								data: ['.$ponts_Pt13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt14))
			   {
						 $se_Pt14='
								{
								type: "column",
								name: "'.$_namec14.'",
								data: ['.$ponts_Pt14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt15))
			   {
						 $se_Pt15='
								{
								type: "column",
								name: "'.$_namec15.'",
								data: ['.$ponts_Pt15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt16))
			   {
						 $se_Pt16='
								{
								type: "column",
								name: "'.$_namec16.'",
								data: ['.$ponts_Pt16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt17))
			   {
						 $se_Pt17='
								{
								type: "column",
								name: "'.$_namec17.'",
								data: ['.$ponts_Pt17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt18))
			   {
						 $se_Pt18='
								{
								type: "column",
								name: "'.$_namec18.'",
								data: ['.$ponts_Pt18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt19))
			   {
						 $se_Pt19='
								{
								type: "column",
								name: "'.$_namec19.'",
								data: ['.$ponts_Pt19.'],
								color: "#00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt20))
			   {
						 $se_Pt20='
								{
								type: "column",
								name: "'.$_namec20.'",
								data: ['.$ponts_Pt20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt21))
			   {
						 $se_Pt21='
								{
								type: "column",
								name: "'.$_namec21.'",
								data: ['.$ponts_Pt21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt22))
			   {
						 $se_Pt22='
								{
								type: "column",
								name: "'.$_namec22.'",
								data: ['.$ponts_Pt22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt23))
			   {
						 $se_Pt23='
								{
								type: "column",
								name: "'.$_namec23.'",
								data: ['.$ponts_Pt23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt24))
			   {
						 $se_Pt24='
								{
								type: "column",
								name: "'.$_namec24.'",
								data: ['.$ponts_Pt24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt25))
			   {
						 $se_Pt25='
								{
								type: "column",
								name: "'.$_namec25.'",
								data: ['.$ponts_Pt25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt26))
			   {
						 $se_Pt26='
								{
								type: "column",
								name: "'.$_namec26.'",
								data: ['.$ponts_Pt26.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}

	}
	else if($p_format=="f_hr")
	{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=60;
			$b=3600;


			$start = strtotime($p_day1);
			$end = strtotime($p_day2)+86400;

			$wt_pt1=array();
			$wt_pt2=array();
			$wt_pt3=array();
			$wt_pt4=array();
			$wt_pt5=array();
			$wt_pt6=array();
			$wt_pt7=array();
			$wt_pt8=array();
			$wt_pt9=array();
			$wt_pt10=array();
			$wt_pt11=array();
			$wt_pt12=array();	
			$wt_pt13=array();
			$wt_pt14=array();
			$wt_pt15=array();
			$wt_pt16=array();
			$wt_pt17=array();
			$wt_pt18=array();
			$wt_pt19=array();
			$wt_pt20=array();
			$wt_pt21=array();
			$wt_pt22=array();
			$wt_pt23=array();
			$wt_pt24=array();
			$wt_pt25=array();
			$wt_pt26=array();

			for ( $tt = $start; $tt <= $end; $tt += 3600 )
			{	
				$dt=date("Y-m-d H:i",$tt);

				$starhour=date("Y-m-d H:15",strtotime('-1 hour',strtotime($dt)));
				$endhour=date("Y-m-d H:00",strtotime($dt));

				//echo $starhour."<BR>";
				//echo $endhour."<BR>";

				$sumrain = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$sumrain .=" ,CONVERT(decimal(38,2),SUM(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end)) vhour_".$nname." ";
				}					
				$sumrain .="FROM [dbo].[DATA_Backup] WHERE CONVERT(varchar(16),DT,121) between '".$starhour."' and '".$endhour."'";
					
				//echo $sumrain;
				$sumrf =odbc_exec($conn,$sumrain);
				
				//echo $dt."_";
				//echo $row['vhour_'.$_nrow2.'']."<BR>";
				
				$stadatey=date("Y",strtotime($dt));	
				$stadatem=date("m",strtotime($dt));	
				$stadated=date("d",strtotime($dt));
				$stadateh=date("H",strtotime($dt));
				$stadatei=date("i",strtotime($dt));
						
				$sm=$stadatey."-".$stadatem;

				$row=odbc_fetch_array($sumrf);

				if(isset($Pt1))
				{ 
					if($row['vhour_'.$_nrow1.'']==null){$val_pt1="null";}else{$val_pt1=$row['vhour_'.$_nrow1.''];}
					array_push($wt_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt1."]");
				}
				if(isset($Pt2))
				{ 
					if($row['vhour_'.$_nrow2.'']==null){$val_pt2="null";}else{$val_pt2=$row['vhour_'.$_nrow2.''];}
					array_push($wt_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt2."]");
				}
				if(isset($Pt3))
				{ 
					if($row['vhour_'.$_nrow3.'']==null){$val_pt3="null";}else{$val_pt3=$row['vhour_'.$_nrow3.''];}
					array_push($wt_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt3."]");
				}
				if(isset($Pt4))
				{ 
					if($row['vhour_'.$_nrow4.'']==null){$val_pt4="null";}else{$val_pt4=$row['vhour_'.$_nrow4.''];}
					array_push($wt_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt4."]");
				}
				if(isset($Pt5))
				{ 
					if($row['vhour_'.$_nrow5.'']==null){$val_pt5="null";}else{$val_pt5=$row['vhour_'.$_nrow5.''];}
					array_push($wt_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt5."]");
				}
				if(isset($Pt6))
				{ 
					if($row['vhour_'.$_nrow6.'']==null){$val_pt6="null";}else{$val_pt6=$row['vhour_'.$_nrow6.''];}
					array_push($wt_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt6."]");
				}
				if(isset($Pt7))
				{ 
					if($row['vhour_'.$_nrow7.'']==null){$val_pt7="null";}else{$val_pt7=$row['vhour_'.$_nrow7.''];}
					array_push($wt_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt7."]");
				}
				if(isset($Pt8))
				{ 
					if($row['vhour_'.$_nrow8.'']==null){$val_pt8="null";}else{$val_pt8=$row['vhour_'.$_nrow8.''];}
					array_push($wt_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt8."]");
				}
				if(isset($Pt9))
				{ 
					if($row['vhour_'.$_nrow9.'']==null){$val_pt9="null";}else{$val_pt9=$row['vhour_'.$_nrow9.''];}
					array_push($wt_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt9."]");
				}
				if(isset($Pt10))
				{ 
					if($row['vhour_'.$_nrow10.'']==null){$val_pt10="null";}else{$val_pt10=$row['vhour_'.$_nrow10.''];}
					array_push($wt_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt10."]");
				}
				if(isset($Pt11))
				{ 
					if($row['vhour_'.$_nrow11.'']==null){$val_pt11="null";}else{$val_pt11=$row['vhour_'.$_nrow11.''];}
					array_push($wt_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt11."]");
				}
				if(isset($Pt12))
				{ 
					if($row['vhour_'.$_nrow12.'']==null){$val_pt12="null";}else{$val_pt12=$row['vhour_'.$_nrow12.''];}
					array_push($wt_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12."]");
				}
				if(isset($Pt13))
				{ 
					if($row['vhour_'.$_nrow13.'']==null){$val_pt13="null";}else{$val_pt13=$row['vhour_'.$_nrow13.''];}
					array_push($wt_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt13."]");
				}
				if(isset($Pt14))
				{ 
					if($row['vhour_'.$_nrow14.'']==null){$val_pt14="null";}else{$val_pt14=$row['vhour_'.$_nrow14.''];}
					array_push($wt_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt14."]");
				}
				if(isset($Pt15))
				{ 
					if($row['vhour_'.$_nrow15.'']==null){$val_pt15="null";}else{$val_pt15=$row['vhour_'.$_nrow15.''];}
					array_push($wt_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt15."]");
				}
				if(isset($Pt16))
				{ 
					if($row['vhour_'.$_nrow16.'']==null){$val_pt16="null";}else{$val_pt16=$row['vhour_'.$_nrow16.''];}
					array_push($wt_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt16."]");
				}
				if(isset($Pt17))
				{ 
					if($row['vhour_'.$_nrow17.'']==null){$val_pt17="null";}else{$val_pt17=$row['vhour_'.$_nrow17.''];}
					array_push($wt_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt17."]");
				}
				if(isset($Pt18))
				{ 
					if($row['vhour_'.$_nrow18.'']==null){$val_pt18="null";}else{$val_pt18=$row['vhour_'.$_nrow18.''];}
					array_push($wt_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt18."]");
				}
				if(isset($Pt19))
				{ 
					if($row['vhour_'.$_nrow19.'']==null){$val_pt19="null";}else{$val_pt19=$row['vhour_'.$_nrow19.''];}
					array_push($wt_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt19."]");
				}
				if(isset($Pt20))
				{ 
					if($row['vhour_'.$_nrow20.'']==null){$val_pt20="null";}else{$val_pt20=$row['vhour_'.$_nrow20.''];}
					array_push($wt_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt20."]");
				}
				if(isset($Pt21))
				{ 
					if($row['vhour_'.$_nrow21.'']==null){$val_pt21="null";}else{$val_pt21=$row['vhour_'.$_nrow21.''];}
					array_push($wt_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt21."]");
				}
				if(isset($Pt22))
				{ 
					if($row['vhour_'.$_nrow22.'']==null){$val_pt22="null";}else{$val_pt22=$row['vhour_'.$_nrow22.''];}
					array_push($wt_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt22."]");
				}
				if(isset($Pt23))
				{ 
					if($row['vhour_'.$_nrow23.'']==null){$val_pt23="null";}else{$val_pt23=$row['vhour_'.$_nrow23.''];}
					array_push($wt_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt23."]");
				}
				if(isset($Pt24))
				{ 
					if($row['vhour_'.$_nrow24.'']==null){$val_pt24="null";}else{$val_pt24=$row['vhour_'.$_nrow24.''];}
					array_push($wt_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt24."]");
				}
				if(isset($Pt25))
				{ 
					if($row['vhour_'.$_nrow25.'']==null){$val_pt25="null";}else{$val_pt25=$row['vhour_'.$_nrow25.''];}
					array_push($wt_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt25."]");
				}
				if(isset($Pt26))
				{ 
					if($row['vhour_'.$_nrow26.'']==null){$val_pt26="null";}else{$val_pt26=$row['vhour_'.$_nrow26.''];}
					array_push($wt_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt26."]");
				}
			}//for
			
				if(isset($Pt1))
				{ 
					$ponts_Pt1=implode(",",$wt_pt1);
				}
				if(isset($Pt2))
				{ 
					$ponts_Pt2=implode(",",$wt_pt2);
				}
				if(isset($Pt3))
				{ 
					$ponts_Pt3=implode(",",$wt_pt3);
				}
				if(isset($Pt4))
				{ 
					$ponts_Pt4=implode(",",$wt_pt4);
				}
				if(isset($Pt5))
				{ 
					$ponts_Pt5=implode(",",$wt_pt5);
				}
				if(isset($Pt6))
				{ 
					$ponts_Pt6=implode(",",$wt_pt6);
				}
				if(isset($Pt7))
				{ 
					$ponts_Pt7=implode(",",$wt_pt7);
				}
				if(isset($Pt8))
				{ 
					$ponts_Pt8=implode(",",$wt_pt8);
				}
				if(isset($Pt9))
				{ 
					$ponts_Pt9=implode(",",$wt_pt9);
				}
				if(isset($Pt10))
				{ 
					$ponts_Pt10=implode(",",$wt_pt10);
				}
				if(isset($Pt11))
				{ 
					$ponts_Pt11=implode(",",$wt_pt11);
				}
				if(isset($Pt12))
				{ 
					$ponts_Pt12=implode(",",$wt_pt12);
				}
				if(isset($Pt13))
				{ 
					$ponts_Pt13=implode(",",$wt_pt13);
				}
				if(isset($Pt14))
				{ 
					$ponts_Pt14=implode(",",$wt_pt14);
				}
				if(isset($Pt15))
				{ 
					$ponts_Pt15=implode(",",$wt_pt15);
				}
				if(isset($Pt16))
				{ 
					$ponts_Pt16=implode(",",$wt_pt16);
				}
				if(isset($Pt17))
				{ 
					$ponts_Pt17=implode(",",$wt_pt17);
				}
				if(isset($Pt18))
				{ 
					$ponts_Pt18=implode(",",$wt_pt18);
				}
				if(isset($Pt19))
				{ 
					$ponts_Pt19=implode(",",$wt_pt19);
				}
				if(isset($Pt20))
				{ 
					$ponts_Pt20=implode(",",$wt_pt20);
				}
				if(isset($Pt21))
				{ 
					$ponts_Pt21=implode(",",$wt_pt21);
				}
				if(isset($Pt22))
				{ 
					$ponts_Pt22=implode(",",$wt_pt22);
				}
				if(isset($Pt23))
				{ 
					$ponts_Pt23=implode(",",$wt_pt23);
				}
				if(isset($Pt24))
				{ 
					$ponts_Pt24=implode(",",$wt_pt24);
				}
				if(isset($Pt25))
				{ 
					$ponts_Pt25=implode(",",$wt_pt25);
				}
				if(isset($Pt26))
				{ 
					$ponts_Pt26=implode(",",$wt_pt26);
				}

			   if(isset($Pt1))
			   {
						 $se_Pt1='
								{
								type: "column",
								name: "'.$_namec1.'",
								data: ['.$ponts_Pt1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Pt2))
			   {
						 $se_Pt2='
								{
								type: "column",
								name: "'.$_namec2.'",
								data: ['.$ponts_Pt2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt3))
			   {
						 $se_Pt3='
								{
								type: "column",
								name: "'.$_namec3.'",
								data: ['.$ponts_Pt3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt4))
			   {
						 $se_Pt4='
								{
								type: "column",
								name: "'.$_namec4.'",
								data: ['.$ponts_Pt4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt5))
			   {
						 $se_Pt5='
								{
								type: "column",
								name: "'.$_namec5.'",
								data: ['.$ponts_Pt5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt6))
			   {
						 $se_Pt6='
								{
								type: "column",
								name: "'.$_namec6.'",
								data: ['.$ponts_Pt6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt7))
			   {
						 $se_Pt7='
								{
								type: "column",
								name: "'.$_namec7.'",
								data: ['.$ponts_Pt7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt8))
			   {
						 $se_Pt8='
								{
								type: "column",
								name: "'.$_namec8.'",
								data: ['.$ponts_Pt8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt9))
			   {
						 $se_Pt9='
								{
								type: "column",
								name: "'.$_namec9.'",
								data: ['.$ponts_Pt9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt10))
			   {
						 $se_Pt10='
								{
								type: "column",
								name: "'.$_namec10.'",
								data: ['.$ponts_Pt10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt11))
			   {
						 $se_Pt11='
								{
								type: "column",
								name: "'.$_namec11.'",
								data: ['.$ponts_Pt11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt12))
			   {
						 $se_Pt12='
								{
								type: "column",
								name: "'.$_namec12.'",
								data: ['.$ponts_Pt12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt13))
			   {
						 $se_Pt13='
								{
								type: "column",
								name: "'.$_namec13.'",
								data: ['.$ponts_Pt13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt14))
			   {
						 $se_Pt14='
								{
								type: "column",
								name: "'.$_namec14.'",
								data: ['.$ponts_Pt14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt15))
			   {
						 $se_Pt15='
								{
								type: "column",
								name: "'.$_namec15.'",
								data: ['.$ponts_Pt15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt16))
			   {
						 $se_Pt16='
								{
								type: "column",
								name: "'.$_namec16.'",
								data: ['.$ponts_Pt16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt17))
			   {
						 $se_Pt17='
								{
								type: "column",
								name: "'.$_namec17.'",
								data: ['.$ponts_Pt17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt18))
			   {
						 $se_Pt18='
								{
								type: "column",
								name: "'.$_namec18.'",
								data: ['.$ponts_Pt18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt19))
			   {
						 $se_Pt19='
								{
								type: "column",
								name: "'.$_namec19.'",
								data: ['.$ponts_Pt19.'],
								color: "#00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt20))
			   {
						 $se_Pt20='
								{
								type: "column",
								name: "'.$_namec20.'",
								data: ['.$ponts_Pt20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt21))
			   {
						 $se_Pt21='
								{
								type: "column",
								name: "'.$_namec21.'",
								data: ['.$ponts_Pt21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt22))
			   {
						 $se_Pt22='
								{
								type: "column",
								name: "'.$_namec22.'",
								data: ['.$ponts_Pt22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt23))
			   {
						 $se_Pt23='
								{
								type: "column",
								name: "'.$_namec23.'",
								data: ['.$ponts_Pt23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt24))
			   {
						 $se_Pt24='
								{
								type: "column",
								name: "'.$_namec24.'",
								data: ['.$ponts_Pt24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt25))
			   {
						 $se_Pt25='
								{
								type: "column",
								name: "'.$_namec25.'",
								data: ['.$ponts_Pt25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt26))
			   {
						 $se_Pt26='
								{
								type: "column",
								name: "'.$_namec26.'",
								data: ['.$ponts_Pt26.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
	}
	else
	{

			$p_date=date("Y-m-d 07:00",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn=  24 * 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=1440;
			$b=86400;

			$start = strtotime($p_day1);
			$end = strtotime($p_day2);
			$wt_pt1=array();
			$wt_pt2=array();
			$wt_pt3=array();
			$wt_pt4=array();
			$wt_pt5=array();
			$wt_pt6=array();
			$wt_pt7=array();
			$wt_pt8=array();
			$wt_pt9=array();
			$wt_pt10=array();
			$wt_pt11=array();
			$wt_pt12=array();	
			$wt_pt13=array();
			$wt_pt14=array();
			$wt_pt15=array();
			$wt_pt16=array();
			$wt_pt17=array();
			$wt_pt18=array();
			$wt_pt19=array();
			$wt_pt20=array();
			$wt_pt21=array();
			$wt_pt22=array();
			$wt_pt23=array();
			$wt_pt24=array();
			$wt_pt25=array();
			$wt_pt26=array();
			$stagearray=array();
			for ( $tt = $start; $tt <= $end; $tt += 86400 )
			{	
				$dt=date("Y-m-d",$tt);
				
				if($p_format=="f_mean")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,Sum(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_min")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,min(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_max")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,max(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				else{}
			
			    //echo $strQuery;
				$result = odbc_exec($conn,$strQuery);
				//$checkrow=odbc_num_rows($objExec);
				$date_now = $dt.' 07:00';
				

				$stadatey=date("Y",strtotime($date_now));	
				$stadatem=date("m",strtotime($date_now));	
				$stadated=date("d",strtotime($date_now));
				$stadateh=date("H",strtotime($date_now));
				$stadatei=date("i",strtotime($date_now));
						
				$sm=$stadatey."-".$stadatem;
				
				$stadate=strtotime($date_now);
				$enddate=strtotime($date_now)+86400;
				$row = odbc_fetch_array($result);
		
						if(isset($Pt1))
						{ 
							if($row['RF_'.$_nrow1.'']==null){$val_pt1="null";}else{$val_pt1=$row['RF_'.$_nrow1.''];}
							array_push($wt_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt1."]");
						}
						if(isset($Pt2))
						{ 
							if($row['RF_'.$_nrow2.'']==null){$val_pt2="null";}else{$val_pt2=$row['RF_'.$_nrow2.''];}
							array_push($wt_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt2."]");
						}
						if(isset($Pt3))
						{ 
							if($row['RF_'.$_nrow3.'']==null){$val_pt3="null";}else{$val_pt3=$row['RF_'.$_nrow3.''];}
							array_push($wt_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt3."]");
						}
						if(isset($Pt4))
						{ 
							if($row['RF_'.$_nrow4.'']==null){$val_pt4="null";}else{$val_pt4=$row['RF_'.$_nrow4.''];}
							array_push($wt_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt4."]");
						}
						if(isset($Pt5))
						{ 
							if($row['RF_'.$_nrow5.'']==null){$val_pt5="null";}else{$val_pt5=$row['RF_'.$_nrow5.''];}
							array_push($wt_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt5."]");
						}
						if(isset($Pt6))
						{ 
							if($row['RF_'.$_nrow6.'']==null){$val_pt6="null";}else{$val_pt6=$row['RF_'.$_nrow6.''];}
							array_push($wt_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt6."]");
						}
						if(isset($Pt7))
						{ 
							if($row['RF_'.$_nrow7.'']==null){$val_pt7="null";}else{$val_pt7=$row['RF_'.$_nrow7.''];}
							array_push($wt_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt7."]");
						}
						if(isset($Pt8))
						{ 
							if($row['RF_'.$_nrow8.'']==null){$val_pt8="null";}else{$val_pt8=$row['RF_'.$_nrow8.''];}
							array_push($wt_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt8."]");
						}
						if(isset($Pt9))
						{ 
							if($row['RF_'.$_nrow9.'']==null){$val_pt9="null";}else{$val_pt9=$row['RF_'.$_nrow9.''];}
							array_push($wt_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt9."]");
						}
						if(isset($Pt10))
						{ 
							if($row['RF_'.$_nrow10.'']==null){$val_pt10="null";}else{$val_pt10=$row['RF_'.$_nrow10.''];}
							array_push($wt_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt10."]");
						}
						if(isset($Pt11))
						{ 
							if($row['RF_'.$_nrow11.'']==null){$val_pt11="null";}else{$val_pt11=$row['RF_'.$_nrow11.''];}
							array_push($wt_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt11."]");
						}
						if(isset($Pt12))
						{ 
							if($row['RF_'.$_nrow12.'']==null){$val_pt12="null";}else{$val_pt12=$row['RF_'.$_nrow12.''];}
							array_push($wt_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12."]");
						}
						if(isset($Pt13))
						{ 
							if($row['RF_'.$_nrow13.'']==null){$val_pt13="null";}else{$val_pt13=$row['RF_'.$_nrow13.''];}
							array_push($wt_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt13."]");
						}
						if(isset($Pt14))
						{ 
							if($row['RF_'.$_nrow14.'']==null){$val_pt14="null";}else{$val_pt14=$row['RF_'.$_nrow14.''];}
							array_push($wt_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt14."]");
						}
						if(isset($Pt15))
						{ 
							if($row['RF_'.$_nrow15.'']==null){$val_pt15="null";}else{$val_pt15=$row['RF_'.$_nrow15.''];}
							array_push($wt_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt15."]");
						}
						if(isset($Pt16))
						{ 
							if($row['RF_'.$_nrow16.'']==null){$val_pt16="null";}else{$val_pt16=$row['RF_'.$_nrow16.''];}
							array_push($wt_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt16."]");
						}
						if(isset($Pt17))
						{ 
							if($row['RF_'.$_nrow17.'']==null){$val_pt17="null";}else{$val_pt17=$row['RF_'.$_nrow17.''];}
							array_push($wt_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt17."]");
						}
						if(isset($Pt18))
						{ 
							if($row['RF_'.$_nrow18.'']==null){$val_pt18="null";}else{$val_pt18=$row['RF_'.$_nrow18.''];}
							array_push($wt_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt18."]");
						}
						if(isset($Pt19))
						{ 
							if($row['RF_'.$_nrow19.'']==null){$val_pt19="null";}else{$val_pt19=$row['RF_'.$_nrow19.''];}
							array_push($wt_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt19."]");
						}
						if(isset($Pt20))
						{ 
							if($row['RF_'.$_nrow20.'']==null){$val_pt20="null";}else{$val_pt20=$row['RF_'.$_nrow20.''];}
							array_push($wt_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt20."]");
						}
						if(isset($Pt21))
						{ 
							if($row['RF_'.$_nrow21.'']==null){$val_pt21="null";}else{$val_pt21=$row['RF_'.$_nrow21.''];}
							array_push($wt_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt21."]");
						}
						if(isset($Pt22))
						{ 
							if($row['RF_'.$_nrow22.'']==null){$val_pt22="null";}else{$val_pt22=$row['RF_'.$_nrow22.''];}
							array_push($wt_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt22."]");
						}
						if(isset($Pt23))
						{ 
							if($row['RF_'.$_nrow23.'']==null){$val_pt23="null";}else{$val_pt23=$row['RF_'.$_nrow23.''];}
							array_push($wt_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt23."]");
						}
						if(isset($Pt24))
						{ 
							if($row['RF_'.$_nrow24.'']==null){$val_pt24="null";}else{$val_pt24=$row['RF_'.$_nrow24.''];}
							array_push($wt_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt24."]");
						}
						if(isset($Pt25))
						{ 
							if($row['RF_'.$_nrow25.'']==null){$val_pt25="null";}else{$val_pt25=$row['RF_'.$_nrow25.''];}
							array_push($wt_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt25."]");
						}
						if(isset($Pt26))
						{ 
							if($row['RF_'.$_nrow26.'']==null){$val_pt26="null";}else{$val_pt26=$row['RF_'.$_nrow26.''];}
							array_push($wt_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt26."]");
						}

			}
				if(isset($Pt1))
				{ 
					$ponts_Pt1=implode(",",$wt_pt1);
				}
				if(isset($Pt2))
				{ 
					$ponts_Pt2=implode(",",$wt_pt2);
				}
				if(isset($Pt3))
				{ 
					$ponts_Pt3=implode(",",$wt_pt3);
				}
				if(isset($Pt4))
				{ 
					$ponts_Pt4=implode(",",$wt_pt4);
				}
				if(isset($Pt5))
				{ 
					$ponts_Pt5=implode(",",$wt_pt5);
				}
				if(isset($Pt6))
				{ 
					$ponts_Pt6=implode(",",$wt_pt6);
				}
				if(isset($Pt7))
				{ 
					$ponts_Pt7=implode(",",$wt_pt7);
				}
				if(isset($Pt8))
				{ 
					$ponts_Pt8=implode(",",$wt_pt8);
				}
				if(isset($Pt9))
				{ 
					$ponts_Pt9=implode(",",$wt_pt9);
				}
				if(isset($Pt10))
				{ 
					$ponts_Pt10=implode(",",$wt_pt10);
				}
				if(isset($Pt11))
				{ 
					$ponts_Pt11=implode(",",$wt_pt11);
				}
				if(isset($Pt12))
				{ 
					$ponts_Pt12=implode(",",$wt_pt12);
				}
				if(isset($Pt13))
				{ 
					$ponts_Pt13=implode(",",$wt_pt13);
				}
				if(isset($Pt14))
				{ 
					$ponts_Pt14=implode(",",$wt_pt14);
				}
				if(isset($Pt15))
				{ 
					$ponts_Pt15=implode(",",$wt_pt15);
				}
				if(isset($Pt16))
				{ 
					$ponts_Pt16=implode(",",$wt_pt16);
				}
				if(isset($Pt17))
				{ 
					$ponts_Pt17=implode(",",$wt_pt17);
				}
				if(isset($Pt18))
				{ 
					$ponts_Pt18=implode(",",$wt_pt18);
				}
				if(isset($Pt19))
				{ 
					$ponts_Pt19=implode(",",$wt_pt19);
				}
				if(isset($Pt20))
				{ 
					$ponts_Pt20=implode(",",$wt_pt20);
				}
				if(isset($Pt21))
				{ 
					$ponts_Pt21=implode(",",$wt_pt21);
				}
				if(isset($Pt22))
				{ 
					$ponts_Pt22=implode(",",$wt_pt22);
				}
				if(isset($Pt23))
				{ 
					$ponts_Pt23=implode(",",$wt_pt23);
				}
				if(isset($Pt24))
				{ 
					$ponts_Pt24=implode(",",$wt_pt24);
				}
				if(isset($Pt25))
				{ 
					$ponts_Pt25=implode(",",$wt_pt25);
				}
				if(isset($Pt26))
				{ 
					$ponts_Pt26=implode(",",$wt_pt26);
				}

			   if(isset($Pt1))
			   {
						 $se_Pt1='
								{
								type: "column",
								name: "'.$_namec1.'",
								data: ['.$ponts_Pt1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Pt2))
			   {
						 $se_Pt2='
								{
								type: "column",
								name: "'.$_namec2.'",
								data: ['.$ponts_Pt2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt3))
			   {
						 $se_Pt3='
								{
								type: "column",
								name: "'.$_namec3.'",
								data: ['.$ponts_Pt3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt4))
			   {
						 $se_Pt4='
								{
								type: "column",
								name: "'.$_namec4.'",
								data: ['.$ponts_Pt4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt5))
			   {
						 $se_Pt5='
								{
								type: "column",
								name: "'.$_namec5.'",
								data: ['.$ponts_Pt5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt6))
			   {
						 $se_Pt6='
								{
								type: "column",
								name: "'.$_namec6.'",
								data: ['.$ponts_Pt6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt7))
			   {
						 $se_Pt7='
								{
								type: "column",
								name: "'.$_namec7.'",
								data: ['.$ponts_Pt7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt8))
			   {
						 $se_Pt8='
								{
								type: "column",
								name: "'.$_namec8.'",
								data: ['.$ponts_Pt8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt9))
			   {
						 $se_Pt9='
								{
								type: "column",
								name: "'.$_namec9.'",
								data: ['.$ponts_Pt9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt10))
			   {
						 $se_Pt10='
								{
								type: "column",
								name: "'.$_namec10.'",
								data: ['.$ponts_Pt10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt11))
			   {
						 $se_Pt11='
								{
								type: "column",
								name: "'.$_namec11.'",
								data: ['.$ponts_Pt11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt12))
			   {
						 $se_Pt12='
								{
								type: "column",
								name: "'.$_namec12.'",
								data: ['.$ponts_Pt12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt13))
			   {
						 $se_Pt13='
								{
								type: "column",
								name: "'.$_namec13.'",
								data: ['.$ponts_Pt13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt14))
			   {
						 $se_Pt14='
								{
								type: "column",
								name: "'.$_namec14.'",
								data: ['.$ponts_Pt14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt15))
			   {
						 $se_Pt15='
								{
								type: "column",
								name: "'.$_namec15.'",
								data: ['.$ponts_Pt15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt16))
			   {
						 $se_Pt16='
								{
								type: "column",
								name: "'.$_namec16.'",
								data: ['.$ponts_Pt16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt17))
			   {
						 $se_Pt17='
								{
								type: "column",
								name: "'.$_namec17.'",
								data: ['.$ponts_Pt17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt18))
			   {
						 $se_Pt18='
								{
								type: "column",
								name: "'.$_namec18.'",
								data: ['.$ponts_Pt18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt19))
			   {
						 $se_Pt19='
								{
								type: "column",
								name: "'.$_namec19.'",
								data: ['.$ponts_Pt19.'],
								color: "#00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt20))
			   {
						 $se_Pt20='
								{
								type: "column",
								name: "'.$_namec20.'",
								data: ['.$ponts_Pt20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt21))
			   {
						 $se_Pt21='
								{
								type: "column",
								name: "'.$_namec21.'",
								data: ['.$ponts_Pt21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt22))
			   {
						 $se_Pt22='
								{
								type: "column",
								name: "'.$_namec22.'",
								data: ['.$ponts_Pt22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt23))
			   {
						 $se_Pt23='
								{
								type: "column",
								name: "'.$_namec23.'",
								data: ['.$ponts_Pt23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt24))
			   {
						 $se_Pt24='
								{
								type: "column",
								name: "'.$_namec24.'",
								data: ['.$ponts_Pt24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt25))
			   {
						 $se_Pt25='
								{
								type: "column",
								name: "'.$_namec25.'",
								data: ['.$ponts_Pt25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt26))
			   {
						 $se_Pt26='
								{
								type: "column",
								name: "'.$_namec26.'",
								data: ['.$ponts_Pt26.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
	}
		?>
		<BR>
		<div id="graphRF" style="<?echo $st;?>"></div>
		<script type="text/javascript">
		//alert("aa");
		$(function () {
			var chart;
			$(document).ready(function() {
				Highcharts.setOptions({
				lang: {
					months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
			});
				chart = new Highcharts.Chart({
					chart: {
						zoomType: 'x',
						renderTo: 'graphRF',
						type: 'column',
						spacingLeft: 25 ,
						resetZoomButton: {
							position: {
							// align: 'right', // by default
							 // verticalAlign: 'top', // by default
							x: -30,
							y: -20
							}
						}
					},
					credits: {
					enabled: false
					},
					title: {
						text: '<? echo $nametype;?>',
					
					style: {
						fontSize: '14px'
					}
					},
					subtitle: {
						text: ''
					},
					xAxis: {
						type: 'datetime',
						//maxZoom: <? echo $maxZ;?>,
						minRange: '<? echo $a;?>' * 60 * 1000 * 6,
						minTickInterval: '<? echo $a;?>' * 60 * 1000,
						title: {
							text: null
						},
						labels:{
						rotation:-45,
						align:'right',
						fontSize: '8px'
							},
						dateTimeLabelFormats: {
						second: '%H:%M:%S',
						minute: '%H:%M',
						hour: '%H:%M',
						day: '%e %B %Y',
						week:'%e %B %Y',
						month:'%B %Y',
						year:'%Y'
					}
					},
					yAxis: {
						min: '<? echo $minva;?>',
						title: {
							text: '<? echo $yaname;?>'
						}
					},
					tooltip: {
						formatter: function() {
						return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+'  มม.';
					}
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0
						},
						series: {
						marker: {
							enabled:false,
							lineWidth: 0
						}
						}
						},
						scrollbar: {
						 enabled: true
						},
						series: [
							 <?php echo $se_Pt3?>
							 <?php echo $se_Pt4?>
							 <?php echo $se_Pt5?>
							
							 <?php echo $se_Pt8?>
							 <?php echo $se_Pt9?>
							 <?php echo $se_Pt10?>
							 <?php echo $se_Pt11?>
							
							 <?php echo $se_Pt13?>
							 <?php echo $se_Pt14?>
							 <?php echo $se_Pt15?>
							 <?php echo $se_Pt16?>
							 <?php echo $se_Pt17?>
							 <?php echo $se_Pt18?>
							 <?php echo $se_Pt19?>
							 <?php echo $se_Pt20?>
							 <?php echo $se_Pt21?>
							 <?php echo $se_Pt22?>
							 <?php echo $se_Pt23?>
							 <?php echo $se_Pt24?>
							 <?php echo $se_Pt25?>
							 <?php echo $se_Pt26?>
							]
						,
						exporting: {
					 url: 'http://telepattani.com/exporting_server/index.php'
				  }
				});
			});

		});
		</script>
		<?	
}

if($p_water=="Y")
{
	$nametype="กราฟ".$_cfg_data_type["wl"][0]; 
	$yname=$_cfg_data_type["wl"][1];
	$yaname=$_cfg_data_type["wl"][0]." ".$_cfg_data_type["wl"][1];
	$typess="line";
	$wlH="หน้า ปตร.";
	$wlL="ท้าย ปตร.";

    
	if($p_format=="f_15" || $p_format=="f_hr")
	{
		if($p_format=="f_15")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
				}
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
				}
							
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE 
					CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY 
						CONVERT(varchar(16),DT,121)
					ORDER BY 
						CONVERT(varchar(16),DT,121)	";
		}
		elseif($p_format=="f_hr")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=60;
			$b=3600;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";	
			foreach($p_stn as $id)
			{
				$_value = cut($id);
				$ssite = $_value[0];
				$nname = $_value[4];

				$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
			}
			foreach($p_stn as $id)
			{
				$_value = cut($id);
				$ssite = $_value[0];
				$nname = $_value[4];

				$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
			}				
			$strQuery .=" FROM [dbo].[DATA_Backup]
						WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:00' 
							AND (DATEPART(MINUTE ,DT))='00'
						GROUP BY 
							CONVERT(varchar(16),DT,121)
						ORDER BY 
							CONVERT(varchar(16),DT,121)	";
		}
		else{}

		$result = odbc_exec($conn,$strQuery);
		//$checkrow=mssql_num_rows($result);

		$stagearray=array();
		$wl_pt1=array();
		$wl_pt2=array();
		$wl_pt3=array();
		$wl_pt4=array();
		$wl_pt5=array();
		$wl_pt6=array();
		$wl_pt7=array();
		$wl_pt8=array();
		$wl_pt9=array();
		$wl_pt10=array();
		$wl_pt11=array();
		$wl_pt12=array();	
		$wl_pt12E=array();
		$wl_pt13=array();
		$wl_pt14=array();
		$wl_pt15=array();
		$wl_pt16=array();
		$wl_pt17=array();
		$wl_pt18=array();
		//$wl_pt18E=array();
		$wl_pt19=array();
		//$wl_pt19E=array();
		$wl_pt20=array();
		$wl_pt21=array();
		$wl_pt22=array();
		$wl_pt23=array();
		$wl_pt24=array();
		$wl_pt25=array();
		//$wl_pt25E=array();
		$wl_pt26=array();

				$stadatey=date("Y",strtotime($p_day1));	
				$stadatem=date("m",strtotime($p_day1));	
				$stadated=date("d",strtotime($p_day1));

				$stadateh=date("H",strtotime($p_day1));
				$stadatei=date("i",strtotime($p_day1));
						
				$sm=$stadatey."-".$stadatem;
				
				if ($p_format=="f_15" or $p_format=="f_hr")
				{
					$stadate=strtotime($p_day1);
					$enddate=strtotime($p_day2)+86400;
				}
				else{}
		
				while($stadate < $enddate)
				{

					if ($row = odbc_fetch_array($result))
					{
						
						$sname=strtotime($row['adate']);
						
						while($stadate < $sname)
						{
							if(isset($Pt1))
							{ 
								array_push($wl_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt2))
							{ 
								array_push($wl_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt3))
							{ 
								array_push($wl_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt4))
							{ 
								array_push($wl_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt5))
							{ 
								array_push($wl_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt6))
							{ 
								array_push($wl_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt7))
							{ 
								array_push($wl_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt8))
							{ 
								array_push($wl_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt9))
							{ 
								array_push($wl_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt10))
							{ 
								array_push($wl_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt11))
							{ 
								array_push($wl_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt12))
							{ 
								array_push($wl_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($wl_pt12E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt13))
							{ 
								array_push($wl_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt14))
							{ 
								array_push($wl_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt15))
							{ 
								array_push($wl_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt16))
							{ 
								array_push($wl_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt17))
							{ 
								array_push($wl_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt18))
							{ 
								array_push($wl_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt19))
							{ 
								array_push($wl_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt20))
							{ 
								array_push($wl_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt21))
							{ 
								array_push($wl_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt22))
							{ 
								array_push($wl_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt23))
							{ 
								array_push($wl_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt24))
							{ 
								array_push($wl_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt25))
							{ 
								array_push($wl_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt26))
							{ 
								array_push($wl_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}


							if ($p_format=="f_15" or $p_format=="f_hr")
							{
								$stadatei+=$a;
								$stadate+=$a*60;
							}
						
						}

						if(isset($Pt1))
						{ 
							if($row['WL_'.$_nrow1.'']==null){$val_pt1="null";}else{$val_pt1=$row['WL_'.$_nrow1.''];}
							array_push($wl_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt1."]");
						}
						if(isset($Pt2))
						{ 
							if($row['WL_'.$_nrow2.'']==null){$val_pt2="null";}else{$val_pt2=$row['WL_'.$_nrow2.''];}
							array_push($wl_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt2."]");
						}
						if(isset($Pt3))
						{ 
							if($row['WL_'.$_nrow3.'']==null){$val_pt3="null";}else{$val_pt3=$row['WL_'.$_nrow3.''];}
							array_push($wl_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt3."]");
						}
						if(isset($Pt4))
						{ 
							if($row['WL_'.$_nrow4.'']==null){$val_pt4="null";}else{$val_pt4=$row['WL_'.$_nrow4.''];}
							array_push($wl_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt4."]");
						}
						if(isset($Pt5))
						{ 
							if($row['WL_'.$_nrow5.'']==null){$val_pt5="null";}else{$val_pt5=$row['WL_'.$_nrow5.''];}
							array_push($wl_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt5."]");
						}
						if(isset($Pt6))
						{ 
							if($row['WL_'.$_nrow6.'']==null){$val_pt6="null";}else{$val_pt6=$row['WL_'.$_nrow6.''];}
							array_push($wl_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt6."]");
						}
						if(isset($Pt7))
						{ 
							if($row['WL_'.$_nrow7.'']==null){$val_pt7="null";}else{$val_pt7=$row['WL_'.$_nrow7.''];}
							array_push($wl_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt7."]");
						}
						if(isset($Pt8))
						{ 
							if($row['WL_'.$_nrow8.'']==null){$val_pt8="null";}else{$val_pt8=$row['WL_'.$_nrow8.''];}
							array_push($wl_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt8."]");
						}
						if(isset($Pt9))
						{ 
							if($row['WL_'.$_nrow9.'']==null){$val_pt9="null";}else{$val_pt9=$row['WL_'.$_nrow9.''];}
							array_push($wl_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt9."]");
						}
						if(isset($Pt10))
						{ 
							if($row['WL_'.$_nrow10.'']==null){$val_pt10="null";}else{$val_pt10=$row['WL_'.$_nrow10.''];}
							array_push($wl_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt10."]");
						}
						if(isset($Pt11))
						{ 
							if($row['WL_'.$_nrow11.'']==null){$val_pt11="null";}else{$val_pt11=$row['WL_'.$_nrow11.''];}
							array_push($wl_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt11."]");
						}
						if(isset($Pt12))
						{ 
							if($row['WL_'.$_nrow12.'']==null){$val_pt12="null";}else{$val_pt12=$row['WL_'.$_nrow12.''];}
							array_push($wl_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12."]");
							if($row['WLE_'.$_nrow12.'']==null){$val_pt12E="null";}else{$val_pt12E=$row['WLE_'.$_nrow12.''];}
							array_push($wl_pt12E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12E."]");
						}
						if(isset($Pt13))
						{ 
							if($row['WL_'.$_nrow13.'']==null){$val_pt13="null";}else{$val_pt13=$row['WL_'.$_nrow13.''];}
							array_push($wl_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt13."]");
						}
						if(isset($Pt14))
						{ 
							if($row['WL_'.$_nrow14.'']==null){$val_pt14="null";}else{$val_pt14=$row['WL_'.$_nrow14.''];}
							array_push($wl_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt14."]");
						}
						if(isset($Pt15))
						{ 
							if($row['WL_'.$_nrow15.'']==null){$val_pt15="null";}else{$val_pt15=$row['WL_'.$_nrow15.''];}
							array_push($wl_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt15."]");
						}
						if(isset($Pt16))
						{ 
							if($row['WL_'.$_nrow16.'']==null){$val_pt16="null";}else{$val_pt16=$row['WL_'.$_nrow16.''];}
							array_push($wl_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt16."]");
						}
						if(isset($Pt17))
						{ 
							if($row['WL_'.$_nrow17.'']==null){$val_pt17="null";}else{$val_pt17=$row['WL_'.$_nrow17.''];}
							array_push($wl_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt17."]");
						}
						if(isset($Pt18))
						{ 
							if($row['WL_'.$_nrow18.'']==null){$val_pt18="null";}else{$val_pt18=$row['WL_'.$_nrow18.''];}
							array_push($wl_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt18."]");
						}
						if(isset($Pt19))
						{ 
							if($row['WL_'.$_nrow19.'']==null){$val_pt19="null";}else{$val_pt19=$row['WL_'.$_nrow19.''];}
							array_push($wl_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt19."]");
						}
						if(isset($Pt20))
						{ 
							if($row['WL_'.$_nrow20.'']==null){$val_pt20="null";}else{$val_pt20=$row['WL_'.$_nrow20.''];}
							array_push($wl_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt20."]");
						}
						if(isset($Pt21))
						{ 
							if($row['WL_'.$_nrow21.'']==null){$val_pt21="null";}else{$val_pt21=$row['WL_'.$_nrow21.''];}
							array_push($wl_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt21."]");
						}
						if(isset($Pt22))
						{ 
							if($row['WL_'.$_nrow22.'']==null){$val_pt22="null";}else{$val_pt22=$row['WL_'.$_nrow22.''];}
							array_push($wl_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt22."]");
						}
						if(isset($Pt23))
						{ 
							if($row['WL_'.$_nrow23.'']==null){$val_pt23="null";}else{$val_pt23=$row['WL_'.$_nrow23.''];}
							array_push($wl_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt23."]");
						}
						if(isset($Pt24))
						{ 
							if($row['WL_'.$_nrow24.'']==null){$val_pt24="null";}else{$val_pt24=$row['WL_'.$_nrow24.''];}
							array_push($wl_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt24."]");
						}
						if(isset($Pt25))
						{ 
							if($row['WL_'.$_nrow25.'']==null){$val_pt25="null";}else{$val_pt25=$row['WL_'.$_nrow25.''];}
							array_push($wl_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt25."]");
						}
						if(isset($Pt26))
						{ 
							if($row['WL_'.$_nrow26.'']==null){$val_pt26="null";}else{$val_pt26=$row['WL_'.$_nrow26.''];}
							array_push($wl_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt26."]");
						}

						if ($p_format=="f_15" or $p_format=="f_hr")
						{
							$stadatei+=$a;
							$stadate+=$a*60;
						}
					
					}
					else
					{
							if(isset($Pt1))
							{ 
								array_push($wl_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt2))
							{ 
								array_push($wl_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt3))
							{ 
								array_push($wl_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt4))
							{ 
								array_push($wl_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt5))
							{ 
								array_push($wl_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt6))
							{ 
								array_push($wl_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt7))
							{ 
								array_push($wl_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt8))
							{ 
								array_push($wl_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt9))
							{ 
								array_push($wl_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt10))
							{ 
								array_push($wl_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt11))
							{ 
								array_push($wl_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt12))
							{ 
								array_push($wl_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($wl_pt12E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");

							}
							if(isset($Pt13))
							{ 
								array_push($wl_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt14))
							{ 
								array_push($wl_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt15))
							{ 
								array_push($wl_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt16))
							{ 
								array_push($wl_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt17))
							{ 
								array_push($wl_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt18))
							{ 
								array_push($wl_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt19))
							{ 
								array_push($wl_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt20))
							{ 
								array_push($wl_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt21))
							{ 
								array_push($wl_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt22))
							{ 
								array_push($wl_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt23))
							{ 
								array_push($wl_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt24))
							{ 
								array_push($wl_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt25))
							{ 
								array_push($wl_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Pt26))
							{ 
								array_push($wl_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}

							if ($p_format=="f_15" or $p_format=="f_hr")
							{
								$stadatei+=$a;
								$stadate+=$a*60;
							}						
					}
				}

				if(isset($Pt1))
				{ 
					$ponts_Pt1=implode(",",$wl_pt1);
				}
				if(isset($Pt2))
				{ 
					$ponts_Pt2=implode(",",$wl_pt2);
				}
				if(isset($Pt3))
				{ 
					$ponts_Pt3=implode(",",$wl_pt3);
				}
				if(isset($Pt4))
				{ 
					$ponts_Pt4=implode(",",$wl_pt4);
				}
				if(isset($Pt5))
				{ 
					$ponts_Pt5=implode(",",$wl_pt5);
				}
				if(isset($Pt6))
				{ 
					$ponts_Pt6=implode(",",$wl_pt6);
				}
				if(isset($Pt7))
				{ 
					$ponts_Pt7=implode(",",$wl_pt7);
				}
				if(isset($Pt8))
				{ 
					$ponts_Pt8=implode(",",$wl_pt8);
				}
				if(isset($Pt9))
				{ 
					$ponts_Pt9=implode(",",$wl_pt9);
				}
				if(isset($Pt10))
				{ 
					$ponts_Pt10=implode(",",$wl_pt10);
				}
				if(isset($Pt11))
				{ 
					$ponts_Pt11=implode(",",$wl_pt11);
				}
				if(isset($Pt12))
				{ 
					$ponts_Pt12=implode(",",$wl_pt12);
					$ponts_Pt12E=implode(",",$wl_pt12E);

				}
				if(isset($Pt13))
				{ 
					$ponts_Pt13=implode(",",$wl_pt13);
				}
				if(isset($Pt14))
				{ 
					$ponts_Pt14=implode(",",$wl_pt14);
				}
				if(isset($Pt15))
				{ 
					$ponts_Pt15=implode(",",$wl_pt15);
				}
				if(isset($Pt16))
				{ 
					$ponts_Pt16=implode(",",$wl_pt16);
				}
				if(isset($Pt17))
				{ 
					$ponts_Pt17=implode(",",$wl_pt17);
				}
				if(isset($Pt18))
				{ 
					$ponts_Pt18=implode(",",$wl_pt18);
				}
				if(isset($Pt19))
				{ 
					$ponts_Pt19=implode(",",$wl_pt19);
				}
				if(isset($Pt20))
				{ 
					$ponts_Pt20=implode(",",$wl_pt20);
				}
				if(isset($Pt21))
				{ 
					$ponts_Pt21=implode(",",$wl_pt21);
				}
				if(isset($Pt22))
				{ 
					$ponts_Pt22=implode(",",$wl_pt22);
				}
				if(isset($Pt23))
				{ 
					$ponts_Pt23=implode(",",$wl_pt23);
				}
				if(isset($Pt24))
				{ 
					$ponts_Pt24=implode(",",$wl_pt24);
				}
				if(isset($Pt25))
				{ 
					$ponts_Pt25=implode(",",$wl_pt25);
				}
				if(isset($Pt26))
				{ 
					$ponts_Pt26=implode(",",$wl_pt26);
				}

				if(isset($Pt1))
			   {
						 $se_Pt1='
								{
								type: "line",
								name: "'.$_namec1.'",
								data: ['.$ponts_Pt1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Pt2))
			   {
						 $se_Pt2='
								{
								type: "line",
								name: "'.$_namec2.'",
								data: ['.$ponts_Pt2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt3))
			   {
						 $se_Pt3='
								{
								type: "line",
								name: "'.$_namec3.'",
								data: ['.$ponts_Pt3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt4))
			   {
						 $se_Pt4='
								{
								type: "line",
								name: "'.$_namec4.'",
								data: ['.$ponts_Pt4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt5))
			   {
						 $se_Pt5='
								{
								type: "line",
								name: "'.$_namec5.'",
								data: ['.$ponts_Pt5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt6))
			   {
						 $se_Pt6='
								{
								type: "line",
								name: "'.$_namec6.'",
								data: ['.$ponts_Pt6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt7))
			   {
						 $se_Pt7='
								{
								type: "line",
								name: "'.$_namec7.'",
								data: ['.$ponts_Pt7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt8))
			   {
						 $se_Pt8='
								{
								type: "line",
								name: "'.$_namec8.'",
								data: ['.$ponts_Pt8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt9))
			   {
						 $se_Pt9='
								{
								type: "line",
								name: "'.$_namec9.'",
								data: ['.$ponts_Pt9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt10))
			   {
						 $se_Pt10='
								{
								type: "line",
								name: "'.$_namec10.'",
								data: ['.$ponts_Pt10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt11))
			   {
						 $se_Pt11='
								{
								type: "line",
								name: "'.$_namec11.'",
								data: ['.$ponts_Pt11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt12))
			   {
						 $se_Pt12='
								{
								type: "line",
								name: "'.$_namec12.'",
								data: ['.$ponts_Pt12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_E",
								data: ['.$ponts_Pt12E.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								';

				}
				if(isset($Pt13))
			   {
						 $se_Pt13='
								{
								type: "line",
								name: "'.$_namec13.'",
								data: ['.$ponts_Pt13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt14))
			   {
						 $se_Pt14='
								{
								type: "line",
								name: "'.$_namec14.'",
								data: ['.$ponts_Pt14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt15))
			   {
						 $se_Pt15='
								{
								type: "line",
								name: "'.$_namec15.'",
								data: ['.$ponts_Pt15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt16))
			   {
						 $se_Pt16='
								{
								type: "line",
								name: "'.$_namec16.'",
								data: ['.$ponts_Pt16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt17))
			   {
						 $se_Pt17='
								{
								type: "line",
								name: "'.$_namec17.'",
								data: ['.$ponts_Pt17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt18))
			   {
						 $se_Pt18='
								{
								type: "line",
								name: "'.$_namec18.'",
								data: ['.$ponts_Pt18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt19))
			   {
						 $se_Pt19='
								{
								type: "line",
								name: "'.$_namec19.'",
								data: ['.$ponts_Pt19.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt20))
			   {
						 $se_Pt20='
								{
								type: "line",
								name: "'.$_namec20.'",
								data: ['.$ponts_Pt20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt21))
			   {
						 $se_Pt21='
								{
								type: "line",
								name: "'.$_namec21.'",
								data: ['.$ponts_Pt21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt22))
			   {
						 $se_Pt22='
								{
								type: "line",
								name: "'.$_namec22.'",
								data: ['.$ponts_Pt22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt23))
			   {
						 $se_Pt23='
								{
								type: "line",
								name: "'.$_namec23.'",
								data: ['.$ponts_Pt23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt24))
			   {
						 $se_Pt24='
								{
								type: "line",
								name: "'.$_namec24.'",
								data: ['.$ponts_Pt24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt25))
			   {
						 $se_Pt25='
								{
								type: "line",
								name: "'.$_namec25.'",
								data: ['.$ponts_Pt25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt26))
			   {
						 $se_Pt26='
								{
								type: "line",
								name: "'.$_namec26.'",
								data: ['.$ponts_Pt26.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
	}
	else
	{

			$p_date=date("Y-m-d 07:00",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn=  24 * 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=1440;
			$b=86400;

			$start = strtotime($p_day1);
			$end = strtotime($p_day2);

			$wl_pt1=array();
			$wl_pt2=array();
			$wl_pt3=array();
			$wl_pt4=array();
			$wl_pt5=array();
			$wl_pt6=array();
			$wl_pt7=array();
			$wl_pt8=array();
			$wl_pt9=array();
			$wl_pt10=array();
			$wl_pt11=array();
			$wl_pt12=array();
			$wl_pt12E=array();
			$wl_pt13=array();
			$wl_pt14=array();
			$wl_pt15=array();
			$wl_pt16=array();
			$wl_pt17=array();
			$wl_pt18=array();
			$wl_pt19=array();
			$wl_pt20=array();
			$wl_pt21=array();
			$wl_pt22=array();
			$wl_pt23=array();
			$wl_pt24=array();
			$wl_pt25=array();
			$wl_pt26=array();

			for ( $tt = $start; $tt <= $end; $tt += 86400 )
			{	
				$dt=date("Y-m-d",$tt);
				
				if($p_format=="f_mean")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_min")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_max")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				else{}
			
				//echo $strQuery;
				$result = odbc_exec($conn,$strQuery);
				//$checkrow=odbc_num_rows($objExec);
				$date_now = $dt.' 07:00';
				

				$stadatey=date("Y",strtotime($date_now));	
				$stadatem=date("m",strtotime($date_now));	
				$stadated=date("d",strtotime($date_now));
				$stadateh=date("H",strtotime($date_now));
				$stadatei=date("i",strtotime($date_now));
						
				$sm=$stadatey."-".$stadatem;
				
				$stadate=strtotime($date_now);
				$enddate=strtotime($date_now)+86400;
				$row = odbc_fetch_array($result);
		
					if(isset($Pt1))
					{ 
						if($row['WL_'.$_nrow1.'']==null){$val_pt1="null";}else{$val_pt1=$row['WL_'.$_nrow1.''];}
						array_push($wl_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt1."]");
					}
					if(isset($Pt2))
					{ 
						if($row['WL_'.$_nrow2.'']==null){$val_pt2="null";}else{$val_pt2=$row['WL_'.$_nrow2.''];}
						array_push($wl_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt2."]");
					}
					if(isset($Pt3))
					{ 
						if($row['WL_'.$_nrow3.'']==null){$val_pt3="null";}else{$val_pt3=$row['WL_'.$_nrow3.''];}
						array_push($wl_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt3."]");
					}
					if(isset($Pt4))
					{ 
						if($row['WL_'.$_nrow4.'']==null){$val_pt4="null";}else{$val_pt4=$row['WL_'.$_nrow4.''];}
						array_push($wl_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt4."]");
					}
					if(isset($Pt5))
					{ 
						if($row['WL_'.$_nrow5.'']==null){$val_pt5="null";}else{$val_pt5=$row['WL_'.$_nrow5.''];}
						array_push($wl_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt5."]");
					}
					if(isset($Pt6))
					{ 
						if($row['WL_'.$_nrow6.'']==null){$val_pt6="null";}else{$val_pt6=$row['WL_'.$_nrow6.''];}
						array_push($wl_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt6."]");
					}
					if(isset($Pt7))
					{ 
						if($row['WL_'.$_nrow7.'']==null){$val_pt7="null";}else{$val_pt7=$row['WL_'.$_nrow7.''];}
						array_push($wl_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt7."]");
					}
					if(isset($Pt8))
					{ 
						if($row['WL_'.$_nrow8.'']==null){$val_pt8="null";}else{$val_pt8=$row['WL_'.$_nrow8.''];}
						array_push($wl_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt8."]");
					}
					if(isset($Pt9))
					{ 
						if($row['WL_'.$_nrow9.'']==null){$val_pt9="null";}else{$val_pt9=$row['WL_'.$_nrow9.''];}
						array_push($wl_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt9."]");
					}
					if(isset($Pt10))
					{ 
						if($row['WL_'.$_nrow10.'']==null){$val_pt10="null";}else{$val_pt10=$row['WL_'.$_nrow10.''];}
						array_push($wl_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt10."]");
					}
					if(isset($Pt11))
					{ 
						if($row['WL_'.$_nrow11.'']==null){$val_pt11="null";}else{$val_pt11=$row['WL_'.$_nrow11.''];}
						array_push($wl_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt11."]");
					}
					if(isset($Pt12))
					{ 
						if($row['WL_'.$_nrow12.'']==null){$val_pt12="null";}else{$val_pt12=$row['WL_'.$_nrow12.''];}
						array_push($wl_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12."]");
						if($row['WLE_'.$_nrow12.'']==null){$val_pt12E="null";}else{$val_pt12E=$row['WLE_'.$_nrow12.''];}
						array_push($wl_pt12E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12E."]");
					}
					if(isset($Pt13))
					{ 
						if($row['WL_'.$_nrow13.'']==null){$val_pt13="null";}else{$val_pt13=$row['WL_'.$_nrow13.''];}
						array_push($wl_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt13."]");
					}
					if(isset($Pt14))
					{ 
						if($row['WL_'.$_nrow14.'']==null){$val_pt14="null";}else{$val_pt14=$row['WL_'.$_nrow14.''];}
						array_push($wl_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt14."]");
					}
					if(isset($Pt15))
					{ 
						if($row['WL_'.$_nrow15.'']==null){$val_pt15="null";}else{$val_pt15=$row['WL_'.$_nrow15.''];}
						array_push($wl_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt15."]");
					}
					if(isset($Pt16))
					{ 
						if($row['WL_'.$_nrow16.'']==null){$val_pt16="null";}else{$val_pt16=$row['WL_'.$_nrow16.''];}
						array_push($wl_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt16."]");
					}
					if(isset($Pt17))
					{ 
						if($row['WL_'.$_nrow17.'']==null){$val_pt17="null";}else{$val_pt17=$row['WL_'.$_nrow17.''];}
						array_push($wl_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt17."]");
					}
					if(isset($Pt18))
					{ 
						if($row['WL_'.$_nrow18.'']==null){$val_pt18="null";}else{$val_pt18=$row['WL_'.$_nrow18.''];}
						array_push($wl_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt18."]");
					}
					if(isset($Pt19))
					{ 
						if($row['WL_'.$_nrow19.'']==null){$val_pt19="null";}else{$val_pt19=$row['WL_'.$_nrow19.''];}
						array_push($wl_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt19."]");
					}
					if(isset($Pt20))
					{ 
						if($row['WL_'.$_nrow20.'']==null){$val_pt20="null";}else{$val_pt20=$row['WL_'.$_nrow20.''];}
						array_push($wl_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt20."]");
					}
					if(isset($Pt21))
					{ 
						if($row['WL_'.$_nrow21.'']==null){$val_pt21="null";}else{$val_pt21=$row['WL_'.$_nrow21.''];}
						array_push($wl_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt21."]");
					}
					if(isset($Pt22))
					{ 
						if($row['WL_'.$_nrow22.'']==null){$val_pt22="null";}else{$val_pt22=$row['WL_'.$_nrow22.''];}
						array_push($wl_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt22."]");
					}
					if(isset($Pt23))
					{ 
						if($row['WL_'.$_nrow23.'']==null){$val_pt23="null";}else{$val_pt23=$row['WL_'.$_nrow23.''];}
						array_push($wl_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt23."]");
					}
					if(isset($Pt24))
					{ 
						if($row['WL_'.$_nrow24.'']==null){$val_pt24="null";}else{$val_pt24=$row['WL_'.$_nrow24.''];}
						array_push($wl_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt24."]");
					}
					if(isset($Pt25))
					{ 
						if($row['WL_'.$_nrow25.'']==null){$val_pt25="null";}else{$val_pt25=$row['WL_'.$_nrow25.''];}
						array_push($wl_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt25."]");
					}
					if(isset($Pt26))
					{ 
						if($row['WL_'.$_nrow26.'']==null){$val_pt26="null";}else{$val_pt26=$row['WL_'.$_nrow26.''];}
						array_push($wl_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt26."]");
					}

			}

			if(isset($Pt1))
				{ 
					$ponts_Pt1=implode(",",$wl_pt1);
				}
				if(isset($Pt2))
				{ 
					$ponts_Pt2=implode(",",$wl_pt2);
				}
				if(isset($Pt3))
				{ 
					$ponts_Pt3=implode(",",$wl_pt3);
				}
				if(isset($Pt4))
				{ 
					$ponts_Pt4=implode(",",$wl_pt4);
				}
				if(isset($Pt5))
				{ 
					$ponts_Pt5=implode(",",$wl_pt5);
				}
				if(isset($Pt6))
				{ 
					$ponts_Pt6=implode(",",$wl_pt6);
				}
				if(isset($Pt7))
				{ 
					$ponts_Pt7=implode(",",$wl_pt7);
				}
				if(isset($Pt8))
				{ 
					$ponts_Pt8=implode(",",$wl_pt8);
				}
				if(isset($Pt9))
				{ 
					$ponts_Pt9=implode(",",$wl_pt9);
				}
				if(isset($Pt10))
				{ 
					$ponts_Pt10=implode(",",$wl_pt10);
				}
				if(isset($Pt11))
				{ 
					$ponts_Pt11=implode(",",$wl_pt11);
				}
				if(isset($Pt12))
				{ 
					$ponts_Pt12=implode(",",$wl_pt12);
					$ponts_Pt12E=implode(",",$wl_pt12E);
				}
				if(isset($Pt13))
				{ 
					$ponts_Pt13=implode(",",$wl_pt13);
				}
				if(isset($Pt14))
				{ 
					$ponts_Pt14=implode(",",$wl_pt14);
				}
				if(isset($Pt15))
				{ 
					$ponts_Pt15=implode(",",$wl_pt15);
				}
				if(isset($Pt16))
				{ 
					$ponts_Pt16=implode(",",$wl_pt16);
				}
				if(isset($Pt17))
				{ 
					$ponts_Pt17=implode(",",$wl_pt17);
				}
				if(isset($Pt18))
				{ 
					$ponts_Pt18=implode(",",$wl_pt18);
				}
				if(isset($Pt19))
				{ 
					$ponts_Pt19=implode(",",$wl_pt19);
				}
				if(isset($Pt20))
				{ 
					$ponts_Pt20=implode(",",$wl_pt20);
				}
				if(isset($Pt21))
				{ 
					$ponts_Pt21=implode(",",$wl_pt21);
				}
				if(isset($Pt22))
				{ 
					$ponts_Pt22=implode(",",$wl_pt22);
				}
				if(isset($Pt23))
				{ 
					$ponts_Pt23=implode(",",$wl_pt23);
				}
				if(isset($Pt24))
				{ 
					$ponts_Pt24=implode(",",$wl_pt24);
				}
				if(isset($Pt25))
				{ 
					$ponts_Pt25=implode(",",$wl_pt25);
				}
				if(isset($Pt26))
				{ 
					$ponts_Pt26=implode(",",$wl_pt26);
				}

				if(isset($Pt1))
			   {
						 $se_Pt1='
								{
								type: "line",
								name: "'.$_namec1.'",
								data: ['.$ponts_Pt1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Pt2))
			   {
						 $se_Pt2='
								{
								type: "line",
								name: "'.$_namec2.'",
								data: ['.$ponts_Pt2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt3))
			   {
						 $se_Pt3='
								{
								type: "line",
								name: "'.$_namec3.'",
								data: ['.$ponts_Pt3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt4))
			   {
						 $se_Pt4='
								{
								type: "line",
								name: "'.$_namec4.'",
								data: ['.$ponts_Pt4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt5))
			   {
						 $se_Pt5='
								{
								type: "line",
								name: "'.$_namec5.'",
								data: ['.$ponts_Pt5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt6))
			   {
						 $se_Pt6='
								{
								type: "line",
								name: "'.$_namec6.'",
								data: ['.$ponts_Pt6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt7))
			   {
						 $se_Pt7='
								{
								type: "line",
								name: "'.$_namec7.'",
								data: ['.$ponts_Pt7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt8))
			   {
						 $se_Pt8='
								{
								type: "line",
								name: "'.$_namec8.'",
								data: ['.$ponts_Pt8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt9))
			   {
						 $se_Pt9='
								{
								type: "line",
								name: "'.$_namec9.'",
								data: ['.$ponts_Pt9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt10))
			   {
						 $se_Pt10='
								{
								type: "line",
								name: "'.$_namec10.'",
								data: ['.$ponts_Pt10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt11))
			   {
						 $se_Pt11='
								{
								type: "line",
								name: "'.$_namec11.'",
								data: ['.$ponts_Pt11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt12))
			   {
						 $se_Pt12='
								{
								type: "line",
								name: "'.$_namec12.'",
								data: ['.$ponts_Pt12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_E",
								data: ['.$ponts_Pt12E.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},';

				}
				if(isset($Pt13))
			   {
						 $se_Pt13='
								{
								type: "line",
								name: "'.$_namec13.'",
								data: ['.$ponts_Pt13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt14))
			   {
						 $se_Pt14='
								{
								type: "line",
								name: "'.$_namec14.'",
								data: ['.$ponts_Pt14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt15))
			   {
						 $se_Pt15='
								{
								type: "line",
								name: "'.$_namec15.'",
								data: ['.$ponts_Pt15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt16))
			   {
						 $se_Pt16='
								{
								type: "line",
								name: "'.$_namec16.'",
								data: ['.$ponts_Pt16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt17))
			   {
						 $se_Pt17='
								{
								type: "line",
								name: "'.$_namec17.'",
								data: ['.$ponts_Pt17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt18))
			   {
						 $se_Pt18='
								{
								type: "line",
								name: "'.$_namec18.'",
								data: ['.$ponts_Pt18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt19))
			   {
						 $se_Pt19='
								{
								type: "line",
								name: "'.$_namec19.'",
								data: ['.$ponts_Pt19.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt20))
			   {
						 $se_Pt20='
								{
								type: "line",
								name: "'.$_namec20.'",
								data: ['.$ponts_Pt20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt21))
			   {
						 $se_Pt21='
								{
								type: "line",
								name: "'.$_namec21.'",
								data: ['.$ponts_Pt21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt22))
			   {
						 $se_Pt22='
								{
								type: "line",
								name: "'.$_namec22.'",
								data: ['.$ponts_Pt22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt23))
			   {
						 $se_Pt23='
								{
								type: "line",
								name: "'.$_namec23.'",
								data: ['.$ponts_Pt23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt24))
			   {
						 $se_Pt24='
								{
								type: "line",
								name: "'.$_namec24.'",
								data: ['.$ponts_Pt24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt25))
			   {
						 $se_Pt25='
								{
								type: "line",
								name: "'.$_namec25.'",
								data: ['.$ponts_Pt25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},	';

				}
				if(isset($Pt26))
			   {
						 $se_Pt26='
								{
								type: "line",
								name: "'.$_namec26.'",
								data: ['.$ponts_Pt26.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}


	}
		?>
		<BR>
		<div id="graphWL" style="<?echo $st;?>"></div>
			<script type="text/javascript">
			$(function () {
				var chart;
				$(document).ready(function() {
					Highcharts.setOptions({
					lang: {
						months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
				});
					chart = new Highcharts.Chart({
						chart: {
							zoomType: 'x',
							renderTo: 'graphWL',
							type: 'line',
							spacingLeft: 25 ,
							resetZoomButton: {
								position: {
								// align: 'right', // by default
								 // verticalAlign: 'top', // by default
								x: -30,
								y: -20
								}
							}
						},
						credits: {
						enabled: false
						},
						title: {
							text: '<? echo $nametype;?>',
						
						style: {
							fontSize: '14px'
						}
						},
						subtitle: {
							text: ''
						},
						xAxis: {
							type: 'datetime',
							//maxZoom: <? echo $maxZ;?>,
							minRange: '<? echo $a;?>' * 60 * 1000 * 6,
							minTickInterval: '<? echo $a;?>' * 60 * 1000,
							title: {
								text: null
							},
							labels:{
							rotation:-45,
							align:'right',
							fontSize: '8px'
								},
							dateTimeLabelFormats: {
							day: '%e %B %Y',
							week:'%e %B %Y',
							month:'%B %Y',
							year:'%Y'
						}
						},
						yAxis: {
							//min: '<? echo $minva;?>',
							minPadding: 0,
							maxPadding: 0,
							title: {
								text: '<? echo $yaname;?>'
							}
						},
						tooltip: {
							formatter: function() {
							return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+' <? echo $yname;?>';
						}
						},
						plotOptions: {
							series:{marker:{enabled:false}}
						},
						scrollbar: {
							 enabled: true
						},
						series: [
							 <?php echo $se_Pt1?>
							<?php echo $se_Pt2?>
							 <?php echo $se_Pt3?>
							 <?php echo $se_Pt4?>
							<?php echo $se_Pt5?>
							 <?php echo $se_Pt6?>
							 <?php echo $se_Pt7?>
							 <?php echo $se_Pt8?>
							 <?php echo $se_Pt9?>
							<?php echo $se_Pt10?>
							 <?php echo $se_Pt11?>
							 <?php echo $se_Pt12?>
							<?php echo $se_Pt13?>
							 <?php echo $se_Pt14?>
							<?php echo $se_Pt15?>
							
							<?php echo $se_Pt17?>
							
							 <?php echo $se_Pt21?>
							
							 <?php echo $se_Pt25?>
							 <?php echo $se_Pt26?>
							]
							,
							exporting: {
                         url: 'http://telepattani.com/exporting_server/index.php'
                      }
					});
				});

			});
			</script>
		<?	
}


if($p_flow=="Y")
{
	$nametype="กราฟ".$_cfg_data_type["fl"][0]; 
	$yname=$_cfg_data_type["fl"][1];
	$yaname=$_cfg_data_type["fl"][0]." ".$_cfg_data_type["fl"][1];
	$typess="line";
	$flH=$_cfg_data_type_3[0];
	$flL="อัตราการไหล ท้าย ปตร.";

	$yname2=$_cfg_data_type["wl"][1];
	$yaname2=$_cfg_data_type["wl"][0]." ".$_cfg_data_type["wl"][1];
	$wlH=$_cfg_data_type["wl"][0];
	$wlL="ท้าย ปตร.";
    
	if($p_format=="f_15" || $p_format=="f_hr")
	{
		if($p_format=="f_15")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];
					
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname." ";
				}
				
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY CONVERT(varchar(16),DT,121)	ORDER BY CONVERT(varchar(16),DT,121)";
		}
		elseif($p_format=="f_hr")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=60;
			$b=3600;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";	
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];
					
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname."	";
				}
				
				$strQuery .=" FROM [dbo].[DATA_Backup]
							WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:00' 
								AND (DATEPART(MINUTE ,DT))='00'
							GROUP BY 
								CONVERT(varchar(16),DT,121)
							ORDER BY 
								CONVERT(varchar(16),DT,121)	";
		}
		else{}

		$result = odbc_exec($conn,$strQuery);
		//$checkrow=mssql_num_rows($result);

		$wt_pt1=array();
		$wt_pt1f=array();
		$wt_pt2=array();
		$wt_pt2f=array();
		$wt_pt3=array();
		$wt_pt3f=array();
		$wt_pt4=array();
		$wt_pt4f=array();
		$wt_pt5=array();
		$wt_pt5f=array();
		$wt_pt6=array();
		$wt_pt6f=array();
		$wt_pt7=array();
		$wt_pt7f=array();
		$wt_pt8=array();
		$wt_pt8f=array();
		$wt_pt9=array();
		$wt_pt9f=array();
		$wt_pt10=array();
		$wt_pt10f=array();
		$wt_pt11=array();
		$wt_pt11f=array();
		$wt_pt12=array();
		$wt_pt12f=array();
		$wt_pt12e=array();
		$wt_pt12fe=array();
		$wt_pt13=array();
		$wt_pt13f=array();
		$wt_pt14=array();
		$wt_pt14f=array();
		$wt_pt15=array();
		$wt_pt15f=array();
		$wt_pt16=array();
		$wt_pt16f=array();
		$wt_pt17=array();
		$wt_pt17f=array();
		$wt_pt18=array();
		$wt_pt18f=array();
		$wt_pt19=array();
		$wt_pt19f=array();
		$wt_pt20=array();
		$wt_pt20f=array();
		$wt_pt21=array();
		$wt_pt21f=array();
		$wt_pt22=array();
		$wt_pt22f=array();
		$wt_pt23=array();
		$wt_pt23f=array();
		$wt_pt24=array();
		$wt_pt24f=array();
		$wt_pt25=array();
		$wt_pt25f=array();
		$wt_pt26=array();
		$wt_pt26f=array();

		$stadatey=date("Y",strtotime($p_day1));	
		$stadatem=date("m",strtotime($p_day1));	
		$stadated=date("d",strtotime($p_day1));

		$stadateh=date("H",strtotime($p_day1));
		$stadatei=date("i",strtotime($p_day1));
				
		$sm=$stadatey."-".$stadatem;
		
		if ($p_format=="f_15" or $p_format=="f_hr")
		{
			$stadate=strtotime($p_day1);
			$enddate=strtotime($p_day2)+86400;
		}
		else{}

		while($stadate < $enddate)
		{

			if ($row = odbc_fetch_array($result))
			{
				$sname=strtotime($row['adate']);
				
				while($stadate < $sname)
				{

					if(isset($Pt1))
					{ 
						array_push($wt_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt1f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt2))
					{ 
						array_push($wt_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt3))
					{ 
						array_push($wt_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt3f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt4))
					{ 
						array_push($wt_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt4f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt5))
					{ 
						array_push($wt_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt5f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt6))
					{ 
						array_push($wt_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt6f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt7))
					{ 
						array_push($wt_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt7f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt8))
					{ 
						array_push($wt_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt8f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt9))
					{ 
						array_push($wt_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt9f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt10))
					{ 
						array_push($wt_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt10f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt11))
					{ 
						array_push($wt_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt11f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt12))
					{ 
						array_push($wt_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt12f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt12e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt12fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt13))
					{ 
						array_push($wt_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt13f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt14))
					{ 
						array_push($wt_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt14f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt15))
					{ 
						array_push($wt_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt15f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt16))
					{ 
						array_push($wt_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt16f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt17))
					{ 
						array_push($wt_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt17f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt18))
					{ 
						array_push($wt_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt18f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt19))
					{ 
						array_push($wt_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt19f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt20))
					{ 
						array_push($wt_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt20f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt21))
					{ 
						array_push($wt_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt21f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt22))
					{ 
						array_push($wt_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt22f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt23))
					{ 
						array_push($wt_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt23f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt24))
					{ 
						array_push($wt_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt24f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt25))
					{ 
						array_push($wt_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt25f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt26))
					{ 
						array_push($wt_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt26f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}

					if ($p_format=="f_15" or $p_format=="f_hr")
					{
						$stadatei+=$a;
						$stadate+=$a*60;
					}
				
				}

				if(isset($Pt1))
				{ 
					if($row['WL_'.$_nrow1.'']==null){$val_pt1="null";}else{$val_pt1=$row['WL_'.$_nrow1.''];}
					array_push($wt_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt1."]");
					if($row['FL_'.$_nrow1.'']==null){$val_pt1f="null";}else{$val_pt1f=$row['FL_'.$_nrow1.''];}
					array_push($wt_pt1f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt1f."]");
				}
				if(isset($Pt2))
				{ 
					if($row['WL_'.$_nrow2.'']==null){$val_pt2="null";}else{$val_pt2=$row['WL_'.$_nrow2.''];}
					array_push($wt_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt2."]");
					if($row['FL_'.$_nrow2.'']==null){$val_pt2f="null";}else{$val_pt2f=$row['FL_'.$_nrow2.''];}
					array_push($wt_pt2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt2f."]");
				}
				if(isset($Pt3))
				{ 
					if($row['WL_'.$_nrow3.'']==null){$val_pt3="null";}else{$val_pt3=$row['WL_'.$_nrow3.''];}
					array_push($wt_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt3."]");
					if($row['FL_'.$_nrow3.'']==null){$val_pt3f="null";}else{$val_pt3f=$row['FL_'.$_nrow3.''];}
					array_push($wt_pt2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt3f."]");
				}
				if(isset($Pt4))
				{ 
					if($row['WL_'.$_nrow4.'']==null){$val_pt4="null";}else{$val_pt4=$row['WL_'.$_nrow4.''];}
					array_push($wt_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt4."]");
					if($row['FL_'.$_nrow4.'']==null){$val_pt4f="null";}else{$val_pt4f=$row['FL_'.$_nrow4.''];}
					array_push($wt_pt4f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt4f."]");
				}
				if(isset($Pt5))
				{ 
					if($row['WL_'.$_nrow5.'']==null){$val_pt5="null";}else{$val_pt5=$row['WL_'.$_nrow5.''];}
					array_push($wt_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt5."]");
					if($row['FL_'.$_nrow5.'']==null){$val_pt5f="null";}else{$val_pt5f=$row['FL_'.$_nrow5.''];}
					array_push($wt_pt5f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt5f."]");
				}
				if(isset($Pt6))
				{ 
					if($row['WL_'.$_nrow6.'']==null){$val_pt6="null";}else{$val_pt6=$row['WL_'.$_nrow6.''];}
					array_push($wt_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt6."]");
					if($row['FL_'.$_nrow6.'']==null){$val_pt6f="null";}else{$val_pt6f=$row['FL_'.$_nrow6.''];}
					array_push($wt_pt6f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt6f."]");
				}
				if(isset($Pt7))
				{ 
					if($row['WL_'.$_nrow7.'']==null){$val_pt7="null";}else{$val_pt7=$row['WL_'.$_nrow7.''];}
					array_push($wt_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt7."]");
					if($row['FL_'.$_nrow7.'']==null){$val_pt7f="null";}else{$val_pt7f=$row['FL_'.$_nrow7.''];}
					array_push($wt_pt7f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt7f."]");
				}
				if(isset($Pt8))
				{ 
					if($row['WL_'.$_nrow8.'']==null){$val_pt8="null";}else{$val_pt8=$row['WL_'.$_nrow8.''];}
					array_push($wt_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt8."]");
					if($row['FL_'.$_nrow8.'']==null){$val_pt8f="null";}else{$val_pt8f=$row['FL_'.$_nrow8.''];}
					array_push($wt_pt8f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt8f."]");
				}
				if(isset($Pt9))
				{ 
					if($row['WL_'.$_nrow9.'']==null){$val_pt9="null";}else{$val_pt9=$row['WL_'.$_nrow9.''];}
					array_push($wt_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt9."]");
					if($row['FL_'.$_nrow9.'']==null){$val_pt9f="null";}else{$val_pt9f=$row['FL_'.$_nrow9.''];}
					array_push($wt_pt9f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt9f."]");
				}
				if(isset($Pt10))
				{ 
					if($row['WL_'.$_nrow10.'']==null){$val_pt10="null";}else{$val_pt10=$row['WL_'.$_nrow10.''];}
					array_push($wt_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt10."]");
					if($row['FL_'.$_nrow10.'']==null){$val_pt10f="null";}else{$val_pt10f=$row['FL_'.$_nrow10.''];}
					array_push($wt_pt10f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt10f."]");
				}
				if(isset($Pt11))
				{ 
					if($row['RF_'.$_nrow11.'']==null){$val_pt11="null";}else{$val_pt11=$row['RF_'.$_nrow11.''];}
					array_push($wt_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt11."]");
					if($row['FL_'.$_nrow11.'']==null){$val_pt11f="null";}else{$val_pt11f=$row['FL_'.$_nrow11.''];}
					array_push($wt_pt11f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt11f."]");
				}
				if(isset($Pt12))
				{ 
					if($row['WL_'.$_nrow12.'']==null){$val_pt12="null";}else{$val_pt12=$row['WL_'.$_nrow12.''];}
					array_push($wt_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12."]");
					if($row['FL_'.$_nrow12.'']==null){$val_pt12f="null";}else{$val_pt12f=$row['FL_'.$_nrow12.''];}
					array_push($wt_pt12f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12f."]");
					if($row['WLE_'.$_nrow12.'']==null){$val_pt12e="null";}else{$val_pt12e=$row['WLE_'.$_nrow12.''];}
					array_push($wt_pt12e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12e."]");
					if($row['FLE_'.$_nrow12.'']==null){$val_pt12ef="null";}else{$val_pt12ef=$row['FLE_'.$_nrow12.''];}
					array_push($wt_pt12fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12ef."]");
				}
				if(isset($Pt13))
				{ 
					if($row['WL_'.$_nrow13.'']==null){$val_pt13="null";}else{$val_pt13=$row['RF_'.$_nrow13.''];}
					array_push($wt_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt13."]");
					if($row['FL_'.$_nrow13.'']==null){$val_pt13f="null";}else{$val_pt13f=$row['FL_'.$_nrow13.''];}
					array_push($wt_pt13f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt13f."]");
				}
				if(isset($Pt14))
				{ 
					if($row['WL_'.$_nrow14.'']==null){$val_pt14="null";}else{$val_pt14=$row['WL_'.$_nrow14.''];}
					array_push($wt_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt14."]");
					if($row['FL_'.$_nrow14.'']==null){$val_pt14f="null";}else{$val_pt14f=$row['FL_'.$_nrow14.''];}
					array_push($wt_pt14f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt14f."]");
				}
				if(isset($Pt15))
				{ 
					if($row['WL_'.$_nrow15.'']==null){$val_pt15="null";}else{$val_pt15=$row['WL_'.$_nrow15.''];}
					array_push($wt_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt15."]");
					if($row['FL_'.$_nrow15.'']==null){$val_pt15f="null";}else{$val_pt15f=$row['FL_'.$_nrow15.''];}
					array_push($wt_pt15f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt15f."]");
				}
				if(isset($Pt16))
				{ 
					if($row['WL_'.$_nrow16.'']==null){$val_pt16="null";}else{$val_pt16=$row['WL_'.$_nrow16.''];}
					array_push($wt_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt16."]");
					if($row['FL_'.$_nrow16.'']==null){$val_pt16f="null";}else{$val_pt16f=$row['FL_'.$_nrow16.''];}
					array_push($wt_pt16f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt16f."]");
				}
				if(isset($Pt17))
				{ 
					if($row['WL_'.$_nrow17.'']==null){$val_pt17="null";}else{$val_pt17=$row['WL_'.$_nrow17.''];}
					array_push($wt_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt17."]");
					if($row['FL_'.$_nrow17.'']==null){$val_pt17f="null";}else{$val_pt17f=$row['FL_'.$_nrow17.''];}
					array_push($wt_pt17f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt17f."]");
				}
				if(isset($Pt18))
				{ 
					if($row['WL_'.$_nrow18.'']==null){$val_pt18="null";}else{$val_pt18=$row['WL_'.$_nrow18.''];}
					array_push($wt_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt18."]");
					if($row['FL_'.$_nrow18.'']==null){$val_pt18f="null";}else{$val_pt18f=$row['FL_'.$_nrow18.''];}
					array_push($wt_pt18f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt18f."]");
				}
				if(isset($Pt19))
				{ 
					if($row['WL_'.$_nrow19.'']==null){$val_pt19="null";}else{$val_pt19=$row['WL_'.$_nrow19.''];}
					array_push($wt_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt19."]");
					if($row['FL_'.$_nrow19.'']==null){$val_pt19f="null";}else{$val_pt19f=$row['FL_'.$_nrow19.''];}
					array_push($wt_pt19f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt19f."]");
				}
				if(isset($Pt20))
				{ 
					if($row['WL_'.$_nrow20.'']==null){$val_pt20="null";}else{$val_pt20=$row['WL_'.$_nrow20.''];}
					array_push($wt_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt20."]");
					if($row['FL_'.$_nrow20.'']==null){$val_pt20f="null";}else{$val_pt20f=$row['FL_'.$_nrow20.''];}
					array_push($wt_pt20f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt20f."]");
				}
				if(isset($Pt21))
				{ 
					if($row['WL_'.$_nrow21.'']==null){$val_pt21="null";}else{$val_pt21=$row['WL_'.$_nrow21.''];}
					array_push($wt_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt21."]");
					if($row['FL_'.$_nrow21.'']==null){$val_pt21f="null";}else{$val_pt21f=$row['FL_'.$_nrow21.''];}
					array_push($wt_pt21f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt21f."]");
				}
				if(isset($Pt22))
				{ 
					if($row['WL_'.$_nrow22.'']==null){$val_pt22="null";}else{$val_pt22=$row['WL_'.$_nrow22.''];}
					array_push($wt_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt22."]");
					if($row['FL_'.$_nrow22.'']==null){$val_pt22f="null";}else{$val_pt22f=$row['FL_'.$_nrow22.''];}
					array_push($wt_pt22f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt22f."]");
				}
				if(isset($Pt23))
				{ 
					if($row['WL_'.$_nrow23.'']==null){$val_pt23="null";}else{$val_pt23=$row['WL_'.$_nrow23.''];}
					array_push($wt_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt23."]");
					if($row['FL_'.$_nrow23.'']==null){$val_pt23f="null";}else{$val_pt23f=$row['FL_'.$_nrow23.''];}
					array_push($wt_pt23f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt23f."]");
				}
				if(isset($Pt24))
				{ 
					if($row['WL_'.$_nrow24.'']==null){$val_pt24="null";}else{$val_pt24=$row['WL_'.$_nrow24.''];}
					array_push($wt_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt24."]");
					if($row['FL_'.$_nrow24.'']==null){$val_pt24f="null";}else{$val_pt24f=$row['FL_'.$_nrow24.''];}
					array_push($wt_pt24f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt24f."]");
				}
				if(isset($Pt25))
				{ 
					if($row['WL_'.$_nrow25.'']==null){$val_pt25="null";}else{$val_pt25=$row['WL_'.$_nrow25.''];}
					array_push($wt_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt25."]");
					if($row['FL_'.$_nrow25.'']==null){$val_pt25f="null";}else{$val_pt25f=$row['FL_'.$_nrow25.''];}
					array_push($wt_pt25f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt25f."]");
				}
				if(isset($Pt26))
				{ 
					if($row['WL_'.$_nrow26.'']==null){$val_pt26="null";}else{$val_pt26=$row['WL_'.$_nrow26.''];}
					array_push($wt_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt26."]");
					if($row['FL_'.$_nrow26.'']==null){$val_pt26f="null";}else{$val_pt26f=$row['FL_'.$_nrow26.''];}
					array_push($wt_pt26f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt26f."]");
				}

				if ($p_format=="f_15" or $p_format=="f_hr")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}
			
			}
			else
			{
				if(isset($Pt1))
					{ 
						array_push($wt_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt1f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt2))
					{ 
						array_push($wt_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt3))
					{ 
						array_push($wt_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt3f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt4))
					{ 
						array_push($wt_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt4f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt5))
					{ 
						array_push($wt_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt5f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt6))
					{ 
						array_push($wt_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt6f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt7))
					{ 
						array_push($wt_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt7f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt8))
					{ 
						array_push($wt_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt8f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt9))
					{ 
						array_push($wt_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt9f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt10))
					{ 
						array_push($wt_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt10f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt11))
					{ 
						array_push($wt_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt11f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt12))
					{ 
						array_push($wt_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt12f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt12e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt12fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt13))
					{ 
						array_push($wt_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt13f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt14))
					{ 
						array_push($wt_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt14f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt15))
					{ 
						array_push($wt_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt15f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt16))
					{ 
						array_push($wt_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt16f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt17))
					{ 
						array_push($wt_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt17f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt18))
					{ 
						array_push($wt_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt18f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt19))
					{ 
						array_push($wt_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt19f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt20))
					{ 
						array_push($wt_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt20f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt21))
					{ 
						array_push($wt_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt21f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt22))
					{ 
						array_push($wt_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt22f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt23))
					{ 
						array_push($wt_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt23f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt24))
					{ 
						array_push($wt_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt24f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt25))
					{ 
						array_push($wt_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt25f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Pt26))
					{ 
						array_push($wt_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_pt26f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}

				if ($p_format=="f_15" or $p_format=="f_hr")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}						
			}
		}
		
				if(isset($Pt1))
				{ 
					$ponts_Pt1=implode(",",$wt_pt1);
					$ponts_Pt1f=implode(",",$wt_pt1f);
				}
				if(isset($Pt2))
				{ 
					$ponts_Pt2=implode(",",$wt_pt2);
					$ponts_Pt2f=implode(",",$wt_pt2f);
				}
				if(isset($Pt3))
				{ 
					$ponts_Pt3=implode(",",$wt_pt3);
					$ponts_Pt3f=implode(",",$wt_pt3f);
				}
				if(isset($Pt4))
				{ 
					$ponts_Pt4=implode(",",$wt_pt4);
					$ponts_Pt4f=implode(",",$wt_pt4f);
				}
				if(isset($Pt5))
				{ 
					$ponts_Pt5=implode(",",$wt_pt5);
					$ponts_Pt5f=implode(",",$wt_pt5f);
				}
				if(isset($Pt6))
				{ 
					$ponts_Pt6=implode(",",$wt_pt6);
					$ponts_Pt6f=implode(",",$wt_pt6f);
				}
				if(isset($Pt7))
				{ 
					$ponts_Pt7=implode(",",$wt_pt7);
					$ponts_Pt7f=implode(",",$wt_pt7f);
				}
				if(isset($Pt8))
				{ 
					$ponts_Pt8=implode(",",$wt_pt8);
					$ponts_Pt8f=implode(",",$wt_pt8f);
				}
				if(isset($Pt9))
				{ 
					$ponts_Pt9=implode(",",$wt_pt9);
					$ponts_Pt9f=implode(",",$wt_pt9f);
				}
				if(isset($Pt10))
				{ 
					$ponts_Pt10=implode(",",$wt_pt10);
					$ponts_Pt10f=implode(",",$wt_pt10f);
				}
				if(isset($Pt11))
				{ 
					$ponts_Pt11=implode(",",$wt_pt11);
					$ponts_Pt11f=implode(",",$wt_pt11f);
				}
				if(isset($Pt12))
				{ 
					$ponts_Pt12=implode(",",$wt_pt12);
					$ponts_Pt12f=implode(",",$wt_pt12f);
					$ponts_Pt12e=implode(",",$wt_pt12e);
					$ponts_Pt12ef=implode(",",$wt_pt12fe);
				}
				if(isset($Pt13))
				{ 
					$ponts_Pt13=implode(",",$wt_pt13);
					$ponts_Pt13f=implode(",",$wt_pt13f);
				}
				if(isset($Pt14))
				{ 
					$ponts_Pt14=implode(",",$wt_pt14);
					$ponts_Pt14f=implode(",",$wt_pt14f);
				}
				if(isset($Pt15))
				{ 
					$ponts_Pt15=implode(",",$wt_pt15);
					$ponts_Pt15f=implode(",",$wt_pt15f);
				}
				if(isset($Pt16))
				{ 
					$ponts_Pt16=implode(",",$wt_pt16);
					$ponts_Pt16f=implode(",",$wt_pt16f);
				}
				if(isset($Pt17))
				{ 
					$ponts_Pt17=implode(",",$wt_pt17);
					$ponts_Pt17f=implode(",",$wt_pt17f);
				}
				if(isset($Pt18))
				{ 
					$ponts_Pt18=implode(",",$wt_pt18);
					$ponts_Pt18f=implode(",",$wt_pt18f);
				}
				if(isset($Pt19))
				{ 
					$ponts_Pt19=implode(",",$wt_pt19);
					$ponts_Pt19f=implode(",",$wt_pt19f);
				}
				if(isset($Pt20))
				{ 
					$ponts_Pt20=implode(",",$wt_pt20);
					$ponts_Pt20f=implode(",",$wt_pt20f);
				}
				if(isset($Pt21))
				{ 
					$ponts_Pt21=implode(",",$wt_pt21);
					$ponts_Pt21f=implode(",",$wt_pt21f);
				}
				if(isset($Pt22))
				{ 
					$ponts_Pt22=implode(",",$wt_pt22);
					$ponts_Pt22f=implode(",",$wt_pt22f);
				}
				if(isset($Pt23))
				{ 
					$ponts_Pt23=implode(",",$wt_pt23);
					$ponts_Pt23f=implode(",",$wt_pt23f);
				}
				if(isset($Pt24))
				{ 
					$ponts_Pt24=implode(",",$wt_pt24);
					$ponts_Pt24f=implode(",",$wt_pt24f);
				}
				if(isset($Pt25))
				{ 
					$ponts_Pt25=implode(",",$wt_pt25);
					$ponts_Pt25f=implode(",",$wt_pt25f);
				}
				if(isset($Pt26))
				{ 
					$ponts_Pt26=implode(",",$wt_pt26);
					$ponts_Pt26f=implode(",",$wt_pt26f);
				}

				if(isset($Pt1))
			   {
						 $se_Pt1='
								{
								type: "line",
								name: "'.$_namec1.'",
								data: ['.$ponts_Pt1f.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec1.'_WL",
								data: ['.$ponts_Pt1.'],
								color: "#228B22",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Pt2))
			   {
						 $se_Pt2='
								{
								type: "line",
								name: "'.$_namec2.'",
								data: ['.$ponts_Pt2f.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec2.'_WL",
								data: ['.$ponts_Pt2.'],
								color: "#528B8B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt3))
			   {
						 $se_Pt3='
								{
								type: "line",
								name: "'.$_namec3.'",
								data: ['.$ponts_Pt3f.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec3.'_WL",
								data: ['.$ponts_Pt3.'],
								color: "#A0522D",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt4))
			   {
						 $se_Pt4='
								{
								type: "line",
								name: "'.$_namec4.'",
								data: ['.$ponts_Pt4f.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec4.'_WL",
								data: ['.$ponts_Pt4.'],
								color: "#483D8B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt5))
			   {
						 $se_Pt5='
								{
								type: "line",
								name: "'.$_namec5.'",
								data: ['.$ponts_Pt5f.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec5.'_WL",
								data: ['.$ponts_Pt5.'],
								color: "#000080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt6))
			   {
						 $se_Pt6='
								{
								type: "line",
								name: "'.$_namec6.'",
								data: ['.$ponts_Pt6f.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec6.'_WL",
								data: ['.$ponts_Pt6.'],
								color: "#8B658B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt7))
			   {
						 $se_Pt7='
								{
								type: "line",
								name: "'.$_namec7.'",
								data: ['.$ponts_Pt7f.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec7.'_WL",
								data: ['.$ponts_Pt7.'],
								color: "#CD9B9B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt8))
			   {
						 $se_Pt8='
								{
								type: "line",
								name: "'.$_namec8.'",
								data: ['.$ponts_Pt8f.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec8.'_WL",
								data: ['.$ponts_Pt8.'],
								color: "#CD5555",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt9))
			   {
						 $se_Pt9='
								{
								type: "line",
								name: "'.$_namec9.'",
								data: ['.$ponts_Pt9f.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec9.'_WL",
								data: ['.$ponts_Pt9.'],
								color: "#CD6839",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt10))
			   {
						 $se_Pt10='
								{
								type: "line",
								name: "'.$_namec10.'",
								data: ['.$ponts_Pt10f.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec10.'_WL",
								data: ['.$ponts_Pt10.'],
								color: "#CD2626",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt11))
			   {
						 $se_Pt11='
								{
								type: "line",
								name: "'.$_namec11.'",
								data: ['.$ponts_Pt11f.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec11.'_WL",
								data: ['.$ponts_Pt11.'],
								color: "#EE9A00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt12))
			   {
						 $se_Pt12='
								{
								type: "line",
								name: "'.$_namec12.'",
								data: ['.$ponts_Pt12f.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_WL",
								data: ['.$ponts_Pt12.'],
								color: "#CD6600",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_E",
								data: ['.$ponts_Pt12ef.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"Dash"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_WLE",
								data: ['.$ponts_Pt12e.'],
								color: "#CD6600",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"LongDash"
								
								},';

				}
				if(isset($Pt13))
			   {
						 $se_Pt13='
								{
								type: "line",
								name: "'.$_namec13.'",
								data: ['.$ponts_Pt13f.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec13.'_WL",
								data: ['.$ponts_Pt13.'],
								color: "#CD0000",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt14))
			   {
						 $se_Pt14='
								{
								type: "line",
								name: "'.$_namec14.'",
								data: ['.$ponts_Pt14f.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec14.'_WL",
								data: ['.$ponts_Pt14.'],
								color: "#CD1076",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt15))
			   {
						 $se_Pt15='
								{
								type: "line",
								name: "'.$_namec15.'",
								data: ['.$ponts_Pt15f.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec15.'_WL",
								data: ['.$ponts_Pt15.'],
								color: "#8B4789",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt16))
			   {
						 $se_Pt16='
								{
								type: "line",
								name: "'.$_namec16.'",
								data: ['.$ponts_Pt16f.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec16.'_WL",
								data: ['.$ponts_Pt16.'],
								color: "#C71585",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt17))
			   {
						 $se_Pt17='
								{
								type: "line",
								name: "'.$_namec17.'",
								data: ['.$ponts_Pt17f.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec17.'_WL",
								data: ['.$ponts_Pt17.'],
								color: "#ECAB53",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt18))
			   {
						 $se_Pt18='
								{
								type: "line",
								name: "'.$_namec18.'",
								data: ['.$ponts_Pt18f.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_WL",
								data: ['.$ponts_Pt18.'],
								color: "#008080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt19))
			   {
						 $se_Pt19='
								{
								type: "line",
								name: "'.$_namec19.'",
								data: ['.$ponts_Pt19f.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_WL",
								data: ['.$ponts_Pt19.'],
								color: "00BB00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt20))
			   {
						 $se_Pt20='
								{
								type: "line",
								name: "'.$_namec20.'",
								data: ['.$ponts_Pt20f.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec20.'_WL",
								data: ['.$ponts_Pt20.'],
								color: "#778899",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt21))
			   {
						 $se_Pt21='
								{
								type: "line",
								name: "'.$_namec21.'",
								data: ['.$ponts_Pt21f.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec21.'_WL",
								data: ['.$ponts_Pt21.'],
								color: "#97FFFF",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt22))
			   {
						 $se_Pt22='
								{
								type: "line",
								name: "'.$_namec22.'",
								data: ['.$ponts_Pt22f.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec22.'_WL",
								data: ['.$ponts_Pt22.'],
								color: "#FFE4B5",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt23))
			   {
						 $se_Pt23='
								{
								type: "line",
								name: "'.$_namec23.'",
								data: ['.$ponts_Pt23f.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec23.'_WL",
								data: ['.$ponts_Pt23.'],
								color: "#4876FF",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt24))
			   {
						 $se_Pt24='
								{
								type: "line",
								name: "'.$_namec24.'",
								data: ['.$ponts_Pt24f.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec24.'_WL",
								data: ['.$ponts_Pt24.'],
								color: "#B0E0E6",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt25))
			   {
						 $se_Pt25='
								{
								type: "line",
								name: "'.$_namec25.'",
								data: ['.$ponts_Pt25f.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_WL",
								data: ['.$ponts_Pt25.'],
								color: "#7CFC00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt26))
			   {
						 $se_Pt26='
								{
								type: "line",
								name: "'.$_namec26.'",
								data: ['.$ponts_Pt26f.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec26.'_WL",
								data: ['.$ponts_Pt26.'],
								color: "#B0E0E6",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
	}
	else
	{

			$p_date=date("Y-m-d 07:00",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn=  24 * 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=1440;
			$b=86400;

			$start = strtotime($p_day1);
			$end = strtotime($p_day2);

			$wt_pt1=array();
		$wt_pt1f=array();
		$wt_pt2=array();
		$wt_pt2f=array();
		$wt_pt3=array();
		$wt_pt3f=array();
		$wt_pt4=array();
		$wt_pt4f=array();
		$wt_pt5=array();
		$wt_pt5f=array();
		$wt_pt6=array();
		$wt_pt6f=array();
		$wt_pt7=array();
		$wt_pt7f=array();
		$wt_pt8=array();
		$wt_pt8f=array();
		$wt_pt9=array();
		$wt_pt9f=array();
		$wt_pt10=array();
		$wt_pt10f=array();
		$wt_pt11=array();
		$wt_pt11f=array();
		$wt_pt12=array();
		$wt_pt12f=array();
		$wt_pt12e=array();
		$wt_pt12fe=array();
		$wt_pt13=array();
		$wt_pt13f=array();
		$wt_pt14=array();
		$wt_pt14f=array();
		$wt_pt15=array();
		$wt_pt15f=array();
		$wt_pt16=array();
		$wt_pt16f=array();
		$wt_pt17=array();
		$wt_pt17f=array();
		$wt_pt18=array();
		$wt_pt18f=array();
		$wt_pt19=array();
		$wt_pt19f=array();
		$wt_pt20=array();
		$wt_pt20f=array();
		$wt_pt21=array();
		$wt_pt21f=array();
		$wt_pt22=array();
		$wt_pt22f=array();
		$wt_pt23=array();
		$wt_pt23f=array();
		$wt_pt24=array();
		$wt_pt24f=array();
		$wt_pt25=array();
		$wt_pt25f=array();
		$wt_pt26=array();
		$wt_pt26f=array();

			for ( $tt = $start; $tt <= $end; $tt += 86400 )
			{	
				$dt=date("Y-m-d",$tt);
				
				if($p_format=="f_mean")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end)) FL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end)) FLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_min")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end)) FL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end)) FLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_max")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end)) FL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end)) FLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				else{}
			
				$result = odbc_exec($conn,$strQuery);
				//$checkrow=odbc_num_rows($objExec);
				$date_now = $dt.' 07:00';
				

				$stadatey=date("Y",strtotime($date_now));	
				$stadatem=date("m",strtotime($date_now));	
				$stadated=date("d",strtotime($date_now));
				$stadateh=date("H",strtotime($date_now));
				$stadatei=date("i",strtotime($date_now));
						
				$sm=$stadatey."-".$stadatem;
				
				$stadate=strtotime($date_now);
				$enddate=strtotime($date_now)+86400;
				$row = odbc_fetch_array($result);
		
				if(isset($Pt1))
				{ 
					if($row['WL_'.$_nrow1.'']==null){$val_pt1="null";}else{$val_pt1=$row['WL_'.$_nrow1.''];}
					array_push($wt_pt1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt1."]");
					if($row['FL_'.$_nrow1.'']==null){$val_pt1f="null";}else{$val_pt1f=$row['FL_'.$_nrow1.''];}
					array_push($wt_pt1f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt1f."]");
				}
				if(isset($Pt2))
				{ 
					if($row['WL_'.$_nrow2.'']==null){$val_pt2="null";}else{$val_pt2=$row['WL_'.$_nrow2.''];}
					array_push($wt_pt2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt2."]");
					if($row['FL_'.$_nrow2.'']==null){$val_pt2f="null";}else{$val_pt2f=$row['FL_'.$_nrow2.''];}
					array_push($wt_pt2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt2f."]");
				}
				if(isset($Pt3))
				{ 
					if($row['WL_'.$_nrow3.'']==null){$val_pt3="null";}else{$val_pt3=$row['WL_'.$_nrow3.''];}
					array_push($wt_pt3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt3."]");
					if($row['FL_'.$_nrow3.'']==null){$val_pt3f="null";}else{$val_pt3f=$row['FL_'.$_nrow3.''];}
					array_push($wt_pt2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt3f."]");
				}
				if(isset($Pt4))
				{ 
					if($row['WL_'.$_nrow4.'']==null){$val_pt4="null";}else{$val_pt4=$row['WL_'.$_nrow4.''];}
					array_push($wt_pt4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt4."]");
					if($row['FL_'.$_nrow4.'']==null){$val_pt4f="null";}else{$val_pt4f=$row['FL_'.$_nrow4.''];}
					array_push($wt_pt4f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt4f."]");
				}
				if(isset($Pt5))
				{ 
					if($row['WL_'.$_nrow5.'']==null){$val_pt5="null";}else{$val_pt5=$row['WL_'.$_nrow5.''];}
					array_push($wt_pt5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt5."]");
					if($row['FL_'.$_nrow5.'']==null){$val_pt5f="null";}else{$val_pt5f=$row['FL_'.$_nrow5.''];}
					array_push($wt_pt5f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt5f."]");
				}
				if(isset($Pt6))
				{ 
					if($row['WL_'.$_nrow6.'']==null){$val_pt6="null";}else{$val_pt6=$row['WL_'.$_nrow6.''];}
					array_push($wt_pt6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt6."]");
					if($row['FL_'.$_nrow6.'']==null){$val_pt6f="null";}else{$val_pt6f=$row['FL_'.$_nrow6.''];}
					array_push($wt_pt6f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt6f."]");
				}
				if(isset($Pt7))
				{ 
					if($row['WL_'.$_nrow7.'']==null){$val_pt7="null";}else{$val_pt7=$row['WL_'.$_nrow7.''];}
					array_push($wt_pt7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt7."]");
					if($row['FL_'.$_nrow7.'']==null){$val_pt7f="null";}else{$val_pt7f=$row['FL_'.$_nrow7.''];}
					array_push($wt_pt7f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt7f."]");
				}
				if(isset($Pt8))
				{ 
					if($row['WL_'.$_nrow8.'']==null){$val_pt8="null";}else{$val_pt8=$row['WL_'.$_nrow8.''];}
					array_push($wt_pt8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt8."]");
					if($row['FL_'.$_nrow8.'']==null){$val_pt8f="null";}else{$val_pt8f=$row['FL_'.$_nrow8.''];}
					array_push($wt_pt8f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt8f."]");
				}
				if(isset($Pt9))
				{ 
					if($row['WL_'.$_nrow9.'']==null){$val_pt9="null";}else{$val_pt9=$row['WL_'.$_nrow9.''];}
					array_push($wt_pt9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt9."]");
					if($row['FL_'.$_nrow9.'']==null){$val_pt9f="null";}else{$val_pt9f=$row['FL_'.$_nrow9.''];}
					array_push($wt_pt9f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt9f."]");
				}
				if(isset($Pt10))
				{ 
					if($row['WL_'.$_nrow10.'']==null){$val_pt10="null";}else{$val_pt10=$row['WL_'.$_nrow10.''];}
					array_push($wt_pt10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt10."]");
					if($row['FL_'.$_nrow10.'']==null){$val_pt10f="null";}else{$val_pt10f=$row['FL_'.$_nrow10.''];}
					array_push($wt_pt10f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt10f."]");
				}
				if(isset($Pt11))
				{ 
					if($row['RF_'.$_nrow11.'']==null){$val_pt11="null";}else{$val_pt11=$row['RF_'.$_nrow11.''];}
					array_push($wt_pt11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt11."]");
					if($row['FL_'.$_nrow11.'']==null){$val_pt11f="null";}else{$val_pt11f=$row['FL_'.$_nrow11.''];}
					array_push($wt_pt11f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt11f."]");
				}
				if(isset($Pt12))
				{ 
					if($row['WL_'.$_nrow12.'']==null){$val_pt12="null";}else{$val_pt12=$row['WL_'.$_nrow12.''];}
					array_push($wt_pt12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12."]");
					if($row['FL_'.$_nrow12.'']==null){$val_pt12f="null";}else{$val_pt12f=$row['FL_'.$_nrow12.''];}
					array_push($wt_pt12f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12f."]");
					if($row['WLE_'.$_nrow12.'']==null){$val_pt12e="null";}else{$val_pt12e=$row['WLE_'.$_nrow12.''];}
					array_push($wt_pt12e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12e."]");
					if($row['FLE_'.$_nrow12.'']==null){$val_pt12ef="null";}else{$val_pt12ef=$row['FLE_'.$_nrow12.''];}
					array_push($wt_pt12ef,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt12ef."]");
				}
				if(isset($Pt13))
				{ 
					if($row['WL_'.$_nrow13.'']==null){$val_pt13="null";}else{$val_pt13=$row['RF_'.$_nrow13.''];}
					array_push($wt_pt13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt13."]");
					if($row['FL_'.$_nrow13.'']==null){$val_pt13f="null";}else{$val_pt13f=$row['FL_'.$_nrow13.''];}
					array_push($wt_pt13f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt13f."]");
				}
				if(isset($Pt14))
				{ 
					if($row['WL_'.$_nrow14.'']==null){$val_pt14="null";}else{$val_pt14=$row['WL_'.$_nrow14.''];}
					array_push($wt_pt14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt14."]");
					if($row['FL_'.$_nrow14.'']==null){$val_pt14f="null";}else{$val_pt14f=$row['FL_'.$_nrow14.''];}
					array_push($wt_pt14f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt14f."]");
				}
				if(isset($Pt15))
				{ 
					if($row['WL_'.$_nrow15.'']==null){$val_pt15="null";}else{$val_pt15=$row['WL_'.$_nrow15.''];}
					array_push($wt_pt15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt15."]");
					if($row['FL_'.$_nrow15.'']==null){$val_pt15f="null";}else{$val_pt15f=$row['FL_'.$_nrow15.''];}
					array_push($wt_pt15f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt15f."]");
				}
				if(isset($Pt16))
				{ 
					if($row['WL_'.$_nrow16.'']==null){$val_pt16="null";}else{$val_pt16=$row['WL_'.$_nrow16.''];}
					array_push($wt_pt16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt16."]");
					if($row['FL_'.$_nrow16.'']==null){$val_pt16f="null";}else{$val_pt16f=$row['FL_'.$_nrow16.''];}
					array_push($wt_pt16f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt16f."]");
				}
				if(isset($Pt17))
				{ 
					if($row['WL_'.$_nrow17.'']==null){$val_pt17="null";}else{$val_pt17=$row['WL_'.$_nrow17.''];}
					array_push($wt_pt17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt17."]");
					if($row['FL_'.$_nrow17.'']==null){$val_pt17f="null";}else{$val_pt17f=$row['FL_'.$_nrow17.''];}
					array_push($wt_pt17f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt17f."]");
				}
				if(isset($Pt18))
				{ 
					if($row['WL_'.$_nrow18.'']==null){$val_pt18="null";}else{$val_pt18=$row['WL_'.$_nrow18.''];}
					array_push($wt_pt18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt18."]");
					if($row['FL_'.$_nrow18.'']==null){$val_pt18f="null";}else{$val_pt18f=$row['FL_'.$_nrow18.''];}
					array_push($wt_pt18f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt18f."]");
				}
				if(isset($Pt19))
				{ 
					if($row['WL_'.$_nrow19.'']==null){$val_pt19="null";}else{$val_pt19=$row['WL_'.$_nrow19.''];}
					array_push($wt_pt19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt19."]");
					if($row['FL_'.$_nrow19.'']==null){$val_pt19f="null";}else{$val_pt19f=$row['FL_'.$_nrow19.''];}
					array_push($wt_pt19f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt19f."]");
				}
				if(isset($Pt20))
				{ 
					if($row['WL_'.$_nrow20.'']==null){$val_pt20="null";}else{$val_pt20=$row['WL_'.$_nrow20.''];}
					array_push($wt_pt20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt20."]");
					if($row['FL_'.$_nrow20.'']==null){$val_pt20f="null";}else{$val_pt20f=$row['FL_'.$_nrow20.''];}
					array_push($wt_pt20f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt20f."]");
				}
				if(isset($Pt21))
				{ 
					if($row['WL_'.$_nrow21.'']==null){$val_pt21="null";}else{$val_pt21=$row['WL_'.$_nrow21.''];}
					array_push($wt_pt21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt21."]");
					if($row['FL_'.$_nrow21.'']==null){$val_pt21f="null";}else{$val_pt21f=$row['FL_'.$_nrow21.''];}
					array_push($wt_pt21f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt21f."]");
				}
				if(isset($Pt22))
				{ 
					if($row['WL_'.$_nrow22.'']==null){$val_pt22="null";}else{$val_pt22=$row['WL_'.$_nrow22.''];}
					array_push($wt_pt22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt22."]");
					if($row['FL_'.$_nrow22.'']==null){$val_pt22f="null";}else{$val_pt22f=$row['FL_'.$_nrow22.''];}
					array_push($wt_pt22f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt22f."]");
				}
				if(isset($Pt23))
				{ 
					if($row['WL_'.$_nrow23.'']==null){$val_pt23="null";}else{$val_pt23=$row['WL_'.$_nrow23.''];}
					array_push($wt_pt23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt23."]");
					if($row['FL_'.$_nrow23.'']==null){$val_pt23f="null";}else{$val_pt23f=$row['FL_'.$_nrow23.''];}
					array_push($wt_pt23f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt23f."]");
				}
				if(isset($Pt24))
				{ 
					if($row['WL_'.$_nrow24.'']==null){$val_pt24="null";}else{$val_pt24=$row['WL_'.$_nrow24.''];}
					array_push($wt_pt24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt24."]");
					if($row['FL_'.$_nrow24.'']==null){$val_pt24f="null";}else{$val_pt24f=$row['FL_'.$_nrow24.''];}
					array_push($wt_pt24f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt24f."]");
				}
				if(isset($Pt25))
				{ 
					if($row['WL_'.$_nrow25.'']==null){$val_pt25="null";}else{$val_pt25=$row['WL_'.$_nrow25.''];}
					array_push($wt_pt25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt25."]");
					if($row['FL_'.$_nrow25.'']==null){$val_pt25f="null";}else{$val_pt25f=$row['FL_'.$_nrow25.''];}
					array_push($wt_pt25f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt25f."]");
				}
				if(isset($Pt26))
				{ 
					if($row['WL_'.$_nrow26.'']==null){$val_pt26="null";}else{$val_pt26=$row['WL_'.$_nrow26.''];}
					array_push($wt_pt26,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt26."]");
					if($row['FL_'.$_nrow26.'']==null){$val_pt26f="null";}else{$val_pt26f=$row['FL_'.$_nrow26.''];}
					array_push($wt_pt26f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_pt26f."]");
				}
			}


			if(isset($Pt1))
				{ 
					$ponts_Pt1=implode(",",$wt_pt1);
					$ponts_Pt1f=implode(",",$wt_pt1f);
				}
				if(isset($Pt2))
				{ 
					$ponts_Pt2=implode(",",$wt_pt2);
					$ponts_Pt2f=implode(",",$wt_pt2f);
				}
				if(isset($Pt3))
				{ 
					$ponts_Pt3=implode(",",$wt_pt3);
					$ponts_Pt3f=implode(",",$wt_pt3f);
				}
				if(isset($Pt4))
				{ 
					$ponts_Pt4=implode(",",$wt_pt4);
					$ponts_Pt4f=implode(",",$wt_pt4f);
				}
				if(isset($Pt5))
				{ 
					$ponts_Pt5=implode(",",$wt_pt5);
					$ponts_Pt5f=implode(",",$wt_pt5f);
				}
				if(isset($Pt6))
				{ 
					$ponts_Pt6=implode(",",$wt_pt6);
					$ponts_Pt6f=implode(",",$wt_pt6f);
				}
				if(isset($Pt7))
				{ 
					$ponts_Pt7=implode(",",$wt_pt7);
					$ponts_Pt7f=implode(",",$wt_pt7f);
				}
				if(isset($Pt8))
				{ 
					$ponts_Pt8=implode(",",$wt_pt8);
					$ponts_Pt8f=implode(",",$wt_pt8f);
				}
				if(isset($Pt9))
				{ 
					$ponts_Pt9=implode(",",$wt_pt9);
					$ponts_Pt9f=implode(",",$wt_pt9f);
				}
				if(isset($Pt10))
				{ 
					$ponts_Pt10=implode(",",$wt_pt10);
					$ponts_Pt10f=implode(",",$wt_pt10f);
				}
				if(isset($Pt11))
				{ 
					$ponts_Pt11=implode(",",$wt_pt11);
					$ponts_Pt11f=implode(",",$wt_pt11f);
				}
				if(isset($Pt12))
				{ 
					$ponts_Pt12=implode(",",$wt_pt12);
					$ponts_Pt12f=implode(",",$wt_pt12f);
					$ponts_Pt12e=implode(",",$wt_pt12e);
					$ponts_Pt12ef=implode(",",$wt_pt12ef);
				}
				if(isset($Pt13))
				{ 
					$ponts_Pt13=implode(",",$wt_pt13);
					$ponts_Pt13f=implode(",",$wt_pt13f);
				}
				if(isset($Pt14))
				{ 
					$ponts_Pt14=implode(",",$wt_pt14);
					$ponts_Pt14f=implode(",",$wt_pt14f);
				}
				if(isset($Pt15))
				{ 
					$ponts_Pt15=implode(",",$wt_pt15);
					$ponts_Pt15f=implode(",",$wt_pt15f);
				}
				if(isset($Pt16))
				{ 
					$ponts_Pt16=implode(",",$wt_pt16);
					$ponts_Pt16f=implode(",",$wt_pt16f);
				}
				if(isset($Pt17))
				{ 
					$ponts_Pt17=implode(",",$wt_pt17);
					$ponts_Pt17f=implode(",",$wt_pt17f);
				}
				if(isset($Pt18))
				{ 
					$ponts_Pt18=implode(",",$wt_pt18);
					$ponts_Pt18f=implode(",",$wt_pt18f);
				}
				if(isset($Pt19))
				{ 
					$ponts_Pt19=implode(",",$wt_pt19);
					$ponts_Pt19f=implode(",",$wt_pt19f);
				}
				if(isset($Pt20))
				{ 
					$ponts_Pt20=implode(",",$wt_pt20);
					$ponts_Pt20f=implode(",",$wt_pt20f);
				}
				if(isset($Pt21))
				{ 
					$ponts_Pt21=implode(",",$wt_pt21);
					$ponts_Pt21f=implode(",",$wt_pt21f);
				}
				if(isset($Pt22))
				{ 
					$ponts_Pt22=implode(",",$wt_pt22);
					$ponts_Pt22f=implode(",",$wt_pt22f);
				}
				if(isset($Pt23))
				{ 
					$ponts_Pt23=implode(",",$wt_pt23);
					$ponts_Pt23f=implode(",",$wt_pt23f);
				}
				if(isset($Pt24))
				{ 
					$ponts_Pt24=implode(",",$wt_pt24);
					$ponts_Pt24f=implode(",",$wt_pt24f);
				}
				if(isset($Pt25))
				{ 
					$ponts_Pt25=implode(",",$wt_pt25);
					$ponts_Pt25f=implode(",",$wt_pt25f);
				}
				if(isset($Pt26))
				{ 
					$ponts_Pt26=implode(",",$wt_pt26);
					$ponts_Pt26f=implode(",",$wt_pt26f);
				}

				if(isset($Pt1))
			   {
						 $se_Pt1='
								{
								type: "line",
								name: "'.$_namec1.'",
								data: ['.$ponts_Pt1f.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec1.'_WL",
								data: ['.$ponts_Pt1.'],
								color: "#228B22",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Pt2))
			   {
						 $se_Pt2='
								{
								type: "line",
								name: "'.$_namec2.'",
								data: ['.$ponts_Pt2f.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec2.'_WL",
								data: ['.$ponts_Pt2.'],
								color: "#528B8B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt3))
			   {
						 $se_Pt3='
								{
								type: "line",
								name: "'.$_namec3.'",
								data: ['.$ponts_Pt3f.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec3.'_WL",
								data: ['.$ponts_Pt3.'],
								color: "#A0522D",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt4))
			   {
						 $se_Pt4='
								{
								type: "line",
								name: "'.$_namec4.'",
								data: ['.$ponts_Pt4f.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec4.'_WL",
								data: ['.$ponts_Pt4.'],
								color: "#483D8B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt5))
			   {
						 $se_Pt5='
								{
								type: "line",
								name: "'.$_namec5.'",
								data: ['.$ponts_Pt5f.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec5.'_WL",
								data: ['.$ponts_Pt5.'],
								color: "#000080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt6))
			   {
						 $se_Pt6='
								{
								type: "line",
								name: "'.$_namec6.'",
								data: ['.$ponts_Pt6f.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec6.'_WL",
								data: ['.$ponts_Pt6.'],
								color: "#8B658B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt7))
			   {
						 $se_Pt7='
								{
								type: "line",
								name: "'.$_namec7.'",
								data: ['.$ponts_Pt7f.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec7.'_WL",
								data: ['.$ponts_Pt7.'],
								color: "#CD9B9B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt8))
			   {
						 $se_Pt8='
								{
								type: "line",
								name: "'.$_namec8.'",
								data: ['.$ponts_Pt8f.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec8.'_WL",
								data: ['.$ponts_Pt8.'],
								color: "#CD5555",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt9))
			   {
						 $se_Pt9='
								{
								type: "line",
								name: "'.$_namec9.'",
								data: ['.$ponts_Pt9f.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec9.'_WL",
								data: ['.$ponts_Pt9.'],
								color: "#CD6839",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt10))
			   {
						 $se_Pt10='
								{
								type: "line",
								name: "'.$_namec10.'",
								data: ['.$ponts_Pt10f.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec10.'_WL",
								data: ['.$ponts_Pt10.'],
								color: "#CD2626",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt11))
			   {
						 $se_Pt11='
								{
								type: "line",
								name: "'.$_namec11.'",
								data: ['.$ponts_Pt11f.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec11.'_WL",
								data: ['.$ponts_Pt11.'],
								color: "#EE9A00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt12))
			   {
						 $se_Pt12='
								{
								type: "line",
								name: "'.$_namec12.'",
								data: ['.$ponts_Pt12f.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_WL",
								data: ['.$ponts_Pt12.'],
								color: "#CD6600",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_E",
								data: ['.$ponts_Pt12ef.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"Dash"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_WLE",
								data: ['.$ponts_Pt12e.'],
								color: "#CD6600",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"LongDash"
								
								},';

				}
				if(isset($Pt13))
			   {
						 $se_Pt13='
								{
								type: "line",
								name: "'.$_namec13.'",
								data: ['.$ponts_Pt13f.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec13.'_WL",
								data: ['.$ponts_Pt13.'],
								color: "#CD0000",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt14))
			   {
						 $se_Pt14='
								{
								type: "line",
								name: "'.$_namec14.'",
								data: ['.$ponts_Pt14f.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec14.'_WL",
								data: ['.$ponts_Pt14.'],
								color: "#CD1076",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt15))
			   {
						 $se_Pt15='
								{
								type: "line",
								name: "'.$_namec15.'",
								data: ['.$ponts_Pt15f.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec15.'_WL",
								data: ['.$ponts_Pt15.'],
								color: "#8B4789",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt16))
			   {
						 $se_Pt16='
								{
								type: "line",
								name: "'.$_namec16.'",
								data: ['.$ponts_Pt16f.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec16.'_WL",
								data: ['.$ponts_Pt16.'],
								color: "#C71585",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt17))
			   {
						 $se_Pt17='
								{
								type: "line",
								name: "'.$_namec17.'",
								data: ['.$ponts_Pt17f.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec17.'_WL",
								data: ['.$ponts_Pt17.'],
								color: "#ECAB53",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt18))
			   {
						 $se_Pt18='
								{
								type: "line",
								name: "'.$_namec18.'",
								data: ['.$ponts_Pt18f.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_WL",
								data: ['.$ponts_Pt18.'],
								color: "#008080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt19))
			   {
						 $se_Pt19='
								{
								type: "line",
								name: "'.$_namec19.'",
								data: ['.$ponts_Pt19f.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_WL",
								data: ['.$ponts_Pt19.'],
								color: "00BB00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt20))
			   {
						 $se_Pt20='
								{
								type: "line",
								name: "'.$_namec20.'",
								data: ['.$ponts_Pt20f.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec20.'_WL",
								data: ['.$ponts_Pt20.'],
								color: "#778899",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt21))
			   {
						 $se_Pt21='
								{
								type: "line",
								name: "'.$_namec21.'",
								data: ['.$ponts_Pt21f.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec21.'_WL",
								data: ['.$ponts_Pt21.'],
								color: "#97FFFF",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt22))
			   {
						 $se_Pt22='
								{
								type: "line",
								name: "'.$_namec22.'",
								data: ['.$ponts_Pt22f.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec22.'_WL",
								data: ['.$ponts_Pt22.'],
								color: "#FFE4B5",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt23))
			   {
						 $se_Pt23='
								{
								type: "line",
								name: "'.$_namec23.'",
								data: ['.$ponts_Pt23f.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec23.'_WL",
								data: ['.$ponts_Pt23.'],
								color: "#4876FF",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt24))
			   {
						 $se_Pt24='
								{
								type: "line",
								name: "'.$_namec24.'",
								data: ['.$ponts_Pt24f.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec24.'_WL",
								data: ['.$ponts_Pt24.'],
								color: "#B0E0E6",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt25))
			   {
						 $se_Pt25='
								{
								type: "line",
								name: "'.$_namec25.'",
								data: ['.$ponts_Pt25f.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_WL",
								data: ['.$ponts_Pt25.'],
								color: "#7CFC00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Pt26))
			   {
						 $se_Pt26='
								{
								type: "line",
								name: "'.$_namec26.'",
								data: ['.$ponts_Pt26f.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec26.'_WL",
								data: ['.$ponts_Pt26.'],
								color: "#B0E0E6",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
	}
		?>
		<BR>
		<div id="graphFL" ></div>
			<script type="text/javascript">
			$(function () {				 
				$(document).ready(function() {
					Highcharts.setOptions({
					lang: {	months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
					});
					var chart = new Highcharts.Chart({
						chart: {
							renderTo: 'graphFL',
							zoomType: 'x',
							//height: 500,
						    //marginBottom: 110,
							spacingRight: 20,
							spacingLeft: 20 ,
								resetZoomButton: {
								position: {
								//align: 'right', // by default
								//verticalAlign: 'top', // by default
								x: -30,
								y: -20
								}
							}
						},
						credits: {
						enabled: false
						},
						title: {
							text: '<? echo $nametype;?>',
							x: -20, //center
						style: {
							fontSize: '14px'
						}
						},
						/*legend: {
							layout: 'vertical',
							align: 'left',
							verticalAlign: 'top',
							x: 100,
							y: 35,
							floating: true,
							borderWidth: 1,
							backgroundColor: '#FFFFFF'
						},*/
						subtitle: {
						style: {
							fontSize: '12px'
							},
						verticalAlign: 'bottom',
						x: 420,
						y: -460
						},		
						xAxis: {
							type: 'datetime',
							//maxZoom: <? echo $maxZ;?>,
							minRange: '<? echo $a;?>' * 60 * 1000 * 6,
							minTickInterval: '<? echo $a;?>' * 60 * 1000,
							title: {
								text: null
							},
							labels:{
							rotation:-45,
							align:'right',
							fontSize: '8px'
								},
							dateTimeLabelFormats: {
							day: '%e %B %Y',
							week:'%e %B %Y',
							month:'%B %Y',
							year:'%Y'
						}
						},
					   yAxis: [{
							//min: '<? echo $minva;?>',
				
							//minPadding: 0.5,
							//maxPadding: 0.5,
							title: {
								text: '<?php echo $yaname;?>'
							 }
							 }
							,
							{
							//minPadding: 0.5,
							//maxPadding: 0.5,
								title: {
									text: '<?php echo $yaname2;?>'
								},
									opposite: true
							}
						],
						tooltip: {
							formatter: function() {	
								var a=undefined;
								var b='WL';
								var c='E';
								var d='WLE';

								var x = this.point.series.name;
								var sname = x.split('_');
								//alert(this.point.series.name);
								//alert(a);
								if(sname[1] ==a || sname[1] ==c)
								{
									return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+' <? echo $yname;?>';
								}
								else
								{
									return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+' <? echo $yname2;?>';
								}
							}
						},
						plotOptions: {							
							series:{marker:{enabled:false}}
						},    
						scrollbar: {
							 enabled: true
						 },
						series: [
							 <?php echo $se_Pt1?>
							<?php echo $se_Pt2?>
							 <?php echo $se_Pt3?>
							 <?php echo $se_Pt4?>
							<?php echo $se_Pt5?>
							 <?php echo $se_Pt6?>
							 <?php echo $se_Pt7?>
							 <?php echo $se_Pt8?>
							 <?php echo $se_Pt9?>
							 <?php echo $se_Pt10?>
							 <?php echo $se_Pt11?>
							 <?php echo $se_Pt12?>
							 <?php echo $se_Pt13?>
							 <?php echo $se_Pt14?>
							 <?php echo $se_Pt15?>
							<?php echo $se_Pt16?>
							<?php echo $se_Pt17?>
							<?php echo $se_Pt18?>
							 <?php echo $se_Pt19?>
							 <?php echo $se_Pt20?>
							 <?php echo $se_Pt21?>
							 <?php echo $se_Pt22?>
							 <?php echo $se_Pt23?>
							 <?php echo $se_Pt24?>
							 <?php echo $se_Pt25?>
							<?php echo $se_Pt26?>
							]
							,
							exporting: {
                         url: 'http://telepattani.com/exporting_server/index.php'
                      }
					});
						
				});

			});
			</script>
<?}?>