<?php
include('connect.php');
connect();
include ('utils.php');

$userName = decrypt_cookie($_COOKIE['hackme']);

setcookie(hackme, "", time() - 3600);
mysql_query("UPDATE users SET extra='' WHERE username = '$userName'") or die(mysql_error());

header("Location: index.php");
?>
