<?php
#########################################################
#                      YouGuestIt                       #
#########################################################
# This script was created by:                           #
#                                                       #
# PHPSelect Web Development Division.                     #
# http://www.phpselect.com/                               #
#                                                       #
# This script and all included modules, lists or        #
# images, documentation are copyright 2002              #
# PHPSelect (http://www.phpselect.com/) unless              #
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
# admin@phpselect.com or info@phpselect.com                 #
#########################################################

#Set this to the file which will hold guestbook posts.
#You will need to chmod 777 that file, and the directory
#which contains both this script and the data file.

$datafile = "msgs.data";

#If you prefer to edit the HTML display of your guestbook,
#scroll to the bottom of the file. Otherwise no further
#configuration is needed.

#########################################################

if(isset($_POST[content])) {
      extract($_POST);

	$oldarray = fopen("$datafile", "r");
	$oldcontents = fread($oldarray, filesize($datafile)) or die( 'Could not read from file.');
	fclose($oldarray);

	if(!$fp = fopen("$datafile", "w")){
        die("Error: PHP does not appear to have permission to write to $datafile");
      }
	fwrite ($fp, "<b>Posted by:</b> $name -- ");
	fwrite ($fp, date("n/d/y h:i:s A"));
	fwrite ($fp, "<br><b>Email:</b> <a href='mailto:$email'>$email</a><br>");
	fwrite ($fp, "<b>Topic:</b> $title<br><br>");
	fwrite ($fp, stripslashes($content) . "<br><hr noshade size=1><br>");

	fwrite ($fp, $oldcontents);
	fclose($fp);
	header("Location: $_SERVER[PHP_SELF]");
}
?>


<!-- HTML Begins Here -->


<font size=2 style='font-family:Verdana'>
<center><a href="#postnew">Post a Message</a></center><p>

<?
#Leave this code in place in order for the messages to display
require("$datafile");
?>

<br><br>
<a name="postnew"></a>
<form method="post" action="<? echo $_SERVER[PHP_SELF]; ?>">
Name: <input type="text" name="name"><br>
Email: <input type="text" name="email"><br>
Title: <input type="text" name="title"><br>
<textarea name=content rows=15 cols=50 wrap=soft></textarea>
<input type="submit" name="submitButton" value="Post">


<!-- HTML Ends Here -->
