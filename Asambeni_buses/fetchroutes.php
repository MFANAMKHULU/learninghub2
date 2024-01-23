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

// Prepare and execute a query to fetch routes for the selected bus company
$query = "SELECT route_id, route_name FROM Routes WHERE company_id = (
    SELECT company_id FROM BusCompanies WHERE company_name = ? LIMIT 1
)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $selectedBusCompany);
$stmt->execute();
$stmt->bind_result($routeId, $routeName);

// Build HTML options for the route dropdown
$options = '';
while ($stmt->fetch()) {
    $options .= "<option value='$routeId'>$routeName</option>";
}

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Return the HTML options for the route dropdown
echo $options;
?>
