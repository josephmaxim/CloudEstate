<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond
//  File name   : login.php

$title = "Cloud Estate | Login";

include('header.php');

$email = NULL;
$pass = NULL;
$error = array();

if (isset($_POST['submit']))
{
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if(isset($email) && $email !== "")
    {
        $email = trim($email);
    }
    else
    {
        array_push($error, "Please enter an e-mail address!");
    }

    if(isset($pass) && $pass !== "")
    {
        $pass = trim($pass);
    }
    else
    {
        array_push($error, "Please enter a password!");
    }

    if (empty($error))
    {
        $qry = "SELECT email, pass FROM users WHERE email='$email' AND pass='$pass'";

        $result = pg_query(db_connect(), $qry);
        $records = pg_num_rows($result);

        if ($records === 0)
        {
            array_push($error, "Sorry, the E-mail/Password combination does not exist in our database! Please try again!");
        }
        else
        {
            $update_time_qry = "UPDATE users SET last_access='". getDateTime() ."' WHERE email='$email'";
            pg_query(db_connect(), $update_time_qry);
        }
    }

}

?>
    <div class="sector-login">
        <div class="sector-overlay">
            <div class="container">
                <div class="col-lg-6 col-lg-offset-3" style="padding: 100px 0px;">
                    <div class="col-lg-10 col-lg-offset-1">
                        <h3 class="text-center">Member Login</h3>
                        <br/>
                        <form class="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php echo $email; ?>" placeholder="Email" name="email">
                            </div>
                            <div class="input-group">
                                <input type="password" class="form-control" value="<?php echo $pass; ?>" placeholder="Password" name="password">
                            </div>
                            <div class="login-form">
                                <input type="submit" class="btn pull-right" value="Login">
                            </div>
                        </form>
                        <br/>
                        <br/>
                        <br/>
                        <p class="text-center" style="color: #ffffff;">
                            Don't have an account? <a href="register.php">Signup here!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('footer.php');
?>