print <<HTML_HEAD;
<html>
<head>
<title>$site_name - $section</title>
<style>
<!--
BODY         { font-family: $dfont_name; font-size: $dfont_size; color: $dfont_color }
TD           { font-family: $dfont_name; font-size: $dfont_size; color: $dfont_color }
H2           { font-family: $name_font; font-size: $name_size; color: $base_color }
A            { color: $link_color }
A:HOVER      { color: $hover_color }
A:VISITED    { color: $link_color }
NAV          { color: $contrast_color; text-decoration: none }
NAV:HOVER    { text-decoration: underline overline }
NAV:VISITED  { color: $contrast_color; text-decoration: none }
.form-button { font-family: $dfont_name; font-size: 11px; color: $contrast_color; background: $base_color; height: 19 }
.form-input  { font-family: $dfont_name; font-size: 11px; color: $base_color; height: 19 }
.form-text   { font-family: $dfont_name; font-size: 11px; color: $base_color }
-->
</style>
</head>
<body background="$background_img" bgcolor="$page_color">
<table width="100%">
  <tr>
    <td align="center"><h2>$site_name</h2><i>$section</i></td>
  </tr>
</table>
<table width="100%" bgcolor="$base_color">
  <tr>
$navigation_menu
  </tr>
</table>
<blockquote>
  <blockquote>
    <p>&nbsp; </p>
HTML_HEAD
