<?php
session_start();
if (!isset($_SESSION['nama'])) {
    header("location:login.php");
    exit(); // Ensure no further code execution after redirection
} else {
    include("connectdb.php"); // Include your database connection file

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if id_layanan is set and not empty
        if (isset($_POST['id_layanan']) && !empty($_POST['id_layanan'])) {
            // Escape any special characters to prevent SQL injection
            $id_layanan = mysqli_real_escape_string($connect, $_POST['id_layanan']);

            // SQL delete query
            $sql = "DELETE FROM layanan WHERE id_layanan = '$id_layanan'";

            // Execute the query
            if (mysqli_query($connect, $sql)) {
                echo "Record deleted successfully";
                header("location:homepage.php");
            } else {
                echo "Error deleting record: " . mysqli_error($connect);
            }
        } else {
            echo "Invalid id_layanan";
        }
    } else {
        echo "Invalid request method";
    }
}
?>
