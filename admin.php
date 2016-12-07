<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : admin.php

// Page title
$title = "Cloud Estate | Home";

// Include header
include_once('header.php');

if(SessionCheck() == true)
{
    // Check user account type
    if($_SESSION['userData']['user_type'] != ADMIN){
        header("Location: welcome.php");
    }
}
else
{
    header("Location: index.php");
}
$pendingAgents = GetPendingAgents();
$reportedListings = GetAllReportedListing();
?>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-sidebar">
                        <li><a href="admin.php">Admin Page</a></li>
                        <li><a href="disabled-users.php">Disabled Users</a></li>
                    </ul>
                </div>
                <div class="col-lg-10 content-left">
                    <h1>Administrator</h1>
                    <hr/>
                    <?php
                    if(isset($_COOKIE['disable_listing'])) {
                        echo '<div class="alert alert-success" role="alert">
                              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                              Successfully disabled listing!
                              </div>';
                        setcookie("disable_listing", "");
                    }
                    ?>
                    <p>Welcome administrator <strong><?php echo $_SESSION['userData']['userID']?></strong>, the last time you accessed the site was on <span class="text-success"><?php echo $_SESSION['userData']['last_access']?></span></p>
<!--                    <h2 class="sub-header">Section title</h2>-->
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if(isset($_COOKIE['adminMsg'])) {
                                echo '<div class="alert alert-warning" role="alert">
                              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                              '.$_COOKIE['adminMsg'].'
                              </div>';
                                setcookie("adminMsg", "");
                            }
                            ?>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Pending Agents</h3>
                                </div>
                                <div class="panel-scroll">
                                    <table class="table table-striped table-responsive">
                                        <thead>
                                        <tr>
                                            <th>UserID</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        foreach($pendingAgents as $key => $agent){
                                            echo'<tr>';
                                            echo '<td class="vert-align">'.$agent['user_id'].'</td>';
                                            echo '<td class="vert-align">'.$agent['email_address'].'</td>';
                                            echo '<td class="vert-align"><a href="action.php?act=enableAgent&user_id='.$agent['user_id'].'" class="btn btn-sm btn-success">Enable Agent</a> <a href="action.php?act=disableUser&user_id='.$agent['user_id'].'" class="btn btn-sm btn-danger">Disable Account</a></td>';
                                            echo'</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Offensive Listing</h3>
                                </div>
                                <div class="panel-scroll">
                                    <table class="table table-striped table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Reporter ID</th>
                                            <th>Full Name</th>
                                            <th>Heading</th>
                                            <th>Reported On</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        foreach($reportedListings as $key => $report){
                                            echo'<tr>';
                                            echo '<td class="vert-align">'.$report['user_id'].'</td>';
                                            echo '<td class="vert-align">'.GetUserProfileInfo($report['user_id'])['first_name']." ".GetUserProfileInfo($report['user_id'])['last_name'].'</td>';
                                            echo '<td class="vert-align">'.getListingData($report['listing_id'])['headline'].'</td>';
                                            echo '<td class="vert-align">'.$report['reported_on'].'</td>';
                                            echo '<td class="vert-align"><a href="listing-display.php?listing_id='.$report['listing_id'].'" class="btn btn-sm btn-info">View</a> <a href="action.php?act=banReporter&user_id='.$report['user_id'].'&listing_id='.$report['listing_id'].'" class="btn btn-sm btn-danger">Ban Reporter</a> <a href="action.php?act=closeReport&user_id='.$report['user_id'].'&listing_id='.$report['listing_id'].'" class="btn btn-sm btn-warning">Close Report</a></td>';
                                            echo'</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>