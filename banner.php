<? // banner module 

//get random url points

  
     $sql = "SELECT client_id, alttext,link,banner FROM banners where points > 0 ORDER BY rand()";
	$result = mysql_query( $sql );
	if ( $result != false )
	{
		while ( $data = mysql_fetch_assoc( $result ) )
		{

			$client_id = $data['client_id'];	
			$banner = $data['banner'];
			$alttext = $data['alttext'];
			$link = $data['link'];
		}
	} else {
		echo mysql_error();
	}
	
     $sql="UPDATE banners SET points=points-1 WHERE client_id=".$client_id;
     
     	$result = mysql_query( $sql );
	if ( $result != false ){
?>
<a href="#"><IMG alt = "<? echo $alttext ?>" BORDER="0" SRC="<? echo "http://$banner"; ?>"  height="60" width="468" onclick='openbanner()'> </a>
<?
	} else {
		
		$link = "www.email2success.com/?hop=lovinlife/e2success";
		?>
<a href="#"><IMG alt = "email2success" BORDER="0" SRC="http://www.email2success.com/images/banner.gif"  height="60" width="468" onclick = 'openbanner()' ></a> 
<?}
?>
<script language="JavaScript1.2">
		function openbanner() {
			window.open('<? echo "http://$link"; ?>');
	}
	</SCRIPT>
