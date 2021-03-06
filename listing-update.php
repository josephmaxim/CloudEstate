<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : dashboard.php

// Page title
$title = "Cloud Estate | Update Listing";

// Include header
include_once('header.php');

// Check if there's an existing user session
if(SessionCheck() == true)
{
    // Check user account type
    if($_SESSION['userData']['user_type'] != AGENT){
        header("Location: welcome.php");
    }
}
else
{
    header("Location: index.php");
}

$listingID ='';
$success = false;
$errors = array();
if($_GET['id'] == ""){
    header("Location: dashboard.php");
}elseif(isset($_GET['id'])){
    $listingID = $_GET['id'];

    $listingData = getListingData($listingID);

    if($listingData['user_id'] == $_SESSION['userData']['userID']) {

        $stickySessions['city'] = $listingData['city'];
        $stickySessions['postal_code'] = $listingData['postal_code'];
        $stickySessions['status'] = $listingData['status'];
        $stickySessions['bedrooms'] = $listingData['bedrooms'];
        $stickySessions['bathrooms'] = $listingData['bathrooms'];
        $stickySessions['listing_type'] = $listingData['listing_type'];
        $stickySessions['storey'] = $listingData['storey'];
        $stickySessions['property_options'] = $listingData['property_options'];
        $stickySessions['building_type'] = $listingData['building_type'];

        if (isset($_POST['submit'])) {
            // Validation for headline
            if (isset($_POST['headLine']) && $_POST['headLine'] != "") {
                // check length of input
                if (CheckInputLength($_POST['headLine'], 3, 100)) {
                    // sanitize input
                    $headline = sanitizeInput($_POST['headLine']);
                } else {
                    array_push($errors, "- Headline must be between 3 - 100 characters long.");
                }
            } else {
                array_push($errors, "- Please enter a Headline!");
            }

            // Validation for description
            if (isset($_POST['description']) && $_POST['description'] != "") {
                // check length of input
                if (CheckInputLength($_POST['description'], 3, 1000)) {
                    // sanitize input
                    $description = sanitizeInput($_POST['description']);
                } else {
                    array_push($errors, "- description must be between 3 - 1000 characters long.");
                }
            } else {
                array_push($errors, "- Please enter a description!");
            }

            // Validation for price
            if (isset($_POST['price']) && $_POST['price'] != "") {
                // check length of input
                if (is_numeric($_POST['price'])) {
                    // sanitize input
                    $price = sanitizeInput($_POST['price']);
                } else {
                    array_push($errors, "- price must be in dollar value.");
                }
            } else {
                array_push($errors, "- Please enter a price!");
            }

            // Validation for listing_status
            if (isset($_POST['status']) && $_POST['status'] != "") {
                $status = $_POST['status'];
                $stickySessions['status'] = $status;
            } else {
                array_push($errors, "- Please select a listing status!");
            }

            // Validation for Postal code
            if (isset($_POST['postal']) && $_POST['postal'] != "") {
                // check length of input
                if (CheckInputLength($_POST['postal'], 6, 6)) {
                    // sanitize input
                    $postal = sanitizeInput($_POST['postal']);
                } else {
                    array_push($errors, "- Postal must be 6 characters long.");
                }
            } else {
                array_push($errors, "- Please enter a postal code!");
            }

            // Validation for city
            if (isset($_POST['city']) && $_POST['city'] != "") {
                $city = $_POST['city'];
                $stickySessions['city'] = $city;
            } else {
                array_push($errors, "- Please select a city!");
            }

            // Validation for property_options
            if (isset($_POST['property_options']) && $_POST['property_options'] != "") {
                $options = $_POST['property_options'];
                $stickySessions['property_options'] = $options;
            } else {
                array_push($errors, "- Please select a property_options!");
            }

            // Validation for bedrooms
            if (isset($_POST['bedrooms']) && $_POST['bedrooms'] != "") {
                $bedrooms = $_POST['bedrooms'];
                $stickySessions['bedrooms'] = $bedrooms;
            } else {
                array_push($errors, "- Please select bedrooms count!");
            }

            // Validation for bathrooms
            if (isset($_POST['bathrooms']) && $_POST['bathrooms'] != "") {
                $bathrooms = $_POST['bathrooms'];
                $stickySessions['bathrooms'] = $bathrooms;
            } else {
                array_push($errors, "- Please select bathrooms count!");
            }

            // Validation for listing_type
            if (isset($_POST['listing_type']) && $_POST['listing_type'] != "") {
                $listingType = $_POST['listing_type'];
                $stickySessions['listing_type'] = $listingType;
            } else {
                array_push($errors, "- Please select a listing type!");
            }

            // Validation for storey
            if (isset($_POST['storey']) && $_POST['storey'] != "") {
                $story = $_POST['storey'];
                $stickySessions['storey'] = $story;
            } else {
                array_push($errors, "- Please choose storey count!");
            }

            // Validation for building type
            if (isset($_POST['building_type']) && $_POST['building_type'] != "") {
                $buildingType = $_POST['building_type'];
                $stickySessions['building_type'] = $story;
            } else {
                array_push($errors, "- Please select a building type!");
            }

            if(empty($errors)){
                // prepare user input
                $data = array(
                    'headline' => $headline,
                    'description' => $description,
                    'price' => $price,
                    'status' => $status,
                    'postal' => $postal,
                    'city' => $city,
                    'options' => $options,
                    'bedrooms' => $bedrooms,
                    'bathrooms' => $bathrooms,
                    'listingType' => $listingType,
                    'storey' => $story,
                    'buildingType' => $buildingType,
                );

                if(UpdateListing($listingID,$data) == true){
                    $success = true;
                }else{
                    array_push($errors,"There was an error while updating the listing, please contact the administrator.");
                }
            }

        }

    }else{
        header("Location: dashboard.php");
    }


}
?>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-sidebar">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="listing-create.php">Create Listing</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 content-left">
                    <h1>Update Listing #<?php echo $listingID;?></h1>
                    <hr/>
                    <?php
                    if (!empty($errors)) {
                        ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>Error(s):</strong><br/>
                            <?php
                            foreach ($errors as $errors) {
                                echo "<span>$errors</span><br/>";
                            }
                            ?>
                        </div>
                        <?php
                    }
                    if($success == true){
                        ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h1>Listing #<?php echo $listingID;?> successfully updated.</h1>
                            <p><a href="listing-display.php?listing_id=<?php echo $listingID?>">Click here</a> to view your updated listing.</p>
                        </div>
                        <?php
                    }else{
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$listingID";?>" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <a class="btn btn-success btn-sm text-center" href="listing-images.php?listing_id=<?php echo $listingID;?>">Upload Images</a>
                                </div>
                                <div class="form-group">
                                    <label for="headLine">Head Line:</label>
                                    <input type="text" class="form-control" id="headLine" name="headLine" value="<?php echo $listingData['headline']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description"><?php echo $listingData['description']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $listingData['price']; ?>">
                                </div>
                                <?php
                                build_dropdown("status");
                                ?>
                                <div class="form-group">
                                    <label for="postal">Postal Code:</label>
                                    <input type="text" class="form-control" id="postal" name="postal" value="<?php echo $listingData['postal_code']; ?>">
                                </div>
                                <?php

                                build_simple_dropdown("city",getAllCity());

                                build_dropdown("property_options");

                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                build_dropdown("bedrooms");

                                build_dropdown("bathrooms");

                                build_dropdown("listing_type");

                                build_dropdown("storey");

                                build_dropdown("building_type");
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <?php

                                ?>
                                <input type="submit" class="btn btn-warning" name="submit" value="Update listing">
                                <br/>
                                <br/>
                            </div>
                        </div>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>