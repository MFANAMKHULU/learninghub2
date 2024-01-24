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

// Prepare and execute a query to fetch all data for the selected bus company
$query = "SELECT time_id, departure_time, arrival_time FROM departingtimes WHERE company_id = (
    SELECT company_id FROM BusCompanies WHERE company_name = ? LIMIT 1
)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $selectedBusCompany);
$stmt->execute();
$stmt->bind_result($timeId, $departureTime, $arrivalTime);

// Fetch all rows
$data = array();
while ($stmt->fetch()) {
    $data[] = array('timeId' => $timeId, 'departureTime' => $departureTime, 'arrivalTime' => $arrivalTime);
}

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Return the data as JSON
echo json_encode($data);
?>
