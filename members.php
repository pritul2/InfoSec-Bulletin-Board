<?php
        // Connects to the Database
        include('connect.php');
        //include('error.php');
        include('enc_dec.php');
        connect();

        echo('in members.php');
        //if the login form is submitted
        if (isset($_POST['submit'])) {

                $_POST['username'] = trim($_POST['username']);
                if(!$_POST['username'] | !$_POST['password']) {
                        die('<p>You did not fill in a required field.
                        Please go back and try again!</p>');
                }

                $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $check = mysql_query("SELECT * FROM users WHERE username = '".$_POST['username']."'")or die(mysql_error());
                $pass_fetched = mysql_query("SELECT pass FROM users WHERE username = '".$_POST['username']."'")or die(mysql_error());
                $pass_row = mysql_fetch_row($pass_fetched);
                $check1 = password_verify($_POST['password'],$pass_row[0]);

                //Gives error if user already exist
                $check2 = mysql_num_rows($check);
                if ($check2 == 0 || $check1 == false) {
                        die("<p>Sorry, user name does not exisits.</p>");
                }
                else
                {
                        $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
                        $enc_user_name = encrypt_string($_POST['username'],$encryption_key);
                        $hour = time() + 3600;
                        setcookie(hackme, $enc_user_name, $hour,'/~txj220003; SameSite=strict');

                        header("Location: members.php");
                }
        }
                ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>hackme</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<?php
        include('header.php');
?>
<div class="post">
        <div class="post-bgtop">
                <div class="post-bgbtm">
        <h2 class = "title">hackme bulletin board</h2>
                <?php
            if(!isset($_COOKIE['hackme'])){
                                 die('Why are you not logged in?!');
                        }else
                        {
                                $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
                                $userName = decrypt_string($_COOKIE['hackme'],$encryption_key);
                                print("<p>Logged in as <a>$userName</a></p>");
                        }
                        ?>
        </div>
    </div>
</div>

<?php
        $threads = mysql_query("SELECT * FROM threads ORDER BY date DESC")or die(mysql_error());
        while($thisthread = mysql_fetch_array( $threads )){
?>
        <div class="post">
        <div class="post-bgtop">
        <div class="post-bgbtm">
                <h2 class="title"><a href="show.php?pid=<?php echo $thisthread['id'] ?>"><?php echo $thisthread['title']?></a></h2>
                                                        <p class="meta"><span class="date"> <?php echo date('l, d F, Y',$thisthread[date]) ?> - Posted by <a href="#"><?php echo $thisthread[username] ?> </a></p>

        </div>
        </div>
        </div>

<?php
}
        include('footer.php');
?>
</body>
</html>
