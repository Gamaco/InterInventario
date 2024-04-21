<?php include '../components/userSessionValidation.php'; ?>

<?php
include '../../db/config.php';

// Initialize variables
$Ptag = $LOAN_TO = $LOANER_AUTH = $START_DATE = $END_DATE = $NAME = $AFFILIATION = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Validate and sanitize user inputs
	$Ptag = filter_var($_POST["Ptag"], FILTER_SANITIZE_SPECIAL_CHARS);
	$LOAN_TO = filter_var($_POST["LOAN_TO"], FILTER_SANITIZE_SPECIAL_CHARS);
	$LOANER_AUTH = filter_var($_POST["LOANER_AUTH"], FILTER_SANITIZE_SPECIAL_CHARS);
	$START_DATE = filter_var($_POST["START_DATE"], FILTER_SANITIZE_SPECIAL_CHARS);
	$END_DATE = filter_var($_POST["END_DATE"], FILTER_SANITIZE_SPECIAL_CHARS);
	$NAME = filter_var($_POST["LOAN_TO_NAME"], FILTER_SANITIZE_SPECIAL_CHARS);
	$AFFILIATION = filter_var($_POST["AFFILIATION"], FILTER_SANITIZE_SPECIAL_CHARS);

	do {
		if (empty($Ptag)) {
			$errorMessage = "Missing 'PTag'.";
			break;
		}
		if (empty($LOAN_TO)) {
			$errorMessage = "Missing 'LOAN TO'.";
			break;
		}
		if (empty($LOANER_AUTH)) {
			$errorMessage = "Missing 'LOANER AUTH'.";
			break;
		}
		if (empty($START_DATE)) {
			$errorMessage = "Missing 'START DATE'.";
			break;
		}
		if (empty($END_DATE)) {
			$errorMessage = "Missing 'END DATE'.";
			break;
		}
		if (empty($NAME)) {
			$errorMessage = "Missing 'Name'.";
			break;
		}

		// Call the stored procedure to insert loan data
		$query = "CALL InsertLoan(?, ?, ?, ?, ?, ?, ?)";

		// Prepare the statement
		$stmt = $connection->prepare($query);

		if (!$stmt) {
			$errorMessage = "Error preparing statement: " . $connection->error;
			break;
		}

		// Bind parameters
		$stmt->bind_param("sssssss", $Ptag, $LOAN_TO, $LOANER_AUTH, $START_DATE, $END_DATE, $NAME, $AFFILIATION);

		// Execute the statement
		$result = $stmt->execute();

		if (!$result) {
			$errorMessage = "Error executing statement: " . $stmt->error;
			break;
		}

		$stmt->close();
		$connection->close();

		header("location: ../loans/index.php");
		exit;
	} while (false);
} else {
	// GET Method - the user is accessing the page from a scanned QR code
	if (isset($_GET["id"])) {
		// Sanitize the input
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

		// Check if $id is valid
		if ($id === false || $id === null) {
			// Handle invalid input (e.g., display an error message, redirect the user, etc.)
			header("location: ../components/error_404.php");
			exit;
		}

		// Call the stored procedure to get the item based on the ID
		$query = "CALL GetAvailableItemById(?)";

		// Prepare the statement
		$stmt = $connection->prepare($query);

		if (!$stmt) {
			$errorMessage = "Error preparing statement: " . $connection->error;
		} else {
			// Bind parameters
			$stmt->bind_param("i", $id);

			// Execute the statement
			$result = $stmt->execute();

			if (!$result) {
				$errorMessage = "Error executing statement: " . $stmt->error;
			} else {
				// Fetch the result set as an associative array
				$item = $stmt->get_result()->fetch_assoc();

				if ($item) {
					$Ptag = $item['Ptag'];
				} else {
					//$errorMessage = "Couldn't find the item you were looking for. ";
				}
			}

			// Close statement
			$stmt->close();
		}

		// Close connection
		$connection->close();
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no">
	<meta name="description" content="Sistema de Inventario">
	<meta name="author" content="Inter Bayamon">
	<meta name="keywords" content="Inter Bayamon, Inventario, Sistema de Inventario, Universidad Interamericana, Bayamon, Inventario de Equipos">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="../../img/icons/interlogo3.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="../../img/icons/app-icon-ios.png">
	<meta name="apple-mobile-web-app-title" content="Inter Loans">
	<link rel="manifest" href="../../manifest.json">

	<title>Create | IRLS</title>
	<!-- Custom CSS specifically for this page -->
	<link rel="stylesheet" , href="../../css/inventory.css">
	<link rel="stylesheet" , href="../../css/loans-create.css">
	<!-- Bootstrap added locally -->
	<link href="../../css/app.css" rel="stylesheet">
	<!-- Google font & icons -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@250" rel="stylesheet" />
</head>

<body draggable="false">
	<?php $activePage = 'loans';
	include '../components/sidebar.php'; ?>

	<div class="main">
		<?php include '../components/navbar.php'; ?>

		<main class="content">
			<div class="container-fluid p-0 justify-content-center">
				<div class="row m-1">
					<div class="card mx-auto my-5 col-12 col-md-9 p-0">
						<div class="card-header bg-success w-100" style="background-color: #00973c !important;">
							<h5 class="h5 mb-0 text-white"><i class="material-symbols-outlined" style='vertical-align: middle;'>edit_calendar</i> New Loan</i></h5>
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
							<form id="submit" method="post" onsubmit="return validateLoanCreationInputs()">
								<div class="row flex-wrap">
									<div class="col-12 col-md mb-3">
										<div data-mdb-input-init class="form-outline">
											<label class="form-label" for="PTAG">PTag <i class="text-danger">*</i></label>
											<div class="input-group">
												<?php

												?>
												<button class="btn btn-primary btn-lg btn-outline-primary" type="button" id="searchInventoryBtn" data-bs-toggle="modal" data-bs-target="#inventoryList">Search</button>
												<input type="text" name="Ptag" id="PTAG" class="form-control fs-4 form-control-lg p-2" aria-describedby="searchInput" value="<?php echo $Ptag; ?>" disabled>
											</div>
										</div>
									</div>
								</div>

								<hr>

								<div class="row flex-wrap">
									<div class="col-12 col-md mb-3">
										<div data-mdb-input-init class="form-outline">
											<label class="form-label" for="LOAN_TO">Loan To <i class="text-danger">*</i></label>
											<div data-mdb-input-init class="form-outline">
												<input type="text" name="LOAN_TO" id="LOAN_TO" class="form-control fs-4 form-control-lg" placeholder="e.g. Y00561278" value="<?php echo htmlspecialchars($LOAN_TO); ?>" required />
											</div>
										</div>
									</div>
								</div>

								<div class="row flex-wrap">
									<div class="col-12 col-md mb-3">
										<div data-mdb-input-init class="form-outline">
											<label class="form-label" for="LOAN_TO">Name <i class="text-danger">*</i></label>
											<div data-mdb-input-init class="form-outline">
												<input type="text" name="LOAN_TO_NAME" id="LOAN_TO_NAME" class="form-control fs-4 form-control-lg" placeholder="e.g. John Doe" value="<?php echo htmlspecialchars($NAME); ?>" required />
											</div>
										</div>
									</div>
								</div>

								<div class="row flex-wrap">
									<div class="col-12 col-md mb-3">
										<div data-mdb-input-init class="form-outline">
											<label class="form-label" for="LOAN_TO">Category <i class="text-danger">*</i></label>
											<div data-mdb-input-init class="form-outline">
												<input type="hidden" id="AFFILIATION" name="AFFILIATION" value="Student" />
												<div class="dropdown-center">
													<button class="btn btn-secondary text-dark dropdown-toggle btn-lg" id="AffiliationButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														Student
													</button>
													<ul class="dropdown-menu" id="affiliationDropdown">
														<li><a class='dropdown-item'>Student</a></li>
														<li><a class='dropdown-item'>Faculty Member</a></li>
														<li><a class='dropdown-item'>Non-faculty staff</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>

								<hr>

								<div class="row flex-wrap">
									<div class="col-12 col-md mb-3">
										<div data-mdb-input-init class="form-outline">
											<label class="form-label" for="LOANER_AUTH">Loaner Auth <i class="text-danger">*</i></label>
											<div data-mdb-input-init class="form-outline">
												<input type="text" name="LOANER_AUTH" id="LOANER_AUTH" class="form-control fs-4 form-control-lg" value="<?php echo htmlspecialchars($LOANER_AUTH); ?>" required />
											</div>
										</div>
									</div>
								</div>

								<div class="row flex-wrap">
									<div class="col-12 col-md mb-3">
										<div data-mdb-input-init class="form-outline">
											<label class="form-label" for="START_DATE">Start Date <i class="text-danger">*</i></label>
												<input type="date" name="START_DATE" id="START_DATE" class="form-control fs-4 form-control-lg" value="<?php echo htmlspecialchars($START_DATE); ?>" required>
										</div>
									</div>
								</div>

								<div class="row flex-wrap">
									<div class="col-12 col-md mb-3">
										<div data-mdb-input-init class="form-outline">
											<label class="form-label" for="END_DATE">End Date <i class="text-danger">*</i></label>
											<div class="mb-3">
												<input type="date" name="END_DATE" id="END_DATE" class="form-control fs-4 form-control-lg" value="<?php echo htmlspecialchars($END_DATE); ?>" required>
											</div>
										</div>
									</div>
								</div>

								<!-- Button container with centering classes -->
								<div class="justify-content-center">
									<div class="row">
										<!-- Submit button -->
										<button type="submit" class="btn btn-primary text-white btn-lg mb-2">Submit</button>
									</div>
									<div class="row">
										<!-- Cancel button -->
										<a type="button" class="btn btn-light btn-lg mb-2" href="../loans/index.php">Cancel</a>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</main>

	</div>
	<!-- Inventory Modal -->
	<div class="modal fade" id="inventoryList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inventoryListLabel" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="inventoryListLabel">Inventory</h1>
					<button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal" aria-label="Close"><b>X</b></button>
				</div>
				<div class="modal-body">
					<div class="d-flex flex-column justify-content-between align-items-center flex-wrap">
						<div class="d-flex w-100 w-sm-75 mb-2 mb-md-0">
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="material-symbols-outlined">search</i></span>
								<input type="text" id="searchInput" class="form-control fs-4 form-control-lg p-2" placeholder="Search">
							</div>
						</div>
						<div class="d-flex mt-4 justify-content-center">
							<div class="dropdown-center mb-3">
								<button class="btn btn-secondary text-dark btn-lg dropdown-toggle mb-2" id="CategoriesButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Categories
								</button>
								<ul class="dropdown-menu" id="categoryDropdown">
									<li class="disabled"><a class="dropdown-header disabled">Categories | Scroll Down</a></li>
									<hr class="mt-0 mb-2">
									<?php
									include '../../db/config.php';

									$query = "CALL GetCategories()"; // Calling the stored procedure to fetch categories

									$stmt = $connection->prepare($query);

									if (!$stmt) {
										die("Error preparing statement: " . $connection->error);
									}

									$result = $stmt->execute();

									if (!$result) {
										die("Error executing statement: " . $stmt->error);
									}

									$stmt->bind_result($id, $category);

									while ($stmt->fetch()) {
										echo "<li><a class='dropdown-item border rounded rounded-5 border-light border-1 fs-4 mb-1 mt-1 p-3'>" . $category . "</a></li>";
									}

									$stmt->close();
									$connection->close();
									?>
								</ul>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-lg-14 col-xxl-12 d-flex">
								<span class="badge badge-secondary fs-5 p-4 mb-3 responsive-badge" id="displayedRowCount"></span>
							</div>
						</div>
					</div>

					<div class="table-container">
						<table id="InventoryTable" class="table my-0 border-secondary fs-6">
							<thead>
								<tr>
									<th>Description</th>
									<th>PTag</th>
									<th>Serial No</th>
									<th>Model</th>
									<th>Location</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
								<?php
								include '../../db/config.php';

								// Call the stored procedure to fetch available inventory items
								$query = "CALL GetAvailableInventory()";
								$equipos = $connection->query($query);

								// In case the query failed
								if (!$equipos) {
									die("Invalid query: " . $connection->error);
								}

								// Read data
								while ($equipo = $equipos->fetch_assoc()) {
									echo "
										<tr>
											<td data-label='Description'>" . ($equipo['Description'] ? $equipo['Description'] : 'N/A') . "</td>
											<td data-label='PTag'>" . ($equipo['Ptag'] ? $equipo['Ptag'] : 'N/A') . "</td>
											<td data-label='Serial_No'>" . ($equipo['Serial_No'] ? $equipo['Serial_No'] : 'N/A') . "</td>
											<td data-label='Model'>" . ($equipo['Model'] ? $equipo['Model'] : 'N/A') . "</td>
											<td data-label='Location'>" . ($equipo['Location'] ? $equipo['Location'] : 'N/A') . "</td>
											<td>
												<a class='btn btn-primary btn-lg mb-1' onclick='getPTagFromModal(\"" . $equipo['Ptag'] . "\")'>Select</a>
											</td>
										</tr>";
								}

								$connection->close();
								?>

							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-lg text-dark" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="../../js/app.js"></script>
	<script src="../../js/inventory.js"></script>
	<script src="../../js/loans-create.js"></script>

</body>

</html>