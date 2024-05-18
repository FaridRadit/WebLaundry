<?php
include("connectdb.php");
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>luxury Laundry</title>
    <link rel="stylesheet" href="home.css">
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
    <h2>Customer Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Service</th>
                <th>Pickup Date</th>
                <th>Delivery Date</th>
                <!-- Remove extra column header -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to select data from the 'pesanan' table
            $msql = "SELECT * FROM pesanan";
            $result = mysqli_query($connect, $msql);

            // Query to select data from the 'delivery' table
            $sqll = "SELECT * FROM delivery";
            $res = mysqli_query($connect, $sqll);

            // Check if both queries are successful
            if ($result && $res) {
                // Fetch data from both result sets
                while ($row = mysqli_fetch_assoc($result)) {
                    $baris = mysqli_fetch_assoc($res); // Fetch corresponding row from 'delivery' table
                    
                    // Check if $baris is not null before accessing its elements
                    if ($baris !== null) {
                        ?>

                        <tr><?php if($row['customer_name']==$_SESSION['nama']){?>
                            
                            <td><?= htmlspecialchars($row['order_id']) ?></td>
                            <td><?= htmlspecialchars($row['customer_name']) ?></td>
                            <td><?= htmlspecialchars($row['order_date']) ?></td>
                            <td><?= htmlspecialchars($row['service']) ?></td>
                            <td><?= htmlspecialchars($baris['pickup_date']) ?></td>
                            <td><?= htmlspecialchars($baris['delivery_date']) ?></td>
                            <!-- Removed extra <td> tag -->
                        <?php } ?>
                        </tr>
                        <?php
                    }
                }
            } else {
                echo "<tr><td colspan='6'>No orders available.</td></tr>"; // Adjusted colspan to match number of columns
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
