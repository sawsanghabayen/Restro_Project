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
//retrive categories from the categories table
$result_sa=mysqli_query($link,"SELECT * FROM salaries")
or die("There are no records to display ... \n" . mysqli_error()); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Salaries</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Salaries Management</h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="salaries.php">Salaries</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table width="320" align="center">
<CAPTION><h3>ADD A NEW SALARY</h3></CAPTION>
<form name="categoryForm" id="categoryForm" action="salaries-exec.php" method="post" onsubmit="return categoriesValidate(this)">
<tr>
    <th>Price</th>
    <th>Action(s)</th>
</tr>
<tr>
    <td><input type="text" name="price" class="textfield" /></td>
    <td><input type="submit" name="Submit" value="Add" /></td>
</tr>
</form>
</table>
<hr>
<table width="320" align="center">
<CAPTION><h3>AVAILABLE Salaries</h3></CAPTION>
<tr>
<th>Food Price</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result_sa)){
echo "<tr>";
echo "<td>" . $row['food_price']."</td>";
echo '<td><a href="delete-salary.php?id=' . $row['salary_id'] . '">Remove Salary</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($link);
?>
</table>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>