<?php
#########################################################
#                     Random Text                       #
#########################################################
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
# You are granted full rights to use this script on any #
# site you own. However, redistribution of this script  #
# REQUIRES that this copyright notice remain in place.  #
#                                                       #
# This and many other fine scripts are available at     #
# <http://www.phpselect.com/>                           #
#                                                       #
# HOW TO USE THIS SCRIPT: set the $file variable below  #
# to point to the location of your random text file,    #
# which should contain one potential entry per line.    #
# Then include() this script from your existing script  #
# to display a random line of text.                     #
#########################################################
# randtext.php                                          #
#########################################################

$file = "quotes.txt";

srand((double) microtime() * 1000000);
$quotes = file($file);
echo $quotes[rand(0, sizeof($quotes)-1)];
?>
