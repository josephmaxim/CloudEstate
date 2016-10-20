<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : index.php

session_start();

$title = "Cloud Estate | Home";

include('header.php');
include ('includes/functions.php');
include('names.php');

	$user_id_array = array();
	$user_first_array = array();
	$user_last_array = array();
	$gender_array = array();
	
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
	
	echo "<table border=\"1\">";
	echo "<tr><td><b>USER</b></td><td><b>PASS</b></td><td><b>E-MAIL<b/></td><td><b>ACCOUNT TYPE</b></td><td><b>ENROLL DATE</b></td><td><b>LAST ACCESS</b></td></tr>";
	
	// This loop sequence will run through all three arrays of names to randomly assign 50 males and 50 females to the user_first_last array 
	for ($counter = 0; $counter < 100; $counter++)
	{	
		if ($counter % 2 == 0)
		{
			strtolower($first = $male_names[rand(0, $m_names_length)]);
			$gender_array[$counter] = 0;
		}
		else
		{
			strtolower($first = $female_names[rand(0, $f_names_length)]);
			$gender_array[$counter] = 1;
		}
		
		$last = strtolower($last_names[rand(0, $last_names_length)]);
		$user_ID = strtolower(substr($first, 0, 1)) . $last;
		array_push($user_id_array, $user_ID);
		array_push($user_first_array, $first);
		array_push($user_last_array, $last);
		$email = strtolower($first) . "." . $last . "@dcmail.ca";
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
		
		echo "<tr><td>".$user_ID."</td><td>".$password."</td><td>".$email."</td><td>".$account_type."</td><td>".enroll_date."</td><td>".last_access."</td></tr>";
	}
	
	echo "</table>";
	

	echo "<table border=\"1\">";
	echo "<tr><td><b>USER ID</b></td><td><b>SALUTATION</b></td><td><b>FIRST NAME<b/></td><td><b>LAST NAME</b></td><td><b>STREET ADDRESS 1</b></td><td><b>STREET ADDRESS 2</b></td><td><b>CITY</b></td><td><b>PROVINCE</b></td>";
	echo "<td><b>POSTAL CODE</b></td><td><b>PRIMARY PHONE</b></td><td><b>SECONDARY PHONE<b/></td><td><b>FAX NUMBER</b></td><td><b>PREFERRED CONTACT METHOD</b></td></tr>";
	
	
	for ($counter = 0; $counter < 100; $counter++)
	{
		$rand = rand(0, 99);
		$user_ID = $user_id_array[$counter];
		
		if ($gender_array[$counter] == 0)
		{
			if ($rand > 0 && $rand < 80)
			{
				$salutation = "Mr.";
			}
			else if ($rand >= 80 && $rand < 90)
			{
				$salutation = "Sir.";
			}
			else if ($rand >= 90 && $rand <= 99)
			{
				$saltation = "Dr.";
			}
		}
		else if ($gender_array[$counter] == 1)
		{
			if ($rand > 0 && $rand < 40)
			{
				$salutation = "Ms.";
			}
			else if ($rand >= 40 && $rand < 90)
			{
				$salutation = "Mrs.";
			}
			else if ($rand >= 90 && $rand <= 99)
			{
				$saltation = "Dr.";
			}
		}
		
		$first = strtolower($user_first_array[$counter]);
		$last = strtolower($user_last_array[$counter]);
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
			
			echo "<tr><td>".$user_ID."</td><td>".$saltation."</td><td>".$first."</td><td>".$last."</td><td>".$street_address_1."</td>
			<td>".$street_address_2."</td><td>".$city."</td><td>".$province."</td>";
			echo "<td>".$postal_code."</td><td>".$phone_number."</td><td>".$second_phone_number."</td><td>".$fax_number."</td><td>".$preferred_contact_method."</td></tr>";
	}
	
	
	echo "</table>";
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
include('footer.php');
?>