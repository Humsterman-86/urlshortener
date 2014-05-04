<!DOCTYPE html> 
<!--[if IE 9]>
<html class="lt-ie10" lang="en" > 
<![endif]--> 
<html class="no-js" lang="en" >
 <head> 
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>MyURL - Yoyr Personal URL Shortener</title>
    <link rel="stylesheet" href="template/css/foundation.css" />
    <script src="template/js/vendor/modernizr.js"></script>
</head> 
<body> 
<nav class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">MyURL</a></h1>
    </li>
  </ul>
</nav>
<div class="panel"> 
<form id="form1" name="form1" method="post" action="" data-abide>
        <label>URL</label>
  <input name="url" type="url" id="url" size="75" placeholder="http://www.example.com"/>
  <input type="submit" class="button [tiny small large]" name="Submit" value="Go" />
</form>
</div>

<?php if (!empty($_GET['s'])) { ?>
<div class="panel callout radius"> 
<h5>Here's the short URL:</h5> 
<p> <a href="<?php echo $server_name; ?><?php echo $_GET['s']; ?>" target="_blank"><?php echo $server_name; ?><?php echo $_GET['s']; ?></a>
</p> </div>
<?php } ?>


<script src="js/vendor/jquery.js"></script> 
<script src="js/foundation.min.js"></script> 
<script> $(document).foundation();
 </script> 
</body> 
</html>