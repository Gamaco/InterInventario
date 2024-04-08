<?php include '../components/userSessionValidation.php'; ?>

<?php
include '../../db/config.php';

$errorMessage = "";

// Check if $id exists
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
    $query = "CALL GetReturnById(?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $returns = $result->fetch_assoc();

    $stmt->close();

    if (!$returns) {
        header("location: index.php");
        exit;
    }
} else {
    // Validate and sanitize user inputs
    $id = filter_var($_POST["id"], FILTER_SANITIZE_SPECIAL_CHARS);
    $Comments = filter_var($_POST["Comments"], FILTER_SANITIZE_SPECIAL_CHARS);
    $Date = filter_var($_POST["date"], FILTER_SANITIZE_SPECIAL_CHARS);

    // Call the stored procedure to update an item
    $query = "CALL InsertComment(?, ?, ?);";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        $errorMessage = "Error preparing statement: " . $connection->error;
    } else {
        // Bind parameters
        $stmt->bind_param("ssi", $Comments, $Date, $id);

        // Execute the statement
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Invalid Input: <br>" . $stmt->error;
        } else {
            $stmt->close();
            $connection->close();
            header("location: ./comments.php?id=$id");
            exit;
        }
    }
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

    <title>Comments | IELS</title>
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
            <div class="container-fluid p-0 justify-content-center">
                <div class="container my-1 py-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <a id="Close" class="btn btn-light btn-lg mb-2" type="button" href="./index.php"><i class="material-symbols-outlined" style='vertical-align: middle;'>arrow_back</i>Back</a>
                            <div class="card text-dark mb-0">
                                <div class="card-body p-4">
                                    <div class="col-12 col-md">
                                        <div data-mdb-input-init class="form-outline">
                                            <form method="post">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="date" id="dateField" value="getCurrentDate()">
                                                <textarea class="form-control" id="commentsText" name="Comments" rows="3" placeholder="New Comment" required></textarea>
                                                <button type="submit" class="btn btn-primary btn-lg mt-3">Add Comments</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            include '../../db/config.php';

                            // Prepare the SQL statement to call the stored procedure
                            $stmt = $connection->prepare("CALL GetCommentByID(?)");
                            $stmt->bind_param("i", $id);

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
                                $CommentID = $Comment['id'];

                                echo "
                                    <div class='card text-dark mb-0 mt-2'>
                                    <div class='card-body p-4'>
                                    <div class='d-flex flex-column'>
                                        <!-- Date -->
                                        <div class='mb-3'>
                                            <p class='mb-0 fw-bold'>
                                                $Date
                                            </p>
                                        </div>
                                        <!-- Paragraph Text -->
                                            <p class='mt-0'>$Cmt</p>
                                        <!-- Delete Button -->
                                        <div class='mt-3 text-end'>
                                            <a type='button' class='btn btn-light btn-lg' data-bs-toggle='modal' data-bs-target='#commentDeletionModal' data-comment-id='$CommentID' data-item-id='$id'>Delete</a>
                                        </div>
                                    </div>
                                </div>
                                </div>
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
        </main>

        <!-- item Deletion Modal -->
        <div class="modal fade" id="commentDeletionModal" tabindex="-1" aria-labelledby="commentDeletionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentDeletionModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You are about to delete this comment. This action cannot be undone.</p>
                        <p>Are you sure you want to proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-dark" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="commentDeleteBtn">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="../../js/app.js"></script>

        <!-- Item Deletion Warning Modal (Are you sure you want to delete?) -->
        <script>
            var commentDeletionModal = document.getElementById('commentDeletionModal');
                commentDeletionModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Button that triggered the modal
                let commentId = button.getAttribute('data-comment-id'); // Extract info from data-* attributes
                let itemId = button.getAttribute("data-item-id");
                var modal = this;
                modal.querySelector('#commentDeleteBtn').addEventListener('click', function() {
                    // Perform deletion action here using the itemId
                    window.location.href = './delete-comments.php?commentId=' + commentId + '&itemId=' + itemId;
                });
            });
        </script>

        <script>
            function getCurrentDate() {
                // Create a new Date object to get the current date and time
                var currentDate = new Date();

                // Get the month name
                var monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                var month = monthNames[currentDate.getMonth()];

                // Get the day and year
                var day = currentDate.getDate();
                var year = currentDate.getFullYear();

                // Format the date as desired (e.g., "Month Day, Year")
                var formattedDate = month + " " + day + ", " + year;

                return formattedDate;
            }

            document.getElementById("dateField").value = getCurrentDate();
        </script>

</body>

</html>