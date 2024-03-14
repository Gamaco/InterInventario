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
	<link rel="apple-touch-icon" sizes="180x180" href="../../img/icons/app-icon-ios.png">
	<meta name="apple-mobile-web-app-title" content="Inter Loans">
	<link rel="manifest" href="../../manifest.json">

	<title>Loans | IELS</title>
	<link rel="stylesheet" , href="../../css/loans.css">
	<!-- Font Awesome CSS -->
	<link rel='stylesheet' href='../../css/font-awesome-4.7.0/css/font-awesome.min.css'>
	<!-- Bootstrap added locally -->
	<link href="../../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body draggable="false">
	<?php $activePage = 'loans';
	include '../components/sidebar.php'; ?>

	<div class="main">
		<?php include '../components/navbar.php'; ?>

		<main class="content">
			<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Active</strong> Loans</h1>

				<div class="row mb-3">
					<div class="col-md-auto mb-2 mb-md-0 d-flex align-items-center">
						<a class="btn btn-primary btn-lg fs-5 me-md-2 me-2" href="./create.php"><i class="fa fa-plus" aria-hidden="true"></i> Create Loan</a>
						<!-- Dropdown for categories -->
						<div class="dropdown-center">
							<button class="btn btn-secondary text-dark btn-lg fs-5 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								All Categories
							</button>
							<ul class="dropdown-menu" id="categoryDropdown">
								<?php
								include '../../db/config.php';

								$query = "CALL GetCategories()";
								$categories = $connection->query($query);

								// In case the query failed
								if (!$categories) {
									die("Invalid query: " . $$connection->error);
								}

								while ($category = $categories->fetch_assoc()) {
									echo "
                                    <li><a class='dropdown-item border rounded rounded-5 border-light border-1 fs-4 mb-1 mt-1 p-3'>" . $category["Category"] . "</a></li>
                                    ";
								}

								$connection->close();
								?>
							</ul>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-lg-15 col-xxl-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header">
								<div class="d-flex mt-3 mb-3">
									<div class="input-group">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
										<input type="text" id="searchInput" class="form-control fs-4 form-control-lg" placeholder="Search">
									</div>
								</div>
								<div class="col-auto text-center text-md-start">
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
									<div class="row mt-3">
										<span class="badge badge-secondary responsive-badge fs-5 p-4" id="displayedRowCount"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-lg-15 col-xxl-12 d-flex">
						<div class="card flex-fill">
							<table id="InventoryTable" class="table table-hover my-0">
								<thead>
									<tr>
										<th>NAME</th>
										<th>LOAN TO</th>
										<th>CATEGORY</th>
										<th>DESCRIPTION</th>
										<th>PTAG</th>
										<th>LOANER AUTH</th>
										<th>STATUS</th>
										<th>START DATE</th>
										<th>END DATE</th>
										<th>OPTIONS</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include '../../db/config.php';

									// Prepare the SQL statement to call the stored procedure
									$stmt = $connection->prepare("CALL GetLoanDetails()");

									// Execute the statement
									$stmt->execute();

									// Get the result set
									$prestamos = $stmt->get_result();

									// Check for errors
									if (!$prestamos) {
										die("Invalid query: " . $connection->error);
									}

									// Output the loan details
									while ($prestamo = $prestamos->fetch_assoc()) {
										$startDate = strtotime($prestamo['START_DATE']);
										$endDate = strtotime($prestamo['END_DATE']);
										$currentDate = strtotime(date("Y-m-d")); // Get current date

										// Check if the current date is past the end date or equal to it
										if ($currentDate > $endDate || ($currentDate == $endDate && date("H:i:s") >= "23:59:59")) {
											$status = "<span class='badge bg-danger'>Overdue</span>";
										} else {
											$status = "<span class='badge bg-warning'>In Progress</span>";
										}

										echo "
											<tr>
												<td data-label='Name'>" . htmlspecialchars($prestamo['LOAN_TO_NAME'] ?? 'N/A') . "</td>
												<td data-label='Loan To'>" . htmlspecialchars($prestamo['LOAN_TO'] ?? 'N/A') . "</td>
												<td data-label='Category'>" . htmlspecialchars($prestamo['LOAN_TO_AFFILIATION'] ?? 'N/A') . "</td>
												<td data-label='Description'>" . htmlspecialchars($prestamo['ItemDescription'] ?? 'N/A') . "</td>
												<td data-label='PTag'>" . htmlspecialchars($prestamo['PTag'] ?? 'N/A') . "</td>
												<td data-label='Loaner Auth'>" . htmlspecialchars($prestamo['LOANER_AUTH'] ?? 'N/A') . "</td>
												<td data-label='Status'>" . $status . "</td>
												<td data-label='Start Date'>" . htmlspecialchars($prestamo['START_DATE'] ?? 'N/A') . "</td>
												<td data-label='End Date'>" . htmlspecialchars($prestamo['END_DATE'] ?? 'N/A') . "</td>
												<td data-label='Options'>
													<a class='btn btn-primary rounded-3 btn-lg' data-bs-toggle='modal' data-bs-target='#itemReturnModal' data-item-id='" . htmlspecialchars($prestamo['PTag']) . "' data-item-description='" . htmlspecialchars($prestamo['ItemDescription']) . "'><i class='fa fa-reply-all' aria-hidden='true'></i> Return</a>
												</td>
											</tr>";
									}

									// Close the statement and connection
									$stmt->close();
									$connection->close();
									?>

								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		</main>

		<!-- Confirm Return Modal -->
		<div class="modal fade" id="itemReturnModal" tabindex="-1" aria-labelledby="itemReturnModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="itemReturnModalLabel">Confirm Return</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="submit" method="post" action="./delete.php" onsubmit="enableInputs()">
							<div class="row flex-wrap">
								<div class="col-12 col-md mb-3">
									<div data-mdb-input-init class="form-outline">
										<label class="form-label" for="PTAG">PTag</label>
										<input type="text" name="PTag" id="PTAG" class="form-control fs-4" aria-describedby="searchInput" disabled>
									</div>
								</div>
							</div>

							<div class="row flex-wrap">
								<div class="col-12 col-md mb-3">
									<div data-mdb-input-init class="form-outline">
										<label class="form-label" for="Description">Description</label>
										<input type="text" name="Description" id="Description" class="form-control fs-4" aria-describedby="Description" disabled>
									</div>
								</div>
							</div>

							<div class="row flex-wrap">
								<div class="col-12 col-md mb-3">
									<div data-mdb-input-init class="form-outline">
										<label for="Fault" class="form-label">Fault Description (Optional)</label>
										<textarea class="form-control" id="Fault" name="Fault" rows="2" maxlength="50"></textarea>
										<small class="form-text text-muted" id="charCount">0/50 characters</small>
									</div>
								</div>
							</div>

							<div class="row flex-wrap">
								<div class="col-12 col-md mb-3">
									<div data-mdb-input-init class="form-outline">
										<label class="form-label" for="Condition">Condition</label>
										<div data-mdb-input-init class="form-outline">
											<input type="hidden" id="condition" name="condition" value="Good">
											<div class="dropdown-center mb-3">
												<button id="conditionDropdownButton" class="btn btn-primary btn-lg dropdown-toggle mb-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
													Good
												</button>
												<div class="dropdown-center">
												<ul class="dropdown-menu" id="conditionDropdownMenu">
													<li><a class='dropdown-item border rounded rounded-5 border-light border-1 fs-4 mb-1 mt-1 p-3'>Good</a></li>
													<li><a class='dropdown-item border rounded rounded-5 border-light border-1 fs-4 mb-1 mt-1 p-3'>Damaged</a></li>
													<li><a class='dropdown-item border rounded rounded-5 border-light border-1 fs-4 mb-1 mt-1 p-3'>Incomplete</a></li>
												</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-secondary text-dark btn-lg" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary btn-lg" id="confirmDeleteBtn">Confirm</button>
							</div>
						</form>

					</div>
				</div>
			</div>

		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="../../js/loans-index.js"></script>
	<script src="../../js/app.js"></script>
	<script src="../../js/inventory.js"></script>

</body>

</html>