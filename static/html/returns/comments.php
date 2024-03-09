

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

    <title>Comments | IELS</title>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='../../css/font-awesome-4.7.0/css/font-awesome.min.css'>
    <!-- Bootstrap added locally -->
    <link href="../../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        .table-container {
            overflow-x: auto;
        }
    </style>
</head>

<body draggable="false">
    <?php $activePage = 'returns';
    include '../components/sidebar.php'; ?>

    <div class="main">
        <?php include '../components/navbar.php'; ?>

        <main class="content">
            <div class="container-fluid p-0 justify-content-center">
                <div class="container my-1 py-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <div class="card text-dark">
                                <div class="card-body p-4">
                                    <div class="card-header bg-success mb-3 w-100" style="background-color: #00973c !important;">
                                        <h5 class="h5 mb-0 text-white">ewgawrtegreherfagrytergefrgwtyrhtegrwferhyrtgefwrg</h5>
                                    </div>

                                    <div class="col-12 col-md mb-3">
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="comments" class="form-label">New Comments</label>
                                            <textarea class="form-control" id="comments" name="Comments" rows="3" maxlength="80"></textarea>
                                            <a id="Close" class="btn btn-secondary text-dark btn-lg mt-2" type="button" href="./index.php">Close</a>
                                            <a id="NewCommentBtn" class="btn btn-primary btn-lg mt-2" type="submit" href='./edit.php?id=$equipo[id]'>Add Comments</a>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-0" />
                                <?php
                                include '../../db/config.php';

                                // Prepare the SQL statement to call the stored procedure
                                $stmt = $connection->prepare("CALL GetAllComments()");

                                // Execute the statement
                                $stmt->execute();

                                // Get the result set
                                $Comments = $stmt->get_result();

                                // Check for errors
                                if (!$Comments) {
                                    die("Invalid query: " . $connection->error);
                                }

                                // Output the loan details
                                while ($Comment = $Comments->fetch_assoc()) {
                                    $Cmt = $Comment['comment'];
                                    $Date = $Comment['date'];

                                    echo "
                                    <div class='card-body p-4'>
                                        <div class='d-flex flex-start'>
                                            <div>
                                                <div class='d-flex align-items-center mb-3'>
                                                    <p class='mb-0 fw-bold'>
                                                        $Date
                                                    </p>
                                                </div>
                                                $Cmt
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class='my-0' style='height: 1px;' />
                                ";
                                }

                                // Close the statement and connection
                                $stmt->close();
                                $connection->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="../../js/app.js"></script>
</body>

</html>