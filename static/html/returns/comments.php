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

    do {
        // Call the stored procedure to update an item
        $query = "CALL InsertComment(?, ?, ?);";
        $stmt = $connection->prepare($query);

        if (!$stmt) {
            $errorMessage = "Error preparing statement: " . $connection->error;
            break;
        }

        // Bind parameters
        $stmt->bind_param("ssi", $Comments, $Date, $id);

        // Execute the statement
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Invalid Input: <br>" . $stmt->error;
            break;
        }

        $stmt->close();
        $connection->close();
        header("location: ./comments.php?id=$id");
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
                                    <div class="col-12 col-md mb-3">
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="comments" class="form-label">New Comments</label>
                                            <form method="post">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="date" id="dateField" value="getCurrentDate()">
                                                <textarea class="form-control" id="comments" name="Comments" rows="3"></textarea>
                                                <a id="Close" class="btn btn-secondary text-dark btn-lg mt-2" type="button" href="./index.php">Close</a>
                                                <button type="submit" class="btn btn-primary btn-lg mt-2">Add Comments</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-0" />
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

                                    echo "
                                    <div class='card-body p-4'>
                                    <div class='d-flex flex-column'>
                                        <!-- Date -->
                                        <div class='mb-3'>
                                            <p class='mb-0 fw-bold'>
                                                $Date
                                            </p>
                                        </div>
                                        <!-- Paragraph Text -->
                                        <div class='bg-light p-4 rounded-4'>
                                            <p class='mt-0'>$Cmt</p>
                                        </div>
                                        <!-- Delete Button -->
                                        <div class='mt-3 text-end'>
                                            <button type='button' class='btn btn-danger btn-lg'>Delete</button>
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