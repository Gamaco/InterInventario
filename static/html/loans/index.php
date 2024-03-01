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

	<title>Index - IELS</title>
	<link rel="stylesheet" , href="../../css/inventory.css">
	<!-- Font Awesome CSS -->
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
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

				<div class="row">
					<div class="col-12 col-lg-15 col-xxl-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header">
								<div class="d-flex mt-3 mb-3">
									<div class="input-group">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
										<input type="text" id="searchInput" class="form-control fs-4" placeholder="Search">
									</div>
								</div>
								<div class="col-auto text-center text-md-start">
									<div class="d-flex mt-4">
										<a class="btn btn-primary btn-lg me-2" href="./create.php"><i class="fa fa-plus" aria-hidden="true"></i> Create Loan</a></td>
										<!-- Dropdown for categories -->
										<div class="dropdown-center">
											<button class="btn btn-success btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #00973c;">
												Categories
											</button>
											<ul class="dropdown-menu" id="categoryDropdown">
												<?php
												include '../../db/config.php';

												$query = "SELECT * FROM categories";
												$categories = $connection->query($query);

												// In case the query failed
												if (!$categories) {
													die("Invalid query: " . $$connection->error);
												}

												while ($category = $categories->fetch_assoc()) {
													echo "
                                                        <li><a class='dropdown-item'>" . $category["Category"] . "</a></li>
                                                ";
												}

												$connection->close();
												?>
											</ul>
										</div>
									</div>
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
							<table id="InventoryTable" class="table table-hover my-0">
								<thead>
									<tr>
										<th>Description</th>
										<th>LOAN TO</th>
										<th>LOANER AUTH</th>
										<th>PTAG</th>
										<th>STATUS</th>
										<th>START DATE</th>
										<th>END DATE</th>
										<th>OPTIONS</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include '../../db/config.php';

									// Query to fetch loan details with item description
									$query = "SELECT prestamos.*, inventario.Description AS ItemDescription
          							FROM prestamos
          							LEFT JOIN inventario ON prestamos.Ptag = inventario.Ptag
          							ORDER BY prestamos.id DESC";

									// Prepare the SQL statement
									$stmt = $connection->prepare($query);

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
            								<td data-label='Description'>" . htmlspecialchars($prestamo['ItemDescription'] ?? 'N/A') . "</td>
            								<td data-label='Loan To'>" . htmlspecialchars($prestamo['LOAN_TO'] ?? 'N/A') . "</td>
            								<td data-label='Loaner Auth'>" . htmlspecialchars($prestamo['LOANER_AUTH'] ?? 'N/A') . "</td>
            								<td data-label='PTag'>" . htmlspecialchars($prestamo['PTag'] ?? 'N/A') . "</td>
           								    <td data-label='Status'>" . $status . "</td>
            								<td data-label='Start Date'>" . htmlspecialchars($prestamo['START_DATE'] ?? 'N/A') . "</td>
            								<td data-label='End Date'>" . htmlspecialchars($prestamo['END_DATE'] ?? 'N/A') . "</td>
            								<td data-label='Options'>
                								<a class='btn btn-primary rounded-3 btn-lg' style='width: 80px;' data-bs-toggle='modal' data-bs-target='#itemReturnModal' data-item-id='" . htmlspecialchars($prestamo['PTag']) . "' data-item-description='" . htmlspecialchars($prestamo['ItemDescription']) . "'>Return</a>
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

		<!-- Modal -->
		<div class="modal fade" id="itemReturnModal" tabindex="-1" aria-labelledby="itemReturnModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="itemReturnModalLabel">Confirm Return</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="submit" method="post" action="./delete.php">
							<div class="row flex-wrap">
								<div class="col-12 col-md mb-3">
									<div data-mdb-input-init class="form-outline">
										<label class="form-label" for="PTAG">PTag</label>
										<input type="text" name="PTag" id="PTAG" class="form-control fs-4" aria-describedby="searchInput">
									</div>
								</div>
							</div>

							<div class="row flex-wrap">
								<div class="col-12 col-md mb-3">
									<div data-mdb-input-init class="form-outline">
										<label class="form-label" for="Description">Description</label>
										<input type="text" name="Description" id="Description" class="form-control fs-4" aria-describedby="Description">
									</div>
								</div>
							</div>

							<div class="row flex-wrap">
								<div class="col-12 col-md mb-3">
									<div data-mdb-input-init class="form-outline">
										<label for="comments" class="form-label">Comments</label>
										<textarea class="form-control" id="comments" name="Comments" rows="3"></textarea>
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
												<ul class="dropdown-menu" id="conditionDropdownMenu">
													<li><a class='dropdown-item'>Good</a></li>
													<li><a class='dropdown-item'>Damaged</a></li>
													<li><a class='dropdown-item'>Incomplete</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-success" id="confirmDeleteBtn">Confirm</button>
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