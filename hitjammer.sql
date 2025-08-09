# MySQL dump 8.8
#
# Host: localhost    Database: mishies
#--------------------------------------------------------
# Server version	3.23.22-beta-log

#
# Table structure for table 'acct_type'
#

CREATE TABLE `acct_type` (
  `id` int(5) NOT NULL auto_increment,
  `accttype` varchar(25) DEFAULT '' NOT NULL,
  PRIMARY KEY (`id`)
);

#
# Dumping data for table 'acct_type'
#

INSERT INTO `acct_type` VALUES (1,'basic');
INSERT INTO `acct_type` VALUES (2,'silver');
INSERT INTO `acct_type` VALUES (3,'gold');

#
# Table structure for table 'admin'
#

CREATE TABLE `admin` (
  `username` varchar(20) DEFAULT '' NOT NULL,
  `password` varchar(20) DEFAULT '' NOT NULL
);

#
# Dumping data for table 'admin'
#

INSERT INTO `admin` VALUES ('hitjammer','hitjammer');

#
# Table structure for table 'adminMenu'
#

CREATE TABLE `adminMenu` (
  `id` int(4) NOT NULL auto_increment,
  `text` varchar(200) DEFAULT 'menu item' NOT NULL,
  `link` varchar(255) DEFAULT '' NOT NULL,
  `adminFile` varchar(255) DEFAULT '' NOT NULL,
  `active` char(1) DEFAULT 'y' NOT NULL,
  KEY `id` (`id`)
);

#
# Dumping data for table 'adminMenu'
#

INSERT INTO `adminMenu` VALUES (1,'QUICK STATS','mainTemplate.php?option=1','quickStats.php','y');
INSERT INTO `adminMenu` VALUES (2,'EDIT SITE PARAMETERS','mainTemplate.php?option=2','siteParams.php','y');
INSERT INTO `adminMenu` VALUES (3,'USER ADMINISTRATION','mainTemplate.php?option=3','userList.php','y');
INSERT INTO `adminMenu` VALUES (4,'URL LISTING','mainTemplate.php?option=4','urlList.php','y');
INSERT INTO `adminMenu` VALUES (5,'EMAIL USERS','mainTemplate.php?option=5','emailUsers.php','y');
INSERT INTO `adminMenu` VALUES (6,'URL LISTING','mainTemplate.php?option=4','urlList.php','y');
INSERT INTO `adminMenu` VALUES (7,'EMAIL USERS','mainTemplate.php?option=5','emailUsers.php','y');
#INSERT INTO `adminMenu` VALUES (6,'.','mainTemplate.php?option=4','bannerList.php','y');
#INSERT INTO `adminMenu` VALUES (7,'.','mainTemplate.php?option=5','clientList.php','y');
INSERT INTO `adminMenu` VALUES (8,'BLOCK ADMINISTRATION','mainTemplate.php?option=8','blockList.php','y');
INSERT INTO `adminMenu` VALUES (9,'FAQ ADMINISTRATION','mainTemplate.php?option=9','faqList.php','y');
INSERT INTO `adminMenu` VALUES (10,'CHANGE ADMIN PASSWORD','mainTemplate.php?option=10','changeAdmin.php','y');

#
# Table structure for table 'banner_clients'
#

CREATE TABLE `banner_clients` (
  `id` int(6) NOT NULL auto_increment,
  `client_name` varchar(255) DEFAULT '' NOT NULL,
  `contact_email` varchar(255) DEFAULT '' NOT NULL,
  `contact_phone` varchar(20) DEFAULT '' NOT NULL,
  `date_joined` date DEFAULT '0000-00-00' NOT NULL,
  UNIQUE `id` (`id`)
);

#
# Dumping data for table 'banner_clients'
#

INSERT INTO `banner_clients` VALUES (1,'sauseymike','info@mishies.com','000-000-0000','2002-10-16');
INSERT INTO `banner_clients` VALUES (2,'tony','molebrain@tonyrocks.com','724-424-2424','0000-00-00');
INSERT INTO `banner_clients` VALUES (6,'IMC','molebrain@tonyrocks.com','contact_phone','0000-00-00');
#INSERT INTO `banner_clients` VALUES (4,'Roig_Konitshek','molebrain@tonyrocks.com','222-222-2222','0000-00-00');

#
# Table structure for table 'banners'
#

CREATE TABLE `banners` (
  `id` int(4) NOT NULL auto_increment,
  `client_id` int(6) DEFAULT '1' NOT NULL,
  `banner` varchar(254) DEFAULT '' NOT NULL,
  `alttext` varchar(100) DEFAULT '' NOT NULL,
  `link` varchar(254) DEFAULT '' NOT NULL,
  `points` int(6) DEFAULT '0' NOT NULL,
  PRIMARY KEY (`id`)
);

#
# Dumping data for table 'banners'
#

INSERT INTO `banners` VALUES (1,1,'www.email2success.com/images/banner1.gif','Email 2 Success Bulk Email','hop.clickbank.net/?lovinlife/smass',999999);
INSERT INTO `banners` VALUES (2,2,'www.email2success.com/images/banner.gif','email blaster','hop.clickbank.net/?lovinlife/smass',999999);
INSERT INTO `banners` VALUES (3,6,'www.marketingtips.com/images/ML-03.GIF','Automate your online Business','www.marketingtips.com/mailloop/t.x/767448/',999999);
#INSERT INTO `banners` VALUES (4,4,'www.thelastmlm.com/mlm/banners/ban2.gif','The Last MLM','www.thelastmlm.com/mlm/b.php?rid=25',24682);
INSERT INTO `banners` VALUES (7,2,'www.10-million-hits.com/10mbanner.gif','10 Million Hits','http://hop.clickbank.net/?lovinlife.10miohits',999999);
INSERT INTO `banners` VALUES (8,2,'www.101-website-traffic.com/addesign.gif','Get 75 Million Hits','hop.clickbank.net/?lovinlife.75million',999999);
INSERT INTO `banners` VALUES (9,2,'surveyjunction.com/cashpaidbanner.gif','Get Paid For your Opinion!','hop.clickbank.net/?lovinlife/secure1',999999);
INSERT INTO `banners` VALUES (10,1,'www.pcspeedtweaks.com/images/banner2.gif','Speed Up your PC','hop.clickbank.net/?lovinlife.sanderson',999999);
INSERT INTO `banners` VALUES (11,2,'www.ffa-submit.com/images/banner1.gif','Submit to a TON of FFA sites','hop.clickbank.net/?lovinlife/ffasubmit',999999);
INSERT INTO `banners` VALUES (12,2,'ad2go.com/webpromotion/banners_2/resell_468_1.gif','Wow, this rocks!','www.ad2go.com/webpromotion/index.html?hop=lovinlife.ad2go',999999);

#
# Table structure for table 'faq'
#

CREATE TABLE `faq` (
  `id` int(4) NOT NULL auto_increment,
  `question` text,
  `answer` text,
  PRIMARY KEY (`id`)
);

#
# Dumping data for table 'faq'
#

INSERT INTO `faq` VALUES (4,'How do I earn points (hits) ?','By signing up, you are going to get 300 points.  But you will get an extra points for each site you view while surfing in the members \"SURF\" area.');
INSERT INTO `faq` VALUES (5,'What happens if I run out of points?','Your listed URL will become inactive.  As soon as you start surfing again, and there by earning points, your listed URL will be activated automatically.');
INSERT INTO `faq` VALUES (6,'How many points can I earn a day?','You will earn points as long as you are surfing.');
INSERT INTO `faq` VALUES (7,'I lost my password! What do I do?','You will see a link on the home page that says \"Lost Password.\"  Click on that link and fill out the information.  Your login/password information will be mailed to your email account.');
INSERT INTO `faq` VALUES (9,'Why do Zebras have stripes?','Because they are stressed, of course :)');

#
# Table structure for table 'points'
#

CREATE TABLE `points` (
  `userid` int(5) DEFAULT '0' NOT NULL,
  `username` varchar(10) DEFAULT '' NOT NULL,
  `points` decimal(7,1) DEFAULT '0.0' NOT NULL,
  UNIQUE `userid` (`userid`)
);

#
# Dumping data for table 'points'
#

INSERT INTO `points` VALUES (383,'',300.0);

#
# Table structure for table 'rightBlock'
#

CREATE TABLE `rightBlock` (
  `id` int(2) NOT NULL auto_increment,
  `title` varchar(255) DEFAULT 'Sponsor' NOT NULL,
  `body` text DEFAULT '' NOT NULL,
  `position` char(1) DEFAULT 'r' NOT NULL,
  `active` char(1) DEFAULT 'y' NOT NULL,
  `displayDate` date DEFAULT '0000-00-00' NOT NULL,
  PRIMARY KEY (`id`)
);

#
# Dumping data for table 'rightBlock'
#

INSERT INTO `rightBlock` VALUES (1,'Affiliates make CASH!','<font size=\"-2\"><B>FREE DOWNLOAD! How to outsell other resellers and become \r\n  A Super Affiliate...</b></font><br>\r\n  <img  height=176 src=\"images/superaffiliate.jpg\" width=177 border=0><br>\r\n<font size=\"-2\"><a href=\"http://www.tonyrocks.com/superbrand.exe\">Download Here</a><br>','r','y','0000-00-00');
INSERT INTO `rightBlock` VALUES (2,'Mailloop','  <table border=0>\r\n                    <tr> \r\n                      <td width=\"139\"><TABLE WIDTH=\"100%\" BORDER=0 CELLSPACING=0 CELLPADDING=0 NOF=TE>\r\n                          <TR> \r\n                            <TD ALIGN=\"CENTER\"><A HREF=\"http://www.marketingtips.com/mailloop/t.x/767448\" target=\"_blank\"> \r\n                              <IMG ID=\"Picture7\" HEIGHT=122 WIDTH=95 SRC=\"images/mailloopx.jpg\" BORDER=0></A></TD>\r\n                          </TR>\r\n                        </TABLE>\r\n                        <BR> <B><FONT SIZE=\"-2\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">Mailloop... \r\n                        <BR>\r\n                        </FONT></B><FONT SIZE=\"-2\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">Breakthrough \r\n                        Software That\'ll Run Your Business For You!<BR>\r\n                        <A HREF=\"http://www.marketingtips.com/mailloop/t.x/767448\" target=\"_blank\"> \r\n                        <IMG ID=\"Picture6\" HEIGHT=17 WIDTH=17 SRC=\"images/arrow.gif\" VSPACE=0 HSPACE=0\r\n			ALIGN=\"TOP\" BORDER=0></A> </FONT><A HREF=\"http://www.marketingtips.com/mailloop/t.x/767448\" target=\"_blank\"> \r\n                        <FONT SIZE=\"-2\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">Click \r\n                        here to learn more!</FONT></A> </td>\r\n                    </tr>\r\n                  </table>','r','y','0000-00-00');
INSERT INTO `rightBlock` VALUES (6,'I am the eggman!','What song is this line from? Come on, you know it!','l','y','0000-00-00');
INSERT INTO `rightBlock` VALUES (8,'menu','<a href=\"index.php?option=Home\">Home</a><BR>\r\n<a href=\"http://clickbank.com/marketplace/?r=lovinlife&c=marketing&s=0&i=10&t=ClickBank_Marketplace\" target=\"_blank\">Super FFA</a><BR><a href=\"index.php?option=marketing resources\">Marketing Resources</a><BR><a href=\"index.php?option=frequently%20asked%20questions\">FAQ</a><br><a href=\"index.php?option=Contact%20Me\">Contact Me</a>','l','y','0000-00-00');
INSERT INTO `rightBlock` VALUES (10,'Ebook Pro','<p align=\"center\"><a href=\"http://hop.clickbank.net/?lovinlife.ebksecretsse\" target=\"_blank\"><img src=\"http://www.tonyrocks.com/Marketing_resources/eBook_Secrets/ebooksecrets.jpg\" border=\"0\"></a> \r\n  <br>\r\n  This is a cool<br>\r\n  product that shows you how to make money with eBooks.</p>','l','y','0000-00-00');

#
# Table structure for table 'siteParams'
#

CREATE TABLE `siteParams` (
  `title` varchar(255) DEFAULT '' NOT NULL,
  `styleSheet` varchar(255) DEFAULT 'default.css' NOT NULL,
  `bgColor` varchar(10) DEFAULT '' NOT NULL,
  `headerColor` varchar(10) DEFAULT '' NOT NULL,
  `fontEmph` varchar(10) DEFAULT '' NOT NULL,
  `tableColor` varchar(10) DEFAULT '' NOT NULL,
  `tableColor2` varchar(10) DEFAULT '' NOT NULL,
  `alertColor` varchar(10) DEFAULT '' NOT NULL,
  `autoSurf` char(1) DEFAULT 'y' NOT NULL,
  `countDown` int(3) DEFAULT '20' NOT NULL,
  `waitCount` int(3) DEFAULT '20' NOT NULL,
  `sellPoints` varchar(5) DEFAULT '' NOT NULL,
  `signPoints` varchar(4) DEFAULT '100' NOT NULL,
  `refPoints` varchar(4) DEFAULT '' NOT NULL,
  `pointInc` decimal(3,1) DEFAULT '0.0' NOT NULL,
  `banner_img` varchar(255) DEFAULT '' NOT NULL,
  `banner_imgSmall` varchar(255) DEFAULT '' NOT NULL,
  `contact_email` varchar(255) DEFAULT '' NOT NULL,
  `paypal` varchar(255) DEFAULT '' NOT NULL,
  `clickBank` varchar(255) DEFAULT 'lovinlife' NOT NULL,
  `siteUrl` varchar(255) DEFAULT '' NOT NULL,
  `privacy` varchar(255) DEFAULT '' NOT NULL,
  `spam` varchar(255) DEFAULT '' NOT NULL,
  `contact_name` varchar(255) DEFAULT '' NOT NULL,
  `pickType` varchar(5) DEFAULT 'randm' NOT NULL,
  `mainText` text DEFAULT '' NOT NULL,
  `emailFooter` varchar(255) DEFAULT '' NOT NULL
);

#
# Dumping data for table 'siteParams'
#

INSERT INTO `siteParams` VALUES ('Mishies.com hit jammer 1.0','default.css','black','#666666','white','white','#f2f2f2','red','y',20,20,'true','300','300',1.0,'logo.gif','hitjammer15050.gif','molebrain@tonyrocks.com','','lovinlife','http://www.mishies.com/','privacy.htm','spam.htm','Your Name','weigh','<p><strong>Welcome to the <a href=\"http://www.mishies.com\">Mishies.com</a> Hitjammer \r\n  1.0</strong></p>\r\n<p>If you are seeing this message then chances are that everything has been installed \r\n  properlly. You can start to customize your Hitjammer by going to the administration \r\n  section of the site and editing your parameters. You will need to create your \r\n  banner logo as well. </p>','----You are receiving this email because you are a member of our site.  To stop receiving emails, please log into your account and select the option to not receive emails');

#
# Table structure for table 'surfMenu'
#

CREATE TABLE `surfMenu` (
  `id` int(4) NOT NULL auto_increment,
  `text` varchar(200) DEFAULT 'menu item' NOT NULL,
  `link` varchar(255) DEFAULT '' NOT NULL,
  `adminFile` varchar(255) DEFAULT '' NOT NULL,
  `section` char(1) DEFAULT 'r' NOT NULL,
  `active` char(1) DEFAULT 'y' NOT NULL,
  PRIMARY KEY (`id`)
);

#
# Dumping data for table 'surfMenu'
#

INSERT INTO `surfMenu` VALUES (1,'home','start.php?option=Home','','m','y');
INSERT INTO `surfMenu` VALUES (2,'Home','index.php?option=Home','','r','y');
#INSERT INTO `surfMenu` VALUES (3,'Super FFA','http://www.tonyrocks.com/cgi-bin/links.cgi','','r','y');
INSERT INTO `surfMenu` VALUES (4,'Marketing Resources','index.php?option=marketing resources','','r','y');
INSERT INTO `surfMenu` VALUES (5,'FAQ','index.php?option=frequently%20asked%20questions','','r','y');
INSERT INTO `surfMenu` VALUES (6,'Contact Me','index.php?option=Contact%20Me','','r','y');
INSERT INTO `surfMenu` VALUES (7,'personal stats','start.php?userid=<?php echo$id; ?>&option=personal stats','','m','y');

#
# Table structure for table 'text_table'
#

CREATE TABLE `text_table` (
  `id` int(11) NOT NULL auto_increment,
  `text_code` varchar(255),
  `text_value` text,
  `text_lang` varchar(5) DEFAULT '0',
  UNIQUE `id` (`id`)
);

#
# Dumping data for table 'text_table'
#

INSERT INTO `text_table` VALUES (1,'index_body','Are you looking for a way to drive more traffic to your Website? Tired of all the lies or broken promises?\r\n<BR><BR>\r\nPut simply, more visitors mean more sales, and that&#8217;s exactly what we can do for you at Mishies.com Hitjammer! Everyday we deliver millions of hits to our satisfied customers. Whether you want only 500 hits or 5,000,000 hits to your Website we can deliver this traffic to you starting today at minimal costs. You won&#8217;t find a better deal anywhere, our established reputation speaks for itself! \r\n<BR><BR>\r\nReceive 300 guaranteed NEW visitors to your Website FREE for signing up. It&#8217;s never been easier! Take advantage of this special offer because it won&#8217;t last long!  \r\n <BR><BR>\r\n  No referrals required. Sign Up now and get lots of NEW visitors to your site immediately! \r\n <BR>\r\n','0');

#
# Table structure for table 'url_points'
#

CREATE TABLE `url_points` (
  `urlid` int(5) DEFAULT '0' NOT NULL,
  `points` int(7) DEFAULT '0' NOT NULL,
  `pointdate` date DEFAULT '0000-00-00' NOT NULL
);

#
# Dumping data for table 'url_points'
#

INSERT INTO `url_points` VALUES (383,35,'2003-01-14');
INSERT INTO `url_points` VALUES (383,32,'2003-01-18');

#
# Table structure for table 'url_table'
#

CREATE TABLE `url_table` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(5) DEFAULT '0' NOT NULL,
  `website` varchar(255) DEFAULT '' NOT NULL,
  `active` char(1) DEFAULT 'n' NOT NULL,
  `datechanged` date DEFAULT '0000-00-00' NOT NULL,
  PRIMARY KEY (`id`)
);

#
# Dumping data for table 'url_table'
#

INSERT INTO `url_table` VALUES (399,383,'http://tonyrocks.com/Marketing_resources/10-Million-Hits','y','2003-01-12');

#
# Table structure for table 'user'
#

CREATE TABLE `user` (
  `id` int(5) NOT NULL auto_increment,
  `fname` varchar(36) DEFAULT '' NOT NULL,
  `lname` varchar(36) DEFAULT '' NOT NULL,
  `username` varchar(10) DEFAULT '' NOT NULL,
  `password` varchar(10) DEFAULT '' NOT NULL,
  `email` varchar(255) DEFAULT '' NOT NULL,
  `acct_type` int(2) DEFAULT '1' NOT NULL,
  `point_inc` decimal(3,1) DEFAULT '0.0' NOT NULL,
  `referral` varchar(10) DEFAULT '' NOT NULL,
  `joindate` timestamp(14),
  `verified` char(1) DEFAULT 'n',
  `receiveEmail` char(1) DEFAULT 'y' NOT NULL,
  UNIQUE `id` (`id`),
  UNIQUE `username` (`username`),
  UNIQUE `username_2` (`username`)
);

#
# Dumping data for table 'user'
#

INSERT INTO `user` VALUES (383,'tony','tony','tony','tony','info@mishies.com',1,1.0,'',20030112224504,'y','y');

