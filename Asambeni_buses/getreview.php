<?php


// Include the database connection
require('db_connect.php');

try {
    // Prepare and execute SQL query to fetch all reviews
    $stmt = $pdo->query("SELECT * FROM reviews");
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return reviews as JSON
    header('Content-Type: application/json');
    echo json_encode($reviews);
} catch (PDOException $e) {
    die("Error fetching reviews: " . $e->getMessage());
}
?>
