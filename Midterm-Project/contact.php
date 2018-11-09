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
    
    
if (isset($_POST['submit'])) {   
     // Connect to the database
    $dbc = mysqli_connect('ftp.uxpays.com', 'uxpasyco', 'webdev2018UX!$', 'uxpaysco_WPLPS'); 
    

    // Grab the employee data from the POST
    // $fullname = mysqli_real_escape_string($dbc, trim($_POST['fullname']));
    // $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    
    $fullname = $_POST['fullname'];
    $subject = $_POST['subject'];
    $emailFrom = $_POST['email'];
    $message = $_POST['message'];
    

    $email_from = "research@researchdivision.com";
    $email_subject = "New Form submission";
    
    $to = "jameshooperdesigns@gmail.com";
    $headers = "From: ".$emailFrom;
    $email_body = "You have received an message from " .$fullname . ".\n\n". $message;
    
    mail($to, $subject, $email_body, $headers);
    header("Location: contact.php?mailsend");
}    

?>
    
    <main>
        <p>Contact Form</p>

       <form enctype="multipart/form-data" class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <label for="fullname">Full Name:</label>
            <input type="text" name="fullname" placeholder="Full Name" value="<?php if (!empty($fullname)) echo $fullname; ?>">
            <label for="email">Email:</label>
            <input type="text" name="email" placeholder="Your Email" value="<?php if (!empty($email)) echo $email; ?>">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" placeholder="Subject" value="<?php if (!empty($subject)) echo $subject; ?>">
            <label for="message">Message:</label>
            <textarea name="message" placeholder="Message" value="<?php if (!empty($message)) echo $message; ?>"></textarea>
            <input type="submit" value="SEND" name="submit">
        </form>
</main>
    

    <?php 
    include 'footer.php'; 
?>

        </div>
</div>
</body>
</html>