<?php 
/**
 * Logout
 * 
 * @description: Logout User
 */
session_start();    //Enable Session
session_unset();    //Clear Session
session_destroy();  // Destroy Session

header('Location: login.php');  // Redirect to Login
?>