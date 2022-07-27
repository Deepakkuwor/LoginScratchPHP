<?php
session_start();    //Enable Session
require 'template/header.php';  //Include Header Template

//Check: If Session does not exists, then redirect to Login
if(!(isset($_SESSION['id']) && isset($_SESSION['name']))){
    header('Location: login.php');
}
?>


<!-- Dashboard Page -->
<header class="dashboard_header">
    <h1 class="welcome_header">Welcome <?php echo ucfirst($_SESSION['name']);?>,</h1>
    <a href="logout.php" class='btn-danger'>Logout</a>
</header>
<!--./Dashboard Page-->


<?php 
require 'template/footer.php';  //Input Footer Template
?>