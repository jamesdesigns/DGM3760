<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Unit 4 - Deleting Records</title>
  <link href="styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:300" rel="stylesheet">
</head>
<body>
<div id="glob_content">
     <div id="title">Remove Email Subscribers</div>
<div id="feedback2">
   
<p>Please select the email addresses to delete from the email list and click Remove.</p>
        
<!-- Change the action attribute of the form tag so that the form is self-referencing -->    
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      
<?php

$host = 'localhost:8889';
$user = 'root';
$password = 'root';
$dbase = 'request_database';
// $table = 'email_list';

// Page 218 of Head First PHP to finalize and validate the form!

// Connection to Database    
$dbc = mysqli_connect($host, $user, $password, $dbase) or die('Error connecting to MySQL server.');

    
// Delete the customer rows (only if the form has been submitted) 
if (isset($_POST['submit'])) {
    foreach ($_POST['todelete'] as $delete_id) {
        $query = "DELETE FROM email_list WHERE id = $delete_id";
        mysqli_query($dbc, $query) or die('Error querying database.'. $delete_id);
    }
    echo 'Customer(s) removed.<br />';
}    
    
    
// Display the customer rows with checkboxes for deleting
    $query = "SELECT * FROM email_list";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo '<input type="checkbox" value="' . $row['ID'] . '" name="todelete[]" />';
        echo '  ' .$row['first_name'];
        echo ' ' . $row['last_name'];
        echo ' ' . $row['email'];
        echo '<br />';
    }
    mysqli_close($dbc);
    
    ?>
    
<input type="submit" name="submit" value="Remove" />
</form>

      
</div>      
</div>
</body>
</html>
          