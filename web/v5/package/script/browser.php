<?php
function chkBrowser($nameBroser)
{  
	return preg_match("/".$nameBroser."/", $_SERVER['HTTP_USER_AGENT']);  
}

// allow for server capture cctv
if ( $_SERVER["REMOTE_ADDR"] != $_cfg_conn['host'] )
{
	if ( chkBrowser("MSIE") == 1 )
	{	
		// IE
		if ( chkBrowser("MSIE 6") == 1 OR chkBrowser("MSIE 7") == 1 OR chkBrowser("MSIE 8") == 1 )
		{
			echo "<H1>Please Update to IE9 or above.</H1>";
			echo "<P>The project currently supports and will attempt to fix bugs for IE9 and above. The continuous integration server runs all the tests against IE10</P>";
			//include($_cfg_path['script'].'server.php');
			exit();
		}
		else
		{  
			// IE อื่นๆ   
		}     
	}
	else if ( chkBrowser("Firefox") == 1 )
	{  
		// Firefox  
	}
	else if ( chkBrowser("Chrome") == 1 )
	{  
		// Chrome  
	}
	else if ( chkBrowser("Chrome") == 0 && chkBrowser("Safari") == 1 )
	{  
		// Safari  
	}
	else if ( chkBrowser("Opera") == 1 )
	{  
		// Opera  
	}
	else if ( chkBrowser("Netscape") == 1 )
	{  
		// Netscape  
	}
	else
	{  
		// Other  
	}
}
?>  