<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : welcome.php

// Page title
$title = "Cloud Estate | Welcome";

// Include header
include_once('header.php');

// Check if there's an existing user session
if(SessionCheck() == false) {
    header("Location: index.php");
}
$userData = GetUserProfileInfo($_SESSION['userData']['userID']);
?>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-sidebar">
                        <li><a href="welcome.php">Profile (welcome)</a></li>
                        <li><a href="user-update.php">Edit Profile</a></li>
                        <li><a href="user-password.php">Change Password</a></li>
                    </ul>
                </div>
                <div class="col-lg-10 content-left">
                    <h1>Account Profile</h1>
                    <p>Welcome <strong><?php echo $_SESSION['userData']['userID']?></strong>, the last time you accessed the site was on <span class="text-success"><?php echo $_SESSION['userData']['last_access']?></span></p>
                    <hr/>
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Account Information</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table profile-info">
                                        <tbody>
                                        <tr>
                                            <td><strong>User ID:</strong></td>
                                            <td><?php echo $userData['user_id']?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Full Name:</strong></td>
                                            <td><?php echo $userData['salutation']. " " .$userData['first_name']. " " .$userData['last_name']?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td><?php echo $userData['email_address']?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Enrol Date:</strong></td>
                                            <td><?php echo $userData['enrol_date']?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Last Access:</strong></td>
                                            <td><?php echo $userData['last_access']?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table class="table profile-info">
                                        <tbody>
                                        <tr>
                                            <td><strong>Address:</strong></td>
                                            <td><?php echo $userData['street_address_1']. " " .$userData['city']. " " .$userData['province']. ", " .$userData['postal_code']?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone #1:</strong></td>
                                            <td><?php echo $userData['primary_phone_number']?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone #2:</strong></td>
                                            <td><?php if($userData['secondary_phone_number'] == ""){ echo "N/A"; }else{ echo $userData['secondary_phone_number']; }?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Fax #:</strong></td>
                                            <td><?php if($userData['fax_number'] == ""){ echo "N/A"; }else{ echo $userData['fax_number']; }?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contact Method:</strong></td>
                                            <td>
                                                <?php
                                                if($userData['preferred_contact_method'] == PHONE){
                                                    echo "Phone";
                                                }elseif($userData['preferred_contact_method'] == POSTED_MAIL){
                                                    echo "Posted Mail";
                                                }elseif($userData['preferred_contact_method'] == EMAIL){
                                                    echo "Email";
                                                }else{
                                                    echo "N/A";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($_SESSION['userData']['user_type'] == CLIENT){
                        $favouriteListings = GetUserFavourites($_SESSION['userData']['userID']);
                        ?>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Favourite Listing(s)</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-favourites">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Headline</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // display all favourites listing
                                    foreach ($favouriteListings as $favourite){
                                        $listings = getListingData($favourite[1]);
                                        $highlight = '';
                                        if ($listings['images'] == 0) {
                                            $image = '<img width="70px" height="70" src="img/noimage.jpg"/>';
                                        } else {
                                            $image = '<img width="400px" height="400px" src="' . $listingDirPath . $listingID . '_' . $listingData['images'] . '.jpg"/>';
                                        }
                                        if ($listings['status'] == SOLD){
                                            $highlight = 'class="danger"';
                                        }
                                        echo '<tr '.$highlight.'>';
                                        echo '<td class="vert-align">'.$image.'</td>';
                                        echo '<td class="vert-align">'.$listings['listing_id'].'</td>';
                                        echo '<td class="vert-align">'.get_property("status",$listings['status'])."</td>";
                                        echo '<td class="vert-align">'.$listings['price']."</td>";
                                        echo '<td class="vert-align">'.$listings['headline']."</td>";
                                        echo '<td class="vert-align">
                                                <a class="btn btn-success btn-sm" href="listing-display.php?listing_id='.$listings['listing_id'].'">View</a> 
                                                <a class="btn btn-danger btn-sm" href="action.php?act=removefav&listing_id='.$listings['listing_id'].'">Remove</a> 
                                              </td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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