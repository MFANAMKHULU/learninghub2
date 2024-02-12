<?php
// Include the database connection file
require_once('db_connect.php');

try {
    // Get the selected bus type from the query parameters
    $selectedBusType = isset($_GET['busType']) ? $_GET['busType'] : null;

    // Check if the bus type is provided
    if ($selectedBusType === null) {
        throw new InvalidArgumentException("Bus type is missing");
    }

    // Query to select company_id based on the selected bus type
    $companyQuery = "SELECT company_id FROM BusCompanies WHERE company_name = :busType";
    $companyStmt = $pdo->prepare($companyQuery);
    $companyStmt->bindParam(':busType', $selectedBusType, PDO::PARAM_STR);
    $companyStmt->execute();

    // Fetch the company_id
    $companyId = $companyStmt->fetchColumn();

    // Check if the company_id is found
    if ($companyId === false) {
        throw new RuntimeException("Bus company not found");
    }

    // Query to select routes based on the selected bus type
    $routesQuery = "SELECT * FROM Routes WHERE company_id = :companyId";
    $routesStmt = $pdo->prepare($routesQuery);
    $routesStmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
    $routesStmt->execute();

    // Fetch the data as an associative array
    $routes = $routesStmt->fetchAll();

    // Output JSON data
    header('Content-Type: application/json');
    echo json_encode(['routes' => $routes]);
} catch (PDOException $e) {
    die("Error fetching routes: " . $e->getMessage());
} catch (InvalidArgumentException $e) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => $e->getMessage()]);
} catch (RuntimeException $e) {
    http_response_code(404); // Not Found
    echo json_encode(['error' => $e->getMessage()]);
}
?>
