<?php
#########################################################
#                       Headliner                       #
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
# http://www.phpselect.com/                             #
#                                                       #
# HOW TO USE THIS SCRIPT: include() it from your page   #
# where you want news headlines to appear, or parse it  #
# to format the headines in a different manner. If you  #
# would rather get headlines from some other section    #
# than the USA Headlines, replace the URL in the first  #
# line of the script.                                   #
#########################################################
# headliner.php                                         #
#########################################################

#########################################################
# NO CONFIGURATION IS REQUIRED                          #
#########################################################

$gnews = file("http://news.google.com/news/gnusaleftnav.html");

for($i=0; $i<sizeof($gnews); $i++){
  preg_match("/<a class=y .*<\/a>/i", $gnews[$i], $result);
  if(!$result[0])
    continue;
  $result[0] = str_replace("class=y ", "", $result[0]);
  $link = trim($result[0]);
  echo $link . "<br>";
}

?>