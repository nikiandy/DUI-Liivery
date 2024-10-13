<?php
require_once '../clases/Sale/Product.php';
require_once '../includes/db.php';

$pdo = get_connection();

$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
$products = $stmt->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Order</title>
</head>
<body>
    <h2>Create a New Order</h2>
    <form method="post">
        <label for="product_id">Select Product:</label>
        <select name="product_id" id="product_id">
            <?php foreach ($products as $product): ?>
                <option value="<?= htmlspecialchars($product['product_id']) ?>">
                    <?= htmlspecialchars($product['name']) ?> - $<?= htmlspecialchars($product['price']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Add to Order">
    </form>
</body>
</html>
