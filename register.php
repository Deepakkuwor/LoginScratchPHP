<?php
session_start(); //Enable Session

//If Session Exists: Redirect to landing (index.php)
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
    header('Location: index.php');
}

require 'template/header.php'; //Render Header Template
require "config.php";  // Load Configuration

/**
 * Register
 * 
 * @description:
 * Check if the register is requested,
 *      -True: Prompt users success
 *      -False: Display Error
 * @param:
 *      register - variabel / event
 */

$register = new Register();
$showSuccess = false;
$showError = false;

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password =  $_POST['password'];


    $response = $register->registration($name, $dob, $phone, $email, $address, $password);
    if ($response['ERR']) {
        $showSuccess = false;
        $showError = true;
    } else if (!$response['ERR']) {
        $showSuccess = true;
        $showError = false;
    } else {
        $showSuccess = false;
        $showError = false;
    }
}
?>

<div class="container">
    <!-- Register Form -->
    <div class="form">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <h3>Register</h3>
            <div class="form-item">
                <img class="userimage" src="img/avatar.png" alt="avatar">
            </div>
            <div class="form-item">
                <input class="input" type="text" name="name" placeholder="Enter name">
            </div>
            <div class="form-item">
                <input class="input" type="date" name="dob" placeholder="Enter DOB">
            </div>
            <div class="form-item">
                <input class="input" type="number" name="phone" placeholder="Enter phone no">
            </div>
            <div class="form-item">
                <input class="input" type="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-item">
                <textarea class="input" name="address" row="5" placeholder="Enter address"></textarea>
            </div>
            <div class="form-item">
                <input class="input" type="password" name="password" placeholder="Enter password">
            </div>
            <!-- Success Section -->
            <?php if ($showSuccess) { ?>
                <div class="form-item" id="success-response"><?php echo $response['MSG']; ?></div>
            <?php } ?>
            <!-- ./Success Section -->
            <!-- Error Section -->
            <?php if ($showError) { ?>
                <div class="form-item" id="error-response"><?php echo $response['MSG']; ?></div>
            <?php } ?>
            <!-- ./Error Section -->


            <div class="form-item">
                <button type="submit" name="register" class="btn">Register</button>
            </div>
            <div class="form-item">
                <small>Already have an account? <a href="login.php">Log in</a></small>
            </div>
        </form>
    </div>
    <!-- Register Form -->
</div>

<?php require 'template/footer.php'; ?>