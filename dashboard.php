<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : dashboard.php

// Page title
$title = "Cloud Estate | Dashboard";

// Include header
include_once('header.php');

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

    <div class="content">
        <div class="container text-center">
            <h1>Dashboard</h1>
            <p>Welcome Agent <strong><?php echo $_SESSION['userData']['userID']?></strong>, the last time you accessed the site was on <span class="text-success"><?php echo $_SESSION['userData']['last_access']?></span></p>
            <a href="listing-create.php">Create a listing.</a>
            <br/>
            <br/>
            <br/>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>