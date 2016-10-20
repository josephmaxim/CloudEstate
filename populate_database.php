<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : index.php

$title = "Cloud Estate | Home";

include('header.php');
include('names.php');
	
	// Declaration of the array that will store the calculated first and last names of the sample users and another array for all information needed to input into the database 
	$user_first_last = array();
	// User ID, Password, E-mail, User Access, Enroll Date, Last Access Date
	$user_information = array();
	
	$email_string = array();
	
	// Variable declarations for the length of the 3 arrays being dealt with in this script for efficient access in comparison 
	$last_names_length = count($last_names);
	$m_names_length = count($male_names);
	$f_names_length = count($female_names);
	
	// Constants defined for the date that all samples users last accessed and enrolled 
	DEFINE('enroll_date', "2016-10-19");
	DEFINE('last_access', "2016-10-19");

	// Information to be input to user_information array 
	$user_ID;
	
	// This loop sequence will run through all three arrays of names to randomly assign 50 males and 50 females to the user_first_last array 
	for ($counter = 0; $counter < 100; $counter++)
	{	
		$first, $last;

		if ($counter % 2 == 0)
		{
			$first = $male_names[rand(0, $m_names_length)];
		}
		else
		{
			$first = $female_names[rand(0, $f_names_length)];
		}
		
		$last = $last_names[rand(0, $last_names_length)];
		$user_ID = substr($first, 0, 1) . $last;
		$email = $first . "." . $last . "@dcmail.ca";
		$password = hashPassword(encryptPassword("testing" . $counter));

		$qry = "INSERT INTO users VALUES('".$user_ID."', '".$password."', '".$email."', 'a', '2016-10-20', '2016-10-20')";
		
		$result = pg_query(db_connect(), $qry);
	}
	
	for ($counter = 0; $counter < 100; $counter++)
	{	
		
	}
?>

<div class="container">
    <br />
    <br />
    <h1 class="text-center">Welcome to Cloud Estate</h1>
    <br />
    <br />
</div>

<?php
include('footer.php');
?>