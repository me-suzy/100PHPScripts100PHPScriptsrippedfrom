<?php
session_start();
require 'include.inc';

$sql = "SELECT point_inc FROM user where id='".$id."'";
	$result = mysql_query( $sql );
	if ( $result != false )
	{
		while ( $data = mysql_fetch_assoc( $result ) )
		{

			$_SESSION['point_inc'] = $data['point_inc'];	
		}
	} else {
		echo mysql_error();
	}
	
$sql = "SELECT * FROM points where userid='".$id."'";
	$result = mysql_query( $sql );
	if ( $result != false )
	{
		while ( $data = mysql_fetch_assoc( $result ) )
		{

			$_SESSION['user_points'] = $data['points'];	
		}
	} else {
		echo mysql_error();
	}

	
pageHeader($title, $bgColor, $styleSheet);
?>
<table width=100% height="60" border="0" cellspacing="0" cellpadding="0" bgcolor="<? print $bg_color2;?>">
  <tr>
    <td width="100"> <table border="0" width="100" height="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td align=left><font color="white" style="text-decoration:underline"><a href="start.php" ><strong>HOME</strong></a></font></td>
        </tr>
        <tr>
          <td align=left><a href="#"><font color="white" style="text-decoration:underline" onClick="report();"><strong>REPORT</strong></font></a></td>
        </tr>
      </table></td>
    <td><center>
        <? include ("banner.php"); ?>
      </center></td>
    <TD align="right"><CENTER> <table cellpadding=0 style="border:solid black 1px;">
        <Tr>
          <Td><center> <div style="background:blue;width:80px" id="countDownText"></div></center>
          </td>
        </tr>
      </table></center></td>
    <td align="right"> <table border="0" width="100" height="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td align=right><div id="countDownText"></div>
            <font onClick="postaction();">
            <div id="next"></div>
            </font></td>
        </tr>
        <tr>
          <td align=right><a href="#"><font color="white" style="text-decoration:underline" onClick="pause();"><strong>PAUSE</strong></font></a></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</HTML>
<script language="JavaScript1.2">
	var duration=25;
	var minimum=10;
	var mode='Click';
	var countDownText;
	//document.getElementById("next").visibility='hidden';
	
	function postaction(){
	  top.location = "surf.php?userid=<? echo $id; ?>&username=<? echo $username; ?>";
	}
	
var countDownTime=duration
	function initializebar(){
		startIE=setInterval("increase()",1000)
	}


	function increase(){
	  if (minimum >= 0){
		document.getElementById("countDownText").innerHTML='<center><strong><font color=red>'+minimum+'</font><font color=white> seconds left to get credit</font></strong></center>'
	  } else {
		document.getElementById("countDownText").innerHTML='<center><strong><font color=white>Click Next<br>or wait</font> <font color=red>'+countDownTime+'</font></strong></center>'
		document.getElementById("next").innerHTML='<strong><a href="#"><font color=white style=text-decoration:underline onClick=postaction()>NEXT</font></a></strong>';
		
	  }
	  if (countDownTime<=duration){
		window.status="User: <? print $username;  ?> |  <? print $_SESSION['user_points']; ?>"
		countDownTime--
		minimum--
	  } else {
		window.status="Paused"
		document.getElementById("countDownText").innerHTML='<center><strong><font color=white>Paused</font></strong></center>'
		document.getElementById("next").innerHTML='<strong><a href="#"><font onClick=postaction() color=white>RESUME</font></a></strong>';
	  }
	  if (countDownTime==0) {
		window.status=''
		clearInterval(startIE)
		postaction()
	  }
	}

	window.onload=initializebar

	function repr2() {
	  top.location = "report.php?userid=<? echo $id; ?>&username=<? echo $username; ?>&zz=<? print $_SESSION['random_urlid']; ?>";
	}
	function report() {
	  input_box=confirm("Click OK to report user #<? print $_SESSION['random_urlid']; ?>");
	  if (input_box==true) {
		repr2()
	  }
	}
	function pause() {
			countDownTime=3600;
	}

	</script>
