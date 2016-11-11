<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : header.php

// Include Files
require_once('includes/constants.php');
require_once('includes/db.php');            // Note: We had to require db.php first before functions because we are using
require_once('includes/functions.php');     //       the connect function in functions.php.

// start session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title;?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/webd3201.css?v=<?php echo time(); ?>" rel="stylesheet">

</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="Cloud Estate"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Search <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="listing-search.php">Search Listings</a></li>
                        <li><a href="listing-city.php">Search by City</a></li>
                        <li><a href="listing-matches.php">Matches</a></li>
                    </ul>
                </li>
                <?php
                    if(isset($_SESSION['userData']['userID'])){

                        if($_SESSION['userData']['user_type'] == ADMIN){
                            echo '<li><a href="admin.php">Admin</a></li>';
                        }elseif($_SESSION['userData']['user_type'] == AGENT){
                            echo '<li><a href="dashboard.php">Dashboard</a></li>';
                        }
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="welcome.php">Profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Edit Profile</a></li>
                                <li><a href="user-password.php">Change Password</a></li>
                                <li><a href="action.php?act=logout"><span class="text-danger">Logout</span></a></li>
                            </ul>
                        </li>
                        <?php
                    }else{
                        ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        <?php
                    }
                ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
