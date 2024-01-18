<?php

function isEmailValid($email) {
    // Define allowed email domains
    $allowedDomains = ['gmail.com', 'outlook.com', 'yahoo.com'];

    // Get the domain part of the email
    $emailParts = explode('@', $email);
    $domain = end($emailParts);

    // Check if the domain is in the list of allowed domains
    return in_array($domain, $allowedDomains);
}

function isNameValid($cardholderName) {
    // Check if the name has at least one alphabetical character
    return (preg_match('/[a-zA-Z]/', $cardholderName));
}

function isCardNumberValid($cardNumber) {
    // Check if the card number has exactly 16 digits
    return (strlen($cardNumber) == 16 && is_numeric($cardNumber));
}

function isExpiryDateValid($expiryDate) {
    // Check if the expiry date is in the future
    $currentDate = date('Y-m');
    return ($expiryDate >= $currentDate);
}

function isCVVValid($cvv) {
    // Check if the CVV is exactly 3 numbers
    return (strlen($cvv) == 3 && is_numeric($cvv));
}

function isFormDataComplete($postData) {
    // Define an array of required fields
    $requiredFields = ["cardNumber", "cardholderName", "billingAddress", "email", "phoneNumber", "expiryDate", "cvv"];

    // Check if all required fields are present and not empty
    foreach ($requiredFields as $field) {
        if (!isset($postData[$field]) || empty($postData[$field])) {
            return false; // Field is missing or empty
        }
    }

    // Check if cardholderName is valid
    if (!isNameValid($postData["cardholderName"])) {
        return false; // Invalid name
    }

    // Check if cardNumber is valid
    if (!isCardNumberValid($postData["cardNumber"])) {
        return false; // Invalid card number
    }

    // Check if expiryDate is valid
    if (!isExpiryDateValid($postData["expiryDate"])) {
        return false; // Expired card
    }

    // Check if CVV is valid
    if (!isCVVValid($postData["cvv"])) {
        return false; // Invalid CVV
    }

    return true; // All required fields are present and valid
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data
    $cardNumber = $_POST["cardNumber"];
    $cardholderName = $_POST["cardholderName"];
    $billingAddress = $_POST["billingAddress"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $expiryDate = $_POST["expiryDate"];
    $cvv = $_POST["cvv"];

    // Check if all required fields are entered and valid
    if (!isFormDataComplete($_POST) || !isEmailValid($email)) {
        // Display an error message and redirect
        echo "Please enter valid information in all fields.";
        header("Refresh: 3; URL=payment.html"); // Redirect after 3 seconds
        exit();
    }

    // Process the form data or perform additional actions if needed

    // Display a success message
    echo "Payment successful! Thank you for your purchase.";

    // Redirect to home.html
    header("Location: home.html");
    exit();
    
} else {
    // If the form is not submitted, redirect to the payment page
    header("Location: payment.html");
    exit();
}
?>
