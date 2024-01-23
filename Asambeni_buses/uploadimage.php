<?php
// upload_and_display_image.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file is selected
    if (isset($_FILES['image']) && isset($_POST['imageName']) && isset($_POST['busCompanyId'])) {
        $busCompanyId = $_POST['busCompanyId'];
        $uploadDirectory = 'c:\xampp\htdocs\learnerhub\Asambeni_buses\images\\' . $busCompanyId . '\\'; // Subfolder for each bus company

        // Create the bus company subfolder if it doesn't exist
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $uploadDirectory . $fileName;

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
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['displayBusCompanyId'])) {
    $displayBusCompanyId = $_GET['displayBusCompanyId'];

    // Connect to the database
    $pdo = new PDO("mysql:host=localhost;dbname=your_database;charset=utf8mb4", 'your_username', 'your_password');

    // Query the ImageNames table to get the image name and path
    $stmt = $pdo->prepare("SELECT image_name, image_path FROM ImageNames WHERE bus_company_id = ?");
    $stmt->execute([$displayBusCompanyId]);

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $imageName = $result['image_name'];
        $imagePath = $result['image_path'];

        // Display the image
        echo "Image Name: $imageName <br>";
        echo '<img src="' . $imagePath . '" alt="' . $imageName . '">';
    } else {
        echo "Image not found for the specified bus company ID.";
    }
}
?>
