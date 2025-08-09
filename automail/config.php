<?php
#
#AutoMail configuration file
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
#You MUST set ALL of these variables to match your server 
#configuration, BEFORE running install.php
#

#sqlhost: the machine name or IP address of your SQL server
$sqlhost = "localhost";

#sqluser: your username on the SQL server
$sqluser = "mysql";

#sqlpass: your password on the SQL server
$sqlpass = "r00tb33r";

#sqldbname: the name of the database you want to create for AutoMail
$sqldbname = "automail";

#sqltype: set to mysql or pgsql
#(pgsql is not yet supported, THIS MUST BE SET TO "mysql" !!)
$sqltype = "mysql";

#version: used to determine the version of the script
$version = "20030103";

?>