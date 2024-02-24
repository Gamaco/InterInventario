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
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>

    <!-- Bootstrap added locally -->
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body draggable="false">
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="./loans/index.php">
                    <img src="../img/icons/universidad-interamericana-pr-logo.png" alt="" class="img-fluid w-50 h-50">
                    <br><span class="align-middle">Equipment Loan System</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Menu
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="./dashboard.php">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./loans/index.php">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Loans</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./returns/index.php">
                            <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Returns</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./inventory/index.php">
                            <i class="align-middle" data-feather="database"></i> <span class="align-middle">Inventory</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        User
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./user/login.php">
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
                        <img src="../img/icons/inter-logo2-48px.png" class="avatar img-fluid rounded me-1" alt="Admin" />
                        <span class="text-dark">Admin</span>
                    </a>
                </ul>
            </nav>
            <main class="content">
                <h1 class="h3 mb-3">Dashboard</h1>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Loans</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="file-text"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">10</h1>
                                <div class="mb-0">
                                    <a class="btn btn-lg btn-success mb-2" href="./returned/index.php" style="background-color: #00973c !important;">View Loans</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Returned Equipment</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-success">
                                            <i class="align-middle" data-feather="check-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">17</h1>
                                <div class="mb-0">
                                    <a class="btn btn-lg btn-success mb-2" href="./returned/index.php" style="background-color: #00973c !important;">Returned List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Inventory</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="database"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">321</h1>
                                <div class="mb-0">
                                    <a class="btn btn-lg btn-success mb-2" href="./inventory/index.php" style="background-color: #00973c !important;">View Inventory</a>
                                </div>
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
    <script src="../js/app.js"></script>
    <script src="../js/inventory.js"></script>

    <!-- Custom -->
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>