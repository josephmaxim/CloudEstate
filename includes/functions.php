<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : function.php

// Main Login Function
function userLogin($userID,$pass){

    // Prepare the Query
    $result = pg_prepare(db_connect(), "my_query","SELECT * FROM users WHERE user_id=$1 AND password=$2");
    // Execute Query
    $result = pg_execute(db_connect(), "my_query", array($userID,hashPassword($pass)));

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
        setUserSessions($userData);

        // Update last access
        UpdateAccessDate($userData['userID']);

        return true;
    }else{
        return false;
    }

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

// register function
function InsertUser($data){

    // $data array key values
    //
    // 'user_id'
    // 'email'
    // 'accountType'
    // 'password'

    // encrypting password
    $data['password'] = encryptPassword($data['password']);

    // Prepare the Query
    pg_prepare(db_connect(), "Insert_Users","INSERT INTO users VALUES($1, $4, $3, $2, CURRENT_DATE, CURRENT_DATE);");
    // Execute Query
    $result = pg_execute(db_connect(), "Insert_Users", $data);

    if($result = true){
        return true;
    }
    else
    {
        return false;
    }
}

// get user profile
function getUserProfile($userID){

    // Prepare the Query
    $result = pg_prepare(db_connect(), "get_profile","SELECT 
        a.*,
        b.password,
        b.user_type,
        b.email_address,
        b.enrol_date,
        b.last_access
    FROM users AS b
    INNER JOIN people AS a
    ON b.user_id=a.user_id
    WHERE b.user_id=$1;");

    // Execute Query
    $result = pg_execute(db_connect(), "get_profile", array($userID));

    // Store data in row variable
    $row = pg_fetch_assoc($result);

    if($row){

        // prepare data for sessions
        $userData = array(
            'userID' => $row['user_id'],
            'password' => $row['password'],
            'email_address' => $row['email_address'],
            'user_type' => $row['user_type'],
            'enrol_date' => $row['enrol_date'],
            'last_access' => $row['last_access'],
            'salutation' => $row['salutation'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'street_address_1' => $row['street_address_1'],
            'street_address_2' => $row['street_address_2'],
            'city' => $row['city'],
            'province' => $row['province'],
            'postal_code' => $row['postal_code'],
            'primary_phone_number' => $row['primary_phone_number'],
            'secondary_phone_number' => $row['secondary_phone_number'],
            'fax_number' => $row['fax_number'],
            'preferred_contact_method' => $row['preferred_contact_method']
        );
        return $userData;
    }
}

// insert profile
function editUserProfile($userID, $inputData){
    $result1 =pg_prepare(db_connect(),'update_users', "UPDATE users SET email_address = $1, user_type = $2 WHERE user_id = '".$userID."';");

    // Execute SQL
    $result1 = pg_execute(db_connect(),'update_users', array($inputData['email_address'], $inputData['user_type'])) or die("Error while inserting.");


    $result2 = pg_prepare(db_connect(),'Update_people', "UPDATE people
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


// set user sessions function
function setUserSessions($data){
    $_SESSION['userData'] = array(
        'userID' => $data['userID'],
        'password' => $data['password'],
        'email_address' => $data['email_address'],
        'user_type' => $data['user_type'],
        'enrol_date' => $data['enrol_date'],
        'last_access' => $data['last_access']
    );
    setCookieSession($data);
}

// Set cookie session
function setCookieSession($data){
    if(!isset($_COOKIE["userLogin"])) {
        setcookie('userLogin', $data, time() + TIMEOUT, "/");
    }
}

//Update user access date
function UpdateAccessDate($user_id){
    // Prepare SQL
    pg_prepare(db_connect(),'Update_access', "UPDATE users SET last_access = CURRENT_DATE WHERE user_id = $1;");

    // Execute SQL
    pg_execute(db_connect(),'Update_access', array($user_id)) or die("Error while inserting.");
}

// Check user sessions
function SessionCheck(){
    if(isset($_SESSION['userData']['userID'])){
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

function display_phone_number($number){

    if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $number,  $matches ) )
    {
        $result = '(' . $matches[1] . ') ' .$matches[2] . '-' . $matches[3];
        return $result;
    }
}

//function by Roshan Bhattara(http://roshanbh.com.np)
////function to validate postal code of canada
function is_valid_postal_code($zip_code)
{
    if(preg_match("/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i",$zip_code))
        return true;
    else
        return false;
}
function createPostalCode()
{
    // Format: X1X1X1
    $alphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    //First Letter       // First Digit  //Second Letter
    $postal_code = $alphabet[rand(0, 25)] . rand(0, 9) . $alphabet[rand(0,25)] . rand(0, 9) . $alphabet[rand(0,25)] . rand(0,9);

    return $postal_code;

}