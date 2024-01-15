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
$bus_companies = ["Greyhound", "Intercape", "Intercity", "Eldocoaches"];
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

// Insert routes for Greyhound
$insert_greyhound_routes = "INSERT INTO routes (route_name, departure_city, arrival_city, departure_time, arrival_time, company_id) VALUES 
    ('Greyhound Route 1', 'Johannesburg/Pretoria', 'Durban', '2024-01-15 08:00:00', '2024-01-15 17:00:00', 1),
    ('Greyhound Route 2', 'Johannesburg//Pretoria', 'Bloemfontein', '2024-01-16 10:00:00', '2024-01-16 21:00:00', 1)";
     ('Greyhound Route 3', 'Johannesburg//Pretoria', 'Cape Town', '2024-01-16 10:00:00', '2024-01-17 21:00:00', 1)";
     ('Greyhound Route 4', 'Johannesburg//Pretoria', 'Polokwane', '2024-01-16 09:00:00', '2024-01-16 15:00:00', 1)";
     ('Greyhound Route 5', 'Durban', 'Johannesburg/Pretoria', '2024-01-15 08:00:00', '2024-01-15 17:00:00', 1),
     ('Greyhound Route 6', 'Bloemfontein', 'Johannesburg/Pretoria', '2024-01-16 10:00:00', '2024-01-16 21:00:00', 1)";
      ('Greyhound Route 7', 'Cape Town', 'Johannesburg/Pretoria', '2024-01-16 10:00:00', '2024-01-17 21:00:00', 1)";
      ('Greyhound Route 8', 'Polokwane', 'Johannesburg/Pretoria', '2024-01-16 09:00:00', '2024-01-16 15:00:00', 1)";
     if ($conn->query($insert_greyhound_routes) === TRUE) {
    echo "Inserted data for Greyhound routes\n";
} else {
    echo "Error inserting data for Greyhound routes - " . $conn->error . "\n";
}



// Close the connection
$conn->close();
?>
