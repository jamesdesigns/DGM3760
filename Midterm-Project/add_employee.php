<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Research Division - Add Employee Information</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
<div id="glob_content">
<div id="title"><i class="fa fa-heartbeat" style="font-size:48px;color:red"></i>&nbsp;Research Division
    <br/>
    <h2>Add Employee Information</h2>
    </div>
<div id="feedback">  
    
<p>Research Division - Add Employee Information</p>
      <hr />

<?php
    
  include 'navigation.php';   
    
  require_once('imagevars.php');
  require_once('connectvars.php');
    
  if (isset($_POST['submit'])) {
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Grab the employee data from the POST
    $fullname = mysqli_real_escape_string($dbc, trim($_POST['fullname']));
    $expertise = mysqli_real_escape_string($dbc, trim($_POST['expertise']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    $expertiseDesc = mysqli_real_escape_string($dbc, trim($_POST['expertiseDesc']));
    $employeeImg = mysqli_real_escape_string($dbc, trim($_FILES['employeeImg']['name']));
    $employeeImg_type = $_FILES['employeeImg']['type'];
    $employeeImg_size = $_FILES['employeeImg']['size']; 
      
    if (!empty($fullname) && !empty($expertise) && !empty($email) && !empty($phone) && !empty($expertiseDesc) && !empty($employeeImg)) {
      if ((($employeeImg_type == 'image/gif') || ($employeeImg_type == 'image/jpeg') || ($employeeImg_type == 'image/pjpeg') || ($employeeImg_type == 'image/png'))  && ($employeeImg_size > 0) && ($employeeImg_size <= GW_MAXFILESIZE)) {        
          if ($_FILES['employeeImg']['error'] == 0) {          // Move the file to the target upload folder      
          $target = GW_UPLOADPATH . $employeeImg;
          if (move_uploaded_file($_FILES['employeeImg']['tmp_name'], $target)) {
            // Write the data to the database
            $query = "INSERT INTO employee_team (fullname, expertise, email, phone, expertiseDesc, employeeImg, approved) VALUES ('$fullname', '$expertise', '$email', '$phone', '$expertiseDesc', '$employeeImg', 0)";
            mysqli_query($dbc, $query);
              
            // Confirm success with the user
            echo '<p>Thanks for adding your new employee information! It will be reviewed and added to the employee page as soon as possible.</p>';
            echo '<p><strong>Full Name:</strong> ' . $fullname . '<br />';
            echo '<strong>Expertise:</strong> ' . $expertise . '<br />';
            echo '<strong>Email:</strong> ' . $email . '<br />';
            echo '<strong>Phone:</strong> ' . $phone . '<br />';
            echo '<strong>Expertise Description:</strong> ' . $expertiseDesc . '<br /><br />';
            echo '<img src="' . GW_UPLOADPATH . $employeeImg . '" alt="Employee image" /></p>';
            echo '<p><a href="index.php">&lt;&lt; Back to Employee Information</a></p>';
              
            // Clear the employee data to clear the form
            $fullname = "";
            $expertise = "";
            $email = "";
            $phone = "";
            $expertiseDesc = "";
            $employeeImg = "";
              
            mysqli_close($dbc); 
          }
          else {
            echo '<p class="error">Sorry, there was a problem uploading your profile image.</p>';
          }
        }      }      else { echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';      }
      // Try to delete the temporary employee image file
      @unlink($_FILES['employeeImg']['tmp_name']);
    }
    else {
      echo '<p class="error">Please enter all of the employee information requested to add your new employee page.</p>';
    }
  }
    
    
?>


  <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
      
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" value="<?php if (!empty($fullname)) echo $fullname; ?>" /><br />
      
    <label for="expertise">Expertise:</label>
    <input type="text" id="expertise" name="expertise" value="<?php if (!empty($expertise)) echo $expertise; ?>" /><br />
      
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br />
      
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="<?php if (!empty($phone)) echo $phone; ?>" /><br />
      
    <label for="expertiseDesc">Expertise Description:</label>
    <input type="text" id="expertiseDesc" name="expertiseDesc" value="<?php if (!empty($expertiseDesc)) echo $expertiseDesc; ?>" /><br />
      
    <label for="employeeImg">Employee Image:</label>
    <input type="file" id="employeeImg" name="employeeImg" />
    <hr />
    <input type="submit" value="Add" name="submit" />
  </form>
    <?php
     include 'footer.php';
    ?>
    
            </div>
    </div>
</body> 
</html>