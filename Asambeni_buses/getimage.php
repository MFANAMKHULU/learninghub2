<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

    public function getCompanyImages()
    {
        try {
            $query = "SELECT * FROM CompanyImages";
            $statement = $this->pdo->query($query);
            $images = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $images;
        } catch (PDOException $e) {
            die("Error fetching images: " . $e->getMessage());
        }
    }
}

// Usage
$busBookingSystem = new BusBookingSystem();
$images = $busBookingSystem->getCompanyImages();

header('Content-Type: application/json');
echo json_encode($images);
?>
