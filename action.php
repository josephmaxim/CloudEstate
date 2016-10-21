<?php
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
}else{
    header("Location: index.php");
}