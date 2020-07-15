	<div class="filter" align="center">
		<form id="Preport" name="Preport" method="POST" action="" >
		<table border="1">
			<tr>
			<td width="300" align="right">
			<span>เลือก DATABASE :
				<select id="type" name="type" class="inpSize" >
					<option value="SK" id="SK"<? if($_POST['type'] == "SK"){ echo"selected"; } ?>>SONGKRAM</option>
					<option value="KL" id="KL"<? if($_POST['type'] == "KL"){ echo"selected"; } ?>>KOLOK</option>
					<option value="PN" id="PN"<? if($_POST['type'] == "PN"){ echo"selected"; } ?>>PATTANI</option>
					<option value="PR" id="PR"<? if($_POST['type'] == "PR"){ echo"selected"; } ?>>PRANBURI</option>
				</select>
				</span>
			</td>
			<td width="500" align="right">
			<span>
				เลือกช่วงเวลา:
				 <input name="DT" type="text" id="DT" class="tcal" value="<?if($_POST['DT']==""){echo date('Y-m-d');} else{echo $_POST['DT'];}?>" />
				 ถึง
				 <input name="DT2" type="text" id="DT2" class="tcal" value="<?if($_POST['DT2']==""){echo date('Y-m-d');} else{echo $_POST['DT2'];}?>" />
			</span>
			</td>
			<td align="left">
			<span>
				<input type="submit" name="search" id="search" value="EXPORT" style="width:60px; height:50px;"  class="btnShow" />
			</span>		
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
	if(x=="SK") 
	{ 
		var a = "";
		var b = "none";
		var c = "none";
	}
	else if(x=="KL") 
	{ 
		var a = "none";
		var b = "";
		var c = "none";
	}
	else
	{ 
		var a = "none";
		var b = "none";
		var c = "";
	}
	document.getElementById('ty1').style.display = a;
	document.getElementById('ty2').style.display = b;
	document.getElementById('ty3').style.display = c;
	//alert(stn[0]);
}
typedate()
</script>