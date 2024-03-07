<?php
include '../../db/config.php';

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: inventory.php");
        exit;
    }

    $id = $_GET["id"];

    // Call the stored procedure to fetch an item by ID
    $query = "CALL GetReturnById(?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $returns = $result->fetch_assoc();

    $stmt->close();

    if (!$returns) {
        header("location: inventory.php");
        exit;
    }

    $description = $returns["Description"];
    $ptag = $returns["PTag"];
    $condition = $returns["Item_Cond"];
    $comments = $returns["Comments"];
} else {
    // Validate and sanitize user inputs
    $id = filter_var($_POST["id"], FILTER_SANITIZE_SPECIAL_CHARS);
    $condition = filter_var($_POST["Item_Cond"], FILTER_SANITIZE_SPECIAL_CHARS);
    $comments = filter_var($_POST["Comments"], FILTER_SANITIZE_SPECIAL_CHARS);

    do {
        // Call the stored procedure to update an item
        $query = "CALL UpdateReturnedItem(?, ?, ?)";
        $stmt = $connection->prepare($query);

        if (!$stmt) {
            $errorMessage = "Error preparing statement: " . $connection->error;
            break;
        }

        // Bind parameters
        $stmt->bind_param("ssi", $condition, $comments, $id);

        // Execute the statement
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Invalid Input: <br>" . $stmt->error;
            break;
        }

        $stmt->close();
        $connection->close();
        header("location: ../returns/index.php");
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
    <?php $activePage = 'returns';
    include '../components/sidebar.php'; ?>

    <div class="main">
        <?php include '../components/navbar.php'; ?>

        <main class="content">
            <div class="container-fluid p-0 justify-content-center">
                <div class="row">
                    <div class="card mx-auto my-5 col-12 col-md-6 p-0">
                        <div class="card-header bg-success w-100" style="background-color: #00973c !important;">
                            <h5 class="h5 mb-0 text-white"><i>Edit Returned Item Status</i></h5>
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
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="PTag">PTag</label>
                                            <input type="text" name="PTag" id="PTag" class="form-control fs-4" value="<?php echo $ptag; ?>" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="Description">Description</label>
                                            <input type="text" name="Description" id="Description" class="form-control fs-4" value="<?php echo $description ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="comments" class="form-label">Comments</label>
                                            <textarea class="form-control" id="comments" name="Comments" rows="2" maxlength="80"><?php echo $comments ?></textarea>
                                            <small class="form-text text-muted" id="charCount">0/80 characters</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md mb-3">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="Condition">Condition</label>
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="hidden" id="condition" name="Item_Cond" value="<?php echo $condition ?>">
                                                <div class="dropdown-center mb-3">
                                                    <button id="conditionDropdownButton" class="btn btn-light btn-lg dropdown-toggle mb-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?php echo $condition ?>
                                                    </button>
                                                    <ul class="dropdown-menu" id="conditionDropdownMenu">
                                                        <li><a class='dropdown-item'>WIP</a></li>
                                                        <li><a class='dropdown-item'>Damaged</a></li>
                                                        <li><a class='dropdown-item'>Incomplete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/app.js"></script>
    <script src="../../js/returns-edit.js"></script>

    <script>
        // Add event listener to the textarea
        document.getElementById('comments').addEventListener('input', function() {
            // Get the current character count
            var charCount = this.value.length;
            // Get the maximum character limit
            var maxLength = parseInt(this.getAttribute('maxlength'));
            // Update the character count display
            document.getElementById('charCount').textContent = charCount + '/' + maxLength + ' characters';
            // Trim the text if it exceeds the limit
            if (charCount > maxLength) {
                this.value = this.value.substring(0, maxLength);
            }
        });
    </script>
</body>

</html>