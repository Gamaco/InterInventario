<?php
session_start();

// Function to check if user is logged in
function checkLoggedIn() {
    if (!isset($_SESSION['username'])) {
        redirectToLogin();
    }
}

// Function to redirect to login page
function redirectToLogin() {
    header("Location: ../user/login.php");
    exit;
}

// Check if user is logged in
checkLoggedIn();

// Get the username (Identification number)
$username = $_SESSION['username'];
?>