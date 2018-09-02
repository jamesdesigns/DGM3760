<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Unit 2 - Connecting to MySQL</title>
  <link href="styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:300" rel="stylesheet">
</head>
<body>
<div id="glob_content">

<div id="feedback">
<?php

$dbPassword = 'root';
$dbUserName = 'root';
$dbServer = 'localhost:8889';
$dbName = 'request_database';

$connection = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);


/*
print_r($connection);

if($connection->connect_errno)
{
    exit("Database Connection Failed. Reason: ".$coonnection->connect_error);
}

*/

$value1 = $_POST['name'];
$value2 = $_POST['email'];
$value3 = $_POST['accountNumber'];
$value4 = $_POST['phone'];
$value5 = $_POST['products'];
$value6 = $_POST['service'];
$value7 = $_POST['message'];


$sql = "INSERT INTO web_form (name, email, accountNumber, phone, products, service, message) VALUES ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7')";

if (mysqli_query($connection, $sql)) {
	// echo "New record created successfully";
    echo "<h1>Thank you! We appreciate your feedback.</h1><br>";

    echo "Here is the information you submitted: <br><br>";
    echo "Your name: " . $value1 . "<br>";
    echo "Email: " . $value2 . "<br>";
    echo "Account Number: " . $value3 . "<br>";
    echo "Phone: " . $value4 . "<br>";
    echo "Product Info Requested: " . $value5 . "<br>";
    echo "How happy you are with our services: " . $value6 . "<br>";
    echo "Your Message: " . $value7 . "<br>";
;    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}


mysqli_close($connection);
?>
    </div>
    </div>
    </body>
</html>