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

// for disable button
if(isset($_POST['disable'])){
    if(DisableListing($listingID)){
        DisableUser($listingData['user_id']);
        header("Location: admin.php");
        setcookie("disable_listing", "true");
    }
}
// for save favourites button
if(isset($_POST['save'])){
    SaveListingToFavourites($_SESSION['userData']['userID'],$listingID);
}
// for remove favourites button
if(isset($_POST['remove'])){
    RemoveListingToFavourites($_SESSION['userData']['userID'],$listingID);
}

// for reporting listing button
if(isset($_POST['report'])){
    ReportListing($_SESSION['userData']['userID'],$listingID);
}

// hide listing if its disabled
if($listingData['status'] == CLOSED) {

    ?>

    <div class="content">
        <div class="container">
            <h1 class="text-warning">The Listing your are trying to see has been disabled or closed!</h1>
        </div>
    </div>

    <?php
}else{
    ?>
        <div class="content">
            <div class="container">
                <h1 class="text-center">Listing <?php echo $listingID; ?></h1>
                <form class="text-right" action="<?php echo $_SERVER['PHP_SELF'] . "?listing_id=$listingID" ?>"
                      method="post">
                    <?php
                if (SessionCheck() == true) {
                    // Check user account type
                    if ($_SESSION['userData']['user_type'] == ADMIN) {
                        ?>
                            <input class="btn btn-danger btn-sm" type="submit" value="Disable Listing" name="disable">
                            <?php
                    } elseif ($_SESSION['userData']['user_type'] == CLIENT) {
                        if(CheckUserFavourite($listingID,$_SESSION['userData']['userID'])){
                            echo '<input class="btn btn-info btn-sm" type="submit" value="Remove from favourites" name="remove">';
                        }else{
                            echo '<input class="btn btn-success btn-sm" type="submit" value="Save to favourites" name="save">';
                        }

                        if(CheckIfUserReported($_SESSION['userData']['userID'],$listingID)){
                            echo '<span class="text-danger"> You have reported this listing.</span>';
                        }else{
                            echo '<input class="btn btn-warning btn-sm" type="submit" value="Report Listing as Offensive" name="report">';
                        }
                    } elseif ($_SESSION['userData']['user_type'] == AGENT) {
                        if ($_SESSION['userData']['userID'] == $listingData['user_id']) {
                            ?>
                                <input class="btn btn-success btn-sm" type="submit" value="Edit Listing" name="edit">
                                <?php
                        }
                    }
                } else {
                    echo '<p><a href="login.php">Login</a> or <a href="register.php">register</a> to save this listing as your favourite.</p>';
                }
                ?>
                </form>
                <hr/>
                <h3>Main set image</h3>
                <?php
            if ($listingData['images'] == 0) {
                echo '<img width="400px" height="400px" src="img/noimagefound.jpg"/>';
            } else {
                echo '<img width="400px" height="400px" src="' . $listingDirPath . $listingID . '_' . $listingData['images'] . '.jpg"/>';
            }
            ?>
                <hr/>
                <h3>All Images</h3>
                <?php
            if (file_exists($listingDirPath)) {
                $files = array_diff(scandir($listingDirPath), array('.', '..'));
                foreach ($files as $file) {
                    echo ' <img width="100px" height="100px" src="' . $listingDirPath . $file . '"/>';
                }
            } else {
                echo '<strong>No images upload</strong>';
            }
            ?>
                <hr/>
                <h3>All listing info</h3>
                <?php
            $userData = GetUserProfileInfo($_SESSION['userData']['userID']);
            // Display User info (Not final, just to show that it works)
            foreach ($listingData as $key => $value) {
                echo "<li><strong>" . $key . " :</strong> <i>" . $value . "</i></li>";
            }
            ?>
            </div>
        </div>

    <?php
}
// Include footer
include_once('footer.php');
?>