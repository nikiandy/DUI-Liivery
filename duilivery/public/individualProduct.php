<?php
require_once '../includes/db.php'; 
$pdo = get_connection();

// Start session to use the shopping cart
session_start();

$productData = [];
$feedback = "";

// Handle Add to Cart submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        
        // Initialize shopping cart if not already
        if (!isset($_SESSION['shopping_cart'])) {
            $_SESSION['shopping_cart'] = [];
        }
        
        // Add or update the product quantity in the shopping cart
        $_SESSION['shopping_cart'][$product_id] = isset($_SESSION['shopping_cart'][$product_id]) ?
            $_SESSION['shopping_cart'][$product_id] + $quantity : $quantity;

        // Redirect to avoid resubmission
        header("Location: individualProduct.php?product_id=$product_id&success=1");
        exit;
    }
}

// Check if product ID is provided
if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Prepare a statement to fetch the product details
    $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id = :product_id");
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the product data
    $productData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$productData) {
        die("Product not found.");
    }

    if (isset($_GET['success'])) {
        $feedback = "Product successfully added to your cart!";
    }
} else {
    die("Invalid product ID.");
}

include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($productData['name']) ?></title>
    <link rel="stylesheet" href="../css/individualProduct.css">
</head>
<body>
    <div class="container">
        <div class="product-container">
            <div>
                <img src="../images/<?= htmlspecialchars(str_replace(' ', '_', $productData['name'])) ?>.jpg" 
                alt="<?= htmlspecialchars($productData['name']) ?>" class="product-image">
            </div>
            <div class="product-details">
                <h1 class="product-title"><?= htmlspecialchars($productData['name']) ?></h1>
                <p class="product-description"><?= htmlspecialchars($productData['description']) ?></p>
                <p class="product-price">Price: $<?= htmlspecialchars($productData['price']) ?></p>
                
                <?php if ($feedback): ?>
                <p class="success"><?= $feedback ?></p>
                <?php endif; ?>
                
                <div class="purchase-section">
                    <form action="individualProduct.php?product_id=<?= $product_id ?>" method="post">
                        <input type="hidden" name="product_id" value="<?= $productData['product_id'] ?>">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1">
                        <button type="submit" name="add_to_cart" class="add-to-cart-button">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
</body>
</html>