<?

#Set the following 4 variables to reflect your MySQL information
$dbhost = "localhost";
$dbuser = "foobar";
$dbpass = "f00b4r";
$dbname = "survey123";

#Set $barurl to the URL to your copy of gradient.gif
$barurl = "http://example.com/survey/templates/gradient.gif";

#Set $publicresults to 1 if you want your visitors to be able
#to view survey results, or to 0 if you don't
$publicresults = 1;

$db = @mysql_connect($dbhost, $dbuser, $dbpass);
@mysql_select_db($dbname);
?>