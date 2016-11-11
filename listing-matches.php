<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : listing_matches.php

// Page title
$title = "Cloud Estate | Listing matches";

//
// NOTE: Not exactly sure whats the purpose of this page since my results shows up at the bottom of the form on listing-search.php
//
$listings = array();
$displayResults = false;

if(!empty($_SESSION['listingID'])){
    foreach ($_SESSION['listingID'] as $id){
        array_push($listings, listing_preview($id));
    }
    $displayResults = true;
}




// Include header
include_once('header.php');


?>

    <div class="content">
        <div class="container">
            <div class="text-center">
                <h1>Listing Match results</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        //////////////////////////
                        // DISPLAY ALL Searched listings based on advanced search
                        //////////////////////////
                        if($displayResults == true){
                            foreach ($listings as $list){
                                echo '<div class="col-lg-3">';
                                echo '<div class="panel panel-default">';
                                echo '<div class="panel-heading">'.$list['headline'].'</div>';

                                echo '<div class="panel-body">';
                                echo "<li>".get_property("status",$list['status'])."</li>";
                                echo "<li>".$list['price']."</li>";
                                echo "<li>".$list['headline']."</li>";
                                echo "<li>".$list['description']."</li>";
                                echo "<li>".$list['postal_code']."</li>";
                                echo "<li>".$list['images']."</li>";
                                echo "<li>".$list['city']."</li>";
                                echo "<li>".get_property("property_options",$list['property_options'])."</li>";
                                echo "<li>".get_property("bedrooms",$list['bedrooms'])."</li>";
                                echo "<li>".get_property("bathrooms",$list['bathrooms'])."</li>";
                                echo "<li>".get_property("listing_type",$list['listing_type'])."</li>";
                                echo "<li>".get_property("storey",$list['storey'])."</li>";
                                echo "<li>".get_property("building_type",$list['building_type'])."</li>";
                                echo "<li>".$list['listing_views']."</li>";
                                echo "<li>".get_property("listing_stars",$list['listing_stars'])."</li>";
                                echo '</div>';

                                echo '</div>';
                                echo '</div>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>