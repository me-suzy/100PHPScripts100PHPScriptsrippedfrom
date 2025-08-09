<?php

#########################################################
#                    DupeCheck                          #
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
#dupecheck.php                                          #
#                                                       #
#DupeCheck is a script that will check any list of email#
#addresses, find all duplicates, and write out only the #
#unique addresses to a new file. Make sure that your    #
#opt-in mailing list doesn't accidentally send multiple #
#copies of your message to anyone - use DupeCheck to    #
#ensure your entire list is only made up of unique      #
#addresses!                                             #
#########################################################

#Set the following configuration variables

#$emailfile is the file that contains your list of email
#addresses

$emailfile = "emails.txt";

#$outputfile is the name of the file where you'd like to
#have the unique addresses placed. PHP must be able to
#create this file (chmod 777 the install directory)

$outputfile = "results.txt";

#########################################################
#Editing below is not required.                         #
#########################################################

#Determine output type (web or console)
$nl = isset($_SERVER[REMOTE_ADDR]) ? "<br>" : "\n";

#Open the source file
if(!$fin = fopen($emailfile, "r"))
  die("Couldn't open $emailfile for reading!");

#Create the results file
if(!file_exists($outputfile)){
  if(!touch($outputfile))
    die("Couldn't open $outputfile for writing!");
}

while(!feof($fin)){

  $dupe = 0;

  #grab a line from the infile
  $current = fgets($fin, 1024);
  $addresses++; 

  #attempt to match it against the outfile
  if(!$fout = fopen($outputfile, "r"))
    die("Couldn't open $outputfile for reading!");

  while(!feof($fout)){
    $compare = fgets($fout, 1024);
    if(strcasecmp(trim($current), trim($compare)) == 0){
      $dupe = 1;
      $dupesfound++;
      break;
    }
  }

  fclose($fout);

  #this address wasn't a dupe, write it to the outfile
  if(!$dupe){
    $fout = fopen($outputfile, "a");
    if(!fputs($fout, $current))
      die("Couldn't write address $current to $outputfile!");
    fclose($fout);
    $uniquesfound++;
  }
}

echo "Processed $addresses addresses from $emailfile...$nl";
echo "Duplicate addresses found: $dupesfound$nl";
echo "Uniques found: $uniquesfound (saved in $outputfile)$nl$nl";

?>