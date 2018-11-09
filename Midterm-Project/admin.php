<?php include 'authorize.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Research Division</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
    <div id="glob_content">
        
        <div id="title"><i class="fa fa-heartbeat" style="font-size:48px;color:red"></i>&nbsp;Research Division
    <br/>
    <h2>Admin Page</h2>
    </div>
        
        
        
<div id="feedback">   
    
  <p>Research Division - Admin page</p>
  <hr />
<?php
  include 'navigation.php';
    
      
    
  require_once('imagevars.php');
  require_once('connectvars.php');
    
  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  // Retrieve the employee data from MySQL
  $query = "SELECT * FROM employee_team";
  $data = mysqli_query($dbc, $query);
  // Loop through the array of employee data, formatting it as HTML 
  echo '<table class="editTable">';
  echo '<tr><th>ID</th><th>Full Name</th><th>Expertise</th><th>Phone</th><th>Email</th><th>Expertise Description</th><th>Action</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the employee data
    echo '<td>' . $row['id'] . '</td>';
    echo '<td><a href="profile.php">' . $row['fullname'] . '</a></td>';
    echo '<td>' . $row['expertise'] . '</td>';
    echo '<td>' . $row['phone'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['expertiseDesc'] . '</td>';
      
    echo '<td><a href="remove_employee.php?id=' . $row['id'] . '&amp;fullname=' . $row['fullname'] .
      '&amp;expertise=' . $row['expertise'] . '&amp;email=' . $row['email'] . '&amp;phone=' . $row['phone'] . '&amp;expertiseDesc=' . $row['expertiseDesc'] . '&amp;employeeImg=' . $row['employeeImg'] . '">Remove</a>';
      
    if ($row['approved'] == '0') {
      echo ' / <a href="approve_employee.php?id=' . $row['id'] . '&amp;fullname=' . $row['fullname'] .
        '&amp;expertise=' . $row['expertise'] . '&amp;email=' . $row['email'] . '&amp;phone=' . $row['phone'] . '&amp;expertiseDesc=' . $row['expertiseDesc'] . '&amp;employeeImg=' . $row['employeeImg'] . '">Approve</a>';
    }
    echo '</td></tr>';
  }
  echo '</table>';
  mysqli_close($dbc);
    

?>
    
<?php
        include 'footer.php';
    ?>