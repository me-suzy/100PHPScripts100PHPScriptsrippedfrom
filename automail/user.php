<?php
#
#AutoMail user/recipient functions script
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
#
include_once("config.php");
include_once("common.php");
if(!$db = @sql_connect())
  die(error("Fatal", "Couldn't connect to the SQL server!"));
if(!@sql_select("$sqldbname", $db))
  die(error("Fatal", "Couldn't select the database from the SQL server!"));
$options = getoptions($db);

#
# The password checking routines have been intentionally omitted
# from this script, as it must be accessible to all recipients.
#

$head = "<html><head><title>AutoMail | Serial Mailing Manager</title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head><body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000066\" topmargin=\"0\"><h2><font face=\"Verdana,Arial\">Subscription Manager</font></h2><hr><font face=\"Verdana,Arial\" size=\"2\">";

#Here are our functions
function subscribe($db){
  global $_POST, $_GET, $_SERVER, $options, $version, $head;
  #Get rid of any dumb input
  if($_POST[name]){
    $name = preg_replace("/[^A-Za-z. ]/", "", $_POST[name]);
    $email = preg_replace("/[^A-Za-z0-9.@]/", "", $_POST[email]);
  }
  else if($_GET[name]){
    $name = preg_replace("/[^A-Za-z. ]/", "", $_GET[name]);
    $email = preg_replace("/[^A-Za-z0-9.@]/", "", $_GET[email]);
  }
  else
    die("No name passed");

  #Check for sanity of field input
  if(strlen($name) > 128){
    echo $head;
    die(error("Input", "The name you entered was too long."));
  }
  if(strlen($email) > 128){
    echo $head;
    die(error("Input", "The email address you entered was too long."));
  }
  #Make sure an email address was passed in
  if(!$email){
    echo $head;
    die(error("Input", "You didn't enter an email address. Please go back and try again."));
  }
  #Check for a valid address
  if(!preg_match("/.*@.*\..*/i", $email, $result)){
    echo $head;
    die(error("Input", "The email address you entered is not valid. Please go back and try again."));
  }
  #Make sure this person does not exist in the database
  $result = @sql_query("SELECT * FROM recipients WHERE email = '$email'", $db);
  $myrow = @sql_fetch_array($result);
  if($myrow[email] == $email){
    echo $head;
    die(error("Input", "That email address is already in the database."));
  }
  #Generate a random confirmation token for this user
  srand ((double) microtime() * 1000000);
  for ($c=0;$c<128;$c++){ 
    $randnum = rand(1,9); 
    $authkey .= $randnum; 
  }
  $authkey = md5($authkey);
  $date = date("Y-m-d H:i:s");
  #Add the user to the database as inactive/unconfirmed
  if($result = @sql_query("INSERT INTO recipients (name, email, active, authkey, adddate) VALUES ('$name', '$email', -1, '$authkey', '$date')", $db)){
    $success = 1;
    #Send a confirmation email to the user
    $subject = "Subscription Confirmation";
    $body = $name ? "Hello $name,\n\n" : "Hello,\n\n";
    $body .= "You (or someone using your email address) just subscribed to the "
           . "$options[listname] mailing list. Before you receive any messages, "
           . "you MUST confirm your subscription. To do so, please visit the following "
           . "URL:\n\n$options[userscripturl]?e=$email&key=$authkey\n\nIf your email program "
           . "has split that address into multiple lines, you will need to reassemble it "
           . "before visiting.\n\nIf you are not the person who subscribed to this list, "
           . "you can ignore this notice and you will not receive any email. The "
           . "subscription request came from the IP address $_SERVER[REMOTE_ADDR].";
    $headers = "X-Mailer: AutoMail v $version (http://www.phpselect.com/)";
    $headers .= "\nX-Envelope-Recipient: $email";
    $headers .= "\nFrom: $options[fromaddr]";
    $envelope = "-f$options[fromaddr]";
    mail($email, $subject, $body, $headers, $envelope); 
  }
  if($success){
    if($options[redirsubsuccurl]){
      header("Location: $options[redirsubsuccurl]");
      exit;
    }
    else{
      echo <<<EOT
$head<b>Success!</b><br><br>Your email address ($email) has been added to our mailing list. A verification email was just sent to this address, with instructions for confirming your subscription. You must follow these instructions before you will receive any further email.</font></body></html>
EOT;
      exit;
    }
  }
  else{
    if($options[redirsubfailurl]){
      header("Location: $options[redirsubfailurl]");
      exit;
    }
    else{
      echo <<<EOT
$head<b>Failure</b><br><br>An error was encountered and your email address was not added. Please try again later.</font></body></html>
EOT;
      exit;
    }
  }
}

function confirm($db){
  global $_GET, $_SERVER, $head, $options;
  #Get rid of any dumb input
  $authkey = preg_replace("/[^A-Za-z0-9]/", "", $_GET[key]);
  $email = preg_replace("/[^A-Za-z0-9.@]/", "", $_GET[e]);
  #Check for sanity of input
  if((strlen($authkey) > 128) || (strlen($email) > 128)){
    echo $head;
    die(error("", "There was a problem with the parameters you passed."));
  }
  #Get this user from the database
  $result = @sql_query("SELECT * FROM recipients WHERE email = '$email'", $db);
  $myrow = @sql_fetch_array($result);
  if(! ($myrow[email] == $email)){
    echo $head;
    die(error("Address", "$email is not in the database."));
  }
  #Verify the auth key
  if(! ($myrow[authkey] == $authkey)){
    echo $head;
    die(error("Authorization", "That isn't a valid confirmation key. If your email program split the confirmation URL into multiple lines, please reassemble it into a single line and try again."));
  }
  #Update the record with confirmation info
  $date = date("Y-m-d H:i:s");
  if($result = @sql_query("UPDATE recipients SET active=1, received=0, lastmail='0000-00-00 00:00:00', authip='$_SERVER[REMOTE_ADDR]', authdate='$date' WHERE email='$email'", $db)){
    $success = 1;
  }
  if($success){
    #Send this user the first message
    $result = @sql_query("SELECT * FROM recipients WHERE email='$email'", $db);
    $myrow = @sql_fetch_array($result);
    sendmsg($myrow, 1, $db);
    #And update the record
    $date = date("Y-m-d H:i:s");
    $update = @sql_query("UPDATE recipients SET received=1, lastmail='$date' WHERE email='$email'", $db);
    if($options[notify] == 1){
      #Notify admin if necessary
      $headers = "From: $options[fromaddr]";
      $subject = "[AutoMail] $email just signed up!";
      $body = "$email just confirmed his subscription and was added to the AutoMail list.";
      $envelope = "-f$options[fromaddr]";
      mail($options[fromaddr], $subject, $body, $headers, $envelope);
    }

    if($options[redirconsuccurl]){
      header("Location: $options[redirconsuccurl]");
      exit;
    }
    else{
      if($options[delay] == 1)
        $future = "day or so";
      else
        $future = "$options[delay] days";
      echo <<<EOT
$head<b>Success!</b><br><br>Your subscription for $email has been confirmed. You are now an active member of our mailing list, and we have sent you an email. You should expect to receive another email within the next $future.</font></body></html>
EOT;
      exit;
    }
  }
  else{
    if($options[redirconfailurl]){
      header("Location: $options[redirconfailurl]");
      exit;
    }
    else{
      echo <<<EOT
$head<b>Failure</b><br><br>An error was encountered and your email address was not confirmed. Please try again later.</font></body></html>
EOT;
      exit;
    }
  }
}

function unsubscribe($db){
  global $_GET, $options, $head;
  #Get rid of any dumb input
  $id = preg_replace("/[^0-9]/", "", $_GET[i]);
  $email = preg_replace("/[^A-Za-z0-9.@]/", "", $_GET[e]);
  #Check for sanity of input
  if(($id > 8388607) || (strlen($email) > 128)){
    echo $head;
    die(error("", "There was a problem with the parameters you passed. If your email program split the confirmation URL into multiple lines, please reassemble it into a single line and try again."));
  }
  #Get this user from the database
  $result = @sql_query("SELECT * FROM recipients WHERE email = '$email'", $db);
  $myrow = @sql_fetch_array($result);
  if(! ($myrow[email] == $email)){
    echo $head;
    die(error("Address", "That email address is not in the database."));
  }
  if(! ($myrow[active] == 1)){
    echo $head;
    die(error("Address", "That email address is not subscribed."));
  }
  #Confirm that the ID matches
  if(! ($myrow[id] == $id)){
    echo $head;
    die(error("Input", "That isn't a valid ID number for $email. If your email program split the unsubscribe URL into multiple lines, please reassemble it into a single line and try again."));
  }
  #Remove the address
  if($result = @sql_query("UPDATE recipients SET active=2 WHERE email='$email' AND id='$id'", $db)){
    $success = 1;
  }
  if($success){
    if($options[notify] == 1){
      #Notify admin if necessary
      $headers = "From: $options[fromaddr]";
      $subject = "[AutoMail] $email just unsubscribed!";
      $body = "$email unsubscribed and will not receive any more mail.";
      $envelope = "-f$options[fromaddr]";
      mail($options[fromaddr], $subject, $body, $headers, $envelope);
    }
    if($options[redirunssuccurl]){
      header("Location: $options[redirunssuccurl]");
      exit;
    }
    else{
      echo <<<EOT
$head<b>Success!</b><br><br>Your have been unsubscribed from the mailing list. You will not receive any more email unless you decide to subscribe again in the future.</font></body></html>
EOT;
      exit;
    }
  }
  else{
    if($options[redirunsfailurl]){
      header("Location: $options[redirunsfailurl]");
      exit;
    }
    else{
      echo <<<EOT
$head<b>Failure</b><br><br>An error was encountered and you could not be unsubscribed. Please try again later.</font></body></html>
EOT;
      exit;
    }
  }
}

if($_GET[e] && $_GET[i]){
  unsubscribe($db);
  exit;
}

if($_POST[email] || $_GET[email]){
  subscribe($db);
  exit;
}

if($_GET[key]){
  confirm($db);
  exit;
}
?>