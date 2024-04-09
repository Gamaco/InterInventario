<?php
session_start();

// Set the target page URL in session if applicable
if (!isset($_SESSION['username']) && isset($_SERVER['REQUEST_URI'])) {
    $_SESSION['target_page'] = $_SERVER['REQUEST_URI'];
}

// Function to check if user is logged in
function checkLoggedIn() {
    if (!isset($_SESSION['username'])) {
        // Redirect to the login page
        redirectToLogin();
    }
}

// Function to redirect to login page
function redirectToLogin() {
    // Check if there's a target page URL stored in the session
    if (isset($_SESSION['target_page'])) {
        // Redirect to the login page, passing the target page URL as a parameter
        header("Location: ../user/login.php?redirect=true&page=" . urlencode($_SESSION['target_page']));
        exit;
    } else {
        // Redirect to the regular login page
        header("Location: ../user/login.php");
        exit;
    }
}

// Check if user is logged in
checkLoggedIn();

// Get the username (Identification number)
$username = $_SESSION['username'];
?>
