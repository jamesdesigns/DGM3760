<?php
  // Generate the navigation menu

  if (isset($_SESSION['username'])) {
    echo '<div class="menu">';  
    echo '<a href="index.php">Home</a>';
    echo '<a href="viewprofile.php">View Profile</a>';
    echo '<a href="editprofile.php">Edit Profile</a>';
    echo '<a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
    echo '</div>';
  }
  else {
    echo '<div class="menu">';  
    echo '<a href="login.php">Log In</a>/ ';
    echo '<a href="signup.php">Sign Up</a>';
    echo '</div>';
  }

?>
