<?php
session_start();

if (!isset($_SESSION['isUser'])) {
    header("Location: login.php");
}

if (isset($_GET['id'])) {
    include_once "./db/db.php";
    $conn->query("DELETE FROM Products WHERE id = '".$_GET["id"]."'");
    header("Location: dashboard.php");
}
?>
