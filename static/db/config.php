<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "interloanhub";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
   die("Connection failed: " . $connection->connect_error);
}
?>