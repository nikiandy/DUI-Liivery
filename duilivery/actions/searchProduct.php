<?php
require_once '../includes/db.php'; // Adjust the path as needed to your database connection script
$pdo = get_connection();

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];

    $stmt = $pdo->prepare("SELECT product_id FROM product WHERE name LIKE ?");
    $stmt->execute(["%$search%"]);

    $product = $stmt->fetch();

    if ($product) {
        header("Location: ../public/individualProduct.php?product_id=" . $product['product_id']);
        exit;
    } else {
        echo "No product found for '$search'.";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>