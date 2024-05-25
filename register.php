<?php
$conn = new mysqli("127.0.0.1", "root", "123", "test", "3307");
if ($conn->connect_error) {
  die($conn->connect_error);
}
?>
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
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT);
    $sql = "INSERT INTO `users` (`username`, `email`, `password_hash`) VALUES ('".$username."', '".$email."', '".$password."');";
    if ($conn->query($sql) == true) {
      echo '<script>alert("NEW RECORD ADDED")</script>';
    } else {
      echo "ERROR: $conn->error";
    }
  }
  ?>
  <h1>Register</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required />
    <label for="email">Email:</label>
    <input type="text" name="email" required />
    <label for="password">Password:</label>
    <input type="password" name="password" required />
    <button type="submit">Register</button>
  </form>
  <?php
echo $username;
echo $email;
echo $password;
?>
</body>

</html>
