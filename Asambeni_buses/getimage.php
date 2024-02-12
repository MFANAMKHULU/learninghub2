<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the file containing the database connection script
require_once('db_connect.php');

class BusBookingSystem
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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

// Create a PDO instance
$pdo = new PDO($dsn, $username, $password, $options);

// Usage
$busBookingSystem = new BusBookingSystem($pdo);
$images = $busBookingSystem->getCompanyImages();

header('Content-Type: application/json');
echo json_encode($images);
?>
