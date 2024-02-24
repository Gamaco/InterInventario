<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "interloanhub";

// Connection
$connection = new mysqli($servername, $username, $password, $database);

// Initialize variables
$ptag = $gn = $description = $model = $Serial_No = $Fund = $AC = $CL = $F = $AQU = $ST = $Acquisition = $Received = $DocNo = $Amt = $Location = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	/*  FYI
        FILTER_SANITIZE_SPECIAL_CHARS is a filter constant in PHP used for sanitizing input data 
        by converting special characters to HTML entities. This is particularly useful when you want 
        to prevent cross-site scripting (XSS) attacks by ensuring that user-supplied data doesn't contain 
        characters that could be interpreted as HTML or JavaScript.

        En otras palabras, para limpiar los datos de caracteres especiales.
    */

	// Validate and sanitize user inputs
	$ptag = filter_var($_POST["ptag"], FILTER_SANITIZE_SPECIAL_CHARS);
	$gn = filter_var($_POST["gn"], FILTER_SANITIZE_SPECIAL_CHARS);
	$description = filter_var($_POST["description"], FILTER_SANITIZE_SPECIAL_CHARS);
	$model = filter_var($_POST["model"], FILTER_SANITIZE_SPECIAL_CHARS);
	$Serial_No = filter_var($_POST["Serial_No"], FILTER_SANITIZE_SPECIAL_CHARS);
	$Fund = filter_var($_POST["Fund"], FILTER_SANITIZE_SPECIAL_CHARS);
	$AC = filter_var($_POST["AC"], FILTER_SANITIZE_SPECIAL_CHARS);
	$CL = filter_var($_POST["CL"], FILTER_SANITIZE_SPECIAL_CHARS);
	$F = filter_var($_POST["F"], FILTER_SANITIZE_SPECIAL_CHARS);
	$AQU = filter_var($_POST["AQU"], FILTER_SANITIZE_SPECIAL_CHARS);
	$ST = filter_var($_POST["ST"], FILTER_SANITIZE_SPECIAL_CHARS);
	$Acquisition = filter_var($_POST["Acquisition"], FILTER_SANITIZE_SPECIAL_CHARS);
	$Received = filter_var($_POST["Received"], FILTER_SANITIZE_SPECIAL_CHARS);
	$DocNo = filter_var($_POST["DocNo"], FILTER_SANITIZE_SPECIAL_CHARS);
	$Amt = filter_var($_POST["Amt"], FILTER_SANITIZE_SPECIAL_CHARS);
	$Location = filter_var($_POST["Location"], FILTER_SANITIZE_SPECIAL_CHARS);

	do {
		if (empty($ptag)) {
			$errorMessage = "Please provide a PTag.";
			break;
		}

		// Add a new item to the database using prepared statements
		$query = "INSERT INTO inventario 
        (ptag, gn, `description`, model, Serial_No, Fund, AC, CL, F,
        AQU, ST, Acquisition, Received, DocNo, Amt, Location) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		// Prepare the statement
		$stmt = $connection->prepare($query);

		if (!$stmt) {
			$errorMessage = "Error preparing statement: " . $connection->error;
			break;
		}

		// Bind parameters
		$stmt->bind_param("ssssssssssssssss", $ptag, $gn, $description, $model, $Serial_No, $Fund, $AC, $CL, $F, $AQU, $ST, $Acquisition, $Received, $DocNo, $Amt, $Location);

		// Execute the statement
		$result = $stmt->execute();

		if (!$result) {
			$errorMessage = "Error executing statement: " . $stmt->error;
			break;
		}

		$stmt->close();
		$connection->close();

		header("location: ../inventory/index.php");
		exit;
	} while (false);
}
?>

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
	<style>
		.table-container {
			overflow-x: auto;
		}

		.modal-fullscreen {
			width: 100vw !important;
			max-width: 100% !important;
			margin: 1.75rem auto;
		}

		.modal-fullscreen .modal-dialog {
			margin: 1.75rem auto;
			max-width: none;
			width: 100%;
		}

		@media (min-width: 576px) {
			.modal-dialog {
				max-width: 100%;
				margin: 1.75rem auto;
			}
		}

		@media (min-width: 992px) {
			.modal-lg {
				max-width: 100%;
				margin: 1.75rem auto;
			}
		}
	</style>
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
				<div class="container-fluid p-0 justify-content-center">
					<div class="row">
						<div class="card mx-auto my-5 col-12 col-md-6 p-0">
							<div class="card-header bg-success w-100" style="background-color: #00973c !important;">
								<h5 class="h5 mb-0 text-white"><i>New Loan</i></h5>
							</div>
							<div class="card-body">
								<?php
								if (!empty($errorMessage)) {
									echo "
                                    <div class='container-fluid bg-danger mt-1 mb-1 bg-opacity-10'>
                                        <div class='alert text-danger alert-dismissible fs-4 fade show mb-5 d-flex justify-content-between' role='alert'>
                                        <strong> $errorMessage </strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                     </div>
                                    </div>

                                    ";
								}
								?>
								<form method="post">
									<div class="row flex-wrap">
										<div class="col-12 col-md mb-3">
											<div data-mdb-input-init class="form-outline">
												<label class="form-label" for="PTAG">PTAG</label>
												<div class="input-group mb-3">
													<button class="btn btn-primary btn-outline-secondary" type="button" id="searchInventoryBtn" data-bs-toggle="modal" data-bs-target="#inventoryList">Search</button>
													<input type="text" id="PTAG" class="form-control" placeholder="" aria-describedby="button-addon1">
												</div>
											</div>
										</div>
									</div>

									<div class="row flex-wrap">
										<div class="col-12 col-md mb-3">
											<div data-mdb-input-init class="form-outline">
												<label class="form-label" for="ptag">LOAN TO</label>
												<div data-mdb-input-init class="form-outline">
													<input type="text" name="LOAN_TO" id="LOAN_TO" class="form-control" value="<?php echo $gn; ?>" />
												</div>
											</div>
										</div>
									</div>

									<div class="row flex-wrap">
										<div class="col-12 col-md mb-3">
											<div data-mdb-input-init class="form-outline">
												<label class="form-label" for="LOANER_AUTH">LOANER AUTH</label>
												<div data-mdb-input-init class="form-outline">
													<input type="text" name="LOANER_AUTH" id="LOANER_AUTH" class="form-control" value="<?php echo $gn; ?>" />
												</div>
											</div>
										</div>
									</div>

									<div class="row flex-wrap">
										<div class="col-12 col-md mb-3">
											<div data-mdb-input-init class="form-outline">
												<label class="form-label" for="LOANER_AUTH">START DATE</label>
												<div class="mb-3">
													<input type="date" id="datepicker" class="form-control">
												</div>
											</div>
										</div>
									</div>

									<div class="row flex-wrap">
										<div class="col-12 col-md mb-3">
											<div data-mdb-input-init class="form-outline">
												<label class="form-label" for="LOANER_AUTH">END DATE</label>
												<div class="mb-3">
													<input type="date" id="datepicker" class="form-control">
												</div>
											</div>
										</div>
									</div>
									<!-- Button container with centering classes -->
									<div class="justify-content-center">
										<div class="row">
											<!-- Submit button -->
											<button type="submit" class="btn btn-success btn-lg mb-2" style="background-color: #00973c !important;">Submit</button>
										</div>
										<div class="row">
											<!-- Cancel button -->
											<a type="button" class="btn btn-light btn-lg mb-2" href="../inventory/index.php">Cancel</a>
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</main>

		</div>
		<!-- Modal -->
		<div class="modal fade" id="inventoryList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inventoryListLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="inventoryListLabel">Inventory</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
					</div>
					<div class="modal-body">
						<div class="d-flex flex-column justify-content-between align-items-start flex-wrap">
							<div class="d-flex w-100 w-sm-75 mb-2 mb-md-0">
								<input type="text" id="searchInput" class="form-control me-2" placeholder="Search e.g. Y00109987">
							</div>
							<div class="d-flex mt-4">
								<div class="dropdown-center">
									<button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #00973c !important;">
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
						</div>
						<div class="table-container">
							<table id="InventoryTable" class="table my-0 table-striped border-secondary fs-6">
								<thead>
									<tr>
										<th>Options</th>
										<th>PTag</th>
										<th>Description</th>
										<th>Serial No</th>
										<th>Model</th>
										<th>Location</th>
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
											   <th>
											   <a class='btn btn-primary mb-1' href=./edit.php?id=$equipo[id]>Select
												   </div></a>
											</th>
											   <td data-label='PTag'>$equipo[Ptag]</td>
											   <td data-label='Description'>$equipo[Description]</td>
											   <td data-label='Serial_No'>$equipo[Serial_No]</td>
											   <td data-label='Model'>$equipo[Model]</td>
											   <td data-label='Location'>$equipo[Location]</td>
                                           </tr>
                                               ";
									}

									$connection->close();
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="../../js/app.js"></script>
	<script src="../../js/inventory.js"></script>
</body>

</html>