<?php
$pageTitle = 'Account Management';

require_once '../classes/Users/User.php';
include '../includes/header.php';

require_once '../includes/db.php';
$pdo = get_connection();

// Placeholder for messages like errors
$message = '';

?>
<link rel="stylesheet" href="../css/account.css">
</div>
<br>
<div class="account-page">
    <div class="account-form">
        <h2 class="account-form-title">REGISTER NOW</h2>
        <form method="post" action="../actions/registerAction.php" class="account-register-form">
            <div class="form-group">
                <input type="text" id="username" name="username" required placeholder="First Name">
            </div>
            <div class="form-group">
                <input type="text" id="last_name" name="last_name" required placeholder="Last Name">
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" required placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" required placeholder="Password">
            </div>
            <div class="form-group">
                <input type="submit" value="CREATE" class="account-submit-btn">
            </div>
        </form>
    </div>
    <div class="account-form login-form">
    <h2 class="account-form-title">Login</h2>
    <form method="post" action="../actions/loginAction.php">
        <div class="form-group">
            <input type="text" id="login_username" name="username" required placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" id="login_password" name="password" required placeholder="Password">
        </div>
        <div class="form-group">
            <input type="submit" value="Login" class="account-submit-btn">
        </div>
    </form>
</div>
</div>



<?php include '../includes/footer.php'; ?>
