<?php
// Connect to the database
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
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $address = $_POST["Address"];
    $email = $_POST["email"];
    $phone = $_POST["Cell_Number"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $tac = isset($_POST["tac"]) ? "Agreed" : "Not Agreed";
    $subscribe = isset($_POST["subscribe"]) ? "Subscribed" : "Not Subscribed";

    // Checking if all info is entered
    if (empty($name) || empty($lastname) || empty($address) || empty($email) || empty($password) || empty($password2)) {
        die("Enter required fields.");
    }

    // Checking if email format is correct
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Validating password
    function validatePassword($password) {
        // Check if password contains at least one capital letter
        if (!preg_match('/[A-Z]/', $password)) {
            return "Password must contain at least one capital letter.";
        }

        // Check if password contains at least one special character
        if (!preg_match('/[^a-zA-Z\d]/', $password)) {
            return "Password must contain at least one special character.";
        }

        // Check if password contains at least one number
        if (!preg_match('/\d/', $password)) {
            return "Password must contain at least one number.";
        }

        return true; // Password is valid
    }

    // Checking if passwords match
    if ($password !== $password2) {
        die("Passwords do not match.");
    }

    // Validate password before inserting into the database
    $passwordValidation = validatePassword($password);
    if ($passwordValidation !== true) {
        die($passwordValidation);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO customers (name, lastname, email, phone, address, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $lastname, $email, $phone, $address, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
