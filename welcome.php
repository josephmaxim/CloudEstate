<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : welcome.php

// Page title
$title = "Cloud Estate | Welcome";

// Include header
include_once('header.php');

// Check if there's an existing user session
if(SessionCheck() == false) {
    header("Location: index.php");
}
?>

    <div class="content">
        <div class="container">
            <h1 class="text-center">Welcome! - User profile</h1>
            <p>Welcome <strong><?php echo $_SESSION['userData']['userID']?></strong>, the last time you accessed the site was on <span class="text-success"><?php echo $_SESSION['userData']['last_access']?></span></p>
            <?php
            $userData = GetUserProfileInfo($_SESSION['userData']['userID']);
            // Display User info (Not final, just to show that it works)
            foreach ($userData as $key => $value){
                echo "<li><strong>". $key . " :</strong> <i>" . $value ."</i></li>";
            }
            ?>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>