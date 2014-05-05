<?php

//mysql db connection information
$hostname = "localhost"; //host
$database = "urls"; //database
$username = "root"; //username for your database
$password = "qwerty"; //password for your database

$site = mysql_connect($hostname, $username, $password); 
mysql_select_db($database, $site) or die (mysql_error());
//

$server_name = "http://".$_SERVER['HTTP_HOST']."/";

?>