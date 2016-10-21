<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : db.php

// Connect to psql database
function db_connect(){

    $db_connection = pg_connect("host=".DBHOST." dbname=".DBNAME." user=".DBUSER." password=".DBPASS);

    return $db_connection;
}

// Check if user id exist in the database
function is_user_id($userID){
    // Prepare the Query
    $result = pg_prepare(db_connect(), "Check_User_ID","SELECT user_id FROM users WHERE user_id=$1");
    // Execute Query
    $result = pg_execute(db_connect(), "Check_User_ID", array($userID));

    // Store data in row variable
    $row = pg_fetch_assoc($result);

    if($row){
        return true;
    }else{
        return false;
    }
}

function build_simple_dropdown(){

}

function build_dropdown(){

}

function build_radio(){

}

function get_property(){

}