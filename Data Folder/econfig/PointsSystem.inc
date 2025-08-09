print <<POINTSSYSTEM_FORM;
<form method="POST"><div align="center">
<table>
<tr><td colspan="2" align="center" bgcolor="$base_color"><font color="$contrast_color">Points System Settings</font></td></tr>
<tr><td align="right">Points added to a member's account when they join - FREE: &nbsp;</td><td> &nbsp;<input name="new_pointsjoinfree" value="$points_joinfree" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account when they join - PRO: &nbsp;</td><td> &nbsp;<input name="new_pointsjoinpro" value="$points_joinpro" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account when they join - PLATINUM: &nbsp;</td><td> &nbsp;<input name="new_pointsjoinplat" value="$points_joinplat" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account for each referral - FREE: &nbsp;</td><td> &nbsp;<input name="new_pointsreferfree" value="$points_referfree" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account for each referral - PRO: &nbsp;</td><td> &nbsp;<input name="new_pointsreferpro" value="$points_referpro" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account for each referral - PLATINUM: &nbsp;</td><td> &nbsp;<input name="new_pointsreferplat" value="$points_referplat" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account for each list email read - FREE: &nbsp;</td><td> &nbsp;<input name="new_pointsreadfree" value="$points_readfree" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account for each list email read - PRO: &nbsp;</td><td> &nbsp;<input name="new_pointsreadpro" value="$points_readpro" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account for each list email read - PLATINUM: &nbsp;</td><td> &nbsp;<input name="new_pointsreadplat" value="$points_readplat" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account for each Advertiser Link click <b>*</b> - FREE: &nbsp;</td><td> &nbsp;<input name="new_pointsalinkfree" value="$points_alinkfree" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account for each Advertiser Link click <b>*</b> - PRO: &nbsp;</td><td> &nbsp;<input name="new_pointsalinkpro" value="$points_alinkpro" size="7" class="form-input"></td></tr>
<tr><td align="right">Points added to a member's account for each Advertiser Link click <b>*</b> - PLATINUM: &nbsp;</td><td> &nbsp;<input name="new_pointsalinkplat" value="$points_alinkplat" size="7" class="form-input"></td></tr>
<tr><td align="right">Points substracted from a member's account for each email ad sent - FREE: &nbsp;</td><td> &nbsp;<input name="new_pointsemailfree" value="$points_emailfree" size="7" class="form-input"></td></tr>
<tr><td align="right">Points substracted from a member's account for each email ad sent - PRO: &nbsp;</td><td> &nbsp;<input name="new_pointsemailpro" value="$points_emailpro" size="7" class="form-input"></td></tr>
<tr><td align="right">Points substracted from a member's account for each email ad sent - PLATINUM: &nbsp;</td><td> &nbsp;<input name="new_pointsemailplat" value="$points_emailplat" size="7" class="form-input"></td></tr>
<tr><td colspan="2" align="center"><font size="1">The amount of points per email ad sent is a per email sent to each one of the other members of the list.</font></td></tr>
<tr><td align="right">Give members the option of buy extra points? &nbsp;</td><td><select name="new_sellpoints" class="form-input">$sellpoints_options</select></td></tr>
<tr><td colspan="2" align="center"><font size="1">When this is set to Yes, members will be able to buy a specified amount of points per dollar thru the members<br>section. Payments for the points will be accepted thru your accepted methods of payments from the general settings.</td></tr>
<tr><td align="right">Points sold/added to a member's account per Dollar <b>*</b> - FREE: &nbsp;</td><td> &nbsp;<input name="new_pointsperdollarfree" value="$points_perdollarfree" size="7" class="form-input"></td></tr>
<tr><td align="right">Points sold/added to a member's account per Dollar <b>*</b> - PRO: &nbsp;</td><td> &nbsp;<input name="new_pointsperdollarpro" value="$points_perdollarpro" size="7" class="form-input"></td></tr>
<tr><td align="right">Points sold/added to a member's account per Dollar <b>*</b> - PLATINUM: &nbsp;</td><td> &nbsp;<input name="new_pointsperdollarplat" value="$points_perdollarplat" size="7" class="form-input"></td></tr>
<tr><td align="right">Minimum Amount of Dollars per member's points purchase <b>*</b> - FREE: &nbsp;</td><td> &nbsp;<input name="new_pointsminbuyfree" value="$points_minbuyfree" size="7" class="form-input"></td></tr>
<tr><td align="right">Minimum Amount of Dollars per member's points purchase <b>*</b> - PRO: &nbsp;</td><td> &nbsp;<input name="new_pointsminbuypro" value="$points_minbuypro" size="7" class="form-input"></td></tr>
<tr><td align="right">Minimum Amount of Dollars per member's points purchase <b>*</b> - PLATINUM: &nbsp;</td><td> &nbsp;<input name="new_pointsminbuyplat" value="$points_minbuyplat" size="7" class="form-input"></td><input type="hidden" name="action" value=" Update Settings Now "><input type="hidden" name="editwhat" value="Points System"><input type="hidden" name="adm_passwd" value="$adm_passwd"></tr>
<tr><td colspan="2" align="center"> &nbsp;&nbsp;</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" Update the $editwhat Settings " class="form-button"></td></tr>
</table>
<p><font size="1"><b>*</b> These settings apply only if their appropriate option is active.</font></p>
</div></form>
POINTSSYSTEM_FORM

1;
