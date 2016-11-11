<?php
include_once('includes/functions.php');
include_once('../includes/functions.php');
include_once('../includes/db.php');
include_once('../includes/constants.php');
include_once('includes/names.php');
include_once('includes/city_provinces.php');
include_once('includes/header.php');

// get all agent names
$agents = getAllAgentID();

$listings = array();
$status = array('s','a');
$address = array_merge($last_names, $male_names, $female_names);
$streetSuffix = array("Dr.","Ave.","St.");

if(isset($_POST['populate'])){



    for($count = 0; $count <= 999; $count++){
        $randomAgent = $agents[rand(0,count($agents)-1)];
        $listingStatus = $status[0];
        $price = rand(200000,1000000);
        $province = array_keys($province_city)[rand(0,11)];
        $city = $province_city[$province][rand(0,count($province_city[$province])-1)];
        $headLine = rand(1000, 9999) . " " . ucwords(strtolower($address[rand(0,count($address)-1)])) ." ".$streetSuffix[rand(0,count($streetSuffix)-1)] .", ".$city.", ". $province . " " . fakePostalCode();
        $description = randomDescription();
        $postal = fakePostalCode();
        $options = rand(0,3);
        $bedrooms = rand(0,4);
        $bathrooms = rand(0,4);
        $date = date("Y-m-d");
        $listingType = rand(0,1);
        $story = rand(0,3);
        $buildingType = rand(0,5);
        $views = rand(0,9999);
        $stars = rand(0,5);

        array_push($listings, array(
            "user_id" => $randomAgent,
            "status" => $listingStatus,
            "price" =>$price,
            "headline" =>$headLine,
            "description" =>$description,
            "postal_code" =>$postal,
            "images" => 0,
            "city" =>$city,
            "property_options" => $options,
            "bedrooms" =>$bedrooms,
            "bathrooms" =>$bathrooms,
            "date" => $date,
            "listing_type" =>$listingType,
            "storey" =>$story,
            "building_type" =>$buildingType,
            "listing_views" => $views,
            "listing_stars" => $stars
        ));
    }

    foreach($listings as $list){
        $query_name = rand(0,99999999999);

        // Prepare SQL
        pg_prepare(db_connect(), $query_name, "INSERT INTO listings VALUES( DEFAULT, $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17);");

        // Execute SQL
        pg_execute(db_connect(), $query_name, $list) or die("Error while inserting.");


    }

}

// get the total number of users
$sql = "SELECT listing_id FROM listings;";
$results = pg_query(db_connect(), $sql);
$count_results = pg_num_rows($results);
?>

    <div class="content">
        <div class="container-fluid">
            <div class="text-center">
                <h1>Listing Population</h1>
                <p>Click the button to generate random listings.<br><span class="text-danger">NOTE: Must run user populate scrips first or else no existing agent will be listed!</span> </p>
                <p>Total number of listings: <strong><?php echo $count_results;?></strong></p>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <input class="btn btn-success" type="submit" value="Generate Listings" name="populate">
                </form>
            </div>
            <br/>
            <div class="panel panel-primary">
                <div class="panel-heading">Users Table Generated (100 users)</div>
                <div class="panel-body">
                    <p>Note: All generated users account password is "test123".</p>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Status</th>
                        <th>price</th>
                        <th>headline</th>
                        <th>Description</th>
                        <th>Postal</th>
                        <th>images</th>
                        <th>City</th>
                        <th>Options</th>
                        <th>bedrooms</th>
                        <th>bathrooms</th>
                        <th>date</th>
                        <th>listing type</th>
                        <th>story</th>
                        <th>building type</th>
                        <th>views</th>
                        <th>Stars</th>
                    </tr>

                    </thead>
                    <tbody style="">
                    <?php
                    if(!empty($listings)){
                        foreach ($listings as $list){
                            echo '<tr>';
                            echo "<td>".$list['user_id']."</td>";
                            echo "<td>".get_property("status",$list['status'])."</td>";
                            echo "<td>".$list['price']."</td>";
                            echo "<td>".$list['headline']."</td>";
                            echo "<td>".$list['description']."</td>";
                            echo "<td>".$list['postal_code']."</td>";
                            echo "<td>".$list['images']."</td>";
                            echo "<td>".$list['city']."</td>";
                            echo "<td>".get_property("property_options",$list['property_options'])."</td>";
                            echo "<td>".get_property("bedrooms",$list['bedrooms'])."</td>";
                            echo "<td>".get_property("bathrooms",$list['bathrooms'])."</td>";
                            echo "<td>".$list['date']."</td>";
                            echo "<td>".get_property("listing_type",$list['listing_type'])."</td>";
                            echo "<td>".get_property("storey",$list['storey'])."</td>";
                            echo "<td>".get_property("building_type",$list['building_type'])."</td>";
                            echo "<td>".$list['listing_views']."</td>";
                            echo "<td>".get_property("listing_stars",$list['listing_stars'])."</td>";

                            echo '</tr>';
                        }

                    }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

<?php include_once('includes/footer.php');?>