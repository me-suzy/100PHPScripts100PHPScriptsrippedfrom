<?php
#
#AutoMail options/preferences script
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
<h2><font face="Verdana,Arial">AutoMail - Options Menu</font></h2><hr>

<?
include_once("config.php");
include_once("common.php");
if(!$db = @sql_connect())
  die(error("Fatal", "Couldn't connect to the SQL server!"));
if(! @sql_select("$sqldbname", $db))
  die(error("Fatal", "Couldn't select $sqldbname from the SQL server!"));
$options = getoptions($db);

#Password change request
if($_POST[changepass]){
  if($result = @sql_query("SELECT password FROM options where confirm > -1", $db)){
    if($myrow = @sql_fetch_array($result)){
      if(($myrow[password]==md5($_POST[currentpass])) || ($myrow[password]=='q')){
        #update the password
        if($_POST[passwd1] == $_POST[passwd2]){
          $newpass = md5($_POST[passwd2]);
          @sql_query("UPDATE options SET password='$newpass' WHERE confirm > -1", $db);
          echo "<font face=\"Verdana,Arial\", size=\"2\">";
          echo "Password updated. You will need to return to the <a href=\"index.php\">";
          echo "main page</a> and login.</font>";
          exit;
        }
        else{
          die(error("Fatal", "The passwords did not match, please go back and try again."));
        }
      }
      else{
        die(error("Fatal", "You supplied an incorrect current password."));
      }
    }
  }
}

#Options save request
if($_POST[saveoptions]){
  echo "<font face=\"Verdana,Arial\", size=\"2\">";
  #Check input for sanity
  extract($_POST);
  #Make sure everything was posted
  if(!($fromaddr && $notify && $delay && $mainscripturl && $userscripturl)){
    die(error("", "You did not fill out all of the option fields. Please go back and try again."));
  }
  #Check for a valid return address
  if(!preg_match("/.*@.*\..*/i", $fromaddr, $result)){
    die(error("", "You specified an invalid return address. Please go back and try again."));
  }
  #Check for a valid delay value
  if(($delay < 1) || ($delay > 365)){
    die(error("", "You specified an invalid delay value (allowed: 1-365). Please go back and try again."));
  }
  #Make sure user entered a valid mainscripturl
  if(eregi("example.com", $mainscripturl)){
    die(error("", "You specified an invalid Main URL value. Please go back and enter the URL to your installed copy of AutoMail's index.php."));
  }
  #Make sure user entered a valid userscripturl
  if(eregi("example.com", $userscripturl)){
    die(error("", "You specified an invalid User URL value. Please go back and enter the URL to your installed copy of AutoMail's user.php."));
  }
  #Make sure user entered a valid listname
  if(!$listname){
    die(error("", "You didn't specify a List Name. Please go back and fill out the List Name field."));
  }
  #Check length of headers, if applicable
  if(strlen($headers) > 255){
    die(error("", "Your custom headers exceeded the maximum of 255 allowed characters. Please go back and shorten your extra header options."));
  }

  #Now save the options
  $notifynum = ($notify == "Yes") ? 1 : 0;
  $result = @sql_query("UPDATE options SET fromaddr='$fromaddr', notify=$notifynum, delay=$delay, mainscripturl='$mainscripturl', userscripturl='$userscripturl', redirsubsuccurl='$redirsubsuccurl', redirsubfailurl='$redirsubfailurl', redirunssuccurl='$redirunssuccurl', redirunsfailurl='$redirunsfailurl', redirconsuccurl='$redirconsuccurl', redirconfailurl='$redirconfailurl', listname='$listname', headers='$headers' where notify>-1", $db);  

  echo "Options saved.<hr>"; 
  $options = getoptions($db);
}

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

#Determine whether or not there are any functions to run
#if($_POST["function"] == "add"){
#  addrecipient($_POST["name"], $_POST["email"], $db);
#}
#if($_POST["function"] == "remove"){
#  remove($_POST["removemail"], $db);
#}

#Display the main options page
if($options[notify])
  $notifyyes = " selected";
else
  $notifyno = " selected";
echo <<<EOT
<font face="Verdana, Arial" size="2">Here you can set all of the 
preferences used by AutoMail. These options can be changed at any time. Required 
settings are marked with an asterisk, and must be given a value; settings with 
no asterisk can be left blank. When you're finished editing the options, be sure 
to use the &quot;Set Options&quot; button to save the changes.</font>
<p align="left"><font face="Verdana, Arial" size="2">You can also <a href="#chpasswd">change 
your password</a> on this page.</font></p>
<hr>
<form name="" method="post" action="$_SERVER[PHP_SELF]">
<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Return address</b>: All mail that 
AutoMail sends will use this email address as the &quot;From&quot; address. You 
must set this to a valid email address that you control.</font><br><br></td>
<td width="40%" align="center"><font size="2" face="Verdana, Arial">Return address: 
<input type="text" name="fromaddr" value="$options[fromaddr]">
* </font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Notify</b>: When set to &quot;Yes,&quot; 
you will be notified via email (to the address specified above) when someone adds himself to or removes himself from the mailing list. <br><br></font></td>
<td align="center"><font size="2" face="Verdana, Arial">Notify: 
<select name="notify">
<option value="Yes"$notifyyes>Yes</option>
<option value="No"$notifyno>No</option>
</select>
* </font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>List Name</b>: The name you want AutoMail to use when it refers to your list in email messages. This happens in two places: confirmation messages sent to recipients who sign themselves up, and at the bottom of each email AutoMail sends.</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">List Name: 
<input type="text" name="listname" value="$options[listname]">
* </font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Delay</b>: The delay, in days, between 
each message sent to a recipient. For example, if you want your recipients to receive one message 
per week, set Delay to 7.</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">Delay: 
<input type="text" name="delay" size="5" maxlength="3" value="$options[delay]">
* </font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Main URL</b>: In order to generate 
some internal links, AutoMail needs to know where it's installed. You should set 
Main URL to the internet address of AutoMail's index.php file, e.g. http://example.com/automail/index.php</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">Main URL 
<input type="text" name="mainscripturl" value="$options[mainscripturl]">
* </font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>User URL</b>: Specify the URL to AutoMail's 
user.php file here. AutoMail uses this URL to generate confirmation and unsubscribe 
links in email messages.</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">User URL: 
<input type="text" name="userscripturl" value="$options[userscripturl]">
* </font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Signup Success URL</b>: When a user is successful at signing himself up for the list, AutoMail will print out a default message to indicate the success. If you'd rather have the user get redirected to a custom page (to match your site layout, etc.) instead of seeing the default message, you can specify the URL here.</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">Custom Redirect URL:<br> 
<input type="text" name="redirsubsuccurl" value="$options[redirsubsuccurl]"></font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Signup Failure URL</b>: When a user is NOT successful at signing himself up for the list, AutoMail will print out a default message to indicate the failure. If you'd rather have the user get redirected to a custom page (to match your site layout, etc.) instead of seeing the default message, you can specify the URL here.</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">Custom Redirect URL:<br>
<input type="text" name="redirsubfailurl" value="$options[redirsubfailurl]"></font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Unsubscribe Success URL</b>: When a user is successful at removing himself from the list, AutoMail will print out a default message to indicate the success. If you'd rather have the user get redirected to a custom page (to match your site layout, etc.) instead of seeing the default message, you can specify the URL here.</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">Custom Redirect URL:<br>
<input type="text" name="redirunssuccurl" value="$options[redirunssuccurl]"></font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Unsubscribe Failure URL</b>: When a user is NOT successful at removing himself from for the list, AutoMail will print out a default message to indicate the failure. If you'd rather have the user get redirected to a custom page (to match your site layout, etc.) instead of seeing the default message, you can specify the URL here.</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">Custom Redirect URL:<br>
<input type="text" name="redirunsfailurl" value="$options[redirunsfailurl]"></font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Confirm Success URL</b>: When a user is successful at confirming his subscription the list, AutoMail will print out a default message to indicate the success. If you'd rather have the user get redirected to a custom page (to match your site layout, etc.) instead of seeing the default message, you can specify the URL here.</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">Custom Redirect URL:<br>
<input type="text" name="redirconsuccurl" value="$options[redirconsuccurl]"></font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Confirm Failure URL</b>: When a user is NOT successful at confirming his subscription to the list, AutoMail will print out a default message to indicate the success. If you'd rather have the user get redirected to a custom page (to match your site layout, etc.) instead of seeing the default message, you can specify the URL here.</font><br><br></td>
<td align="center"><font size="2" face="Verdana, Arial">Custom Redirect URL:<br>
<input type="text" name="redirconfailurl" value="$options[redirconfailurl]"></font></td>
</tr>
<tr> 
<td><font size="2" face="Verdana, Arial"><b>Headers</b>: You can specify extra 
mail headers to be included in outgoing email messages (max 255 characters). Place one header per line. 
Extra headers are completely optional; most users will not have a need for this 
setting.</font></td>
<td align="center"><font size="2" face="Verdana, Arial">Headers:<br>
<textarea name="headers" rows="5" cols="30">$options[headers]</textarea>
</font></td>
</tr>
<tr> 
<td colspan="2"> 
<div align="center"> 
<input type="hidden" name="saveoptions" value="1">
<input type="hidden" name="p" value="$b64pass">
<input type="submit" value="Save Options">
</div>
</td>
</tr>
</table>
</form>
<hr>
<form name="password" method="post" action="options.php">
<center><font size="2" face="Verdana, Arial"><b><a name="chpasswd"></a>Change Password:</b> 
</font> 
<table width="50%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Current 
Password:</font></td>
<td><font face="Verdana, Arial" size="2">
<input type="password" name="currentpass">
</font></td>
</tr>
<tr>
<td width="50%"><font face="Verdana, Arial" size="2">New Password:</font></td>
<td> <font face="Verdana, Arial" size="2">
<input type="password" name="passwd1">
</font></td>
</tr>
<tr>
<td><font face="Verdana, Arial" size="2">Verify New Password:</font></td>
<td> <font face="Verdana, Arial" size="2">
<input type="password" name="passwd2">
</font></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
<input type="hidden" name="changepass" value="1">
<input type="submit" name="Submit" value="Set Password">
</td>
</tr>
</table>
<div align="left"></div></center></form>

</center>
<hr><center>
<form method="post" action="index.php">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$_POST[p]">
<input type="submit" value="Return to Menu">
</font> 
</form></center>
<hr>
EOT;

include("foot.php");

echo "</body></html>";
?>