<?php
session_start();

if(isset($_SESSION['first_name'])) {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $role = $_SESSION['role'];

    // Now you can use these variables in your success page
} else {
    // Redirect back to the registration page if session data is not available
    header("Location: localhost/learnerhub.login session/form.html");
    exit();
}
?>
