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
