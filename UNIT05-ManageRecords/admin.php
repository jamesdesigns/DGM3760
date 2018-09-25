<!DOCTYPE html>
<html>
<head>
<title>Unit 5 - Manage Records</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div id="glob_content">
     <div id="title">Admin Page</div>
<div id="feedback2">

    <p>Below is a list of all the employees. Use this page to remove employee accounts.</p>
    
    <?php include 'navigation.php'; ?>
<hr>
    
    
<?php

require_once('appvars.php');
require_once('connectvars.php');
    
// NEW CONNECT TO DATABASE ATTEMPT
$db_host = 'localhost:8889';
$db_user = 'root';
$db_password = 'root';
$db_name = 'request_database';    
    

// Connect to the database
// $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$dbc = mysqli_connect($db_host, $db_user, $db_password, $db_name);    

// Retrieve the employee info from MySQL
$query = "SELECT * FROM employee_info";
$data = mysqli_query($dbc, $query);

// Loop through the array of employee info, formatting it as HTML
echo '<table>';
while ($row = mysqli_fetch_array($data)) {
    // Display the employee info
    echo '<tr class="employeerow"><td><strong>' . $row['firstname'] . '</strong></td>';
    echo '<td><strong>' . $row['lastname'] . '</strong></td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['accountnumber'] . '</td>';
    echo '<td>' . $row['phonenumber'] . '</td>';
    echo '<td><a href="remove_employee.php?ID=' . $row['ID'] . '&amp;firstname=' . $row['firstname'] . '&amp;lastname=' . $row['lastname'] . '&amp;email=' . $row['email'] . '&amp;accountnumber=' . $row['accountnumber'] . '&amp;phonenumber=' . $row['phonenumber'] . '&amp;profileimage=' . $row['profileimage'] . '">Remove</a></td></tr>';
}

echo '</table>';

mysqli_close($dbc);

?>
    
</div>
</div>
</body>
</html>    