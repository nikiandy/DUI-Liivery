<?php
session_start();

//check if user is logged in if not redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../public/account.php");
    exit;
}

require_once '../includes/db.php';

$pdo = get_connection();
$userId = $_SESSION["id"];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(":id", $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

unset($pdo);

include '../includes/header.php';
?>

<div class="container">
    <h1>Welcome, <b><?= htmlspecialchars($_SESSION["username"]); ?></b></h1>
    
    <p>
        Here is your account dashboard where you can view your profile details and manage your account.
    </p>
    
    <p>
        <a href="../public/logout.php">Sign Out of Your Account</a>
    </p>
    
    <div class="user-details">
        <h2>Your Profile:</h2>
        <p><b>Username:</b> <?= htmlspecialchars($user['username']); ?></p>
        <p><b>Email:</b> <?= htmlspecialchars($user['email']); ?></p>
    </div>
    
</div>

<?php include '../includes/footer.php'; ?>
