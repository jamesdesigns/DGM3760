<?php
  require_once('authorize.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <title>Unit 6 - Employee Administration</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="glob_content">
<div id="title">Display Records</div>
<div id="feedback">

  <p>Below is a list of all our Employees. Use this page to remove employees as needed.</p>
  <hr />

<?php

  include 'navigation.php';    
    
  require_once('appvars.php');
  require_once('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the employee data from MySQL
  $query = "SELECT * FROM employee_records";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of employee data, formatting it as HTML 
  echo '<table>';
  echo '<tr><th>ID</th><th>Name</th><th>Bid Number</th><th>Date</th><th>Email</th><th>Action</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the email data
    echo '<tr class="scorerow"><td><strong>' . $row['ID'] . '</strong></td>';  
    echo '<td>' . $row['name'] . '</td>'; 
    echo '<td>' . $row['bidnumber'] . '</td>'; 
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
 
    echo '<td><a href="remove_employee.php?ID=' . $row['ID'] . '&amp;name=' . $row['name'] .
      '&amp;bidnumber=' . $row['bidnumber'] . '&amp;date=' . $row['date'] . '&amp;email=' . $row['email'] . 
      '&amp;profileimage=' . $row['profileimage'] . '">Remove</a>';
      
    if ($row['approved'] == '0') {
      echo ' / <a href="approve_employee.php?ID=' . $row['ID'] . '&amp;name=' . $row['name'] .
        '&amp;bidnumber=' . $row['bidnumber'] . '&amp;date=' . $row['date'] . '&amp;email=' . $row['email'] . '&amp;profileimage=' . $row['profileimage'] . '">Approve</a>';
    }
    echo '</td></tr>';
  }
  echo '</table>';
    

    

  mysqli_close($dbc);
?>
            </div>
    </div>
</body> 
</html>
