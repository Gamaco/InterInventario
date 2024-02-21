<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Inventario">
    <meta name="author" content="Inter Bayamon">
    <meta name="keywords"
        content="Inter Bayamon, Inventario, Sistema de Inventario, admin, Universidad Interamericana, Bayamon, Inventario de Equipos">

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
                        <a class="sidebar-link" href="loans.php">
                            <i class="align-middle" data-feather="file-text"></i> <span
                                class="align-middle">Loans</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="returned.php">
                            <i class="align-middle" data-feather="check-circle"></i> <span
                                class="align-middle">Returned</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="inventory.php">
                            <i class="align-middle" data-feather="database"></i> <span
                                class="align-middle">Inventory</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        User
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="login.php">
                            <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Log
                                out</span>
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
                        <div class="d-flex mb-2">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search">
                            <div class="dropdown d-none d-xl-table-cell">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    All Category
                                </button>
                                <ul class="dropdown-menu" id="categoryDropdown">
                                    <li><a class="dropdown-item" href="#">Devices</a></li>
                                    <li><a class="dropdown-item" href="#">Infrastrcuture</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto text-center text-md-start">
                            <button class="btn btn-primary mb-2">Add New <div data-feather="plus"></div>
                            </button></td>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-14 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                </div>
                                <div class="table-container">
                                    <table id="InventoryTable" class="table my-0 table-bordered border-secondary">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>gn</th>
                                                <th>PTag</th>
                                                <th>Description</th>
                                                <th>Model</th>
                                                <th>Serial_No</th>
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
                                            <tr>
                                                <td data-label="ID">1</td>
                                                <td data-label="gn">35010</td>
                                                <td data-label="PTag">Y02087990</td>
                                                <td data-label="Description">MINI DESKTOP (29)</td>
                                                <td data-label="Model">INTEL CORE</td>
                                                <td data-label="Serial_No">MXL70420SH</td>
                                                <td data-label="Fund">116071</td>
                                                <td data-label="AC">49</td>
                                                <td data-label="CL">5</td>
                                                <td data-label="F">IN</td>
                                                <td data-label="AQU">MA</td>
                                                <td data-label="ST">I</td>
                                                <td data-label="Acquisition">12/19/2016</td>
                                                <td data-label="Received"> N/A</td>
                                                <td data-label="Doc No">PY170373</td>
                                                <td data-label="Amt">864.12</td>
                                                <td data-label="Location">F-203</td>
                                                <td data-label="Stock">4 out of 10</td>
                                                <th>
                                                    <button class="btn btn-primary mb-1">Edit <div data-feather="edit">
                                                        </div></button>
                                                    <button class="btn btn-danger">Delete <div data-feather="trash-2">
                                                        </div></button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">2</td>
                                                <td data-label="gn">36010</td>
                                                <td data-label="PTag">Y12087990</td>
                                                <td data-label="Description">MINI DESKTOP (29)</td>
                                                <td data-label="Model">INTEL CORE</td>
                                                <td data-label="Serial_No">MXL70420SH</td>
                                                <td data-label="Fund">116071</td>
                                                <td data-label="AC">49</td>
                                                <td data-label="CL">5</td>
                                                <td data-label="F">IN</td>
                                                <td data-label="AQU">MA</td>
                                                <td data-label="ST">I</td>
                                                <td data-label="Acquisition">12/19/2016</td>
                                                <td data-label="Received"> N/A</td>
                                                <td data-label="Doc No">PY170377</td>
                                                <td data-label="Amt">864.12</td>
                                                <td data-label="Location">F-203</td>
                                                <td data-label="Stock">4 out of 10</td>
                                                <th>
                                                    <button class="btn btn-primary mb-1">Edit <div data-feather="edit">
                                                        </div></button>
                                                    <button class="btn btn-danger">Delete <div data-feather="trash-2">
                                                        </div></button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">3</td>
                                                <td data-label="gn">35010</td>
                                                <td data-label="PTag">Y02087990</td>
                                                <td data-label="Description">MINI DESKTOP (29)</td>
                                                <td data-label="Model">INTEL CORE</td>
                                                <td data-label="Serial_No">MXL70420SH</td>
                                                <td data-label="Fund">116071</td>
                                                <td data-label="AC">49</td>
                                                <td data-label="CL">5</td>
                                                <td data-label="F">IN</td>
                                                <td data-label="AQU">PO</td>
                                                <td data-label="ST">I</td>
                                                <td data-label="Acquisition">12/19/2016</td>
                                                <td data-label="Received"> N/A</td>
                                                <td data-label="Doc No">PY170377</td>
                                                <td data-label="Amt">864.12</td>
                                                <td data-label="Location">F-203</td>
                                                <td data-label="Stock">4 out of 10</td>
                                                <th>
                                                    <button class="btn btn-primary mb-1">Edit <div data-feather="edit">
                                                        </div></button>
                                                    <button class="btn btn-danger">Delete <div data-feather="trash-2">
                                                        </div></button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">4</td>
                                                <td data-label="gn">35010</td>
                                                <td data-label="PTag">Y02087990</td>
                                                <td data-label="Description">MINI DESKTOP (29)</td>
                                                <td data-label="Model">INTEL CORE</td>
                                                <td data-label="Serial_No">MXL70420SH</td>
                                                <td data-label="Fund">116071</td>
                                                <td data-label="AC">49</td>
                                                <td data-label="CL">5</td>
                                                <td data-label="F">IN</td>
                                                <td data-label="AQU">PO</td>
                                                <td data-label="ST">I</td>
                                                <td data-label="Acquisition">12/19/2016</td>
                                                <td data-label="Received"> N/A</td>
                                                <td data-label="Doc No">PY170377</td>
                                                <td data-label="Amt">864.12</td>
                                                <td data-label="Location">F-203</td>
                                                <td data-label="Stock">4 out of 10</td>
                                                <th>
                                                    <button class="btn btn-primary mb-1">Edit <div data-feather="edit">
                                                        </div></button>
                                                    <button class="btn btn-danger">Delete <div data-feather="trash-2">
                                                        </div></button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">5</td>
                                                <td data-label="gn">35010</td>
                                                <td data-label="PTag">Y02087990</td>
                                                <td data-label="Description">MINI DESKTOP (29)</td>
                                                <td data-label="Model">INTEL CORE</td>
                                                <td data-label="Serial_No">MXL70420SH</td>
                                                <td data-label="Fund">116071</td>
                                                <td data-label="AC">49</td>
                                                <td data-label="CL">5</td>
                                                <td data-label="F">IN</td>
                                                <td data-label="AQU">PO</td>
                                                <td data-label="ST">I</td>
                                                <td data-label="Acquisition">12/19/2016</td>
                                                <td data-label="Received"> N/A</td>
                                                <td data-label="Doc No">PY170377</td>
                                                <td data-label="Amt">864.12</td>
                                                <td data-label="Location">F-203</td>
                                                <td data-label="Stock">4 out of 10</td>
                                                <th>
                                                    <button class="btn btn-primary mb-1">Edit <div data-feather="edit">
                                                        </div></button>
                                                    <button class="btn btn-danger">Delete <div data-feather="trash-2">
                                                        </div></button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">6</td>
                                                <td data-label="gn">35010</td>
                                                <td data-label="PTag">Y02087990</td>
                                                <td data-label="Description">MINI DESKTOP (29)</td>
                                                <td data-label="Model">INTEL CORE</td>
                                                <td data-label="Serial_No">MXL70420SH</td>
                                                <td data-label="Fund">116071</td>
                                                <td data-label="AC">49</td>
                                                <td data-label="CL">5</td>
                                                <td data-label="F">IN</td>
                                                <td data-label="AQU">PO</td>
                                                <td data-label="ST">I</td>
                                                <td data-label="Acquisition">12/19/2016</td>
                                                <td data-label="Received"> N/A</td>
                                                <td data-label="Doc No">PY170377</td>
                                                <td data-label="Amt">864.12</td>
                                                <td data-label="Location">F-203</td>
                                                <td data-label="Stock">4 out of 10</td>
                                                <th>
                                                    <button class="btn btn-primary mb-1">Edit <div data-feather="edit">
                                                        </div></button>
                                                    <button class="btn btn-danger">Delete <div data-feather="trash-2">
                                                        </div></button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">7</td>
                                                <td data-label="gn">35010</td>
                                                <td data-label="PTag">Y02087990</td>
                                                <td data-label="Description">MINI DESKTOP (29)</td>
                                                <td data-label="Model">INTEL CORE</td>
                                                <td data-label="Serial_No">MXL70420SH</td>
                                                <td data-label="Fund">116071</td>
                                                <td data-label="AC">49</td>
                                                <td data-label="CL">5</td>
                                                <td data-label="F">IN</td>
                                                <td data-label="AQU">PO</td>
                                                <td data-label="ST">I</td>
                                                <td data-label="Acquisition">12/19/2016</td>
                                                <td data-label="Received"> N/A</td>
                                                <td data-label="Doc No">PY170377</td>
                                                <td data-label="Amt">864.12</td>
                                                <td data-label="Location">F-203</td>
                                                <td data-label="Stock">4 out of 10</td>
                                                <th>
                                                    <button class="btn btn-primary mb-1">Edit <div data-feather="edit">
                                                        </div></button>
                                                    <button class="btn btn-danger">Delete <div data-feather="trash-2">
                                                        </div></button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">8</td>
                                                <td data-label="gn">35010</td>
                                                <td data-label="PTag">Y02087990</td>
                                                <td data-label="Description">MINI DESKTOP (29)</td>
                                                <td data-label="Model">INTEL CORE</td>
                                                <td data-label="Serial_No">MXL70420SH</td>
                                                <td data-label="Fund">116071</td>
                                                <td data-label="AC">49</td>
                                                <td data-label="CL">5</td>
                                                <td data-label="F">IN</td>
                                                <td data-label="AQU">PO</td>
                                                <td data-label="ST">I</td>
                                                <td data-label="Acquisition">12/19/2016</td>
                                                <td data-label="Received"> N/A</td>
                                                <td data-label="Doc No">PY170377</td>
                                                <td data-label="Amt">864.12</td>
                                                <td data-label="Location">F-203</td>
                                                <td data-label="Stock">4 out of 10</td>
                                                <th>
                                                    <button class="btn btn-primary mb-1">Edit <div data-feather="edit">
                                                        </div></button>
                                                    <button class="btn btn-danger">Delete <div data-feather="trash-2">
                                                        </div></button>
                                                </th>
                                            </tr>
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
</body>

</html>