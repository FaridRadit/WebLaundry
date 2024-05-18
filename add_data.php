<?php
session_start();
$user=$_SESSION['nama'];
if (!$user=='admin') {
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service - Luxury Laundry</title>
    <link href="home.css" rel="stylesheet">
</head>
<body>
<div class="topnav">
    <div class="isi">
        <div class="title">
            <a href="#">Luxury Laundry</a>
        </div>
        <div class="list">
            <a href="service.php">Order</a>
            <a href="homepage.php">Dashboard</a>
            <?php if ($_SESSION['nama'] == 'admin') { ?>
                <a href="customer.php">Customer</a>
            <?php } ?>
            <a href="logout.php">LogOut</a>
        </div>
    </div>
</div>
<div class="content">
    <h2>Add New Service</h2>
    <form action="insert_service.php" method="post" enctype="multipart/form-data">
        <label for="nama_layanan">Service Name:</label><br>
        <input type="text" id="nama_layanan" name="nama_layanan" required><br><br>
        
        <label for="harga">Price (Rp):</label><br>
        <input type="number" id="harga" name="harga" required><br><br>
        
        <label for="gambar">Image:</label><br>
        <input type="file" id="gambar" name="gambar" accept="image/*" required><br><br>
        
        <button type="submit" class="add-button">Add Service</button>
    </form>
</div>

<footer class="footer">
    <p>&copy; 2024 Luxury Laundry. All rights reserved.</p>
</footer>
</body>
</html>
