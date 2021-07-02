<?php
	//checking connection and connecting to a database
	require_once('connection/config.php');
	//Connect to mysql server
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysqli_error());
	}
	
	//Select database
	$db = mysqli_select_db($link,DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
 
    $flag_1 = 1;
    $timezones=mysqli_query($link,"SELECT * FROM timezones WHERE flag='$flag_1'")
    or die("Something is wrong. ".mysqli_error());
    
    $row=mysqli_fetch_assoc($timezones); //gets retrieved row
    
    $active_reference = $row['timezone_reference']; //gets active timezone
    
    date_default_timezone_set($active_reference); //sets the default timezone for use
    
    $current_date = date("Y-m-d"); //gets the current date
    
    $current_time = date("H:i:s"); //gets the current time
    
	//Sanitize the POST values
    $new_subject = ($_POST['subject']);
	$new_message = ($_POST['txtmessage']);
    
    $from = "administrator"; //sets default to the administrator (it can be changed if PM will be implemented in the future)
	
     // update the entry
     $result = mysqli_query($link,"INSERT INTO messages(message_from,message_date,message_time,message_subject,message_text) VALUES('$from','$current_date','$current_time','$new_subject','$new_message')")
     or die("Message sending failed ..." . mysqli_error()); 
 
     if($result){
         // redirect back to the messages page
         header("Location: messages.php");
         exit();
     }
     else
     // if not sent, give an error
     {
        die("Message sending failed ..." . mysqli_error());
     }
?>