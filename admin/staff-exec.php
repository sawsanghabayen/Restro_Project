<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('connection/config.php');
	
	//Connect to mysql server
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysqli_select_db($link,DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	
	//Sanitize the POST values
	$FirstName = ($_POST['fName']);
	$LastName = ($_POST['lName']);
	$StreetAddress = ($_POST['sAddress']);
	$MobileNo = ($_POST['mobile']);
	

	//Create INSERT query
	$qry = "INSERT INTO staff(firstname,lastname,Street_Address,Mobile_Tel) VALUES('$FirstName','$LastName','$StreetAddress','$MobileNo')";
	$result = @mysqli_query($link,$qry);
	
	//Check whether the query was successful or not
	if($result) {
		echo "<html><script language='JavaScript'>alert('Staff information added successifully.')</script></html>";
		exit();
	}else {
		die("Adding staff information failed ... " . mysqli_error());
	}
?>