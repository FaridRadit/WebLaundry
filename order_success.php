<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <link href="home.css" rel="stylesheet">
</head>
<body>
<div class="content">
    <h2>Order Successful</h2>
    <p>Your order has been placed successfully.</p>
    <a href="homepage.php">Return to Dashboard</a>
</div>
<footer class="footer">
    <p>&copy; 2024 Luxury Laundry. All rights reserved.</p>
</footer>
</body>
</html>
