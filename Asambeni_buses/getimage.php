<?php

class BusBookingSystem
{
    private $pdo;

    public function __construct()
    {
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

            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function fetchImagesAsJSON()
    {
        try {
            $query = "SELECT company_id, image_name FROM CompanyImages";
            $result = $this->pdo->query($query);

            $images = [];

            if ($result && $result->rowCount() > 0) {
                while ($row = $result->fetch()) {
                    $company_id = $row['company_id'];
                    $image_name = $row['image_name'];

                    $image_url = "learninghub2/Asambeni_buses/images/{$image_name}";

                    // Build an array with image information
                    $images[] = [
                        'company_id' => $company_id,
                        'image_url' => $image_url,
                    ];
                }

                // Encode the array as JSON and return it
                return json_encode($images);
            } else {
                return json_encode(['error' => 'No images found.']);
            }
        } catch (PDOException $e) {
            return json_encode(['error' => 'Error fetching images: ' . $e->getMessage()]);
        }
    }
}

// Usage
$busBookingSystem = new BusBookingSystem();
?>
