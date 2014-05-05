<?php

include('config.php');
require_once 'myurl.php';

$nurl = new myurl();
if (!empty($_GET['url'])) {
    $nurl->redirect($_GET['url']);
}

//var_dump($_REQUEST);
//insert new url
$postUrl = $_POST['url'];
if ($_POST['url']) {
    $short = $nurl->shortGeneration();

    $query = mysql_query('SELECT url_short FROM urls WHERE url_link ="'.$postUrl.'"');

    if(!$query)
            {
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
