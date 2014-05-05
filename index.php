<?php

include('config.php');
require_once 'myurl.php';

$getUrl = $_GET['url'];

if (!empty($getUrl)) {
    $redirect = new existingUrl($getUrl);
}

if ($_POST['url']) {
    $postUrl = $_POST['url'];
    $do = new newUrl($postUrl);
}
 require('template/template.php'); 
?>
