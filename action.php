<?php
$act = $_GET['act'];

if(isset($act)){
    if($act == 'logout'){
        session_start();
        session_destroy();
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}