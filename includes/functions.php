<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond
//  File name   : function.php

include_once('users.class.php');

function UserLogin($email, $password){

    $user = new Users();
    if($user->GetUser($email) == true){
        if($password == $user->getPassword()){
            echo "match found.";
        }else{
            echo "Email & password don't match!";
        }
    }else{
        echo "no results found.";
    }

}

//for debug only debug only
UserLogin("joseph.dagunan@dmail.ca","test123");



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