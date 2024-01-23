<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asambeni_buses";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT image_name FROM ImageNames";
$result = $conn->query($sql);

$images = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = $row["image_name"];
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($images);
?>
