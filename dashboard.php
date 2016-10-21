<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : dashboard.php

$title = "Cloud Estate | Dashboard";

include('header.php');

// Check if there's an existing user session
if(SessionCheck() == true)
{
    // Check user account type
    if($_SESSION['userData']['user_type'] != AGENT){
        header("Location: welcome.php");
    }
}
else
{
    header("Location: index.php");
}

?>

    <section class="sector-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                        <div  class="alert alert-info animated bounceIn" role="alert">
                            <h2>Welcome Agent <?php echo $_SESSION['userData']['userID']?>!</h2>
                            <p>To check your account visit <a href="welcome.php">Profile page</a></p>
                        </div>
                </div>
            </div>
        </div>
    </section>

<?php
include('footer.php');
?>