<?php
// getreviews.php

// Include the database connection
require('db_connect.php');

try {
    // Get the selected company ID from the query parameters
    $selectedCompanyId = isset($_GET['companyId']) ? $_GET['companyId'] : null;

    // Prepare and execute SQL query to fetch reviews for the selected company
    $stmt = $pdo->prepare("SELECT * FROM reviews WHERE company_id = :companyId");
    $stmt->bindParam(':companyId', $selectedCompanyId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch reviews from the result set
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return reviews as JSON
    header('Content-Type: application/json');
    echo json_encode($reviews);
} catch (PDOException $e) {
    die("Error fetching reviews: " . $e->getMessage());
}
?>
