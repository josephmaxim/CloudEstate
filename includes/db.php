<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : db.php

// Connect to psql database
function db_connect(){

    $db_connection = pg_connect("host=".DBHOST." dbname=".DBNAME." user=".DBUSER." password=".DBPASS);

    return $db_connection;
}

// Check if user id exist in the database
function is_user_id($userID){

    pg_prepare(db_connect(), "check_userID","SELECT user_id FROM users WHERE user_id=$1");
    // Execute Query
    $result = pg_execute(db_connect(), "check_userID", array($userID));

    if(pg_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

// Check if listing id exist in the database
function listingIDExists($id){

    pg_prepare(db_connect(), "check_userID","SELECT listing_id FROM listings WHERE listing_id=$1");
    // Execute Query
    $result = pg_execute(db_connect(), "check_userID", array($id));

    if(pg_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

function build_simple_dropdown($name,$arrayData){

    global $stickySessions;
    echo '<div class="form-group">';
    echo '<label for="'.$name.'">'.$name.'</label><select class="form-control"  name="'.$name.'" id="type">';
    echo '<option value="0" disabled selected>Select '.$name.'</option>';

    foreach ($arrayData as $val){
        echo '<option value="'. $val .'"';
        if(isset($stickySessions[$name])){
            if($stickySessions[$name] == $val){
                echo ' selected="selected"';
            }
        }

        echo '>'.$val.'</option>';
    }

    echo '</select></div>';
}

function build_dropdown($tableName){
    global $stickySessions;
    pg_prepare(db_connect(), "$tableName","SELECT * FROM $tableName;");
    // Execute Query
    $result = pg_execute(db_connect(), "$tableName", array());

    echo '<div class="form-group">';
    echo '<label for="'.$tableName.'">'.$tableName.':</label>';
    echo '<select class="form-control mySelect"  name="'.$tableName.'" id="'.$tableName.'">';
    echo '<option value="" disabled selected>Select a '.$tableName.'</option>';
    while($row = pg_fetch_array($result)){
        echo '<option value="'. $row[0] .'"';

        if(isset($stickySessions[$tableName])){
            if($stickySessions[$tableName] == $row[0]){
                echo ' selected="selected"';
            }
        }


        echo '>'.$row['property'].'</option>';

    }
    echo '</select></div>';
}

function build_radio($tableName){

    global $stickySessions;

    pg_prepare(db_connect(), "$tableName","SELECT * FROM $tableName;");
    // Execute Query
    $result = pg_execute(db_connect(), "$tableName", array());

    echo '<div class="form-group">';
    echo '<label for="'.$tableName.'">'.$tableName.':</label>';

    while($row = pg_fetch_array($result)){
        echo '<div class="radio"><label><input type="radio" name="'.$tableName.'" value="'.$row[0].'"';
        if(isset($stickySessions[$tableName])){
            if($stickySessions[$tableName] == $row[0]){
                echo ' checked="checked" ';
            }
        }
        echo '>'.$row['property'].'</label></div>';
    }
    echo '</div>';
}

function get_property($tableName,$property){
    $query_name = rand(0,9999999999);
    pg_prepare(db_connect(), $query_name,"SELECT property FROM $tableName WHERE property_id=$1");
    // Execute Query
    $result = pg_execute(db_connect(), $query_name, array($property));

    $row = pg_fetch_assoc($result);

    return $row['property'];
}