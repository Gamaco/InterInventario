<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    include '../../db/config.inc';

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
