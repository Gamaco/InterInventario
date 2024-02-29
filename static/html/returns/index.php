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
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
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

				<h1 class="h3 mb-3"><strong>Returned</strong> Item Reviews</h1>

				<div class="row">
					<div class="col-12 col-lg-15 col-xxl-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header">
								<div class="col-auto text-center text-md-start">
									<div class="d-flex mt-3">
										<div class="input-group mb-3">
											<input type="text" id="searchInput" class="form-control fs-4" placeholder="Search">
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
										<th>Comments</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include '../../db/config.php';

									// Prepare the SQL statement
									$query = "SELECT * FROM returns ORDER BY id DESC";
									$statement = $connection->prepare($query);

									// Execute the statement
									$statement->execute();

									// Get the result set
									$equipos = $statement->get_result();

									// Check for errors
									if (!$equipos) {
										die("Invalid query: " . $connection->error);
									}

									// Output the results
									while ($equipo = $equipos->fetch_assoc()) {
										echo "
        									<tr>
            								<td data-label='Description'>" . htmlspecialchars($equipo['Description'] ?? 'N/A') . "</td>
            								<td data-label='PTag'>" . htmlspecialchars($equipo['PTag'] ?? 'N/A') . "</td>
            								<td data-label='Condition'>" . htmlspecialchars($equipo['Item_Cond'] ?? 'N/A') . "</td>
            								<td data-label='Comments'>" . htmlspecialchars($equipo['Comments'] ?? 'N/A') . "</td>
            								<td>
                							<a class='btn btn-primary btn-lg' data-bs-toggle='modal' data-bs-target='#itemCompletionModal' data-item-id='" . htmlspecialchars($equipo['id']) . "'>Complete</a>
            								</td>
        									</tr>";
									}

									// Close the connection
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