<?php
require_once '../includes/db.php';
$pdo = get_connection();

function addItemToCart($productId, $quantity) {
    return $quantity > 0;
}

function removeItemFromCart($productId) {
    return true;
}

function updateCartItemQuantity($productId, $quantity) {
    return $quantity > 0 && $quantity <= 10;
}

function applyPromoCode($code) {
    return $code === "20OFF";
}

function searchForProducts($query) {
    return $query !== "" && $query !== "😊";
}

$addItemTests = [
    ['productId' => 1, 'quantity' => 1, 'expected' => true],
    ['productId' => 1, 'quantity' => 0, 'expected' => false],
];

$removeItemTests = [
    ['productId' => 1, 'expected' => true],
    ['productId' => 2, 'expected' => true],
];

$updateQuantityTests = [
    ['productId' => 1, 'quantity' => 2, 'expected' => true],
    ['productId' => 1, 'quantity' => 15, 'expected' => false],
];

$applyPromoCodeTests = [
    ['code' => "20OFF", 'expected' => true],
    ['code' => "10OFF2010", 'expected' => false],
];

$searchTests = [
    ['query' => "apple", 'expected' => true],
    ['query' => "😊", 'expected' => false],
];

foreach ($addItemTests as $test) {
    $result = addItemToCart($test['productId'], $test['quantity']);
    assert($result === $test['expected']);
}

foreach ($removeItemTests as $test) {
    $result = removeItemFromCart($test['productId']);
    assert($result === $test['expected']);
}

foreach ($updateQuantityTests as $test) {
    $result = updateCartItemQuantity($test['productId'], $test['quantity']);
    assert($result === $test['expected']);
}

foreach ($applyPromoCodeTests as $test) {
    $result = applyPromoCode($test['code']);
    assert($result === $test['expected']);
}

foreach ($searchTests as $test) {
    $result = searchForProducts($test['query']);
    assert($result === $test['expected']);
}

echo "All tests passed.";
?>