<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Unit 6 - Add Employee</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
    
<body>
    
<div id="glob_content">
<div id="title">Add Records</div>
<div id="feedback">   

<?php
    
  include 'navigation.php';    
    
  require_once('appvars.php');
  require_once('connectvars.php');

  if (isset($_POST['submit'])) {
      
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

    // Grab the employee data from the POST
      
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $bidnumber = mysqli_real_escape_string($dbc, trim($_POST['bidnumber']));   
    $profileimage = mysqli_real_escape_string($dbc, trim($_FILES['profileimage']['name']));
    $profileimage_type = $_FILES['profileimage']['type'];
    $profileimage_size = $_FILES['profileimage']['size']; 

    if (!empty($name) && !empty($email) && is_numeric($bidnumber) && !empty($profileimage)) {
      if ((($profileimage_type == 'image/gif') || ($profileimage_type == 'image/jpeg') || ($profileimage_type == 'image/pjpeg') || ($profileimage_type == 'image/png')) && ($profileimage_size > 0) && ($profileimage_size <= GW_MAXFILESIZE)) {
        if ($_FILES['profileimage']['error'] == 0) {
          // Move the file to the target upload folder
          $target = GW_UPLOADPATH . $profileimage;
          if (move_uploaded_file($_FILES['profileimage']['tmp_name'], $target)) {
            // Write the data to the database
            $query = "INSERT INTO employee_records (date, name, email, bidnumber, profileimage, approved) VALUES (NOW(), '$name', '$email', '$bidnumber', '$profileimage', 0)";
            mysqli_query($dbc, $query);

            // Confirm success with the user
            echo '<p>Thanks for adding your employee information! It will be reviewed and added to our employee list as soon as possible.</p>';
            echo '<p><strong>Name:</strong> ' . $name . '<br>';
            echo '<strong>Email:</strong> ' . $email . '<br>';
            echo '<strong>Bid Number:</strong> ' . $bidnumber . '<br>';  
            echo '<img src="' . GW_UPLOADPATH . $profileimage . '" alt="Profile image" /></p>';
            echo '<p><a href="index.php">&lt;&lt; Back to Employee List</a></p>';

            // Clear the employee data to clear the form
            $name = "";
            $email = "";
            $bidnumber = "";  
            $profileimage = "";

            mysqli_close($dbc);
          }
          else {
            echo '<p class="error">Sorry, there was a problem uploading your profile image.</p>';
          }
        }
      }
      else {
        echo '<p class="error">The profile image must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
      }

      // Try to delete the temporary screen shot image file
      @unlink($_FILES['profileimage']['tmp_name']);
    }
    else {
      echo '<p class="error">Please enter all of the information to add employee information.</p>';
    }
  }
?>

  <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br>
      
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br>
      
    <label for="phonenumber">Bid Number:</label>
    <input type="text" id="bidnumber" name="bidnumber" value="<?php if (!empty($bidnumber)) echo $bidnumber; ?>" /><br>
      
    <label for="profileimage">Profile Image:</label>
    <input type="file" id="profileimage" name="profileimage" />
      
    <hr />
    <input type="submit" value="Add" name="submit" />
  </form>
    
        </div>
    </div>
</body> 
</html>
