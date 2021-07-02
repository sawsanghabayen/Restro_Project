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
    
    // check if Delete is set in POST
     if (isset($_POST['Delete'])){
         // get id value of currency and Sanitize the POST value
         $currency_id = ($_POST['currency']);
         
         // delete the entry
         $result = mysqli_query($link,"DELETE FROM currencies WHERE currency_id='$currency_id'")
         or die("There was a problem while deleting the currency ... \n" . mysqli_error()); 
         
         // redirect back to options
         header("Location: options.php");
     }
     
         else
            // if id isn't set, redirect back to options
         {
            header("Location: options.php");
         }
?>