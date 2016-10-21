<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : login.php

$title = "Cloud Estate | Login";

include('header.php');

// Check if there's an existing user session
if(SessionCheck() == true)
{
    header("Location: index.php");
}

// Defining Variables
$user_id = '';
$pass = '';
$error = array();

// Check if user submits login form
if (isset($_POST['submit']))
{

    // initialize input variables
    $user_id = $_POST['user_id'];
    $pass = $_POST['password'];

    // Check id User id is empty
    if(!isset($user_id) || $user_id == '')
    {
        // add error message to error array
        array_push($error, "Please enter your user ID!");
    }
    else
    {
        // sanitize input
        $user_id = sanitizeInput($_POST['user_id']);
    }

    // Check if password field is empty
    if(!isset($pass) || $pass == '')
    {
        // add error message to error array
        array_push($error, "Please enter a password!");
    }
    else
    {
        // sanitize input
        $pass = sanitizeInput($_POST['password']) ;
    }

    // check if there is any errors
    if (empty($error))
    {
        // pass user input as parameters to the login function with user id and hashed password.
        if(UserLogin($user_id,$pass))
        {
            // check account type
            if($_SESSION['userData']['user_type'] == ADMIN)
            {
                header("Location: admin.php");
            }
            elseif($_SESSION['userData']['user_type'] == AGENT)
            {
                header("Location: dashboard.php");
            }
            elseif($_SESSION['userData']['user_type'] == PENDING_AGENT)
            {
                array_push($error, "Your account is still pending for activation.");
                session_destroy();
            }
            elseif($_SESSION['userData']['user_type'] == SUSPENDED_USER)
            {
                array_push($error, "Your account has been suspended. Please contact system administrator!");
                session_destroy();
            }
            elseif($_SESSION['userData']['user_type'] == CLIENT)
            {
                header("Location: welcome.php");
            }
        }
        else
        {
            // add error message to error array
            array_push($error, "User ID & password doesn't match!");
        }
    }

}

?>

    <section class="sector-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h3>What do I get from being a member?</h3>
                        <ul>
                            <li>Alex make a list of our sites features in here</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h3>Member Login</h3>

                        <?php

                        // Display existing errors
                        if(!empty($error))
                        {
                            echo '<div  class="alert alert-danger animated bounceIn" role="alert">';
                            foreach($error as $msg)
                            {
                                echo '&middot;  ' . $msg . '<br />';
                            }
                            echo '</div>';
                        }
                        ?>

                        <form class="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <div class="input-group">
                                <span class="input-group-addon" id="userID"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control" value="<?php echo $user_id; ?>" placeholder="User ID" name="user_id" aria-describedby="userID">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" id="pass"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" value="<?php echo $pass; ?>" placeholder="Password" name="password"aria-describedby="pass">
                            </div>

                            <div class="login-form">
                                <input type="submit" class="btn" name="submit" value="Login">
                            </div>
                        </form>
                        <br/>
                        <p class="" style="color: #333333;">
                            Don't have an account? <a href="register.php">Signup here!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include('footer.php');
?>