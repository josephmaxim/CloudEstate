<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : dashboard.php

// Page title
$title = "Cloud Estate | Dashboard";

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
?>

    <div class="content">
        <div class="container-fluid">
            <div class="text-center">
                <h1>Dashboard</h1>
                <p>Welcome Agent <strong><?php echo $_SESSION['userData']['userID']?></strong>, the last time you accessed the site was on <span class="text-success"><?php echo $_SESSION['userData']['last_access']?></span></p>
                <a class="btn btn-info" href="listing-create.php">Create a listing.</a>
                <br/>
            </div>
            <h2>Your current listings</h2>
            <div class="row">


                <?php
                //////////////////////////
                // DISPLAY ALL CURRENT AGENT LOGIN LISTING
                //////////////////////////
                $listings = getAgentListings($_SESSION['userData']['userID']);

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

                ?>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>