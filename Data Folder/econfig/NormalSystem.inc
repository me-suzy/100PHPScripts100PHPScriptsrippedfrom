print <<NORMALSYSTEM_FORM;
<form method="POST"><div align="center">
<table>
<tr><td colspan="2" align="center" bgcolor="$base_color"><font color="$contrast_color">Normal System Settings</font></td></tr>
<tr><td align="right">Days in between sends (FREE): &nbsp;</td><td> &nbsp;<input name="new_normalfreedays" value="$normal_freedays" size="10" class="form-input"></td></tr>
<tr><td align="right">Days in between sends (PRO): &nbsp;</td><td> &nbsp;<input name="new_normalprodays" value="$normal_prodays" size="10" class="form-input"></td></tr>
<tr><td align="right">Days in between sends (PLATINUM): &nbsp;</td><td> &nbsp;<input name="new_normalplatinumdays" value="$normal_platinumdays" size="10" class="form-input"></td></tr>
<tr><td align="right">Earnings made for each paid referral - FREE: &nbsp;</td><td> &nbsp;\$<input name="new_normalreferfree" value="$normal_referfree" size="10" class="form-input"></td></tr>
<tr><td align="right">Earnings made for each paid referral - PRO: &nbsp;</td><td> &nbsp;\$<input name="new_normalreferpro" value="$normal_referpro" size="10" class="form-input"></td></tr>
<tr><td align="right">Earnings made for each paid referral - PLATINUM: &nbsp;</td><td> &nbsp;\$<input name="new_normalreferplat" value="$normal_referplat" size="10" class="form-input"></td></tr>
<tr><td align="right">Earnings made for each Advertiser Links click <b>*</b> - FREE: &nbsp;</td><td> &nbsp;\$<input name="new_normalalinkfree" value="$normal_alinkfree" size="10" class="form-input"></td></tr>
<tr><td align="right">Earnings made for each Advertiser Links click <b>*</b> - PRO: &nbsp;</td><td> &nbsp;\$<input name="new_normalalinkpro" value="$normal_alinkpro" size="10" class="form-input"></td></tr>
<tr><td align="right">Earnings made for each Advertiser Links click <b>*</b> - PLATINUM: &nbsp;</td><td> &nbsp;\$<input name="new_normalalinkplat" value="$normal_alinkplat" size="10" class="form-input"></td></tr>
<tr><td align="right">Earnings made for each list email read - FREE: &nbsp;</td><td> &nbsp;\$<input name="new_normalreadfree" value="$normal_readfree" size="10" class="form-input"></td></tr>
<tr><td align="right">Earnings made for each list email read - PRO: &nbsp;</td><td> &nbsp;\$<input name="new_normalreadpro" value="$normal_readpro" size="10" class="form-input"></td></tr>
<tr><td align="right">Earnings made for each list email read - PLATINUM: &nbsp;</td><td> &nbsp;\$<input name="new_normalreadplat" value="$normal_readplat" size="10" class="form-input"></td></tr>
<tr><td colspan="2" align="center"><font size="1">
If the earnings for list email read is set to anything above 0, then at the bottom of each list email ad each<br>member receives there will be a link with a unique id they can click on to get credit for reading the email.</font></td><input type="hidden" name="action" value=" Update Settings Now "><input type="hidden" name="editwhat" value="Normal System"><input type="hidden" name="adm_passwd" value="$adm_passwd"></tr>
<tr><td colspan="2" align="center"> &nbsp;&nbsp;</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" Update the $editwhat Settings " class="form-button"></td></tr>
</table>
<p><font size="1"><b>*</b> These settings apply only if their appropriate option is active.</font></p>
</div></form>
NORMALSYSTEM_FORM

1;
