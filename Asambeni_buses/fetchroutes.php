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

    // Query to select all route information
    $stmt = $pdo->query("SELECT * FROM Routes");

    // Fetch the data as an associative array
    $routes = $stmt->fetchAll();

    // Output JSON data
    header('Content-Type: application/json');
    echo json_encode(['routes' => $routes]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
