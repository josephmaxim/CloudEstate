<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : header.php


// Include Files
require_once('includes/constants.php');
require_once('includes/db.php');            // Note: We had to require db.php first before functions because we are using
require_once('includes/functions.php');     //       the connect function in functions.php.

// Start Sessions
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title;?></title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css"/>
    <link rel="stylesheet" href="css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="css/webd3201.css" type="text/css"/>
</head>
<body>

<!-- Navigation -->

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-caret-down fa-lg" aria-hidden="true"></i>
            </button>
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="Cloud Estate">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="listing-search.php">Search Listing</a></li>
                <?php
                if(SessionCheck() == false){
                    echo '<li><a href="login.php">Login</a></li><li><a href="register.php">Register</a></li>';
                }else{
                    echo '<li><a href="welcome.php">Account</a></li><li><a href="action.php?act=logout">Logout</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>