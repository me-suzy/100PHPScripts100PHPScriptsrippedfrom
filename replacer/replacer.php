<?
#########################################################
#                       Replacer                        #
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

#No variables to set - see bundled INSTALL.txt file

#########################################################

$template = implode("", file("template.html"));
$template = str_replace("%PHP_SELF%", $_SERVER[PHP_SELF], $template);

if($_POST[Submit] == "Do It"){
  if(!($_POST[directory] && $_POST[find] && $_POST[replace])){
    $template = str_replace("%message%", "You didn't fill out the required fields: starting directory, phrase to find, and replacement text!", $template);
    die($template);
  }

  #Make sure the starting directory exists on the system
  if(!is_dir($_POST[directory])){
    $template = str_replace("%message%", "The directory you specified, $_POST[directory], does not exist!", $template);
    die($template);
  }

  #Escape a few common characters that would bork the regex if left unescaped.
  #If you encounter characters which are not escaped here and should be
  #(indicated by preg_replace errors when you run the script), please email
  #info@phpselect.com to request an update.

  $_POST[find] = stripslashes($_POST[find]);
  $_POST[find] = str_replace("\\", "\\\\", $_POST[find]);
  $_POST[find] = str_replace("/", "\/", $_POST[find]);
  $_POST[find] = str_replace("?", "\\?", $_POST[find]);
  $_POST[find] = str_replace("(", "\\(", $_POST[find]);
  $_POST[find] = str_replace(")", "\\)", $_POST[find]);

  $goods = array(); 
  $bads = array();
  chdir($_POST[directory]);
  echo '<font face="Verdana, Arial" size="2"><b>Replacer starting up!</b><br><br>';

  replace($_POST[find], $_POST[replace], $_POST[directory]);

  echo "<hr><b>Results</b>:<br><br>Matches: " . (count($goods) + count($bads)) . ", Successful Replacements: " . count($goods) . ", Failed Replacements: " . count($bads);

  if((!$_POST[verbose]) && (count($bads) > 0))
    echo '<br><br>Hint: Next time, enable verbose mode to be notified about which files were successfully altered and which files could not be altered due to permissions problems.';

  if((count($goods) > 0) && ($_POST[verbose])){
    echo "<hr><b>Files where replacement SUCCEEDED:</b><br><br>The following files matched the search, and the search term was successfully replaced within them.<br><br>";
    foreach($goods as $var){
      echo "$var<br>";
    }
  }

  if((count($bads) > 0) && ($_POST[verbose])){
    echo "<hr><b>Files where replacement FAILED due to bad permissions:</b><br><br>The following files matched the search, but Replacer was unable to alter them because their permissions do not allow PHP write access. You should chmod 777 these files and then run Replacer again with the same criteria.<br><br>";
    foreach($bads as $var){
      echo "$var<br>";
    }
  }

  echo '<hr><br><center><font size="1"><a href="http://www.phpselect.com/scripts.php?script=Replacer">Replacer</a> | Copyright 2003, <a href="http://www.phpselect.com/">PHP Labs</a></font></center>';
}

else{
  $template = str_replace("%message%", "", $template);
  die($template);
}

function replace($find, $replace, $dir){
  global $goods, $bads;
  #Open the directory
  $directory = opendir($dir);
  if($_POST[verbose]){
    echo "Processing files in directory $dir...<br>";
  }
  while($filename = readdir($directory)){
    #Get next filename
    if(($filename == ".") || ($filename == ".."))
      continue;
    if(is_dir($filename)){
      if($_POST[recurse]){
        $current = getcwd();
        chdir($filename);
        replace($find, $replace, "$current/$filename");
        chdir($current);
      }
      else
        continue;
    }
    $ext = substr($filename, -(strlen($_POST[extension])));
    if(($_POST[filter]) && (strcasecmp($ext, $_POST[extension]) != 0))
      continue;
    #Look for search term inside the file
    $buffer = implode("", file($filename));
    if(preg_match("/$find/$_POST[insensitive]", $buffer)){
      #We have a match!
      if(!is_writeable($filename)){
        #Bad permissions, we can't replace
        array_push($bads, getcwd() . "/$filename");
      }
      else{
        #Replace and overwrite the file
        $buffer = preg_replace("/$find/$_POST[insensitive]", "$replace", $buffer);
        $fp = fopen($filename, "w+");
        fputs($fp, $buffer);
        fclose($fp);
        array_push($goods, getcwd() . "/$filename");
      }
    }
    flush();
  }
}
?>

