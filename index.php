<?php

include('config.php');
require_once 'myurl.php';

$nurl = new myurl();
$postUrl = $_POST['url'];
$getUrl = $_GET['url'];

if (!empty($getUrl)) {
    $nurl->redirect($getUrl);
    $nurl->addHint($getUrl);
}

if ($_POST['url']) {

    $query = mysql_query('SELECT url_short FROM urls WHERE url_link ="'.$postUrl.'"');

    if(mysql_num_rows($query) == 0)
            {
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
