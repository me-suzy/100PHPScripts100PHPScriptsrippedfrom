<?
session_start();
require 'include.inc';
if (!isset($_SESSION['letmein'])){
	header ("Location: index.php?invalid=PLEASE LOGIN");
				  }


// check user points

$query = "select userid,points from points where userid=".$id;

$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
$row = mysql_fetch_object($result);
if (($row->points) > 1 ){
	
	// points look ok, don't deactivate
	 	$sql="UPDATE url_table SET active = 'y' WHERE userid=".$row->userid;
		$result = mysql_query( $sql );
	} else {
	
	// points look bad, deactivate

	 	$sql="UPDATE url_table SET active = 'n' WHERE userid=".$row->userid;
		$result = mysql_query( $sql );
	}

	
// get random url

if ($pickType=="randm"){
$query = "SELECT points.userid, points.points,url_table.website, url_table.userid, url_table.active
FROM url_table INNER JOIN points ON url_table.userid = points.userid 
where url_table.active='y' and points.points >0 and url_table.userid !=".$id." order by rand()";



//$query = "SELECT url_table.website, url_table.userid, url_table.active, points.userid, points.points 
//FROM url_table INNER JOIN points ON url_table.userid = points.userid 
//where url_table.active='y' and points.points >0 and url_table.userid !=".$id;
} else {

// USE THIS QUERY TO PICK POINT WEIGHTED URLS
$weight=2;
$query = "SELECT url_table.website, url_table.userid, url_table.active, points.userid, points.points FROM url_table INNER JOIN points on url_table.userid=points.userid where url_table.active='y' and points.points >0 and url_table.userid !=".$id." ORDER BY ROUND(ROUND((RAND()/$weight), $weight)*points)";
}


// $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
// $row = mysql_fetch_object($result);
 
// $result = mysql_data_seek ( $query, mysql_num_rows($query)-1 );
// $row= mysql_fetch_object( $result );

// $result = mysql_feild_seek(rand(0,mysql_num_rows($query))-1);
// $row=mysql_fetch_object($result);

$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

if( mysql_data_seek ( $result, mysql_num_rows($result)-1 ) )
{
$row = mysql_fetch_object($result);
}
else
echo "invalid data seek";


			$_SESSION['random_url'] = $row->website;
			$_SESSION['random_urlid'] = $row->userid;




// get user points

	$query = "SELECT count(*) AS check_rows FROM url_points WHERE urlid='".$_SESSION['random_urlid']."' AND pointdate='".date("Ymd")."'";
			
	//run the query and get the number of affected rows
	$result = mysql_query( $query );
	
	while ( $data = mysql_fetch_assoc( $result ) )
		{

				$affected_rows = $data['check_rows'];
		}
	


	//if there's exactly one result, the user is validated. Otherwise, he's invalid
	
	if($affected_rows > 0) {

			     	$sql="UPDATE url_points SET points=points+1 WHERE urlid='".$_SESSION['random_urlid']."'";

				$result = mysql_query( $sql );
					if ( $result != false )
						{
					} else {
						echo mysql_error();
					}
				} else {
				$sql="INSERT INTO url_points (urlid, points, pointdate) VALUES (".$_SESSION['random_urlid'].", 1, '".date("Ymd")."')"; 

				$result = mysql_query( $sql );
				
					if ( $result != false )
						{
					} else {
						echo mysql_error();
					}
					}

// subtract point from random url

$sql="UPDATE points SET points=points-1 WHERE userid=".$row->userid;

$result = mysql_query( $sql );

// add points to user
$sql="UPDATE points SET points=points + ". $_SESSION['point_inc'] ." WHERE userid=".$id;

$result = mysql_query( $sql );

$query = "select userid,points from points where userid=".$id."";

$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
$row = mysql_fetch_object($result);

	// display points

 ?>
	<HTML>
	 <HEAD>
	 <SCRIPT>
		if (top.location != self.location) {
			top.location = self.location
		}
	 </SCRIPT>
	  <TITLE></TITLE>
	 </HEAD>
	 <FRAMESET ROWS='65,100%' FRAMESPACING='0' BORDER='0'>
 <FRAME MARGINWIDTH='0' MARGINHEIGHT='0' NORESIZE SCROLLING=NO SRC='query_user2.php?random_url=$random_urlid&user_id=<? print $id; ?>&username=<? echo $username; ?>' FRAMEBORDER='0'>
<FRAME MARGINWIDTH='0' MARGINHEIGHT='0' NAME='bottom' SCROLLING=AUTO SRC='<? print $_SESSION['random_url']; ?>' FRAMEBORDER='0'>

	  <NOFRAMES>
	   <BODY>
		<P>
		 This page is designed for use with a browser that supports frames.
	   </BODY>
	  </NOFRAMES>
	 </FRAMESET>
	</HTML>
<?

?>
