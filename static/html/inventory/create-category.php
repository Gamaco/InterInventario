<?php

include '../../db/config.php';

// Initialize variables
$Category = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate and sanitize user inputs
    $Category = filter_var($_POST["Category"], FILTER_SANITIZE_SPECIAL_CHARS);

    do {
        if (empty($Category)) {
            $errorMessage = "Please provide a Category.";
            break;
        }

        // Call the stored procedure
        $query = "CALL InsertCategory(?)";

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

        header("location: ../inventory/create-category.php");
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
    <?php $activePage = 'inventory';
    include '../components/sidebar.php'; ?>

    <div class="main">
        <?php include '../components/navbar.php'; ?>

        <main class="content">
            <div class="container-fluid p-0 justify-content-center">
                <div class="row">
                    <div class="card mx-auto my-5 col-12 col-md-6 p-0">
                        <div class="card-header bg-success w-100" style="background-color: #00973c !important;">
                            <h5 class="h5 mb-0 text-white"><i><i class="fa fa-cloud" aria-hidden="true"></i> Categories</i></h5>
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
                                            <input type="text" name="Category" id="Category" class="form-control fs-4" value="<?php echo $Category; ?>" />
                                            <label class="form-label" for="Category">New Category</label>
                                        </div>
                                        <div>
                                            <!-- Close window button -->
                                            <a type="button" class="btn btn-light btn-lg mb-2" href="../inventory/index.php">Close</a>
                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-lg mb-2">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-group mb-3">
                                    <?php
                                    include '../../db/config.php';

                                    // Call the stored procedure for fetching categories
                                    $query = "CALL GetCategories()";

                                    // Prepare the statement
                                    $stmt = $connection->prepare($query);

                                    if (!$stmt) {
                                        die("Error preparing statement: " . $connection->error);
                                    }

                                    // Execute the statement
                                    $result = $stmt->execute();

                                    if (!$result) {
                                        die("Error executing statement: " . $stmt->error);
                                    }

                                    // Bind result variables
                                    $stmt->bind_result($id, $category);

                                    // Fetch categories
                                    while ($stmt->fetch()) {
                                        echo "
                                            <li class='list-group-item list-group-item-light'> " . $category . "
                                            <a class='btn btn-danger btn-lg float-right' data-bs-toggle='modal' data-bs-target='#itemDeletionModal' data-item-id='$id'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
                                            </li>
                                            ";
                                    }

                                    $stmt->close();
                                    $connection->close();
                                    ?>


                                </ul>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- item Deletion Modal -->
        <div class="modal fade" id="itemDeletionModal" tabindex="-1" aria-labelledby="itemDeletionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemDeletionModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You are about to delete this category. This action cannot be undone.</p>
                        <p>Are you sure you want to proceed?</p>
                        <input type="hidden" id="itemIdToDelete" name="deleteItemId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

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

    <!-- Item Deletion Warning Modal (Are you sure you want to delete?) -->
    <script>
        var itemDeletionModal = document.getElementById('itemDeletionModal');
        itemDeletionModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var itemId = button.getAttribute('data-item-id'); // Extract info from data-* attributes
            var modal = this;
            modal.querySelector('#itemIdToDelete').textContent = itemId;
            modal.querySelector('#confirmDeleteBtn').addEventListener('click', function() {
                // Perform deletion action here using the itemId
                window.location.href = './delete-category.php?id=' + itemId;
            });
        });
    </script>
</body>

</html>