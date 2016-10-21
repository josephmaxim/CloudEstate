<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : admin.php

$title = "Cloud Estate | AdminPanel";

include('header.php');

// Check if there's an existing user session
if(SessionCheck() == true)
{
    // Check user account type
    if($_SESSION['userData']['user_type'] != ADMIN){
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
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="alert alert-success animated bounceIn" role="alert">
                        <h2>Welcome admin <?php echo $_SESSION['userData']['userID']?></h2>
                        <p>Note: Admin page is still under development!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include('footer.php');
?>