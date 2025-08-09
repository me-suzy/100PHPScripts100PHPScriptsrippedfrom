<?php

#########################################################
#                    QuickWhois                         #
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
#quickwhois.php                                         #
#                                                       #
#QuickWhois allows you or your site's visitors to enter #
#a domain name in the .com, .net, or .org TLDs and get  #
#the WHOIS information for that domain. Makes a great   #
#addition to a web hosting site, a network tools site,  #
#or even your personal home page.                       #
#########################################################

#Set the following configuration variable

#$template is the HTML template file you want to use
$template = "template1.html";

#########################################################
#Editing below is not required.
#########################################################

$server = "whois.crsnic.net";

#load the template file
if(!$output = file($template))
  die("Couldn't open the template file ($template). Please check and make sure that this file is where it's supposed to be.");
$output = implode("\n", $output);

#See whether or not there was a form submission
if($_POST[target]){
  if(ereg("[a-zA-Z]", $_POST[target])){
    if(eregi("\.com|\.net|\.org|\.edu", $_POST[target])){
      #Connect to the whois server
      if(!$sock = fsockopen($server, 43, $num, $error, 10)){
        unset($sock);
        $msgoutput .= "Timed-out connecting to $server (port 43)";
      }
      else{
        fputs($sock, "$_POST[target]\n");
        while (!feof($sock))
          $buffer .= fgets($sock, 10240); 
      }
      fclose($sock);
      if(!eregi("Whois Server:", $buffer)){
        if(eregi("no match", $buffer))
          $msgoutput .= "NOT FOUND: No match for $_POST[target]<br>";
        else
          $msgoutput .= "Ambiguous query, multiple matches for $_POST[target]:<br>";
      }
      else{
        $buffer = split("\n", $buffer);
        for($i=0; $i<sizeof($buffer); $i++){
          if(eregi("Whois Server:", $buffer[$i]))
            $buffer = $buffer[$i];
        }
        $nextServer = substr($buffer, 17, (strlen($buffer)-17));
        $buffer = "";
        $msgoutput .= "Deferred to specific whois server: $nextServer...<br><br>";
        if(!$sock = fsockopen($nextServer, 43, $num, $error, 10)){
          unset($sock);
          $msgoutput .= "Timed-out connecting to $nextServer (port 43)";
        }
        else{
          fputs($sock, "$_POST[target]\n");
          while(!feof($sock))
            $msgoutput .= nl2br(fgets($sock, 10240));
          fclose($sock);
        }
      }
    }
    else
      $msgoutput .= "I currently only support .com, .net, .org, and .edu.";
  }
  else
    $msgoutput .= "Can't WWWhois without a domain name";
}
else
 $msgoutput = "";

#build output for %%FORM%%
$formoutput = "<form method=\"POST\" action=\"$_SERVER[PHP_SELF]\">Whois domain: <input type=\"text\" name=\"target\"><br><input type=\"submit\" value=\"Lookup\"></form>";

$output = str_replace("%%RESULT%%", $msgoutput, $output);
$output = str_replace("%%FORM%%", $formoutput, $output);

echo $output;

?>

