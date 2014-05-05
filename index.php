<?php

include('config.php');
require_once 'myurl.php';

$url = new myurl();
//redirect to real link if URL is set
if (!empty($_GET['url'])) {
    $url->redirect($_GET['url']);
}

var_dump($_REQUEST);
//insert new url
if ($_POST['url']) {
    $short = $url->shortGeneration();

    $query = mysql_query('SELECT url_short FROM urls WHERE url_link ="'.$_POST['url'].'"');
    if(!$query)
            {
            $newUrl = $url->insertNewUrl($_POST['url'], $short, $_SERVER['REMOTE_ADDR']);
            $url->redirectNewLink($newUrl);
            }
    else
            {
            $sql_url = mysql_fetch_assoc($query);
            $short_url = $sql_url['url_short'];
            $url->redirectNewLink($short_url);
            }
}
 require('template/template.php'); 
?>
