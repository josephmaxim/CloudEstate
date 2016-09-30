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

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <br/>
                <h4 class="text-center">User Info:</h4>
                <br/>
                <ul>
                    <?php
                        // Display User info (Not final, just to show that it works)
                        foreach ($_SESSION['UserData'] as $key => $value){
                            echo "<li><strong>". $key . " :</strong> <i>" . $value ."</i></li>";
                        }

                    ?>
                </ul>
                <br/>
                <br/>
            </div>
        </div>
    </div>

<?php
include('footer.php');
?>