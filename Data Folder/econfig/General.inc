print <<GENERAL_FORM;
<form method="POST"><div align="center">
<table>
<tr><td colspan="2" align="center" bgcolor="$base_color"><font color="$contrast_color">General/Main Settings</font></td></tr>
<tr><td colspan="2" align="center">Name of your safelist:<br><input name="new_sitename" value="$site_name" size="65" maxlength="65" class="form-input"></p></td></tr>
<tr><td align="right">Safelist Type: &nbsp;</td><td> &nbsp;<select name="new_safelisttype" class="form-input">$safelisttype_options</select></td></tr>
<tr><td align="right">Members Message Type: &nbsp;</td><td> &nbsp;<select name="new_messagetype" class="form-input">$messagetype_options</select></td></tr>
<tr><td align="right">Will you offer Advertiser Links? &nbsp;</td><td> &nbsp;<select name="new_advlinks" class="form-input">$advlinks_options</select></td></tr>
<tr><td colspan="2" align="center"><font size="1">Advertiser Links are links you will be sending to members that when they click on each one<br>they will earn a predefined amount of points/earnings.</td></tr>
<tr><td align="right">Amount of Time per Advertiser Link: &nbsp;</td><td> &nbsp;<input name="new_alinktime" size="7" class="form-input" value="$alink_time"> (in seconds)</td></tr>
<tr><td colspan="2" align="center"><font size="1">This is the amount of time the system waits before it gives credit to each member for the visit.</td></tr>
<tr><td align="right">Admin Section Password: &nbsp;</td><td> &nbsp;<input type="password" name="new_adminpassword" value="$admin_password" size="20" maxlength="25" class="form-input"></td></tr>
<tr><td align="right">.. Password (verify): &nbsp;</td><td> &nbsp;<input type="password" name="new_adminpasswordv" value="$admin_password" size="20" maxlength="25" class="form-input"></td></tr>
<tr><td align="right">Admin User ID: &nbsp;</td><td> &nbsp;<input name="new_adminid" value="$admin_id" size="20" maxlength="25" class="form-input"></td></tr>
<tr><td align="right">Admin Display Name: &nbsp;</td><td> &nbsp;<input name="new_adminname" value="$admin_name" size="20" maxlength="25" class="form-input"></td></tr>
<tr><td align="right">Admin Email Address: &nbsp;</td><td> &nbsp;<input name="new_adminemail" value="$admin_email" size="50" maxlength="65" class="form-input"></td></tr>
<tr><td align="right">Bounced Email Address: &nbsp;</td><td> &nbsp;<input name="new_bouncedemail" value="$bounced_email" size="50" maxlength="65" class="form-input"></td></tr>
<tr><td colspan="2" align="center"><font size="1">This is the email address where you want bounced messages to go to.</font></td></tr>
<tr><td align="right">New PRO and/or Platinum Member Notification? &nbsp;</td><td> &nbsp;<select name="new_notifypaid" class="form-input">$notifypaid_options</select></td></tr>
<tr><td align="right">New Paid Member Notify to Email Address: (<font size="1">if active</font>) &nbsp;</td><td> &nbsp;<input name="new_notifyemail" value="$notify_email" size="50" maxlength="65" class="form-input"></td></tr>
<tr><td align="right">Accept PayPal Payments? &nbsp;</td><td> &nbsp;<select name="new_acceptpaypal" class="form-input">$acceptpaypal_options</select></td></tr>
<tr><td align="right">Pay Earnings thru PayPal? &nbsp;</td><td> &nbsp;<select name="new_paybypaypal" class="form-input">$paybypaypal_options</select></td></tr>
<tr><td align="right">PayPal Email Address: &nbsp;</td><td> &nbsp;<input name="new_paypalemail" value="$paypal_email" size="50" maxlength="65" class="form-input"></td></tr>
<tr><td colspan="2" align="center"><font size="1">This is the PayPal.com email address where you want payments sent to. (if accepting PayPal.com payments)</font></td></tr>
<tr><td align="right">Accept E-gold Payments? &nbsp;</td><td> &nbsp;<select name="new_acceptegold" class="form-input">$acceptegold_options</select></td></tr>
<tr><td align="right">Pay Earnings thru E-gold? &nbsp;</td><td> &nbsp;<select name="new_paybyegold" class="form-input">$paybyegold_options</select></td></tr>
<tr><td align="right">E-gold Account Number: &nbsp;</td><td> &nbsp;<input name="new_egoldacct" value="$egold_acct" size="10" maxlength="10" class="form-input"></td></tr>
<tr><td colspan="2" align="center"><font size="1">This is the E-gold.com Account Number where you want payments sent to. (if accepting E-gold.com payments)</font></td><input type="hidden" name="action" value=" Update Settings Now "><input type="hidden" name="editwhat" value="General"><input type="hidden" name="adm_passwd" value="$adm_passwd"></tr>
<tr><td colspan="2" align="center"> &nbsp;&nbsp;</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" Update the $editwhat Settings " class="form-button"></td></tr>
</table>
</div></form>
GENERAL_FORM

1;
