<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unit 6 - Securing the Application</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    
<div id="glob_content">
<div id="title">Employee List</div>
<div id="feedback">    
    

  <p>Welcome new employees! Have you submitted your profile and bid information yet? <br>Enter your employee information here: <a href="addemployee.php">Add Record</a></p>
  <hr />
 
<?php
  
  include 'navigation.php';    
      
  require_once('appvars.php');
  require_once('connectvars.php');  

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  // Retrieve the employee data from MySQL
  // $query = "SELECT * FROM employee_records WHERE approved = 1 ORDER BY date DESC";
  // $query = "SELECT * FROM employee_records WHERE approved = 1";  
  $query = "SELECT * FROM employee_records WHERE approved = 1";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of employee data, formatting it as HTML 
  echo '<table>';
   $i = 0;
  while ($row = mysqli_fetch_array($data)) { 
    // Display the employee data
   if ($i == 0) {
      echo '<tr><td colspan="2" class="topscoreheader">Bid Number: ' . $row['bidnumber'] . '</td></tr>';
    }
    echo '<tr><td class="bidinfo">';
    echo '<span class="bid">' . $row['bidnumber'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br>';  
    echo '<strong>Email:</strong>' . $row['email'] . '<br />'; 
    echo '<strong>Date:</strong> ' . $row['date'] . '</td>';
    if (is_file(GW_UPLOADPATH . $row['profileimage']) && filesize(GW_UPLOADPATH . $row['profileimage']) > 0) {
      echo '<td><img src="' . GW_UPLOADPATH . $row['profileimage'] . '" alt="Employee image" /></td></tr>';
    }
    else {
      echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="Unverified score" /></td></tr>';
    }
    $i++;
  }
  echo '</table>';

  mysqli_close($dbc);
?>
    
    </div>
    </div>

</body> 
</html>
