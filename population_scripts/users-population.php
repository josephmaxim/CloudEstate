<?php
include_once('../includes/functions.php');
include_once('includes/functions.php');
include_once('../includes/db.php');
include_once('includes/header.php');
include_once('../includes/constants.php');
include_once('includes/names.php');
include_once('includes/city_provinces.php');

$users_data = array();
$people_data = array();
$rendered = false;
$account_type = array(AGENT,PENDING_AGENT,CLIENT,SUSPENDED_USER);
$male_salutation = array("Mr.","Prof.","Dr.","Rev.");
$female_salutation = array("Mrs.","Ms.","Miss","Prof.","Dr.","Rev.");
$email_providers = array("dcmail.ca","yahoo.com","gmail.com","live.com","hotmail.com");
$contact = array(EMAIL,PHONE,POSTED_MAIL);
$password = encryptPassword("test123");
$streetSuffix = array("Dr.","Ave.","St.");

if(isset($_POST['populate'])){

    for($count = 1; $count <= 100; $count++){

        $gender = 2;
        $streetNum = rand(10,99);
        $streetName = ucwords(strtolower($last_names[rand(0,count($last_names)-1)]));
        $address = "".$streetNum." ".$streetName." ".$streetSuffix[rand(0,count($streetSuffix)-1)];
        $province = array_keys($province_city)[0];
        $city = $province_city[$province][rand(0,count($province_city[$province])-1)];
        $postal = fakePostalCode();
        $phone = rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);
        $ContactMethod = $contact[rand(0,count($contact)-1)];

        if(rand(0,1) == 1){
            $phone2 = "";
        }else{
            $phone2 = rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);
        }

        if(rand(0,1) == 1){
            $fax = "";
        }else{
            $fax = rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);
        }

        // generate male account
        if($gender == 1){

            do{
                $firstName = strtolower($male_names[rand(0,count($male_names)-1)]);
                $lastName = strtolower($last_names[rand(0,count($last_names)-1)]);
                $userID = $lastName . substr($firstName,0,1);
                $email = strtolower($firstName.".".$lastName."@".$email_providers[rand(0,count($email_providers)-1)]);
                $user_type = $account_type[rand(0,count($account_type)-1)];
                $salutation = $male_salutation[rand(0,count($male_salutation)-1)];
            }while(CheckUserID($userID) == true);
        }
        // generate female account
        elseif($gender == 2){

            do{
                $firstName = strtolower($female_names[rand(0,count($female_names)-1)]);
                $lastName = strtolower($last_names[rand(0,count($last_names)-1)]) ;
                $userID = $lastName . substr($firstName,0,1);
                $email = strtolower($firstName.".".$lastName."@".$email_providers[rand(0,count($email_providers)-1)]);
                $user_type = $account_type[rand(0,count($account_type)-1)];
                $salutation = $female_salutation[rand(0,count($female_salutation)-1)];
            }while(CheckUserID($userID) == true);
        }

        array_push($users_data,array($userID,$email,$password,$user_type));
        array_push($people_data,array($userID,$salutation,$firstName,$lastName,$address,"",$city,$province,$postal,$phone,$phone2,$fax,$ContactMethod));


    }
    // populate users
    foreach($users_data as $user){

        // Prepare SQL
        pg_prepare(db_connect(), $user[0], "INSERT INTO users VALUES($1,$3,$4,$2, CURRENT_DATE, CURRENT_DATE);");

        // Execute SQL
        pg_execute(db_connect(),$user[0], $user) or die("Error while inserting.");


    }
    // populate people
    foreach($people_data as $people){
        $count = rand(0,99999);
        // Prepare SQL
        pg_prepare(db_connect(), $count, "INSERT INTO people VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13)");

        // Execute SQL
        pg_execute(db_connect(), $count, $people) or die("Error while inserting.");


    }

}
// get the total number of users
$sql = "SELECT user_id FROM users;";
$results = pg_query(db_connect(), $sql);
$count_results = pg_num_rows($results);
?>
    <div class="content">
        <div class="container-fluid">
            <div class="text-center">
                <h1>Users Population</h1>
                <p>Click the button to generate users.</p>
                <p>Total number of users: <strong><?php echo $count_results;?></strong></p>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <input class="btn btn-success" type="submit" value="Generate users/people" name="populate">
                </form>
            </div>
            <br/>
            <div class="panel panel-primary">
                <div class="panel-heading">Users Table Generated</div>
                <div class="panel-body">
                    <p>Note: All generated users account password is "test123".</p>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>User Type</th>
                        <th>Enrol Date</th>
                        <th>Last Access</th>
                    </tr>
                    </thead>
                    <tbody style="height:200px;">
                    <?php
                    if(!empty($users_data)){
                        foreach ($users_data as $users){
                            echo '<tr>';
                            foreach($users as $user){
                                echo "<td>".$user."</td>";
                            }
                            echo '<td>'.date("Y-m-d").'</td>';
                            echo '<td>'.date("Y-m-d").'</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">People Table Generated (100 people based on generated users)</div>
                <table class="people-table table table-striped">
                    <thead>
                    <tr>
                        <th>UserID</th>
                        <th>salutation</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Postal</th>
                        <th>Number 1</th>
                        <th>Number 2</th>
                        <th>Fax</th>
                        <th>Contact method</th>
                    </tr>
                    </thead>
                    <tbody style="height:200px;">

                    <?php
                    if(!empty($people_data)){
                        foreach ($people_data as $users){
                            echo '<tr>';
                            foreach($users as $key => $user){
                                echo "<td>".$user."</td>";
                            }
                            echo '</tr>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include_once('includes/footer.php');?>