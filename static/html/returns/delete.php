<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    include '../../db/config.php';

    // Sanitize the ID to prevent SQL injection
    $id = $connection->real_escape_string($id);

    // Call the stored procedure
    $query = "CALL DeleteReturn($id)";

    if ($connection->query($query) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    // Close the connection
    $connection->close();
}

// Redirect to returns.php
header("location: ../returns/index.php");
exit;
?>
