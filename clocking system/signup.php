<?php

function checkEmailExists($email, $table) {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "electronic_Logging";

    $mysqli = new mysqli($host, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM $table WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    $mysqli->close();

    // If count is greater than 0, the email already exists
    return $count > 0;
}

function containsSpecialCharacters($str) {
    // Define a pattern for allowed characters (letters only)
    $pattern = '/^[A-Za-z]+$/';

    // Check if the string contains characters other than letters
    return !preg_match($pattern, $str);
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

// Main Logic

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $IDNumber = $_POST["IDNumber"];
    $Address = $_POST["Address"];
    $cellnumber = $_POST["cellnumber"];
    $role = $_POST["role"];
    $job = $_POST["job"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    // Validate form data

    // Check if required fields are not empty
    if (empty($name) || empty($lastname) || empty($email) || empty($IDNumber) || empty($Address) || empty($password) || empty($password2)) {
        $errors[] = "All fields must be filled out";
    }

    // Check if the password and confirm password fields match
    if ($password != $password2) {
        $errors[] = "Passwords do not match";
    }

    // Check if the email format is correct
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Check if first name contains numeric or special characters
    if (containsSpecialCharacters($name)) {
        $errors[] = "First name cannot contain numeric or special characters";
    }

    // Check if last name contains numeric or special characters
    if (containsSpecialCharacters($lastname)) {
        $errors[] = "Last name cannot contain numeric or special characters";
    }

    // Check if the password meets criteria, including the minimum length requirement
    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>0-9a-z]/', $password) || strlen($password) < 8) {
        $errors[] = "Password must meet the following criteria: at least one uppercase letter, one lowercase letter, one special character, and a minimum length of 8 characters";
    }

    // Checking if passwords match
$password = $_POST['password'];
$password2 = $_POST['password2'];

if ($password !== $password2) {
    die("Passwords do not match.");
}


   // Check if the email is unique in the database
$emailExists = checkEmailExists($email);
$emailExistsInEmployee = checkEmailExists($email, "employee");
$emailExistsInManager = checkEmailExists($email, "Manager");

if ($emailExists || $emailExistsInEmployee || $emailExistsInManager) {
    $errors[] = "Email is already registered. Please use a different email address.";
}
$emailExists = checkEmailExists($email);

if ($emailExists) {
    $errors[] = "Email is already registered. Please use a different email address.";
}




}


?>
