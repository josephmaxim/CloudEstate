<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond
//  File name   : header.php


// Include Files
require_once('includes/constants.php');
require_once('includes/db.php');
require_once('includes/functions.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
<div class="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="logo">
                    <img src="img/logo.png" alt="Cloud Estate">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="links">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="listing-search.php">Search Listing</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>