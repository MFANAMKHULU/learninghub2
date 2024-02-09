<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Asambeni_buses";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute SQL query to fetch comments
$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);

$comments = [];

if ($result->num_rows > 0) {
    // Fetch comments from the result set
    while ($row = $result->fetch_assoc()) {
        $comments[] = [
            'company_id' => $row['company_id'],
            'name' => $row['name'],
            'review' => $row['review']
        ];
    }
}

// Close the database connection
$conn->close();

// Return comments as JSON
header('Content-Type: application/json');
echo json_encode($comments);
?>
