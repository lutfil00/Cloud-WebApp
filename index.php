<?php
ini_set('display_errors', 1);
$connectionInfo = array("UID" => "azure", "pwd" => "6#vWHD_$", "Database" => "localdb", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "127.0.0.1:50390";
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Check connection
if ($conn === false) {
    // Handle connection errors
    die("Connection could not be established.<br />" . print_r(sqlsrv_errors(), true));
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $number = $_POST['number'];
    $food = $_POST['food'];
    $extra = $_POST['extra'];
    $orders = $_POST['orders'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    $sql = "INSERT INTO order (name, number, food, extra, orders, address, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
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