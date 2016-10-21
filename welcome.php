<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : welcome.php

$title = "Cloud Estate | Welcome";

include('header.php');

// Check is there is no existing session
if(SessionCheck() == false){
    header("Location: index.php");
}

?>

    <section class="sector-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div  class="alert alert-info animated bounceIn" role="alert">
                        <h4 class="text-center">User Info:</h4>
                        <br/>
                        <ul>
                            <?php
                            $userProfile = getUserProfile($_SESSION['userData']['userID']);

                            // Display User info (Not final, just to show that it works)
                            foreach ($userProfile as $key => $value){
                                echo "<li><strong>". $key . " :</strong> <i>" . $value ."</i></li>";
                            }
                            ?>
                        </ul>
                        <p>Formatted Primary Phone #: <?php echo display_phone_number($userProfile['primary_phone_number']);?></p>
                    </div>
                    <div class="text-center">
                        <a href="edit_profile.php">Click here to edit your profile!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
include('footer.php');
?>