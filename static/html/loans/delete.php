<?php
$id = $_GET["id"];

include '../../db/config.php';

// Sanitize the ID to prevent SQL injection
$id = $connection->real_escape_string($id);

// Select the item from another table by its ID
$selectQuery = "SELECT * FROM prestamos WHERE PTag = ?";
$stmt = $connection->prepare($selectQuery);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the item data
    $row = $result->fetch_assoc();

    // Extract necessary data from $row to use in the INSERT query
    $loanTo = $row['LOAN_TO'];
    $loanerAuth = $row['LOANER_AUTH'];
    $startDate = $row['START_DATE'];
    $endDate = $row['END_DATE'];

    // Insert the item into another table
    $insertQuery = "INSERT INTO returns (Ptag, Item_Cond, Comments) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($insertQuery);
    $stmt->bind_param("ssss", $id, $startDate, $endDate,);

    if ($stmt->execute()) {
        echo "Record inserted into another table successfully";
        // Delete the item from the original table
        $deleteQuery = "DELETE FROM inventario WHERE id = ?";
        $stmt = $connection->prepare($deleteQuery);
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

    } else {
        echo "Error inserting record into another table: " . $stmt->error;
    }
} else {
    echo "Item not found in another table";
}

// Close the statement and connection
$stmt->close();
$connection->close();

// Redirect to inventory.php
header("location: ../inventory/returns.php");
exit;
?>
