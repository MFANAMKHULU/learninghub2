<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "asambeni_buses";
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getImage($company_id) {
        $stmt = $this->pdo->prepare("SELECT image_name FROM ImageNames WHERE company_id = ?");
        $stmt->execute([$company_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['image_name'] : null;
    }
}

$database = new Database();
$company_id = 1;

$imagePath = $database->getImage($company_id);

if ($imagePath) {
    // Display the image in HTML
    echo '<img src="' . $imagePath . '" alt="Company Image">';
} else {
    echo 'Image not found for company with ID ' . $company_id;
}
?>
