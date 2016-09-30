<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : function.php

// include users table class
include_once('users.class.php');

// Main Login Function
function UserLogin($user_id, $password){

    // Set new Users class
    $user = new Users();

    // Check if user ID exist in the database
    if($user->GetUser($user_id) == true){

        // Check if password entered matches the ones on the database
        if($password == $user->getPassword()){

            // Update last access date
            $user->UpdateAccessDate($user_id, CurrentDateTime());

            // Prep user data for sessions
            $userData = array(
                'user_id' => $user->getUserId(),
                'password' => $user->getPassword(),
                'email' => $user->getEmailAddress(),
                'user_type' => $user->getUserType(),
                'enrol_date' => $user->getEnroldate(),
                'last_access' => $user->getLastAccess()
            );

            // Start sessions using prepared data
            StartUserSession($userData);
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

}

// Set user sessions
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

// Return Date and time
function CurrentDateTime(){
    date_default_timezone_set("America/Toronto");
    $date = date("M j, Y  g:i a");

    return $date;
}

// Checks is user session exist
function SessionCheck(){
    if(empty($_SESSION['UserData']['user_id'])){
        return false;
    }else{
        return true;
    }
}

// sanitize user input
function sanitizeInput($data) {
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


// Encrypt Password
function encryptPassword($password){
    $saltedPassword = $password . CSPRING;
    $encryptedPassword = md5($saltedPassword);
    return $encryptedPassword;
}

// Compare hash password to the string the user has entered.
function hashPassword($password){
    $saltedPassword = $password . CSPRING;
    $hashedPassword = hash("md5", $saltedPassword);
    return $hashedPassword;
}
