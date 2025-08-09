<?
#########################################################
#                      PortPeeker                       #
#########################################################
#                                                       #
# This script was created by:                           #
#                                                       #
# PHPSelect Web Development Division.                   #
# http://www.phpselect.com/                             #
#                                                       #
# This script and all included modules, lists or        #
# images, documentation are copyright 2002              #
# PHPSelect (http://www.phpselect.com/) unless          #
# otherwise stated in the script.                       #
#                                                       #
# Purchasers are granted rights to use this script      #
# on any site they own. There is no individual site     #
# license needed per site.                              #
#                                                       #
# Any copying, distribution, modification with          #
# intent to distribute as new code will result          #
# in immediate loss of your rights to use this          #
# program as well as possible legal action.             #
#                                                       #
# This and many other fine scripts are available at     #
# the above website or by emailing the authors at       #
# admin@phpselect.com or info@phpselect.com             #
#                                                       #
#########################################################

# NO CONFIGURATION WHATSOEVER IS REQUIRED
# WE RECOMMEND NOT EDITING THIS SCRIPT AT ALL!

set_time_limit(0);

if($_POST[iprestrict]){
  #The form was posted

  #First determine which ports need to be scanned
  $ports = array();
  switch($_POST[portrestrict]){
    case "single":
      array_push($ports, $_POST[singleport]);
      break;
    case "range":
      if(!($_POST[portstart] && $_POST[portend]))
        fail("You chose to scan a range of ports, but you didn't specify both a beginning and ending port.");
      if($_POST[portstart] > $_POST[portend])
        fail("The starting port must be a number lower than the ending port.");
      $portrange = 1;
      break;
    case "list":
      if(!$_POST[portlist])
        fail("You chose to scan a list of ports, but you did not specify any ports to scan.");
      $_POST[portlist] = str_replace(",", "", $_POST[portlist]);
      $ports = explode(" ", $_POST[portlist]);
      sort($ports);
      break;
  }

  #Next determine which IP addresses need to be scanned
  $ips = array();
  switch($_POST[iprestrict]){
    case "single":
      array_push($ips, $_POST[singleip]);
      break;
    case "range":
      if(!($_POST[ipstart] && $_POST[ipend]))
        fail("You chose to scan a range of IP addresses, but you didn't specify both a beginning and ending address.");
     if($_POST[ipstart] > $_POST[ipend])
        fail("The starting address must be lower than the ending address.");
      list($i11, $i12, $i13, $i14) = split("\.", $_POST[ipstart]);
      list($i21, $i22, $i23, $i24) = split("\.", $_POST[ipend]);
      if(!(($i11 == $i21) && ($i12 == $i22)))
        fail("PortPeeker is restricted to scanning a /16 (65025 IP addresses). The range you specified is too large.");
      $iprange = 1;
      break;
  }

  #Now start scanning!!
  echo <<<EOT
<html>
<head>
<title>PortPeeker from PHP Labs</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<h3><font face="Verdana, Arial"> PortPeeker from PHP Labs </font></h3>
<p><font face="Verdana, Arial" size="2">
EOT;
  if($iprange == 1){
    $base = "$i11.$i12.";
    for($j = $i13; (($i13 == $i23) ?  $j <=$i23 : $j<=255 ); $j++){
      for($k = (($j==$i13) ? $i14 : 0); (($i14 == $i24) ?  $k <=$i24 : $k<=255 ); $k++){
        if($portrange == 1){
          for($q = $_POST[portstart]; $q<=$_POST[portend]; $q++){
            peek("$base$j.$k", $q);
            $now = sprintf("%03d%03d%03d%03d", $i11,$i12,$j, $k);
            $end = sprintf("%03d%03d%03d%03d", $i21, $i22, $i23, $i24);
            if(($now >= $end) && ($q >= $_POST[portend])){
              finish();
            }
          }
        }
        else{
          foreach($ports as $var){
            peek("$base$j.$k", $var);
            $now = sprintf("%03d%03d%03d%03d", $i11,$i12,$j, $k);
            $end = sprintf("%03d%03d%03d%03d", $i21, $i22, $i23, $i24);
            if($now >= $end && ($var >= $ports[count($ports)-1])){
              finish();
            }
          }
        }
      }
    }
  }

  else{
    if($portrange == 1){
      for($q = $_POST[portstart]; $q<=$_POST[portend]; $q++){
        peek("$_POST[singleip]", $q);
        $now = sprintf("%03d%03d%03d%03d", $i11,$i12,$j, $k);
        $end = sprintf("%03d%03d%03d%03d", $i21, $i22, $i23, $i24);
        if(($now >= $end) && ($q >= $_POST[portend])){
          finish();
        }
      }
    }
    else{
      foreach($ports as $var){
        peek($_POST[singleip], $var);
        $now = sprintf("%03d%03d%03d%03d", $i11,$i12,$j, $k);
        $end = sprintf("%03d%03d%03d%03d", $i21, $i22, $i23, $i24);
        if(($now >= $end) && ($var >= $ports[count($ports)-1])){
          finish();
        }
      }
    }
  }
}

else{
  echo <<<EOT
<html>
<head>
<title>PortPeeker from PHP Labs</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/javascript">
function m(el) {
  if (el.defaultValue==el.value) el.value = ""
}
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<h3><font face="Verdana, Arial"> PortPeeker from PHP Labs </font></h3>
<form name="form1" method="post" action="">
<table width="95%" border="0" cellspacing="0" cellpadding="1" align="center" bgcolor="#CCCCCC">
<tr>
<td>
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center">
<tr bgcolor="#f0f0f0">
<td width="20%"><font face="Verdana, Arial" size="2"><b>IP Restrictions</b>:</font></td>
<td>
<p align="center"> <font face="Verdana, Arial" size="2">
<input type="radio" name="iprestrict" value="single" checked>
Scan only one IP:
<input type="text" name="singleip" size="20" maxlength="15" value="127.0.0.1" onFocus="m(this)">
<br>
<br>
<input type="radio" name="iprestrict" value="range">
Start at:
<input type="text" name="ipstart" value="127.0.0.1" maxlength="15" size="20" onFocus="m(this)">
stop at:
<input type="text" name="ipend" size="20" maxlength="15" value="127.0.0.255" onFocus="m(this)">
</font></p>
</td>
</tr>
<tr bgcolor="#f0f0f0">
<td><font face="Verdana, Arial" size="2"><b>Port Restrictions</b>:</font></td>
<td>
<center>
<font face="Verdana, Arial" size="2">
<input type="radio" name="portrestrict" value="single">
Scan only one port:
<input type="text" name="singleport" value="80" size="8" maxlength="5" onFocus="m(this)">
<br>
<br>
<input type="radio" name="portrestrict" value="range" checked>
Start at:
<input type="text" name="portstart" maxlength="5" size="8" value="1" onFocus="m(this)">
stop at:
<input type="text" name="portend" maxlength="5" size="8" value="65535" onFocus="m(this)">
<br>
<br>
<input type="radio" name="portrestrict" value="list">
Specify ports (separate with spaces)
<input type="text" name="portlist" value="21 22 23 25 80 110" maxlength="15" size="20" onFocus="m(this)">
</font>
</center>
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan="2" bgcolor="#f0f0f0">
<center>
<input type="submit" name="Submit" value="Start Peeking">
</center>
</td>
</tr>
</table>
</td>
</tr>
</table>
</form>
<center>
<font face="Verdana, Arial" size="1"><br>
PortPeeker - Copyright &copy; 2003 <a href="http://www.phpselect.com/"><b>PHP Labs</b></a></font>
</center>
</body>
</html>
EOT;
}

function fail($msg){
  exit($msg);
}

function peek($host, $port){
  if($sock = @fsockopen($host, $port, $err, $err)){
    fclose($sock);
    echo "<b>Open:</b> $host:$port " . getservbyport($port, 'tcp') . '<br>';
    flush();
    return 1;
  }
}

function finish(){
  echo <<<EOT
<br><b>Scanning finished!</b> <a href="$_SERVER[PHP_SELF]">Do another scan</a><br><center>
<font face="Verdana, Arial" size="1"><br>
PortPeeker - Copyright &copy; 2003 <a href="http://www.phpselect.com/"><b>PHP Labs</b></a></font>
</center>
EOT;
}

?>