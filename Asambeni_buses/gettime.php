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

// Prepare and execute a query to fetch departure and arrival times for the selected route
$query = "SELECT time_id, departure_time, arrival_time FROM Times WHERE route_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $selectedRouteId);
$stmt->execute();
$stmt->bind_result($timeId, $departureTime, $arrivalTime);

// Build HTML options for the time dropdown
$options = '';
while ($stmt->fetch()) {
    // Add options for departure time
    $options .= "<option value='$timeId'>Departure: $departureTime</option>";

    // Add options for arrival time
    $options .= "<option value='$timeId'>Arrival: $arrivalTime</option>";
}

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Return the HTML options for the time dropdown
echo $options;
?>
