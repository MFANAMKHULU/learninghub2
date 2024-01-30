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

    // Get the selected bus type from the query parameters
    $selectedBusType = isset($_GET['busType']) ? $_GET['busType'] : null;

    // Query to select routes based on the selected bus type
    $stmt = $pdo->prepare("SELECT * FROM Routes WHERE company_id = (
        SELECT company_id FROM BusCompanies WHERE company_name = :busType
    )");

    // Bind the parameter
    $stmt->bindParam(':busType', $selectedBusType, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch the data as an associative array
    $routes = $stmt->fetchAll();

    // Output JSON data
    header('Content-Type: application/json');
    echo json_encode(['routes' => $routes]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
