<?php
if (!isset($_SESSION)) {
  session_start();
}

// Destroy the session
session_destroy();
// Redirect to the login page
header('Location: /login');
exit();
?>
