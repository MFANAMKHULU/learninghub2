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

// Get the selected route and company from the POST request
$selectedRouteId = $_POST['routeId'];
$selectedCompanyId = $_POST['companyId'];

// Prepare and execute a query to fetch departure and arrival times for the selected route and company
$query = "SELECT departure_time, arrival_time FROM Times WHERE route_id = ? AND bus_company_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $selectedRouteId, $selectedCompanyId);
$stmt->execute();
$stmt->bind_result($departureTime, $arrivalTime);

// Fetch the first row 
$stmt->fetch();

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Return JSON response with departure and arrival times
echo json_encode(['departureTime' => $departureTime, 'arrivalTime' => $arrivalTime]);
?>
