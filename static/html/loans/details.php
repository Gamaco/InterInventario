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

  <link rel="canonical" href="https://demo-basic.adminkit.io/" />

  <title>Details - IELS</title>

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
            <a class="sidebar-link" href="../dashboard.php">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
            </a>
          </li>

          <li class="sidebar-item active">
            <a class="sidebar-link" href="../loans/index.php">
              <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Loans</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="../returns/index.php">
              <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Returned</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="../inventory/index.php">
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
            <img src="img/icons/inter-logo2-48px.png" class="avatar img-fluid rounded me-1" alt="Admin" /> <span class="text-dark">Admin</span>
          </a>
        </ul>
      </nav>

      <main class="content">
        <div class="container-fluid p-0">

          <section>
            <div class="container py-5">
              <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                  <div class="card text-black">
                    <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/3.webp" class="card-img-top" alt="Apple Computer" />
                    <div class="card-body">
                      <div class="text-center">
                        <h5 class="card-title">Believing is seeing</h5>
                        <p class="text-muted mb-4">Apple pro display XDR</p>
                      </div>
                      <div>
                        <div class="d-flex justify-content-between">
                          <span>Pro Display XDR</span><span>$5,999</span>
                        </div>
                        <div class="d-flex justify-content-between">
                          <span>Pro stand</span><span>$999</span>
                        </div>
                        <div class="d-flex justify-content-between">
                          <span>Vesa Mount Adapter</span><span>$199</span>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between total font-weight-bold mt-4">
                        <span>Total</span><span>$7,197.00</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        </div>
      </main>
    </div>
  </div>
  </div>

  <script src="js/app.js"></script>

</body>

</html>