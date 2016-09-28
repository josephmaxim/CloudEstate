<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond
//  File name   : welcome.php

$title = "Cloud Estate | Welcome";

include('header.php');

if(SessionCheck() == false){
    header("Location: index.php");
}

?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                edit this code for debugging only
                <ul>
                    <?php
                        foreach ($_SESSION['UserData'] as $key => $value){
                            echo "<li>". $key . ":" . $value ."</li>";
                        }

                    ?>
                </ul>
            </div>
        </div>
    </div>

<?php
include('footer.php');
?>