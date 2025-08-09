<?
#########################################################
#                     MP3Stream                         #
#########################################################
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

#########################################################
# You must set the following variables.                 #
#########################################################

# the server path to the directory containing this script
$dir="/home/shaun/public_html/stream";

# the web address (URL) of the directory containing this script
$dir_url="http://box/shaun/stream";

# the server path to the directory with your mp3 files
$mpsdir = "/home/shaun/public_html/stream/mp3s";

# the url to the mp3 collection
$mpsurl="http://box/shaun/stream/mp3s";

# do we use checkboxes or a select box?
# enter "check" for checkboxes
# enter "select" for select box
$which = "select";

#########################################################
# No editing is required below this line.               #
#########################################################

if($_REQUEST[action] == "process"){
  global $dir, $mpsdir, $mpsurl, $dir_url;
  $id = uniqid("") . ".m3u";
  if(!$fp = fopen("$dir/lists/$id", "w"))
    die("Unable to create playlist file (permission denied)");
  foreach($_POST[song] as $var){
    fputs($fp, "$mpsurl/$var\n");
  }
  header("Location: $dir_url/lists/$id");
  exit;
}
else
  showpage();


function showpage(){
  extract($GLOBALS);
  $files = array();
  $directory = opendir($mpsdir);
  while($filename = readdir($directory)){
    if(strlen($filename) > 2){ #ignore . and ..
      $localext = substr($filename, -3);
      if(strcasecmp($localext, "mp3") != 0)
        continue;
      array_push($files, $filename);
    }
  }
  $output .= "<form method=\"post\" action=\"$_SERVER[PHP_SELF]\"><input type=\"hidden\" name=\"action\" value=\"process\">";
  if($which == "select"){
    $output .= '<select name="song[]" size=10 multiple>';
  }
  foreach($files as $var){
    if($which == "check"){
      $output .= "<input type=checkbox name=\"song[]\" value=\"$var\">$var<br>";
    }
    else{
      $output .= "<option value=\"$var\">$var</option>";
    }
  }
  if($which == "select")
    $output .= '</select><br>';
  $output .= '<br><input type=submit value="Stream!"></form>';
  $template = implode("", file("$dir/templates/streamer.html"));
  $template = str_replace("%output%", $output, $template);
  echo $template;
  exit;
}

?>