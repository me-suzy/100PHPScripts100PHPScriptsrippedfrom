#!/usr/local/bin/php
<?php
#
#AutoMail autoresponder script - ADVANCED USERS ONLY!
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
#This script allows you to establish an autoresponder, 
#so that users can email your autoresponder address and 
#automatically be subscribed to your list as a result.
#
#In order to use this script, you MUST have root access 
#on your machine and be able to edit your 
#/etc/mail/aliases file (or the equivalent). You will 
#need to alias or pipe the target email address to this 
#file, wherever it's installed on your system. For 
#example, on a FreeBSD system running sendmail, you 
#would add to /etc/mail/aliases:
#
#signup: |/usr/local/apache/htdocs/automail/autoresponder.php
#
#And then rebuild the aliases database (FreeBSD: 
#cd /etc/mail && make). Then when someone sends email to
#signup@yourdomain, they will receive a subscription 
#confirmation.
#
#This script is NOT SUPPORTED as a part of AutoMail, 
#and is provided as an experimental tool only.
#

include_once("config.php");
include_once("common.php");
if(!$db = @sql_connect()){
  #TODO: Send error email message
  return;
}
if(! @sql_select("$sqldbname", $db)){
  #TODO: Send error email message
  return;
}
$options = getoptions($db);

#We'll be needing STDIN, so define it if it's not defined already.
if (version_compare(phpversion(),'4.3.0','<')){
  define('STDIN',fopen("php://stdin","r"));
  define('STDOUT',fopen("php://stdout","r"));
  define('STDERR',fopen("php://stderr","r"));
  register_shutdown_function( create_function( '' , 'fclose(STDIN);
  fclose(STDOUT); fclose(STDERR); return true;' ) );
}

#Obtain the inbound email message
while(!feof(STDIN)){
  $inbound .= fread(STDIN, 10240);
  if(feof(STDIN)) break;
}

#Determine who sent the message
preg_match("/From: .*/i", $inbound, $result);
$email = trim(str_replace("From: ", "", $result[0]));
$email = preg_match("/[A-Za-z0-9]*@[A-Za-z0-9]*.[A-Za-z0-9]*/i", $email, $result);
$email = preg_replace("/[^A-Za-z0-9.@]/", "", $result[0]);
if(strlen($email) > 128){
  #TODO: Send error email message
  return;
}

#Make sure this person does not exist in the database
$result = @sql_query("SELECT * FROM recipients WHERE email = '$email'", $db);
$myrow = @sql_fetch_array($result);
if($myrow[email] == $email){
  #TODO: Send error email message
  return;
}

#Now add this person to the DB and send a confirm message
#Generate a random confirmation token for this user
srand ((double) microtime() * 1000000);
for ($c=0;$c<128;$c++){ 
  $randnum = rand(1,9); 
  $authkey .= $randnum; 
}
$authkey = md5($authkey);
$date = date("Y-m-d H:i:s");
#Add the user to the database as inactive/unconfirmed
if($result = @sql_query("INSERT INTO recipients (name, email, active, authkey, adddate) VALUES ('$email', '$email', -1, '$authkey', '$date')", $db)){
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
         . "you can ignore this notice and you will not receive any email.";
  $headers = "X-Mailer: AutoMail v $version (http://www.phpselect.com/)";
  $headers .= "\nX-Envelope-Recipient: $email";
  $headers .= "\nFrom: $options[fromaddr]";
  $envelope = "-f$options[fromaddr]";
  mail($email, $subject, $body, $headers, $envelope);  
}

?>