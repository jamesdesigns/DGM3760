<?php
  require_once ('authorize.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
<title>Unit 6 - Approve New Employee</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="glob_content">
<div id="title">Approve Records</div>
<div id="feedback">


<?php
    
  include 'navigation.php';
    
  require_once('appvars.php');
  require_once('connectvars.php');

  if (isset($_GET['ID']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['email']) && isset($_GET['bidnumber'])) {
    // Grab the employee data from the GET
    $ID = $_GET['ID'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $email = $_GET['email'];
    $bidnumber = $_GET['bidnumber'];  
    $profileimage = $_GET['profileimage'];
  }
  else if (isset($_POST['ID']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['bidnumber'])) {
    // Grab the employee data from the POST
    $ID = $_POST['ID'];  
    $name = $_POST['name'];
    $email = $_POST['email'];
    $bidnumber = $_POST['bidnumber'];  
  }
  else {
    echo '<p class="error">Sorry, no employee information was specified for approval.</p>';
  }
    
    
    

  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
            
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

      // Approve the employee by setting the approved column in the database
      $query = "UPDATE employee_records SET approved = 1 WHERE ID = $ID";
       
      mysqli_query($dbc, $query);
      mysqli_close($dbc);

      // Confirm success with the user
      echo '<p>The bid number ' . $bidnumber . ' for ' . $name . ' was successfully accepted.';
    }
    else {
      echo '<p class="error">Sorry, there was a problem approving the employee.</p>';
    }
  }
  else if (isset($ID) && isset($name) && isset($date) && isset($email) && isset($bidnumber)) {
    echo '<p>Are you sure you want to approve the following employee?</p>';
    echo '<p><strong>Name: </strong>' . $name . '<br /><strong>Date: </strong>' . $date .
      '<br /><strong>Email: </strong>' . $email . '<br /><strong>Bid Number: </strong>' . $bidnumber . '</p>';
    echo '<form method="post" action="approve_employee.php">';
    echo '<img src="' . GW_UPLOADPATH . $profileimage . '" width="160" alt="Profile image" /><br />';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="ID" value="' . $ID . '" />';
    echo '<input type="hidden" name="date" value="' . $date . '" />';  
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="email" value="' . $email . '" />';
    echo '<input type="hidden" name="bidnumber" value="' . $bidnumber . '" />'; 
    echo '</form>';
  }
    

  echo '<p><a href="admin.php">&lt;&lt; Back to Admin page</a></p>';
?>

</div>
</div>
</body> 
</html>
