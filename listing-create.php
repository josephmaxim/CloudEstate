<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : listing-create.php

// Page title
$title = "Cloud Estate | Create a listing.";

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

$headline = '';
$description = '';
$price = '';
$status = '';
$postal = '';
$city = '';
$options = '';
$bedrooms = '';
$bathrooms = '';
$listingType = '';
$story = '';
$buildingType = '';
$errors = array();
$success = false;

if(isset($_POST['submit'])){

    if(isset($_SESSION['create_listing'])){
        $stickySessions = $_SESSION['create_listing'];
    }


    // Validation for headline
    if(isset($_POST['headLine']) && $_POST['headLine'] != ""){
        // check length of input
        if(CheckInputLength($_POST['headLine'], 3, 100)){
            // sanitize input
            $headline = sanitizeInput($_POST['headLine']);
        }else{
            array_push($errors, "- Headline must be between 3 - 100 characters long.");
        }
    }else{
        array_push($errors, "- Please enter a Headline!");
    }

    // Validation for description
    if(isset($_POST['description']) && $_POST['description'] != ""){
        // check length of input
        if(CheckInputLength($_POST['description'], 3, 1000)){
            // sanitize input
            $description = sanitizeInput($_POST['description']);
        }else{
            array_push($errors, "- description must be between 3 - 1000 characters long.");
        }
    }else{
        array_push($errors, "- Please enter a description!");
    }

    // Validation for price
    if(isset($_POST['price']) && $_POST['price'] != ""){
        // check length of input
        if(is_numeric($_POST['price'])){
            // sanitize input
            $price = sanitizeInput($_POST['price']);
        }else{
            array_push($errors, "- price must be in dollar value.");
        }
    }else{
        array_push($errors, "- Please enter a price!");
    }

    // Validation for listing_status
    if(isset($_POST['listing_status']) && $_POST['listing_status'] != ""){
        $status = $_POST['listing_status'];
        $stickySessions['listing_status'] = $status;
    }else{
        array_push($errors, "- Please select a listing status!");
    }

    // Validation for Postal code
    if(isset($_POST['postal']) && $_POST['postal'] != ""){
        // check length of input
        if(CheckInputLength($_POST['postal'], 6, 6)){
            // sanitize input
            $postal = sanitizeInput($_POST['postal']);
        }else{
            array_push($errors, "- Postal must be 6 characters long.");
        }
    }else{
        array_push($errors, "- Please enter a postal code!");
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
        $userData = array(
            'status' => $status,
            'price' => $price,
            'headline' => $headline,
            'description' => $description,
            'postal' => $postal,
            'city' => $city,
            'options' => $options,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'listingType' => $listingType,
            'storey' => $story,
            'buildingType' => $buildingType,
        );


        if(insertListing($userData) == true){
            $success = true;
            $stickySessions = '';
        }else{
            array_push($errors, "- There was an error while inserting your listing. please contact the administration!");
        }

    }

}
?>

    <div class="content">
        <div class="container">
            <h1 class="text-center">Create a Listing</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="row">
                        <div class="col-lg-12">
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
                                    <p>You have successfully created a listing.</p>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <label for="headLine">Head Line:</label>
                                <input type="text" class="form-control" id="headLine" name="headLine" value="<?php echo $headline; ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
                            </div>
                            <?php
                                build_radio("listing_status");
                            ?>
                            <div class="form-group">
                                <label for="postal">Postal Code:</label>
                                <input type="text" class="form-control" id="postal" name="postal" value="<?php echo $postal; ?>">
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

                                build_radio("listing_type");

                                build_dropdown("storey");

                                build_dropdown("building_type");
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <?php

                            ?>
                            <input type="submit" class="btn btn-warning" name="submit" value="Create listing">
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>