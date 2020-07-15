<?
if(isset($_REQUEST[save]))
{
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	
	$Dname =iconv('UTF-8', 'TIS-620',$name);

	$sql = "INSERT INTO [PATTANI].[dbo].[DATA_Alarmname] ([name] ,[phone] ,[email] ,[LAST_UPDATE]) VALUES ('".$Dname."','".$phone."','".$email."',GETDATE())";
	$rs_insert =odbc_exec($connection,$sql) or die ("cannot insert data ");
	if($rs_insert)
	{
		echo "บันทึกรายการเรียบร้อยแล้วคะ..";
		echo "<meta http-equiv='refresh' content='2; url=index.php?menu=alarmedit'>";
	}
	else
	{
		echo "เกิดข้อผิดพลาด...";
		echo "<meta http-equiv='refresh' content='2; url=index.php?menu=alarmedit'>";
	}

	?>
	<div class="filter" align="center">
		<form id="editalarm" name="editalarm" method="post" action="" onsubmit="return chkdata();">
		   <span>ชื่อ - นาสกุล:
				<input name="name" type="text" id="name" size="30" class="inpSize wShort" />
			</span>	
			<span>เบอร์โทรศัพท์:
				<input name="phone" type="text" id="phone" size="15" class="inpSize wShort" />
			</span>	
			<span>อีเมล:
				<input name="email" type="text" id="email" size="30" class="inpSize wShort" />
				<input type="submit" name="save" id="save" value="บันทึก" class="btnShow" />
			</span>	
		</form>
	</div><BR>
	<table align="center">
		<thead>
			<tr class="tr_head" style="<?=$cssTH?>">
				<th>ชื่อ - นามสกุล</th>
				<th>เบอร์โทรศัพท์ </th>
				<th>อีเมล </th>
				<th>แก้ไขข้อมูล</th>
				<th>ลบข้อมูล</th>
			</tr>
		</thead>
		<tbody>
		<?

		$sss="SELECT top 1 [id],[name] ,[phone] ,[email] FROM  [PATTANI].[dbo].[DATA_Alarmname] order by LAST_UPDATE desc";

		$rs_check =odbc_exec($connection,$sss);
		$row = 1;
		$checkrow=odbc_num_rows($rs_check);
			
			while($r_check=odbc_fetch_array($rs_check))
			{
				$Dname=iconv('TIS-620', 'UTF-8', $r_check['name']);
				$id=$r_check['id'];
		?>
				<tr class="tr_list">
					<td><? echo $Dname;?></td>
					<td><?=$r_check['phone']?></td>
					<td><?=$r_check['email']?></td>
					<td><a href="index.php?view=editalarm&name=<?echo $Dname?>"><IMG SRC="img/ic_edit.png" title="แก้ไขข้อมูล"></a></td>
					<td><a href="index.php?up=delete&name=<?echo $Dname?>"><img src="img/ic_drop.png" border="0" /></a></td>
				</tr>
		<?
				$row++;
			}	//end while		
		?>
		</tbody>
	</table>
<?
}

else
{
?>
	<div class="filter" align="center">
		<form id="editalarm" name="editalarm" method="post" action="" onsubmit="return chkdata();">
		   <span>ชื่อ - นาสกุล:
				<input name="name" type="text" id="name" size="30" class="inpSize wShort" />
			</span>	
			<span>เบอร์โทรศัพท์:
				<input name="phone" type="text" id="phone" size="15" class="inpSize wShort" />
			</span>	
			<span>อีเมล:
				<input name="email" type="text" id="email" size="30" class="inpSize wShort" />
				<input type="submit" name="save" id="save" value="บันทึก" class="btnShow" />
			</span>	
		</form>
	</div><BR>
	<table align="center">
		<thead>
			<tr class="tr_head" style="<?=$cssTH?>">
				<th>ชื่อ - นามสกุล</th>
				<th>เบอร์โทรศัพท์ </th>
				<th>อีเมล </th>
				<th>แก้ไขข้อมูล</th>
				<th>ลบข้อมูล</th>
			</tr>
		</thead>
		<tbody>
		<?
	    if($_GET[up]=="delete")
		{
			$id = $_GET['name'];
			$D_sql="delete [PATTANI].[dbo].[DATA_Alarmname] where id='".$id."'";
			$query_sql=odbc_exec($connection,$D_sql);
			if($query_sql)
			{
				echo "ลบรายการการเรียบร้อยแล้วคะ..";
				echo "<meta http-equiv='refresh' content='2; url=index.php?menu=alarmedit'>";
			}
			else
			{
				echo "เกิดข้อผิดพลาด...";
				echo "<meta http-equiv='refresh' content='2; url=index.php?menu=alarmedit'>";
			}
		}
		else
		{

		$sss="SELECT [id],[name] ,[phone] ,[email]  FROM [PATTANI].[dbo].[DATA_Alarmname] order by LAST_UPDATE desc";

		$rs_check =odbc_exec($connection,$sss);
		$row = 1;
		$checkrow=odbc_num_rows($rs_check);
			
			while($r_check=odbc_fetch_array($rs_check))
			{
				$Dname=iconv('TIS-620', 'UTF-8', $r_check['name']);
				$id=$r_check['id'];
		?>
				<tr class="tr_list">
					<td><? echo $Dname;?></td>
					<td><?=$r_check['phone']?></td>
					<td><?=$r_check['email']?></td>
					<td><a href="index.php?view=editalarm&name=<? echo $id?>"><IMG SRC="img/ic_edit.png" title="แก้ไขข้อมูล"></a></td>
					<td><a href="index.php?up=delete&name=<?echo $id?>"><img src="img/ic_drop.png" border="0" /></a></td>
				</tr>
		<?
				$row++;
			}	//end while		
		?>
		</tbody>
	</table>
<?
}	}
?>

<script language="JavaScript">
function chkdata()
{
	with(editalarm)
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
</script>