<?php

#########################################################
#                      8-Ball                           #
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
#8ball.php                                              #
#                                                       #
#This script will answer user-submitted questions in    #
#the style of the "Magic 8-Ball." You can set your own  #
#answers, as well as the output attributes.             #
#########################################################

#Set the following configuration options:

#$answers is an array containing all possible responses 
#the 8-ball will give.

$answers = array("Heck no!", "Not bloody likely.", "The possibilities look good...", "How should I know?", "Maybe.", "The answer looks hazy...", "Are you crazy? OF COURSE!", "Naaah.", "Anything's possible!", "I tend to doubt it.", "For sure!!");

#$template is the template file the script will use to 
#format the output. This should be an HTML file with the 
#appropriate tokens placed where you'd like the 
#corresponding values to appear. See the INSTALL.txt file
#for more information.

$template = "template1.html";

#########################################################
#Editing below is not required.                         #
#########################################################

#load the template file
if(!$output = file($template))
  die("Couldn't open the template file ($template). Please check and make sure that this file is where it's supposed to be.");
$output = implode("\n", $output);

#build output for %%FORM%%
$formoutput = "<form method=\"POST\" action=\"$_SERVER[PHP_SELF]\"><input type=\"hidden\" name=\"posted\" value=1><input type=\"text\" name=\"question\"><br><input type=\"submit\" value=\"Ask\"></form>";

#Answer a question if one was posted
if($_POST[posted]){
  srand((double)microtime() * 1000000); 
  $answeroutput = $_POST[question] ? $answers[rand(0, (sizeof($answers)-1))] : "I can only answer if you ask a question!";
}
else
  $answeroutput = "";

#replace tokens

$output = str_replace("%%FORM%%", $formoutput, $output);
$output = str_replace("%%ANSWER%%", $answeroutput, $output);

echo $output;

?>
