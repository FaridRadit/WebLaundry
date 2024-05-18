<?php 
 
session_start();
 
if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
            <?php
        if (($_SESSION['nama']=='admin')){?>
            <a href="customer.php">Customer</a>
            <?php
        }?>
            <a href="logout.php">LogOut</a>
            </div>
          
           
        </div> 
    </div>
    <div class="container">
        <header class="header">
            <h1>Welcome to Luxury Laundry</h1>
            <p>Your premium solution for all laundry needs.</p>
        </header>
        
        <section class="services">
            <h2>Our Services</h2>
            <div class="service-item">
                <h3>Wash & Fold</h3>
                <p>High-quality wash and fold service for your everyday laundry needs.</p>
            </div>
            <div class="service-item">
                <h3>Dry Cleaning</h3>
                <p>Professional dry cleaning for your delicate and special garments.</p>
            </div>
            <div class="service-item">
                <h3>Ironing</h3>
                <p>Crisp and perfect ironing to keep your clothes looking sharp.</p>
            </div>
        </section>
        
        <section class="about">
            <h2>About Us</h2>
            <p>Luxury Laundry is committed to providing top-notch laundry services with a focus on quality and customer satisfaction. Our state-of-the-art facilities and experienced staff ensure that your clothes are treated with the utmost care.</p>
        </section>
        
        <footer class="footer">
            <p>&copy; 2024 Luxury Laundry. All rights reserved.</p>
        </footer>
    </div>

</body>

</html>