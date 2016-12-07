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
// get pending agents
function GetPendingAgents(){
    $pendingAgents = array();
    // Prepare the Query
    pg_prepare(db_connect(), "GetPendingAgents","SELECT * FROM users WHERE user_type = '".PENDING_AGENT."'");
    // Execute Query
    $result = pg_execute(db_connect(), "GetPendingAgents", array());

    if(pg_num_rows($result) > 0){
        while ($row = pg_fetch_array($result)){
            array_push($pendingAgents, $row);
        }
    }
    return $pendingAgents;

}

// get pending agents
function GetDisabledUsers(){
    $data = array();
    // Prepare the Query
    pg_prepare(db_connect(), "GetDisabledUsers","SELECT * FROM users WHERE user_type = '".SUSPENDED_USER."'");
    // Execute Query
    $result = pg_execute(db_connect(), "GetDisabledUsers", array());

    if(pg_num_rows($result) > 0){
        while ($row = pg_fetch_array($result)){
            array_push($data, $row);
        }
    }
    return $data;

}
// enable agent
function EnableAgent($user_id){
    $rand = rand(100000,999999);
    // Prepare SQL
    pg_prepare(db_connect(), "$rand", "UPDATE users SET user_type = '".AGENT."' WHERE user_id = $1;");

    // Execute SQL
    $result = pg_execute(db_connect(),"$rand", array($user_id)) or die("Error while inserting.");

    return $result;
}
// enable user
function EnableUser($user_id){
    $rand = rand(100000,999999);
    // Prepare SQL
    pg_prepare(db_connect(), "$rand", "UPDATE users SET user_type = '".CLIENT."' WHERE user_id = $1;");

    // Execute SQL
    $result = pg_execute(db_connect(),"$rand", array($user_id)) or die("Error while inserting.");

    return $result;
}
// Reset password
function resetPassword($userID, $email){
    // Prepare the Query
    pg_prepare(db_connect(), "Insert_Users","SELECT users.user_id, users.email_address FROM users WHERE user_id=$1 AND email_address=$2");
    // Execute Query
    $result = pg_execute(db_connect(), "Insert_Users", array($userID, $email));

    if(pg_num_rows($result) != 0){
        $newStringPassword = generateRandomString();
        $newEncryptedPassword = encryptPassword($newStringPassword);

        $result = pg_query(db_connect(),"UPDATE users SET password = '$newEncryptedPassword' WHERE user_id = '$userID';");

        $to = $email;
        $subject = "Account Password Reset";
        $txt = '<table width="600" cellpadding="0" cellspacing="0" align="center"><tr><td width="600"><h1>Cloud Estate Reset</h1><p>You can now access your cloud estate account using <strong>'.$newStringPassword.'</strong> as your new password.</p></td></tr></table>';

        mail($to,$subject,$txt);

        return true;
    }else{
        return false;
    }
}

// Generate 10 random char
function generateRandomString() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// Save Listing to favourites
function SaveListingToFavourites($user_id,$listing_id){
    pg_prepare(db_connect(), "save_fav","INSERT INTO favourites VALUES($1,$2);");
    // Execute Query
    $result = pg_execute(db_connect(), "save_fav", array($user_id,$listing_id));

    if($result){
        return true;
    }else{
        return false;
    }
}
// remove Listing to favourites
function RemoveListingToFavourites($user_id,$listing_id){
    $rand = rand(100000,999999);
    pg_prepare(db_connect(), "$rand","DELETE FROM favourites WHERE user_id = $1 AND listing_id = $2");
    // Execute Query
    $result = pg_execute(db_connect(), "$rand", array($user_id,$listing_id));

    if($result){
        return true;
    }else{
        return false;
    }
}

// report listing
function ReportListing($user_id,$listing_id){
    pg_prepare(db_connect(), "ReportListing","INSERT INTO reports VALUES($1,$2,CURRENT_DATE,'".OPEN."');");
    // Execute Query
    $result = pg_execute(db_connect(), "ReportListing", array($user_id,$listing_id));

    if($result){
        return true;
    }else{
        return false;
    }
}

// update report status
function UpdateReportStatus($user_id,$listing_id){
    pg_prepare(db_connect(),'UpdateReportStatus', "UPDATE reports SET status ='".CLOSED."' WHERE user_id = $1 AND listing_id = $2;");

    // Execute SQL
    $result = pg_execute(db_connect(),'UpdateReportStatus', array($user_id, $listing_id)) or die("Error while inserting.");
}
// check if user already reported
function CheckIfUserReported($user_id,$listing_id){
    pg_prepare(db_connect(), "Check_report","SELECT * FROM reports WHERE user_id = $1 AND listing_id = $2");
    // Execute Query
    $result = pg_execute(db_connect(), "Check_report", array($user_id,$listing_id));

    if(pg_num_rows($result) != 0){
        return true;
    }else{
        return false;
    }
}
// get all reported listing
function GetAllReportedListing(){
    $data = array();
    pg_prepare(db_connect(), "GetAllReportedListing","SELECT * FROM reports WHERE status = '".OPEN."' ORDER BY reported_on DESC");
    // Execute Query
    $result = pg_execute(db_connect(), "GetAllReportedListing", array());

    if(pg_num_rows($result) > 0){
        while ($row = pg_fetch_array($result)){
            array_push($data, $row);
        }
    }

    return $data;
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

// Disable listing
function DisableUser($user_id){
    // Prepare SQL
    pg_prepare(db_connect(),'DisableUser', "UPDATE users SET user_type = 'X' WHERE user_id = $1;");

    // Execute SQL
    $result = pg_execute(db_connect(),'DisableUser', array($user_id)) or die("Error while inserting.");

    $deleteFav = pg_query(db_connect(), "DELETE FROM favourites WHERE user_id='$user_id'");

    return $result;
}
// checks user favourite
function CheckUserFavourite($listing_id, $user_id){
    pg_prepare(db_connect(),'DisableUser', "SELECT * FROM favourites WHERE listing_id = $1 AND user_id = $2");

    // Execute SQL
    $result = pg_execute(db_connect(),'DisableUser', array($listing_id,$user_id)) or die("Error while inserting.");

    if(pg_num_rows($result) == 0){
        return false;
    }else{
        return true;
    }
}
// get user favourites
function GetUserFavourites($user_id){
    $favourites = array();

    pg_prepare(db_connect(), 'getAgentListings', "SELECT * FROM favourites WHERE user_id = $1");

    $result = pg_execute(db_connect(), 'getAgentListings', array($user_id));

    if(pg_num_rows($result) > 0){
        while ($row = pg_fetch_array($result)){
            array_push($favourites, $row);
        }
    }

    return $favourites;
}

// Get all user info
function GetUserProfileInfo($userID){

    $sql = "SELECT 
                p.*, 
                u.password,
                u.email_address,
                u.user_type,
                u.enrol_date,
                u.last_access
            FROM people AS p
            INNER JOIN users AS u
            ON p.user_id=u.user_id
            WHERE p.user_id='$userID'; ";
    $result = pg_query(db_connect(), $sql);

    $row = pg_fetch_assoc($result);

    return $row;
}
// edit user profile
function editUserProfile($userID, $inputData){
    pg_prepare(db_connect(),'update_users', "UPDATE users SET email_address = $1, user_type = $2 WHERE user_id = '".$userID."';");

    // Execute SQL
    $result1 = pg_execute(db_connect(),'update_users', array($inputData['email_address'], $inputData['user_type'])) or die("Error while inserting.");


    pg_prepare(db_connect(),'Update_people', "UPDATE people
        SET 
        salutation = $1,
        first_name = $2,
        last_name = $3,
        street_address_1 = $4,
        street_address_2 = $5,
        city = $6,
        province = $7,
        postal_code = $8,
        primary_phone_number = $9,
        secondary_phone_number = $10,
        fax_number = $11,
        preferred_contact_method = $12
        WHERE user_id = '".$userID."';");

    // Execute SQL
    $result2 = pg_execute(db_connect(),'Update_people', array(
        $inputData['salutation'],
        $inputData['first_name'],
        $inputData['last_name'],
        $inputData['street_address_1'],
        $inputData['street_address_2'],
        $inputData['city'],
        $inputData['province'],
        $inputData['postal_code'],
        $inputData['primary_phone_number'],
        $inputData['secondary_phone_number'],
        $inputData['fax_number'],
        $inputData['preferred_contact_method'])) or die("Error while inserting.");

    if($result1==true && $result2==true){
        return true;
    }else{
        return false;
    }
}
// Disable listing
function DisableListing($listing_id){
    // Prepare SQL
    pg_prepare(db_connect(),'Disable_listing', "
        UPDATE 
            listings 
        SET 
            status = 'c'
        WHERE 
            listing_id = $1;");

    // Execute SQL
    $result = pg_execute(db_connect(),'Disable_listing', array($listing_id)) or die("Error while inserting.");

    return $result;
}

// Update listing
function UpdateListing($listing_id,$data){
    // Prepare SQL
    pg_prepare(db_connect(),'Update_listing', "
        UPDATE 
            listings 
        SET 
            headline = $1,
            description = $2,
            price = $3,
            status = $4,
            postal_code = $5,
            city = $6,
            property_options = $7,
            bedrooms = $8,
            bathrooms = $9,
            listing_type = $10,
            storey = $11,
            building_type = $12
        WHERE 
            listing_id = $listing_id;");

    // Execute SQL
    $result = pg_execute(db_connect(),'Update_listing', $data) or die("Error while inserting.");

    return $result;
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

// set Main Image
function setMainImage($listing_id,$value){
    pg_prepare(db_connect(),'Update_listing', "
        UPDATE 
            listings 
        SET 
           images = $1
        WHERE 
            listing_id = $listing_id;");

    // Execute SQL
    $result = pg_execute(db_connect(),'Update_listing', array($value)) or die("Error while inserting.");

    return $result;
}

// get province
function getAllProvince(){
    global $province_city;
    $provinceData = array();
    foreach($province_city as $province => $city){
            array_push($provinceData,$province);
    }
    asort($provinceData);
    return $provinceData;
}

 // function that gets agent listings
function getAgentListings($order,$userID){
    $listings = array();

    if($order == CLOSED){ // all
        pg_prepare(db_connect(), 'getAgentListings', "SELECT * FROM listings WHERE user_id = $1 AND status = '".CLOSED."' ORDER BY listed_date DESC");
    }elseif($order == SOLD){ // sold
        pg_prepare(db_connect(), 'getAgentListings', "SELECT * FROM listings WHERE user_id = $1 AND status = '".SOLD."' ORDER BY listed_date DESC");
    }elseif($order == OPEN){ // open
        pg_prepare(db_connect(), 'getAgentListings', "SELECT * FROM listings WHERE user_id = $1 AND status = '".OPEN."' ORDER BY listed_date DESC");
    }elseif($order == HIDDEN){ // open
        pg_prepare(db_connect(), 'getAgentListings', "SELECT * FROM listings WHERE user_id = $1 AND status = '".HIDDEN."' ORDER BY listed_date DESC");
    }else{
        pg_prepare(db_connect(), 'getAgentListings', "SELECT * FROM listings WHERE user_id = $1 ORDER BY listed_date DESC");
    }

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
// get listing
function getListingData($id){
    $rand = rand(100000,999999);
    pg_prepare(db_connect(), "$rand", "SELECT * FROM listings WHERE listing_id = $1");

    $result = pg_execute(db_connect(), "$rand", array($id));

    if(pg_num_rows($result) > 0){
        $listingData = pg_fetch_assoc($result);
    }

    return $listingData;
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