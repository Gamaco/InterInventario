<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "interloanhub";

    // Connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Sanitize the ID to prevent SQL injection
    $id = $connection->real_escape_string($id);

    $query = "DELETE FROM inventario WHERE id = $id";

    // Execute the DELETE query
    if ($connection->query($query) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    // Close the connection
    $connection->close();
}

// Redirect to inventory.php
header("location: ../inventory/index.php");
exit;
?>
