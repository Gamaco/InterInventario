<?php
session_start();

// Include database configuration
include '../../db/config.php';

// Function to validate user input
function emptyInputLogin($id, $pwd)
{
    return (empty($id) || empty($pwd));
}

// Function to validate password
function password_match($conn, $id, $pwd)
{
    // Prepare and execute query
    $query = "CALL GetUserByUsername(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    // Get data
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Close query
    $stmt->close();

    // Verify password
    return ($user && password_verify($pwd, $user['pwd'])) ? true : false;
}

// Function to verify if the user exists
function IDExists($conn, $id)
{
    // Prepare and execute query
    $query = "CALL GetUserByUsername(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    // Get data
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Close query
    $stmt->close();

    return (!$user) ? false : true;
}

// Function to login user into the system
function loginUser($conn, $id, $pwd)
{
    if (emptyInputLogin($id, $pwd)) {
        header("location: ./login.php?Error=MIF");
        exit();
    }

    if (!IDExists($conn, $id)) {
        header("location: ./login.php?Error=UDE");
        exit();
    }

    if (!password_match($conn, $id, $pwd)) {
        header("location: ./login.php?Error=IUP");
        exit();
    }

    // Start login session (User is now logged in)
    $_SESSION["username"] = $id;

    // Check if redirected from a target page
    if (isset($_GET['redirect']) && $_GET['redirect'] === 'true' && isset($_GET['page'])) {
        // Store the target page URL in a session variable
        $_SESSION['target_page'] = $_GET['page'];
    }

    // Redirect after successful login
    if (isset($_SESSION['target_page'])) {
        $targetPage = $_SESSION['target_page'];
        unset($_SESSION['target_page']); // Clear the session variable
        header("location: $targetPage");
    } else {
        header("location: ../components/dashboards.php");
    }
    exit();
}

// Perform login if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $pwd = $_POST["pwd"];

    loginUser($connection, $id, $pwd);
}

// Close database connection
$connection->close();

// Handle error messages
$errorMessage = "";
if (isset($_GET['Error'])) {
    if ($_GET['Error'] == 'MIF') {
        $errorMessage = "Error: Missing input fields.";
    } else if ($_GET['Error'] == 'UDE') {
        $errorMessage = "Error: Username doesn't exist.";
    } else if ($_GET['Error'] == 'IUP') {
        $errorMessage = "Error: Incorrect user password.";
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

    <title>Login - IRLS</title>

    <link href="../../css/app.css" rel="stylesheet">
    <link href="../../css/login.css" rel="stylesheet">
    <!-- Google font & icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@250" rel="stylesheet" />
</head>

<body>
    <div class="bg-image">
        <main class="d-flex w-100">
            <div class="container d-flex flex-column">
                <div class="row vh-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            <div class="card">
                                <div class="text-center mt-4">
                                    <img class="img-fluid mb-0" src="../../img/icons/inter-logo.png" style="max-width: 150px; max-height: 150px;">
                                    <h1 class="login mt-0">Equipment Loan System</h1>
                                    <p class="lead">
                                        Sign in to your account to continue
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="m-sm-3">
                                        <form action="login.php" method="post">
                                            <div class="mb-3">
                                                <!-- Error Message -->
                                                <?php
                                                if (!empty($errorMessage)) {
                                                    echo "<div class='container-fluid bg-danger mt-1 mb-1 bg-opacity-10'>
                                                    <div class='alert text-danger alert-dismissible fs-5 fade show mb-5 d-flex justify-content-between' role='alert'>
                                                        <strong> $errorMessage </strong>
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>
                                                </div>";
                                                }
                                                ?>
                                                <label class="form-label"><b>Identification Number</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"><i class="material-symbols-outlined">person</i></span>
                                                    <input class="form-control fs-4 form-control-lg p-2" type="text" name="id" required />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><b>Password</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"><i class="material-symbols-outlined">key</i></span>
                                                    <input class="form-control fs-4 form-control-lg p-2" type="password" name="pwd" id="passwordField" required />
                                                </div>
                                            </div>
                                            <div>
                                                <!-- 
                                                    'Remember me' button isn't implemented. 
                                                    Kept it here just in case someone else
                                                    decides to implement it in the future.

                                                    ¯\_(ツ)_/¯ @Profe
                                                    
                                                    <div class="form-check align-items-center">
                                                        <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
                                                        <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                                                    </div> 
                                                -->
                                            </div>
                                            <div class="d-grid gap-2 mt-5 mb-3">
                                                <button type="submit" name="submit" class="btn btn-lg fs-4 btn-primary">Log in</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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