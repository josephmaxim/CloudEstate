<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond
//  File name   : register.php

$title = "Cloud Estate | Register";

include('header.php');

?>

    <div class="sector-register">
        <div class="sector-overlay">
            <div class="container">
                <div class="col-lg-6 col-lg-offset-3" style="padding: 100px 0px;">
                    <div class="col-lg-10 col-lg-offset-1">
                        <h3 class="text-center">Register</h3>
                        <br/>
                        <form class="login-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email" name="email">
                            </div>
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="password">
                            </div>
                            <div class="login-form">
                                <input type="submit" class="btn pull-right" value="Register">
                            </div>
                        </form>
                        <br/>
                        <br/>
                        <br/>
                        <p class="text-center" style="color: #ffffff;">
                            Already have an account? <a href="login.php">Login here!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('footer.php');
?>