<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : function.php

require_once('city_provinces.php');

function userLogin($userID, $password){

    // Prepare the Query
    pg_prepare(db_connect(), "login_query","SELECT * FROM users WHERE user_id=$1 AND password=$2");
    // Execute Query
    $result = pg_execute(db_connect(), "login_query", array($userID,hashPassword($password)));

    // Store data in row variable
    $row = pg_fetch_assoc($result);

    // Checks if row exist
    if($row){

        // prepare data for sessions
        $userData = array(
            'userID' => $row['user_id'],
            'password' => $row['password'],
            'email_address' => $row['email_address'],
            'user_type' => $row['user_type'],
            'enrol_date' => $row['enrol_date'],
            'last_access' => $row['last_access']
        );


        //Set user sessions
        setUserSession($userData);

        // Update last access
        UpdateAccessDate($userData['userID']);

        return true;
    }else{
        return false;
    }

}

// register function
function InsertUser($data){

    // $data array key values
    //
    // 'userID'
    // 'email'
    // 'accountType'
    // 'password'

    // encrypting password
    $data['password'] = encryptPassword($data['password']);

    // Prepare the Query
    pg_prepare(db_connect(), "Insert_Users","INSERT INTO users VALUES($1, $4, $3, $2, CURRENT_DATE, CURRENT_DATE);");
    // Execute Query
    $result = pg_execute(db_connect(), "Insert_Users", $data);

    // Prepare the Query
    pg_prepare(db_connect(), "Insert_People","INSERT INTO people VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13)");
    // Execute Query
    pg_execute(db_connect(), "Insert_People", array($data['userID'],'','','','','','','','','','','',EMAIL));

    if($result == true){
        return true;
    }else{
        return false;
    }
}

// Insert listing
function insertListing($listingData){

    pg_prepare(db_connect(), "Insert_Listing","INSERT INTO listings VALUES( DEFAULT, '".$_SESSION['userData']['userID']."', $1, $2, $3, $4, $5, 0, $6, $7, $8, $9, CURRENT_DATE, $10, $11, $12, 0, 0);");
    // Execute Query
    $result = pg_execute(db_connect(), "Insert_Listing", $listingData);

    if($result == true){
        return true;
    }else{
        return false;
    }
}
// Update password
function changePassword($pass){
    $pass = encryptPassword($pass);
    pg_prepare(db_connect(),'Update_access', "UPDATE users SET password = $1 WHERE user_id = '".$_SESSION['userData']['userID']."';");

    // Execute SQL
    $result = pg_execute(db_connect(),'Update_access', array($pass)) or die("Error while inserting.");

    if($result == true){
        $_SESSION['userData']['password'] = $pass;
        return true;
    }else{
        return false;
    }
}

// get city
function getAllCity(){
    global $province_city;
    $cityData = array();
    foreach($province_city as $province){
        foreach ($province as $city){
            array_push($cityData,$city);
        }
    }
    asort($cityData);
    return $cityData;
}

// function that checks input length
function CheckInputLength($string, $min, $max){
    $charCount = strlen($string);
    if($charCount >= $min && $charCount <= $max){
        return true;
    }else{
        return false;
    }
}

// sanitize user input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = htmlentities($data);
    return $data;
}

// Start user session
function setUserSession($userData){
    $_SESSION["userData"] = $userData;
}

// Check user sessions
function SessionCheck(){
    if(isset($_SESSION['userData']['userID'])){
        return true;
    }else{
        return false;
    }
}

//Update user access date
function UpdateAccessDate($user_id){
    // Prepare SQL
    pg_prepare(db_connect(),'Update_access', "UPDATE users SET last_access = CURRENT_DATE WHERE user_id = $1;");

    // Execute SQL
    pg_execute(db_connect(),'Update_access', array($user_id)) or die("Error while inserting.");
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

?>