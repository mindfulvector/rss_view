<?php
include "config.php";

// if there were no URLs defined, create a default
if(!defined('URLS')) {
    define('URLS', ["https://rickhanson.com/feed/"]);
    define('SEARCH', ['']);
}

// cache or retrieve the cache of each feed
$display_html = '';
$refreshed = false;

foreach(URLS as $idx => $url) {
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
        $refreshed = true;
    }

    $display_html .= 'RSS feed <a href="'.$url.'">'.$url.'</a> cached at <i>'.date('c', $cache_dt).'</i>.<br>'."\n";
    $display_html .= '<fieldset class="rsslib">'.$cache.'</fieldset>'."\n\n";
}

if($refreshed) {
    header('Location: ?');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>RSS_view</title>
</head>
<link type="text/css" href="rss-style.css" rel="stylesheet">

<body bgcolor="#FFFFFF">
<h1>RSS_view</h1>
<hr>
<a href="?refresh=1">Refresh Now</a>
<br>
<?php echo $display_html; ?>
</body>
</html>
