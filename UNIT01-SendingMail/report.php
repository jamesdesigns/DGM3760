<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Submission Form</title>
	<title>Aliens Abducted Me - Report an Abduction</title>
	<link rel="stylesheet" type="text/css" href="styles2.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Raleway" rel="stylesheet">
</head>
<body>

<div id="form">
<?php
	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$how_many = $_POST['howmany'];
	$what_they_did = $_POST['whattheydid'];
	$other = $_POST['other'];

	$when_it_happend = $_POST['whenithappend'];
	$how_long = $_POST['howlong'];
	$alien_description = $_POST['aliendescription'];
	$fang_spotted = $_POST['fangspotted'];
	$email = $_POST['email'];

        $to = 'webmaster@artistjameshooper.com';
        $subject = 'Aliens Abducted Me - Abduction Report';
        $msg = "$first_name was abducted $when_it_happened and was gone for $how_long.\n" .
         "Number of aliens: $how_many\n" . 
         "Alien description: $alien_description\n" .
         "What they did: $what_they_did\n" .
         "Fang spotted: $fang_spotted\n" .
         "Other comments: $other";
         mail($to, $subject, $msg, 'From:' . $email);
        
    echo '<h1>Alien Abduction Report</h1>';	
	echo '<span>Thank you for submitting this form ' . $first_name . '.</span><br /><br />';
	echo 'You were abducted  ' . $when_it_happend;
	echo ' and were gone for  ' . $how_long . '<br />';
	echo 'Describe them:  ' . $alien_description . '<br />';
	echo 'Was Fang there?  ' . $fang_spotted . '<br />';

	echo 'How many aliens did you see?  ' . $how_many . '<br />';
	echo 'What did they do to you?  ' . $what_they_did . '<br />';
	echo 'Other information:  ' . $other . '<br />';
	echo 'Your email address is:  ' . $email;



	$email = "james@artistjameshooper.com";
	$subject = "Test Message";
	$msg = "This is a test message";

	$eLog="/tmp/mailError.log";

	//Get the size of the error log
	//ensure it exists, create it if it doesn't
	$fh= fopen($eLog, "a+");
	fclose($fh);
	$originalsize = filesize($eLog);

	mail($email,$subject,$msg);

	/*
	* NOTE: PHP caches file status so we need to clear
	* that cache so we can get the current file size
	*/

	clearstatcache();
	$finalsize = filesize($eLog);

	//Check if the error log was just updated
	if ($originalsize != $finalsize) {
	print "Problem sending mail. (size was $originalsize, now $finalsize) See $eLog
	";
	} else {
	print "Mail sent to $email";
	}

	
?>
</div>
</body>
</html>