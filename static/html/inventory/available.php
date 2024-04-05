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

    <title>Inventory | IELS</title>
    <link rel="stylesheet" , href="../../css/inventory.css">
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='../../css/font-awesome-4.7.0/css/font-awesome.min.css'>
    <!-- Bootstrap added locally -->
    <link href="../../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body draggable="false">
    <?php $activePage = 'inventory';
    include '../components/sidebar.php'; ?>

    <div class="main">
        <?php include '../components/navbar.php'; ?>

        <main class="content">
            <div class="container-fluid">
                <h1 class="h3 mb-3"><strong>Inventory</strong> List</h1>

                <div class="row mb-3">
                    <div class="col-sm-auto ms-auto">
                        <a class="btn btn-lg fs-5 text-dark btn-secondary" href="../inventory/create-category.php"><i class="fa fa-cog" aria-hidden="true"></i> Manage Categories</a>
                    </div>
                </div>

                <hr class="mb-3">

                <div class="row mb-3">
                    <div class="col-md-auto mb-2 mb-md-0 d-flex align-items-center">
                        <a class="btn btn-primary btn-lg fs-5 me-md-2 me-2" href="../inventory/create.php"><i class="fa fa-plus" aria-hidden="true"></i> Add Product</a>
                        <div class="dropdown-center">
                            <button class="btn btn-secondary text-dark fs-5 btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                All Categories
                            </button>
                            <ul class="dropdown-menu" id="categoryDropdown">
                                <li class="disabled"><a class="dropdown-header disabled"><i class="fa fa-filter" aria-hidden="true"></i> Categories | Scroll Down</a></li>
                                <hr class="mt-0 mb-2">
                                <?php
                                include '../../db/config.php';

                                $query = "CALL GetCategories()";

                                $stmt = $connection->prepare($query);

                                if (!$stmt) {
                                    die("Error preparing statement: " . $connection->error);
                                }

                                $result = $stmt->execute();

                                if (!$result) {
                                    die("Error executing statement: " . $stmt->error);
                                }

                                $stmt->bind_result($id, $category);

                                while ($stmt->fetch()) {
                                    echo "<li><a class='dropdown-item border rounded rounded-5 border-light border-1 fs-4 mb-1 mt-1 p-3'>" . $category . "</a></li>";
                                }

                                $stmt->close();
                                $connection->close();
                                ?>
                                <li class="dropdown-arrow">
                                    <span class="arrow-down"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-lg-14 col-xxl-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                                        <input type="text" id="searchInput" class="form-control fs-4 form-control-lg p-2" placeholder="Search">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-14 col-xxl-12 d-flex">
                    <span class="badge badge-secondary fs-5 p-4 mb-3 responsive-badge" id="displayedRowCount"></span>
                </div>
            </div>

            <div class="row">
                <div class="btn-group mb-3 w-25">
                    <a href="./available.php" class="btn btn-lg btn-primary active" aria-current="page">Available</a>
                    <a href="./unavailable.php" class="btn btn-lg btn-light">Unavailable</a>
                </div>

                <div class="col-12 col-lg-14 col-xxl-12 d-flex">
                    <div class="card flex-fill">
                        <div class="table-container" style="overflow-x: auto;">
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
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../../db/config.php';

                                    $query = "CALL GetAvailableInventory()";

                                    $equipos = $connection->query($query);

                                    // In case the query failed
                                    if (!$equipos) {
                                        die("Invalid query: " . $connection->error);
                                    }

                                    // Reads data and also checks if the field value is empty.
                                    // In case the field is empty, it'll display N/A on the table,
                                    // to avoid having empty spaces on the table.
                                    // Empty spaces make the table collapse/wrap a field into another.
                                    while ($equipo = $equipos->fetch_assoc()) {
                                        echo "
                                            <tr>
                                                <td data-label='Description'>" . ($equipo['Description'] ? $equipo['Description'] : 'N/A') . "</td>
                                                <td data-label='PTag'>" . ($equipo['Ptag'] ? $equipo['Ptag'] : 'N/A') . "</td>
                                                <td data-label='gn'>" . ($equipo['gn'] ? $equipo['gn'] : 'N/A') . "</td>
                                                <td data-label='Model'>" . ($equipo['Model'] ? $equipo['Model'] : 'N/A') . "</td>
                                                <td data-label='Serial_No'>" . ($equipo['Serial_No'] ? $equipo['Serial_No'] : 'N/A') . "</td>
                                                <td data-label='Fund'>" . ($equipo['Fund'] ? $equipo['Fund'] : 'N/A') . "</td>
                                                <td data-label='AC'>" . ($equipo['AC'] ? $equipo['AC'] : 'N/A') . "</td>
                                                <td data-label='CL'>" . ($equipo['CL'] ? $equipo['CL'] : 'N/A') . "</td>
                                                <td data-label='F'>" . ($equipo['F'] ? $equipo['F'] : 'N/A') . "</td>
                                                <td data-label='AQU'>" . ($equipo['AQU'] ? $equipo['AQU'] : 'N/A') . "</td>
                                                <td data-label='ST'>" . ($equipo['ST'] ? $equipo['ST'] : 'N/A') . "</td>
                                                <td data-label='Acquisition'>" . ($equipo['Acquisition'] ? $equipo['Acquisition'] : 'N/A') . "</td>
                                                <td data-label='Received'>" . ($equipo['Received'] ? $equipo['Received'] : 'N/A') . "</td>
                                                <td data-label='Doc No'>" . ($equipo['DocNo'] ? $equipo['DocNo'] : 'N/A') . "</td>
                                                <td data-label='Amt'>" . ($equipo['Amt'] ? $equipo['Amt'] : 'N/A') . "</td>
                                                <td data-label='Location'>" . ($equipo['Location'] ? $equipo['Location'] : 'N/A') . "</td>
                                                <td>
                                                    <a class='btn btn-light mt-1 mb-lg-1 rounded-3 btn-lg' style='width: 100px;' href='./edit.php?id=" . htmlspecialchars($equipo['id']) . "'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</a>
                                                    <a class='btn btn-danger mt-1 mb-lg-1 rounded-3 btn-lg' style='width: 100px;' data-bs-toggle='modal' data-bs-target='#itemDeletionModal' data-item-id='$equipo[id]'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
                                                </td>
                                            </tr>";
                                    }

                                    $connection->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- item Deletion Modal -->
    <div class="modal fade" id="itemDeletionModal" tabindex="-1" aria-labelledby="itemDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemDeletionModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You are about to delete this item. This action cannot be undone.</p>
                    <p>Are you sure you want to proceed?</p>
                    <input type="hidden" id="itemIdToDelete" name="deleteItemId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-dark" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>

    <!-- Local JS -->
    <script src="../../js/app.js"></script>
    <script src="../../js/inventory.js"></script>
    <script src="../../js/inventory-index.js"></script>
</body>

</html>