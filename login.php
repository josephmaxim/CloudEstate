<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : login.php

// Page title
$title = "Cloud Estate | Login";

// Include header
include_once('header.php');

// Check if there's an existing user session
if(SessionCheck() == true) {
    header("Location: welcome.php");
}

// Define variables
$userID = '';
$password = '';
$errors = array();

// Login button script
if(isset($_POST['submit'])){

    // Validation for User ID
    if(isset($_POST['userID']) && $_POST['userID'] != ""){
        $userID = $_POST['userID'];
    }else{
        array_push($errors, "- Please enter your User ID!");
    }

    // Validation for Password
    if(isset($_POST['password']) && $_POST['password'] != ""){
        $password = $_POST['password'];
    }else{
        array_push($errors, "- Please enter your password!");
    }

    // Check if errors exist
    if(empty($errors)){
        if(userLogin($userID,$password)){
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
                array_push($errors, "- Your account is still pending for activation.");
                session_destroy();
            }
            elseif($_SESSION['userData']['user_type'] == SUSPENDED_USER)
            {
                array_push($errors, "- Your account has been suspended. Please contact system administrator!");
                session_destroy();
                setcookie("disableMSG", "Your account has been suspended. Please contact system administrator!");
                header( "Refresh:2; url=aup.php", true, 303);
            }
            elseif($_SESSION['userData']['user_type'] == CLIENT)
            {
                header("Location: welcome.php");
            }
        }else{
            array_push($errors,"- The User ID and Password you provided did not match, Please try again!");
        }
    }
}
?>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>What you get from being a member</h3>
                    <ul>
                        <li>Alex make a list of our sites features in here</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h3>Member Login</h3>
                    <?php
                    if(!empty($errors)){
                        ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Error(s):</strong><br/>
                        <?php
                        foreach ($errors as $error){
                            echo "<span>$error</span><br/>";
                        }
                        ?>
                        </div>
                        <?php
                    }
                    ?>
                    <form class="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="input-group">
                            <span class="input-group-addon" id="userID"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" value="<?php echo $userID;?>" placeholder="User ID" name="userID" aria-describedby="userID">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon" id="pass"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" class="form-control" value="<?php echo $password;?>" placeholder="Password" name="password" aria-describedby="pass">
                        </div>

                        <div class="login-form">
                            <input type="submit" class="btn" name="submit" value="Login">
                        </div>
                    </form>
                    <br/>
                    <p class="" style="color: #333333;">
                        Don't have an account? <a href="register.php">Signup here!</a>
                        <br/>
                        Forgot your password? <a href="password-request.php">Reset it here!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>