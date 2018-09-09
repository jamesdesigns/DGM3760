<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Unit 3 - Sending Spam and Sending the Email</title>
  <link href="styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:300" rel="stylesheet">
</head>
<body>
<div id="glob_content">
<div id="feedback">
      
<?php


$user = 'root';
$password = 'root';
$host = 'localhost:8889';
$dbase = 'request_database';
$table = 'email_list';

// This email address has been changed for obvious reasons
$from = 'james3450934590345@yahoo.com';

$subject = $_POST['subject'];
$text = $_POST['jamesmail'];



// Connection to Database    
$connection = mysqli_connect($host, $user, $password, $dbase) or die('Error connecting to MySQL server.');

$query = "SELECT * FROM $table";
$result = mysqli_query($connection, $query) or die('Error querying database.');

while($row = mysqli_fetch_array($result)) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    // $email = $row['email'];
    
    $msg = "Dear $first_name $last_name, \n . $text .";
    $to = $row['email'];
    mail($to, $subject, $msg, 'From:' . $from);
    
    echo 'Email sent to: ' . $to . '<br>';
    
    
    mysqli_close($connection);
}
    ?>
      
</div>      
</div>
</body>
</html>
          