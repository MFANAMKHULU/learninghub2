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

function isCVVValid($cvv) {
    // Check if the CVV is exactly 3 numbers
    return (strlen($cvv) == 3 && is_numeric($cvv));
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

    
    // Check if cardholderName is valid
    if (!isNameValid($cardholderName)) {
        // Display an error message and redirect
        echo "Please enter a valid name.";
        header("Refresh: 3; URL=payment.html"); // Redirect after 3 seconds
        exit();
    }

    // Check if cardNumber is valid
    if (!isCardNumberValid($cardNumber)) {
        // Display an error message and redirect
        echo "Please enter a valid card number.";
        header("Refresh: 3; URL=payment.html"); // Redirect after 3 seconds
        exit();
    }

    // Check if CVV is valid
    if (!isCVVValid($cvv)) {
        // Display an error message and redirect
        echo "Please enter a valid CVV.";
        header("Refresh: 3; URL=payment.html"); // Redirect after 3 seconds
        exit();
    }

    // Check if email is valid
    if (!isEmailValid($email)) {
        // Display an error message and redirect
        echo "Please enter a valid email address.";
        header("Refresh: 3; URL=payment.html"); // Redirect after 3 seconds
        exit();
    }

    // Display a success message
    echo "Payment successful! Thank you for your purchase.";

    // Redirect to confirmation.html
    header("Location: confirmation.html");
    exit();
    
} else {
    // If the form is not submitted, redirect to the payment page
    header("Location: payment.html");
    exit();
}
?>
