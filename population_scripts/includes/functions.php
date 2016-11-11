<?php
// function get all agent userID
function getAllAgentID(){
    $userID = array();
    $qry = "SELECT user_id FROM users WHERE user_type='A'";

    $result = pg_query(db_connect(), $qry);

    while($row = pg_fetch_array($result)){
        array_push($userID, $row['user_id']);
    }

    return $userID;
}

function CheckUserID($userID){
    // Prepare the Query
    $sql = "SELECT user_id FROM users WHERE user_id='$userID'";

    $result = pg_query(db_connect(), $sql);

    if(pg_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

function fakePostalCode(){
    $a = array("A","B","C","E","G","H","J","K","L","M","N","P","R","S","T","V","W","X","Y","Z");
    $zip = $a[rand(0,count($a)-1)].rand(0,9).$a[rand(0,count($a)-1)].rand(0,9).$a[rand(0,count($a)-1)].rand(0,9);
    return $zip;
}

function randomString($length = 1) {
    $str = "";
    $characters = array_merge(range('a','z'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}

function randomDescription(){
    $lorem = array("lorem", "ipsum", "dolor", "sit", "amet", "consectetuer",
        "adipiscing", "elit", "sed", "diam", "nonummy", "nibh", "euismod",
        "tincidunt", "ut", "laoreet", "dolore", "magna", "aliquam", "erat");
    $string = '';
    for($i = 0; $i <= 30; $i++){
        $string .= $lorem[rand(0,count($lorem)-1)] . " ";
    }

    return $string;
}

?>