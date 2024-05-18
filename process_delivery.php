<?php
include("connectdb.php");
session_start();
$user=$_SESSION['nama'];
if ($user=='admin'){

}
else {
    header("location:login.php");
    exit();
}
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $order_id = $_POST['order_id'];
    $order_date = $_POST['order_date'];
    $pickup_date = $_POST['pickup_date'];
    $delivery_date = $_POST['delivery_date'];
    $username=$_POST['Customer_name'];

    // Validate dates
    if ($pickup_date < $order_date || $delivery_date < $order_date) {
        echo "Error: Pickup date or delivery date cannot be before order date.";
        exit;
    }

    // Insert data into the delivery table
    $insert_query = "INSERT INTO delivery (order_id,username,order_date, pickup_date, delivery_date) VALUES ('$order_id','$username', '$order_date', '$pickup_date', '$delivery_date')";

    if (mysqli_query($connect, $insert_query)) {
        echo "Data inserted successfully into the delivery table.";
        header("location:homepage.php");
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>
