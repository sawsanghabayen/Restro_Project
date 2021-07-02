<?php
    require_once('auth.php');
?>
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
    //retrive promotions from the specials table
    $result=mysqli_query($link,"SELECT * FROM food_details,categories WHERE food_details.food_category=categories.category_id")
    or die("There are no records to display ... \n" . mysqli_error());
    $result_sa=mysqli_query($link,"SELECT * FROM food_details,salaries,categories WHERE food_details.food_salary=salaries.salary_id and food_details.food_category=categories.category_id")
    or die("There a... \n" . mysqli_error()); 
?>
<?php
    //retrive categories from the categories table
    $categories=mysqli_query($link,"SELECT * FROM categories")
    or die("There are no records to display ... \n" . mysqli_error()); 
    $salaries=mysqli_query($link,"SELECT * FROM salaries")
    or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($link,"SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Foods</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Foods Management </h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="salaries.php">Salaries</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table width="760" align="center">
<CAPTION><h3>ADD A NEW FOOD</h3></CAPTION>
<form name="foodsForm" id="foodsForm" action="foods-exec.php" method="post" enctype="multipart/form-data" onsubmit="return foodsValidate(this)">
<tr>
    <th>Name</th>
    <th>Description</th>
    <th>Calories</th>
    <th>Price</th>
    <th>Category</th>
    <th>Photo</th>
    <th>Action(s)</th>
</tr>
<tr>
    <td><input type="text" name="name" id="name" class="textfield" /></td>
    <td><textarea name="description" id="description" class="textfield" rows="2" cols="15"></textarea></td>
    <td><input  type="text" style="width:50px;" name="Calories" id="Calories" class="textfield" /></td>
    <td width="168"><select name="salary" id="salary">
    <option value="select">- select one option -
    <?php 
    //loop through categories table rows
    while ($row=mysqli_fetch_array($salaries)){
    echo "<option value=$row[salary_id]>$row[food_price]"; 
    }
    ?>

    </select></td>
    <td width="168"><select name="category" id="category">
    <option value="select">- select one option -
    <?php 
    //loop through categories table rows
    while ($row=mysqli_fetch_array($categories)){
    echo "<option value=$row[category_id]>$row[category_name]"; 
    }
    ?>
    </select></td>
    <td><input type="file" name="photo" id="photo"/></td>
    <td><input type="submit" name="Submit" value="Add" /></td>
</tr>
</form>
</table>
<hr>
<table width="950" align="center">
<CAPTION><h3>AVAILABLE FOODS</h3></CAPTION>
<tr>
<th>Food Photo</th>
<th>Food Name</th>
<th>Food Description</th>
<th>Food Calories</th>
<th>Food Price</th>
<th>Food Category</th>
<th>Action(s)</th>
</tr>

<?php


$symbol=mysqli_fetch_assoc($currencies); //gets active currency
while ($row=mysqli_fetch_array($result_sa)){
echo "<tr>";
echo '<td><img src=../images/'. $row['food_photo']. ' width="80" height="70"></td>';
echo "<td>" . $row['food_name']."</td>";
echo "<td>" . $row['food_description']."</td>";
echo "<td>" . $row['food_Calories']."</td>";
echo "<td>" . $symbol['currency_symbol']. "" . $row['food_price']."</td>";
echo "<td>" . $row['category_name']."</td>";
echo '<td><a href="delete-food.php?id=' . $row['food_id'] . '">Remove Food</a></td>';
echo "</tr>";
}
mysqli_free_result($result_sa);
mysqli_close($link);
?>
</table>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>