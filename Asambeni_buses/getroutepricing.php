<?php

// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "asambeni_buses";

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get the selected route from the POST request
$selectedRouteId = $_POST['routeId'];

// Prepare and execute a query to fetch pricing for the selected route
$query = "SELECT price_per_child, price_per_adult FROM RoutePricing WHERE route_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $selectedRouteId);
$stmt->execute();
$stmt->bind_result($pricePerChild, $pricePerAdult);

// Fetch the first row
$stmt->fetch();

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Return the pricing data as JSON
echo json_encode(['pricePerChild' => $pricePerChild, 'pricePerAdult' => $pricePerAdult]);
?>
