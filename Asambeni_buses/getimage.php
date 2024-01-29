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

// Prepare and execute a query to fetch image file name for the selected bus company
$query = "SELECT image_filename FROM BusCompanies WHERE company_name = ? LIMIT 1";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $selectedBusCompany);
$stmt->execute();
$stmt->bind_result($imageFilename);
$stmt->fetch(); // Fetch the image filename

// Close the statement, as we'll use the connection again
$stmt->close();

// Display the image based on the filename
if ($imageFilename) {
    
    $imagePath = "Asambeni_buses/images/" . $imageFilename;
    echo "<img src='$imagePath' alt='Bus Company Image'>";
} else {
    echo "No image available for the selected bus company.";
}



// Prepare and execute a query to fetch routes for the selected bus company
$routeQuery = "SELECT route_id, route_name FROM Routes WHERE company_id = (
    SELECT company_id FROM BusCompanies WHERE company_name = ? LIMIT 1
)";
$routeStmt = $mysqli->prepare($routeQuery);
$routeStmt->bind_param("s", $selectedBusCompany);
$routeStmt->execute();
$routeStmt->bind_result($routeId, $routeName);

// Build HTML options for the route dropdown
$options = '';
while ($routeStmt->fetch()) {
    $options .= "<option value='$routeId'>$routeName</option>";
}

// Close the statement and database connection
$routeStmt->close();
$mysqli->close();

// Return the HTML options for the route dropdown
echo $options;
?>
