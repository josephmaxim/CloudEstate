<?php
/**
 *
 *  Group #     : 15
 *  @author     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
 *  File name   : users.class.php
 */
class Users
{
    // Define private variables
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


    /**
     * Get User Credentials from the database
     *
     * @param string $user_id
     * @return boolean
     */
    public function GetUser($user_id){

        // Prepare the Query
        $result = pg_prepare(db_connect(), "my_query","SELECT * FROM users WHERE user_id=$1");
        // Execute Query
        $result = pg_execute(db_connect(), "my_query", array($user_id));

        // Store data in row variable
        $row = pg_fetch_assoc($result);

        // Checks if row exist
        if($row){

            // Set user credentials to class variables
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

    /**
     * Get all users from the database
     *
     * @return object
     */
    public function GetAllUsers(){

    }

    /**
     * Update the last_access date of a user
     *
     * @param string $user_id
     * @param string $date
     * @return null
     */
    public function UpdateAccessDate($user_id, $date){

        $sql = "UPDATE users SET last_access = $1 WHERE user_id = '".$user_id."';";
        // Prepare SQL
        pg_prepare(db_connect(),'Update_access', $sql);

        // Execute SQL
        pg_execute(db_connect(),'Update_access', array($date)) or die("Error while inserting.");
    }


}