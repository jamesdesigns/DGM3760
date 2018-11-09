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
    
    ?>


    <main>
        <p>Contact Form</p>

       <form enctype="multipart/form-data" class="contact-form" action="formToEmail.php" method="post">
           
           
           
           
        <?php
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
		  // Retrieve the employee info from MySQL
		  $query = "SELECT * FROM employee_team";
		  $data = mysqli_query($dbc, $query);

		    echo 'Who is this message for: <br><br>'; 
		    while ($row = mysqli_fetch_array($data)) { 
				echo '<input type="checkbox" name="contactEmployee" value="contactEmployee">&nbsp;'.$row['fullname'].' - '.$row['email'].'<br>';
		   } 
           echo '<br>';
		?> 

<!-- <select>
            <option value="email" name="email">Email</option>
           </select><br><br> -->
            
            <label for="fullname">Full Name:</label>
            <input type="text" name="fullname" placeholder="Full Name" value="">
            <label for="email">Email:</label>
            <input type="text" name="email" placeholder="Your Email" value="">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" placeholder="Subject" value="">
            <label for="message">Message:</label>
            <textarea name="message" placeholder="Message" value=""></textarea>
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