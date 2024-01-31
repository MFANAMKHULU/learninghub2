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

    // Loop through image filenames and encode images as base64
    $imageData = [];
    foreach ($imageFilenames as $filename) {
        $imagePath = "C:/xampp/htdocs/learninghub2/Asambeni_buses/images/$filename";
        // Manually specify MIME type based on file extension
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $mime_type = ($extension === 'png') ? 'image/png' : (($extension === 'jpg' || $extension === 'jpeg') ? 'image/jpeg' : '');

        // Read and encode image content
        $imageContent = @base64_encode(file_get_contents($imagePath));

        if ($imageContent !== false) {
            $imageData[$filename] = [
                'mime_type' => $mime_type,
                'base64_data' => $imageContent,
            ];
        } else {
            throw new Exception("Error reading image file: $filename");
        }
    }

    // Output JSON data
    header('Content-Type: application/json');
    echo json_encode(['image_data' => $imageData]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
