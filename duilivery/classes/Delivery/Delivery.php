<?php
define('BASE_PATH', realpath(__DIR__ . '/../..'));
require_once BASE_PATH . '/classes/Users/User.php';
require_once BASE_PATH . '/classes/Sale/Order.php';

class Delivery {
    public $deliveryId;
    public $deliveryDate;
    public $address;
    public $user;
    public $order;

    public function __construct($deliveryId, $deliveryDate, $address, User $user, Order $order) {
        // Cannot exist without an order
        $this->deliveryId = $deliveryId;
        $this->deliveryDate = $deliveryDate;
        $this->address = $address;
        $this->user = $user;
        $this->order = $order;
    }

    public function displayDeliveryDetails() {
        echo "Delivery ID: " . $this->deliveryId . "<br>";
        echo "Delivery Address: " . $this->address . "<br>";
        echo "Order Details: <br>";
        $this->order->displayProducts();
    }

    public function deliver() {
        //implementation for delivery
    }
}
