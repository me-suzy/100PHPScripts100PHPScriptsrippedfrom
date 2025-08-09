<?php

#########################################################
#                     IPConvert                         #
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
#                                                       #
#IPConvert will convert an IP address into a longer,    #
#numeric address with no dots (called "DWORD" format).  #
#It can also convert either an IP address OR a domain   #
#name into hexadecimal format.                          #
#########################################################

#Set the following configuration variable

#$template is the HTML template file you want to use
$template = "template.html";

#########################################################
#Editing below is not required.                         #
#########################################################

#load the template file
if(!$output = file($template))
  die("Couldn't open the template file ($template). Please check and make sure that this file is where it's supposed to be.");
$output = implode("\n", $output);

if($_POST[method] == "DWORD"){
  list($quad1, $quad2, $quad3, $quad4) = split("\.", $_POST[ipaddr]);
  $result = ((((($quad1 * 256) + $quad2) * 256) + $quad3) * 256) + $quad4;
}
else if($_POST[method] == "Hex"){
  for($i=0; $i<strlen($_POST[ipaddr]); $i++){
    $string = sprintf("%%%X", ord($_POST[ipaddr][$i]));
    $result .= $string;
  }
}
else
  $result = "";

#build output for %%FORM%%
$formoutput = "<form method=\"POST\" action=\"$_SERVER[PHP_SELF]\"><input type=\"text\" name=\"ipaddr\"> Convert to: <select name=\"method\"><option value=\"DWORD\" selected>DWORD</option><option value=\"Hex\">Hex</option></select><br><input type=\"submit\" value=\"Convert\"></form>";

$output = str_replace("%%FORM%%", $formoutput, $output);
$output = str_replace("%%RESULT%%", $result, $output);

echo $output;

?>