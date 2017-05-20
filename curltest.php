<?php

// RSS feed to try
$url = "http://myanimelist.net/rss.php?type=rw&u=saka";

echo "testing for GD (image functions)... ";
if( function_exists('gd_info') ) {
$gdinfo = gd_info();
if($gdinfo['FreeType Support']) {
$gd = true;
echo '<strong style="color:green">works! version: '.preg_replace('/[^d.]/','',$gdinfo['GD Version']).'</strong><br />';
} else '<strong style="color:#f90">installed, but no freetype support so bitmap fonts only</strong><br />';
} else echo '<strong style="color:red">failed</strong><br />';

echo "testing url fopen... ";
$buffer = @file_get_contents($url);
if ( strstr($buffer, '<?xml version="1.0"') ) {
$downloads = true;
echo '<strong style="color:green">works!</strong><br />';
} else echo '<strong style="color:red">failed</strong><br />';

echo "testing cURL... ";
$buffer = @download($url);
if ( strstr($buffer, '<?xml version="1.0"') ) {
$downloads = true;
echo '<strong style="color:green">works!</strong><br />';
} else echo '<strong style="color:red">failed</strong><br />';

echo '<br /><strong>verdict:</strong> ' . (($gd && $downloads)? "This host will work great!" : "Sorry, this host won't work.");


// download() downloads the content at $url and returns the raw string, not including the http header
function download($url) {
if(function_exists('curl_init')) {
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_HEADER,false);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$results = curl_exec($ch); // download!
curl_close($ch);
}
return $results;
}

?>