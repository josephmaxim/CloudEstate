<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : edit_profile.php

$title = "Cloud Estate | Edit Profile";

include('header.php');

// Check is there is no existing session
if(SessionCheck() == false){
    header("Location: index.php");
}

// load user profile from database
$userData = getUserProfile($_SESSION['userData']['userID']);

$userInput = array(
    'email_address' => '',
    'user_type' => '',
    'salutation' => '',
    'first_name' => '',
    'last_name' => '',
    'street_address_1' => '',
    'street_address_2' => '',
    'city' => '',
    'province' => '',
    'postal_code' => '',
    'primary_phone_number' => '',
    'secondary_phone_number' => '',
    'fax_number' => '',
    'preferred_contact_method' => ''
);
$error = array();
$changed = false;

if (isset($_POST['submit']))
{

    // initialize input variables
    $userInput = array(
        'email_address' => $_POST['email'],
        'user_type' => $_POST['type'],
        'salutation' => $_POST['salutation'],
        'first_name' => $_POST['fname'],
        'last_name' => $_POST['lname'],
        'street_address_1' => $_POST['address1'],
        'street_address_2' => $_POST['address2'],
        'city' => $_POST['city'],
        'province' => $_POST['province'],
        'postal_code' => $_POST['postal'],
        'primary_phone_number' => $_POST['pphone'],
        'secondary_phone_number' => $_POST['secphone'],
        'fax_number' => $_POST['faxnum'],
        'preferred_contact_method' =>  $_POST['type']
    );

    // check if there is any errors
    if (empty($error))
    {
        if(editUserProfile($_SESSION['userData']['userID'], $userInput)){
            $changed = true;
        }else{
            array_push($error,"There was an error while saving your changes.");
        }
    }

}

?>

    <section class="sector-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
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
                            ?>

                    <h2>Edit Profile</h2>
                    <br/>
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
                    <form class="register-form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

                        <div class="form-group">
                            <label for="userID">User ID:</label>
                            <input type="text" disabled class="form-control" id="userID" placeholder="User ID" value="<?php echo $userData['userID'];?>" name="user_id">
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
                                <div class="form-group">
                                    <label for="city">City:</label>
                                    <input type="text" class="form-control" id="city" placeholder="City" value="<?php echo $userData['city'];?>" name="city">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="province">Province:</label>
                                    <input type="text" class="form-control" id="province" placeholder="Province" value="<?php echo $userData['province'];?>" name="province">
                                </div>
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

<!--                        <div class="form-group">-->
<!--                            <label for="pass">Password:</label>-->
<!--                            <input type="password" class="form-control" id="pass" placeholder="Password"  name="pass">-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label for="re_pass">Confirm new password:</label>-->
<!--                            <input type="password" class="form-control" id="re_pass" placeholder="Confirm Password" name="re_pass">-->
<!--                        </div>-->

                        <div class="login-form text-center">
                            <input type="submit" class="btn" name="submit" value="Save Changes">
                        </div>
                    </form>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>


<?php
include('footer.php');
?>