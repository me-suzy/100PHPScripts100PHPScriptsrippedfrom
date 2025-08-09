<?php

#########################################################
#                      InstaPics                        #
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
#autopic.php                                            #
#                                                       #
#InstaPics lets you create a web based image gallery    #
#for your site, allowing your visitors to upload their  #
#own images. This can be used for a number of purposes, #
#from a private gallery among friends to a public, free #
#for all image library, to the foundation of a TGP site.#
#########################################################

#Set the configuration variables below

#$template is the template HTML file which will hold the
#image display and allow users to upload.

$template = "gallery.html";

#$imagedir is the directory where uploaded images will
#be stored. Either relative or absolute path will work,
#the default is the included "images" directory. Note,
#PHP MUST have permission to write to this directory
#on your server or you will get errors during uploads.
#You should include the trailing slash on the name.

$imagedir = "images/";

#$max is your preferred maximum upload size, in bytes
#(the default is 250KB). The script will try to use this
#but your php.ini may impose a different limit.

$max = 256000;

#########################################################
#Editing below is not required.
#########################################################

ini_set("upload_max_filesize", $max);

#load the template file
if(!$output = file($template))
  die("Couldn't open the template file ($template). Please check and make sure that this file is where it's supposed to be.");
$output = implode("\n", $output);

#If there was an image uploaded, print out the results
if($_POST["MAX_FILE_SIZE"]){
  if(is_uploaded_file($_FILES["newimage"]["tmp_name"]) && ($_FILES["newimage"]["size"] > 0)){
    #Was this a graphics file or something bogus?
    $extension = substr($_FILES["newimage"]["name"], -3);
    if(!((strcasecmp($extension, "gif") == 0) || (strcasecmp($extension, "jpg") == 0) || (strcasecmp($extension, "bmp") == 0) || (strcasecmp($extension, "png") == 0)))
      $resultsoutput = "Upload error, that doesn't look like a graphic file.";
    else{
      #File looks good, copy it to the image root
      $newpath = $imagedir . $_FILES["newimage"]["name"];
      move_uploaded_file($_FILES["newimage"]["tmp_name"], $newpath);
      $resultsoutput = "File " . $_FILES["newimage"]["name"] . " (" . $_FILES["newimage"]["size"] . " bytes) was added to the gallery! You may need to refresh the page to see it.";
    }
  }
  else if(!$_FILES["newimage"]["name"])
    $resultoutput = "Upload error, it appears that you did not select a file to upload.";
  else
    $resultsoutput = "Upload error, please try again and make sure your file is smaller than $max bytes.";
}
else $resultsoutput = "";


#Locate and display all of the existing images
$directory = opendir($imagedir);
while($filename = readdir($directory)){
  if(strlen($filename) > 2){ #ignore . and ..
    $localext = substr($filename, -3);
    if(!((strcasecmp($localext, "gif") == 0) || (strcasecmp($localext, "jpg") == 0) || (strcasecmp($localext, "bmp") == 0) || (strcasecmp($localext, "png") == 0)))
      continue;
    $imagesoutput .= "<img src=\"$imagedir$filename\" alt=\"$filename (" . filesize("$imagedir/$filename") . " bytes)\"><br><br>";
  }
}

#Build the upload form
$formoutput = "<form enctype=\"multipart/form-data\" action=\"$_SERVER[PHP_SELF]\""
            . " method=\"post\"><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$max\">"
            . "Send this file: <input name=\"newimage\" type=\"file\"><br><input type="
            . "\"submit\" value=\"Upload\"> (max $max bytes)</form>";

#Replace output tokens
$output = str_replace("%%RESULTS%%", $resultsoutput, $output);
$output = str_replace("%%IMAGES%%", $imagesoutput, $output);
$output = str_replace("%%FORM%%", $formoutput, $output);
echo $output;

?>