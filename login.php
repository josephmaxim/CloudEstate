<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : login.php

$title = "Cloud Estate | Login";

include('header.php');

if(SessionCheck() == true)
{
    header("Location: index.php");
}

$email = '';
$pass = '';
$error = array();

if (isset($_POST['submit']))
{
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if(!isset($email) || $email == '') 
	{
        array_push($error, "Please enter an email address!");
    }
	else
	{
        $email = Clean_Input($_POST['email']);
    }

    if(!isset($pass) || $pass == '') 
	{
        array_push($error, "Please enter a password!");
    }
	else
	{
        $pass = Clean_Input($_POST['password']);
    }

    if (empty($error))
	{
        if(UserLogin($email,$pass))
		{
            header("Location: welcome.php");
        }
		else
		{
            array_push($error, "Email & password doesn't match!");
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
                        <?php
                        if(!empty($error))
						{
							echo "<fieldset style='border: 1px solid red; color: red;'><legend>Error:</legend><ul>";
                                foreach($error as $msg)
								{
									echo "<li>$msg</li>";
                                }
                                echo "</ul></fieldset><br />";
                        }
                        ?>
                        <form class="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php echo $email; ?>" placeholder="Email" name="email">
                            </div>
                            <div class="input-group">
                                <input type="password" class="form-control" value="<?php echo $pass; ?>" placeholder="Password" name="password">
                            </div>
                            <div class="login-form">
                                <input type="submit" class="btn pull-right" name="submit" value="Login">
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