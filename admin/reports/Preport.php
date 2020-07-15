	<?
	$site_id = ( empty($_GET['site_id']) ) ? ( empty($_POST['site_id']) ) ? null : $_POST['site_id'] : $_GET['site_id'];
	$type = ( empty($_GET['type']) ) ? ( empty($_POST['type']) ) ? null : $_POST['type'] : $_GET['type'];
	$date1 = ( empty($_GET['date1']) ) ? ( empty($_POST['date1']) ) ? date('Y-m-d') : $_POST['date1'] : $_GET['date1'];
	$date2 = ( empty($_GET['date2']) ) ? ( empty($_POST['date2']) ) ? date('Y-m-d') : $_POST['date2'] : $_GET['date2'];
	?>
	
	<div class="filter" align="center">
		<form id="Preport" name="Preport" method="POST" action="./?view=table" >
		<table border="1">
			<tr>
			<td width="250" align="right">
			<span>เลือกประเภท :
				<select id="type" name="type" class="inpSize">
					<option value="DS" id="DS"<? if($type == "DS"){ echo"selected"; } ?>>ข้อมูลราย 15 นาที</option>
					<option value="MS" id="MS"<? if($type == "MS"){ echo"selected"; } ?>>ข้อมูลรายวัน</option>
					<option value="YS" id="YS"<? if($type == "YS"){ echo"selected"; } ?>>ข้อมูลรายเดือน</option>
				</select>
				</span>
			</td>
			<td width="290" align="right">
				<span>สถานี :		
				<select name="site_id" id="site_id" class="inpSize" >
					<? 
						getSiteList($site_id)					
					?>
				</select>			
			</span>		
			</td>
			<td width="250" align="right">
			<span>
				<ul id="dt1">
				เลือกช่วงเวลา:				
				 <input id="date1" name="date1" type="text"  size="10" value="<?if($date1==""){echo date('Y-m-d');} else{echo $date1;}?>"/><a href="javascript:NewCssCal('date1','yyyymmdd','false')" class="img"><img src="img/ic_calendar.jpg" align="absmiddle" alt="PickDate" /></a>
				 </ul>
				 <ul id="dt2">
				 ถึง
				 <input id="date2" name="date2" type="text" size="10" value="<?if($date2==""){echo date('Y-m-d');} else{echo $date2;}?>"/><a href="javascript:NewCssCal('date2','yyyymmdd','false')" class="img"><img src="img/ic_calendar.jpg" align="absmiddle" alt="PickDate" /></a>
				 </ul>
			</span>
			</td>
			<td align="left">
			<span>
				<input type="submit" name="search" id="search" value="ค้นหา"style="width:60px; height:50px;"  class="btnShow" />
			</span>		
			<!-- <span>
			<a href="./?menu=charts&site_id=<?=$site_id?>&type=<?=$type?>&date1=<?=$date1?>&date2=<?=$date2?>"><img src="img/LChart.png" border=0 style="width:60px; height:50px;" valign="MIDDLE"  title="กราฟ"></a>
			</span> -->
			</td>
		</tr>
	</table>
	</form>
	</div>
	
<script language="JavaScript">
function chkdata()
{
	if(site_id.value=='')
	{
		alert('กรุณากรอก สถานี');
		site_id.focus();
		return false;
	}
}
function typedate()
{
	var x = document.getElementById("type").value;
	if(x=="DB" || x=="MB") 
	{ 
		var a = "";
		var b = "";
	}
	else
	{ 
		var a = "";
		var b = "none";
	}
	document.getElementById('dt1').style.display = a;
	document.getElementById('dt2').style.display = b;
	//alert(stn[0]);
}
//typedate()
</script>