<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : user-password.php

// Page title
$title = "Cloud Estate | Change password";

// Include header
include_once('header.php');

// Check if there's an existing user session
if(SessionCheck() == false) {
    header("Location: index.php");
}

$currentPass = '';
$newPass = '';
$confirmPass = '';
$errors = array();
$successMessage = false;

if(isset($_POST['submit'])){

    // Validation for confirm password
    if(isset($_POST['current_pass']) && $_POST['current_pass'] != ""){
        // sanitize input
        $currentPass = $_POST['current_pass'];
        if(encryptPassword(sanitizeInput($currentPass)) != $_SESSION['userData']['password']){
            array_push($errors, "- Current password wrong! please try again.");
        }
    }else{
        array_push($errors, "- Please enter your current password!");
    }

    // Validation for new password
    if(isset($_POST['new_pass']) && $_POST['new_pass'] != ""){
        // check length of input
        if(CheckInputLength($_POST['new_pass'], 8, 32)){
            // sanitize input
            $newPass = sanitizeInput($_POST['new_pass']);
        }else{
            array_push($errors, "- Password must be between 8 - 32 characters long.");
        }
    }else{
        array_push($errors, "- Please enter a new password!");
    }

    // Validation for confirm password
    if(isset($_POST['confirm_pass']) && $_POST['confirm_pass'] != ""){
        // sanitize input
        $confirmPass = sanitizeInput($_POST['confirm_pass']);
    }else{
        array_push($errors, "- Please confirm your new password!");
    }

    if(empty($errors)){

        if($newPass == $confirmPass){
            if(changePassword($newPass) == true){
                $successMessage = true;
            }else{
                array_push($errors, "- There was a problem changing your password. please contact administration.");
            }
        }else{
            array_push($errors, "- Your new passwords must match! please try again.");
        }

    }

}

?>

    <div class="content">
        <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <ul class="nav nav-sidebar">
                            <li><a href="user-update.php">Edit Profile</a></li>
                            <li><a href="user-password.php">Change Password</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-10 content-left">
                        <h1>Change password</h1>
                        <p></p>
                        <hr/>
                        <div class="col-lg-6 col-lg-offset-3">
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
                            if($successMessage == true){
                                ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p>You have successfully changed your password!</p>
                                </div>
                                <?php
                            }
                            ?>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                                <div class="form-group">
                                    <label for="current_pass">Current Password:</label>
                                    <input type="password" class="form-control" id="current_pass" name="current_pass" value="">
                                </div>
                                <div class="form-group">
                                    <label for="new_pass">New Password:</label>
                                    <input type="password" class="form-control" id="new_pass" name="new_pass" value="<?php echo $newPass; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_pass">Confirm New Password:</label>
                                    <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" value="<?php echo $confirmPass; ?>">
                                </div>
                                <input class="btn btn-success" type="submit" name="submit" value="Change Password">
                                <br/>
                                <br/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>