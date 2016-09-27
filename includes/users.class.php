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

        $query = "SELECT * FROM users WHERE email_address='$email'";
        $result = pg_query(db_connect(), $query);
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

    public function UpdateUser($email, $password, $userType){

    }

    public function DeleteUser($userId){

    }


}