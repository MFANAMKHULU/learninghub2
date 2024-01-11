<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate input
    if (empty($email) || empty($password)) {
        die("Please enter both email and password.");
    }

    // Check user credentials
    $stmt = $conn->prepare("SELECT customer_id, name, password FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) { 
            // User found, set session and redirect to a logged-in page
            $_SESSION["user_email"] = $email;
            $_SESSION["user_name"] = $row['name']; // Store the user's name in the session

            header("Location: index.phtml");
            exit();
        } else {
            // Incorrect password or password not found
            echo "Invalid password.";
        }
    } else {
        // User not found
        echo "Invalid email.";
    }

    $stmt->close();
}

$conn->close();
?>
