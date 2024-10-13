<?php
require_once BASE_DIR . '/includes/db.php';
require_once 'Product.php';

class Order {
    public $orderId;
    public $orderDate;
    public $status;
    public $products = [];

    public function __construct($orderId, $orderDate, $status) {
        $this->orderId = $orderId;
        $this->orderDate = $orderDate;
        $this->status = $status;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function displayProducts() {
        foreach ($this->products as $product) {
            echo "Product: " . htmlspecialchars($product->name) . ", Description: " . htmlspecialchars($product->description) . ", Price: $" . htmlspecialchars($product->price) . "<br/>";
        }
    }

    public static function displayAllOrdersWithDetails(PDO $pdo) {
        try {
            $sql = "SELECT o.order_id, o.order_date, o.status,
                        p.name, p.description, p.category, od.quantity, od.price
                    FROM orders o
                    LEFT JOIN orderdetails od ON o.order_id = od.order_id
                    LEFT JOIN product p ON od.product_id = p.product_id
                    ORDER BY o.order_id";
    
            $stmt = $pdo->query($sql);
            $orders = $stmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    
            foreach ($orders as $orderId => $orderDetails) {
                echo "Order ID: " . htmlspecialchars($orderId) . "<br>";
                foreach ($orderDetails as $detail) {
                    echo "Order Date: " . htmlspecialchars($detail['order_date'] ?? 'N/A') . "<br>";
                    echo "Status: " . htmlspecialchars($detail['status'] ?? 'N/A') . "<br>";
                    echo "Item: " . htmlspecialchars($detail['name'] ?? 'N/A') . "<br>";
                    echo "Description: " . htmlspecialchars($detail['description'] ?? 'N/A') . "<br>";
                    echo "Category: " . htmlspecialchars($detail['category'] ?? 'N/A') . "<br>";
                    echo "Quantity: " . htmlspecialchars($detail['quantity'] ?? 'N/A') . "<br>";
                    echo "Price per unit: $" . htmlspecialchars($detail['price'] ?? 'N/A') . "<br><br>";
                }
                echo "<hr>";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
    
    public static function displayOrders() {
        $pdo = get_connection();
        $order = new self(); //create new instance of Order
        $order->displayAllOrdersWithDetails($pdo);
    }

    public function getOrderId() {
        return $this->orderId;
    }

    public function getOrderDate() {
        return $this->orderDate;
    }

    public function getStatus() {
        return $this->status;
    }

}
$pdo = get_connection();
Order::displayAllOrdersWithDetails($pdo);
