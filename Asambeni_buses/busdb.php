<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS bus_booking_system";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Connect to the created database
$conn = new mysqli($servername, $username, $password, "bus_booking_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create 'routes' table
$sql_routes = "CREATE TABLE IF NOT EXISTS routes (
    route_id INT AUTO_INCREMENT PRIMARY KEY,
    route_name VARCHAR(255) NOT NULL,
    departure_city VARCHAR(255) NOT NULL,
    arrival_city VARCHAR(255) NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL
)";
if ($conn->query($sql_routes) === TRUE) {
    echo "Table 'routes' created successfully\n";
} else {
    echo "Error creating table 'routes': " . $conn->error . "\n";
}

// Create 'payments' table
$sql_payments = "CREATE TABLE IF NOT EXISTS payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    route_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (route_id) REFERENCES routes(route_id)
)";
if ($conn->query($sql_payments) === TRUE) {
    echo "Table 'payments' created successfully\n";
} else {
    echo "Error creating table 'payments': " . $conn->error . "\n";
}

// Close the connection
$conn->close();
?>
