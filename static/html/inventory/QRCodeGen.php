<?php include '../components/userSessionValidation.php'; ?>

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
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3"><strong>Equipment </strong>Information</h1>
                <div class="row">
                    <div class="col-12 col-lg-14 col-xxl-12 d-flex">
                        <div class="card flex-fill">
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

                    <div class="row justify-content-center">
                        <div class="col-9 col-lg-3 col-xxl-5">
                            <div class="d-flex justify-content-center">
                                <div class="card gradient-box" style="width: 240px;">
                                    <div class="card-body gradient-box mt-0 text-center">
                                        <h5 class="card-title mb-2" style="color: white !important">QR Code</h5>
                                        <div id="qr-code-container" class="d-flex justify-content-center align-items-center" style="height: 300px;">
                                            <!-- QR code will be appended here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            // Function to generate the QR code
            function generateQRCode(value) {
            var qr = qrcode(0, 'L'); // Create QRCode object with error correction level 'L' and size '0'
            qr.addData(value); // Add the input field value to the QRCode object
            qr.make(); // Generate QR code data
            var qrImage = qr.createImgTag(4); // Create image tag with a scaling factor of 4 (adjust as needed)
            document.getElementById('qr-code-container').innerHTML = qrImage; // Set the QR code image HTML to the qr-code div
            }

            // Function to run when the DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                var itemId = "<?php echo $itemId; ?>";
                var baseURL = "http://172.20.10.2/InterInventario/static/html/inventory/details.php";
                var itemURL = baseURL + "?id=" + itemId;
                generateQRCode(itemURL);
            });
        </script>

        <!-- jQuery -->
        <script src='https://code.jquery.com/jquery-3.7.0.js'></script>

        <!-- QR Code library -->
        <script src="https://cdn.jsdelivr.net/npm/qrcode-generator/qrcode.min.js"></script>

        <!-- Local JS -->
        <script src="../../js/app.js"></script>

</body>

</html>