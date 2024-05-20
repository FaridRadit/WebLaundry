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
        echo " <script>alert(Error: Pickup date or delivery date cannot be before order date.)</script>";
       
        exit;
    }
<<<<<<< HEAD
    $msql = "SELECT * FROM delivery WHERE order_id = '$order_id'";
    $read = mysqli_query($connect, $msql);
    
    if ($read->num_rows > 0) {
        echo "<script>alert('Data Already Filled');";
        echo "window.location.href = 'customer.php';</script>";
        exit(); // Make sure to exit after redirection
    }
    
    else {
    
=======
    $msql="SELECT * FROM delivery WHERE order_id='$order_id'";
    $process=mysqli_query($connect,$msql);
    if($process) {
        echo "<script>
        alert('This data is already filled');
        window.location.href = 'customer.php';
      </script>";
        exit();
    }
else {
>>>>>>> 4e6bd9b659770d3a147cf3743399e3bca61a31d4
    // Insert data into the delivery table
    $insert_query = "INSERT INTO delivery (order_id,username,order_date, pickup_date, delivery_date) VALUES ('$order_id','$username', '$order_date', '$pickup_date', '$delivery_date')";

    if (mysqli_query($connect, $insert_query)) {
        echo "Data inserted successfully into the delivery table.";
        header("location:homepage.php");
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
}
?>
