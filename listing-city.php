<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : dashboard.php

// Page title
$title = "Cloud Estate | Dashboard";

// Include header
include_once('header.php');

$city = "";
$errors = array();
$displayResults = false;

if(isset($_POST['submit'])){

    if(isset($_POST['city']) && $_POST['city'] != ""){
        $city = $_POST['city'];
        $listings = getListingsOnCity(ucwords($city));
        $displayResults = true;
    }else{
        array_push($errors, "- Please enter a city!");
    }

}

?>

    <div class="content">
        <div class="container">
            <div class="text-center">
                <h1>Listing City</h1>

            </div>
            <div class="row">
                <div class="col-lg-5 col-lg-offset-3">
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
            <div class="row">
                <div class="col-lg-12">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="input-group  input-group-lg">
                            <input type="text" class="form-control" placeholder="Search City" name="city" value="<?php echo $city;?>">
                            <span class="input-group-btn">
                            <input class="btn btn-success" type="submit" name="submit" value="GO!"></button>
                        </span>
                        </div>
                    </form>
                    <br/>
                </div>



                <?php
                //////////////////////////
                // DISPLAY ALL Searched listings based on city
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
            <br/>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>