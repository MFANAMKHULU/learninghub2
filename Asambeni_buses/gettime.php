<?php
try {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $databasename = 'asambeni_buses';
    $charset = 'utf8mb4';

    // Connect to the database
    $dsn = "mysql:host=$host;dbname=$databasename;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);

    // Get the selected route ID from the query parameters
    $selectedRouteId = isset($_GET['routeId']) ? $_GET['routeId'] : null;

    // Query to select departure and arrival times based on the selected route
    $stmt = $pdo->prepare("SELECT departure_time, arrival_time FROM Routes WHERE route_id = :routeId");

    // Bind the parameter
    $stmt->bindParam(':routeId', $selectedRouteId, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the data as an associative array
    $times = $stmt->fetch();

    // Output JSON data
    header('Content-Type: application/json');
    echo json_encode(['departure_time' => $times['departure_time'], 'arrival_time' => $times['arrival_time']]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
