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

    <title>Index - IELS</title>
    <link rel="stylesheet" , href="../../css/inventory.css">
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
    <!-- Bootstrap added locally -->
    <link href="../../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

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
                <h1 class="h3 mb-3"><strong>Inventory</strong> List</h1>
                <div class="row">
                    <div class="col-12 col-lg-14 col-xxl-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-body mt-0">
                                <h5 class="card-title mb-2">Options</h5>
                                <div class="row mt-0">
                                    <div class="col-6 col-sm-auto">
                                        <a class="btn btn-primary btn-lg btn-block mb-2 mb-sm-0" href="../inventory/create.php" style="width: 160px" ;><i class="fa fa-plus" aria-hidden="true"></i> Add Product</a>
                                    </div>
                                    <div class="col-6 col-sm-auto">
                                        <a class="btn btn-lg btn-primary btn-block" href="../inventory/create-category.php" style="width: 160px" ;><i class="fa fa-plus" aria-hidden="true"></i> Add Category</a>
                                    </div>
                                </div>
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
                                            <input type="text" id="searchInput" class="form-control fs-4" placeholder="Search e.g. Y00109987">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end">
                                        <div class="dropdown-center">
                                            <button class="btn btn-success btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #00973c;">
                                                Categories
                                            </button>
                                            <ul class="dropdown-menu" id="categoryDropdown">
                                                <?php
                                                include '../../db/config.php';

                                                $query = "SELECT * FROM categories";
                                                $categories = $connection->query($query);

                                                // In case the query failed
                                                if (!$categories) {
                                                    die("Invalid query: " . $$connection->error);
                                                }

                                                while ($category = $categories->fetch_assoc()) {
                                                    echo "
                                                        <li><a class='dropdown-item'>" . $category["Category"] . "</a></li>
                                                ";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-14 col-xxl-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <div class="row mt-3">
                                    <span class="badge badge-secondary responsive-badge fs-5 p-2" id="displayedRowCount"></span>
                                </div>

                            </div>


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
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../../db/config.php';

                                        $query = "SELECT * FROM inventario ORDER BY id DESC";
                                        $equipos = $connection->query($query);

                                        // In case the query failed
                                        if (!$equipos) {
                                            die("Invalid query: " . $$connection->error);
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
                                                   <a class='btn btn-primary mb-lg-1 rounded-3 btn-lg' style='width: 100px;' href=./edit.php?id=$equipo[id]><i class='fa fa-pencil' aria-hidden='true'></i> Edit
                                                       </div></a>
                                                   <a class='btn btn-danger rounded-3 btn-lg' style='width: 100px;' data-bs-toggle='modal' data-bs-target='#itemDeletionModal' data-item-id='$equipo[id]'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
                                                </td>
                                           </tr>
                                               ";
                                        }

                                        $connection->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Modal -->
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>

    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>

    <!-- Local JS -->
    <script src="../../js/app.js"></script>
    <script src="../../js/inventory.js"></script>

    <!-- Item Deletion Warning Modal (Are you sure you want to delete?) -->
    <script>
        var itemDeletionModal = document.getElementById('itemDeletionModal');
        itemDeletionModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var itemId = button.getAttribute('data-item-id'); // Extract info from data-* attributes
            var modal = this;
            modal.querySelector('#itemIdToDelete').textContent = itemId;
            modal.querySelector('#confirmDeleteBtn').addEventListener('click', function() {
                // Perform deletion action here using the itemId
                window.location.href = './delete.php?id=' + itemId;
            });
        });
    </script>

</body>

</html>