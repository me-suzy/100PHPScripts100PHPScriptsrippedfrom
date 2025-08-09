<?php

#########################################################
#                    Advanced Trivia                    #
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
#trivia.php  AdvancedTrivia                             #
#                                                       #
#This script will present user-defined trivia questions #
#along with choices and determine whether or not the    #
#visitor entered the correct answer. Features randomized#
#question and choice order along with 100% templates.   #
#########################################################

#Set the following configuration options:

#$triviadb is the text file containing your questions, 
#choices, and answers. By default, that file is called
#triviadb.txt in the same directory as this script.

$triviadb = "triviadb.txt";

#$template is the template file the script will use to 
#format the output. This should be an HTML file with the 
#appropriate tokens placed where you'd like the 
#corresponding values to appear. See the INSTALL.txt file 
#for more information.

$template = "template1.html";

#$showanswer determines whether or not to display the 
#correct answer if the user submits an incorrect answer. 
#1 means yes, 0 means no.

$showanswer = 1;

#$progressive determines whether the user is given another
#random question after answering a question. If $progressive
#is set to 0, the script will only display the results from
#the previous question. If set to 1, it will display the 
#results along with another question. Because questions are
#chosen in random order, it's possible that the same question
#will appear twice in a row during a progressive game.

$progressive = 1;

#########################################################
#Editing below is not required. To customize your trivia 
#questions, choices, and answers, see the triviadb.txt 
#file that came with this script.
#########################################################

#load the template file
if(!$output = file($template))
  die("Couldn't open the template file ($template). Please check and make sure that this file is where it's supposed to be.");
$output = implode("\n", $output);

#load the data file
if(!$data=file($triviadb))
  die("Couldn't open the trivia database file ($triviadb). Please check and make sure that this file is where it's supposed to be.");

#populate the question/choices/answer arrays
$questions = array(); $choices = array(); $answer = array();
for($i=0, $j=0; $i<sizeof($data); $i++){
  #ignore comments and blank lines in the trivia file
  if((strncmp($data[$i], "#", 1) != 0) && (strlen($data[$i]) > 1)){
    list($questions[$j], $choices[$j], $answer[$j]) = split("\|", trim($data[$i]));
    $j++; 
  }
}

#Judge the user's answer, if one was submitted
if($_POST[question]){
  if($_POST[answer]){
    #Remove slashes that came through as submitted data
    $_POST[question] = stripslashes($_POST[question]);
    #Find the relevant question in the array
    $i = 0; 
    foreach($questions as $val){
      if($val == $_POST[question]){
        break;
      }
      $i++;
    }
    #Did the user get it right?
    if(strcasecmp($_POST[answer], $answer[$i]) == 0)
      $resultoutput = "Correct!<hr>";
    else{
      $message = $showanswer ? "The correct answer was $answer[$i]" : "";
      $resultoutput= "Incorrect! $message<hr>";
    }
  }
  else
    $resultoutput= "You didn't type in an answer! <hr>";
  #Should we show another question?
  if(!$progressive)
    exit;
}
else
  $resultoutput = "";

#Pick a random question, set of choices, and answer
srand((double)microtime() * 1000000);
$rand = rand(0, (sizeof($questions)-1));
$currentchoices = explode("~", $choices[$rand]);
shuffle($currentchoices);

#build output for %%CHOICES%%
for($i=0; $i<sizeof($currentchoices); $i++)
  $choiceoutput .= "$currentchoices[$i]<br>";

#build output for %%FORM%%
$formoutput = "<form method=\"POST\" action=\"$_SERVER[PHP_SELF]\"><input type=\"hidden\" name=\"question\" value=\"" . htmlspecialchars($questions[$rand]) . "\"><input type=\"text\" name=\"answer\"><br><input type=\"submit\" value=\"Answer\"></form>";

#replace tokens
$output = str_replace("%%RESULT%%", $resultoutput, $output);
$output = str_replace("%%QUESTION%%", $questions[$rand], $output);
$output = str_replace("%%CHOICES%%", $choiceoutput, $output);
$output = str_replace("%%FORM%%", $formoutput, $output);

echo $output;

?>
