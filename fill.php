<?php
include("connectdb.php");
session_start();
$user = $_SESSION['nama'];
if ($user !== 'admin') {
    header("location:login.php");
    exit();
}

$row = []; // Initialize $row variable to avoid undefined variable error
$msql=$_SESSION['nama'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['order_id'];
    $msql = "SELECT * FROM pesanan WHERE order_id='$id'";
    $query = mysqli_query($connect, $msql);
    if ( mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxuryLaundry - Delivery Data Entry</title>
    <link href="fill.css" rel="stylesheet">
</head>
<body>
   <div class="content">

  <div class="title">
  <h2>Delivery Data Entry</h2>
  </div>
  <div class="form"></div>
    
    <form method="POST" action="process_delivery.php" onsubmit="return validateForm()">
        <label for="order_id">Order ID:</label>
        <input type="text" id="order_id" name="order_id" value="<?= $row['order_id'] ?>" readonly><br><br>

        <label for="order_date">Order Date:</label>
        <input type="date" id="order_date" name="order_date" value="<?= $row['order_date'] ?>" readonly><br><br>    

        <label for="Customer_name">Customer name:</label>
        <input type="text" id="Customer_name" name="Customer_name" value="<?= $row['customer_name'] ?>" readonly><br><br>

        <label for="pickup_date">Pickup Date:</label>
        <input type="date" id="pickup_date" name="pickup_date" required><br><br>

        <label for="delivery_date">Delivery Date:</label>
        <input type="date" id="delivery_date" name="delivery_date" required><br><br>

        <input type="submit" value="Submit">
    </form>
    </div>
    </div>
</body>
<script>
    function validateForm() {
        var orderDate = new Date(document.getElementById("order_date").value);
        var pickupDate = new Date(document.getElementById("pickup_date").value);
        var deliveryDate = new Date(document.getElementById("delivery_date").value);

        if (pickupDate < orderDate) {
            alert("Pickup date cannot be before order date.");
            return false;
        }

        if (deliveryDate < orderDate) {
            alert("Delivery date cannot be before order date.");
            return false;
        }

        return true;
    }
</script>
</html>
