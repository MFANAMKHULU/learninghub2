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
$bus_companies = ["Greyhound", "Intercape", "Intercity", "Eldocoaches", "DRDLuxury", "Tourliner"];
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

// Create 'reviews' table
$sql_reviews = "CREATE TABLE IF NOT EXISTS reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    route_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    date_posted DATETIME NOT NULL,
    comment TEXT NOT NULL,
    FOREIGN KEY (route_id) REFERENCES routes(route_id)
)";
if ($conn->query($sql_reviews) === TRUE) {
    echo "Table 'reviews' created successfully\n";
} else {
    echo "Error creating table 'reviews': " . $conn->error . "\n";
}

// Get the current date
$currentDate = date('Y-m-d');

// Define the number of days to add for each route
$daysToAdd = array(0, 1, 2, 3, 0, 1, 2, 3);

// Function to calculate the new date based on the current date and days to add
function calculateNewDate($currentDate, $daysToAdd) {
    return date('Y-m-d H:i:s', strtotime($currentDate . ' +' . $daysToAdd . ' days'));
}

// Insert Greyhound routes
$insert_greyhound_routes = "INSERT INTO routes (route_name, departure_city, arrival_city, departure_time, arrival_time, company_id) VALUES ";

// Define routes for Johannesburg to Durban, Cape Town, and Durban to Johannesburg
for ($i = 1; $i <= 8; $i++) {
    $departureDate = calculateNewDate($currentDate, $daysToAdd[$i - 1]);
    $arrivalDate = calculateNewDate($currentDate, $daysToAdd[$i - 1]);
    $insert_greyhound_routes .= "('Greyhound Route $i', 'Johannesburg/Pretoria', 'Durban', '$departureDate', '$arrivalDate', 1),";
}

// Define routes for Johannesburg to Cape Town
$departureDateCT = calculateNewDate($currentDate, 2);
$arrivalDateCT = calculateNewDate($currentDate, 2);
$insert_greyhound_routes .= "('Greyhound Route 9', 'Johannesburg/Pretoria', 'Cape Town', '$departureDateCT', '$arrivalDateCT', 1),";

// Define routes for Durban to Johannesburg
$departureDateDBN = calculateNewDate($currentDate, 1);
$arrivalDateDBN = calculateNewDate($currentDate, 1);
$insert_greyhound_routes .= "('Greyhound Route 10', 'Durban', 'Johannesburg/Pretoria', '$departureDateDBN', '$arrivalDateDBN', 1)";

$insert_greyhound_routes = rtrim($insert_greyhound_routes, ',');

// Execute the query
if ($conn->query($insert_greyhound_routes) === TRUE) {
    echo "Inserted data for Greyhound routes\n";
} else {
    echo "Error inserting data for Greyhound routes - " . $conn->error . "\n";
}

// Insert Intercape routes
$insert_intercape_routes = "INSERT INTO routes (route_name, departure_city, arrival_city, departure_time, arrival_time, company_id) VALUES ";

// Define routes for Johannesburg to Durban, Bloemfontein, and Durban to Johannesburg
for ($i = 1; $i <= 8; $i++) {
    $departureDate = calculateNewDate($currentDate, $daysToAdd[$i - 1]);
    $arrivalDate = calculateNewDate($currentDate, $daysToAdd[$i - 1]);
    $insert_intercape_routes .= "('Intercape Route $i', 'Johannesburg/Pretoria', 'Durban', '$departureDate', '$arrivalDate', 2),";
}

// Define routes for Johannesburg to Bloemfontein
$departureDateBFN = calculateNewDate($currentDate, 2);
$arrivalDateBFN = calculateNewDate($currentDate, 2);
$insert_intercape_routes .= "('Intercape Route 9', 'Johannesburg/Pretoria', 'Bloemfontein', '$departureDateBFN', '$arrivalDateBFN', 2),";

// Define routes for Durban to Johannesburg
$departureDateDBN = calculateNewDate($currentDate, 1);
$arrivalDateDBN = calculateNewDate($currentDate, 1);
$insert_intercape_routes .= "('Intercape Route 10', 'Durban', 'Johannesburg/Pretoria', '$departureDateDBN', '$arrivalDateDBN', 2)";

$insert_intercape_routes = rtrim($insert_intercape_routes, ',');

// Execute the query
if ($conn->query($insert_intercape_routes) ===
