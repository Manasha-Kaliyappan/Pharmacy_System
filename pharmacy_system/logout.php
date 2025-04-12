<?php
session_start();
session_unset();   // remove all session variables
session_destroy(); // destroy the session

// Redirect to login page after logout
header("Location: login.php");
exit();
?>
