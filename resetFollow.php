<SCRIPT language=JavaScript type=text/javascript>
  <!--
  if(window != window.top)
  {
  	top.location.href=location.href;
  }
  // -->
  </SCRIPT>
<?php
require 'include.inc'; 	
pageHeader($title, $bgColor, $styleSheet);
?>
<DIV align=left> 
  <TABLE border="0" cellPadding="0" cellSpacing="0" style="topmargin: 0; leftmargin: 0" width="100%">
    <TBODY>
      <TR> 
        <TD height="100%" width="33%">&nbsp;</TD>
        <TD bgColor="#ffffff" vAlign="top" width="800"><A name="#top"></A> <DIV align=left> 
            <TABLE bgColor="#ffffff" border="0" cellPadding="0" cellSpacing="0" width="800">
              <TBODY>
                <TR> 
                  <TD bgColor="#ffffff" width="75"></TD>
                  <TD bgColor="#ffffff" width="650"><IMG border="0" height="72" src="images/<? echo $banner_img; ?>" width="650" alt="<? echo $title; ?>"></TD>
                  <TD bgColor="#ffffff" width="75">&nbsp;</TD>
                </TR>
                <!-- row3 -->
                <TR> 
                  <TD bgColor="#ffffff" width=75></TD>
                  <TD align="CENTER" bgColor="#ffffff" height=20 vAlign="MIDDLE" width="650"> 
                    <P align=left class=pfad><? echo $title; ?> <IMG border=0 height=2 src="images/linie.gif" width="650" alt="--"></P></TD>
                  <TD bgColor="#ffffff" width=75>&nbsp;</TD>
                </TR>
              </TBODY>
            </TABLE>
          </DIV></TD>
        <TD height="100%" width="34%">&nbsp;</TD>
      </TR>
    </TBODY>
  </TABLE>
</DIV><DIV align="left">
<TABLE border="0" cellPadding="0" cellSpacing="0" style="topmargin: 0; leftmargin: 0" width="100%"> 
<TR> 
  <TD height="100%" width="33%">&nbsp;</TD><TD bgColor="#ffffff" vAlign="TOP" width="800"><DIV align=left> 
  <TABLE bgColor="#ffffff" border=0 cellPadding=0 cellSpacing=1 width=800><TR><TD bgColor="#ffffff" colSpan=3 width="800">
<DIV align=center>
    <TABLE border=0 cellPadding=0 cellSpacing=0 width="750">
      <TR> 
        <TD align="CENTER" vAlign="top" width="150"> <DIV align=left> </DIV>
          <BR>
          &nbsp;<BR>
          <BR> </td>
        <TD align="CENTER" vAlign="TOP" width=500> <DIV align=center> 
            <table border=0 cellpadding=1 cellspacing=4 width=400>
              <tbody>
                <tr> 
                  <td align="CENTER" bgcolor="#660000" colspan="2"><font
                        color="#ffffff" face="Arial,Helvetica,Geneva,sans-serif"
                        size="4"><b></b></font></td>
                </tr>
                <tr> 
                  <td bgcolor="#ffffff" colspan=2 valign="TOP"><font color="#333333"> 
Your login information has been sent to your registered email account.
                    </font></td>
                </tr>
                <tr> 
                  <td align="CENTER" colspan=2 height=20 valign="MIDDLE" > <img border=0 height=2 src="images/linie.gif" width="380" alt="--"></td>
                </tr>
            </table>
          </DIV></TD>
        <TD align="CENTER" vAlign="TOP"> <DIV align=left> </DIV>
          <BR>
          &nbsp;<BR>
          <BR> <p> 
          <DIV align=left> </DIV>
          <BR>
          &nbsp;<BR>
          <BR> </TD>
      </TR>
      <TR> 
        <TD align="CENTER" vAlign="TOP" width=150>&nbsp;</TD>
        <TD align="CENTER" vAlign="TOP" width=500>&nbsp;</TD>
        <TD align="CENTER" vAlign="TOP" width=150>&nbsp;</TD>
      </TR>
      <!-- / row2 --><TR>
      <TD align="CENTER" vAlign="TOP" width=150>&nbsp;</TD><TD align="CENTER" vAlign="TOP" width=500>
      <table width="100%">
        <tr> 
          <? footer("$contact_email"); ?></TD></tr>
        <TD align="CENTER" vAlign="top" width=150>&nbsp;</TD>
        </TR>
      </TABLE></DIV></TD></TR>
    </TABLE></DIV></TD>
    <TD height="100%"
width="34%">&nbsp;</TD>
    </TR>
  </TABLE></DIV></BODY></HTML>

