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

// Close the connection
$conn->close();

// Connect to the created database
$conn = new mysqli($servername, $username, $password, "bus_booking_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table for bus details
$sql = "CREATE TABLE IF NOT EXISTS buses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    route VARCHAR(255) NOT NULL,
    departure_location VARCHAR(255) NOT NULL,
    arrival_location VARCHAR(255) NOT NULL,
    departure_time TIME NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'buses' created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// Insert  data
$insertData = "INSERT INTO buses (name, route, departure_location, arrival_location, departure_time)
VALUES
('Greyhound', 'Johannesburg to Durban', 'Johannesburg', 'Durban', '08:00:00'),
('Greyhound', 'Johannesburg to Cape Town', 'Johannesburg', 'Cape Town', '10:30:00'),
('Greyhound', 'Johannesburg to Polokwane', 'Johannesburg', 'Polokwane', '12:45:00'),
('Greyhound', 'Johannesburg to Bloemfontein', 'Johannesburg', 'Bloemfontein', '15:15:00'),
('Greyhound', 'Durban to Johannesburg', 'Durban', 'Johannesburg', '17:30:00'),
('Greyhound', 'Cape Town to Johannesburg', 'Cape Town', 'Johannesburg', '19:00:00'),
('Greyhound', 'Polokwane to Johannesburg', 'Polokwane', 'Johannesburg', '21:15:00'),
('Greyhound', 'Bloemfontein to Johannesburg', 'Bloemfontein', 'Johannesburg', '23:45:00'),

('Intercape', 'Cape Town to Bloemfontein', 'Cape Town', 'Bloemfontein', '10:30:00'),
('Intercape', 'Cape Town to Durban', 'Cape Town', 'Durban', '12:00:00'),
('Intercape', 'Bloemfontein to Johannesburg', 'Bloemfontein', 'Johannesburg', '14:30:00'),
('Intercape', 'Durban to Pretoria', 'Durban', 'Pretoria', '16:45:00'),
('Intercape', 'Bloemfontein to Cape Town', 'Bloemfontein', 'Cape Town', '11:00:00'),
('Intercape', 'Durban to Cape Town', 'Durban', 'Cape Town', '13:30:00'),
('Intercape', 'Johannesburg to Bloemfontein', 'Johannesburg', 'Bloemfontein', '15:45:00'),
('Intercape', 'Johannesburg to Polokwane', 'Johannesburg', 'Polokwane', '18:00:00'),
('Intercape', 'Bloemfontein to Johannesburg', 'Bloemfontein', 'Johannesburg', '20:30:00'),

('Intercity', 'Johannesburg to Durban', 'Johannesburg', 'Durban', '09:00:00'),
('Intercity', 'Johannesburg to Cape Town', 'Johannesburg', 'Cape Town', '11:30:00'),
('Intercity', 'Johannesburg to Polokwane', 'Johannesburg', 'Polokwane', '14:00:00'),
('Intercity', 'Johannesburg to Bloemfontein', 'Johannesburg', 'Bloemfontein', '16:30:00'),
('Intercity', 'Cape Town to Bloemfontein', 'Cape Town', 'Bloemfontein', '10:00:00'),
('Intercity', 'Cape Town to Durban', 'Cape Town', 'Durban', '12:30:00'),
('Intercity', 'Bloemfontein to Johannesburg', 'Bloemfontein', 'Johannesburg', '15:00:00'),
('Intercity', 'Johannesburg to Harrismith', 'Johannesburg', 'Harrismith', '17:30:00'),

('DRD Luxury', 'Johannesburg to Harare', 'Johannesburg', 'Harare', '18:00:00'),
('DRD Luxury', 'Pretoria to Harare', 'Pretoria', 'Harare', '20:30:00'),
('DRD Luxury', 'Harare to Pretoria', 'Harare', 'Pretoria', '22:00:00'),
('DRD Luxury', 'Harare to Johannesburg', 'Harare', 'Johannesburg', '23:30:00'),

('Eldo Coaches', 'Polokwane to Kimberley', 'Polokwane', 'Kimberley', '18:30:00'),
('Eldo Coaches', 'Cape Town to Durban', 'Cape Town', 'Durban', '20:00:00'),
('Tourliner', 'Special Hire', 'City K', 'City L', '20:30:00');



if ($conn->multi_query($insertData) === TRUE) {
    echo "Sample data inserted successfully\n";
} else {
    echo "Error inserting sample data: " . $conn->error . "\n";
}

// Close the connection
$conn->close();
?>
