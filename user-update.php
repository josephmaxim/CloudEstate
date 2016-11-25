<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : user-update.php

$title = "Cloud Estate | Edit Profile";

include('header.php');

// Check is there is no existing session
if(SessionCheck() == false){
    header("Location: index.php");
}

// load user profile from database
$userData = GetUserProfileInfo($_SESSION['userData']['userID']);
$stickySessions['city'] = $userData['city'];
$stickySessions['province'] = $userData['province'];
$contact_method = array('Email' => EMAIL, "Phone" => PHONE, "Posted" => POSTED_MAIL);

$email = '';
$salutation = '';
$fname = '';
$lname ='';
$address1 ='';
$city ='';
$province ='';
$userInput = '';
$postal ='';
$pphone ='';
$secphone ='';
$faxnum ='';
$errors = array();
$changed = false;

if (isset($_POST['submit']))
{

    // Validation for email
    if(isset($_POST['email']) && $_POST['email'] != ""){
        // sanitize input
        $email = sanitizeInput($_POST['email']);
    }else{
        array_push($errors, "- Please enter an email!");
    }

    // Validation for salutation
    if(isset($_POST['salutation']) && $_POST['salutation'] != ""){
        // check length of input
        if(CheckInputLength($_POST['salutation'], 1, 10)){
            // sanitize input
            $salutation = sanitizeInput($_POST['salutation']);
        }else{
            array_push($errors, "- salutation must be between 1 - 10 characters long.");
        }
    }else{
        array_push($errors, "- Please enter a salutation!");
    }

    // Validation for first name
    if(isset($_POST['fname']) && $_POST['fname'] != ""){
        // check length of input
        if(CheckInputLength($_POST['fname'], 1, 25)){
            // sanitize input
            $fname = sanitizeInput($_POST['fname']);
        }else{
            array_push($errors, "- First Name must be between 1 - 25 characters long.");
        }
    }else{
        array_push($errors, "- Please enter your first name!");
    }

    // Validation for last name
    if(isset($_POST['lname']) && $_POST['lname'] != ""){
        // check length of input
        if(CheckInputLength($_POST['lname'], 1, 50)){
            // sanitize input
            $lname = sanitizeInput($_POST['lname']);
        }else{
            array_push($errors, "- Last Name must be between 1 - 50 characters long.");
        }
    }else{
        array_push($errors, "- Please enter your last name!");
    }

    // Validation for address 1
    if(isset($_POST['address1']) && $_POST['address1'] != ""){
        // check length of input
        if(CheckInputLength($_POST['address1'], 1, 75)){
            // sanitize input
            $address1 = sanitizeInput($_POST['address1']);
        }else{
            array_push($errors, "- Address 1 must be between 1 - 75 characters long.");
        }
    }else{
        array_push($errors, "- Please enter your Address 1!");
    }

    // Validation for address 2
    if(isset($_POST['address2']) && $_POST['address2'] != ""){
        // check length of input
        if(CheckInputLength($_POST['address2'], 1, 75)){
            // sanitize input
            $address2 = sanitizeInput($_POST['address2']);
        }else{
            array_push($errors, "- Address 2 must be between 1 - 75 characters long.");
        }
    }else{
        $address2 = '';
    }

    // Validation for city
    if(isset($_POST['city']) && $_POST['city'] != ""){
        $city = $_POST['city'];
        $stickySessions['city'] = $city;
    }else{
        array_push($errors, "- Please select a city!");
    }

    // Validation for province
    if(isset($_POST['province']) && $_POST['province'] != ""){
        $province = $_POST['province'];
        $stickySessions['province'] = $province;
    }else{
        array_push($errors, "- Please select a city!");
    }

    // Validation for postal
    if(isset($_POST['postal']) && $_POST['postal'] != ""){
        // check length of input
        if(CheckInputLength($_POST['postal'], 6, 6)){
            // sanitize input
            $postal = sanitizeInput($_POST['postal']);
        }else{
            array_push($errors, "- postal  must be 6 characters long.");
        }
    }else{
        array_push($errors, "- Please enter your postal code!");
    }

    // Validation for Phone 1
    if(isset($_POST['pphone']) && $_POST['pphone'] != ""){
        // check length of input
        if(CheckInputLength($_POST['pphone'], 10, 10)){
            // sanitize input
            $pphone = sanitizeInput($_POST['pphone']);
        }else{
            array_push($errors, "- Primary phone  must be 10 characters long.");
        }
    }else{
        array_push($errors, "- Please enter your Primary phone!");
    }

    // Validation for Phone 2
    if(isset($_POST['secphone']) && $_POST['secphone'] != ""){
        // check length of input
        if(CheckInputLength($_POST['secphone'], 10, 10)){
            // sanitize input
            $secphone = sanitizeInput($_POST['secphone']);
        }else{
            array_push($errors, "- Secondary phone  must be 10 characters long.");
        }
    }else{
        $secphone = '';
    }

    // Validation for fax
    if(isset($_POST['faxnum']) && $_POST['faxnum'] != ""){
        // check length of input
        if(CheckInputLength($_POST['faxnum'], 10, 10)){
            // sanitize input
            $faxnum = sanitizeInput($_POST['faxnum']);
        }else{
            array_push($errors, "- Fax number must be 10 characters long.");
        }
    }else{
        array_push($errors, "- Please enter your Fax number!");
    }

    // check if there is any errors
    if (empty($error))
    {
        // prepare input variables
        $userInput = array(
            'email_address' => $email,
            'user_type' => $_SESSION['userData']['user_type'],
            'salutation' => $salutation,
            'first_name' => $fname,
            'last_name' => $lname,
            'street_address_1' => $address1,
            'street_address_2' => $_POST['address2'],
            'city' => $city,
            'province' => $province,
            'postal_code' => $postal,
            'primary_phone_number' => $pphone,
            'secondary_phone_number' => $secphone,
            'fax_number' => $faxnum,
            'preferred_contact_method' =>  $_POST['type']
        );
        if(editUserProfile($_SESSION['userData']['userID'], $userInput)){
            $changed = true;
        }else{
            array_push($error,"There was an error while saving your changes.");
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
                    <h1>Edit Profile</h1>
                    <p></p>
                    <hr/>
                    <div class="col-lg-10 col-lg-offset-1">
                        <?php
                        if($changed)
                        {
                            ?>
                            <div  class="alert alert-success animated bounceIn">
                                <h1>Profile Successfully Changed</h1>
                                <a href="welcome.php">View Profile.</a>
                            </div>
                            <?php
                        }else{

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
                        <form class="register-form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

                            <div class="form-group">
                                <label for="userID">User ID:</label>
                                <input type="text" disabled class="form-control" id="userID" placeholder="User ID" value="<?php echo $userData['user_id'];?>" name="user_id">
                            </div>

                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $userData['email_address'];?>" name="email">
                            </div>

                            <div class="form-group">
                                <label for="salutation">Salutation:</label>
                                <input type="text" class="form-control" id="salutation" placeholder="Salutation" value="<?php echo $userData['salutation'];?>" name="salutation">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fname">First Name:</label>
                                        <input type="text" class="form-control" id="fname" placeholder="First Name" value="<?php echo $userData['first_name'];?>" name="fname">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="lname">Last Name:</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Last Name" value="<?php echo $userData['last_name'];?>" name="lname">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address1">Address 1:</label>
                                <input type="text" class="form-control" id="address1" placeholder="Address 1" value="<?php echo $userData['street_address_1'];?>" name="address1">
                            </div>

                            <div class="form-group">
                                <label for="address2">Address 2:</label>
                                <input type="text" class="form-control" id="address2" placeholder="Address 2" value="<?php echo $userData['street_address_2'];?>" name="address2">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <?php build_simple_dropdown("city",getAllCity());?>
                                </div>
                                <div class="col-lg-6">
                                    <?php build_simple_dropdown("province",getAllProvince());?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="postal">Postal:</label>
                                <input type="text" class="form-control" id="postal" placeholder="Postal" value="<?php echo $userData['postal_code'];?>" name="postal">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="pphone">Primary Phone:</label>
                                        <input type="text" class="form-control" id="pphone" placeholder="Primary Phone" value="<?php echo $userData['primary_phone_number'];?>" name="pphone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="secphone">Secondary Phone:</label>
                                        <input type="text" class="form-control" id="secphone" placeholder="Secondary Phone" value="<?php echo $userData['secondary_phone_number'];?>" name="secphone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="secphfaxnumone">Fax Number:</label>
                                <input type="text" class="form-control" id="faxnum" placeholder="Fax Number" value="<?php echo $userData['fax_number'];?>" name="faxnum">
                            </div>

                            <div class="form-group">
                                <label for="type">Preferred contact method:</label>
                                <select class="form-control mySelect"  name="type" id="type">
                                    <option <?php if($userData['preferred_contact_method'] == '0'){ echo 'selected="selected"';};?> value="0" disabled selected>
                                        Preferred contact method
                                    </option>
                                    <option <?php if($userData['preferred_contact_method'] == 'e'){ echo 'selected="selected"';};?> value="e">
                                        Email
                                    </option>
                                    <option <?php if($userData['preferred_contact_method'] == 'p'){ echo 'selected="selected"';};?>  value="p">
                                        Phone
                                    </option>
                                    <option <?php if($userData['preferred_contact_method'] == 'l'){ echo 'selected="selected"';};?> value="l">
                                        Posted Mail
                                    </option>
                                </select>
                            </div>

                            <div class="login-form text-center">
                                <input type="submit" class="btn btn-warning" name="submit" value="Save Changes">
                                <br/>
                                <br/>
                            </div>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include('footer.php');
?>