<?php
// Initialize
session_start();

// Unset all variables
$_SESSION = array();

// Destroy
session_destroy();

// Redirect back to login page
header("location: account.php");
exit;
?>