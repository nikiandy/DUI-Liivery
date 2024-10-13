<?php
include '../includes/db.php';

$pdo = get_connection();

function updateLoyaltyLevel($userId, $pdo) {
    //total spent by the user
    $stmt = $pdo->prepare("SELECT SUM(od.Price * od.Quantity) AS total_spent
                            FROM orders o
                            JOIN orderdetails od ON o.order_id = od.Order_ID
                            WHERE o.user_id = ?");
    $stmt->execute([$userId]);
    $result = $stmt->fetch();
    $totalSpent = $result['total_spent'] ?? 0;

    //get loyalty level
    $loyaltyLevel = 0;
    if ($totalSpent >= 1000) {
        $loyaltyLevel = 3;
    } elseif ($totalSpent >= 500) {
        $loyaltyLevel = 2;
    } elseif ($totalSpent >= 100) {
        $loyaltyLevel = 1;
    }

    $updateStmt = $pdo->prepare("UPDATE users SET loyaltyLevel = ? WHERE id = ?");
    $updateStmt->execute([$loyaltyLevel, $userId]);

    return $loyaltyLevel;
}

$userId = 1;
$loyaltyLevel = updateLoyaltyLevel($userId, $pdo);
echo "Your Loyalty Level: " . $loyaltyLevel;