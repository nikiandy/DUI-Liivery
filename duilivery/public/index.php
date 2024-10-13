<?php
$pageTitle = 'Welcome to DUI-livery';


include '../includes/header.php';

define('BASE_DIR', dirname(__DIR__));
require_once BASE_DIR . '/includes/db.php';

$pdo = get_connection();

try {
    $stmt = $pdo->query("SELECT product_id, name, description, category, price FROM product ORDER BY product_id ASC");
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Could not retrieve products: " . $e->getMessage());
}

require_once '../classes/Sale/Product.php';
require_once '../classes/Sale/Order.php';
require_once '../classes/Delivery/Delivery.php';
require_once '../classes/Users/User.php';

$order = new Order(1, 2024-03-16, "not delivered");

foreach ($products as $productData) {
    $product = new Product($productData['product_id'], $productData['name'], $productData['description'], $productData['category'], $productData['price']);
    $order->addProduct($product);
}

// HTML
?>
<body>
<link rel="stylesheet" href="../css/index.css">
</body>
<ar>
<a href="#"></a>
<div class="hero-image">
  <div class="hero-text">
    <h1 style="font-size:50px">Sip, Click, Repeat</h1>
  </div>
  <div class="hero-text2">
  <p>Explore Our Spirits!</p>
  </div>
</div>
<br>
<body>
    <div class="container">
        <h2 class="title">Our Products</h2>
        
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <?php 
                    $imageName = str_replace(' ', '_', $product['name']);
                    $productLink = 'individualProduct.php';
                ?>
                <a href="<?= $productLink ?>?product_id=<?= $product['product_id'] ?>">
                    <img src="../images/<?= $imageName ?>.jpg" alt="<?= htmlspecialchars($product['name']) ?>">
                </a>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p>Category: <?= htmlspecialchars($product['category']) ?></p>
                <p>Price: $<?= htmlspecialchars($product['price']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>



        <div class="order-details">
            <h3>Products in Order:</h3>
            <?php
            $order->displayProducts();

            $product1 = new Product(1, "Guinness", "DRAUGHT STOUT BEER 8 X 500ML CANS", "Beer", 14.00);
            $product2 = new Product(2, "Smirnoff", "NO. 21 VODKA RED LABEL 1L", "Spirits", 31.50);

            echo "<h3>Delivery cannot exist without order (full composition):</h3>";

            $user = new User(1, "marcel", "marcel@gmail.com");
            $order = new Order(6, 2024-03-17, "not delivered");
            $order->addProduct($product1);
            $order->addProduct($product2);

            $delivery = new Delivery(2, 2024-03-17, "123 Main St, Anytown", $user, $order);
            $delivery->displayDeliveryDetails();
            ?>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>