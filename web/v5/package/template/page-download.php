<BR>
<H3>รายงานความก้าวหน้าประจำงวดที่</H3>
<SELECT ONCHANGE="downloadit(this.value)" CLASS="bc_fade">
<?php $_call->findItem($_cfg_path['download'].'monthly', '.pdf', 'option') ?>
</SELECT>
<HR CLASS="dc_fade">

				
<H3>รายงานของโครงการ</H3>
<UL CLASS="list-item">
<?php $_call->findItem($_cfg_path['download'].'project', '.pdf', 'list') ?>
</UL>
<HR CLASS="dc_fade">


<H3>คู่มือการใช้งาน</H3>
<UL CLASS="list-item">
<?php $_call->findItem($_cfg_path['download'].'manual', '.pdf', 'list') ?>
</UL>
<HR CLASS="dc_fade">


<H3>ไฟล์นำเสนอโครงการ</H3>
<SELECT ONCHANGE="downloadit(this.value)" CLASS="bc_fade">
<?php $_call->findItem($_cfg_path['download'].'presentation', '.pdf', 'option') ?>
</SELECT>
<HR CLASS="dc_fade">


<H3>รายงาน Follow Up</H3>
<UL CLASS="list-item">
<?php $_call->findItem($_cfg_path['download'].'follow', '.pdf', 'list') ?>
</UL>


<SCRIPT TYPE="text/javascript">
function downloadit(filename)
{
	if (filename != "")
	{
		//location.href = filename;
		window.open(filename);
	}

	return false;
}
</SCRIPT>