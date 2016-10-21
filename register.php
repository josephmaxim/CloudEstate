<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : register.php

$title = "Cloud Estate | Register";

include('header.php');

// Defining Variables
$user_id = '';
$password = '';
$rePass = '';
$email = '';
$accountType = '';
$error = array();
$registered = false;

if(isset($_POST['submit'])){

    // initialize input variables
    $user_id = $_POST['user_id'];
    $password = $_POST['pass1'];
    $rePass = $_POST['pass2'];
    $email = $_POST['email'];

    //check option
    if(!isset($_POST['type']) || $_POST['type'] == '')
    {
        // add error message to error array
        array_push($error, "You forgot to choose an account type!");
    }
    else
    {
        $accountType = $_POST['type'];
    }

    if(!isset($user_id) || $user_id == '')
    {
        // add error message to error array
        array_push($error, "Please enter a user ID!");
    }
    else
    {
        // check if user id exist
        if(is_user_id($user_id)){
            array_push($error, "User ID already taken!");
        }else{
            // check length of input
            if(CheckInputLength($user_id, 3, 20)){
                // sanitize input
                $user_id = sanitizeInput($_POST['user_id']);
            }else{
                array_push($error, "User ID must be between 3 - 20 characters long.");
            }
        }
    }

    if(!isset($email) || $email == '')
    {
        // add error message to error array
        array_push($error, "Please enter an email address!");
    }
    else
    {

        // sanitize input
        $email = sanitizeInput($_POST['email']);
    }

    if(!isset($password) || $password == '')
    {
        // add error message to error array
        array_push($error, "Please enter a password");
    }
    else
    {
        // check length of input
        if(CheckInputLength($password, 8, 32)){
            // sanitize input
            $password = sanitizeInput($_POST['pass1']);
        }else{
            array_push($error, "Password must be between 8 - 32 characters long.");
        }
    }

    if(!isset($rePass) || $rePass == '')
    {
        // add error message to error array
        array_push($error, "Please confirm your password!");
    }
    else
    {
        // sanitize input
        $rePass = sanitizeInput($_POST['pass2']);
    }

    // check if there is any errors
    if (empty($error))
    {

        if($password != $rePass)
        {
            array_push($error, "The passwords you entered doesn't match!");
        }
        else
        {
            // prepare user input
            $userData = array(
                'user_id' => $user_id,
                'email' => $email,
                'accountType' => $accountType,
                'password' => $password
            );

            // pass user input as parameters to the login function with user id and hashed password.
            if(InsertUser($userData))
            {
                $registered = true;
            }
            else
            {
                // add error message to error array
                array_push($error, "There was an error while creating your account. Please contact the web administrator!");
            }
        }

    }

}

?>

    <section class="sector-signup">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php

                        if($registered){
                        ?>
                        <div class="alert alert-success animated bounceIn" role="alert">
                            <h3>Registration Successful!</h3>
                            <p>You can now check your account status by <a href="login.php">logging in</a>.</p>
                        </div>
                        <?php
                        }
                        else
                        {
                        ?>
                            <h3>Sign Up</h3>

                            <?php

                            // Display existing errors
                            if(!empty($error))
                            {
                                echo '<div class="alert alert-danger animated bounceIn" role="alert">';
                                foreach($error as $msg)
                                {
                                    echo '&middot;  ' . $msg . '<br />';
                                }
                                echo '</div>';
                            }
                            ?>

                            <form class="register-form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

                                <div class="form-group">
                                    <select class="form-control mySelect"  name="type" id="type">
                                        <option <?php if($accountType == '0'){echo 'selected="selected"';} ?> value="0" disabled selected>
                                            Select an account type(Client/Agent)
                                        </option>
                                        <option <?php if($accountType == 'C'){echo 'selected="selected"';} ?> value="C">
                                            I am a client.
                                        </option>
                                        <option <?php if($accountType == 'A'){echo 'selected="selected"';} ?> value="A">
                                            I am an agent.
                                        </option>
                                    </select>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon" id="userID"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="text" class="form-control" value="<?php echo $user_id; ?>" placeholder="User ID" name="user_id" aria-describedby="userID">
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon" id="email"><span class="glyphicon glyphicon-envelope"></span></span>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email" name="email" aria-describedby="email">
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon" id="pass"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" name="pass1" aria-describedby="pass">
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon" id="re_pass"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" class="form-control" value="<?php echo $rePass; ?>" placeholder="Confirm Password" name="pass2" aria-describedby="re_pass">
                                </div>

                                <div class="login-form">
                                    <input type="submit" class="btn" name="submit" value="Register">
                                </div>
                            </form>
                            <br/>
                            <p class="" style="color: #333333;">
                                Already have an account? <a href="login.php">Login here!</a>
                            </p>
                        <?php
                        }
                        ?>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h3>What do I get from being a member?</h3>
                        <ul>
                            <li>Alex make a list of our sites features in here</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include('footer.php');
?>