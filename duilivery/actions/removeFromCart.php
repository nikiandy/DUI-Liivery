<?php
session_start();

if (isset($_POST['product_id'])) {
    unset($_SESSION['shopping_cart'][$_POST['product_id']]);

    header('Location: ../public/shoppingCart.php');
    exit();
}
?>