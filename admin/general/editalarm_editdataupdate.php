<?
$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$fname= iconv('UTF-8','TIS-620' , $name);

if (!$name || !$phone)
{
	echo "กรอกข้อมูลไม่ครบ";
	echo "<BR><input type=button onclick=history.back(1) value=ย้อนกลับ>";
	exit;
}
$sqlup = "update [PATTANI].[dbo].[DATA_Alarmname] set  name='".$fname."',phone='".$phone."',email='".$email."' where id = '".$id."'";
$result = odbc_exec($connection,$sqlup);
if($result)
{
	echo "ข้อมูลถูกแก้ไขเรียบร้อย..."  ;
	echo "<meta http-equiv='refresh' content='2; url=index.php?menu=alarmedit'>" ;
}
else
{
	echo "เกิดข้อผิดพลาดในการทำงาน... กรุณาตรวจสอบค่าอีกครั้ง.";
	echo "<BR><input type = button  onclick = history.back(1)  value = ย้อนกลับ>";
}
?>