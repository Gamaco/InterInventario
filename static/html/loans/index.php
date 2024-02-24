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

    <title>Inventario de Equipos</title>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
    <!-- Bootstrap added locally -->
    <link href="../../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body draggable="false">
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="../loans/index.php">
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

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="../loans/index.php">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Loans</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../returns/index.php">
                            <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Returns</span>
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
					
						<h1 class="h3 mb-3"><strong>Active</strong> Loans</h1>

						<div class="row">
							<div class="col-12 col-lg-15 col-xxl-12 d-flex">
								<div class="card flex-fill">
									<div class="card-header">
										<div class="d-flex mt-3 mb-3">
											<div class="input-group">
												<input type="text" id="searchInput" class="form-control" placeholder="Search">
											</div>
										</div>
										<div class="col-auto text-center text-md-start">
											<a class="btn btn-primary mb-2" href="./create.php">Create New Loan
											</a></td>
										</div>
									</div>
									<table id="dataTable" class="table table-hover my-0 table-striped">
										<thead>
											<tr>
												<th>Description</th>
												<th>Student ID</th>
												<th class="d-none d-xl-table-cell">Status</th>
												<th class="d-none d-xl-table-cell">Start_Date</th>
												<th class="d-none d-xl-table-cell">End_Date</th>
												<th class="d-none d-xl-table-cell">PTag</th>
												<th class="d-none d-xl-table-cell">Lender</th>
												<th>Options</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>MINI DESKTOP (29)</td>
												<td>Y12088025</td>
												<td class="d-none d-xl-table-cell">
													<span class="badge bg-warning">In Progress</span>
												</td>
												<td class="d-none d-xl-table-cell">01/02/2023</td>
												<td class="d-none d-xl-table-cell">30/12/2025</td>
												<td class="d-none d-xl-table-cell">Y02088027</td>
												<td class="d-none d-xl-table-cell">Y00093456</td>
												<td>
													<button class="btn btn-success mb-2">Return</button>
													<button class="btn btn-info mb-2">Details</button>
												</td>
											</tr>
											<tr>
												<td>MINI DESKTOP (29)</td>
												<td>Y12088025</td>
												<td class="d-none d-xl-table-cell">
													<span class="badge bg-warning">In Progress</span>
												</td>
												<td class="d-none d-xl-table-cell">01/02/2023</td>
												<td class="d-none d-xl-table-cell">30/12/2025</td>
												<td class="d-none d-xl-table-cell">Y02088027</td>
												<td class="d-none d-xl-table-cell">Y00093456</td>
												<td>
													<button class="btn btn-success mb-2">Return</button>
													<button class="btn btn-info mb-2">Details</button>
												</td>
											</tr>
											<tr>
												<td>MINI DESKTOP (29)</td>
												<td>Y12088025</td>
												<td class="d-none d-xl-table-cell">
													<span class="badge bg-warning">In Progress</span>
												</td>
												<td class="d-none d-xl-table-cell">01/02/2023</td>
												<td class="d-none d-xl-table-cell">30/12/2025</td>
												<td class="d-none d-xl-table-cell">Y02088027</td>
												<td class="d-none d-xl-table-cell">Y00093456</td>
												<td>
													<button class="btn btn-success mb-2">Return</button>
													<button class="btn btn-info mb-2">Details</button>
												</td>
											</tr>
											<tr>
												<td>MINI DESKTOP (29)</td>
												<td>Y12088025</td>
												<td class="d-none d-xl-table-cell">
													<span class="badge bg-warning">In Progress</span>
												</td>
												<td class="d-none d-xl-table-cell">01/02/2023</td>
												<td class="d-none d-xl-table-cell">30/12/2025</td>
												<td class="d-none d-xl-table-cell">Y02088027</td>
												<td class="d-none d-xl-table-cell">Y00093456</td>
												<td>
													<button class="btn btn-success mb-2">Return</button>
													<button class="btn btn-info mb-2">Details</button>
												</td>
											</tr>
											<tr>
												<td>MINI DESKTOP (29)</td>
												<td>Y12088025</td>
												<td class="d-none d-xl-table-cell">
													<span class="badge bg-warning">In Progress</span>
												</td>
												<td class="d-none d-xl-table-cell">01/02/2023</td>
												<td class="d-none d-xl-table-cell">30/12/2025</td>
												<td class="d-none d-xl-table-cell">Y02088027</td>
												<td class="d-none d-xl-table-cell">Y00093456</td>
												<td>
													<button class="btn btn-success mb-2">Return</button>
													<button class="btn btn-info mb-2">Details</button>
												</td>
											</tr>
											<tr>
												<td>MINI DESKTOP (29)</td>
												<td>Y12088025</td>
												<td class="d-none d-xl-table-cell">
													<span class="badge bg-warning">In Progress</span>
												</td>
												<td class="d-none d-xl-table-cell">01/02/2023</td>
												<td class="d-none d-xl-table-cell">30/12/2025</td>
												<td class="d-none d-xl-table-cell">Y02088027</td>
												<td class="d-none d-xl-table-cell">Y00093456</td>
												<td>
													<button class="btn btn-success mb-2">Return</button>
													<button class="btn btn-info mb-2">Details</button>
												</td>
											</tr>
											<tr>
												<td>MINI DESKTOP (29)</td>
												<td>Y12088025</td>
												<td class="d-none d-xl-table-cell">
													<span class="badge bg-warning">In Progress</span>
												</td>
												<td class="d-none d-xl-table-cell">01/02/2023</td>
												<td class="d-none d-xl-table-cell">30/12/2025</td>
												<td class="d-none d-xl-table-cell">Y02088027</td>
												<td class="d-none d-xl-table-cell">Y00093456</td>
												<td>
													<button class="btn btn-success mb-2">Return</button>
													<button class="btn btn-info mb-2">Details</button>
												</td>
											</tr>
											<tr>
												<td>MINI DESKTOP (29)</td>
												<td>Y12088025</td>
												<td class="d-none d-xl-table-cell">
													<span class="badge bg-warning">In Progress</span>
												</td>
												<td class="d-none d-xl-table-cell">01/02/2023</td>
												<td class="d-none d-xl-table-cell">30/12/2025</td>
												<td class="d-none d-xl-table-cell">Y02088027</td>
												<td class="d-none d-xl-table-cell">Y00093456</td>
												<td>
													<button class="btn btn-success mb-2">Return</button>
													<button class="btn btn-info mb-2">Details</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
			</main>

		</div>
	</div>

	<script src="../../js/app.js"></script>
	<script src="../../js/index.js"></script>
</body>

</html>