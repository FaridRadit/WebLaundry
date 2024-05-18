<?php
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit();
}

include("connectdb.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_layanan = $_POST['id_layanan'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $amount_paid = $_POST['amount_paid'];

    // Fetch the service details
    $msql = "SELECT * FROM layanan WHERE id_layanan='$id_layanan'";
    $result = mysqli_query($connect, $msql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $service_name = $row['nama_layanan'];
        $price = $row['harga'];

        // Check if the amount paid is sufficient
        if ($amount_paid >= $price) {
            $status = "paid";

            // Insert the data into the customer table
            $insert_customer_sql = "INSERT INTO customer (name, email, phone, address, status, service) VALUES ('$name', '$email', '$phone', '$address', '$status', '$service_name')";
            if (mysqli_query($connect, $insert_customer_sql)) {
                // Get the last inserted customer ID
                $customer_id = mysqli_insert_id($connect);

                // Generate order ID and get current date
                $order_id = uniqid();
                $order_date = date("Y-m-d H:i:s");

                // Insert the order data into the pesanan table
                $insert_order_sql = "INSERT INTO pesanan (order_id, customer_name, order_date, total_price, service, gadget_number, address) VALUES ('$order_id', '$name', '$order_date', '$price', '$service_name', '$phone', '$address')";
                if (mysqli_query($connect, $insert_order_sql)) {
                    echo "Order successfully placed and payment status set to paid.";
                    header("location:homepage.php");
                } else {
                    echo "Error inserting order: " . mysqli_error($connect);
                    header("location:homepage.php");
                    
                }
            } else {
                echo "Error inserting customer: " . mysqli_error($connect);
                header("location:homepage.php");
            }
        } else {
            echo "Payment amount is insufficient.";
            header("location:homepage.php");
        }
    } else {
        echo "Service not found.";
        header("location:homepage.php");
    }
}
?>
