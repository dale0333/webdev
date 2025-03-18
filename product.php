<?php
session_start();
include 'connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier = $_POST['supplier'];
    $description = $_POST['description'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO products (name, category, price, stock, supplier, description, created_at, updated_at) 
            VALUES ('$name', '$category', '$price', '$stock', '$supplier', '$description', '$created_at', '$updated_at')";
    
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Table</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; padding: 20px; }
        table { width: 90%; margin: 20px auto; border-collapse: collapse; background: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 10px; overflow: hidden; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .btn { display: inline-block; padding: 10px 20px; margin: 10px; font-size: 18px; color: white; background-color: #007bff; text-decoration: none; border-radius: 5px; }
        .btn:hover { background-color: #0056b3; }
        .form-container { width: 50%; margin: 20px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); text-align: left; }
        .form-container input, .form-container select, .form-container button { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ddd; border-radius: 5px; }
        .form-container button { background-color: #007bff; color: white; cursor: pointer; }
        .form-container button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h1>Products List</h1>
    <div class="form-container">
        <form method="post">
            <label>Product Name:</label>
            <input type="text" name="name" required>
            
            <label>Category:</label>
            <select name="category" required>
                <option value="Electronics">Electronics</option>
                <option value="Clothing">Clothing</option>
                <option value="Home & Kitchen">Home & Kitchen</option>
                <option value="Sports">Sports</option>
                <option value="Books">Books</option>
            </select>
            
            <label>Price:</label>
            <input type="number" step="0.01" name="price" required>
            
            <label>Stock:</label>
            <input type="number" name="stock" required>
            
            <label>Supplier:</label>
            <input type="text" name="supplier" required>
            
            <label>Description:</label>
            <input type="text" name="description" required>
            
            <button type="submit">Add Product</button>
        </form>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Supplier</th>
            <th>Description</th>
            <th>Created At</th>
        </tr>
        <?php
        $sql = "SELECT * FROM products";
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>" . $row['supplier'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
            $result->free();
        } else {
            echo "<tr><td colspan='8'>No products found.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <a href="homepage.php" class="btn">Back to Homepage</a>
</body>
</html>
