<?
#########################################################
#                     ProxyCheck                        #
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

#No configuration is required


set_time_limit(0);

#Format output for console or web?
$nl = ((isset($REMOTE_ADDR)) ? "<br>" : "\n");

function getmicrotime(){
  #used in add/scan scripts to find response latency
  list($usec, $sec) = explode(" ",microtime());
  return ((float)$usec + (float)$sec);
}

#Open the list of possible proxies
$fp = fopen("proxies.txt", "r");

while(!feof($fp)){
  $buffer = fgets($fp, 4096);
  $buffer = trim($buffer);
  list($host,$port) = split(":", $buffer);

  #check for blank lines in the file
  if(strlen($host) < 7)
    continue;

  #make sure we have an IP, not a hostname
  if(eregi("[a-zA-Z]", $host))
    $host = gethostbyname($host);
  if(eregi("[a-zA-Z]", $host))
    #we had a hostname but it didn't resolve, ditch it
    continue;

  echo "Testing $host:$port";
  flush();

  #make sure we do NOT have a .gov server
  if(eregi("\.gov", gethostbyaddr($host))){
    echo " ... skipping .gov server (" . gethostbyaddr($host) .")!$nl";
    continue;
  }
  #make sure we do NOT have a .mil server
  if(eregi("\.mil", gethostbyaddr($host))){
    echo " ... skipping .mil server (" . gethostbyaddr($host) .")!$nl";
    continue;
  }
  #make sure we do NOT have a .int server
  if(eregi("\.int", gethostbyaddr($host))){
    echo " ... skipping .int server (" . gethostbyaddr($host) .")!$nl";
    continue;
  }

  #try connecting to the server, if the connection is refused,
  #the host is discarded
  if (! $sock = fsockopen($host, $port, &$num, &$error, 15)){
    echo " ... connection refused, ignoring.$nl";
    unset($sock);
    continue;
  }

  #build a request string
  $request = "GET http://shat.net/proxy.txt HTTP/1.0\r\n"
           . "User-Agent: Mozilla/4.0 (compatible; MSIE 5.5; "
           . "see http://winfosec.com/proxies)\r\n"
           . "Connection: Close\r\n"
           . "\r\n";
  
  #send request and wait for a reply
  $timeout = 0;
  $buffer = "";
  fputs($sock, $request);
  $start = getmicrotime();
  socket_set_timeout($sock, 15);
  while (!feof($sock)){ 
    $stat = socket_get_status($sock);
    if($stat[timed_out] == TRUE){
      echo " ... timed out, status unknown.$nl";
      $timeout = 1;
      break;
    }
    if(feof($sock))
      break;
    $buffer .= fread($sock, 10240);

  }
  $finish = getmicrotime();
  $latency = sprintf("%.2f", ($finish - $start)*1000); 

  fclose($sock);
  unset($sock);
  if($timeout == 1)
    continue;

  if((ereg("WFSC",$buffer))||(ereg("BABABOOEY",$buffer))){
    echo " ... OPEN! Latency $latency ms$nl";
  }
  else
    echo " ... proxy is not public.$nl";
  flush();
}
?>

