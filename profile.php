<?php
  session_start();
if (!isset($_SESSION["isUser"])) {
    header("Location: login.php");
}
?>
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
    $user = $conn->query("SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
    $userinfo = [];
    if ($user->num_rows > 0) {
        $userinfo = $user->fetch_row();
    } else {
        header("Location: login.php");
    }
    ?>
  <div class="container" <h1>Profile</h1>
    <h3>Username:
      <?php echo $userinfo[1]; ?>
    </h3>
    <h3>Email:
      <?php echo $userinfo[2]; ?>
    </h3>
    <a href="update_username.php">Update Username?</a>
        <a href="update_email.php">Update Email?</a>
    <a href="logout.php">LogOut</a>
  </div>
</body>

</html>
