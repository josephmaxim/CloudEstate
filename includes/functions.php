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
 // function that gets agent listings
function getAgentListings($userID){
    $listings = array();

    pg_prepare(db_connect(), 'getAgentListings', "SELECT * FROM listings WHERE user_id = $1");

    $result = pg_execute(db_connect(), 'getAgentListings', array($userID));

    if(pg_num_rows($result) > 0){
        while ($row = pg_fetch_array($result)){
            array_push($listings, $row);
        }
    }

    return $listings;
}

//get listings based on city
function getListingsOnCity($city){
    $listings = array();
    $city .= "%";

    pg_prepare(db_connect(), 'getListingsOnCity', "SELECT * FROM listings WHERE city LIKE $1;");

    $result = pg_execute(db_connect(), 'getListingsOnCity', array($city));

    if(pg_num_rows($result) > 0){
        while ($row = pg_fetch_array($result)){
            array_push($listings, $row);
        }
    }

    return $listings;
}

// function get all advanced search listing
function getAllSearchedListings($searchData){
    $listings = array();

    pg_prepare(db_connect(), 'getAllSearchedListings', "SELECT * FROM listings WHERE status = $1 AND city = $2 AND property_options = $3 AND bedrooms = $4 AND bathrooms = $5 AND listing_type = $6 AND storey = $7 AND building_type = $8 ORDER BY listing_id DESC LIMIT 200");

    $result = pg_execute(db_connect(), 'getAllSearchedListings', $searchData);

    if(pg_num_rows($result) > 0){
        while ($row = pg_fetch_array($result)){
            array_push($listings, $row);
        }
    }

    return $listings;
}
//
function listing_preview($listing_id){
    $listings = array();

    pg_prepare(db_connect(), 'getAllSearchedListings', "SELECT * FROM listings WHERE listing_id = $1 LIMIT 10");

    $result = pg_execute(db_connect(), 'getAllSearchedListings', array($listing_id));

    if(pg_num_rows($result) > 0){
        while ($row = pg_fetch_array($result)){
            array_push($listings, $row);
        }
    }

    return $listings;
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



/*
 *  NOTE : we never used this two function. we did the sticky radio/select in a different way to work on what we already have.
 *
	this function should be passed a integer power of 2, and any decimal number,
	it will return true (1) if the power of 2 is contain as part of the decimal argument
*/
function isBitSet($power, $decimal) {
    if((pow(2,$power)) & ($decimal))
        return 1;
    else
        return 0;
}

/*
	this function can be passed an array of numbers (like those submitted as
	part of a named[] check box array in the $_POST array).
*/
function sumCheckBox($array)
{
    $num_checks = count($array);
    $sum = 0;
    for ($i = 0; $i < $num_checks; $i++)
    {
        $sum += $array[$i];
    }
    return $sum;
}

?>