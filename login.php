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
        if(UserLogin($user_id,hashPassword($pass)))
		{
            header("Location: welcome.php");
        }
		else
		{
            // add error message to error array
            array_push($error, "User ID & password doesn't match!");
        }
    }

}

?>
    <div class="sector-login">
        <div class="sector-overlay">
            <div class="container">
                <div class="col-lg-6 col-lg-offset-3" style="padding: 100px 0px;">
                    <div class="col-lg-10 col-lg-offset-1">
                        <h3 class="text-center header-light">Member Login</h3>
                        <br/>
                        <?php

                        // Display existing errors
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
                                <input type="text" class="form-control" value="<?php echo $user_id; ?>" placeholder="User ID" name="user_id">
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