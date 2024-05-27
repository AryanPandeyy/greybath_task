 <?php
 session_start();
 if(!isset($_SESSION["isUser"])) {
        header("Location: login.php");    
 }
    ?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GreyBath</title>
</head>
<body>
     <?php
            require_once "./db/db.php";
        $user = $conn->query("SELECT * FROM users WHERE username = '".$_SESSION['username']."'");
        $userinfo = [];
        if ($user->num_rows > 0) {
            $userinfo = $user->fetch_row();
        } else {
            header("Location: login.php");
        }
        ?>
        <h1>Profile</h1>
            <h3>Username: <?php echo $userinfo[1]?></h3>
            <h3>Email: <?php echo $userinfo[2]?></h3>
        <a href="logout.php">LogOut</a>
        </body>

        </html>
