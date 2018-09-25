<!DOCTYPE html>
<html>
<head>
<title>Unit 5 - Manage Records</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div id="glob_content">
<div id="title">Add Employee Info</div>
<div id="feedback2">
    
<?php
        require_once('appvars.php');
        require_once('connectvars.php');
    
    if (isset($_GET['ID']) && isset($_GET['firstname']) && isset($_GET['lastname']) && isset($_GET['email']) && isset($_GET['accountnumber']) && isset($_GET['phonenumber']) && isset($_GET['profileimage'])) {
        
        // Grab the employee info from the GET
        $id = $_GET['ID'];
        $firstname = $_GET['firstname'];
        $lastname = $_GET['lastname'];
        $email = $_GET['email'];
        $accountnumber = $_GET['accountnumber'];
        $phonenumber = $_GET['phonenumber'];
        $profileimage = $_GET['profileimage'];
    }
    else if (isset($_POST['ID']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['accountnumber']) && isset($_POST['phonenumber'])) {
        // Grab the employee info from the POST
        $id = $_POST['ID'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $accountnumber = $_POST['accountnumber'];
        $phonenumber = $_POST['phonenumber'];
    }
    else {
        echo '<p class="error">Sorry, no employee info was specified for removal.</p>';
    }
    
    if (isset($_POST['submit'])) {
        if ($_POST['confirm'] == 'Yes') {
            // Delete the profile image file from the server
            @unlink(GW_UPLOADPATH . $profileimage);
            
            
            // NEW CONNECT TO DATABASE ATTEMPT
            $db_host = 'localhost:8889';
            $db_user = 'root';
            $db_password = 'root';
            $db_name = 'request_database';
            
            // Connect to the database
            // $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $dbc = mysqli_connect($db_host, $db_user, $db_password, $db_name);
            
            // Delete the date from the database
            $query = "DELETE FROM employee_info WHERE ID = $id LIMIT 1";
            
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
            
            // Confirm success with the user
            echo '<p>The Employee ' . $firstname . ' ' . $lastname . ' was successfully removed.';
        }
        else {
            echo '<p class="error">The employee was not removed.</p>';
        }
            
    }
    
    else if (isset($id) && isset($firstname) && isset($lastname) && isset($email) && isset($accountnumber) && isset($phonenumber) && isset($profileimage)) {
        echo '<p>Are you sure you want to delete the following employee information?</p>';
        echo '<p><strong>First Name: </strong>' . $firstname . '<br><strong>Last Name: </strong>' . $lastname . '<br><strong>Email: </strong> ' . $email . '<br><strong>Account Number: </strong>' . $accountnumber . '<br><strong>Phone Number: </strong>' . $phonenumber . '<br><strong>Profile Image: </strong>' . $profileimage . '</p>';
        echo '<form method="post" action="remove_employee.php">';
        echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
        echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br>';
        echo '<input type="submit" value="submit" name="submit" />';
        
        echo '<input type="hidden" name="ID" value="' . $id . '" />';
        echo '<input type="hidden" name="firstname" value="' . $firstname . '" />';
        echo '<input type="hidden" name="lastname" value="' . $lastname . '" />';
        echo '<input type="hidden" name="email" value="' . $email . '" />';
        echo '<input type="hidden" name="accountnumber" value="' . $accountnumber . '" />';
        echo '<input type="hidden" name="phonenumber" value="' . $phonenumber . '" />';
        echo '<input type="hidden" name="profileimage" value="' . $profileimage . '" />';
        echo '</form>';
    }
    
    echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';

?>    
    
    </div>
    </div>
    </body>
</html>