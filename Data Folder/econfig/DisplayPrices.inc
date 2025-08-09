print <<DISPLAYPRICES_FORM;
<form method="POST"><div align="center">
<table>
<tr><td colspan="2" align="center" bgcolor="$base_color"><font color="$contrast_color">Display & Prices Settings</font></td></tr>
<tr><td align="right">Default Font Name: &nbsp;</td><td> &nbsp;<input name="new_dfontname" value="$dfont_name" size="20" class="form-input"></td></tr>
<tr><td align="right">Default Font Size: &nbsp;</td><td> &nbsp;<input name="new_dfontsize" value="$dfont_size" size="20" class="form-input"></td></tr>
<tr><td align="right">Default Font Color: &nbsp;</td><td> &nbsp;<input name="new_dfontcolor" value="$dfont_color" size="20" class="form-input"></td></tr>
<tr><td align="right">Safelist Name Font: &nbsp;</td><td> &nbsp;<input name="new_namefont" value="$name_font" size="20" class="form-input"></td></tr>
<tr><td align="right">Safelist Name Size: &nbsp;</td><td> &nbsp;<input name="new_namesize" value="$name_size" size="20" class="form-input"></td></tr>
<tr><td align="right">Safelist Name Color: &nbsp;</td><td> &nbsp;<input name="new_namecolor" value="$name_color" size="20" class="form-input"></td></tr>
<tr><td colspan="2" align="center">Safelist Name Wide Logo Image URL:<br><input name="new_listnamelogoimg" value="$listnamelogo_img" size="65" class="form-input"><br><font size="1">If you have a wide graphic logo of your safelist's name, and want to replace<br>the text safelist name in your pages with it just enter the URL to<br>the image here.  Leave it blank if not.</font></td></tr>
<tr><td align="right">Links Hover Color: &nbsp;</td><td> &nbsp;<input name="new_hovercolor" value="$hover_color" size="20" class="form-input"></td></tr>
<tr><td align="right">Background Color: &nbsp;</td><td> &nbsp;<input name="new_pagecolor" value="$page_color" size="20" class="form-input"></td></tr>
<tr><td colspan="2" align="center">Page Background Image URL:<br><input name="new_backgroundimg" value="$background_img" size="65" class="form-input"><br><font size="1">If you want to use a graphic as the background in your<br>pages just enter the URL to the image here.  Leave it blank if not.</font></td></tr>
<tr><td align="right">Template Base Color: &nbsp;</td><td> &nbsp;<input name="new_basecolor" value="$base_color" size="20" class="form-input"></td></tr>
<tr><td align="right">Template Contrast Color: &nbsp;</td><td> &nbsp;<input name="new_contrastcolor" value="$contrast_color" size="20" class="form-input"></td></tr>
<tr><td align="right">Max. buttons per line in navigation menu: &nbsp;</td><td> &nbsp;<input name="new_maxbuttons" value="$max_buttons" class="form-input"></td></tr>
<tr><td colspan="2" align="center"><font size="1">If you are using a template that uses a sidebar navigation menu just enter 1 here.</font></td></tr>
<tr><td align="right">Price for FREE to PRO upgrades: &nbsp;</td><td> &nbsp;\$<input name="new_pricesfreetopro" value="$prices_freetopro" size="10" class="form-input"></td></tr>
<tr><td align="right">Price for FREE to PLATINUM upgrades: &nbsp;</td><td> &nbsp;\$<input name="new_pricesfreetoplat" value="$prices_freetoplat" size="10" class="form-input"></td></tr>
<tr><td align="right">Price for PRO to PLATINUM upgrades: &nbsp;</td><td> &nbsp;\$<input name="new_pricesprotoplat" value="$prices_protoplat" size="10" class="form-input"></td></tr>
<tr><td align="right">Re-billing Cycle length for PRO memberships: &nbsp;</td><td> &nbsp;<select name="new_cyclespro" class="form-input">$cyclespro_options</select></td></tr>
<tr><td align="right">Re-billing Cycle length for PLATINUM memberships: &nbsp;</td><td> &nbsp;<select name="new_cyclesplatinum" class="form-input">$cyclesplatinum_options</select></td></tr>
<tr><td colspan="2" align="center"><font size="1">The only automatic re-billing currently available with the package, is by use of the<br>Subscriptions feature from PayPal.com so if you won't be accepting payments thru<br>PayPal then <b>you must</b> take care of the re-billing yourself.</font></td><input type="hidden" name="action" value=" Update Settings Now "><input type="hidden" name="editwhat" value="Display & Prices"><input type="hidden" name="adm_passwd" value="$adm_passwd"></tr>
<tr><td colspan="2" align="center"> &nbsp;&nbsp;</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" Update the $editwhat Settings " class="form-button"></td></tr>
</table>
</div></form>
DISPLAYPRICES_FORM

1;
