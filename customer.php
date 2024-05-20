<?php
include("connectdb.php");
session_start();
$user=$_SESSION['nama'];
if ($user=='admin') {
    
}
else {
    header("location:login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>luxuryLaundry</title>
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
    <h2>Customer Orders</h2>
    <table>
        <thead>
            <tr><?php
           
             ?>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Total Price (Rp)</th>
                <th>Service</th>
                <th>Gadget Number</th>
                <th>Address</th>
                <th>PickUp-Date</th>
                <th>Delivery-Date</th>
        
                <th>Action</th> <!-- Kolom tambahan untuk tombol delete dan update -->
            </tr>
        </thead>
        <tbody>
            <?php
            $msql = "SELECT * FROM pesanan"; // Table name changed to 'pesanan'
            $result = mysqli_query($connect, $msql);
           
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { 
                    
                    ?>
                    
               
                    <tr>
                        <td><?= htmlspecialchars($row['order_id']) ?></td>
                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td><?= htmlspecialchars($row['order_date']) ?></td>
                        <td><?= number_format($row['Total_price'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($row['service']) ?></td>
                        <td><?= htmlspecialchars($row['gadget_number']) ?></td>
                        <td><?= htmlspecialchars($row['Address']) ?></td><?php
                        $order_id=$row['order_id'];
                        $cus=$row['customer_name'];
                        $sqll = "SELECT * FROM delivery WHERE order_id='$order_id' AND username='$cus'";
                        $res = mysqli_query($connect, $sqll);
                        if ($res && mysqli_num_rows($res)>0){
                        $baris = mysqli_fetch_assoc($res);?>
                        <td><?= htmlspecialchars($baris['pickup_date']) ?></td>
                        <td><?= htmlspecialchars($baris['delivery_date']) ?></td>
                   <?php } 
                   else { 
                    
                    ?>
                    <td></td>
                    <td></td>
                   <?php } ?>
                        <td>
                        <form action="fill.php?order_id=<?=$row['order_id']?>" method="post">
                                <!-- Tombol "Order" -->
                                
                                <button type="submit" class="order-button">Fill</button>
                            </form>
                           
                        </td>
                    </tr>
                <?php } 
            } else {
                echo "<tr><td colspan='8'>No orders available.</td></tr>";
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