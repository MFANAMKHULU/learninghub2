<?php

class BusBookingSystem
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $databasename = 'asambeni_buses';
    private $charset = 'utf8mb4';
    private $pdo;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            // Connect without specifying a database
            $dsn = "mysql:host={$this->host};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
    
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
    
            // Create the database if it doesn't exist
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS {$this->databasename}");
    
            // Switch to the specified database
            $this->pdo->exec("USE {$this->databasename}");
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    public function createTables()
    {
        $queries = [
            "CREATE TABLE IF NOT EXISTS BusCompanies (
                company_id INT AUTO_INCREMENT PRIMARY KEY,
                company_name VARCHAR(255) NOT NULL,
                company_image VARCHAR(255) NOT NULL
            )",
    
            "INSERT INTO BusCompanies (company_name, company_image) VALUES
                ('Greyhound', 'Asmabeni_buses/images/greyhound.jpg'),
                ('Intercape', 'Asmabeni_buses/images/intercape.jpg'),
                ('Intercity', 'Asmabeni_buses/images/intercity.jpg'),
                ('EldoCoaches', 'Asmabeni_buses/images/eldocoach.jpg'),
                ('DRD Luxury', 'Asmabeni_buses/images/drdluxury.jpg')", 
        ];
    
        foreach ($queries as $query) {
            try {
                $this->pdo->exec($query);
                echo "Table created or already exists.\n";
            } catch (PDOException $e) {
                die("Error executing query: " . $e->getMessage());
            }
        }
    }

    public function testConnection()
    {
        try {
            $this->connect();
            $this->createTables();
            echo "Database connection successful.\n";
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

// Usage
$busBookingSystem = new BusBookingSystem();
$busBookingSystem->testConnection();
?>
