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
	<?php $activePage = 'loans'; include '../components/sidebar.php'; ?>

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
												<input type="text" id="searchInput" class="form-control" placeholder="Search">
											</div>
										</div>
										<div class="col-auto text-center text-md-start">
											<a class="btn btn-primary mb-2" href="./create.php">Create New Loan
											</a></td>
										</div>
									</div>
									<table id="dataTable" class="table table-hover my-0">
										<thead>
											<tr>
												<th>DESCRIPTION</th>
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

                                            // Query searches for the item description in the inventario table.
                                            $query = "SELECT prestamos.*, inventario.Description AS ItemDescription
                                            FROM prestamos
                                            LEFT JOIN inventario ON prestamos.Ptag = inventario.Ptag
                                            ORDER BY prestamos.id DESC";

                                            $prestamos = $connection->query($query);

                                            // In case the query failed
                                            if (!$prestamos) {
                                                die("Invalid query: " . $$connection->error);
                                            }

											while ($prestamo = $prestamos->fetch_assoc()) {
                                                echo "
											<tr>
												<td data-label='Description'>" . ($prestamo['ItemDescription'] ? $prestamo['ItemDescription'] : 'N/A') . "</td>
												<td data-label='Loan To'>" . ($prestamo['LOAN_TO'] ? $prestamo['LOAN_TO'] : 'N/A') . "</td>
												<td data-label='Loaner Auth'>" . ($prestamo['LOANER_AUTH'] ? $prestamo['LOANER_AUTH'] : 'N/A') . "</td>
												<td data-label='PTag'>" . ($prestamo['PTag'] ? $prestamo['PTag'] : 'N/A') . "</td>
												<td data-label='Status'>
												<span class='badge bg-warning'>In Progress</span>
												</td>
												<td data-label='Start Date'>" . ($prestamo['START_DATE'] ? $prestamo['START_DATE'] : 'N/A') . "</td>
												<td data-label='End Date'>" . ($prestamo['END_DATE'] ? $prestamo['END_DATE'] : 'N/A') . "</td>
												<td data-label='Options'>
													<button class='btn btn-success mb-2'>Return</button>
												</td>
											</tr>
											";
											}

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