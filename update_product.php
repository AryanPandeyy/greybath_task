<?php
session_start();
if (!isset($_SESSION["isUser"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile</title>
  <link rel="stylesheet" href="./style/styles.css">
</head>

<body>
  <?php
    $product_name = "";
    $product_desc = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["product_name"]) or empty($_POST["product_desc"])) {
            echo '<script>alert("All fields are must")</script>';
        } else {
            include_once "./db/db.php";
            $product_name = htmlspecialchars($_POST["product_name"]);
            $product_desc = htmlspecialchars($_POST["product_desc"]);
            $isProduct = $conn->query("SELECT * FROM Products WHERE id = '".$_GET["id"]."'");
            if ($isProduct->num_rows > 0) {
                $conn->query("UPDATE Products SET product_name = '$product_name' , product_desc = '$product_desc' WHERE id = '".$_GET["id"]."';");
                header("Location: dashboard.php");
            } else {
                echo '<script>alert("Product not found")</script>';
            }
        }
    }
    ?>
  <div class="container">
    <h2>Update Product</h2>
    <form action="<?php echo htmlspecialchars(
        $_SERVER[" PHP_SELF"]
    ); ?>" method="post">
      <label for="product_name">Product Name:</label>
    <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars(
        $product_name
    ); ?>" required>
      <label for="product_desc">Product Description:</label>
    <input type="text" id="product_desc" name="product_desc" value="<?php echo htmlspecialchars(
        $product_desc
    ); ?>" required>
      <button type="submit">Update Email</button>
    </form>
  </div>
</body>

</html>
