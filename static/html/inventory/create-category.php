<?php

include '../../db/config.php';

// Initialize variables
$Category = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /*  FYI
        FILTER_SANITIZE_SPECIAL_CHARS is a filter constant in PHP used for sanitizing input data 
        by converting special characters to HTML entities. This is particularly useful when you want 
        to prevent cross-site scripting (XSS) attacks by ensuring that user-supplied data doesn't contain 
        characters that could be interpreted as HTML or JavaScript.

        En otras palabras, para limpiar los datos de caracteres especiales.
    */

    // Validate and sanitize user inputs
    $Category = filter_var($_POST["Category"], FILTER_SANITIZE_SPECIAL_CHARS);

    do {
        if (empty($Category)) {
            $errorMessage = "Please provide a Category.";
            break;
        }

        // Add a new item to the database using prepared statements
        $query = "INSERT INTO categories 
        (Category) 
        VALUES (?)";

        // Prepare the statement
        $stmt = $connection->prepare($query);

        if (!$stmt) {
            $errorMessage = "Error preparing statement: " . $connection->error;
            break;
        }

        // Bind parameters
        $stmt->bind_param("s", $Category);

        // Execute the statement
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Error executing statement: " . $stmt->error;
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

    <title>Create - IELS</title>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
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
    <?php $activePage = 'inventory'; include '../components/sidebar.php'; ?>

        <div class="main">
        <?php include '../components/navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0 justify-content-center">
                    <div class="row">
                        <div class="card mx-auto my-5 col-12 col-md-6 p-0">
                            <div class="card-header bg-success w-100" style="background-color: #00973c !important;">
                                <h5 class="h5 mb-0 text-white"><i><i class="fa fa-cloud" aria-hidden="true"></i> New Category</i></h5>
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
                                                <input type="text" name="Category" id="Category" class="form-control" value="<?php echo $Category; ?>" />
                                                <label class="form-label" for="Category">Category</label>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Button container with centering classes -->
                                    <div class="justify-content-center">
                                        <div class="row">
                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-success btn-lg mb-2" style="background-color: #00973c !important;">Submit <i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="row">
                                            <!-- Cancel button -->
                                            <a type="button" class="btn btn-light btn-lg mb-2" href="../inventory/index.php">Cancel</a>
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
            var category = document.getElementById('category').value;

            if (description.trim() === '') {
                alert('Category is empty');
                return false;
            }
            // Return true to allow the form to submit
            return true;
        }
    </script>
</body>

</html>