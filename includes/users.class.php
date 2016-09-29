<?php

class Users
{
    private $userId;
    private $password;
    private $userType;
    private $emailAddress;
    private $enrolDate;
    private $lastAccess;


    public function getUserId() {
        return $this->userId;
    }

    private function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getPassword() {
        return $this->password;
    }

    private function setPassword($password) {
        $this->password = $password;
    }

    public function getUserType() {
        return $this->userType;
    }

    private function setUserType($userType) {
        $this->userType = $userType;
    }

    public function getEmailAddress() {
        return $this->emailAddress;
    }

    private function setEmailAddress($emailAddress) {
        $this->emailAddress = $emailAddress;
    }

    public function getEnroldate() {
        return $this->enrolDate;
    }

    private function setEnroldate($enrolDate) {
        $this->enrolDate = $enrolDate;
    }

    public function getLastAccess() {
        return $this->lastAccess;
    }

    private function setLastAccess($lastAccess) {
        $this->lastAccess = $lastAccess;
    }



    public function GetUser($email){

        $dbconn = db_connect();

        $result = pg_prepare($dbconn, "my_query","SELECT * FROM users WHERE email_address=$1");
        $result = pg_execute($dbconn, "my_query", array("$email"));

        $row = pg_fetch_assoc($result);

        if($row){
            $this->setUserId($row['user_id']);
            $this->setPassword($row['password']);
            $this->setEmailAddress($row['email_address']);
            $this->setUserType($row['user_type']);
            $this->setEnroldate($row['enrol_date']);
            $this->setLastAccess($row['last_access']);
            return true;
        }else{
            return false;
        }
    }

    public function GetAllUsers(){

    }

    public function AddUser($email, $password){

    }

    public function UpdateUser($email, $password, $userType, $last_access){
        $dbconn = db_connect();

        pg_prepare($dbconn, "my_query","UPDATE users SET email_address=$1, password=$2, user_type=$3, last_access=$4 WHERE email_address='". $this->getEmailAddress() ."';");
        pg_execute($dbconn, "my_query", array("$email", "$password", "$userType", "$last_access"));

    }

    public function DeleteUser($userId){

    }


}