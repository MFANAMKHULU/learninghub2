<?php
// Assuming you have established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "organizerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_username = $_POST['name'];
    $entered_password = $_POST['password'];

    // Query to retrieve information from the database
    $sql = "SELECT * FROM organizerdb WHERE name='$entered_username' AND password='$entered_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Match found in the database
        echo "Login successful!";
    } else {
        // No match found in the database
        echo "Invalid credentials!";
    }
}

$conn->close();
?>
