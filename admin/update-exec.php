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
	$OldPassword = ($_POST['opassword']);
	$NewPassword = ($_POST['npassword']);
	$ConfirmNewPassword = ($_POST['cpassword']);
	
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // update the entry
         $result = mysqli_query($link,"UPDATE pizza_admin SET Password='$NewPassword' WHERE Admin_ID='$id' AND Password='$OldPassword'")
         or die("The admin does not exist ... \n". mysqli_error()); 
         
         // redirect back to the member profile
         header("Location: profile.php");
     }
     else
     // if id isn't set, give an error
     {
        die("Password changing failed ..." . mysqli_error());
     }
 
?>