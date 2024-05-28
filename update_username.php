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
    $username = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            echo '<script>alert("All fields are must")</script>';
        } else {
            include_once "./db/db.php";
            $username = htmlspecialchars($_POST["username"]);
            $isUser = $conn->query("SELECT * FROM users WHERE username = '".$_SESSION["username"]."'");
            if ($isUser->num_rows > 0) {
                $conn->query("UPDATE users SET username = '$username' WHERE username = '".$_SESSION["username"]."';");
                header("Location: logout.php");
            } else {
                echo '<script>alert("Username not found, Please register first")</script>';
            }
        }
    }
    ?>
  <div class="container">
    <h2>Update Username</h2>
    <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
      <button type="submit">Update Username</button>
    </form>
  </div>
</body>

</html>
