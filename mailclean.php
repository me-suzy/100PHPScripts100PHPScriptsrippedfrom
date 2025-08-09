<?php
#########################################################
#                    Mailbox Cleaner                    #
#########################################################
#                                                       #
# PHPSelect Web Development Division                    #
#                                                       #
# http://www.phpselect.com/                             #
#                                                       #
# This script and all included modules, lists or        #
# images, documentation are distributed through         #
# PHPSelect (http://www.phpselect.com/) unless          #
# otherwise stated.                                     #
#                                                       #
# Purchasers are granted rights to use this script      #
# on any site they own. There is no individual site     #
# license needed per site.                              #
#                                                       #
# This and many other fine scripts are available at     #
# the above website or by emailing the distriuters      #
# at admin@phpselect.com                                #
#                                                       #
#########################################################



$host = "mail.example.com";    #Your email server
$user = "user1234";            #Email username/login
$pass = "rootbeer";            #Email password

#########################################################
# End Configuration                                     #
#########################################################

#Format output for console or for web?
$nl = ((isset($REMOTE_ADDR)) ? "<br>" : "\n");

if(!$sock=fsockopen($host, 110, $err, $errno, 10))
  die("Couldn't connect to the POP server$nl");

fputs($sock, "USER $user\r\n");
$buf = fgets($sock, 1024);
if($buf[0] != '+')
  die("POP server didn't like USER $user$nl");
fputs($sock, "PASS $pass\r\n");
$buf = fgets($sock, 1024);
if($buf[0] != '+')
  die("POP server didn't like PASS$nl");

fputs($sock, "STAT\r\n");
$buf = fgets($sock, 1024);
fputs($sock, "STAT\r\n");
$buf2 = fgets($sock, 1024);
list($stat, $num, $size) = split(' ', $buf2, 3);
echo "There are $num messages$nl";

for($i=1; $i<=$num; $i++){
   $command = "DELE $i\r\n";
   echo "Deleting message $i with DELE $i$nl";
   fputs($sock, $command);
   $buf = fgets($sock, 1024);
   if($buf[0] != '+')
     die("POP server didn't like DELE $i: ($buf)$nl");
}

fputs($sock, "QUIT\r\n");
$buf = fgets($sock, 1024);
fclose($sock);

?>