<?php
if (isset($_GET["id"])) {
    
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    // Check if $id is valid
    if ($id === false || $id === null) {
        // Handle invalid input (e.g., display an error message, redirect the user, etc.)
        header("location: ../components/error_404.php");
        exit;
    }

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
