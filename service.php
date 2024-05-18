<?php
include("connectdb.php");
session_start();
if (!isset($_SESSION['nama'])) {
    header("location:login.php");
    exit();
}
$user=$_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Laundry</title>
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
            <?php
            if ($_SESSION['nama']!='admin'){?>
            <a href="transaksi.php">Transaction</a>
            <?php
        }?>
            <?php if ($_SESSION['nama'] == 'admin') { ?>
                <a href="customer.php">Customer</a>
            <?php } ?>
            <a href="logout.php">LogOut</a>
        </div>
    </div>
</div>
<div class="content">
    <?php 
    if ($user=='admin'){?> 
<button class="add-button" onclick="location.href='add_data.php';">Add Service</button> <!-- Add Data button -->
<?php } ?>
    <table>
        <thead>
            <tr>
                <th>Service Name</th>
                <th>Price (Rp)</th>
                <th>Image</th>
                <th>Action</th> <!-- Kolom tambahan untuk tombol delete -->
            </tr>
        </thead>
        <tbody>
            <?php
            $msql = "SELECT * FROM layanan";
            $result = mysqli_query($connect, $msql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_layanan']) ?></td>
                        <td><?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td><img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_layanan']) ?>"></td>
                        <td><?php if($user=='admin'){?>
                             <form action="delete_service.php" method="post">
                             <input type="hidden" name="id_layanan" value="<?= $row['id_layanan'] ?>">
                             <button type="submit" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                         </form>
                         <form action="update_service.php" method="post">
                        <input type="hidden" name="id_layanan" value="<?= $row['id_layanan'] ?>">
                        <button type="submit" class="update-button">Update</button>
</form>
<?php
}?>
                           
                            <form action="order.php" method="post">
                                <!-- Tombol "Order" -->
                                <input type="hidden" name="id_layanan" value="<?= $row['id_layanan'] ?>">
                                <button type="submit" class="order-button">Order</button>
                            </form>
                        </td>
                    </tr>
                <?php } 
            } else {
                echo "<tr><td colspan='4'>No services available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
        <footer class="footer">
            <p>&copy; 2024 Luxury Laundry. All rights reserved.</p>
        </footer>
</body>
</html>
