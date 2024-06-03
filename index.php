<?php

$port = $_SERVER['WEBSITE_MYSQL_PORT'];
$server = "localhost:$port";
$user = "azure";
$password = "6#vWHD_$";
$database = "localdb";

$connection = mysqli_connect($server, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    // Get the raw input data
    $input = file_get_contents('php://input');
    // Decode the JSON data
    $data = json_decode($input, true);

    $username = $data['name'];
    $number = $data['number'];
    $food = $data['food'];
    $extra = $data['extra'];
    $orders = $data['orders'];
    $address = $data['address'];
    $message = $data['message'];

    $sql = "INSERT INTO orders (name, number, food, extra, orders, address, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, 'sssssss', $username, $number, $food, $extra, $orders, $address, $message);

    if (mysqli_stmt_execute($stmt)) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($connection);
?>
