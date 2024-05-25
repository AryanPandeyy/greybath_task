<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GreyBath</title>
</head>

<body>
  <?php
  $username = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"]) or empty($_POST["password"])) {
      echo '<script>alert("All fields are must")</script>';
    } else {
      require_once "./db/db.php";
      $username = htmlspecialchars($_POST["username"]);
      $isUser = $conn->query("SELECT * FROM users WHERE username = '$username'");
      if ($isUser->num_rows > 0) {
        $row = $isUser->fetch_row();
        $result = password_verify($_POST["password"], $row[3]);
        if ($result) {
          echo '<script>window.location.href = "dashboard.php"</script>';
        } else {
          echo "ERROR: $conn->error";
        }
      } else {
        echo '<script>alert("Username not found, Please register first")</script>';
      }
    }
  }
  ?>
  <h1>Login</h1>
  <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required />
    <label for="password">Password:</label>
    <input type="password" name="password" required />
    <button type="submit">Register</button>
  </form>
  <p>Dont have an account? <a href="register.php">Register</a></p>
</body>

</html>
