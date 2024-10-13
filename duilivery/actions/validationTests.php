<?php
require_once '../includes/db.php';

/**
 * Validation Test 1: Login system.
 */
function validateUsernameUniqueness($username) {
    $pdo = get_connection();
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        throw new Exception("Username is already taken.");
    }
}
function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format.");
    }

    $pdo = get_connection();
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        throw new Exception("Email is already registered.");
    }
}
function validatePasswordStrength($password) {
    $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/';
    if (!preg_match($pattern, $password)) {
        throw new Exception("Password does not meet complexity requirements.");
    }
}
function validateProductCreation($name, $description, $category, $price) {
    if (empty($name) || empty($description) || empty($category)) {
        throw new Exception("All fields must be filled out.");
    }

    if (!is_numeric($price) || $price <= 0) {
        throw new Exception("Price must be a positive number.");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (isset($_POST['username'])) {
            validateUsernameUniqueness($_POST['username']);
            echo "Username uniqueness validation passed.<br>";
        }

        if (isset($_POST['email'])) {
            validateEmail($_POST['email']);
            echo "Email format and uniqueness validation passed.<br>";
        }

        if (isset($_POST['password'])) {
            validatePasswordStrength($_POST['password']);
            echo "Password strength validation passed.<br>";
        }

        if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price'])) {
            validateProductCreation($_POST['name'], $_POST['description'], $_POST['category'], $_POST['price']);
            echo "Product creation validation passed.<br>";
        }
    } catch (Exception $e) {
        echo "Validation test failed: " . $e->getMessage() . "<br>";
    }

    /**
     * Validation Test 2: Order Placement Validation
     * Ensures that an order can be placed with valid product selections.
     */
    function validateOrderPlacement($productId, $quantity) {
        $pdo = get_connection();
        
        // Check if product exists
        $stmt = $pdo->prepare("SELECT id FROM product WHERE product_id = :product_id");
        $stmt->bindParam(":product_id", $productId, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() !== 1) {
            throw new Exception("Product does not exist.");
        }

        // Check if quantity is valid
        if (!is_numeric($quantity) || $quantity <= 0) {
            throw new Exception("Quantity must be a positive number.");
        }
    }

    /**
     * Validation Test 3: Delivery Information Validation
     * Verifies that all necessary delivery information is provided and in the correct format.
     */
    function validateDeliveryInformation($address, $deliveryDate) {
        if (empty($address)) {
            throw new Exception("Delivery address cannot be empty.");
        }
        
        $dateRegex = '/^\d{4}-\d{2}-\d{2}$/';
        if (!preg_match($dateRegex, $deliveryDate)) {
            throw new Exception("Delivery date must be in YYYY-MM-DD format.");
        }
    }

    /**
     * Validation Test 4: Profile Update Validation
     * Checks that the user can update their profile with valid data.
     */
    function validateProfileUpdate($firstName, $lastName, $email) {
        if (empty($firstName) || empty($lastName)) {
            throw new Exception("Name fields cannot be empty.");
        }
        
        validateEmail($email);
    }

}
?>