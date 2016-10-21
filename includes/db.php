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

function build_simple_dropdown($value){

    // pull from databse

    echo '<div class="form-group">';
    echo '<select class="form-control mySelect"  name="type" id="type">';
    echo '<option value="0" disabled selected>Select an account type(Client/Agent)</option>';
    foreach ($value as $val){
        echo '<option value="'. $val .'">';

        if($val == CLIENT){
            echo 'I am a client';
        }elseif ($val == AGENT){
            echo 'I am an agent';
        }

        echo '</option>';
    }
    echo '</select></div>';
}

function build_dropdown($value){
    echo '<div class="form-group">';
    echo '<select class="form-control mySelect"  name="type" id="type">';
    foreach ($value as $val){
        echo '<option value="'. $val .'">';

        if($val == CLIENT){
            echo 'I am a client';
        }elseif ($val == AGENT){
            echo 'I am an agent';
        }

        echo '</option>';
    }
    echo '</select></div>';
}

function build_radio(){

}

function get_property(){

}