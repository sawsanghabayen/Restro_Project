<?php
    //Start session
    session_start();
    
    //Include database connection details
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
    
    
    $target = "../images/"; 
    $target = $target . basename( $_FILES['photo']['name']); 
    
    //Sanitize the POST values
    $name = ($_POST['name']);
    $description = ($_POST['description']);
    $Calories = ($_POST['Calories']);
    $salary = ($_POST['salary']);
    $category = ($_POST['category']);
    $photo = ($_FILES['photo']['name']);

    //Create INSERT query
    $qry = "INSERT INTO food_details(food_name, food_description,food_Calories, food_salary, food_photo, food_category) VALUES('$name','$description','$Calories','$salary','$photo','$category')";
    $result = @mysqli_query($link,$qry);
    
    //Check whether the query was successful or not
    if($result) {
            //Writes the photo to the server 
         $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);
         
         if($moved) 
         {      
             //everything is okay
             echo "The photo ". basename( $_FILES['photo']['name']). " has been uploaded, and your information has been added to the directory"; 
         } else {  
             //Gives an error if its not okay 
             echo "Sorry, there was a problem uploading your photo. "  . $_FILES["photo"]["error"]; 
         }
        header("location: foods.php");
        exit();
    }else {
        die("Query failed " . mysqli_error());
    } 
 ?>