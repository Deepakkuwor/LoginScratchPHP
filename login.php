<?php 
session_start();    //Enable Session

//If Session Exists: Redirect to landing (index.php)
if(isset($_SESSION['id']) && isset($_SESSION['name'])){
    header('Location: index.php');
}


require "template/header.php"; //   Render Header Template
require "config.php";   // Load Configuration


/**
 * Login
 * 
 * @description:
 * Check if the login is requested,
 *      - True: Start Session
 *      - False: Display Error
 * 
 * @param:
 *      login  - variable / event
 */
$login = new Login();
$showError = false;
if (isset($_POST['login'])) {
    $phone = $_POST['phone'];
    $password =  $_POST['password'];

    $response = $login->signin($phone, $password);
    if (!$response['ERR']) {
        $_SESSION['id'] = $login->getId();
        $_SESSION['name'] = $login->getName();
        header('Location: index.php');
    } else {
        $showError = true;
    }
}

?>
<div class="container">
    <!-- Login Form -->
    <div class="form">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <h3>Login</h3>
            <div class="form-item">
                <img class="userimage" src="img/avatar.png" alt="avatar">
            </div>
            <div class="form-item">
                <input class="input" type="number" name="phone" placeholder="Enter phone no">
            </div>
            <div class="form-item">
                <input class="input" type="password" name="password" placeholder="Enter password">
            </div>
            <!-- Error Section -->
            <?php if ($showError) { ?>
                <div class="form-item" id="error-response"><?php echo $response['MSG']; ?></div>
            <?php } ?>
            <!--./Error Section-->
            <div class="form-item">
                <button type="submit" name="login" class="btn">Log in</button>
            </div>
            <div class="form-item">
                <small>Create new account? <a href="register.php">Register</a></small>
            </div>
        </form>
    </div>
    <!--./Login Form-->
</div>

<?php require "template/footer.php"; ?>