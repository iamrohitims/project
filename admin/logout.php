<?php
session_start();
$_SESSION = array();

// on logout destroying session 
session_destroy();

header("Location: ../index.php");
exit;
?>
