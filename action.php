<?php
include_once('header.php');

// Gets the value of 'act'
$act = $_GET['act'];

// Check if act is set
if(isset($act)){

    // check if act is equals to logout
    if($act == 'logout'){
        session_start();
        session_destroy();

        // un set a cookie.
        if (isset($_COOKIE['userLogin'])) {
            unset($_COOKIE['userLogin']);
            setcookie('userLogin', '', time() - 3600, '/');
        }

        // redirect to index.php
        header("Location: index.php");
    }
    // removes favourite listing
    elseif($act == 'removefav'){
        RemoveListingToFavourites($_SESSION['userData']['userID'],$_GET['listing_id']);
        header("Location: welcome.php");
    }

    // enables agent
    elseif($act == 'enableAgent'){
        EnableAgent($_GET['user_id']);
        setcookie('adminMsg', '<span class="text-success">Successfully enabled Agent</span> '.$_GET['user_id']);
        header("Location: admin.php");
    }

    // Disable User
    elseif($act == 'disableUser'){
        DisableUser($_GET['user_id']);
        setcookie('adminMsg', '<span class="text-danger">Successfully disabled Agent</span> '.$_GET['user_id']);
        header("Location: admin.php");
    }

    // Ban reporter
    elseif($act == 'banReporter'){
        DisableUser($_GET['user_id']);
        UpdateReportStatus($_GET['user_id'],$_GET['listing_id']);
        setcookie('adminMsg', '<span class="text-danger">Successfully banned reporter</span> '.$_GET['user_id']);
        header("Location: admin.php");
    }

    // close report
    elseif($act == 'closeReport'){
        UpdateReportStatus($_GET['user_id'],$_GET['listing_id']);
        setcookie('adminMsg', '<span class="text-danger">Report successfully closed</span> ');
        header("Location: admin.php");
    }

    else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}

include_once('footer.php');
?>