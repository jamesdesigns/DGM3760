<?php
  // Start the session
  require_once('startsession.php');
  // Insert the page header
  $page_title = 'My Perfect Match';
  require_once('header.php');
  require_once('appvars.php');
  require_once('connectvars.php');
  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }
  // Show the navigation menu
  require_once('navmenu.php');
  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  // Only look for a match if the user has questionnaire responses stored
  $query = "SELECT * FROM matchmaker_response WHERE user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  if (mysqli_num_rows($data) != 0) {
    // First grab the user's responses from the response table (JOIN to get the topic name)
    $query = "SELECT MR.response_id, MR.topic_id, MR.response, MT.name AS topic_name " .
      "FROM matchmaker_response AS MR " .
      "INNER JOIN matchmaker_topic AS MT USING (topic_id) " .
      "WHERE MR.user_id = '" . $_SESSION['user_id'] . "'";
    $data = mysqli_query($dbc, $query);
    $user_responses = array();
    while ($row = mysqli_fetch_array($data)) {
      array_push($user_responses, $row);
    }
    // Initialize the match search results
    $matchmaker_score = 0;
    $matchmaker_user_id = -1;
    $matchmaker_topics = array();
    // Loop through the user table comparing other people's responses to the user's responses
    $query = "SELECT user_id FROM matchmaker_user WHERE user_id != '" . $_SESSION['user_id'] . "'";
    $data = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($data)) {
      // Grab the response data for the user (a potential match)
      $query2 = "SELECT response_id, topic_id, response FROM matchmaker_response WHERE user_id = '" . $row['user_id'] . "'";
      $data2 = mysqli_query($dbc, $query2);
      $matchmaker_responses = array();
      while ($row2 = mysqli_fetch_array($data2)) {
        array_push($matchmaker_responses, $row2);
      }
      // Compare each response and calculate a match total
      $score = 0;
      $topics = array();
      for ($i = 0; $i < count($user_responses); $i++) {
        if ($user_responses[$i]['response'] + $matchmaker_responses[$i]['response'] == 3) {
          $score += 1;
          array_push($topics, $user_responses[$i]['topic_name']);
        }
      }
      // Check to see if this person is better than the best match so far
      if ($score > $matchmaker_score) {
        // We found a better match, so update the match search results
        $matchmaker_score = $score;
        $matchmaker_user_id = $row['user_id'];
        $matchmaker_topics = array_slice($topics, 0);
      }
    }
    // Make sure a match was found
    if ($matchmaker_user_id != -1) {
      $query = "SELECT username, first_name, last_name, city, state, picture FROM matchmaker_user WHERE user_id = '$matchmaker_user_id'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 1) {
        // The user row for the match was found, so display the user data
        $row = mysqli_fetch_array($data);
        echo '<table><tr><td class="label">';
        if (!empty($row['first_name']) && !empty($row['last_name'])) {
          echo $row['first_name'] . ' ' . $row['last_name'] . '<br />';
        }
        if (!empty($row['city']) && !empty($row['state'])) {
          echo $row['city'] . ', ' . $row['state'] . '<br />';
        }

        echo '</td><td>';
        if (!empty($row['picture'])) {
          echo '<img src="' . MM_UPLOADPATH . $row['picture'] . '" alt="Profile Picture" /><br />';
        }
        echo '</td></tr></table>';
        // Display the matched topics
        echo '<h4>You are matched on the following ' . count($matchmaker_topics) . ' topics:</h4>';
        foreach ($matchmaker_topics as $topic) {
          echo '<ul class="matchedItems"><li>' . $topic . '<br />';
          echo '</li></ul>';
        }
        // Display a link to the match user's profile
        echo '<h4>View <a href=viewprofile.php?user_id=' . $matchmaker_user_id . '>' . $row['first_name'] . '\'s profile</a></h4>';
      }
    }
  }
  else {
    echo '<p>You must first <a href="questions.php">Answer the Questionnaire</a> before you can be matched.</p>';
  }
  mysqli_close($dbc);
  // Insert the page footer
  require_once('footer.php');
?>
