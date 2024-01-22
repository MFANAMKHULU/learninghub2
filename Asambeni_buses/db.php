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
            die("Error: " . $e->getMessage());
        }
    }

    public function createTables()
    {
        $queries = [
            "CREATE TABLE IF NOT EXISTS BusCompanies (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
            )",
        
            "CREATE TABLE IF NOT EXISTS Routes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
            )",
        
            "CREATE TABLE IF NOT EXISTS Times (
                id INT AUTO_INCREMENT PRIMARY KEY,
                bus_company_id INT,
                route_id INT,
                departure_time TIME,
                arrival_time TIME,
                FOREIGN KEY (bus_company_id) REFERENCES BusCompanies(id),
                FOREIGN KEY (route_id) REFERENCES Routes(id)
            )",
        
            "CREATE TABLE IF NOT EXISTS Reviews (
                id INT AUTO_INCREMENT PRIMARY KEY,
                bus_company_id INT,
                rating INT,
                comment TEXT,
                FOREIGN KEY (bus_company_id) REFERENCES BusCompanies(id)
            )",
        
            "CREATE TABLE IF NOT EXISTS Payments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                bus_company_id INT,
                route_id INT,
                time_id INT,
                amount DECIMAL(10, 2),
                payment_date DATE,
                FOREIGN KEY (bus_company_id) REFERENCES BusCompanies(id),
                FOREIGN KEY (route_id) REFERENCES Routes(id),
                FOREIGN KEY (time_id) REFERENCES Times(id)
            )",
        ];
        

        foreach ($queries as $query) {
            try {
                $this->pdo->exec($query);
                echo "Table created or already exists.\n";
            } catch (PDOException $e) {
                die("Error creating table: " . $e->getMessage());
            }
        }
    }
}

// Usage
$busBookingSystem = new BusBookingSystem();
$busBookingSystem->createTables();
?>
