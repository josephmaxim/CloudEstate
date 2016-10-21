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

?>

    <section class="sector-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <h2>Edit Profile</h2>
                    <br/>
                    <form class="register-form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

                        <div class="input-group">
                            <span class="input-group-addon" id="userID"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" disabled value="<?php ?>" placeholder="User ID" name="user_id" aria-describedby="userID">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon" id="email"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" class="form-control" value="<?php ?>" placeholder="Email" name="email" aria-describedby="email">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon" id="salutation"><span class="glyphicon glyphicon-briefcase"></span></span>
                            <input type="text" class="form-control" value="<?php ?>" placeholder="Salutation" name="salutation" aria-describedby="salutation">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon" id="fname"><span class="glyphicon glyphicon-envelope"></span></span>
                                    <input type="email" class="form-control" value="<?php ?>" placeholder="First Name" name="fname" aria-describedby="fname">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon" id="lname"><span class="glyphicon glyphicon-envelope"></span></span>
                                    <input type="email" class="form-control" value="<?php ?>" placeholder="Last Name" name="lname" aria-describedby="lname">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->

                        <div class="input-group">
                            <span class="input-group-addon" id="address1"><span class="glyphicon glyphicon-globe"></span></span>
                            <input type="text" class="form-control" value="<?php ?>" placeholder="Address 1" name="address1" aria-describedby="address1">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon" id="address2"><span class="glyphicon glyphicon-globe"></span></span>
                            <input type="text" class="form-control" value="<?php ?>" placeholder="Address 2" name="salutation" aria-describedby="address2">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon" id="city"><span class="glyphicon glyphicon-globe"></span></span>
                                    <input type="text" class="form-control" value="<?php ?>" placeholder="City" name="city" aria-describedby="city">
                                </div>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon" id="province"><span class="glyphicon glyphicon-globe"></span></span>
                                    <input type="text" class="form-control" value="<?php ?>" placeholder="Province" name="province" aria-describedby="province">
                                </div>
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->

                        <div class="input-group">
                            <span class="input-group-addon" id="postal"><span class="glyphicon glyphicon-globe"></span></span>
                            <input type="text" class="form-control" value="<?php ?>" placeholder="Postal" name="postal" aria-describedby="postal">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon" id="pphone"><span class="glyphicon glyphicon-earphone"></span></span>
                                    <input type="text" class="form-control" value="<?php ?>" placeholder="Primary Phone" name="pphone" aria-describedby="pphone">
                                </div>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon" id="secphone"><span class="glyphicon glyphicon-phone-alt"></span></span>
                                    <input type="text" class="form-control" value="<?php ?>" placeholder="Secondary Phone" name="secphone" aria-describedby="secphone">
                                </div>
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->

                        <div class="input-group">
                            <span class="input-group-addon" id="faxnum"><span class="glyphicon glyphicon-print"></span></span>
                            <input type="text" class="form-control" value="<?php ?>" placeholder="Fax Number" name="faxnum" aria-describedby="faxnum">
                        </div>

                        <div class="form-group">
                            <select class="form-control mySelect"  name="type" id="type">
                                <option value="0" disabled selected>
                                    Preferred contact method
                                </option>
                                <option value="e">
                                    Email
                                </option>
                                <option  value="p">
                                    Phone
                                </option>
                                <option value="l">
                                    Posted Mail
                                </option>
                            </select>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon" id="pass"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" class="form-control" value="<?php ?>" placeholder="New password" name="pass1" aria-describedby="pass">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon" id="re_pass"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" class="form-control" value="<?php ?>" placeholder="Confirm new password" name="pass2" aria-describedby="re_pass">
                        </div>

                        <div class="login-form">
                            <input type="submit" class="btn" name="submit" value="Save Changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


<?php
include('footer.php');
?>