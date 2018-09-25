<!DOCTYPE html>
<html>
<head>
<title>Unit 5 - Manage Records</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div id="glob_content">
<div id="title">Our Employees</div>
<div id="feedback">

     
    <p>Welcome to the Employee Account page. Please add Employee Information here: <br><br>
     
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
    
    // Retrieve the employee data from MySQL
    $query = "SELECT * FROM employee_info";
    $data = mysqli_query($dbc, $query);
    
    
    // Loop through the array of employee data, formatting it as HTML
    echo '<table>';
    $i = 0;
    while ($row = mysqli_fetch_array($data)) {
        // Display the employee information
        if ($i ==0) {
            echo '<tr><td colspan="2" class="employeeheader">Employee List</td></tr>';
        }
            
        echo '<tr><td class="employeeinfo">';
        echo '<strong>First Name: </strong>' . $row['firstname'] . '<br>';
        echo '<strong>Last Name: </strong>' . $row['lastname'] . '<br>';
        echo '<strong>Email: </strong>' . $row['email'] . '<br>';
        echo '<strong>Account Number: </strong>' . $row['accountnumber'] . '<br>';
        echo '<strong>Phone Number: </strong>' . $row['phonenumber'] . '</td>';
        if (is_file(GW_UPLOADPATH . $row['profileimage']) && filesize(GW_UPLOADPATH . $row['profileimage']) > 0) {
            echo '<td><img src="' . GW_UPLOADPATH . $row['profileimage'] . '" alt="Profile Image" /></td></tr>';
        } else {
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