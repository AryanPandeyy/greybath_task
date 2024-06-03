<?php
session_start();
if(!isset($_SESSION["isUser"])) {
    header("Location: login.php");
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
  <?php
    require_once "./db/db.php";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["product_name"]) or empty($_POST["product_desc"])) {
            echo '<script>alert("Please fill all the details")</script>';
        } else {
            $product_name = htmlspecialchars($_POST["product_name"]);
            $product_desc = htmlspecialchars($_POST["product_desc"]);
            $isUser = $conn->query("SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
            if ($isUser->num_rows > 0) {
                $userinfo = $isUser->fetch_row();
                if ($conn->query("INSERT INTO `Products` (`product_name`, `product_desc`, `users_id`) VALUES ('".$product_name."', '".$product_desc."', '".$userinfo[0]."');") == true) {
                    echo '<script>alert("Added")</script>';
                } else {
                    echo "$conn->error";
                }
            } else {
                echo 'No username found, please login again';
            }
        }
    }
    ?>
  <div class="container">
    <h1>Create Product</h1>
    <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
      <label for="username">Name:</label>
      <input type="text" name="product_name" required />
      <label for="email">Description:</label>
      <input type="text" name="product_desc" required />
      <button type="submit">Create</button>
    </form>
  </div>
</body>

</html>

