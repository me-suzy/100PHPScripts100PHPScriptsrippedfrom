<?php

#########################################################
#                      AnonMail                         #
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
#anonmail.php                                           #
#                                                       #
#AnonMail is a PHP script which lets you or your site's #
#visitors to send "anonymous" email. You set a return   #
#address, such as "anonymous@yourhostname.com" and then #
#all messages sent through the script use that as the   #
#From address. It features password protection (NOT     #
#sent over the URL so "hackers" or unwanted visitors    #
#can't find it) and is 100% template based.             #
#########################################################

#Set the configuration variables below

#$adminpass is the password required to access the script.
#This prevents "hackers" or unwanted visitors from using
#your script to send mail using your server. CHANGE THIS
#FROM THE DEFAULT!

$adminpass = "p455w0rd";

#$fromaddr is the "From" address that will display on 
#messages

$fromaddr = "anonymous@example.com";

#$tpllogin is the location of your "Login" template.

$tpllogin = "login.html";

#$tplemail is the location of your "Compose Mail" template.

$tplemail = "email.html";

#$tplbadpass is the location of your "Invalid Password" template.

$tplbadpass = "bad_pass.html";

#$tplmailsent is the location of your "Email was Sent" template.

$tplmailsent = "email_sent.html";

#########################################################
#Editing below is not required.
#########################################################

#Check the password
if(!($_POST["p"] || $_POST["password"])){ 
  #No password, output login page
  $login = str_replace("%%ACTION%%", $_SERVER[PHP_SELF], implode("\n", file($tpllogin)));
  echo $login;
  exit;
}
else if(($_POST["p"] != md5($adminpass)) && ($_POST["password"] != $adminpass)){ 
  #Bad password, output error page
  header("Location: $tplbadpass");
  exit;
}

if($_POST["sendmail"]){
  #Valid password, user wants to send mail he's written
  mail($to, $subject, stripslashes($body), "From: $fromaddr\n", "-f$fromaddr");
  header("Location: $tplmailsent");
}
else{
  #Valid password, user has no mail pending, display mail form
  $hidden = "<input type=\"hidden\" name=\"p\" value=\"" . md5($_POST["password"]) . "\">";
  $hidden .= "<input type=\"hidden\" name=\"sendmail\" value=1>";
  $email = str_replace("%%HIDDEN%%", "$hidden", implode("\n", file($tplemail)));
  $email = str_replace("method=\"post\"", "method=\"post\" action=\"$_SERVER[PHP_SELF]\"", $email);
  echo $email;
}

?>