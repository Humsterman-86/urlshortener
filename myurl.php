<?php
class existingUrl {
    public $link;
    public function __construct($url) {
        $this->link = $url;
        $this->redirect($url);
    }
    function redirect ($link) {
	$redirect = mysql_fetch_assoc(mysql_query("SELECT url_link FROM urls WHERE url_short = '".addslashes($link)."'"));
	$redirect = "http://".str_replace("http://","",$redirect['url_link']);
	header('HTTP/1.1 301 Moved Permanently');  
	header("Location: ".$redirect);  
    } 
}

class newUrl {
    public $link;
    public $short;
    public function __construct($url) {
        $this->link = $url;
        $this->checkUrl();
    }    

    function checkUrl() {
        $query = mysql_query('SELECT url_short FROM urls WHERE url_link ="'.$this->link.'"');
        if(mysql_num_rows($query) == 0)
            {
            $this->newRecord();
            }
    else
            {
            $sql_url = mysql_fetch_assoc($query);
            $short_url = $sql_url['url_short'];
            $this->redirectNewLink($short_url);
            }

    }
    
    function newRecord() {
        $short = $this->shortGeneration();
        $this->insertNewUrl($this->link, $short);
        $this->redirectNewLink($short);
    }
    
    function shortGeneration() {
        $short = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);
        return $short;
    }

    function insertNewUrl($url, $short_url) {
        mysql_query("INSERT INTO urls (url_link, url_short, url_ip, url_date) VALUES
	(
            '".addslashes($url)."',
            '".$short_url."',
            '".$_SERVER['REMOTE_ADDR']."',
            '".time()."'
	)
        ") or die (mysql_error());
        return 1;
    }
    
    function redirectNewLink($link) {
            $redirect = "?s=$link";
	    return header('Location: '.$redirect); die;
    }
    
    function addHint($short_url) {
        
    }
    
    }
?>