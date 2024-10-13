<?php
require_once '../classes/Sale/Product.php';

// Test Case for Product class
echo "Running ProductTest...\n";
$product = new Product("Whiskey", "Aged 12 years", "Beverages", 39.99, 1);
assert($product->getId() === 1, new Exception("Product ID should be 1"));
assert($product->getName() === "Whiskey", new Exception("Product name should be 'Whiskey'"));
assert($product->getDescription() === "Aged 12 years", new Exception("Description should be 'Aged 12 years'"));
assert($product->getCategory() === "Beverages", new Exception("Category should be 'Beverages'"));
assert($product->getPrice() === 39.99, new Exception("Price should be 39.99"));
echo "ProductTest completed.\n";
?>