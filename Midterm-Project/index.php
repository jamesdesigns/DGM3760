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
    <h2>Our Employees</h2>
    </div>
        
                
        
<div id="feedback">   
    
  <p>Welcome to the employee's Research Division. If you are a new employee, welcome!</p>
    <blockquote><small>In order to add new employee information, you must obtain a username and password from Human Resources. Contact Cindy Thompson (HR)</small></blockquote><br>
    
  <hr />

<?php
    
  include('navigation.php'); 
    
  require_once('imagevars.php');
  require_once('connectvars.php');
  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  // Retrieve the score data from MySQL
  $query = "SELECT * FROM employee_team WHERE approved = 1";
  $data = mysqli_query($dbc, $query);
  // Loop through the array of employee data, formatting it as HTML 
  echo '<table>';  
  $i = 0;
  while ($row = mysqli_fetch_array($data)) { 
    // Display the employee data
    if ($i == 0) {
 
      echo '<tr><td class="employeeheader"><i class="fa fa-user-circle-o" style="font-size:20px;color:#0099e6"></i>&nbsp;Employees</td></tr>';
    }
      
    if (is_file(GW_UPLOADPATH . $row['employeeImg']) && filesize(GW_UPLOADPATH . $row['employeeImg']) > 0) {
      echo '<td colspan="2"><img class="profile" src="' . GW_UPLOADPATH . $row['employeeImg'] . '" alt="Employee image" /></td>';
    }
    else {
      echo '<td colspan="2"><img class="profile" src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="Unverified image" /></td>';
    }  

    // echo '<tr><td class="employeeinfo"></td></tr>';
    echo '<tr><td><strong>Full Name:  </strong>   ' . $row['fullname'] . '</td></tr>';
    echo '<tr><td><strong>Expertise:  </strong>   ' . $row['expertise'] . '</td></tr>';
    echo '<tr><td><strong>Expertise Description:  </strong>   ' . $row['expertiseDesc'] . '</td></tr>';
    echo '<tr><td><strong>Phone:  </strong>   ' . $row['phone'] . '</td></tr>';
    echo '<tr><td><span style="color:#0099cc"><a class="highlight" href="contact-v3.php"><strong>Email:  </strong>   ' . $row['email'] . '</a></span></td></tr>';
    echo '<tr><td></td></tr>';  

    $i++;
  }
  echo '</table>';
  mysqli_close($dbc);
    
    include 'footer.php';
?>
        </div></div>
</body> 
</html>