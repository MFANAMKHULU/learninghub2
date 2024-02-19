<?php

// Include the database connection file
require_once 'db_connect.php';

// Function to check if the name doesn't contain numbers and has at least one alphabet
function isNameValid($name) {
    return preg_match('/[a-zA-Z]/', $name) && !preg_match('/[0-9]/', $name);
}

// Function to check if the email has a valid domain (@outlook, @yahoo, @email)
function isEmailValid($email) {
    $allowedDomains = ['outlook.com', 'yahoo.com', 'gmail.com'];

    $emailParts = explode('@', $email);
    $domain = end($emailParts);

    return in_array($domain, $allowedDomains);
}

// Function to check if the review length is between 3 and 50 characters
function isReviewLengthValid($review) {
    $length = strlen($review);
    return ($length >= 3 && $length <= 50);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $company = $_POST["company"]; // Assuming this is the company name selected in the dropdown
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
        echo "Invalid email domain. Allowed domains are @outlook.com, @yahoo.com, @gmail.com";
        exit();
    }

    // Validate review length
    if (!isReviewLengthValid($review)) {
        echo "Invalid review length. Review should be between 3 and 50 characters.";
        exit();
    }

    // Assuming you have a function to retrieve the company_id based on the company name
    $company_id = getCompanyIdByName($company);

    // Prepare and execute SQL query with the current date
    $stmt = $pdo->prepare("INSERT INTO reviews (company_id, name, email, rating, review, date) VALUES (?, ?, ?, ?, ?, CURDATE())");
    $stmt->execute([$company_id, $name, $email, $rating, $review]);

    if ($stmt->rowCount() > 0) {
        echo "Thank you for submitting your review!";
        echo '<meta http-equiv="refresh" content="10;url=home.html">'; // Redirect after 10 seconds
        exit();
    } else {
        echo "Error submitting review.";
    }

} else {
    // If the form is not submitted, redirect to the review page
    header("Location: review.html");
    exit();
}

// Function to get company_id based on company name
function getCompanyIdByName($companyName)
{
    global $pdo;

    // Prepare and execute SQL query
    $stmt = $pdo->prepare("SELECT company_id FROM BusCompanies WHERE company_name = ?");
    $stmt->execute([$companyName]);

    // Fetch the result
    $companyId = $stmt->fetchColumn();

    // Return the company_id
    return $companyId;
}

?>
