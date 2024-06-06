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
  $username = $email = $password = "";
  function uploadFile($file, $des)
  {
      move_uploaded_file($file["tmp_name"], $des);
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      include_once "./db/db.php";
      if (empty($_POST["username"]) or empty($_POST["email"]) or empty($_POST["password"] or empty($_FILES['photo']))) {
          echo '<script>alert("All fields are must")</script>';
      } else {
          $des = dirname(__FILE__).'/uploads/'.basename($_FILES["photo"]["name"]);
          uploadFile($_FILES["photo"], $des);
          $username = htmlspecialchars($_POST["username"]);
          $email = htmlspecialchars($_POST["email"]);
          $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT);
          $result = $conn->query("SELECT * FROM users WHERE username = '$username' OR email = '$email'");
          if ($result->num_rows > 0) {
              echo '<script>alert("Username or Email already exist")</script>';
          } else {
              $sql = "INSERT INTO `users` (`username`, `email`, `password_hash`, `photo`) VALUES ('" . $username . "', '" . $email . "', '" . $password . "', '". '/uploads/'.basename($_FILES["photo"]["name"]) ."');";
              if ($conn->query($sql) == true) {
                  echo '<script>window.location.href = "login.php"</script>';
              } else {
                  echo "ERROR: $conn->error";
              }
          }
      }
  }
    ?>
  <div class="container">
    <h1>Register</h1>
    <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <label for="username">Username:</label>
      <input type="text" name="username" required />
      <label for="email">Email:</label>
      <input type="text" name="email" required />
      <label for="password">Password:</label>
      <input type="password" name="password" required />
      <label for="photo">Photo</label>
      <input name="photo" id="photo" type="file" placeholder="Photo">
      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
  </body>

  </html>
