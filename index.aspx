<?php

$connectionInfo = array("UID" => "CloudSA5e50fd81", "pwd" => "L123456789.", "Database" => "Food system", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:cloudprojectunikl.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "post") {
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