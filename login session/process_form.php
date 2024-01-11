<?php

session_start(); // starting session

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "organizerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$first_name = $_POST['name'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['cellnumber'];
$password = $_POST['password'];
$role = $_POST['role'];

// checking if all info is entered
if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($phone)) {
    die("All fields are required.");
}

// checking if email format is correct
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// validating password
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
$password = $_POST['password'];
$password2 = $_POST['password2'];

if ($password !== $password2) {
    die("Passwords do not match.");
}

// Usage
$password = $_POST['password'];
$passwordValidationResult = validatePassword($password); // calling the function of validate function

if ($passwordValidationResult === true) {
    // Password is valid, proceed with registration
    // Add user details to session
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['role'] = $role;

    if ($role == 'attendee') {
        $sql = "INSERT INTO attendee (first_name, last_name, email, phone, password ) VALUES ('$first_name', '$last_name', '$email', '$phone', '$password')";
    } elseif ($role == 'organizer') {
        $sql = "INSERT INTO organizer (organizer_name, organizer_surname, email, phone, password ) VALUES ('$first_name', '$last_name', '$email', '$phone', '$password')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        // Redirect to a success page
        header("Location: localhost/learnerhub/login session/success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    // Password is invalid, show error message
    die($passwordValidationResult);
}

$conn->close();
?>
