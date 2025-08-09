require "$data_dir/iConfigAdver.pm";
if ($verify_aemails) { $vayes = " selected"; }
else { $vano = " selected"; }
print <<DISPLAYPRICES_FORM;
<form method="POST"><div align="center">
<table>
<tr><td colspan="2" align="center" bgcolor="$base_color"><font color="$contrast_color">Advertisers Section Settings</font></td></tr>
<tr><td align="right">Advertisers CGI-BIN URL: &nbsp;</td><td> &nbsp;<input name="n_advertisercgi" value="$advertiser_cgi" size="60" class="form-input"></td></tr>
<tr><td align="right">Advertisers Login URL: &nbsp;</td><td> &nbsp;<input name="n_advertiserloginurl" value="$advertiser_loginurl" size="60" class="form-input"></td></tr>
<tr><td align="right">Advertisers Logout URL: &nbsp;</td><td> &nbsp;<input name="n_advertiserlogouturl" value="$advertiser_logouturl" size="60" class="form-input"></td></tr>
<tr><td align="right">Verify Advertiser Email Addresses: &nbsp;</td><td> &nbsp;<select name="n_vaemails" size="1" class="form-input"><option value="0"$vano>No - Verification Off</option><option value="1"$vayes>Yes - Verification On</option></select></td><input type="hidden" name="action" value=" Update Settings Now "><input type="hidden" name="editwhat" value="Advertisers"><input type="hidden" name="adm_passwd" value="$adm_passwd"></tr>
<tr><td colspan="2" align="center"> &nbsp;&nbsp;</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" Update the $editwhat Settings " class="form-button"></td></tr>
</table>
</div></form>
DISPLAYPRICES_FORM

1;
