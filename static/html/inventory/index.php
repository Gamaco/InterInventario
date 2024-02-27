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
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="../dashboard.php">
                    <img src="../../img/icons/universidad-interamericana-pr-logo.png" alt="" class="img-fluid w-50 h-50">
                    <br><span class="align-middle">Equipment Loan System</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Menu
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../dashboard.php">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../loans/index.php">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Loans</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../returns/index.php">
                            <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Returns</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="../inventory/index.php">
                            <i class="align-middle" data-feather="database"></i> <span class="align-middle">Inventory</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        User
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../user/login.php">
                            <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Log out</span>
                        </a>
                    </li>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <ul class="navbar-nav navbar-align">
                    <a class="nav-link d-none d-sm-inline-block">
                        <img src="../../img/icons/inter-logo2-48px.png" class="avatar img-fluid rounded me-1" alt="Admin" />
                        <span class="text-dark">Admin</span>
                    </a>
                </ul>
            </nav>
            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>Inventory</strong> List</h1>
                    <div class="row">
                        <div class="col-12 col-lg-14 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <div class="d-flex flex-column justify-content-between align-items-start flex-wrap">
                                        <div class="d-flex w-100 w-sm-75 mb-2 mb-md-0">
                                            <input type="text" id="searchInput" class="form-control me-2" placeholder="Search e.g. Y00109987">
                                        </div>
                                        <div class="d-flex mt-4">
                                            <a class="btn btn-primary btn-lg me-2" href="../inventory/create.php">Add New</a>
                                            <div class="dropdown-center">
                                                <button class="btn btn-success btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #00973c !important;">
                                                    Categories
                                                </button>
                                                <ul class="dropdown-menu" id="categoryDropdown">
                                                    <li><a class="dropdown-item" href="#">All Categories</a></li>
                                                    <li><a class="dropdown-item" href="#">PC LENOVO</a></li>
                                                    <li><a class="dropdown-item" href="#">THINKSTATION</a></li>
                                                    <li><a class="dropdown-item" href="#">ESTACION DE TRABAJO</a></li>
                                                    <li><a class="dropdown-item" href="#">PODIUM</a></li>
                                                    <li><a class="dropdown-item" href="#">HIDDEN POWER CENTER</a></li>
                                                    <li><a class="dropdown-item" href="#">MINI DESKTOP</a></li>
                                                    <li><a class="dropdown-item" href="#">IBM LENOVO</a></li>
                                                    <li><a class="dropdown-item" href="#">Computers</a></li>
                                                    <li><a class="dropdown-item" href="#">STORAGE CIBER LABS</a></li>
                                                    <li><a class="dropdown-item" href="#">ACCU SCOPE - ZOOM ST</a></li>
                                                    <li><a class="dropdown-item" href="#">TABLEAU TX1</a></li>
                                                    <li><a class="dropdown-item" href="#">ULTIMAKER S3 - 3D PR</a></li>
                                                    <li><a class="dropdown-item" href="#">HOT MELT</a></li>
                                                    <li><a class="dropdown-item" href="#">AUTO POLICHER KIT</a></li>
                                                    <li><a class="dropdown-item" href="#">BUNDLE STATIONS</a></li>
                                                    <li><a class="dropdown-item" href="#">THINKCENTRE</a></li>
                                                    <li><a class="dropdown-item" href="#">PRELOAD TYPE STANDAR</a></li>
                                                    <li><a class="dropdown-item" href="#">TV SMART</a></li>
                                                    <li><a class="dropdown-item" href="#">VADDIO CONFERENCE</a></li>
                                                    <li><a class="dropdown-item" href="#">NEC MULTISYNC</a></li>
                                                    <li><a class="dropdown-item" href="#">PURIFICADOR DE AIRE</a></li>
                                                    <li><a class="dropdown-item" href="#">Logitech Rally Plus</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h5 id="displayedRowCount"></h5>
                                        </div>
                                    </div>

                                </div>


                                <div class="table-container">
                                    <table id="InventoryTable" class="table my-0 border-secondary">
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
                                                   <a class='btn btn-primary mb-lg-1' style='width: 80px;' href=./edit.php?id=$equipo[id]>Edit
                                                       </div></a>
                                                   <a class='btn btn-danger' style='width: 80px;' data-bs-toggle='modal' data-bs-target='#itemDeletionModal' data-item-id='$equipo[id]'>Delete</a>
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