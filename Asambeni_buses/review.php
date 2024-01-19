<?php

// Function to check if the name doesn't contain numbers and has at least one alphabet
function isNameValid($name) {
    return preg_match('/[a-zA-Z]/', $name) && !preg_match('/[0-9]/', $name);
}

// Function to check if the email has a valid domain (@outlook, @yahoo, @email)
function isEmailValid($email) {
    $allowedDomains = ['outlook', 'yahoo', 'email']; // Add more domains as needed

    $emailParts = explode('@', $email);
    $domain = end($emailParts);

    return in_array($domain, $allowedDomains);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $company = $_POST["company"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $rating = $_POST["rating"];
    $review = $_POST["review"];

    // Validate name
    if (!isNameValid($name)) {
        echo "Invalid name. Please enter a name without numbers.";
        exit();
    }

    // Validate email domain
    if (!isEmailValid($email)) {
        echo "Invalid email domain. Allowed domains are @outlook, @yahoo, @email.";
        exit();
    }

    // Display a thank you message
    echo "Thank you for submitting your review!";

} else {
    // If the form is not submitted, redirect to the review page
    header("Location: review.html");
    exit();
}
?>
