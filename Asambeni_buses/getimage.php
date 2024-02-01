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

    // Prepare and execute a query to fetch only the company_image column
    $query = "SELECT company_image FROM BusCompanies";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Output image tags directly
    while ($row = $stmt->fetch()) {
        $imagePath = "Asambeni_buses/images/" . $row['company_image'];
        echo '<img src="' . $imagePath . '" alt="Bus Image" class="img-fluid" />';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
