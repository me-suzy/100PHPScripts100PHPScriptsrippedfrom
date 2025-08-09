# If you edit this file make sure that the: print <<ADMIN_HEADER;
# is the first line above all your html code, and that there is a
# line with only: ADMIN_HEADER at the bottom below all your html
# code, if not you will get errors when runnig the scripts

print <<ADMIN_HEADER;

<HTML>
<HEAD>
<TITLE>Safelist Admin Control Panel</TITLE>
</HEAD>
<BODY BGCOLOR="$bg_clr" TOPMARGIN="0" BOTTOMMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">

<TABLE WIDTH="100%" BGCOLOR="$bg_clr2">
<tr><TD ALIGN="center" colspan="5"><FONT SIZE="$name_size" FACE="$name_font" COLOR="$name_clr">$list_name</FONT></td></tr>
<TR ALIGN="CENTER">
<FORM ACTION="$list_dir/admin.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="password" VALUE="$password"><INPUT TYPE="HIDDEN" NAME="action" VALUE="Search It"><TD>
	<INPUT TYPE="SUBMIT" VALUE="Search Database"></TD></FORM>
<FORM ACTION="$list_dir/admin.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="password" VALUE="$password"><INPUT TYPE="HIDDEN" NAME="action" VALUE="Verify"><TD>
	<INPUT TYPE="SUBMIT" VALUE="Pending Accounts"></TD></FORM>
<FORM ACTION="$list_dir/admin.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="password" VALUE="$password"><INPUT TYPE="HIDDEN" NAME="action" VALUE="Affiliate"><TD>
	<INPUT TYPE="SUBMIT" VALUE="Affiliate Earnings"></TD></FORM>
<FORM ACTION="$list_dir/admin.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="password" VALUE="$password"><INPUT TYPE="HIDDEN" NAME="action" VALUE="Daily"><TD>
	<INPUT TYPE="SUBMIT" VALUE="Reset Daily Send"></TD></FORM>
<FORM ACTION="$list_dir/admin.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="password" VALUE="$password"><INPUT TYPE="HIDDEN" NAME="action" VALUE="Ads"><TD>
	<INPUT TYPE="SUBMIT" VALUE="Banner & Main Page"></TD></FORM>
</TR>
</TABLE>
<TABLE BORDER="0" BORDERCOLOR="$bg_clr3" CELLSPACING="0" CELLPADDING="0" BGCOLOR="$bg_clr1" WIDTH="100%">
<TR>
<TD ALIGN="LEFT">&nbsp;&nbsp;Member Count: <SMALL><font color="red">$total</font></SMALL></TD>
<TD ALIGN="CENTER">Free Members: <SMALL><font color="red">$free_total</font></small></TD>
<TD ALIGN="CENTER">PRO Members: <SMALL><font color="red">$pro_total</font></small></TD>
<TD ALIGN="CENTER">Active Members: <SMALL><font color="red">$active_total</font></small></TD>
<TD ALIGN="RIGHT">Pending Members: <SMALL><font color="red">$pending_total</font></small>&nbsp;&nbsp;</TD>
</TR>
</TABLE>

ADMIN_HEADER
