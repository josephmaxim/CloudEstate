<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : listing-display.php

// Page title
$title = "Cloud Estate | Welcome";

// Include header
include_once('header.php');

//check if there's a listing id that is set
if(isset($_GET['listing_id'])){
    $listingID = $_GET['listing_id'];
    if(listingIDExists($listingID)){
        $listingData = getListingData($listingID);
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
$listingDirPath = "img/listings/$listingID/";

// don't mind the design. well fix it soon. :)
?>

    <div class="content">
        <div class="container">
            <h1 class="text-center">Listing <?php echo $listingID;?></h1>
            <hr/>
            <h3>Main set image</h3>
            <?php
                if($listingData['images'] == 0){
                    echo '<strong>No set main image</strong>';
                }else{
                    echo '<img width="400px" height="400px" src="'.$listingDirPath.$listingID.'_'.$listingData['images'].'.jpg"/>';
                }
            ?>
            <hr/>
            <h3>All Images</h3>
            <?php
            if (file_exists($listingDirPath)){
                $files = array_diff(scandir($listingDirPath), array('.', '..'));
                foreach ($files as $file){
                    echo ' <img width="100px" height="100px" src="'.$listingDirPath.$file.'"/>';
                }
            }else{
                echo '<strong>No images upload</strong>';
            }
            ?>
            <hr/>
            <h3>All listing info</h3>
            <?php
            $userData = GetUserProfileInfo($_SESSION['userData']['userID']);
            // Display User info (Not final, just to show that it works)
            foreach ($listingData as $key => $value){
                echo "<li><strong>". $key . " :</strong> <i>" . $value ."</i></li>";
            }
            ?>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>