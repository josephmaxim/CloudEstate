<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : listing_matches.php

// Page title
$title = "Cloud Estate | Listing matches";


// Include header
include_once('header.php');

if(isset($_SESSION['searchIds'])){

}else{
    header("Location: listing-city.php");
}

$listings = $_SESSION['searchIds'];
$listingsCount = count($_SESSION['searchIds']);
$numberOfPages = ceil($listingsCount/MAX_RESULTS);

if(isset($_GET['pg']) && $_GET['pg'] > 0 && $_GET['pg'] < $numberOfPages + 1){
    $pageNumber = $_GET['pg'];
}else{
    $pageNumber = 1;
}

?>

    <div class="content">
        <div class="container">
            <h1 class="text-center">Listing Match results</h1>
            <nav aria-label="Page navigation" class="text-center">
                <ul class="pagination">
                    <li>
                        <a href="<?php $position = $pageNumber;$position -= 1;echo "listing-matches.php?pg=".$position;?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    for($count = 1; $count < $numberOfPages + 1; $count++){
                        $active = '';
                        if($pageNumber == $count){
                            $active = 'class="active"';
                        }
                        echo '<li '.$active.'><a href="listing-matches.php?pg='.$count.'">'. $count .'</a></li>';
                    }
                    ?>
                    <li>
                        <a href="<?php $position = $pageNumber;$position += 1;echo "listing-matches.php?pg=".$position;?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="row">
            <?php
                 for($count = $pageNumber*MAX_RESULTS-MAX_RESULTS; $count < $pageNumber*MAX_RESULTS;$count++){
                    if($count < $listingsCount){
                        // for disable button
                        if(isset($_POST['disable'.$listings[$count]])){
                            if(DisableListing($listings[$count])){
                                DisableUser(getListingData($listings[$count])['user_id']);
                                header("Location: admin.php");
                                setcookie("disable_listing", "true");
                            }
                        }
                        // for save favourites button
                        if(isset($_POST['save'.$listings[$count]])){
                            SaveListingToFavourites($_SESSION['userData']['userID'],$listings[$count]);
                        }
                        // for remove favourites button
                        if(isset($_POST['remove'.$listings[$count]])){
                            RemoveListingToFavourites($_SESSION['userData']['userID'],$listings[$count]);
                        }

                        // for reporting listing button
                        if(isset($_POST['report'.$listings[$count]])){
                            ReportListing($_SESSION['userData']['userID'],$listings[$count]);
                        }
                        $listingDirPath = "img/listings/".$listings[$count]."/";
                        echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
                        echo '<div class="col-sm-6 col-md-4">';
                        echo '    <div class="thumbnail">';
                        echo '        <img style="width: 100%;" src="img/noimage.jpg" alt="...">';
                        echo '        <div class="caption">';
                        echo '            <h3 style="font-weight: 400; height: 40px;">'.getListingData($listings[$count])['headline'].'</h3>';
                        echo '            <p class="text-success" style="height: 20px;">'.asDollars(getListingData($listings[$count])['price']).'</p>';
                        echo '            <p style="height: 100px;" class="text-justify">'.getListingData($listings[$count])['description'].'</p>';
                        echo '            <p class="text-center"><a href="listing-display.php?listing_id='.$listings[$count].'" class="btn btn-info btn-sm" role="button">Read more</a> ';
                        if (SessionCheck() == true) {
                            // Check user account type
                            if ($_SESSION['userData']['user_type'] == ADMIN) {
                                ?>
                                <input class="btn btn-danger btn-sm" type="submit" value="Disable Listing" name="disable<?php echo $listings[$count];?>">
                                <?php
                            } elseif ($_SESSION['userData']['user_type'] == CLIENT) {
                                if(CheckUserFavourite($listings[$count],$_SESSION['userData']['userID'])){
                                    echo '<input class="btn btn-info btn-sm" type="submit" value="Remove from favourites" name="remove'.$listings[$count].'"> ';
                                }else{
                                    echo '<input class="btn btn-success btn-sm" type="submit" value="Favourite" name="save'.$listings[$count].'"> ';
                                }

                                if(CheckIfUserReported($_SESSION['userData']['userID'],$listings[$count])){
                                    echo '<span class="text-danger"> Reported!</span> ';
                                }else{
                                    echo '<input class="btn btn-warning btn-sm" type="submit" value="Report" name="report'.$listings[$count].'"> ';
                                }
                            } elseif ($_SESSION['userData']['user_type'] == AGENT) {
                                if ($_SESSION['userData']['userID'] == $listingData['user_id']) {
                                    ?>
                                    <input class="btn btn-success btn-sm" type="submit" value="Edit Listing" name="edit<?php echo $listings[$count];?>">
                                    <?php
                                }
                            }
                        }else{
                            echo '<a href="login.php" class="btn btn-warning btn-sm" role="button">Login to save listing</a>';
                        }
                        echo '            </p>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                        echo '</form>';
                    }
                 }
            ?>
            </div>
            <nav aria-label="Page navigation" class="text-center">
                <ul class="pagination">
                    <li>
                        <a href="<?php $position = $pageNumber;$position -= 1;echo "listing-matches.php?pg=".$position;?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    for($count = 1; $count < $numberOfPages + 1; $count++){
                        $active = '';
                        if($pageNumber == $count){
                            $active = 'class="active"';
                        }
                        echo '<li '.$active.'><a href="listing-matches.php?pg='.$count.'">'. $count .'</a></li>';
                    }
                    ?>
                    <li>
                        <a href="<?php $position = $pageNumber;$position += 1;echo "listing-matches.php?pg=".$position;?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>