<?php
#
#AutoMail message editing script
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
<h2><font face="Verdana,Arial">AutoMail - Message Editor</font></h2><hr>

<?
include_once("config.php");
include_once("common.php");
$db = @sql_connect();
@sql_select("$sqldbname", $db);

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

#Here are our functions
function senditnow($db){
  #We should send the posted message to all people in the database
  if(!$result = @sql_query("SELECT * FROM recipients WHERE active=1", $db)){
    echo "Error selecting recipients from the database!";
    exit;
  }

  #Cycle through the list and send each message
  if($myrow = @sql_fetch_array($result)){
    echo '<font face="Verdana, Arial" size="2">';
    do{
      $munged = strtok($myrow[email], "@") . "@[hidden]";
      sendmsgnow($myrow, $_POST[msgnum], $db);
      echo "Message sent to $munged ... <br>";
      $sent++;
      flush();
    } while($myrow = @sql_fetch_array($result));
    echo '</font><hr>';
  }
}


function editmsg($db){
  global $_POST;
  extract($_POST);

  #Is this an update request?
  if($savemsg){
    if($msgnum != 0){
    #Check for data sanity
      if(! ($subject && $message)){
        die(error("", "You need to specify both a subject and a message. Please go back and complete the form. If you want to delete this message, use the \"Delete Message\" button."));
      }
      if(strlen($subject)>255){
        die(error("", "The subject you entered was too long. There is a maximum of 255 characters. Please go back and enter a shorter subject."));
      }
      if(strlen($message)>65535){
        die(error("", "The message you entered was too long. There is a maximum of 65535 characters. Please go back and enter a shorter message."));
      }
      #Determine the internal ID of this message
      $result = @sql_query("SELECT * FROM messages ORDER BY id LIMIT $msgnum", $db);
      while($i<$msgnum){
        $myrow = @sql_fetch_array($result);
        $i++;
      }
      $id = $myrow[id];
    }
    #Escape single-quotes in the message
    $subject = stripslashes($subject);
    $message = stripslashes($message);
    $subject = str_replace("'", "\\'", $subject);
    $message = str_replace("'", "\\'", $message);
    #Update the message
    if($msgnum != 0){
      $result = @sql_query("UPDATE messages SET subject='$subject', message='$message' WHERE id=$id", $db);
      $message = "<font size=\"2\" face=\"Verdana, Arial\">The message has been updated.<hr>";
    }
    else{
      if($subject && $message){
        $result = @sql_query("INSERT INTO messages(subject, message) VALUES('$subject', '$message')", $db);
        $message = "<font size=\"2\" face=\"Verdana, Arial\">The message has been added.<hr>";
      }
    }
    #Refresh the row contents
    if($msgnum != 0)
      $result = @sql_query("SELECT * FROM messages WHERE id=$id", $db);
    else
      $result = @sql_query("SELECT * FROM messages WHERE subject='$subject'", $db);
    $myrow = @sql_fetch_array($result);
    echo $message;
  }

  #Is this a delete request?
  if($deletemsg){
    #Determine the internal ID of this message
    $result = @sql_query("SELECT * FROM messages ORDER BY id LIMIT $msgnum", $db);
    while($i<$msgnum){
      $myrow = @sql_fetch_array($result);
      $i++;
    }
    $id = $myrow[id];
    #Delete the message
    $result = @sql_query("DELETE FROM messages WHERE id=$id", $db);
    #Refresh the row contents
    $result = @sql_query("SELECT * FROM messages WHERE id=$id", $db);
    $myrow = @sql_fetch_array($result);
    echo "<font size=\"2\" face=\"Verdana, Arial\">The message has been deleted.<hr>";
    return;
  }

  $msgnum = $msgnum ? $msgnum : str_replace("Edit ", "", $number);
  #Select the appropriate message
  $result = @sql_query("SELECT * FROM messages ORDER BY id LIMIT $msgnum", $db);
  while($i<$msgnum){
    $myrow = @sql_fetch_array($result);
    $i++;
  }
  $myrow[message] = htmlspecialchars($myrow[message]);
  #Print out the message editor view
  echo <<<EOT
<font size="2" face="Verdana, Arial">After making changes, use the "Save Message" button to update the message. To delete this message entirely, use the "Delete Message" button.<br><br>
Tip: You can have AutoMail insert the recipient's name into the message by placing %%NAME%% where you want the name to appear. If the recipient's name is not known, AutoMail will use their email address instead.</font><hr>
<center><form method="POST" action="$_SERVER[PHP_SELF]">
<input type="hidden" name="savemsg" value="yes">
<input type="hidden" name="msgnum" value="$msgnum">
<input type="hidden" name="function" value="editmsg">
<input type="hidden" name="p" value="$_POST[p]">
<p><font size="2" face="Verdana, Arial">Subject: 
<textarea name="subject" rows="1" cols="50">$myrow[subject]</textarea>
</font></p>
<p><font size="2" face="Verdana, Arial">Message Body:<br>
<textarea name="message" rows="10" cols="65">$myrow[message]</textarea>
</font></p>
<input type="submit" value="Save Message">
</form>
<form method="POST" action="$_SERVER[PHP_SELF]">
<input type="hidden" name="deletemsg" value="yes">
<input type="hidden" name="msgnum" value="$msgnum">
<input type="hidden" name="function" value="editmsg">
<input type="hidden" name="p" value="$_POST[p]">
<input type="submit" value="Delete Message">
</form>
<form method="POST" action="$_SERVER[PHP_SELF]">
<input type="hidden" name="sendmsg" value="yes">
<input type="hidden" name="msgnum" value="$msgnum">
<input type="hidden" name="function" value="sendmsg">
<input type="hidden" name="p" value="$_POST[p]">
<input type="submit" value="Send Message Now">
</form>
</center>

<hr><center>
<form method="post" action="index.php">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$_POST[p]">
<input type="submit" value="Return to Menu">
</font> 
</form></center><hr>
EOT;
  include("foot.php");
  exit;
}

#Determine whether or not there are any functions to run
if($_POST["function"] == "editmsg"){
  editmsg($db);
}
else if($_POST["function"] == "sendmsg"){
  senditnow($db);
}

#List all messages and give edit options
$msgnum=0;
echo <<<EOT
<font size="2" face="Verdana, Arial">The Message Editor allows 
you to create, edit, and delete messages in your series. To change or delete an 
existing message, simply click the &quot;Edit&quot; button next to its subject. 
To add a new message, use the &quot;Add Message&quot; button.</font><hr>
<p align="center"><font size="2" face="Verdana, Arial"> <b>Current Messages</b></font></p>
<form method="post" action="$_SERVER[PHP_SELF]">
<input type="hidden" name="p" value="$_POST[p]">
<input type="hidden" name="function" value="editmsg">
<table width="80%" border="1" cellspacing="0" cellpadding="5" align="center">
EOT;
$result = @sql_query("SELECT * FROM messages ORDER BY id ASC", $db);
if($myrow = @sql_fetch_array($result)){
  do{
    #Print out this message's information
    $msgnum++;
    echo <<<EOT
<tr> 
<td align="center" valign="middle" width="10%"> 
<font size="2" face="Verdana, Arial">#$msgnum</font>
</td>
<td align="center" valign="middle"><font size="2" face="Verdana, Arial">$myrow[subject]</font></td>
<td align="center" valign="middle" width="20%"> 
<font face="Verdana, Arial" size="2"> 
<input type="submit" name="number" value="Edit $msgnum">
</font>
</td>
</tr>
EOT;
  } while($myrow = @sql_fetch_array($result));
}
echo <<<EOT
</table></form>
<center>
<form method="POST" action="$_SERVER[PHP_SELF]">
<input type="hidden" name="msgnum" value="0">
<input type="hidden" name="savemsg" value="yes">
<input type="hidden" name="function" value="editmsg">
<input type="hidden" name="p" value="$_POST[p]">
<input type="submit" value="Add Message">
</form>
</center>

<hr><center>
<form method="post" action="index.php">
<font face="Verdana, Arial" size="2"> 
<input type="hidden" name="p" value="$_POST[p]">
<input type="submit" value="Return to Menu">
</font> 
</form></center><hr>
EOT;
include("foot.php");

?>