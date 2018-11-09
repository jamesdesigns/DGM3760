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
    <h2>Contact Employees</h2>
    </div>
        
                
        
<div id="feedback">   
    
  <p>If you have any questions or comments, don't hesitate to contact our team of talented employees.</p>
  <hr />


<?php

include('navigation.php'); 
    
  require_once('imagevars.php');
  require_once('connectvars.php'); 

    
$fullname = $_POST['fullname'];
$subject = $_POST['subject'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

$email_from = "research@researchdivision.com";
$email_subject = "New Form submission";
$email_body = "You have received a new message from $fullname.\n".
    "Message:\n $message\n". 
    

$to = $_POST['contactEmployee'];    
    
    echo "Thank you for your message $fullname.\n<br>". 
        "<p>Your message has been received and I will get back to you as soon as possible.</p><br><br>"; 

$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
mail($to,$email_subject,$email_body,$headers)
    
  

?>
      
    <?php 
    include 'footer.php'; 
?>
    
</div>
</div>
</body>
</html>