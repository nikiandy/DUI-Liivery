<?php
define('BASE_DIR', realpath(dirname(__FILE__) . '/..'));
require_once BASE_DIR . '/classes/Delivery/Delivery.php';
require_once BASE_DIR . '/classes/Users/User.php';
require_once BASE_DIR . '/classes/Sale/Order.php';

// Test Case for Delivery class
echo "Running DeliveryTest...\n";
$user = new User(1, 'testUser', 'test@example.com');
$order = new Order(1, '2024-01-01', 'Pending');
$delivery = new Delivery(1, '2024-01-02', '123 Main St', $user, $order);

assert($delivery->deliveryId === 1, new Exception("Delivery ID should be 1"));
assert($delivery->deliveryDate === '2024-01-02', new Exception("Delivery date should be '2024-01-02'"));
assert($delivery->address === '123 Main St', new Exception("Delivery address should be '123 Main St'"));
assert($delivery->user === $user, new Exception("Delivery user should be the same instance as the created user"));
assert($delivery->order === $order, new Exception("Delivery order should be the same instance as the created order"));
echo "DeliveryTest completed.\n";
?>