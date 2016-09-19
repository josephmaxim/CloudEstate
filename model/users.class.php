<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond
//  File name   : users.class.php

class Users
{
    public function __construct()
    {

    }

    public function GetAllUsers(){
        $usersArray = Array();



        return $usersArray;
    }

    public function GetUser($userID){

        $query = "SELECT * users WHERE user_id = '$userID'";

        $userArrayInfo = Array(
            'user_id' => "user_id",
            'password' => "password",
            'user_type' => "user_type",
            'email_address' => "email_address",
            'enrol_date' => "enrol_date",
            'last_access' => "last_access"
        );

        return $userArrayInfo;
    }

    public function UpdateUser($userID){

    }
}