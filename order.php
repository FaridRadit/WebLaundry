<?php
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit();
}

include("connectdb.php");
$nama=$_SESSION['nama'];
$msql="SELECT * FROM user WHERE Username='$nama'";
$result=mysqli_query($connect,$msql);
if(mysqli_num_rows($result)>0){
    $baris=mysqli_fetch_array($result);

}
$id = $_POST['id_layanan'];
$msql = "SELECT * FROM layanan WHERE id_layanan='$id'";
$result = mysqli_query($connect, $msql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $service_name = $row['nama_layanan'];
    $_SESSION['layanan']=$service_name;
    $price = $row['harga']; // Assuming there is a price column in your layanan table
} else {
    echo "Service not found";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <link href="fill.css" rel="stylesheet">
</head>
<body>
<div class="content">
    
<div class="title">
<h2 style="text-align:center;">Order Form</h2>
</div>
<div class="form"></div>
<form action="orderprocess.php" method="post">
    <input type="hidden" name="id_layanan" value="<?php echo $id; ?>">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?= $baris['Username']?>"  readonly>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="address">Address</label>
    <textarea id="address" name="address" rows="4" required></textarea>

    <label for="service">Service Name</label>
    <input type="text" id="service" name="service" value="<?php echo $service_name; ?>" readonly>
    
    <label for="price">Price (Rp)</label>
    <input type="text" id="price" name="price" value="<?php echo number_format($price, 0, ',', '.'); ?>" readonly>

    <label for="amount_paid">Amount Paid (Rp)</label>
    <input type="number" id="amount_paid" name="amount_paid" required min="0">


    <input type="submit" value="Submit">
</form>
</div>
</div>

</body>
</html>
