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

// Prepare and execute a query to fetch image file names for the selected bus company
$query = "SELECT image_filename FROM BusCompanies WHERE company_name = ? LIMIT 1";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $selectedBusCompany);
$stmt->execute();
$stmt->bind_result($imageFilename);
$stmt->fetch(); // Fetch the image filename

// Close the statement
$stmt->close();

// Fetch all image filenames for the selected bus company
$imagePaths = array();
if ($imageFilename) {

    $imagePath = "Asambeni_buses/images/" . $imageFilename;
    $imagePaths[] = $imagePath;
}

// Return JSON-encoded array of image paths
echo json_encode($imagePaths);

// Close the database connection
$mysqli->close();
?>
