    <!--- LOGIN MENU --->
   
<TABLE cellPadding=2 cellSpacing=0 class="superMenuNoshadow" width=150>
  <TR>
	  <TD>
	  	<FONT COLOR="RED" SIZE="2"><CENTER><B><? echo $invalid; ?></b></CENTER></font>
	  </TD>
	 </TR>	 
	<TR>
	  
    <TD vAlign="MIDDLE" class="menuheader"> <? echo $title; ?> 
    </TD>
        </TR>
  	<TR>
  	 <TD bgColor="#f2f2f2" colSpan="2">
  	  <form name="login" method="post" action="validate.php"> 
  
  		<table border=0>
  		   <tr>
            <td class="smallstatsText">User ID: </td>
            <td><input type="text" name="username"></td></tr>
      		   <tr>
            <td class="smallstatsText"> Password: </td>
            <td><input type="password" name="password"></td></tr>
      		   <tr><td colspan=2><input type="submit" value="Login"></td></tr>
      		   
	      </table>
      	  </form>
         </TD></TR>
      </TABLE>
     
     <!--- END LOGIN MENU --->