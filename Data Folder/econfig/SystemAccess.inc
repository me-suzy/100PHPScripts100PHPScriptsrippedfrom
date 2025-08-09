print <<SYSTEMACCESS_FORM;
<form method="POST"><div align="center">
<table>
<tr><td colspan="2" align="center" bgcolor="$base_color"><font color="$contrast_color">System & Access Settings</font></td></tr>
<tr><td colspan="2" align="center">Members CGI-BIN Url:<br><input name="new_cgibin" value="$cgi_bin" size="75" class="form-input"><br><font size="1">This is the URL to where all the scripts for members functions are located.<br><font color=red>NO TRAILING SLASH (/)</font></font></td></tr>
<tr><td colspan="2" align="center">Admin CGI-BIN Url:<br><input name="new_admincgi" value="$admin_cgi" size="75" class="form-input"><br><font size="1">This is the URL to where all the scripts for administrative functions are located.<br><font color=red>NO TRAILING SLASH (/)</font></font></td></tr>
<tr><td colspan="2" align="center">Logout Page Url:<br><input name="new_logouturl" value="$logout_url" size="75" class="form-input"><br><font size="1">This is the URL to where you want members to go when logging off.</font></td></tr>
<tr><td colspan="2" align="center">Login Page Url:<br><input name="new_loginurl" value="$login_url" size="75" class="form-input"><br><font size="1">This is the URL to where the login page to your safelist is located.<br><font color=red>INCLUDE THE PAGE NAME (ie. login.html)</font></font></td></tr>
<tr><td colspan="2" align="center">Click Through Url:<br><input name="new_clickthruurl" value="$clickthru_url" size="75" class="form-input"><br><font size="1">This is the URL to that you want referred visitors to see first.</font></td></tr>
<tr><td colspan="2" align="center">Data Directory Path:<br><input name="new_datadir" value="$data_dir" size="75" class="form-input"><br><font size="1">This is FULL path to the data directory on your server/hosting acocunt.<br><font color=red>NO TRAILING SLASH (/)</font></font></td></tr>
<tr><td colspan="2" align="center">Sendmail Path:<br><input name="new_mailprog" value="$mailprog" size="75" class="form-input"><br><font size="1">This is FULL path to Sendmail on your server/hosting acocunt.</font></td></tr>
<tr><td align="right">Server/Hosting Account type of Operating System: &nbsp;</td><td><select name="new_opsystem" class="form-input">$opsystem_options</select></td>
<tr><td colspan="2" align="center" bgcolor="$base_color"><font color="$contrast_color">MySQL Database Settings</font></td></tr>
<tr><td colspan="2" align="center"><font size="1" color="red"><b>Only edit change settings if your list is not working properly, or if you changed the working information.</b></font></td></tr>
<tr><td align="right">MySQL Database Name: &nbsp;</td><td> &nbsp;<input name="new_mysqldbname" value="$mysql_dbname" size="25" class="form-input"></td></tr>
<tr><td align="right">MySQL Database Username: &nbsp;</td><td> &nbsp;<input name="new_mysqlusername" value="$mysql_username" size="25" class="form-input"></td></tr>
<tr><td align="right">MySQL Database Password: &nbsp;</td><td> &nbsp;<input name="new_mysqlpassword" value="$mysql_password" size="25" class="form-input"></td></tr>
<tr><td align="right">MySQL Database Host: &nbsp;</td><td> &nbsp;<input name="new_mysqlhost" value="$mysql_host" size="25" class="form-input"></td></tr>
<tr><td colspan="2" align="center"><font size="1">In most all servers/hosting accounts the host will work when left blank, if it doesn't then enter the appropriate host name here.</font></td><input type="hidden" name="action" value=" Update Settings Now "><input type="hidden" name="editwhat" value="System & Access"><input type="hidden" name="adm_passwd" value="$adm_passwd"></tr>
<tr><td colspan="2" align="center"> &nbsp;&nbsp;</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" Update the $editwhat Settings " class="form-button"></td></tr>
</table>
</div></form>
SYSTEMACCESS_FORM

1;
