<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : function.php

include_once('users.class.php');
$_SESSION['UserData'] = array();

function UserLogin($email, $password){
    $user = new Users();
    if($user->GetUser($email) == true){
        if($password == $user->getPassword()){
            $userData = array(
                'user_id' => $user->getUserId(),
                'password' => $user->getPassword(),
                'email' => $user->getEmailAddress(),
                'user_type' => $user->getUserType(),
                'enrol_date' => $user->getEnroldate(),
                'last_access' => $user->getLastAccess()
            );
            StartUserSession($userData);
            $user->UpdateUser($user->getEmailAddress(),$user->getPassword(),$user->getUserType(),"getdate()");
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

}

function StartUserSession($data){

    $_SESSION['UserData'] = array(
        'user_id' => $data['user_id'],
        'password' => $data['password'],
        'email' => $data['email'],
        'user_type' => $data['user_type'],
        'enrol_date' => $data['enrol_date'],
        'last_access' => $data['last_access']
    );
}

function CurrentDateTime(){
    date_default_timezone_set("America/Toronto");
    $date = date("M j, Y  g:i a");

    return $date;
}
echo CurrentDateTime();

function SessionCheck(){
    if(empty($_SESSION['UserData']['user_id'])){
        return false;
    }else{
        return true;
    }
}

function Clean_Input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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