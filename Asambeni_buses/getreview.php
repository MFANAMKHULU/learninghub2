<?php
// getreviews.php

// Include the database connection
require('db_connect.php');

// Prepare and execute SQL query to fetch comments
$sql = "SELECT * FROM reviews";
$result = $pdo->query($sql);

$comments = [];

if ($result->num_rows > 0) {
    // Fetch comments from the result set
    while ($row = $result->fetch_assoc()) {
        $comments[] = [
            'company_id' => $row['company_id'],
            'name' => $row['name'],
            'review' => $row['review']
        ];
    }
}

// Return comments as JSON
header('Content-Type: application/json');
echo json_encode($comments);
