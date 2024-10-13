<?php
session_start();

require_once '../includes/db.php';

if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0) {
    if (!isset($_SESSION['shopping_cart'])) {
        $_SESSION['shopping_cart'] = array();
    }

    //product details
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    
    $_SESSION['shopping_cart'][$product_id] = $quantity;

    //redirect to shopping cart page
    header("Location: shoppingCart.php");
    exit();
} else {
    //redirect to the product page if the addition to cart fails
    header("Location: individualProduct.php?product_id=" . $_POST['product_id']);
    exit();
}
?>