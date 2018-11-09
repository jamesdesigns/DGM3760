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
    <h2>Contact Form</h2>
    </div>
        
                
        
<div id="feedback">   
    
  <p>Contact Form</p>
  <hr />
<!--

    <form method="post" action="sendemail.php">
        
    <label for="employeeEmail">Who is this message for?</label><br><br>
    John <input type="checkbox" name="employeeEmail" value="John"> <br>
    Bobby <input type="checkbox" name="employeeEmail" value="Bobby"> <br>  
     

    <label for="subject">Subject of email:</label>
    <input type="text" name="subject" size="60" /><br />

    <label for="email">Email:</label>
    <input type="text" name="email" /><br />

    // name:elvismail -- Body of email:
    <label for="message">Message:</label>
    <textarea name="message"></textarea><br />
    
    // submit
    <input type="submit" value="Submit" name="submit" />
  </form>    


<form method="post" action="sendemail.php">
    <label for="subject">Subject of email: </label><br>
    <input type="text" id="subject" name="subject" size="60" />
    <label for="elvismail">Body of email:</label><br>
    <textarea id="elvismail" name="elvismail" rows="8" cols="60"></textarea><br>

    <input type="submit" name="submit" vlaue="Submit" />
</form>



-->
    

<?php
  include('navigation.php'); 
    
  require_once('imagevars.php');
  require_once('connectvars.php');    
    
    
// What to do??    
// $from = 'jameshooperdesigns@gmail.com';
    
       
// $subject = $_POST['subject'];
$to = 'jameshooperdesigns@yahoo.com';    
$subject = 'The Subject';    
    
$text = $_POST['message'];

$dbc = mysqli_connect('localhost:8889','root','root','request_database') or die('Error connecting to MySQL server.');
$query = "SELECT * FROM employee_team";
$result = mysqli_query($dbc, $query) or die('Error querying database.');
    

while($row = mysqli_fetch_array($result)) {
    // $name = $row['fullname'];
   // $email = $row['email'];
    $message = "Hello $fullname, \n $text";
    $headers = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    // This is who it should send to
    // $to = $row['email'];
    
    // mail($row['email'], $subject, $msg, $headers);
    mail($to, $subject, $message, $headers);
    echo 'Your message has been sent to: ' . $to .'<br>'; 
}
    mysqli_close($dbc);
    
    
    include 'footer.php';
?>
</div>
</div>
</body> 
</html> 