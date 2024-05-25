<?php
$conn = new mysqli("127.0.0.1", "root", "123", "test", "3307");
if ($conn->connect_error) {
  die($conn->connect_error);
}
?>
