<?php
  // If user is logged in, delete session vars to log them out
  session_start();
  if (isset($_SESSION['user_id'])) {
    // Delete session vars by clearing the $_SESSION array
    $_SESSION = array();
    // Delete session cookie by setting its expiration to an hour ago (3600)
    if (isset($_COOKIE[session_name()])) {      setcookie(session_name(), '', time() - 3600);    }
    // Destroy the session
    session_destroy();
  }
  // Delete USER ID and USERNAME COOKIES by setting expirations to an hour ago (3600)
  setcookie('user_id', '', time() - 3600);
  setcookie('username', '', time() - 3600);
  // Redirect to HOME PAGE
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
  header('Location: ' . $home_url);
?>