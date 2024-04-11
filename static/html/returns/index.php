<?php include '../components/userSessionValidation.php'; ?>

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

	<title>Returns | IRLS</title>
	<link rel="stylesheet" , href="../../css/inventory.css">
	<!-- Bootstrap added locally -->
	<link href="../../css/app.css" rel="stylesheet">
	<!-- Google font & icons -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@250" rel="stylesheet" />
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
						<div class="card flex-fill border">
							<div class="card-header">
								<div class="col-auto text-center text-md-start">
									<div class="d-flex mt-3">
										<div class="input-group">
											<span class="input-group-text" id="basic-addon1"><i class="material-symbols-outlined">search</i></span>
											<input type="text" id="searchInput" class="form-control fs-4 form-control-lg p-2" placeholder="Search">
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
										<th>Fault</th>
										<th>Comments</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include '../../db/config.php';

									// Prepare the query to retrieve return records along with comment counts
									$query = "SELECT r.*, COUNT(c.id) AS total_comments
									FROM returns r
									LEFT JOIN comments c ON r.id = c.returned_id
									GROUP BY r.id";
									$statement = $connection->prepare($query);
									$statement->execute();
									$equipos = $statement->get_result();

									// Check if the query was successful
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

										// Output table row with badge
										echo "
											<tr>
												<td data-label='Description'>" . htmlspecialchars($equipo['Description'] ?? 'N/A') . "</td>
												<td data-label='PTag'>" . htmlspecialchars($equipo['PTag'] ?? 'N/A') . "</td>
												<td data-label='Condition'>" . $status . "</td>
												<td data-label='Fault'>" . htmlspecialchars($equipo['Fault'] ?? 'N/A') . "</td>
												<td data-label='Comments'> 
													<a href='./comments.php?id=" . htmlspecialchars($equipo['id']) . "'><span class='material-symbols-outlined' style='vertical-align: middle;'>chat</span> View Comments</a> <span class='badge bg-danger rounded-pill'>" . htmlspecialchars($equipo['total_comments']) . "</span> 
												</td>
												<td>
													<a class='btn btn-light mt-1 mb-lg-1 rounded-3 btn-lg' href='./edit.php?id=" . htmlspecialchars($equipo['id']) . "'>Edit</a>
													<a class='btn btn-primary mt-1 mb-lg-1 rounded-3 btn-lg' href='delete.php?id=" . htmlspecialchars($equipo['id']) . "'>Complete</a>
												</td>							
											</tr>";
									}

									// Close the statement and connection
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