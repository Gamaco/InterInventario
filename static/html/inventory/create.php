<?php include '../components/userSessionValidation.php'; ?>

<?php
include '../../db/config.php';

// Initialize variables
$gn = $description = $model = $Serial_No = $Fund = $AC = $CL = $F = $AQU = $ST = $Acquisition = $Received = $DocNo = $Amt = $Location = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate and sanitize user inputs
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
        if (empty($description)) {
            $errorMessage = "Please provide a description.";
            break;
        }
        if (empty($model)) {
            $errorMessage = "Please provide the model.";
            break;
        }
        if (empty($Serial_No)) {
            $errorMessage = "Please provide the serial no.";
            break;
        }
        if (empty($Location)) {
            $errorMessage = "Please provide a location.";
            break;
        }

        // Call the stored procedure for inserting data
        $query = "CALL InsertInventory(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $connection->prepare($query);

        if (!$stmt) {
            $errorMessage = "Error preparing statement: " . $connection->error;
            break;
        }

        // Bind parameters
        $stmt->bind_param("sssssssssssssss", $gn, $description, $model, $Serial_No, $Fund, $AC, $CL, $F, $AQU, $ST, $Acquisition, $Received, $DocNo, $Amt, $Location);

        // Execute the statement
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Error executing statement: " . $stmt->error;
            break;
        }

        $stmt->close();
        $connection->close();

        header("location: ../inventory/available.php");
        exit;
    } while (false);
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
    <meta name="keywords" content="Inter Bayamon, Inventario, Sistema de Inventario, admin, Universidad Interamericana, Bayamon, Inventario de Equipos">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../../img/icons/interlogo3.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="../../img/icons/app-icon-ios.png">
    <meta name="apple-mobile-web-app-title" content="Inter Loans">
    <link rel="manifest" href="../../manifest.json">

    <title>Create | IRLS</title>
    <!-- Bootstrap added locally -->
    <link href="../../css/app.css" rel="stylesheet">
    <!-- Google font & icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@250" rel="stylesheet" />
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
                            <h5 class="h5 mb-0 text-white"><i><i class="fa fa-cloud" aria-hidden="true"></i> New Item</i></h5>
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
                            <form method="post" onsubmit="return validateForm()">
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="description">Description <i class="text-danger">*</i></label>
                                            <input type="text" name="description" id="description" class="form-control form-control-lg" value="<?php echo $description; ?>" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="gn">GN</label>
                                            <input type="text" name="gn" id="gn" class="form-control form-control-lg" value="<?php echo $gn; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="model">Model <i class="text-danger">*</i></label>
                                            <input type="text" name="model" id="model" class="form-control form-control-lg" value="<?php echo $model; ?>" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="description">Serial No</label>
                                            <input type="text" name="Serial_No" id="Serial_No" class="form-control form-control-lg" value="<?php echo $Serial_No; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="model">Fund</label>
                                            <input type="text" name="Fund" id="Fund" class="form-control form-control-lg" value="<?php echo $Fund; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="AC">AC</label>
                                            <input type="text" name="AC" id="AC" class="form-control form-control-lg" value="<?php echo $AC ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="CL">CL</label>
                                            <input type="text" name="CL" id="CL" class="form-control form-control-lg" value="<?php echo $CL; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="F">F</label>
                                            <input type="text" name="F" id="F" class="form-control form-control-lg" value="<?php echo $F; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="AQU">AQU</label>
                                            <input type="text" name="AQU" id="AQU" class="form-control form-control-lg" value="<?php echo $AQU; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="ST">ST</label>
                                            <input type="text" name="ST" id="ST" class="form-control form-control-lg" value="<?php echo $ST; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="Acquisition">Acquisition</label>
                                            <input type="text" name="Acquisition" id="Acquisition" class="form-control form-control-lg" value="<?php echo $Acquisition; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="Received">Received</label>
                                            <input type="text" name="Received" id="Received" class="form-control form-control-lg" value="<?php echo $Received; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="DocNo">Doc No</label>
                                            <input type="text" name="DocNo" id="DocNo" class="form-control form-control-lg" value="<?php echo $DocNo; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="Amt">Amt</label>
                                            <input type="text" name="Amt" id="Amt" class="form-control form-control-lg" value="<?php echo $Amt; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md mb-3">
                                        <!-- Text input -->
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label fs-4" for="Location">Location <i class="text-danger">*</i></label>
                                            <input type="text" name="Location" id="Location" class="form-control form-control-lg" value="<?php echo $Location; ?>" required />
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
                                        <a type="button" class="btn btn-light btn-lg mb-2" href="../inventory/available.php">Cancel</a>
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
    <script>
        function validateForm() {
            // Get the value of the inputs
            var des = document.getElementById('description').value;
            var mod = document.getElementById('model').value;
            var Ser = document.getElementById('Serial_No').value;
            var Loc = document.getElementById('Location').value;

            if (des.trim() === '') {
                alert('Description is empty');
                return false;
            }
            if (mod.trim() === '') {
                alert('model is empty');
                return false;
            }
            if (Ser.trim() === '') {
                alert('Serial_No is empty');
                return false;
            }
            if (Loc.trim() === '') {
                alert('Location is empty');
                return false;
            }
            // Return true to allow the form to submit
            return true;
        }
    </script>
</body>

</html>