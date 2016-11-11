<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : dashboard.php

// Page title
$title = "Cloud Estate | Dashboard";

// Include header
include_once('header.php');

$listing_ids = array();
$listingsResults = '';
$status = '';
$city = '';
$options = '';
$bedrooms = '';
$bathrooms = '';
$listingType = '';
$story = '';
$buildingType = '';
$errors = array();
$displayResults = false;

if(isset($_POST['submit'])){

    if(isset($_SESSION['search_listing'])){
        $stickySessions = $_SESSION['search_listing'];
    }

    // Validation for listing_status
    if(isset($_POST['listing_status']) && $_POST['listing_status'] != ""){
        $status = $_POST['listing_status'];
        $stickySessions['listing_status'] = $status;
    }else{
        array_push($errors, "- Please select a listing status!");
    }

    // Validation for city
    if(isset($_POST['city']) && $_POST['city'] != ""){
        $city = $_POST['city'];
        $stickySessions['city'] = $city;
    }else{
        array_push($errors, "- Please select a city!");
    }

    // Validation for property_options
    if(isset($_POST['property_options']) && $_POST['property_options'] != ""){
        $options = $_POST['property_options'];
        $stickySessions['property_options'] = $options;
    }else{
        array_push($errors, "- Please select a property_options!");
    }

    // Validation for bedrooms
    if(isset($_POST['bedrooms']) && $_POST['bedrooms'] != ""){
        $bedrooms = $_POST['bedrooms'];
        $stickySessions['bedrooms'] = $bedrooms;
    }else{
        array_push($errors, "- Please select bedrooms count!");
    }

    // Validation for bathrooms
    if(isset($_POST['bathrooms']) && $_POST['bathrooms'] != ""){
        $bathrooms = $_POST['bathrooms'];
        $stickySessions['bathrooms'] = $bathrooms;
    }else{
        array_push($errors, "- Please select bathrooms count!");
    }

    // Validation for listing_type
    if(isset($_POST['listing_type']) && $_POST['listing_type'] != ""){
        $listingType = $_POST['listing_type'];
        $stickySessions['listing_type'] = $listingType;
    }else{
        array_push($errors, "- Please select a listing type!");
    }

    // Validation for storey
    if(isset($_POST['storey']) && $_POST['storey'] != ""){
        $story = $_POST['storey'];
        $stickySessions['storey'] = $story;
    }else{
        array_push($errors, "- Please choose storey count!");
    }

    // Validation for building type
    if(isset($_POST['building_type']) && $_POST['building_type'] != ""){
        $buildingType = $_POST['building_type'];
        $stickySessions['building_type'] = $story;
    }else{
        array_push($errors, "- Please select a building type!");
    }

    if(empty($errors)){
        // prepare user input
        $searchData = array(
            'status' => $status,
            'city' => $city,
            'options' => $options,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'listingType' => $listingType,
            'storey' => $story,
            'buildingType' => $buildingType
        );

        $listingsResults = getAllSearchedListings($searchData);
        $displayResults = true;

        // start session listing ID for listing matches
        foreach ($listingsResults as $item){
            array_push($listing_ids, $item['user_id']);
        }
        $_SESSION['listingID'] = $listing_ids;


        if(empty($listingsResults)){
            array_push($errors, "- No results found!");
        }

    }

}

?>

    <div class="content">
        <div class="container">
            <div class="text-center">
                <h1>Advanced Listing Search</h1>

            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <?php
                    if(!empty($errors)){
                        ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Error(s):</strong><br/>
                            <?php
                            foreach ($errors as $error){
                                echo "<span>$error</span><br/>";
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-12">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <?php

                            build_simple_dropdown("city",getAllCity());

                            build_dropdown("property_options");

                            build_radio("status");

                            ?>
                        </div>
                        <div class="col-lg-4">
                            <?php
                            build_dropdown("bedrooms");

                            build_dropdown("bathrooms");

                            build_radio("listing_type");
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <?php

                            build_dropdown("storey");

                            build_dropdown("building_type");
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <input type="submit" class="btn btn-warning" name="submit" value="Search Listing">
                            <br/>
                            <br/>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        //////////////////////////
                        // DISPLAY ALL Searched listings based on advanced search
                        //////////////////////////
                        if($displayResults == true){
                            foreach ($listingsResults as $list){
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