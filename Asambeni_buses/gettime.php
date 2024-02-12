<?php
// gettimes.php

// Include the database connection
require('db_connect.php');

try {
    // Get the selected route ID from the query parameters
    $selectedRouteId = isset($_GET['routeId']) ? $_GET['routeId'] : null;

    // Check if the route ID is provided
    if ($selectedRouteId === null) {
        throw new InvalidArgumentException("Route ID is missing");
    }

    // Query to select departure and arrival times based on the selected route
    $stmt = $pdo->prepare("SELECT departure_time, arrival_time FROM Routes WHERE route_id = :routeId");

    // Bind the parameter
    $stmt->bindParam(':routeId', $selectedRouteId, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the data as an associative array
    $times = $stmt->fetch();

    // Check if the route was not found
    if ($times === false) {
        throw new RuntimeException("Route not found");
    }

    // Output JSON data
    header('Content-Type: application/json');
    echo json_encode(['departure_time' => $times['departure_time'], 'arrival_time' => $times['arrival_time']]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
} catch (InvalidArgumentException $e) {
    // Handle missing route ID error
    http_response_code(400); // Bad Request
    echo json_encode(['error' => $e->getMessage()]);
} catch (RuntimeException $e) {
    // Handle route not found error
    http_response_code(404); // Not Found
    echo json_encode(['error' => $e->getMessage()]);
}
?>
