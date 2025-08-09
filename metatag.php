<?php

#########################################################
#                    META Tag Maker                     #
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

?>

<FORM ACTION="metatag.php" method="POST">  
 <font face="Arial" size="2" color="Black"><b>Site Description:</b><br> 
 <input type="text" size="35" name="description"> 
 <br>  
 <font face="Arial" size="2" color="Black"><b>Site Keywords(Seperate with commas):</b><br> 
 <input type="text" size="35" name="keywords"> 
 <br>  
 <input type="submit" name="set" value="Generate">  
 <input type="reset" value="Reset"></FORM>  
<P> 
<? 

if($_POST[set] == "Generate"){
 echo <<<EOT
<CENTER>Place the following html between the head tags of your site to add your mega tags<br> 
<BR>&lt;META name="description" content="$_POST[description]"&gt;<BR> 
&lt;META name="keywords" content="$_POST[keywords]"&gt;"
EOT;
}
?>
