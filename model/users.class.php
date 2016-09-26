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
            for($i = 0; $ri < $numrows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo " <td>", $row["fname"], "</td>";
            }
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