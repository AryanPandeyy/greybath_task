<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GreyBath</title>
</head>

<body>
  <?php
  $username = $email = $password = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "./db/db.php";
    if (empty($_POST["username"]) or empty($_POST["email"]) or empty($_POST["password"])) {
      echo '<script>alert("All fields are must")</script>';
    } else {
      $username = htmlspecialchars($_POST["username"]);
      $email = htmlspecialchars($_POST["email"]);
      $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT);
      $result = $conn->query("SELECT * FROM users WHERE username = '$username' OR email = '$email'");
      if ($result->num_rows > 0) {
        echo '<script>alert("Username or Email already exist")</script>';
      } else {
        $sql = "INSERT INTO `users` (`username`, `email`, `password_hash`) VALUES ('" . $username . "', '" . $email . "', '" . $password . "');";
        if ($conn->query($sql) == true) {
          echo '<script>window.location.href = "login.php"</script>';
        } else {
          echo "ERROR: $conn->error";
        }
      }
    }
  }
  ?>
  <h1>Register</h1>
  <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required />
    <label for="email">Email:</label>
    <input type="text" name="email" required />
    <label for="password">Password:</label>
    <input type="password" name="password" required />
    <button type="submit">Register</button>
  </form>
  <p>Already have an account? <a href="login.php">Login</a></p>
</body>

</html>
