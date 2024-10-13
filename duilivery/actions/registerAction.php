<?php
require_once '../includes/db.php';
require_once "validationTests.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $pdo = get_connection();
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    if ($stmt->execute([$username, $email, $hashed_password])) {
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $pdo->lastInsertId();
        $_SESSION["username"] = $username;
        
        header("location: welcome.php");
        exit;
    } else {
        echo "Something went wrong. Please try again later.";
    }
}
?>