<?php
define('BASE_DIR', realpath(dirname(__FILE__) . '/..'));
require_once BASE_DIR . '/classes/Sale/Order.php';
require_once BASE_DIR . '/classes/Sale/Product.php';

// Test Case for Order class
echo "Running OrderTest...\n";
$order = new Order(1, '2024-01-01', 'Pending');
$product = new Product("Whiskey", "Aged 12 years", "Beverages", 39.99, 1);
$order->addProduct($product);

assert($order->orderId === 1, new Exception("Order ID should be 1"));
assert($order->orderDate === '2024-01-01', new Exception("Order date should be '2024-01-01'"));
assert($order->status === 'Pending', new Exception("Order status should be 'Pending'"));
assert(in_array($product, $order->products), new Exception("Product should be in the order's products array"));
echo "OrderTest completed.\n";
?>