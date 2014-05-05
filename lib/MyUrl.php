<?php
class existingUrl {
    public $link;
// Constructor
    public function __construct($url) {
        $this->link = $url;
        $this->redirect($this->link);
    }
    
    function redirect ($link) {
	$redirect = mysql_fetch_assoc(mysql_query("SELECT url_link FROM urls WHERE url_short = '".addslashes($link)."'"));
        $redirect = "http://".str_replace("http://","",$redirect['url_link']);
        header('HTTP/1.1 301 Moved Permanently');  
	header("Location: ".$redirect);  
    }
   
    function addHit($link_id) {
        while (!mysql_query("INSERT INTO url_stats (hit_url, hit_ip, hit_date) VALUES ('".$link_id."','".$_SERVER['REMOTE_ADDR']."','".time()."')")) {};
    }

}

class newUrl {
    public $link;
    public $short;
    public $query;

    // Constructor
    public function __construct($url) {
        $this->link = $url;
        if ($this->parseUrlIfValid($url)) {
            $this->query = mysql_query('SELECT url_short FROM urls WHERE url_link ="'.$this->link.'"');
            $this->checkUrl();
        }
    else {
    }
    }    

    function parseUrlIfValid($url)
    {
        $arUrl = parse_url($url);
        $ret = null;

        if (!array_key_exists("scheme", $arUrl)
                || !in_array($arUrl["scheme"], array("http", "https")))
            $arUrl["scheme"] = "http";

        if (array_key_exists("host", $arUrl) &&
                !empty($arUrl["host"]))
            $ret = sprintf("%s://%s%s", $arUrl["scheme"],
                            $arUrl["host"], $arUrl["path"]);

        else if (preg_match("/^\w+\.[\w\.]+(\/.*)?$/", $arUrl["path"]))
            $ret = sprintf("%s://%s", $arUrl["scheme"], $arUrl["path"]);

        if ($ret && empty($ret["query"]))
            $ret .= sprintf("?%s", $arUrl["query"]);

        return $ret;
    }
    
    function checkUrl() {
        if(mysql_num_rows($this->query) == 0)
            {
            $this->newRecord();
            }
        else
            {
            $path = $this->checkSqlRec();
            $this->redirectNewLink($path);
            }

    }
    
    function checkSqlRec() {
        $sql_url = mysql_fetch_assoc($this->query);
        return ($sql_url['url_short']);
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
    
    }
?>