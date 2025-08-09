<?
// ADD BOUGHT POINTS
$ii=$_GET['userid'];
$pp=$_GET['points'];

   require 'include.inc';

		$query="UPDATE points SET points=points+$pp WHERE userid=$ii";

		$result = mysql_query($query) or die ("Error in query: $query. " .
		mysql_error());

		// close database connection
		mysql_close($connection);
		
		// redirect to main page
		header("Location: start.php?option=thank you for purchasing points&id=$id&username=$username"); 
?>
