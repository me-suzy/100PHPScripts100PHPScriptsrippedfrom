# If you edit this file make sure that the: print <<AFFILIATE_BANNERS;
# is the first line above all your html code, and that there is a
# line with only: AFFILIATE_BANNERS at the bottom below all your html
# code, if not you will get errors when runnig the scripts

print <<AFFILIATE_BANNERS;

<font face="$def_font" size="$def_fsize">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0">
<TR>
<td align="center">
<p><b>Get your affiliate banner and/or text link below:</b></p>
<p><font color="green">You will earn \$$commissions.00 for every PRO member you refer to the $list_name</font></p>
<p>Banner #1:<br><img src="/images/banner.gif" width="468" height="60"></p>
<p><textarea rows="3" cols="70"><a href="$list_dir/in.cgi?$account"><img src="/imgs/banner.gif" width="468" height="60"></a></textarea></p>
<p>Text Link:<br>$list_dir/in.cgi?$account</p>
<p><textarea rows="2" cols="70">$list_dir/in.cgi?$account</textarea></p>
</td>
</tr>
</TABLE>
</font>

AFFILIATE_BANNERS
