<!DOCTYPE html>
<html>
<head>
<title>Unit 5 - Manage Records</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div id="glob_content">
     <div id="title">Add Employees</div>
<div id="feedback2">
    <p>Fill out this form to add new employees to the list.</p>
      <?php include 'navigation.php'; ?>

    
    
    <?php

    require_once('appvars.php');
    require_once('connectvars.php');
    

       if (isset($_POST['submit'])) {
        // Grab the employee information from the POST
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $accountnumber = $_POST['accountnumber'];
        $phonenumber = $_POST['phonenumber'];  
        $profileimage = $_FILES['profileimage']['name'];
        $profileimage_type = $_FILES['profileimage']['type'];
        $profileimage_size = $_FILES['profileimage']['size'];  
           
        // Debugging function to view what is going on!
        //   print_r ($_POST);   
    
        if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($accountnumber) && !empty($phonenumber)) {
            
            if ((($profileimage_type == 'image/gif') || ($profileimage_type == 'image/jpeg') || ($profileimage_type == 'image/pjpeg') || ($profileimage_type == 'image/png')) && ($profileimage_size > 0) && ($profileimage_size <= GW_MAXFILESIZE)) {
                if ($_FILES['profileimage']['error'] == 0) {
                    // Move the file to the target upload folder
                    $target = GW_UPLOADPATH . $profileimage;
                    if (move_uploaded_file($_FILES['profileimage']['tmp_name'], $target)) {
                        // NEW CONNECT TO DATABASE ATTEMPT
                        $db_host = 'localhost:8889';
                        $db_user = 'root';
                        $db_password = 'root';
                        $db_name = 'request_database';

                        
                        // Connect to the database
                        // $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $dbc = mysqli_connect($db_host, $db_user, $db_password, $db_name);
                        
                        // Write the data to the database
                        $query = "INSERT INTO employee_info VALUES (0,'$firstname','$lastname','$email','$accountnumber','$phonenumber','$profileimage')";
                        mysqli_query($dbc, $query);
                        
                        
                         // Confirm success with the user
                        echo '<p>Thanks for adding your employee information.</p>';
                        echo '<p><strong>First Name:</strong> ' . $firstname . '<br>';
                        echo '<strong>Last Name:</strong> ' . $lastname . '<br>';
                        echo '<strong>Email:</strong> ' . $email . '<br>';
                        echo '<strong>Account Number:</strong> ' . $accountnumber . '<br>';
                        echo '<strong>Phone Number:</strong> ' . $phonenumber . '<br>';
                        echo '<img src="' . GW_UPLOADPATH . $profileimage . '" alt="Profile Image" /></p>';   
                        echo '<p><a href="index.php">&lt;&lt; Back to Employee Information page</a></p>';
                        
                        // Clear the employee data to clear the form
                        $firstname = "";
                        $lastname = "";
                        $email = "";
                        $accountnumber = "";
                        $phonenumber = "";
                        $profileimage = "";

                        mysqli_close($dbc);
                    }
                    else {
                        echo '<p class="error">Sorry, there was a problem uploading your profile image.</p>';
                    }   
                }
            }       else {
                        echo '<p> class="error">The screen shot must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
                }
            
            // Try to delete the temporary employee profile image file
            @unlink($_FILES['profileimage']['tmp_name']);
        }
           else {
               echo '<p class="error">Please enter all of the information to add Employee information.</p>';
           }
       }
    ?>
    

    <hr />
    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
        
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" value="<?php if (!empty($firstname)) echo $firstname; ?>" /><br>
        
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" value="<?php if (!empty($lastname)) echo $lastname; ?>" /><br>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br>
        
        <label for="accountnumber">Account Number:</label>
        <input type="text" id="accountnumber" name="accountnumber" value="<?php if (!empty($accountnumber)) echo $accountnumber; ?>" /><br>
        
        <label for="phonenumber">Phone Number:</label>
        <input type="text" id="phonenumber" name="phonenumber" value="<?php if (!empty($phonenumber)) echo $phonenumber; ?>" /><br>
        
        <label for="profileimage">Profile Image:</label>
        <input type="file" id="profileimage" name="profileimage" />
        <hr>
        <input type="submit" value="Add" name="submit" />
    </form>        
  

    
        </div>
    </div>
    </body>
</html>
