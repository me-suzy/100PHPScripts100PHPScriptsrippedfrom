<?php
#
#AutoMail main script
#
#########################################################
#                     AutoMail                          #
#########################################################
#                                                       #
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
?>

<html>
<head>
<title>AutoMail | Serial Mailing Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#000066" topmargin="0">
<h2><font face="Verdana,Arial">AutoMail - Administrative Menu</font></h2><hr>

<?
include_once("config.php");
include_once("common.php");
if(!$db = @sql_connect())
  die(error("Fatal", "Couldn't connect to the SQL server!"));
if(! @sql_select("$sqldbname", $db))
  die(error("Fatal", "Couldn't select $sqldbname from the SQL server!"));

$options = getoptions($db);

#is this the first run?
if($optresult = @sql_query("SELECT password FROM options where confirm > -1", $db)){
  if($myrow = @sql_fetch_array($optresult)){
    if($myrow[password] == 'q'){
      echo <<<EOT
<p><font face="Verdana, Arial" size="2">This appears to be your first time running 
AutoMail. Before you can proceed, you must set an administrative password.</font></p><form name="password" method="post" action="options.php"><table width="50%" border="0" cellspacing="0" cellpadding="0"><tr><td width="50%"><font face="Verdana, Arial" size="2">Password:</font></td><td> <font face="Verdana, Arial" size="2"><input type="password" name="passwd1"></font></td></tr><tr><td><font face="Verdana, Arial" size="2">Verify:</font></td><td> <font face="Verdana, Arial" size="2"><input type="password" name="passwd2"></font></td></tr><tr><td>&nbsp;</td><td><input type="hidden" name="changepass" value="1"><input type="submit" name="Submit" value="Set Password"></td></tr></table><div align="left"></div></form>
EOT;
      exit;
    }
  }
  else
    die(error("Fatal", "Couldn't look up a record from the database. Did you forget to run install.php?"));
}
else
  die(error("Fatal", "Couldn't connect to the database!"));

#Check the password
if($_GET["p"])
  $_GET["password"] = base64_decode($_GET["p"]);
else if($_POST["p"])
  $_GET["password"] = base64_decode($_POST["p"]);
if(!$_POST["password"]){
  if(!$_GET["password"]){
    echo <<<EOT
<p><font face="Verdana, Arial" size="2">Please enter your password to continue: </font><form name="password" method="post" action="$_SERVER[PHP_SELF]"><input type="password" name="password">&nbsp;<input type="submit" name="Submit" value="Login"></form></font>
EOT;
    exit;
  }
  else{
    if(@passcheck($_GET["password"], $db)!= 1)
      die(error("Authentication", "Invalid password."));
    $b64pass = base64_encode($_GET["password"]);
  }
}
else{
  if(@passcheck($_POST["password"], $db) != 1)
    die(error("Authentication", "Invalid password."));
  $b64pass  = base64_encode($_POST["password"]);
}

#If the required options are not defined, force them to be set


#Here are our functions

function addrecipient($name, $email, $db){
  echo "<font face=\"Verdana,Arial\" size=\"2\">";
  #Make sure an email address was passed in
  if(!$email){
    echo "You didn't enter an email address. Recipient was not added.<hr>";
    return;
  }
  #Check for a valid address
  if(!preg_match("/.*@.*\..*/i", $email, $result)){
    echo "Invalid email address. Recipient was not added.<hr>";
    return;
  }
  #Make sure this person does not exist in the database
  $result = @sql_query("SELECT * FROM recipients WHERE email = '$email'", $db);
  $myrow = @sql_fetch_array($result);
  if($myrow[email] == $email){
    echo "$email is already in the database. Recipient was not added.<hr>";
    return;
  }
  #Now attempt to add the record
  $date = date("Y-m-d H:i:s");
  if(!$result = @sql_query("INSERT INTO recipients (email, name, active, adddate, received, lastmail) VALUES ('$email', '$name', 1, '$date', 1, '$date')", $db)){
    echo "Error creating a record in the database. Recipient was not added.<hr>";
    return;
  }
  else{
    echo "$email was added to the database, and has received the first message!<hr>";
  }
  #Send the mail
  $result = @sql_query("SELECT * FROM recipients WHERE email='$email'", $db);
  $myrow = @sql_fetch_array($result);
  sendmsg($myrow, 1, $db);
}

function remove($email, $db){
  echo "<font face=\"Verdana,Arial\" size=\"2\">";
  #Make sure an email address was passed in
  if(!$email){
    echo "You didn't enter an email address. Recipient was not removed.<hr>";
    return;
  }
  #Check for a valid address
  if(!preg_match("/.*@.*\..*/i", $email, $result)){
    echo "Invalid email address. Recipient was not removed.<hr>";
    return;
  }
  #Make sure the address exists in the database
  if(!$result = @sql_query("SELECT * FROM recipients WHERE email='$email'", $db)){
    echo "Error querying the database!<hr>";
    return;
  }
  else{
    if(!$myrow = @sql_fetch_array($result)){
      echo "$email was not found in the database.<hr>";
      return;
    }
  }
  #Now delete the address from the database
  if(!$result = @sql_query("DELETE FROM recipients WHERE email='$email'", $db)){
    echo "Error deleting $email from the database!<hr>";
    return;
  }
  else{
    echo "$email was removed from the database, and will not receive more mail.<hr>";
  }
}

function recipients(){
  global $_POST, $_SERVER, $b64pass, $db;

  echo "<font size=\"2\" face=\"Verdana, Arial\">";

  if($_POST[emailinfo] != ""){
    #Display this user's details
    $result = @sql_query("SELECT * FROM recipients WHERE email='$_POST[emailinfo]'", $db);
    $myrow = @sql_fetch_array($result);
    if($_POST[emailinfo] != $myrow[email]){
      echo "$_POST[emailinfo] was not found in the database.<hr>";
      printrecipform();
      return;
    }
    if($myrow[authkey]){
      $addedby = "User subscribed himself";
      $confinfo = "Confirmation key: $myrow[authkey]<br>Confirmed on: $myrow[authdate]<br>";
      $confinfo .="Confirmed by IP: $myrow[authip]";
    }
    else{
      $addedby = "User added manually by administrator";
      $confinfo = "No confirmation info available";
    }
    echo <<<EOT
<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
<td width="50%"> 
<div align="right"><font size="2" face="Verdana, Arial">Recipient Name: &nbsp;&nbsp;&nbsp;</font></div>
</td>
<td> 
<div align="left"><font size="2" face="Verdana, Arial">$myrow[name]</font></div>
</td>
</tr>
<tr> 
<td> 
<div align="right"><font size="2" face="Verdana, Arial">Email Address: &nbsp;&nbsp;&nbsp;</font></div>
</td>
<td> 
<div align="left"><font size="2" face="Verdana, Arial">$myrow[email]</font></div>
</td>
</tr>
<tr> 
<td> 
<div align="right"><font size="2" face="Verdana, Arial">Messages Received: &nbsp;&nbsp;&nbsp;</font></div>
</td>
<td> 
<div align="left"><font size="2" face="Verdana, Arial">$myrow[received]</font></div>
</td>
</tr>
<tr> 
<td> 
<div align="right"><font size="2" face="Verdana, Arial">Date Added: &nbsp;&nbsp;&nbsp;</font></div>
</td>
<td> 
<div align="left"><font size="2" face="Verdana, Arial">$myrow[adddate]</font></div>
</td>
</tr>
<tr> 
<td> 
<div align="right"><font size="2" face="Verdana, Arial">Last Message Received: &nbsp;&nbsp;&nbsp;
</font></div>
</td>
<td> 
<div align="left"><font size="2" face="Verdana, Arial">$myrow[lastmail]</font></div>
</td>
</tr>
<tr> 
<td> 
<div align="right"><font size="2" face="Verdana, Arial">Added By: &nbsp;&nbsp;&nbsp;</font></div>
</td>
<td> 
<div align="left"><font size="2" face="Verdana, Arial">$addedby</font></div>
</td>
</tr>
<tr> 
<td> 
<div align="right"><font size="2" face="Verdana, Arial">Confirmation Info: &nbsp;&nbsp;&nbsp;</font></div>
</td>
<td> 
<div align="left"><font size="2" face="Verdana, Arial">$confinfo</font></div>
</td>
</tr>
</table>
<hr>
EOT;
  }

  if($_POST[listactive]){
  #Print a list of active recipients
  echo "Active recipients: <br><br>";
  $result = @sql_query("SELECT * FROM recipients WHERE active=1", $db);
  if($myrow = @sql_fetch_array($result))
    do{
      echo "$myrow[email]<br>";
    } while($myrow = @sql_fetch_array($result));
  echo "<hr>";
  }

  if($_POST[listall]){
  #Print a list of active recipients
  echo "All current and former recipients: <br><br>";
  $result = @sql_query("SELECT * FROM recipients WHERE active>-1", $db);
  if($myrow = @sql_fetch_array($result))
    do{
      echo "$myrow[email]<br>";
    } while($myrow = @sql_fetch_array($result));
  echo "<hr>";
  }
printrecipform();
}
  #Print out the recipient page
function printrecipform(){
  global $_POST, $_SERVER, $b64pass;
  echo <<<EOT
<form method="post" action="$_SERVER[PHP_SELF]">
<div align="center"><font size="2" face="Verdana, Arial">Email address: 
<input type="text" name="emailinfo">
<input type="hidden" name="function" value="recipients">
<input type="hidden" name="p" value="$b64pass">
</font> <br>
<input type="submit" value="Lookup User Details">
</div>
</form>
<hr>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<form method="post" action="$_SERVER[PHP_SELF]">
<div align="center">
<input type="hidden" name="function" value="recipients">
<input type="hidden" name="p" value="$b64pass">
<input type="hidden" name="listactive" value="1">
<input type="submit" value="List Active Recipients">
</div>
</form>
</td>
<td>
<form name="" method="post" action="$_SERVER[PHP_SELF]">
<div align="center">
<input type="hidden" name="function" value="recipients">
<input type="hidden" name="p" value="$b64pass">
<input type="hidden" name="listall" value="1">
<input type="submit" value="List All Recipients">
</div>
</form>
</td>
</tr>
</table>
<hr>
<center>
<form method="post" action="index.php">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$_POST[p]">
<input type="submit" value="Return to Menu">
</font> 
</form></center>
<hr>
EOT;
  include("foot.php");
  exit;
}

#Determine whether or not there are any functions to run
if($_POST["function"] == "add"){
  addrecipient($_POST["name"], $_POST["email"], $db);
}
if($_POST["function"] == "remove"){
  remove($_POST["removemail"], $db);
}
if($_POST["function"] == "recipients"){
  recipients();
}

#Display the main administrative page
echo <<<EOT
<center>
<b><font face="Verdana, Arial" size="2">What would you like to do?</font></b><font face="Verdana, Arial" size="2"><br><br>
</font><font face="Verdana, Arial" size="2"><br>
</font> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" valign="middle"> 
<form method="post" action="$_SERVER[PHP_SELF]">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$b64pass">
<input type="hidden" name="function" value="add">
Name: 
<input type="text" name="name">
(optional)<br>
Email Address: 
<input type="text" name="email">
<br>
<input type="submit" value="Add New Recipient">
</font> 
</form>
</td>
<td align="center" valign="middle"> 
<form method="post" action="$_SERVER[PHP_SELF]">
<input type="hidden" name="function" value="remove">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$b64pass">
Email Address: 
<input type="text" name="removemail">
<br>
<input type="submit" value="Remove Recipient">
</font> 
</form>
</td>
</tr>
</table>
<hr>
<form method="post" action="process.php">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$b64pass">
<input type="submit" value="Process Today's Mail">
<br>
<font size="1">(Click only once, may take awhile)</font></font> 
</form>
<hr><br>
</center>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr align="center" valign="top"> 
<td>
<form method="post" action="$_SERVER[PHP_SELF]">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$b64pass">
<input type="hidden" name="function" value="recipients">
<input type="submit" value="Recipients">
</font> 
</form>
</td>
<td> 
<form method="post" action="messages.php">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$b64pass">
<input type="submit" value="Edit Messages">
</font> 
</form>
</td>
<td> 
<form method="post" action="options.php">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$b64pass">
<input type="submit" value="Options/Setup">
</font> 
</form>
</td>
</tr>
</table>
<hr>
EOT;

include("foot.php");

echo "</body></html>";

?>