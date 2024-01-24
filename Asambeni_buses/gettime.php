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

// Get the selected bus company from the POST request
$selectedBusCompany = $_POST['busCompany'];

// Prepare and execute a query to fetch departure and arrival times for the selected bus company
$query = "SELECT departure_time, arrival_time FROM departingtimes WHERE company_id = (
    SELECT company_id FROM BusCompanies WHERE company_name = ? LIMIT 1
)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $selectedBusCompany);
$stmt->execute();
$stmt->bind_result($departureTime, $arrivalTime);

// Fetch the first row
$stmt->fetch();

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Return the departure and arrival times as JSON
echo json_encode(['departureTime' => $departureTime, 'arrivalTime' => $arrivalTime]);
?>
