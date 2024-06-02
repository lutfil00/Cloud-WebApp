<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$host = "cloudprojectunikl.database.windows.net"; // Server name
$username = "CloudSA5e50fd81"; // Username
$password = "L123456789."; // Password
$db_name = "Food system"; // Database name

// Create a new mysqli instance
$conn = mysqli_init();

// Attempt to connect
if (!mysqli_real_connect($conn, $host, $username, $password, $db_name)) {
    // Connection failed, output the error
    echo "Connection error: " . mysqli_connect_error();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $number = $_POST['number'];
    $food = $_POST['food'];
    $extra = $_POST['extra'];
    $orders = $_POST['orders'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    $sql = "INSERT INTO dbo.order_query (name, number, food, extra, orders, address, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = array($username, $number, $food, $extra, $orders, $address, $message);
    
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo "Error in statement execution.<br />";
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Data inserted successfully!";
    }

    sqlsrv_free_stmt($stmt);
}

// Close the connection
sqlsrv_close($conn);
?>