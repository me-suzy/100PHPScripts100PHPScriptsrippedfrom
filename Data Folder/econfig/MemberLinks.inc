require "$data_dir/iMLinks.pm";
if ($verify_aemails) { $vayes = " selected"; }
else { $vano = " selected"; }
print <<DISPLAYPRICES_FORM;
<form method="POST"><div align="center">
<table>
<tr><td colspan="2" align="center" bgcolor="$base_color"><font color="$contrast_color">Advertisers Section Settings</font></td></tr>
<tr><td align="right">Maximum Links per Membership Type: &nbsp;</td><td> &nbsp;<input name="n_maxlinkspertype" value="$maxlinks_pertype" size="10" class="form-input"></td></tr>
<tr><td align="right">Maximum Description characters (Free): &nbsp;</td><td> &nbsp;<input name="n_mlinkmcfree" value="$mlinkmc_free" size="10" class="form-input"></td></tr>
<tr><td align="right">Maximum Description characters (Pro): &nbsp;</td><td> &nbsp;<input name="n_mlinkmcpro" value="$mlinkmc_pro" size="10" class="form-input"></td></tr>
<tr><td align="right">Maximum Description characters (Platinum): &nbsp;</td><td> &nbsp;<input name="n_mlinkmcplat" value="$mlinkmc_plat" size="10" class="form-input"></td><input type="hidden" name="action" value=" Update Settings Now "><input type="hidden" name="editwhat" value="MemberLinks"><input type="hidden" name="adm_passwd" value="$adm_passwd"></tr>
<tr><td colspan="2" align="center"> &nbsp;&nbsp;</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" Update the $editwhat Settings " class="form-button"></td></tr>
</table>
</div></form>
DISPLAYPRICES_FORM

1;
