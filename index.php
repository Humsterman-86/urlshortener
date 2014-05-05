<?php

include('config.php');
require_once 'myurl.php';

$nurl = new myurl();
if (!empty($_GET['url'])) {
    $nurl->redirect($_GET['url']);
}

$postUrl = $_POST['url'];
if ($_POST['url']) {

    $query = mysql_query('SELECT url_short FROM urls WHERE url_link ="'.$postUrl.'"');

    if(mysql_num_rows($query) == 0)
            {
            $count = mysql_num_rows($query);
            $short = $nurl->shortGeneration();
            $nurl->insertNewUrl($postUrl, $short, $_SERVER['REMOTE_ADDR']);
            $nurl->redirectNewLink($short);
            }
    else
            {
            $sql_url = mysql_fetch_assoc($query);
            $short_url = $sql_url['url_short'];
            $nurl->redirectNewLink($short_url);
            }
}
 require('template/template.php'); 
?>
