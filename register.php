<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : register.php

// Page title
$title = "Cloud Estate | Register";

// Include header
include_once('header.php');

// Check if there's an existing user session
if(SessionCheck() == true) {
    header("Location: welcome.php");
}

// Defining Variables
$userID = '';
$password = '';
$rePass = '';
$email = '';
$accountType = '';
$errors = array();
$registered = false;

if(isset($_POST['submit'])){

    // Validation for account type
    if(isset($_POST['type']) && $_POST['type'] != ""){
        $accountType = $_POST['type'];
    }else{
        array_push($errors, "- Please select an account type!");
    }

    // Validation for user id
    if(isset($_POST['userID']) && $_POST['userID'] != ""){

        // check if user id exist
        if(is_user_id($_POST['userID'])){
            array_push($errors, "- User ID already taken!");
        }else{
            // check length of input
            if(CheckInputLength($_POST['userID'], 3, 20)){
                // sanitize input
                $userID = sanitizeInput($_POST['userID']);
            }else{
                array_push($errors, "- User ID must be between 3 - 20 characters long.");
            }
        }
    }else{
        array_push($errors, "- Please enter a User ID!");
    }

    // Validation for email
    if(isset($_POST['email']) && $_POST['email'] != ""){
        // sanitize input
        $email = sanitizeInput($_POST['email']);
    }else{
        array_push($errors, "- Please enter an email!");
    }

    // Validation for password
    if(isset($_POST['pass1']) && $_POST['pass1'] != ""){
        // check length of input
        if(CheckInputLength($_POST['pass1'], 8, 32)){
            // sanitize input
            $password = sanitizeInput($_POST['pass1']);
        }else{
            array_push($errors, "- Password must be between 8 - 32 characters long.");
        }
    }else{
        array_push($errors, "- Please enter a password!");
    }

    // Validation for re-type password
    if(isset($_POST['pass2']) && $_POST['pass2'] != ""){
        // sanitize input
        $rePass = sanitizeInput($_POST['pass2']);
    }else{
        array_push($errors, "- Please re-enter your password!");
    }

    if(empty($errors)){

        if($password == $rePass){
            // prepare user input
            $userData = array(
                'userID' => $userID,
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
                array_push($error, "- There was an error while creating your account. Please contact the web administrator!");
            }
        }else{
            array_push($errors, "- The passwords you entered doesn't match. Please try again!");
        }

    }

}

?>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Sign Up</h3>
                    <?php

                    if($registered == false) {

                        if (!empty($errors)) {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <strong>Error(s):</strong><br/>
                                <?php
                                foreach ($errors as $errors) {
                                    echo "<span>$errors</span><br/>";
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        <form class="register-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <div class="form-group">
                                <select class="form-control mySelect" name="type" id="type">
                                    <option <?php if ($accountType == '0') {
                                        echo 'selected="selected"';
                                    } ?> value="0" disabled selected>
                                        Select an account type(Client/Agent)
                                    </option>
                                    <option <?php if ($accountType == 'C') {
                                        echo 'selected="selected"';
                                    } ?> value="C">
                                        I am a client.
                                    </option>
                                    <option <?php if ($accountType == 'A') {
                                        echo 'selected="selected"';
                                    } ?> value="A">
                                        I am an agent.
                                    </option>
                                </select>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon" id="userID"><span
                                        class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control" value="<?php echo $userID; ?>"
                                       placeholder="User ID" name="userID" aria-describedby="userID">
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon" id="email"><span
                                        class="glyphicon glyphicon-envelope"></span></span>
                                <input type="email" class="form-control" value="<?php echo $email; ?>"
                                       placeholder="Email" name="email" aria-describedby="email">
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon" id="pass"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" value="<?php echo $password; ?>"
                                       placeholder="Password" name="pass1" aria-describedby="pass">
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon" id="re_pass"><span
                                        class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" value="<?php echo $rePass; ?>"
                                       placeholder="Confirm Password" name="pass2" aria-describedby="re_pass">
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
                    }else{
                        ?>
                        <div class="alert alert-success" role="alert">
                            You have successfully registered. <a href="login.php">Click here</a> to login.
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-lg-6">
                    <h3>What you get from being a member</h3>
                    <ul>
                        <li>Alex make a list of our sites features in here</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>