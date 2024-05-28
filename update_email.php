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
    $email = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            echo '<script>alert("All fields are must")</script>';
        } else {
            include_once "./db/db.php";
            $email = htmlspecialchars($_POST["email"]);
            $isUser = $conn->query("SELECT * FROM users WHERE username = '".$_SESSION["username"]."'");
            if ($isUser->num_rows > 0) {
                $conn->query("UPDATE users SET email = '$email' WHERE username = '".$_SESSION["username"]."';");
                header("Location: logout.php");
            } else {
                echo '<script>alert("Username not found, Please register first")</script>';
            }
        }
    }
    ?>
  <div class="container">
    <h2>Update Email</h2>
    <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
      <label for="username">Email:</label>
      <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
      <button type="submit">Update Email</button>
    </form>
  </div>
</body>

</html>
