<?php
class myurl {
    public function __construct() {
    }
    function redirect ($link) {
	$redirect = mysql_fetch_assoc(mysql_query("SELECT url_link FROM urls WHERE url_short = '".addslashes($link)."'"));
	$redirect = "http://".str_replace("http://","",$redirect['url_link']);
	header('HTTP/1.1 301 Moved Permanently');  
	header("Location: ".$redirect);  
    }
    
    function shortGeneration() {
        $short = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);
        return $short;
    }

    function insertNewUrl($url, $short_url, $server) {
        mysql_query("INSERT INTO urls (url_link, url_short, url_ip, url_date) VALUES
	(
            '".addslashes($url)."',
            '".$short_url."',
            '".$server."',
            '".time()."'
	)
        ") or die (mysql_error());
        return 1;
    }
    
    function redirectNewLink($link) {
            $redirect = "?s=$link";
	    return header('Location: '.$redirect); die;
    }
    
    }
?>