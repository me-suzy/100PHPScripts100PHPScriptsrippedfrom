<?php
#########################################################
#                     FileMailer                        #
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
#stats.php                                              #
#                                                       #
#FileMail lets you require visitors to submit their name#
#and email address in order to retrieve a file from your#
#site. Upon submitting the information, the file is sent#
#to the visitor via email. This is a great way to stop  #
#leeching and third-party linking of your files, and    #
#it also lets you know exactly who's obtaining your     #
#files! You can use the stored name/email address info  #
#to build a mailing list or newsletter.                 #
#########################################################

#########################################################
#Editing below is not required.                         #
#########################################################

#List emails if requested
if($_POST[emails]){
  if(!$stats = file("stats/emails.txt"))
    die("Couldn't open the email log file (stats/emails.txt). Please check and make sure that this file is where it's supposed to be.");
  for($i=0; $i<sizeof($stats); $i++){
    list($name, $email, $file) = split("\|", trim($stats[$i]));
    echo "$name:$email<br>";
  }
  exit;
}
#Open the database file
if(!$stats = file("stats/database.txt"))
  die("Couldn't open the database file (stats/database.txt). Please check and make sure that this file is where it's supposed to be.");

echo <<<EOT
<html><body bgcolor="ffffff"><font face="verdana,arial" size="2">
<table width="90%"><tr bgcolor="#00cc99"><td width="50%" align="center"><b>File Name:</b></td><td width="50%" align="center"><b>Downloads:</b></td></tr>
EOT;

for($i=0; $i<sizeof($stats); $i++){
  list($file, $count) = split("\|", trim($stats[$i]));
  $color = $i % 2 ? "#cccccc" : "#99cccc";
  echo "<tr bgcolor=\"$color\"><td><b>$file</b></td><td><b>$count</b></td></tr>";
}

echo <<<EOT
</table></font><br><br><center><form method="post" action="$_SERVER[PHP_SELF]"><input type="hidden" name="emails" value="1"><input type="submit" value="List Name:Email Records"></form></center></body></html>
EOT;

?>