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
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow: auto;">
                        <div class="col-lg-6 panel-title listing-display-title"><?php echo $listingData['headline']?></div><div class="text-right col-lg-6">Views: <span class="label label-info"><?php echo $listingData['listing_views'];?></span> </div>
                    </div>
                    <div class="panel-body listing-display-body">
                        <div class="col-lg-5">
                            <?php
                            if ($listingData['images'] == 0) {
                                echo '<img width="100%" src="img/noimage.jpg"/>';
                            } else {
                                echo '<img width="400px" height="400px" src="' . $listingDirPath . $listingID . '_' . $listingData['images'] . '.jpg"/>';
                            }
                            ?>
                            <hr/>
                            <?php
                            if (file_exists($listingDirPath)) {
                                $files = array_diff(scandir($listingDirPath), array('.', '..'));
                                foreach ($files as $file) {
                                    echo ' <img width="100px" height="100px" src="' . $listingDirPath . $file . '"/>';
                                }
                            } else {
                                echo '<p class="text-center">No images uploaded by the agent.</p>';
                            }
                            ?>
                        </div>
                        <div class="col-lg-7">
                            <table class="table profile-info">
                                <tbody>
                                <tr>
                                    <td><strong>Description: </strong></td>
                                    <td><?php echo $listingData['description'];?></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table profile-info">
                                        <tbody>
                                            <tr>
                                                <td><strong>Price:</strong></td>
                                                <td><span class="text-success"><?php echo asDollars($listingData['price']);?></span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Agent:</strong></td>
                                                <td><?php echo GetUserProfileInfo($listingData['user_id'])['salutation']." ".GetUserProfileInfo($listingData['user_id'])['first_name']." " .GetUserProfileInfo($listingData['user_id'])['last_name'] ;?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Story: </strong></td>
                                                <td><?php echo get_property("storey",$listingData['storey']);?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Listing Type: </strong></td>
                                                <td><?php echo get_property("listing_type",$listingData['listing_type']);?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table class="table profile-info">
                                        <tbody>
                                            <tr>
                                                <td><strong>Status: </strong></td>
                                                <td><?php echo get_property("status",$listingData['status']);?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Posted: </strong></td>
                                                <td><?php echo $listingData['listed_date'];?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Bedrooms: </strong></td>
                                                <td><?php echo get_property("bedrooms",$listingData['bedrooms']);?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Bathrooms: </strong></td>
                                                <td><?php echo get_property("bathrooms",$listingData['bathrooms']);?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Stars: </strong></td>
                                                <td>
                                                    <?php
                                                    for($count = 0; $count < $listingData['listing_stars']+1; $count++){
                                                        echo '<img width="20px" src="img/star.png">';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
}
// Include footer
include_once('footer.php');
?>