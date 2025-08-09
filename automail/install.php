<?php
#
#AutoMail installation script
#
#########################################################
#                     AutoMail                          #
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
#
#AutoMail installation script

include_once("config.php");
include_once("common.php");

#Grab our formatting variables from the global scope
$nl = $GLOBALS["nl"];
$b = $GLOBALS["b"];
$eb = $GLOBALS["eb"];

echo $b . "Beginning AutoMail installation$eb...$nl$nl";

#Connect to the server
echo "Connecting to the SQL server...$nl"; flush();
if(!$db = sql_connect())
  die(error("Fatal", "Couldn't connect to SQL server!"));
else
  echo "-> Connected!$nl$nl";
flush();

#Make sure that AutoMail isn't already installed
if(sql_select("$sqldbname", $db)){
  die(error("Fatal", "It appears that AutoMail is already installed. If you want \nto reinstall or repair a failed installation, you must remove the existing database entries first. Please " . $b . "back up the existing \n\"automail\" database$eb from your SQL server if you want to retain the current data."));
}

#Create our database
echo "Creating AutoMail's database...$nl"; flush();
if(!$result = sql_query("CREATE DATABASE $sqldbname", $db))
  die(error("Fatal", "Couldn't create a database named \"$sqldbname\" on the SQL server, please check your SQL permissions."));
else
  echo "-> Successfully created the \"$sqldbname\" database on the SQL server$nl$nl";
flush();

#Select our database
echo "Selecting the new database...$nl"; flush();
if(!sql_select("$sqldbname", $db))
  die(error("Fatal", "Couldn't select the newly created \"$sqldbname\" database on the SQL server!"));
else
  echo "-> Successfully selected database \"$sqldbname\"$nl$nl";

#Create our tables
echo "Creating tables in the \"$sqldbname\" database...$nl"; flush();
if(!$result = sql_query("CREATE TABLE options(confirm tinyint(1) NOT NULL DEFAULT 0, notify tinyint(1) NOT NULL DEFAULT 0, password varchar(255) NOT NULL, delay tinyint NOT NULL DEFAULT 1, mainscripturl varchar(255) NOT NULL, userscripturl varchar(255) NOT NULL, redirsubsuccurl varchar(128), redirsubfailurl varchar(128), redirconsuccurl varchar(128), redirconfailurl varchar(128), redirunssuccurl varchar(128), redirunsfailurl varchar(128), listname varchar(255) NOT NULL, fromaddr varchar(255) NOT NULL, headers varchar(255))", $db))
  die(error("Fatal", "Couldn't create a table named \"options!\""));
else
  echo "-> Successfully created the \"options\" table$nl";
flush();
if(!$result = sql_query("CREATE TABLE recipients(id mediumint NOT NULL AUTO_INCREMENT, email varchar(255) NOT NULL, name varchar(255), active tinyint(1) NOT NULL DEFAULT 1, authkey varchar(128), authip varchar(20), authdate datetime, adddate datetime NOT NULL, received mediumint NOT NULL DEFAULT 0, lastmail datetime NOT NULL, PRIMARY KEY (id), UNIQUE ID (id))", $db))
  die(error("Fatal", "Couldn't create a table named \"recipients!\""));
else
  echo "-> Successfully created the \"recipients\" table$nl";
flush();
if(!$result = sql_query("CREATE TABLE messages(id mediumint NOT NULL AUTO_INCREMENT, subject varchar(255) NOT NULL, message text NOT NULL, PRIMARY KEY (id), UNIQUE ID (id))", $db))
  die(error("Fatal", "Couldn't create a table named \"messages!\""));
else
  echo "-> Successfully created the \"messages\" table$nl$nl";
flush();

#Now let's populate the tables
echo "Populating tables in the \"automail\" database...$nl"; flush();
$date = date("Y-m-d H:i:s");
if(!$result = sql_query("INSERT INTO options (confirm, notify, password, fromaddr, mainscripturl, userscripturl, listname) VALUES (1, 1, 'q', 'automail@example.com', 'http://example.com/automail/index.php', 'http://example.com/automail/user.php', 'AutoMail Default')", $db))
  die(error("Fatal", "Couldn't populate the \"options\" table!"));
else
  echo "-> Added default settings to the \"options\" table$nl";
flush();
if(!$result = sql_query("INSERT INTO messages(subject, message) VALUES ('Sample Message (edit me!)', 'Dear %%NAME%%,\n\nThis is a test message. You should delete this message, OR edit both the message and the subject to make this your first message.')", $db))
  die(error("Fatal", "Couldn't populate the \"messages\" table!"));
else
  echo "-> Added one sample message to the \"messages\" table$nl";
flush();
if(!$result = sql_query("INSERT INTO messages(subject, message) VALUES ('Second Sample (edit me!)', 'Hello again! %%NAME%%, you should delete this message, OR edit both the message and the subject to make this your second message.')", $db))
  die(error("Fatal", "Couldn't populate the \"messages\" table!"));
else
  echo "-> Added a second sample message to the \"messages\" table$nl";
flush();

echo "$nl$b" . "Congratulations!$eb$nl$nl" . "By all appearances, AutoMail was successfully installed. You should visit the \n";
if($nl == "<br>")
  echo "<a href=\"index.php\">AutoMail index page</a>";
else
  echo "AutoMail index page";
echo " now to start setting things up!$nl";

?>