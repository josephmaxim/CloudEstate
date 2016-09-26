<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : users.class.php

class Users
{
    private $userId;
    private $password;
    private $userType;
    private $emailAddress;
    private $enrolDate;
    private $lastAccess;

    private function getUserId() {
        return $this->userId;
    }

    private function setUserId($userId) {
        $this->userId = $userId;
    }

    private function getPassword() {
        return $this->password;
    }

    private function setPassword($password) {
        $this->password = $password;
    }

    private function getUserType() {
        return $this->userType;
    }

    private function setUserType($userType) {
        $this->userType = $userType;
    }

    private function getEmailAddress() {
        return $this->emailAddress;
    }

    private function setEmailAddress($emailAddress) {
        $this->emailAddress = $emailAddress;
    }

    private function getEnroldate() {
        return $this->enrolDate;
    }

    private function setEnroldate($enrolDate) {
        $this->enrolDate = $enrolDate;
    }

    private function getLastAccess() {
        return $this->lastAccess;
    }

    private function setLastAccess($lastAccess) {
        $this->lastAccess = $lastAccess;
    }



    public function GetUser($email){
        $userData = array();

        $query = "SELECT * FROM users WHERE email='$email'";
        $result = pg_query(db_connect(), $query);
        $records = pg_num_rows($result);

        // checks if there's a match
        if ($records === 1){
            $row = pg_fetch_array($result, 0, PGSQL_NUM);

            $this->setUserId($row["user_id"]);
            $this->setPassword($row["password"]);
            $this->setEmailAddress($row["email_address"]);
            $this->setUserType($row["user_type"]);
            $this->setEnroldate($row["enrol_date"]);
            $this->setLastAccess($row["last_access"]);

            // remove just for debugging.
            echo $this->getEmailAddress();

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