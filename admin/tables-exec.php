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
    $name = ($_POST['name']);

    //Create INSERT query
    $qry = "INSERT INTO tables(table_name) VALUES('$name')";
    $result = @mysqli_query($link,$qry);
    
    //Check whether the query was successful or not
    if($result) {
        header("location: options.php");
        exit();
    }else {
        die("Query failed " . mysqli_error());
    }
 ?>