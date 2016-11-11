<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : admin.php

// Page title
$title = "Cloud Estate | Home";

// Include header
include_once('header.php');

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

    <div class="content">
        <div class="container">
            <h1 class="text-center">Admin Page!</h1>
            <p>Welcome administrator <strong><?php echo $_SESSION['userData']['userID']?></strong>, the last time you accessed the site was on <span class="text-success"><?php echo $_SESSION['userData']['last_access']?></span></p>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>