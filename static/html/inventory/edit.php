<?php include '../components/userSessionValidation.php'; ?>

<?php
include '../../db/config.php';

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: ../components/error_404.php");
        exit;
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    // Check if $id is valid
    if ($id === false || $id === null) {
        header("location: ../components/error_404.php");
        exit;
    }

    // Call the stored procedure to fetch an item by ID
    $query = "CALL GetItemById(?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    $stmt->close();

    if (!$item) {
        header("location: ../components/error_404.php");
        exit;
    }

    $gn = $item["gn"];
    $description = $item["Description"];
    $model = $item["Model"];
    $Serial_No = $item["Serial_No"];
    $Fund = $item["Fund"];
    $AC = $item["AC"];
    $CL = $item["CL"];
    $F = $item["F"];
    $AQU = $item["AQU"];
    $ST = $item["ST"];
    $Acquisition = $item["Acquisition"];
    $Received = $item["Received"];
    $DocNo = $item["DocNo"];
    $Amt = $item["Amt"];
    $Location = $item["Location"];
} else {
    // Validate and sanitize user inputs
    $id = filter_var($_POST["id"], FILTER_SANITIZE_SPECIAL_CHARS);
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
        // Call the stored procedure to update an item
        $query = "CALL UpdateItem(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);

        if (!$stmt) {
            $errorMessage = "Error preparing statement: " . $connection->error;
            break;
        }

        // Bind parameters
        $stmt->bind_param("sssssssssssssssi", $gn, $description, $model, $Serial_No, $Fund, $AC, $CL, $F, $AQU, $ST, $Acquisition, $Received, $DocNo, $Amt, $Location, $id);

        // Execute the statement
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Invalid Input: <br>" . $stmt->error;
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
    <link rel="apple-touch-icon" sizes="180x180" href="../../img/icons/app-icon-ios.png">
    <meta name="apple-mobile-web-app-title" content="Inter Loans">
    <link rel="manifest" href="../../manifest.json">

    <title>Edit - IELS</title>
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
    <?php $activePage = 'inventory';
    include '../components/sidebar.php'; ?>

    <div class="main">
        <?php include '../components/navbar.php'; ?>

        <main class="content">
            <div class="container-fluid p-0 justify-content-center">
                <div class="row">
                    <div class="card mx-auto my-5 col-12 col-md-6 p-0">
                        <div class="card-header bg-success w-100" style="background-color: #00973c !important;">
                            <h5 class="h5 mb-0 text-white"><i>Edit Item</i></h5>
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
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="description" id="description" class="form-control" value="<?php echo $description; ?>" />
                                            <label class="form-label" for="description">Description</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="gn" id="gn" class="form-control" value="<?php echo $gn; ?>" />
                                            <label class="form-label" for="gn">GN</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="model" id="model" class="form-control" value="<?php echo $model; ?>" />
                                            <label class="form-label" for="model">Model</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="Serial_No" id="Serial_No" class="form-control" value="<?php echo $Serial_No; ?>" />
                                            <label class="form-label" for="Serial_No">Serial No</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="Fund" id="Fund" class="form-control" value="<?php echo $Fund; ?>" />
                                            <label class="form-label" for="model">Fund</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="AC" id="AC" class="form-control" value="<?php echo $AC ?>" />
                                            <label class="form-label" for="AC">AC</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="CL" id="CL" class="form-control" value="<?php echo $CL; ?>" />
                                            <label class="form-label" for="CL">CL</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="F" id="F" class="form-control" value="<?php echo $F; ?>" />
                                            <label class="form-label" for="F">F</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="AQU" id="AQU" class="form-control" value="<?php echo $AQU; ?>" />
                                            <label class="form-label" for="AQU">AQU</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="ST" id="ST" class="form-control" value="<?php echo $ST; ?>" />
                                            <label class="form-label" for="ST">ST</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="Acquisition" id="Acquisition" class="form-control" value="<?php echo $Acquisition; ?>" />
                                            <label class="form-label" for="Acquisition">Acquisition</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="Received" id="Received" class="form-control" value="<?php echo $Received; ?>" />
                                            <label class="form-label" for="Received">Received</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="DocNo" id="DocNo" class="form-control" value="<?php echo $DocNo; ?>" />
                                            <label class="form-label" for="DocNo">Doc No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="Amt" id="Amt" class="form-control" value="<?php echo $Amt; ?>" />
                                            <label class="form-label" for="Amt">Amt</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="Location" id="Location" class="form-control" value="<?php echo $Location; ?>" />
                                            <label class="form-label" for="Location">Location</label>
                                        </div>
                                    </div>
                                </div>


                                <!-- Button container with centering classes -->
                                <div class="justify-content-center">
                                    <div class="row">
                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-primary btn-lg mb-2">Submit</button>
                                    </div>
                                    <div class="row">
                                        <!-- Cancel button -->
                                        <a type="button" class="btn btn-light btn-lg mb-2" href="index.php">Cancel</a>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
    </div>

    <script src="../../js/app.js"></script>
</body>

</html>