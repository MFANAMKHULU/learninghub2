<?php
//  check if a string contains only letters and is not empty
function isValidName($name) {
    return !empty($name) && ctype_alpha($name);
}

// check if an email is in the correct format
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// check if a South African ID number is in the correct format
function isValidSAID($id) {
    // Check if the ID number is numeric and has a length of 13 characters
    if (!is_numeric($id) || strlen($id) !== 13) {
        return false;
    }

    return true;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $busType = $_POST['busType'];
    $route = $_POST['route'];
    $date = $_POST['date'];
    $numChildren = $_POST['numChildren'];
    $numAdults = $_POST['numAdults'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $id = $_POST['id'];
    $email = $_POST['email'];

    // Validate form data
    if (!isValidName($name)) {
        echo "Invalid name. Please enter a valid name.";
        header("refresh:5;url=booking.html"); 
        exit();
    }

    if (!isValidName($surname)) {
        echo "Invalid surname. Please enter a valid surname.";
        header("refresh:5;url=booking.html"); 
        exit();
    }

    if (!isValidEmail($email)) {
        echo "Invalid email. Please enter a valid email address.";
        header("refresh:5;url=booking.html"); 
        exit();
    }

    if (!isValidSAID($id)) {
        echo "Invalid South African ID number. Please enter a valid ID number.";
       
        header("refresh:5;url=booking.html"); 
        exit();
    }


}
?>
