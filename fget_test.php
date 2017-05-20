<?PHP

$homepage = file_get_contents("https://graph.facebook.com/me");
echo $homepage;
?>