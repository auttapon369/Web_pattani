<?
function numa($value)
{
	$aa=$value;
	if($aa=="")
	{ 
		$aa = ""; 
	}
	else
	{ 
		$aa = number_format($aa, 2, '.', '');
	}  
	return $aa;
}
$id = $_GET['name'];
$sql="SELECT [id],[name] ,[phone] ,[email] FROM [PATTANI].[dbo].[DATA_Alarmname] where id= '$id'";
$result = odbc_exec($connection,$sql);
$row = odbc_fetch_array($result);
$aname = iconv('TIS-620', 'UTF-8', $row['name']);	
$phone = $row['phone'];	
$email = $row['email'];	
$id = $row['id'];	
?>
<form action="" method="post" name="form1" id="form1" onsubmit="return chkdata();">
	<table class="form">
		<caption>แก้ไขข้อมูล</caption>
		<tr>
			<td width="160" align="right">ID :</td>
			<td align="left"><input type="text" name="id" id="id"  readonly value= "<? echo $id; ?>"/></td>
		</tr>
		<tr>
			<td width="160" align="right">ชื่อ - นาสกุล :</td>
			<td align="left"><input type="text" name="name" id="name" value= "<? echo $aname; ?>"/></td>
		</tr>
		<tr>
			<td align="right">เบอร์โทรศัพท์ :</td>
			<td align="left"><input type="text" name="phone" id="phone" value= "<? echo $phone; ?>"/></td>
		</tr>
		<tr>
			<td align="right">อีเมล :</td>
			<td align="left"><input type="text" name="email" id="email" value= "<? echo $email; ?>"/></td>
		</tr>
		<tr>
			<td></td>
			<td align="left"><input type="submit" name="Submit" id="Submit" value="ยืนยัน" />
			<input type="button" onclick="history.back(1)" value="ยกเลิก"></td>
		</tr>
	</table>
</form>

<script language="JavaScript">
function chkdata()
{
	with(form1)
	{
		if(name.value=='')
		{
			alert('กรุณากรอกชื่อ');
			name.focus();
			return false;
		}
		
		if(phone.value=='')
		{
			alert('กรุณากรอกเบอร์โทรศัพท์');
			phone.focus();
			return false;
		}
	

		if(email.value=='')
		{
			alert('กรุณากรอกอีเมล');
			email.focus();
			return false;
		}

		var tel=document.getElementById('phone').value;
		var tel=tel.replace(/\,$/,""); //ตัดเครื่องหมาย , ตัวสุดท้ายออกเพื่อเผลอใส่เข้ามา
		var tel=tel.split(",");
		var telLen=tel.length;
		for(i=0;i<telLen;i++){
			var telNum=tel[i].length;
			if(telNum!=10){
				alert('หมายเลขนี้ '+tel[i]+' ไม่ครบ 10 หลักค่ะ'); return false;
			}else{
				var part=/^(08|09)[0-9]{8}$/
				if(!tel[i].match(part)){
					alert('หมายเลข'+tel[i]+'ไม่ถูกต้องค่ะ'); return false;
				}  
			}
		}

		
		var emailFilter=/^.+@.+\..{2,3}$/;
		var str=document.editalarm.email.value;
			if (!(emailFilter.test(str))) 
			{ alert ("ท่านใส่อีเมล์ไม่ถูกต้อง");   return false;}
   
	}
}