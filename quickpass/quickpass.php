<?php

#########################################################
#                       QuickPass                       #
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
#quickpass.php                                          #
#                                                       #
#This script will generate a random password based upon #
#the length entered by the user. Great for any site     #
#which uses password protected areas, this script can   #
#prevent your users from choosing passwords that would  #
#be easily guessed. Let them generate one instead!      #
#########################################################

#Set the following configuration variables

#$minlength is the minimum allowed length for a generated 
#password.

$minlength = 6;

#$maxlength is the maximum allowed length for a generated 
#password.

$maxlength = 18;

#$template is the template file the script will use to 
#format the output. This should be an HTML file with the
#appropriate token placed where you'd like the generated 
#password to appear. See the INSTALL.txt file included 
#with this script for more information.

$template = "template-result.html";

#########################################################
#Editing below is not required.                         #
#########################################################

srand((double)microtime() * 1000000);

#load the template file
if(!$output = file($template))
  die("Couldn't open the template file ($template). Please check and make sure that this file is where it's supposed to be.");
$output = implode("\n", $output);

#check the input
if(($_POST[length] < $minlength) || ($_POST[length] > $maxlength)){
  #if the user entered a bad length, generate a password of mean length
  $_POST[length] = (($minlength + $maxlength) / 2);
  $badlength = 1;
}

#generate a random password
for($i=0; $i<$_POST[length]; $i++){
  $randnum = rand(48, 122);
  if(($randnum > 57) && ($randnum < 90))
    while($randnum < 65)
      $randnum = rand(48, 90);
  if(($randnum > 90) && ($randnum < 122))
    while($randnum < 97)
      $randnum = rand(97, 122);
  $password .= chr($randnum);
}

if($badlength)
  $password .= " (we created a password with " . $_POST[length] . " characters because you entered an invalid length)";

$output = str_replace("%%RESULT%%", $password, $output);

echo $output;

?>