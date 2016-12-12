<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : listing-search.php

// Page title
$title = "Cloud Estate | Dashboard";

// Include header
include_once('header.php');

if(isset($_GET['City']) && $_GET['City'] != ""){
    $selectedCity = $_GET['City'];
}else{
    header("Location: listing-city.php");
}

$listings_id = array();

if(isset($_POST['submit'])){

    function wrap($text){
        $string = "";
        if(isset($text) && $text != ""){
            $string = "AND (".$text.")";
        }
        return $string;
    }

    function buildOr($selection){
        $string = "";
        foreach ($_POST[$selection] as $key => $id){
            if(count($_POST[$selection]) > 1){
                if($key != 0){
                    $string .= " OR ";
                }
            }
            $string .="listings.$selection = $id";
        }
        return $string;
    }

    $property_options = "";
    $bedrooms = "";
    $bathrooms = "";
    $story = "";
    $build_type = "";
    $listing_type = "";
    // check Property options
    if(isset($_POST['property_options'])){
        $property_options = buildOr("property_options");
    }
    // check bedrooms options
    if(isset($_POST['bedrooms'])){
        $bedrooms = buildOr("bedrooms");
    }
    // check bathrooms options
    if(isset($_POST['bathrooms'])){
        $bathrooms = buildOr("bathrooms");
    }
    // check storey options
    if(isset($_POST['storey'])){
        $story = buildOr("story");
    }
    // check building_type options
    if(isset($_POST['building_type'])){
        $building_type = buildOr("building_type");
    }
    // check listing_type options
    if(isset($_POST['listing_type'])){
        $listing_type = buildOr("listing_type");
    }

    $sql = "SELECT listings.listing_id FROM listings 
	WHERE 1 = 1 
	AND listings.city = '$selectedCity'
	".wrap($property_options)."
	".wrap($bedrooms)."
	".wrap($bathrooms)."
	".wrap($story)."
	".wrap($build_type)."
	".wrap($listing_type)."
	ORDER BY listings.listing_id DESC LIMIT 200";

    pg_prepare(db_connect(), "Search",$sql);
    // Execute Query
    $result = pg_execute(db_connect(), "Search", array());

    while ($row = pg_fetch_array($result)){
        array_push($listings_id, $row[0]);
    }

    $_SESSION['searchIds'] = $listings_id;
    header("Location: listing-matches.php");

}
?>

    <div class="content">
        <div class="container">
            <div class="text-center">
                <h1>Search Listing in <?php echo $selectedCity?></h1>
                <p></p>
            </div>
            <div class="col-lg-12">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?City='.$selectedCity;?>">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <?php

                            build_radio("property_options");
                            ?>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <?php
                            build_radio("bedrooms");

                            ?>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <?php

                            build_radio("bathrooms");

                            ?>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <?php

                            build_radio("storey");
                            ?>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <?php

                            build_radio("building_type");
                            ?>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <?php

                            build_radio("listing_type");
                            ?>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <input type="submit" class="btn btn-warning" name="submit" value="Search Listing">
                            <br/>
                            <br/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>