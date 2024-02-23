<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Inventario">
    <meta name="author" content="Inter Bayamon">
    <meta name="keywords" content="Inter Bayamon, Inventario, Sistema de Inventario, admin, Universidad Interamericana, Bayamon, Inventario de Equipos">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/interlogo3.png" />

    <title>Inventario de Equipos</title>
    <link rel="stylesheet" , href="css/inventory.css">
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
    <!-- Bootstrap added locally -->
    <link href="css/app.css" rel="stylesheet">
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
                <a class="sidebar-brand" href="loans.php">
                    <img src="img/icons/universidad-interamericana-pr-logo.png" alt="" class="img-fluid w-50 h-50">
                    <br><span class="align-middle">Equipment Loan System</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Menu
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="dashboard.php">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="loans.php">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Loans</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="returned.php">
                            <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Returned</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="inventory.php">
                            <i class="align-middle" data-feather="database"></i> <span class="align-middle">Inventory</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        User
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="login.php">
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
                        <img src="img/icons/inter-logo2-48px.png" class="avatar img-fluid rounded me-1" alt="Admin" />
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
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <div class="d-flex w-75 w-md-100 mb-2 mb-md-0">
                                            <input type="text" id="searchInput" class="form-control me-2" placeholder="Search">
                                            <div class="dropdown-center d-none d-xl-table-cell me-2">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    All Category
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark" id="categoryDropdown">
                                                    <li><a class="dropdown-item" href="#">All Category</a></li>
                                                    <li><a class="dropdown-item" href="#">Devices</a></li>
                                                    <li><a class="dropdown-item" href="#">Infrastructure</a></li>
                                                    <li><a class="dropdown-item" href="#">Placeholder</a></li>
                                                </ul>
                                            </div>
                                            <button class="btn btn-light">Search</button>
                                        </div>
                                        <div class="col-auto text-center d-flex align-items-center">
                                            <a class="btn btn-primary mb-2" href="inventory-create.php">Add New</a>
                                        </div>
                                    </div>
                                </div>


                                <div class="table-container">
                                    <table id="InventoryTable" class="table my-0 table-striped border-secondary">
                                        <thead>
                                            <tr>
                                                <th>PTag</th>
                                                <th>GN</th>
                                                <th>Description</th>
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
                                                <th>Stock</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $database = "interloanhub";

                                            // Create connection
                                            $connection = new mysqli($servername, $username, $password, $database);

                                            // Check connection
                                            if ($connection->connect_error) {
                                                die("Connection failed: " . $connection->connect_error);
                                            }

                                            $query = "SELECT * FROM inventario";
                                            $equipos = $connection->query($query);

                                            // In case the query failed
                                            if (!$equipos) {
                                                die("Invalid query: " . $$connection->error);
                                            }

                                            // Read data
                                            while ($equipo = $equipos->fetch_assoc()) {
                                                echo "
                                               <tr>
                                               <td data-label='PTag'>$equipo[Ptag]</td>
                                               <td data-label='gn'>$equipo[gn]</td>
                                               <td data-label='Description'>$equipo[Description]</td>
                                               <td data-label='Model'>$equipo[Model]</td>
                                               <td data-label='Serial_No'>$equipo[Serial_No]</td>
                                               <td data-label='Fund'>$equipo[Fund]</td>
                                               <td data-label='AC'>$equipo[AC]</td>
                                               <td data-label='CL'>$equipo[CL]</td>
                                               <td data-label='F'>$equipo[F]</td>
                                               <td data-label='AQU'>$equipo[AQU]</td>
                                               <td data-label='ST'>$equipo[ST]</td>
                                               <td data-label='Acquisition'>$equipo[Acquisition]</td>
                                               <td data-label='Received'>$equipo[Received]</td>
                                               <td data-label='Doc No'>$equipo[DocNo]</td>
                                               <td data-label='Amt'>$equipo[Amt]</td>
                                               <td data-label='Location'>$equipo[Location]</td>
                                               <td data-label='Stock'>4 out of 10</td>
                                               <th>
                                                   <a class='btn btn-primary mb-1' href=details.php?id=$equipo[id]>Edit
                                                       </div></a>
                                                   <a class='btn btn-danger' href=delete.php?$equipo[id]>Delete
                                                       </div></a>
                                               </th>
                                           </tr>
                                               ";
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
    </div>

    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>

    <!-- Local JS -->
    <script src="js/app.js"></script>
    <script src="js/inventory.js"></script>

    <!-- Custom -->
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>