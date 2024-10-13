<?php
require_once '../includes/db.php';

//for errors
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get product details from the form the db
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    //validate input
    if (!empty($name) && !empty($description) && !empty($category) && !empty($price)) {
        $pdo = get_connection();
        $sql = "INSERT INTO product (name, description, category, price) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $description, $category, $price]);

            $message = "Product added successfully!";
        } catch (PDOException $e) {
            $message = "Error adding product: " . $e->getMessage();
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Product</title>
</head>
<body>
    <h2>Add a New Product</h2>

    <?php if ($message) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="admin.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br>

        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" required><br>

        <label for="price">Price ($):</label><br>
        <input type="number" id="price" name="price" step=".01" required><br>

        <input type="submit" value="Add Product">
    </form>
</body>
</html>
