<?php
include('config.php');
//create the urls table if it's not already there:
mysql_query("CREATE TABLE IF NOT EXISTS `urls` (
  `url_id` int(11) NOT NULL auto_increment,
  `url_link` varchar(255) default NULL,
  `url_short` varchar(6) default NULL,
  `url_date` int(10) default NULL,
  `url_ip` varchar(255) default NULL,
  `url_hits` int(11) default '0',
  PRIMARY KEY  (`url_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

mysql_query("CREATE TABLE IF NOT EXISTS `url_stats` (
  `log_id` int(11) NOT NULL auto_increment,
  `hit_url` varchar(255) NOT NULL,
  `hit_ip` varchar(255) default NULL,
  `hit_date` int(10) default NULL,  
PRIMARY KEY  (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
?>