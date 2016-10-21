<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : index.php

session_start();

$title = "Cloud Estate | Home";

include('includes/header.php');
include ('includes/functions.php');
include('names.php');

	$street_names = array("Rose Street", "Academy Street", "3rd Street West", "Fawn Lane", "Church Street North", "Main Street West", "5th Street West", "Washington Avenue", "Main Street South", "Inverness Drive");
	$provinces = array("BC", "SA", "MA", "AL", "ON", "QB", "NS", "NL", "PE");
	
	// Variable declarations for the length of the 3 arrays being dealt with in this script for efficient access in comparison 
	$last_names_length = count($last_names);
	$m_names_length = count($male_names);
	$f_names_length = count($female_names);
	
	
	// Constants defined for the date that all samples users last accessed and enrolled 
	DEFINE('enroll_date', "2016-10-19");
	DEFINE('last_access', "2016-10-19");
	DEFINE('ADMIN', "S");
	DEFINE('AGENT', "A");
	DEFINE('PENDING_AGENT', "P");
	DEFINE('CLIENT', "C");
	DEFINE('SUSPENDED_USER', "X");
	
if (isset($_POST['submit']))
{

	// This loop sequence will run through all three arrays of names to randomly assign 50 males and 50 females to the user_first_last array 
	for ($counter = 0; $counter < 100; $counter++)
	{	
		$data_users = array();
		$data_people = array();
		
	
		$r = rand(0, 3);
	
		if ($r == 0)
		{
			$first = $male_names[rand(0, $m_names_length)];
			$salutation = "Mr.";
		}
		else if ($r == 1)
		{
			$first = $male_names[rand(0, $m_names_length)];
			
			$salutation = "Mr.";
		}
		else if ($r == 2)
		{
			$first = $female_names[rand(0, $f_names_length)];
			
			$salutation = "Ms.";
		}
		else if ($r == 3)
		{
			$first = $female_names[rand(0, $f_names_length)];
			
			$salutation = "Mrs.";
		}
		
		$last = $last_names[rand(0, $last_names_length)];
		$user_ID = substr($first, 0, 1) . $last;
		$email = $first . "." . $last . "@dcmail.ca";
		$password = hashPassword(encryptPassword("testing" . $counter));
		$account_type = 'C';
		$preferred_contact_method = 'e';
		// Client = 50% chance, Agent = %20 chance, Pending Agent = 15% chance, Suspended User = 15% chance 
		$rand_account = rand(0, 100);
		
		if ($rand_account >= 0 && $rand_account < 50)
		{
			$account_type = CLIENT;
		}
		else if ($rand_account >= 50 && $rand_account < 70)
		{
			$account_type = AGENT;
		} 
		else if ($rand_account >= 70 && $rand_account < 85)
		{
			$account_type = PENDING_AGENT;
		} 
		else if ($rand_account >= 85 && $rand_account < 100)
		{
			$account_type = SUSPENDED_USER;
		} 
	
		$data_users[0] = $user_ID;
		$data_users[1] = $password;
		$data_users[2] = $email;
		$data_users[3] = $account_type;
	
	
	
	
		// People table
	
		$rand = rand(0, 99);

		$street_address_1 = rand(1, 1000) . ' ' . $street_names[rand(0, 9)];
		$street_address_2 = "  ";
		$province = $provinces[rand(0, 8)];
		
		if ($province == "BC")
		{
			$r = rand(0,1);
			if ($r == 0)
			{
				$city = "Vancouver";
			}
			else
			{
				$city = "Victoria";
			}
		}
		else if ($province == "SA")
		{
			$r = rand(0,1);
			if ($r == 0)
			{
				$city = "Regina";
			}
			else
			{
				$city = "Saskatoon";
			}
		}
		else if ($province == "MA")
		{
			$r = rand(0,1);
			if ($r == 0)
			{
				$city = "Winnipeg";
			}
			else
			{
				$city = "Brandon";
			}
		}
		else if ($province == "AL")
		{
			$r = rand(0,1);
			if ($r == 0)
			{
				$city = "Calgary";
			}
			else
			{
				$city = "Edmonton";
			}
		}
		else if ($province == "ON")
		{
			$r = rand(0,1);
			if ($r == 0)
			{
				$city = "Toronto";
			}
			else
			{
				$city = "Whitby";
			}
		}
		else if ($province == "QB")
		{
			$r = rand(0,1);
			if ($r == 0)
			{
				$city = "Montreal";
			}
			else
			{
				$city = "Quebec City";
			}
		}
		else if ($province == "NS")
		{
			$r = rand(0,1);
			if ($r == 0)
			{
				$city = "Cape Breton";
			}
			else
			{
				$city = "Halifax";
			}
		}
		else if ($province == "NL")
		{
			$r = rand(0,1);
			if ($r == 0)
			{
				$city = "St. Johns";
			}
			else
			{
				$city = "Mount Pearl";
			}
		}
		else if ($province == "PE")
		{
			$r = rand(0,1);
			if ($r == 0)
			{
				$city = "Charlottetown";
			}
			else
			{
				$city = "Summerside";
			}
		}
		else
		{
			$city = "Nowhere Land";
		}
		
		$postal_code = createPostalCode();
		$phone_number = rand(1000000000, 9999999999);
		$second_phone_rand = rand(0, 3);
		if ($second_phone_rand == 0)
		{
			$second_phone_number = rand(1000000000, 9999999999);
		}
		else
		{
			$second_phone_number = "";
		}
		$fax_number = rand(1000000000, 9999999999);
		
		$preferred_contact_rand = rand(0, 99);
		if ($preferred_contact_rand > 0 && $preferred_contact_rand < 80)
			{
				$preferred_contact_method = "e";
			}
			else if ($rand >= 80 && $rand < 90)
			{
				$preferred_contact_method = "p";
			}
			else if ($rand >= 90 && $rand < 100)
			{
				$preferred_contact_method = "l";
			}
			
		$data_people[0] = $user_ID;
		$data_people[1] = $first;
		$data_people[2] = $last;
		$data_people[3] = $street_address_1;
		$data_people[4] = $street_address_2;
		$data_people[5] = $province;
		$data_people[6] = $city;
		$data_people[7] = $postal_code;
		$data_people[8] = $phone_number;
		$data_people[9] = $second_phone_number;
		$data_people[10] = $second_phone_number;
		$data_people[11] = $second_phone_number;
		$data_people[12] = $fax_number;
		$data_people[13] = $preferred_contact_method;
	}
	
	// Prepare the Query
    	pg_prepare(db_connect(), "Insert_Users","INSERT INTO users VALUES($1, $4, $3, $2, CURRENT_DATE, CURRENT_DATE);");
    	// Execute Query
    	$result = pg_execute(db_connect(), "Insert_Users", $data_users);
    	
    	// Prepare the Query
    	pg_prepare(db_connect(), "Insert_Users","INSERT INTO users VALUES($1, $4, $3, $2, CURRENT_DATE, CURRENT_DATE);");
    	// Execute Query
    	$result = pg_execute(db_connect(), "Insert_Users", $data_people);
	
}
	

	
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
	<div class="container">
    	<br />
    	<br />
    	<h1 class="text-center">Welcome to Cloud Estate</h1>
    	<br />
    	<br />
		<input type="submit" value = "Populate User Table" name="submit" />
	</div>
</form>
<?php
include('includes/footer.php');
?>