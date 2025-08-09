<?php

#########################################################
#                      Gallerize                        #
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
#index.php                                              #
#########################################################

#########################################################
# Set the following configuration variables if you don't#
# want to use the defaults. We suggest giving the script#
# a test-run with the defaults to see how it looks, then#
# deleting the auto generated thumbnails and making any #
# desired changes to the settings. When you load up the #
# script again, new thumbs will be generated.           # 
#########################################################

# Path to HTML template which contains the %output% token, if you
# want to use your own template. Defaults to built-in template.
# If you create your own, just stick %output% in the HTML file
# wherever you want the gallery output to appear.

$template = "";

# Here are the width and height settings for thumbnails. In most
# cases you will want to specify a value for one of these, and set
# the other one to 0, this enables the auto ratio calculations.
# If you set both to nonzero values, your thumbnails will all
# be generated at the exact same height/width but they'll end up
# looking "warped" and out of proportion. You MUST set at least 
# one, either the height or the width.

# Desired width of thumbnails (or 0 for auto)
$thumbw = 0;

# Desired height of thumbnails (or 0 for auto)
$thumbh = 100;

# The thumbnails will be displayed in a table. The following 
# variables control the appearance of the table.

# $perrow = number of thumbnails to display in each row
$perrow = 3;

# $perpage = number of images to display per page, this 
# really should be some multiple of $perrow
$perpage = 9;

# Size of the border for the table, in pixels
$tableborder = 0;

# Width of the table
$tablewidth = "75%";

# Cell spacing for the table, in pixels
$cellspacing = 3;

# Color of the table
$bgcolor = "#f0f0f0";

# Font to use for displaying the table
$fontface = "Verdana, Arial";

# Font size
$fontsize = 2;

# You can have information about each image displayed below
# its thumbnail in the table. Use the following settings to
# toggle these displays on or off by setting to 1 or 0.

# Display file name
$showname = 1;

# Display image coordinates
$showcoords = 1;

# Display file size in KB
$showsize = 1;

# If you want PHP to include() a header before displaying
# the gallery page, set the full system path here, e.g.
# /home/foo/public_html/gallery/header.php
$header = '';

# If you want PHP to include() a footer after displaying
# the gallery page, set the full system path here, e.g.
# /home/foo/public_html/gallery/footer.php
$footer = '';

# By default, thumbnails displayed in the gallery will link
# directly to the fullsize JPG. If you'd rather have them
# point somewhere else (for example to your own script that
# checks a user's cookie or tracks how many times each pic
# has been viewed), you can take advantage of the $linkurl
# variable. The %picname% token will be replaced automatically.
# For example you might want the thumbnails to link to 
# "/your/site/viewpic.php?image=%picname%" where viewpic.php
# is a script you wrote that counts the view and displays the
# image specified by %picname%
# If you do not need this capability, leave the default
# value, the default will work for most people.

$linkurl = "%picname%";

#########################################################
# End of configuration variables                        #
#########################################################

set_time_limit(0);

#If there's no template file, use the default
if(!$template){
  $template .= <<<EOT
<title>Gallerize - Displaying Gallery</title><body bgcolor="#FFFFFF"><center><h2><font face="$fontface">Gallerize from <a href="http://www.phpselect.com/">PHPSelect</a></font></h2>
<hr noshade size="1"><font face="$fontface" size="$fontsize">Click a thumbnail to view the full-size 
image</font></center><p align="center"><font face="$fontface" size="$fontsize">%output%</font></p>
EOT;
}
else{
  $template = implode("", file($template));
}

#Open the cwd and build a list of JPG files
$jpegs = array();
$directory = opendir(getcwd());
while($filename = readdir($directory)){
  #ignore . and .. as well as existing thumbnails
  if((strlen($filename) > 2) && (strcasecmp(substr($filename, 0, 5), 'thumb') != 0)){
    $localext = substr($filename, -3);
    if(strcasecmp($localext, 'jpg') != 0)
      continue;
    else{
      array_push($jpegs, $filename);
    }
  }
}

sort($jpegs);
reset($jpegs);

#Now that we have the files, we need to create thumbs if
#they don't exist
foreach($jpegs as $var){
  if(!file_exists("thumb$var")){
    if(!isset($pleasehold)){
      $pleasehold = 1;
      echo "<font face='$fontface' size='$fontsize'><b>One moment please...</b><br><br>New images were found in this gallery, and thumbnails must be made for them.<br><br>Processing images: ";
      flush();
    }
    echo "<font face='$fontface' size='$fontsize'>$var... </font>";
    flush();
    makejpegthumb("$var", $thumbw, $thumbh, "thumb$var", 100);
  }
}
if($pleasehold){
  echo "<font face='$fontface' size='$fontsize'><br><br><b>Thumbnails created!</b></font><br>";
}

#Build the navigation links
$nav = "<center><font face='$fontface' size='$fontsize'>";
#$numlinks = round(count($jpegs)/$perpage, 0);
$numlinks = (int)ceil(count($jpegs)/$perpage);
$linkstart = 1;
for($i=1; $i<=$numlinks; $i++){
  $nav .= "<a href='$_SERVER[PHP_SELF]?start=$linkstart' title='Go to page $i'>Page $i</a> ";
  $linkstart += $perpage;
}
$nav .= '</font></center><br>';

$output = "$nav\n";

#It's time to display the gallery!
$picnum = (isset($_GET[start])) ? (($_GET[start] == 0) ? 0 : $_GET[start] - 1) : 0;
$output .= <<<EOT
<!-- Begin Gallerize Output - Gallerize from http://www.phpselect.com/ -->\n\n<table width="$tablewidth" bgcolor="$bgcolor" border="$tableborder" cellspacing="$cellspacing" align="center">
EOT;
for($i=0; $i<(int)($perpage/$perrow); $i++){
  $output .= '<tr>';
  for($j=0; $j<$perrow; $j++){
    $output .= "<td align='center' valign='middle'>";
    if(file_exists($jpegs[$picnum])){
      $target = str_replace('%picname%', $jpegs[$picnum], $linkurl);
      $output .= "<a href='$target' target='_blank'><img src='thumb$jpegs[$picnum]' border='0' alt='Click to view $jpegs[$picnum]'></a>";
      if($showname == 1){
        $output .= "<br><font face='$fontface' size='$fontsize'>$jpegs[$picnum]</font>";
      }
      if($showcoords == 1){
        $coords = getimagesize($jpegs[$picnum]);
        $output .= "<br><font face='$fontface' size='$fontsize'>$coords[0] x $coords[1]</font>";
      }
      if($showsize == 1){
        $output .= "<br><font face='$fontface' size='$fontsize'>" . sprintf("%.02f", (float)(filesize($jpegs[$picnum]) / 1024)) . 'KB</font>';
      }
      $output .= "\n";
    }
    $picnum++;
  }
  $output .= '</tr>';
}
$output .= "</table><br>$nav\n\n<!-- End Gallerize Output - Gallerize from http://phpselect.com -->";

$template = str_replace('%output%', $output, $template);
if($header){
  include($header);
}
echo $template;
if($footer){
  include($footer);
}

#Make a JPG thumbnail of a source image
function makejpegthumb($infile, $outxcoord, $outycoord, $outfile, $quality){
  $insize = getimagesize("$infile");

  $inxcoord = $insize[0];
  $inycoord = $insize[1];
  $inresource = imageCreateFromJPEG("$infile");

  if($outxcoord == 0){
    #auto-width: calculate new width based on ratio of old to new height
    $ratio = (float)($outycoord / $inycoord);
    $outxcoord = $inxcoord * $ratio;
  }
  else if($outycoord == 0){
    #auto-height: calculate new height based on ratio of old to new height
    $ratio = (float)($outxcoord / $inxcoord);
    $outycoord = $inycoord * $ratio;
  }

  $outresource = imagecreatetruecolor($outxcoord, $outycoord);

  $target_pic = imagecopyresampled($outresource, $inresource, 0, 0, 0, 0, $outxcoord, $outycoord, $inxcoord, $inycoord);
  imagejpeg($outresource, "$outfile", $quality);
}

?>