<?php
$url = "https://rickhanson.com/feed/"; 
$cachename = str_replace([':', 'https', 'http'], '', $url);
$cachename = str_replace(['.', '/'], '_', $cachename);
$cachename = trim($cachename, '_');
$cachename = __DIR__.'/cache/'.$cachename.'.html';
if(file_exists($cachename)                              // there is a cache file
    && date("G") == date("G", filemtime($cachename))    // the file is less than 1 hour old
    && !isset($_GET['refresh'])                         // the user didn't request a refresh
    )
{
    $cache = file_get_contents($cachename);
    $cache_dt = filemtime($cachename);
} else {
    require_once "rsslib/rsslib.php";
    $cache = RSS_Display($url, 'Meditation + Talk', 15, false, true);
    file_put_contents($cachename, $cache);
    header('Location: ?');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Rick Hanson RSS</title>
</head>
<link type="text/css" href="rss-style.css" rel="stylesheet">

<body bgcolor="#FFFFFF">
<h1>Rick Hanson RSS Feed</h1>
<hr>
<?php echo "RSS feed cached at ".date('c', $cache_dt)."."; ?> <a href="?refresh=1">Refresh Now</a>
<br>
<fieldset class="rsslib">
    <?php echo $cache; ?>
</fieldset>

</body>
</html>