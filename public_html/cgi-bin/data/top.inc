# If you edit this file make sure that the: print <<MEMBER_HEADER;
# is the first line above all your html code, and that there is a
# line with only: MEMBER_HEADER at the bottom below all your html
# code, if not you will get errors when runnig the scripts

print <<MEMBER_HEADER;

<HTML>
<HEAD>
<TITLE>Logged In to $listname as $account</TITLE>
</HEAD>
<BODY BGCOLOR="$bg_clr" TOPMARGIN="0" BOTTOMMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" BGCOLOR="$bg_clr2" WIDTH="100%">
<TR>
<TD ALIGN="center" colspan="2"><FONT SIZE="$name_size" FACE="$name_font" COLOR="$name_clr">$list_name</FONT></td>
</tr>
</TABLE>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" BGCOLOR="$bg_clr2">
<TR ALIGN="CENTER">
<FORM ACTION="$list_dir/login.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="account" VALUE="$account"><INPUT TYPE="HIDDEN" NAME="pass" VALUE="$pass"><TD>
	<INPUT TYPE="SUBMIT" VALUE="Members Main"></TD></FORM>
<FORM ACTION="$list_dir/account.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="account" VALUE="$account"><INPUT TYPE="HIDDEN" NAME="pass" VALUE="$pass"><INPUT TYPE="HIDDEN" NAME="action" VALUE="Edit"><TD>
	<INPUT TYPE="SUBMIT" VALUE="Edit Your Account"></TD></FORM>
<FORM ACTION="$list_dir/affiliate.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="account" VALUE="$account"><INPUT TYPE="HIDDEN" NAME="pass" VALUE="$pass"><td>
	<INPUT TYPE="SUBMIT" VALUE="Affiliate Program"></TD></FORM>
<FORM ACTION="$list_dir/account.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="account" VALUE="$account"><INPUT TYPE="HIDDEN" NAME="pass" VALUE="$pass"><INPUT TYPE="HIDDEN" NAME="action" VALUE="Send Email"><TD>
	<INPUT TYPE="SUBMIT" VALUE="Send Your Ads"></TD></FORM>
<FORM ACTION="$list_dir/account.cgi" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="account" VALUE="$account"><INPUT TYPE="HIDDEN" NAME="pass" VALUE="$pass"><INPUT TYPE="HIDDEN" NAME="action" VALUE="Help"><TD>
	<INPUT TYPE="SUBMIT" VALUE="Need Help?"></TD></FORM>
</TR>
</TABLE>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" BGCOLOR="$bg_clr1" WIDTH="100%">
<tr>
<td align="left">&nbsp;&nbsp;&nbsp;<SMALL>Logged in as: <font color="red">$account</font></SMALL></TD>
<TD ALIGN="CENTER"><SMALL>Your Subscribe Address: <A HREF="mailto:$sub1" STYLE="COLOR: $def_linkcolor">$sub1</A>&nbsp;&nbsp;&nbsp;</SMALL></TD>
<TD ALIGN="CENTER"><SMALL>Active Member Count: <font color="red">$total</font></SMALL></TD>
<TD ALIGN="right"><A HREF="$logout" style="color: $def_linkcolor" target="_top">Click Here to Logout</A>&nbsp;&nbsp;&nbsp;</TD>
</TR>
</TABLE>

MEMBER_HEADER
