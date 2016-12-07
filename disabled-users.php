<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : disabled-users.php

// Page title
$title = "Cloud Estate | Disabled Users";

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

// pagination
$disabledUsers = GetDisabledUsers();
$disabledUsersCount = count($disabledUsers);
$numberOfPages = ceil($disabledUsersCount/MAX_RESULTS);

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
                        <li><a href="admin.php">Admin Page</a></li>
                        <li><a href="disabled-users.php">Disabled Users</a></li>
                    </ul>
                </div>
                <div class="col-lg-10 content-left">
                    <h1>Disabled Users</h1>
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
                    <nav aria-label="Page navigation" class="text-center">
                        <ul class="pagination">
                            <li>
                                <a href="<?php $position = $pageNumber;$position -= 1;echo "disabled-users.php?pg=".$position;?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for($count = 1; $count < $numberOfPages + 1; $count++){
                                $active = '';
                                if($pageNumber == $count){
                                    $active = 'class="active"';
                                }
                                echo '<li '.$active.'><a href="disabled-users.php?pg='.$count.'">'. $count .'</a></li>';
                            }
                            ?>
                            <li>
                                <a href="<?php $position = $pageNumber;$position += 1;echo "disabled-users.php?pg=".$position;?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for($count = $pageNumber*MAX_RESULTS-MAX_RESULTS; $count < $pageNumber*MAX_RESULTS;$count++){
                                if($count < $disabledUsersCount){
                                    echo '<tr>';
                                    echo "<td>".$disabledUsers[$count]['user_id']."</td>";
                                    echo "<td>".GetUserProfileInfo($disabledUsers[$count]['user_id'])['first_name']. " " .GetUserProfileInfo($disabledUsers[$count]['user_id'])['last_name']."</td>";
                                    echo "<td>".$disabledUsers[$count]['email_address']."</td>";
                                    echo '<td>NONE</td>';
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
                                <a href="<?php $position = $pageNumber;$position -= 1;echo "disabled-users.php?pg=".$position;?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for($count = 1; $count < $numberOfPages + 1; $count++){
                                $active = '';
                                if($pageNumber == $count){
                                    $active = 'class="active"';
                                }
                                echo '<li '.$active.'><a href="disabled-users.php?pg='.$count.'">'. $count .'</a></li>';
                            }
                            ?>
                            <li>
                                <a href="<?php $position = $pageNumber;$position += 1;echo "disabled-users.php?pg=".$position;?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <hr/>
                </div>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>