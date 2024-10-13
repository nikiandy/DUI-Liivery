<?php
session_start();

require_once '../includes/db.php';
$pdo = get_connection();

$userId = $_SESSION['user_id'] ?? null;

// Retrieve loyalty level from the database
$stmt = $pdo->prepare("SELECT loyaltyLevel FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$loyaltyLevel = $user['loyaltyLevel'] ?? 0;

//discount rate based on loyalty level
$discountRate = 0;
switch ($loyaltyLevel) {
    case 1:
        $discountRate = 0.05; //5%
        break;
    case 2:
        $discountRate = 0.10; //10%
        break;
    case 3:
        $discountRate = 0.15; //15%
        break;
}

//shopping cart session array
if (!isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = array();
}

//get the product details for items in the shopping cart
$product_ids = array_keys($_SESSION['shopping_cart']);
$products = [];
$total = 0;
if (count($product_ids) > 0) {
    $placeholders = str_repeat('?,', count($product_ids) - 1) . '?';
    $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id IN ($placeholders)");
    $stmt->execute($product_ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //total cost of the items in the cart
    foreach ($products as $product) {
        $total += $product['price'] * $_SESSION['shopping_cart'][$product['product_id']];
    }
}

//apply discount
$discount = $total * $discountRate;
$finalTotal = $total - $discount;

include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/shoppingCart.css">
</head>
<body>
    <div class="shopping-cart-container">
        <h1>Your Shopping Cart</h1>
        <?php if (empty($products)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
        <div class="cart-items">
            <?php foreach ($products as $product): ?>
            <div class="cart-item">
                <div class="item-image-container">
                    <img src="../images/<?= htmlspecialchars(str_replace(' ', '_', $product['name'])) ?>.jpg" alt="<?= htmlspecialchars($product['name']) ?>" class="item-image">
                </div>
                <div class="item-info">
                    <p class="item-name"><?= htmlspecialchars($product['name']) ?></p>
                    <p class="item-price">€<?= number_format($product['price'], 2) ?></p>
                    <p class="item-quantity">Quantity: <?= $_SESSION['shopping_cart'][$product['product_id']] ?></p>
                    <div class="item-actions">
                        <form action="../actions/updateCart.php" method="post">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <input type="number" name="quantity" value="<?= $_SESSION['shopping_cart'][$product['product_id']] ?>" min="1">
                            <button type="submit" class="update-btn">Update</button>
                        </form>
                        <form action="../actions/removeFromCart.php" method="post">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <h2>Order Summary</h2>
            <p><strong>Subtotal:</strong> €<?= number_format($total, 2) ?></p>
            <p><strong>Discount:</strong> -€<?= number_format($discount, 2) ?> (<?= $discountRate * 100 ?>% loyalty discount)</p>
            <p><strong>Total:</strong> €<?= number_format($finalTotal, 2) ?></p>
            <form action="checkout.php" method="post">
                <button type="submit" class="checkout-btn">Proceed to Checkout</button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>