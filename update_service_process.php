<?php
include("connectdb.php");
session_start();

$user = $_SESSION['nama'];
if ($user != 'admin') {
    header("location:login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_layanan = $_POST['id_layanan'];
    $nama_layanan = $_POST['nama_layanan'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar'];

    $gambar_path = null;

    // Handle image upload if a new image is provided
    if ($gambar['error'] == UPLOAD_ERR_OK) {
        $gambar_path = 'images/' . basename($gambar['name']);
        move_uploaded_file($gambar['tmp_name'], $gambar_path);
    }

    // Update the database with new values
    if ($gambar_path) {
        $query = "UPDATE layanan SET nama_layanan = ?, harga = ?, gambar = ? WHERE id_layanan = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sisi", $nama_layanan, $harga, $gambar_path, $id_layanan);
    } else {
        $query = "UPDATE layanan SET nama_layanan = ?, harga = ? WHERE id_layanan = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sii", $nama_layanan, $harga, $id_layanan);
    }

    if ($stmt->execute()) {
        header("location:homepage.php?update_success=1");
    } else {
        echo "Error updating record: " . $connect->error;
    }
}
?>
