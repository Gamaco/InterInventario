<?php
include '../../db/config.php';

$PTag = $Description = $Fault = $Condition = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize user inputs
    $PTag = filter_var($_POST["PTag"], FILTER_SANITIZE_SPECIAL_CHARS);
    $Description = filter_var($_POST["Description"], FILTER_SANITIZE_SPECIAL_CHARS);
    $Fault = filter_var($_POST["Fault"], FILTER_SANITIZE_SPECIAL_CHARS);
    $Condition = filter_var($_POST["condition"], FILTER_SANITIZE_SPECIAL_CHARS);

    // Call the stored procedure
    $query = "CALL ProcessReturn(?, ?, ?, ?)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        $errorMessage = "Error preparing statement: " . $connection->error;
    } else {
        // Bind parameters
        $stmt->bind_param("ssss", $PTag, $Description, $Fault, $Condition);

        // Execute the statement
        $stmt->execute();

        // Check for errors
        if ($stmt->errno) {
            $errorMessage = "Error executing statement: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $connection->close();

    if (!empty($errorMessage)) {
        // Handle error
    } else {
        header("location: ../loans/index.php");
        exit;
    }
}
?>