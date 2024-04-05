<?php
// Include database configuration and establish connection
include '../../db/config.php';

// Get the category filter from the request
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Prepare the query to fetch filtered data
$query = "CALL GetFilteredInventory(?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

// Fetch filtered data and render table rows
while ($equipo = $result->fetch_assoc()) {
    // Render table rows here
}

$stmt->close();
$connection->close();
?>