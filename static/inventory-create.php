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

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Inventario de Equipos</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
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
                <div class="container-fluid p-0 justify-content-center">
                    <div class="row">
                        <div class="card mx-auto my-5 col-12 col-md-6 p-0">
                            <div class="card-header bg-success w-100" style="background-color: #00973c !important;">
                                <h5 class="h5 mb-0 text-white"><i>New Item</i></h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row flex-wrap">
                                        <div class="col-12 col-md mb-3">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="Ptag" class="form-control" />
                                                <label class="form-label" for="PTag">PTag</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md mb-3">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="gn" class="form-control" />
                                                <label class="form-label" for="gn">GN</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-wrap">
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="description" class="form-control" />
                                                <label class="form-label" for="description">Description</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="model" class="form-control" />
                                                <label class="form-label" for="model">Model</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-wrap">
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="Serial_No" class="form-control" />
                                                <label class="form-label" for="description">Serial No</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="Fund" class="form-control" />
                                                <label class="form-label" for="model">Fund</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-wrap">
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="AC" class="form-control" />
                                                <label class="form-label" for="AC">AC</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="CL" class="form-control" />
                                                <label class="form-label" for="CL">CL</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-wrap">
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="F" class="form-control" />
                                                <label class="form-label" for="F">F</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="AQU" class="form-control" />
                                                <label class="form-label" for="AQU">AQU</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-wrap">
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="ST" class="form-control" />
                                                <label class="form-label" for="ST">ST</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="Acquisition" class="form-control" />
                                                <label class="form-label" for="Acquisition">Acquisition</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-wrap">
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="Received" class="form-control" />
                                                <label class="form-label" for="Received">Received</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="DocNo" class="form-control" />
                                                <label class="form-label" for="DocNo">Doc No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-wrap">
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="Amt" class="form-control" />
                                                <label class="form-label" for="Amt">Amt</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md mb-3">
                                            <!-- Text input -->
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="Location" class="form-control" />
                                                <label class="form-label" for="Location">Location</label>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Button container with centering classes -->
                                    <div class="justify-content-center">
                                        <div class="row">
                                            <!-- Submit button -->
                                            <button type="button" class="btn btn-success btn-lg mb-2" style="background-color: #00973c !important;">Submit</button>
                                        </div>
                                        <div class="row">
                                            <!-- Cancel button -->
                                            <a type="button" class="btn btn-light btn-lg mb-2" href="inventory.php">Cancel</a>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <script src="js/app.js"></script>
</body>

</html>