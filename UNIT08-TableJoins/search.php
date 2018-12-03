<?php
  // This starts the session
  require_once('startsession.php');

  // The header
  $page_title = 'Search by Common Traits';
  require_once('header.php');
  require_once('appvars.php');
  require_once('connectvars.php');

  // Displays the navigation
  require_once('navmenu.php');

  // Connects to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection to the database failed');
  // Retrieve user information from MySQL

 $query = "SELECT matchmaker_user.user_id, matchmaker_user.first_name, matchmaker_topic.name, matchmaker_response.response" .
" FROM matchmaker_user" .
" JOIN matchmaker_response" .
" ON matchmaker_user.user_id = matchmaker_response.user_id" .
" JOIN matchmaker_topic" .
" ON matchmaker_response.topic_id = matchmaker_topic.topic_id" .
" WHERE matchmaker_user.user_id";

 // echo $query;

  $data = mysqli_query($dbc, $query) or die('Query failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Search Matches</title>
  <link href="styles.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <ul class="searchList">
    <?php
        echo '<h4>25 - Questions answered by Members:</h4>';
    while($row = mysqli_fetch_array($data)) {
      echo '<li class="search"><a href="index.php?first_name='.$row['first_name']. ' on ' .$row['name']. ': ' .$row['response']. '">';

      echo $row['first_name'] . ' - ' . $row['name'];

      // Create Icons for the Response answers from members
      if ($row['response'] === '1') {
          echo '  <i class="fa fa-heart"></i>';
      }
      if ($row['response'] === NULL) {
          echo ' N/A';
      }
      if ($row['response'] === '2') {
          echo '  <i class="fa fa-thumbs-o-down"></i>';
      }
      echo '</a></li>';
    };
    ?>
  </ul>

  <?php
  // We are done so hang up
  mysqli_close($dbconnection);
  include_once('footer.php');
   ?>
 </body>
 </html>
