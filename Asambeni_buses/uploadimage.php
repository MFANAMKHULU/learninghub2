<?php
// upload_image.php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file is selected
    if (isset($_FILES['image']) && isset($_POST['imageName']) && isset($_POST['busCompanyId'])) {
        $busCompanyId = $_POST['busCompanyId'];
        $uploadDirectory = 'c:\xampp\htdocs\learnerhub\Asambeni_buses\images';

        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $uploadDirectory . $fileName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            // Save the file path to the BusImages table
            $pdo = new PDO("mysql:host=localhost;dbname=your_database;charset=utf8mb4", 'your_username', 'your_password');
            $stmt = $pdo->prepare("INSERT INTO BusImages (bus_company_id, image_path) VALUES (?, ?)");
            $stmt->execute([$busCompanyId, $targetFilePath]);

            // Save the image name and path to the ImageNames table
            $imageName = $_POST['imageName'];
            $stmt = $pdo->prepare("INSERT INTO ImageNames (bus_company_id, image_name, image_path) VALUES (?, ?, ?)");
            $stmt->execute([$busCompanyId, $imageName, $targetFilePath]);

            echo "Image uploaded successfully.";
        } else {
            echo "Error uploading image.";
        }
    }
}
?>
