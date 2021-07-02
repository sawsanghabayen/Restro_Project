<?php
	//checking connection and connecting to a database
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
	$ReservationID = ($_POST['reservationid']);
	$StaffID = ($_POST['staffid']);
	
    //define a default value for flag
    $flag_1 = 1;
 
     // update the entry
     $result = mysqli_query($link,"UPDATE reservations_details SET StaffID='$StaffID', flag='$flag_1' WHERE ReservationID='$ReservationID'")
     or die("The reservation or staff does not exist ... \n" . mysqli_error()); 
     
     //check if query executed
     if($result) {
     // redirect back to the allocation page
     header("Location: allocation.php");
     exit();
     }
     else
     // Gives an error
     {
     die("reservation allocation failed ..." . mysqli_error());
     }
 
?>