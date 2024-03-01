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
    <link rel="shortcut icon" href="../../img/icons/interlogo3.png" />

    <title>Dashboard - IELS</title>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>

    <!-- Bootstrap added locally -->
    <link href="../../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body draggable="false">
    <?php $activePage = 'dashboard'; include './sidebar.php'; ?>

    <div class="main">
        <?php include './navbar.php'; ?>
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
                            <?php
                            include '../../db/config.php';

                            $query = "SELECT COUNT(*) AS TotalItems FROM prestamos";
                            $result = $connection->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                                $totalItems = $row['TotalItems'];
                            } else {
                                die("Invalid query: " . $connection->error);
                            }
                            echo "<h1 class='mt-1 mb-3'>$totalItems</h1>"
                            ?>
                            <div class="mb-0">
                                <a class="btn rounded-5 btn-lg btn-success mb-2" href="../loans/index.php" style="background-color: #00973c !important;">View Loans</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Equipment returned and awaiting review</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-success">
                                        <i class="align-middle" data-feather="check-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <?php
                            include '../../db/config.php';

                            $query = "SELECT COUNT(*) AS TotalItems FROM returns";
                            $result = $connection->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                                $totalItems = $row['TotalItems'];
                            } else {
                                die("Invalid query: " . $connection->error);
                            }
                            echo "<h1 class='mt-1 mb-3'>$totalItems</h1>"
                            ?>
                            <div class="mb-0">
                                <a class="btn rounded-5 btn-lg btn-success mb-2" href="../returns/index.php" style="background-color: #00973c !important;">View Returns</a>
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
                            <?php
                            include '../../db/config.php';

                            $query = "SELECT COUNT(*) AS TotalItems FROM inventario";
                            $result = $connection->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                                $totalItems = $row['TotalItems'];
                            } else {
                                die("Invalid query: " . $connection->error);
                            }
                            echo "<h1 class='mt-1 mb-3'>$totalItems</h1>"
                            ?>
                            <div class="mb-0">
                                <a class="btn rounded-5 btn-lg btn-success mb-2" href="../inventory/index.php" style="background-color: #00973c !important;">View Inventory</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Equipment Categories</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="database"></i>
                                    </div>
                                </div>
                            </div>
                            <?php
                            include '../../db/config.php';

                            $query = "SELECT COUNT(*) AS TotalItems FROM categories";
                            $result = $connection->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                                $totalItems = $row['TotalItems'];
                            } else {
                                die("Invalid query: " . $connection->error);
                            }
                            echo "<h1 class='mt-1 mb-3'>$totalItems</h1>"
                            ?>
                            <div class="mb-0">
                                <a class="btn rounded-5 btn-lg btn-success mb-2" href="../inventory/create-category.php" style="background-color: #00973c !important;">View Categories</a>
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
    <script src="../../js/app.js"></script>
    <script src="../../js/inventory.js"></script>

    <!-- Custom -->
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>