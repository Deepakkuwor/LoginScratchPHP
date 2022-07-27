<?php

session_start();
require 'template/header.php';

if(!(isset($_SESSION['id']) && isset($_SESSION['name']))){
    header('Location: login.php');
}
?>
<header class="dashboard_header"><h1 class="welcome_header">Welcome <?php echo ucfirst($_SESSION['name']);?>,</h1><a href="logout.php" class='btn-danger'>Logout</a>

<?php require 'template/footer.php'; ?>