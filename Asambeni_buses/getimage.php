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

    // Query to select all image filenames
    $stmt = $pdo->query("SELECT company_image FROM BusCompanies");
    $imageFilenames = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Display the images
    foreach ($imageFilenames as $filename) {
        echo "<img src='Asmabeni_buses/images/$filename' alt='Bus Image'>";
        echo "<br>";
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
