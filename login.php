<?php
session_start();
if (isset($_SESSION["isUser"])) {
    header("Location: dashboard.php");
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
    $username = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"]) or empty($_POST["password"])) {
            echo '<script>alert("All fields are must")</script>';
        } else {
            include_once "./db/db.php";
            $username = htmlspecialchars($_POST["username"]);
            $isUser = $conn->query("SELECT * FROM users WHERE username = '$username'");
            if ($isUser->num_rows > 0) {
                $row = $isUser->fetch_row();
                $result = password_verify($_POST["password"], $row[3]);
                if ($result) {
                    session_start();
                    $_SESSION["isUser"] = true;
                    $_SESSION["username"] = $username;
                    header("Location: dashboard.php");
                } else {
                    echo '<script>alert("Wrong password, please try again with right password")</script>';
                }
            } else {
                echo '<script>alert("Username not found, Please register first")</script>';
            }
        }
    }
    ?>
  <div class="container">
    <h1>Login</h1>
    <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
      <label for="username">Username:</label>
      <input type="text" name="username" required />
      <label for="password">Password:</label>
      <input type="password" name="password" required />
      <button type="submit">Login</button>
    </form>
    <p>Dont have an account? <a href="register.php">Register</a></p>
  </div>
</body>

</html>
