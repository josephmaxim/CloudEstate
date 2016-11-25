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

$order ='';
if(isset($_GET['filter'])){
    $filter = sanitizeInput($_GET['filter']);

    if($filter == CLOSED){
        $order = CLOSED;
    }elseif ($filter == OPEN){
        $order = OPEN;
    }elseif ($filter == SOLD){
        $order = SOLD;
    }elseif ($filter == HIDDEN){
        $order = HIDDEN;
    }else{
        $order = '';
    }
}

// pagination
$listings = getAgentListings($order,$_SESSION['userData']['userID']);
$listingsCount = count($listings);
$numberOfPages = ceil($listingsCount/MAX_RESULTS);

if(isset($_GET['pg']) && $_GET['pg'] > 0 && $_GET['pg'] < $numberOfPages + 1){
    $pageNumber = $_GET['pg'];
}else{
    $pageNumber = 1;
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
                    <h1>Dashboard</h1>
                    <p>Welcome agent <strong><?php echo $_SESSION['userData']['userID']?></strong>, the last time you accessed the site was on <span class="text-success"><?php echo $_SESSION['userData']['last_access']?></span></p>
                    <hr/>
                    <h2>Your Listings</h2>
                    <form method="get" action="">
                        <label>Filter By:</label>
                        <label class="radio-inline"><input type="radio" name="filter" value="" <?php if($order == ""){echo 'checked="checked"';}?> >All</label>
                        <label class="radio-inline"><input type="radio" name="filter" value="o" <?php if($order == "o"){echo 'checked="checked"';}?> >Open</label>
                        <label class="radio-inline"><input type="radio" name="filter" value="c" <?php if($order == "c"){echo 'checked="checked"';}?> >Close</label>
                        <label class="radio-inline"><input type="radio" name="filter" value="h" <?php if($order == "h"){echo 'checked="checked"';}?> >Hidden</label>
                        <label class="radio-inline"><input type="radio" name="filter" value="s" <?php if($order == "s"){echo 'checked="checked"';}?> >Sold</label>
                        <input class="btn btn-info btn-sm" type="submit" value="Filter">
                    </form>

                    <hr/>
                    <nav aria-label="Page navigation" class="text-center">
                        <ul class="pagination">
                            <li>
                                <a href="<?php $position = $pageNumber;$position -= 1;echo "dashboard.php?filter=$order&pg=".$position;?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for($count = 1; $count < $numberOfPages + 1; $count++){
                                $active = '';
                                if($pageNumber == $count){
                                    $active = 'class="active"';
                                }
                                echo '<li '.$active.'><a href="dashboard.php?filter='.$order.'&pg='.$count.'">'. $count .'</a></li>';
                            }
                            ?>
                            <li>
                                <a href="<?php $position = $pageNumber;$position += 1;echo "dashboard.php?filter=$order&pg=".$position;?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Headline</th>
                                <th>Listing Type</th>
                                <th>Building Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for($count = $pageNumber*MAX_RESULTS-MAX_RESULTS; $count < $pageNumber*MAX_RESULTS;$count++){
                                if($count < $listingsCount){
                                    echo '<tr>';
                                    echo "<td>".$listings[$count]['listing_id']."</td>";
                                    echo "<td>".get_property("status",$listings[$count]['status'])."</td>";
                                    echo "<td>$".$listings[$count]['price']."</td>";
                                    echo "<td>".$listings[$count]['headline']."</td>";
                                    echo "<td>".get_property("listing_type",$listings[$count]['listing_type'])."</td>";
                                    echo "<td>".get_property("building_type",$listings[$count]['building_type'])."</td>";
                                    echo '<td><a class="btn btn-success btn-sm" href="listing-display.php?listing_id='.$listings[$count]['listing_id'].'">View</a> <a href="listing-update.php?id='.$listings[$count]['listing_id'].'" class="btn btn-info btn-sm">Edit</a> <a href="#" class="btn btn-danger btn-sm">Delete</a></td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation" class="text-center">
                        <ul class="pagination">
                            <li>
                                <a href="<?php $position = $pageNumber;$position -= 1;echo "dashboard.php?filter=$order&pg=".$position;?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for($count = 1; $count < $numberOfPages + 1; $count++){
                                $active = '';
                                if($pageNumber == $count){
                                    $active = 'class="active"';
                                }
                                echo '<li '.$active.'><a href="dashboard.php?filter='.$order.'&pg='.$count.'">'. $count .'</a></li>';
                            }
                            ?>
                            <li>
                                <a href="<?php $position = $pageNumber;$position += 1;echo "dashboard.php?filter=$order&pg=".$position;?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>