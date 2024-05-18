<?php
include("connectdb.php");
session_start();

if (!isset($_SESSION['nama'])) {
    header("location:login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_layanan = mysqli_real_escape_string($connect, $_POST['nama_layanan']);
    $harga = mysqli_real_escape_string($connect, $_POST['harga']);
    
    // Handle file upload
    $target_dir = "gif/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["gambar"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Insert into database
            $gambar = $target_file;
            $sql = "INSERT INTO layanan (nama_layanan, harga, gambar) VALUES ('$nama_layanan', '$harga', '$gambar')";
            if (mysqli_query($connect, $sql)) {
                echo "The file ". basename($_FILES["gambar"]["name"]). " has been uploaded.";
                header("location: homepage.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connect);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "Invalid request.";
}
?>
