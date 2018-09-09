<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Unit 3 - Sending Spam and Adding Email</title>
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
    
// Connection to Database    
$connection = mysqli_connect($host, $user, $password, $dbase);    
  

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];

    
    $sql="INSERT INTO email_list (first_name, last_name, email) VALUES('$firstname','$lastname','$email')";

    
if (mysqli_query($connection, $sql)) {
    echo "<h1>Thank you $first_name!</h1><br>";  
    echo "<p>We look forward to sending you valuable information regarding our new products.</p>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

    mysqli_close($connection);             
             

?>
      </div>
</div>   
</body>
</html>

