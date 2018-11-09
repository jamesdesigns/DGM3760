<?php
  require_once('authorize.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Research Division - Remove Employee Information</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="glob_content">

    <div id="title"><i class="fa fa-heartbeat" style="font-size:48px;color:red"></i>&nbsp;Research Division
    <br/>
    <h2>Remove Employees</h2>
    </div>
<div id="feedback">
      <p>Research Division - Remove Employee Information</p>
  <hr />

<?php
  include 'navigation.php';    
    
  require_once('imagevars.php');
  require_once('connectvars.php');
  if (isset($_GET['id']) && isset($_GET['fullname']) && isset($_GET['expertise']) && isset($_GET['phone']) && isset($_GET['email']) && isset($_GET['expertiseDesc']) && isset($_GET['employeeImg'])) {
    // Grab the employee data from the GET
    $id = $_GET['id'];
    $fullname = $_GET['fullname'];
    $expertise = $_GET['expertise'];
    $phone = $_GET['phone'];
    $email = $_GET['email'];
    $expertiseDesc = $_GET['expertiseDesc'];
    $employeeImg = $_GET['employeeImg'];    
  }
  else if (isset($_POST['id']) && isset($_POST['fullname']) && isset($_POST['expertise']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['expertiseDesc'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $expertise = $_POST['expertise'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $expertiseDesc = $_POST['expertiseDesc'];  
  } 
  else {
    echo '<p class="error">Sorry, no employee information was specified for removal.</p>';
  }
  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
      // Delete the screen shot image file from the server
      @unlink(GW_UPLOADPATH . $employeeImg);
        
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
    
      // Delete the score data from the database
      $query = "DELETE FROM employee_team WHERE id = $id LIMIT 1";
      mysqli_query($dbc, $query);
      mysqli_close($dbc);
      // Confirm success with the user
      echo '<p>The employee information for ' . $fullname . ' was successfully removed.';
    }
    else {
      echo '<p class="error">The employee information was not removed.</p>';
    }
  }
  else if (isset($id) && isset($fullname) && isset($expertise) && isset($phone) && isset($email) && isset($expertiseDesc)) {
    echo '<p>Are you sure you want to delete the following employee information?</p>';
    echo '<p><strong>Full Name: </strong>' . $fullname . '<br /><strong>Expertise: </strong>' . $expertise . '<br /><strong>Phone: </strong>' . $phone . '<br /><strong>Email: </strong>' . $email . '<br /><strong>Expertise Description: </strong>' . $expertiseDesc . '</p>';
      
    echo '<form method="post" action="remove_employee.php">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br /><br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="fullname" value="' . $fullname . '" />';
    echo '<input type="hidden" name="expertise" value="' . $expertise . '" />';
    echo '<input type="hidden" name="phone" value="' . $phone . '" />';
    echo '<input type="hidden" name="email" value="' . $email . '" />';
    echo '<input type="hidden" name="expertiseDesc" value="' . $expertiseDesc . '" />';
    echo '</form>';
  }
  echo '<p><a href="admin.php">&lt;&lt; Back to Admin page</a></p>';
  
  include 'footer.php';
?>

        </div></div>
</body> 
</html>