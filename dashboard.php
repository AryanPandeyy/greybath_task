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
    <a href="profile.php">Profile</a>
     <a href="logout.php">LogOut</a>
</body>

</html>
