<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    include '../../db/config.php';

    // Sanitize the ID to prevent SQL injection
    $id = $connection->real_escape_string($id);

    // Call the stored procedure for deleting a record
    $query = "CALL DeleteRecord(?)";

    // Prepare the statement
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        die("Error preparing statement: " . $connection->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $id);

    // Execute the statement
    $result = $stmt->execute();

    if ($result) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    $connection->close();
}

// Redirect to inventory.php
header("location: ../inventory/index.php");
exit;
?>
