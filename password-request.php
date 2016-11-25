<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : password-request.php

// Page title
$title = "Cloud Estate | Password Request";

// Include header
include_once('header.php');

// redirect to welcome.php if session is check
if(SessionCheck() == true){
    header('Location: welcome.php');
}

$email = '';
$userID = '';
$errors = array();
$success = false;

if(isset($_POST['reset'])){

    // Validation for email
    if(isset($_POST['email']) && $_POST['email'] != ""){
        // sanitize input
        $email = sanitizeInput($_POST['email']);
    }else{
        array_push($errors, "- Please enter an email!");
    }

    // Validation for User ID
    if(isset($_POST['userID']) && $_POST['userID'] != ""){
        // sanitize input
        $userID = sanitizeInput($_POST['userID']);
    }else{
        array_push($errors, "- Please enter your User ID!");
    }

    if(empty($errors)){
        if(is_user_id($userID)){
            if(resetPassword($userID,$email) == true){
                $success = true;
            }else{
                array_push($errors, "- The email you entered is not associated with any account.");
            }
        }else{
            array_push($errors, "- User ID not found on the database.");
        }
    }

}
?>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <h3>Reset Password Request</h3>
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
                    if($success == true){
                        ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h2>Your password has been reset!</h2>
                            <p>Please check your email "<?php echo $email;?>" for your temporary password.</p>
                        </div>
                        <?php
                    }
                    ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="userID">User ID:</label>
                            <input type="text" class="form-control" id="userID" name="userID">
                        </div>
                        <input class="btn btn-warning" type="submit" value="Reset" name="reset">
                    </form>
                    <br/>
                    <p class="" style="color: #333333;">
                        Don't have an account? <a href="register.php">Signup here!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>