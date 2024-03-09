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

	<title>Returns - IELS</title>
	<link rel="stylesheet" , href="../../css/inventory.css">
	<!-- Font Awesome CSS -->
	<link rel='stylesheet' href='../../css/font-awesome-4.7.0/css/font-awesome.min.css'>
	<!-- Bootstrap added locally -->
	<link href="../../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body draggable="false">
	<?php $activePage = 'returns';
	include '../components/sidebar.php'; ?>

	<div class="main">
		<?php include '../components/navbar.php'; ?>

		<main class="content">
			<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Equipment</strong> returned and awaiting review</h1>

				<div class="row">
					<div class="col-12 col-lg-15 col-xxl-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header">
								<div class="col-auto text-center text-md-start">
									<div class="d-flex mt-3">
										<div class="input-group">
											<span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
											<input type="text" id="searchInput" class="form-control fs-4 form-control-lg" placeholder="Search">
										</div>
									</div>
								</div>
							</div>
							<table id="dataTable" class="table table-hover my-0">
								<thead>
									<tr>
										<th>Description</th>
										<th>PTag</th>
										<th>Condition</th>
										<th>Issue</th>
										<th>Comments</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include '../../db/config.php';

									// Call the stored procedure to retrieve return records
									$query = "CALL GetReturns()";
									$statement = $connection->prepare($query);
									$statement->execute();
									$equipos = $statement->get_result();

									if (!$equipos) {
										die("Invalid query: " . $connection->error);
									}

									// Output the results
									while ($equipo = $equipos->fetch_assoc()) {
										// Calculate status based on condition
										$status = '';
										if ($equipo['Item_Cond'] === 'Damaged') {
											$status = "<span class='badge bg-danger'>Damaged</span>";
										} else if ($equipo['Item_Cond'] === 'Incomplete') {
											$status = "<span class='badge bg-warning'>Incomplete</span>";
										} else if ($equipo['Item_Cond'] === 'In Progress') {
											$status = "<span class='badge bg-success'>In Progress</span>";
										}

										// 

										// Output table row with badge
										echo "
											<tr>
												<td data-label='Description'>" . htmlspecialchars($equipo['Description'] ?? 'N/A') . "</td>
												<td data-label='PTag'>" . htmlspecialchars($equipo['PTag'] ?? 'N/A') . "</td>
												<td data-label='Condition'>" . $status . "</td>
												<td data-label='Issue'>". htmlspecialchars($equipo['Comments'] ?? 'N/A') . "</td>
												<td data-label='Comments'> <a href='https://fontawesome.com/v4/icons/'> View Comments </a> <span class='badge bg-primary rounded-pill'>14</span> </td>
												<td>
												<a class='btn btn-secondary text-dark mt-1 mb-lg-1 rounded-3 btn-lg' href='./edit.php?id=$equipo[id]'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</a>
												<a class='btn btn-primary mt-1 mb-lg-1 rounded-3 btn-lg' href='delete.php?id=" . htmlspecialchars($equipo['id']) . "'><i class='fa fa-check' aria-hidden='true'></i> Complete</a>
												</td>							
											</tr>";
									}

									// Close the statement
									$statement->close();
									$connection->close();
									?>

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