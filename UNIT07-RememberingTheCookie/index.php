<?php
  // This starts the session
  require_once('startsession.php');
  // The header
  $page_title = '&#8220;Finding Love that Lasts.&#8221;';
  require_once('header.php');
  require_once('appvars.php');
  require_once('connectvars.php');
  // Displays the navigation
  require_once('navmenu.php');
  // Connects to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  // Retrieve user information from MySQL
  $query = "SELECT user_id, first_name, picture FROM matchmaker_user WHERE first_name IS NOT NULL ORDER BY join_date DESC LIMIT 5";
  $data = mysqli_query($dbc, $query);
  // Loop through the array of user information and format this as HTML
  echo '<h4>Most Recent Members:</h4>';
  echo '<table>';
  while ($row = mysqli_fetch_array($data)) {
    if (is_file(MM_UPLOADPATH . $row['picture']) && filesize(MM_UPLOADPATH . $row['picture']) > 0) {
        echo '<tbody>';
      echo '<tr class="home-tr"><td class="home-td"><img src="' . MM_UPLOADPATH . $row['picture'] . '" alt="' . $row['first_name'] . '" /></td>';
    }
    else {
      echo '<tr class="home-tr"><td class="home-td"><img src="' . MM_UPLOADPATH . 'nopic.jpg' . '" alt="' . $row['first_name'] . '" /></td>';
    }
    if (isset($_SESSION['user_id'])) {
      echo '<td class="home-td"><a class="name-title" href="viewprofile.php?user_id=' . $row['user_id'] . '">' . $row['first_name'] . '</a></td></tr>';
    }
    else {
      echo '<td class="home-td">' . $row['first_name'] . '</td></tr>';
    }
  }
  echo '</table>';
  mysqli_close($dbc);
?>

<?php
  // Displays the footer
  require_once('footer.php');
?>