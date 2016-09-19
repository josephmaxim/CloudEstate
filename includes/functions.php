<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond
//  File name   : function.php


// Function that renders the Copyrights
function display_copyright(){

    $year = date("Y");
    echo "<span>&copy; $year Cloud Estate. All Rights Reserved.</span>";

}


// Password Encryption
function encryptPassword($password){

    $saltedRawPassword = "232dsd" . $password . "867hn2"; // do not edit or else current users wont be able to login!

    $encryptedPassword = md5($saltedRawPassword); // encrypt salted password.

    return $encryptedPassword;
}