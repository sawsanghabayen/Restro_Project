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

//selecting all records from the food_details table. Return an error if there are no records in the table

$result=mysqli_query($link,"SELECT * FROM food_details,salaries,categories WHERE food_details.food_salary=salaries.salary_id and food_details.food_category=categories.category_id")
    or die("There a... \n" . mysqli_error()); 



?>
<?php
    //retrive categories from the categories table
    $categories=mysqli_query($link,"SELECT * FROM categories")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
    $salaries=mysqli_query($link,"SELECT * FROM salaries")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($link,"SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    if(isset($_POST['Submit'])){
    
        $id = ($_POST['category']);
        
        //selecting all records from the food_details and categories tables based on category id. Return an error if there are no records in the table
        $result=mysqli_query($link,"SELECT * FROM food_details,categories,salaries WHERE food_category='$id' 
        AND food_details.food_salary=salaries.salary_id AND food_details.food_category=categories.category_id ")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
    }


    else if(isset($_POST['Show'])){
        
        $id = ($_POST['salary']);
        
        //selecting all records from the food_details and categories tables based on category id. Return an error if there are no records in the table
        $result=mysqli_query($link,"SELECT * FROM food_details ,salaries,categories WHERE food_salary='$id'
        AND food_details.food_category=categories.category_id  AND food_details.food_salary=salaries.salary_id")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo APP_NAME; ?>:Foods</title>
<script type="text/javascript" src="swf/swfobject.js"></script>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="member-index.php">Home</a></li>
  <li><a href="foodzone.php">Food Zone</a></li>
  <li><a href="specialdeals.php">Special Deals</a></li>
  <li><a href="member-index.php">My Account</a></li>
  <li><a href="contactus.php">Contact Us</a></li>
  </ul>
  </div>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name"><?php echo APP_NAME; ?> Restaurant</div>
</div>

<div id="center">
 <h1>CHOOSE YOUR FOOD</h1>
 <hr>
 <h3>Note: limit the food zone by selecting a category below:</h3>
 <form name="categoryForm" id="categoryForm" method="post" action="foodzone.php">
     <table width="360" align="center">
     <tr>
        <td>Category</td>
        <td width="168"><select name="category" id="category">
        <option value="select">- select category -
        <?php 
        //loop through categories table rows
        while ($row=mysqli_fetch_array($categories)){
        echo "<option value=$row[category_id]>$row[category_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Submit" value="Show Foods" /></td>


        
        <td>Salary</td>
        <td width="168"><select name="salary" id="salary">
        <option value="select">- select salary -
        <?php 
        //loop through categories table rows
        while ($row=mysqli_fetch_array($salaries)){
        echo "<option value=$row[salary_id]>$row[food_price]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Show" value="Show Foods" /></td>
     </tr>
     </table>
 </form>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
      <table width="860" height="auto" style="text-align:center;">
        <tr>
                <th>Food Photo</th>
                <th>Food Name</th>
                <th>Food Description</th>
                <th>Food Category</th>
                <th>Food Price</th>
                <th>Food Calories</th>
                <th>Action(s)</th>
        </tr>
        <?php
      
            $count_sa = mysqli_num_rows($result);
            if(isset($_POST['Show']) && $count_sa < 1){
                echo "<html><script language='JavaScript'>alert('There are no foods under the selected salary at the moment. Please check back later.')</script></html>";
            }
            else{
                //loop through all table rows
                //$counter = 3;
                $symbol=mysqli_fetch_assoc($currencies); //gets active currency
                while ($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo '<td><a href=images/'. $row['food_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['food_photo']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row['food_name']."</td>";
                    echo "<td>" . $row['food_description']."</td>";
                    echo "<td>" . $row['category_name']."</td>";
                    echo "<td>" . $symbol['currency_symbol']. "" . $row['food_price']."</td>";
                    echo "<td>" . $row['food_Calories']."</td>";
                    echo '<td><a href="cart-exec.php?id=' . $row['food_id'] . '">Add To Cart</a></td>';
                    echo "</td>";
                    echo "</tr>";
                    }      
                }
            mysqli_free_result($result);
            mysqli_close($link);
        ?>
      </table>
  </div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>