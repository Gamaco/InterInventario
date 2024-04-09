<?php include '../components/userSessionValidation.php'; ?>

<?php
include '../../db/config.php';

$ItemIsAvailable = false;

// Check whether the item is available or not
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET Method - the user is accessing the page from a scanned QR code
    if (isset($_GET["id"])) {
        // Sanitize the input
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        // Check if $id is valid
        if ($id === false || $id === null) {
            // Handle invalid input (e.g., display an error message, redirect the user, etc.)
            header("location: ../components/error_404.php");
            exit;
        }

        // Call the stored procedure to get the item based on the ID
        $query = "CALL GetAvailableSingleItemByItemID(?)";

        // Prepare the statement
        $stmt = $connection->prepare($query);

        if (!$stmt) {
            $errorMessage = "Error preparing statement: " . $connection->error;
        } else {
            // Bind parameters
            $stmt->bind_param("i", $id);

            // Execute the statement
            $result = $stmt->execute();

            if (!$result) {
                $errorMessage = "Error executing statement: " . $stmt->error;
            } else {
                // Fetch the result set as an associative array
                $item = $stmt->get_result()->fetch_assoc();

                if ($item) {
                    $ItemIsAvailable = true;
                } else {
                    $ItemIsAvailable = false;
                }
            }

            // Close statement
            $stmt->close();
        }

        // Close connection
        $connection->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no">

    <meta name="description" content="Sistema de Inventario">
    <meta name="author" content="Inter Bayamon">
    <meta name="keywords" content="Inter Bayamon, Inventario, Sistema de Inventario, admin, Universidad Interamericana, Bayamon, Inventario de Equipos">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../../img/icons/interlogo3.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="../../img/icons/app-icon-ios.png">
    <meta name="apple-mobile-web-app-title" content="Inter Loans">
    <link rel="manifest" href="../../manifest.json">

    <title>Index | IRLS</title>
    <link rel="stylesheet" , href="../../css/inventory.css">
    <!-- Bootstrap added locally -->
    <link href="../../css/app.css" rel="stylesheet">
    <!-- Google font & icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@250" rel="stylesheet" />

    <style>
        .table-container {
            overflow-x: auto;
        }
    </style>
</head>

<body draggable="false">
    <?php $activePage = 'inventory';
    include '../components/sidebar.php'; ?>

    <div class="main">
        <?php include '../components/navbar.php'; ?>

        <main class="content">
            <div class="row">
            <h6 class="h6 mb-2 text-secondary"><strong>Options</strong></h6>
            <div class="col-10 col-lg-10 col-xxl-10 d-flex">
                <a class="btn btn-secondary text-dark btn-lg mb-3 p-3 me-2" href="../loans/index.php"><i class='material-symbols-outlined fs-4' style="vertical-align: middle;">manage_search</i>Manage Loans</a>
                <?php
                    if ($ItemIsAvailable == true) {
                        echo "
                            <a class='btn btn-primary btn-lg mb-3 p-3' href='../loans/create.php?id=$id'><i class='material-symbols-outlined fs-4' style='vertical-align: middle;'>calendar_add_on</i>Create Loan</a>
                        ";
                    }
                ?>
                </div>
                <hr />
                <div class="col-12 col-lg-14 col-xxl-12 d-flex">

                    <div class="card flex-fill">
                        <?php
                        if ($ItemIsAvailable == true) {
                            echo "
                            <div class='flex-fill text-center mb-1' style='background-color: #00973c;'>
                            <p class='text-white fs-3 mb-0 p-1'><b>Available</b></p>
                            </div>
                        ";
                        } else {
                            echo "
                            <div class='flex-fill text-center mb-1' style='background-color: red;'>
                            <p class='text-white fs-3 mb-0 p-2'><b>Unavailable</b></p>
                            </div>
                            ";
                        }
                        ?>
                        <div class="table-container">
                            <table id="InventoryTable" class="table my-0 table-hover border-secondary">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>PTag</th>
                                        <th>GN</th>
                                        <th>Model</th>
                                        <th>Serial No</th>
                                        <th>Fund</th>
                                        <th>AC</th>
                                        <th>CL</th>
                                        <th>F</th>
                                        <th>AQU</th>
                                        <th>ST</th>
                                        <th>Acquisition</th>
                                        <th>Received</th>
                                        <th>Doc No</th>
                                        <th>Amt</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Establish database connection
                                    include '../../db/config.php';

                                    // Function to fetch item details by ID using a stored procedure
                                    function getItemDetails($connection, $itemId)
                                    {
                                        // Prepare and execute the stored procedure
                                        $stmt = $connection->prepare("CALL GetItemDetails(?)");
                                        $stmt->bind_param("i", $itemId);
                                        $stmt->execute();

                                        // Get result
                                        $result = $stmt->get_result();

                                        // Check if the query result contains any rows
                                        if ($result->num_rows > 0) {
                                            // Fetch item details
                                            return $result->fetch_assoc();
                                        } else {
                                            return false;
                                        }
                                    }

                                    // Check if the item ID is provided in the URL
                                    if (isset($_GET['id'])) {

                                        $itemId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                                        // Check if $id is valid
                                        if ($itemId === false || $itemId === null) {
                                            header("location: ../components/error_404.php");
                                            exit;
                                        }

                                        // Fetch item details by ID
                                        $itemDetails = getItemDetails($connection, $itemId);

                                        // Check if item details were retrieved
                                        if ($itemDetails) {
                                            // Output item details
                                    ?>
                                            <tr>
                                                <td data-label='Description'><?php echo $itemDetails['Description'] ? $itemDetails['Description'] : 'N/A'; ?></td>
                                                <td data-label='PTag'><?php echo $itemDetails['Ptag'] ? $itemDetails['Ptag'] : 'N/A'; ?></td>
                                                <td data-label='gn'><?php echo $itemDetails['gn'] ? $itemDetails['gn'] : 'N/A'; ?></td>
                                                <td data-label='Model'><?php echo $itemDetails['Model'] ? $itemDetails['Model'] : 'N/A'; ?></td>
                                                <td data-label='Serial_No'><?php echo $itemDetails['Serial_No'] ? $itemDetails['Serial_No'] : 'N/A'; ?></td>
                                                <td data-label='Fund'><?php echo $itemDetails['Fund'] ? $itemDetails['Fund'] : 'N/A'; ?></td>
                                                <td data-label='AC'><?php echo $itemDetails['AC'] ? $itemDetails['AC'] : 'N/A'; ?></td>
                                                <td data-label='CL'><?php echo $itemDetails['CL'] ? $itemDetails['CL'] : 'N/A'; ?></td>
                                                <td data-label='F'><?php echo $itemDetails['F'] ? $itemDetails['F'] : 'N/A'; ?></td>
                                                <td data-label='AQU'><?php echo $itemDetails['AQU'] ? $itemDetails['AQU'] : 'N/A'; ?></td>
                                                <td data-label='ST'><?php echo $itemDetails['ST'] ? $itemDetails['ST'] : 'N/A'; ?></td>
                                                <td data-label='Acquisition'><?php echo $itemDetails['Acquisition'] ? $itemDetails['Acquisition'] : 'N/A'; ?></td>
                                                <td data-label='Received'><?php echo $itemDetails['Received'] ? $itemDetails['Received'] : 'N/A'; ?></td>
                                                <td data-label='Doc No'><?php echo $itemDetails['DocNo'] ? $itemDetails['DocNo'] : 'N/A'; ?></td>
                                                <td data-label='Amt'><?php echo $itemDetails['Amt'] ? $itemDetails['Amt'] : 'N/A'; ?></td>
                                                <td data-label='Location'><?php echo $itemDetails['Location'] ? $itemDetails['Location'] : 'N/A'; ?></td>
                                            </tr>
                                    <?php
                                        } else {
                                            // If no matching item found, redirect or show an error message
                                            echo "<tr><td colspan='17'>Item not found</td></tr>";
                                        }
                                    } else {
                                        // If no item ID is provided, redirect or show an error message
                                        echo "<tr><td colspan='17'>Item ID not provided</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            // Close database connection
                            $connection->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>

    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>

    <!-- Local JS -->
    <script src="../../js/app.js"></script>

</body>

</html>