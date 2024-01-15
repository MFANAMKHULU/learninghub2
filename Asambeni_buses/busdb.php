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

// Create 'bus_companies' table
$sql_bus_companies = "CREATE TABLE IF NOT EXISTS bus_companies (
    company_id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL
)";
if ($conn->query($sql_bus_companies) === TRUE) {
    echo "Table 'bus_companies' created successfully\n";
} else {
    echo "Error creating table 'bus_companies': " . $conn->error . "\n";
}

// Insert bus companies
$bus_companies = ["Greyhound", "Intercape", "Intercity", "Eldocoaches", "DRD", "Tourlines"];
foreach ($bus_companies as $company) {
    $insert_company = "INSERT INTO bus_companies (company_name) VALUES ('$company')";
    if ($conn->query($insert_company) === TRUE) {
        echo "Inserted data for company: $company\n";
    } else {
        echo "Error inserting data for company: $company - " . $conn->error . "\n";
    }
}

// Create 'routes' table
$sql_routes = "CREATE TABLE IF NOT EXISTS routes (
    route_id INT AUTO_INCREMENT PRIMARY KEY,
    route_name VARCHAR(255) NOT NULL,
    departure_city VARCHAR(255) NOT NULL,
    arrival_city VARCHAR(255) NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL,
    company_id INT NOT NULL,
    FOREIGN KEY (company_id) REFERENCES bus_companies(company_id)
)";
if ($conn->query($sql_routes) === TRUE) {
    echo "Table 'routes' created successfully\n";
} else {
    echo "Error creating table 'routes': " . $conn->error . "\n";
}

// Create 'tickets' table
$sql_tickets = "CREATE TABLE IF NOT EXISTS tickets (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    route_id INT NOT NULL,
    company_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    booking_date DATETIME NOT NULL,
    FOREIGN KEY (route_id) REFERENCES routes(route_id),
    FOREIGN KEY (company_id) REFERENCES bus_companies(company_id)
)";
if ($conn->query($sql_tickets) === TRUE) {
    echo "Table 'tickets' created successfully\n";
} else {
    echo "Error creating table 'tickets': " . $conn->error . "\n";
}

// Close the connection
$conn->close();
?>
