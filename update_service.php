<?php
include("connectdb.php");
session_start();

if (!isset($_SESSION['nama']) || $_SESSION['nama'] != 'admin') {
    header("location:login.php");
    exit();
}

if (isset($_POST['id_layanan'])) {
    $id_layanan = $_POST['id_layanan'];

    // Fetch current service details from the database
    $query = "SELECT * FROM layanan WHERE id_layanan = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id_layanan);
    $stmt->execute();
    $result = $stmt->get_result();
    $service = $result->fetch_assoc();
} else {
    header("location:homepage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Service</title>
    <link href="update.css" rel="stylesheet">
</head>
<body>
<div class="content">
    <h2>Update Service</h2>
    <form action="update_service_process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_layanan" value="<?= htmlspecialchars($service['id_layanan']) ?>">
        
        <div class="form-group">
            <label for="nama_layanan">Service Name:</label>
            <input type="text" id="nama_layanan" name="nama_layanan" value="<?= htmlspecialchars($service['nama_layanan']) ?>" required>
        </div>

        <div class="form-group">
            <label for="harga">Price (Rp):</label>
            <input type="number" id="harga" name="harga" value="<?= htmlspecialchars($service['harga']) ?>" required>
        </div>


        <div class="form-group">
            <label for="gambar">Image:</label>
            <input type="file" id="gambar" name="gambar" accept="image/*">
            <div class="current-img">
                <img src="<?= htmlspecialchars($service['gambar']) ?>" alt="Current Image" class="service-img">
            </div>
        </div>

        <button type="submit" class="update-button">Update Service</button>
    </form>
</div>
<footer class="footer">
    <p>&copy; 2024 Luxury Laundry. All rights reserved.</p>
</footer>
</body>
</html>
