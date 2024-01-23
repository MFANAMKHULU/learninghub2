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
                company_name VARCHAR(255) NOT NULL
            )",

            "INSERT INTO BusCompanies (company_name) VALUES
                ('Greyhound'),
                ('Intercape'),
                ('Intercity'),
                ('EldoCoaches'),
                ('DRD Luxury');",

            "CREATE TABLE IF NOT EXISTS Routes (
                route_id INT AUTO_INCREMENT PRIMARY KEY,
                route_name VARCHAR(255) NOT NULL,
                company_id INT,
                FOREIGN KEY (company_id) REFERENCES BusCompanies(company_id)
            )",

            "INSERT INTO Routes (route_name, company_id) VALUES
                ('Johannesburg/Pretoria to Durban', (SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1)),
                ('Johannesburg/Pretoria to Bloemfontein', (SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1)),
                ('Johannesburg/Pretoria to Cape Town', (SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1)),
                ('Johannesburg/Pretoria to Polokwane', (SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1)),
                ('Johannesburg/Pretoria to Nelspruit', (SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1)),
                ('Johannesburg/Pretoria to Richards Bay', (SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1))",

            "CREATE TABLE IF NOT EXISTS Times (
                time_id INT AUTO_INCREMENT PRIMARY KEY,
                bus_company_id INT,
                route_id INT,
                departure_time TIME,
                arrival_time TIME,
                FOREIGN KEY (bus_company_id) REFERENCES BusCompanies(company_id),
                FOREIGN KEY (route_id) REFERENCES Routes(route_id)
            )",

            "INSERT INTO Times (bus_company_id, route_id, departure_time, arrival_time) VALUES
                ((SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1), (SELECT route_id FROM Routes WHERE route_name = 'Johannesburg/Pretoria to Durban' LIMIT 1), '07:00', '19:00'),
                ((SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1), (SELECT route_id FROM Routes WHERE route_name = 'Johannesburg/Pretoria to Bloemfontein' LIMIT 1), '09:00', '16:00'),
                ((SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1), (SELECT route_id FROM Routes WHERE route_name = 'Johannesburg/Pretoria to Cape Town' LIMIT 1), '07:30', '11:00'),
                ((SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1), (SELECT route_id FROM Routes WHERE route_name = 'Johannesburg/Pretoria to Polokwane' LIMIT 1), '08:00', '15:30'),
                ((SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1), (SELECT route_id FROM Routes WHERE route_name = 'Johannesburg/Pretoria to Nelspruit' LIMIT 1), '11:30', '20:45'),
                ((SELECT company_id FROM BusCompanies WHERE company_name = 'Greyhound' LIMIT 1), (SELECT route_id FROM Routes WHERE route_name = 'Johannesburg/Pretoria to Richards Bay' LIMIT 1), '09:15', '20:30')",

            "CREATE TABLE IF NOT EXISTS Reviews (
                review_id INT AUTO_INCREMENT PRIMARY KEY,
                bus_company_id INT,
                rating INT,
                comment TEXT,
                FOREIGN KEY (bus_company_id) REFERENCES BusCompanies(company_id)
            )",

            "CREATE TABLE IF NOT EXISTS Payments (
                payment_id INT AUTO_INCREMENT PRIMARY KEY,
                bus_company_id INT,
                route_id INT,
                time_id INT,
                amount DECIMAL(10, 2),
                payment_date DATE,
                FOREIGN KEY (bus_company_id) REFERENCES BusCompanies(company_id),
                FOREIGN KEY (route_id) REFERENCES Routes(route_id),
                FOREIGN KEY (time_id) REFERENCES Times(time_id)
            )",
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
