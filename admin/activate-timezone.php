<?php
    //Start session
    session_start();
    
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
 
   
    
    if(isset($_POST['Update'])){
        //define default values for flag_0 and flag_1
        $flag_0 = 0;
        $flag_1 = 1;
        
        //check whether their is an active currency
        $qry=mysqli_query($link,"SELECT * FROM timezones WHERE flag='$flag_1'") or die("Something is wrong ... \n" . mysql_error()); 
        if(mysqli_num_rows($qry)>0){
            $row=mysqli_fetch_assoc($qry);
            $timezone_id=$row['timezone_id'];
            // update the entry with a deactivation flag
            $result = mysqli_query($link,"UPDATE timezones SET flag='$flag_0' WHERE timezone_id='$timezone_id'")
            or die("Something is wrong ... \n". mysql_error());
            
                //Perform activation of another timezone
                
                    //Sanitize the POST values
                    $timezone_id = ($_POST['timezone']);
             
                 // update the entry with an activation flag
                 $result = mysqli_query($link,"UPDATE timezones SET flag='$flag_1' WHERE timezone_id='$timezone_id'")
                 or die("Something is wrong ... \n". mysqli_error()); 
                 
                 //check if query executed
                 if($result) {
                     // redirect back to the options page
                     header("Location: options.php");
                     exit();
                 }
                 else
                 // Gives an error
                 {
                    die("activating a timezone failed ..." . mysqli_error());
                 }
        }
            else{
                    //Sanitize the POST values
                    $timezone_id = ($_POST['timezone']);
             
                 // update the entry with an activation flag
                 $result = mysqli_query($link,"UPDATE timezones SET flag='$flag_1' WHERE timezone_id='$timezone_id'")
                 or die("Something is wrong ... \n". mysqli_error()); 
                 
                 //check if query executed
                 if($result) {
                 // redirect back to the options page
                 header("Location: options.php");
                 exit();
                 }
                 else
                 // Gives an error
                 {
                 die("activating a timezone failed ..." . mysqli_error());
                 }
            }
    }
?>