<?php
session_start();

if (isset($_POST['product_id'], $_POST['quantity'])) {
    if (is_numeric($_POST['quantity']) && $_POST['quantity'] > 0) {
        //update quantity
        $_SESSION['shopping_cart'][$_POST['product_id']] = (int) $_POST['quantity'];
    } else {
        unset($_SESSION['shopping_cart'][$_POST['product_id']]);
    }

    header('Location: ../public/shoppingCart.php');
    exit();
}
?>