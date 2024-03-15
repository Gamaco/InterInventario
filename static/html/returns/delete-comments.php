<?php include '../components/userSessionValidation.php'; ?>

<?php
if (isset($_GET["commentId"]) && isset($_GET["itemId"])) {

    $commentId = filter_input(INPUT_GET, 'commentId', FILTER_VALIDATE_INT);
    $itemId = filter_input(INPUT_GET, 'itemId', FILTER_VALIDATE_INT);


    // Check if $id is valid
    if ($commentId === false || $commentId === null || $itemId === null || $itemId == false) {
        header("location: ../components/error_404.php");
    exit;
    }

    include '../../db/config.php';

    // Sanitize the ID to prevent SQL injection
    $commentId = $connection->real_escape_string($commentId);
    $itemId = $connection->real_escape_string($itemId);

    // Call the stored procedure for deleting a category
    $query = "CALL DeleteCommentByID(?)";

    // Prepare the statement
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        die("Error preparing statement: " . $connection->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $commentId);

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

// Redirect
header("location: ./comments.php?id=" . $itemId);
exit;
?>

