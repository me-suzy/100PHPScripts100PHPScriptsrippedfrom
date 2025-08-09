<?php
#########################################################
#                    FileMailer                         #
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
#download.php                                           #
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

#Set the following configuration variables

#$fromaddr is the address you want files to be mailed from
$fromaddr = "test@example.com";

#$subject is the subject line you want to use for file mail
$subject = "Your requested file from PHPSelect";

#########################################################
#Editing below is not required.                         #
#########################################################

#if they've posted the form, grab their email address and send the file
if($_POST[action] == "process"){
  #make sure nobody's trying anything funny... for security reasons we'll
  #disallow .. % and ; in the filename
  if(ereg("\.\.", $_POST[filename]) || ereg("%", $_POST[filename]) || ereg(";", $_POST[filename]))
    die("The filename you attempted to retrieve is not permissable.");
  #load the appropriate template file
  if(file_exists("files/$_POST[filename]")){
    #file was found
    if(!$output = file("templates/standard.html"))
      die("Couldn't open the template file (templates/standard.html). Please check and make sure that this file is where it's supposed to be.");
    $output = implode("\n", $output);
    $output = str_replace("%%NAME%%", $_POST[name], $output);
    $output = str_replace("%%EMAIL%%", $_POST[email], $output);
    $output = str_replace("%%FILENAME%%", $_POST[filename], $output);
    $output = str_replace("%%IPADDR%%", $_SERVER[REMOTE_ADDR], $output);

    #get the mail body
    if(!$body = implode("", file("templates/mailbody.txt")))
      die("Couldn't open the template file (templates/mailbody.txt). Please check and make sure that this file is where it's supposed to be.");
    $body = str_replace("%%NAME%%", $_POST[name], $body);
    $body = str_replace("%%FILENAME%%", $_POST[filename], $body);

    #build the attachment
    $fp = fopen("files/$_POST[filename]", "rb");
    while(!feof($fp))
      $attachment .= fread($fp, 4096);
    $attachment = base64_encode($attachment);

    #build the mail message
    $boundary = uniqid("NextPart_");
    $headers = "From: $fromaddr\nContent-type: multipart/mixed; boundary=\"$boundary\"";
    $body =  "--$boundary\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\n\n$body\n\n--$boundary\nContent-type: application/octet-stream; name=$_POST[filename]\nContent-disposition: inline; filename=$_POST[filename]\nContent-transfer-encoding: base64\n\n$attachment\n\n--$boundary--";

    #send the message
    mail($_POST[email], $subject, $body, $headers);

    #record the download
    if(!file_exists("stats/database.txt"))
      touch("stats/database.txt");
    $stats = file("stats/database.txt");
    for($i=0; $i<sizeof($stats); $i++){
      list($file, $count) = split("\|", trim($stats[$i]));
      if(trim($file) == trim($_POST[filename])){
        $count++;
        $stats[$i] = "$file|$count\n";
        if(!$fp = fopen("stats/database.txt", "w+"))
          die("Couldn't open the template file (stats/database.txt). Please check and make sure that this file is where it's supposed to be.");
        for($j=0; $j<sizeof($stats); $j++)
          fputs($fp, "$stats[$j]");
        $recorded = 1;
        fclose($fp);
        break;
      }
    }
    if(!$recorded){
      #we have a new file that's never been recorded
      if(!$fp = fopen("stats/database.txt", "a"))
        die("Couldn't open the database file (stats/database.txt). Please check and make sure that this file is where it's supposed to be.");
      fputs($fp, "$_POST[filename]|1");
      fclose($fp);
    }

    #record the user's email address
    if(!$fp = fopen("stats/emails.txt", "a"))
      die("Couldn't open the email log file (stats/emails.txt). Please check and make sure that this file is where it's supposed to be.");
    fputs($fp, "$_POST[name]|$_POST[email]|$_POST[filename]\n");
    fclose($fp);

    #display the success message
    echo $output;
  }
  else{
    #file was not found
    if(!$output = file("templates/notfound.html"))
      die("Couldn't open the template file (templates/notfound.html). Please check and make sure that this file is where it's supposed to be.");
    $output = implode("\n", $output);
    $output = str_replace("%%FILENAME%%", $_POST[filename], $output);
    $output = str_replace("%%IPADDR%%", $_SERVER[REMOTE_ADDR], $output);
    echo $output;
    exit;
  }
}

#otherwise, print out the registration form
else{
 if(!$output = file("templates/register.html"))
    die("Couldn't open the template file (templates/register.html). Please check and make sure that this file is where it's supposed to be.");
  $output = implode("\n", $output);
  $output = str_replace("%%IPADDR%%", $_SERVER[REMOTE_ADDR], $output);
  $output = str_replace("%%FILENAME%%", $_GET[filename], $output);
  $output = str_replace("%%PHPSELF%%", $_SERVER[PHP_SELF], $output);
  echo $output;
}

?>