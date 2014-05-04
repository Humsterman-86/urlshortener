<?php

include('config.php');

//redirect to real link if URL is set
if (!empty($_REQUEST['url'])) {
	$redirect = mysql_fetch_assoc(mysql_query("SELECT url_link FROM urls WHERE url_short = '".addslashes($_GET['url'])."'"));
	$redirect = "http://".str_replace("http://","",$redirect[url_link]);
	header('HTTP/1.1 301 Moved Permanently');  
	header("Location: ".$redirect);  
}

//insert new url
if ($_POST['url']) {
    $short = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);
    $query = mysql_query('SELECT url_short FROM urls WHERE url_link ="'.$_POST['url'].'"');
     
    if($query == FALSE)
            {
		mysql_query("INSERT INTO urls (url_link, url_short, url_ip, url_date) VALUES
			(
				'".addslashes($_POST['url'])."',
				'".$short."',
				'".$_SERVER['REMOTE_ADDR']."',
				'".time()."'
			)
		");
	    $redirect = "?s=$short";
	    header('Location: '.$redirect); die;

            $banavtorip = 0;
            }
    else
            {
            $sql_url = mysql_fetch_assoc($query);
            $short_url = $sql_url['url_short'];
	    $redirect = "?s=$short_url";
	    header('Location: '.$redirect); die;

            }

}
 require('template/template.php'); 
?>
