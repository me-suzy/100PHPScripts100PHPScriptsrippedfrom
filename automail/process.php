<?php
#
#AutoMail email processing script
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
<h2><font face="Verdana,Arial">AutoMail - Mail Processing</font></h2><hr>

<?
include_once("config.php");
include_once("common.php");
$db = @sql_connect();
@sql_select("$sqldbname", $db);

#
# The password checking routines have been intentionally omitted
# from this script. There is no harm in having an unauthorized
# user attempt to process the day's messages.
#
?>

<div><font size="2" face="Verdana,Arial" color="#000000">Processing today's mail...<br><br>

<?
#Figure out the total number of messages
if(!$result = @sql_query("SELECT COUNT(*) FROM messages", $db)){
  echo "Error selecting message count from the database!";
  exit;
}
if(!$myrow = @sql_fetch_array($result)){
  echo "Error selecting message count from the database!";
  exit;
}
$series = $myrow[0];

#Load the options array
$options = getoptions($db);

#Figure out today's date
$today = date("Ymd");

#Determine who should get mail today
if(!$result = @sql_query("SELECT * FROM recipients WHERE active=1", $db)){
  echo "Error selecting recipients from the database!";
  exit;
}

#Cycle through the list and send each message
if($myrow = @sql_fetch_array($result)){
  do{
    $munged = strtok($myrow[email], "@") . "@[hidden]";
    #Mark user inactive if he has already received all emails
    if($myrow[received] >= $series){
      @sql_query("UPDATE recipients SET active=0 WHERE email='$myrow[email]'", $db);
      echo "$munged has received all messages and is being marked inactive.<br>";
      continue;
    }
    #See whether or not the user is due for a new message
    list($last, $junk) = explode(" ", $myrow[lastmail]);
    $last = str_replace("-", "", $last);
    if(! ($today >= ($last + $options[delay]))){
      continue;
    }
    #Now send the message the user needs to receive
    $msgnum = $myrow[received] + 1;
    echo "Sending message $msgnum to $munged<br>";
    sendmsg($myrow, $msgnum, $db);
    $sent++;
    #Update the record
    $date = date("Y-m-d H:i:s");
    $update = @sql_query("UPDATE recipients SET received=$msgnum, lastmail='$date'", $db);
    flush();
  } while($myrow = @sql_fetch_array($result));
}
if(!$sent){
  echo "<br>There was no mail to send today.";
}
echo <<<EOT
<br><br>
<form method="post" action="index.php">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$_POST[p]">
<input type="submit" value="Return to Menu">
</font> 
</form>
</body>
</html>
EOT;
?>