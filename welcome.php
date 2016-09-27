<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond
//  File name   : welcome.php

$title = "Cloud Estate | Welcome";

include('header.php');

?>

    <div class="container">
        <?php

        echo $_SESSION['UserData']['email'];

        ?>
    </div>

<?php
include('footer.php');
?>