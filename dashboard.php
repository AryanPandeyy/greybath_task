<?php
session_start();
if (!isset($_SESSION["isUser"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GreyBath</title>
  <link rel="stylesheet" href="./style/styles.css">
</head>

<body>
  <div class="container">
    <?php
    require_once "./db/db.php";
    $result = $conn->query(
        "SELECT Products.id, `product_name`, `product_desc`, users.username FROM `Products` JOIN `users` ON `users_id` = users.id;"
    );
    if ($result) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($products as $product) {
            if (isset($product["product_name"]) && isset($product["product_desc"])) {
                echo "<div class='product'>";
                echo "<h2>" . htmlspecialchars($product["product_name"]) . "</h2>";
                echo "<p>" . htmlspecialchars($product["product_desc"]) . "</p>";
                echo "<p><strong>Created by: </strong>" . htmlspecialchars($product["username"]) . "</p>";
                echo "<a href='update_product.php?id=".$product["id"]."'>update</a>";
                echo "<a href='delete_product.php?id=".$product["id"]."'>delete</a>";
                echo "</div><br>";
            }
        }
    } else {
        echo "Error: " . $conn->error;
    }
    ?>
    <a href="profile.php">Profile</a>
    <br>
    <a href="create_product.php">Create Product?</a>
    <br>
    <a href="logout.php">LogOut</a>
  </div>
</body>

</html>
