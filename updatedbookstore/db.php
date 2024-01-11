<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "book_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create tables
$queryCreateAuthorsTable = "
    CREATE TABLE IF NOT EXISTS authors (
        author_id INT PRIMARY KEY AUTO_INCREMENT,
        author_name VARCHAR(255)
    );
";

$queryCreateGenresTable = "
    CREATE TABLE IF NOT EXISTS genres (
        genre_id INT PRIMARY KEY AUTO_INCREMENT,
        genre_name VARCHAR(255)
    );
";

$queryCreateBooksTable = "
    CREATE TABLE IF NOT EXISTS books (
        book_id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(255),
        author_id INT,
        genre_id INT,
        price DECIMAL(10, 2),
        quantity_in_stock INT,
        publication_date DATE,
        ISBN VARCHAR(13),
        FOREIGN KEY (author_id) REFERENCES authors(author_id),
        FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
    );
";

$queryCreateCustomersTable = "
    CREATE TABLE IF NOT EXISTS customers (
        customer_id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255),
        lastname VARCHAR(255),
        email VARCHAR(255),
        phone VARCHAR(20),
        address VARCHAR(255),
        password VARCHAR(255)
    );
";

$queryCreateOrdersTable = "
    CREATE TABLE IF NOT EXISTS orders (
        order_id INT PRIMARY KEY AUTO_INCREMENT,
        customer_id INT,
        order_date TIMESTAMP,
        total_amount DECIMAL(10,2),
        FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
    );
";

$queryCreateOrderItemsTable = "
    CREATE TABLE IF NOT EXISTS order_items (
        order_item_id INT PRIMARY KEY AUTO_INCREMENT,
        order_id INT,
        book_id INT,
        quantity INT,
        subtotal DECIMAL(10, 2),
        FOREIGN KEY (order_id) REFERENCES orders(order_id),
        FOREIGN KEY (book_id) REFERENCES books(book_id)
    );
";

$queryCreateCommentsTable = "
    CREATE TABLE IF NOT EXISTS comments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        comment TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        book_id INT,
        FOREIGN KEY (book_id) REFERENCES books(book_id)
    );
";

$createTableQueries = [
    $queryCreateAuthorsTable,
    $queryCreateGenresTable,
    $queryCreateBooksTable,
    $queryCreateCustomersTable,
    $queryCreateOrdersTable,
    $queryCreateOrderItemsTable,
    $queryCreateCommentsTable,
];

foreach ($createTableQueries as $createTableQuery) {
    if ($conn->query($createTableQuery) !== TRUE) {
        echo "Error creating tables: " . $conn->error;
    }
}

// Insert books 
$insertBookQueries = [
    "INSERT INTO books (title, author_id, genre_id, price, quantity_in_stock, publication_date, ISBN) VALUES ('I\'m David', 100, 1, 200.00, 50, '2003-11-21', '1234567890123');",
    "INSERT INTO books (title, author_id, genre_id, price, quantity_in_stock, publication_date, ISBN) VALUES ('Life of Pi', 150, 33, 700.00, 150, '2003-09-28', '1234567890124');",
    "INSERT INTO books (title, author_id, genre_id, price, quantity_in_stock, publication_date, ISBN) VALUES ('Macbeth', 200, 22, 480.00, 70, '2013-06-11', '1234567890125');",
    "INSERT INTO books (title, author_id, genre_id, price, quantity_in_stock, publication_date, ISBN) VALUES ('Night to Remember', 250, 40, 200.00, 50, '2005-07-03', '1234567890126');",
];

foreach ($insertBookQueries as $insertBookQuery) {
    if ($conn->query($insertBookQuery) !== TRUE) {
        echo "Error inserting book: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
