<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../../db/config.php';

    $id = $_POST["id"];
    $pwd = $_POST["pwd"];
    $conn = $connection;


    // Validate user input
    function emptyInputLogin($id, $pwd)
    {
        $result = (empty($id) || empty($pwd));
        return $result;
    }

    if (emptyInputLogin($id, $pwd) == true) {
        header("location: ./login.php?Error=MIF");
        exit();
    }

    // Validate password
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


    // Verify if the user exists
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

    // Login user into the system
    function loginUser($conn, $id, $pwd)
    {
        $IDExists = IDExists($conn, $id);
        $passwordMatch = password_match($conn, $id, $pwd);

        if ($IDExists === false) {
            header("location: ./login.php?Error=UDE");
            exit();
        } else if ($passwordMatch === false) {
            header("location: ./login.php?Error=IUP");
            exit();
        }

        // Start login session (User is now logged in)
        session_start();
        $_SESSION["username"] = $id;

        // Redirect to dashboard if login successful
        header("location: ../components/dashboards.php");
        exit();
    }

    loginUser($conn, $id, $pwd);

    // Close main db connection
    $connection->close();
} else {
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

    <title>Login - IELS</title>

    <link href="../../css/app.css" rel="stylesheet">
    <link href="../../css/login.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
                                                <label class="form-label">Identification Number</label>
                                                <input class="form-control form-control-lg" type="text" name="id" placeholder="Enter your ID" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input class="form-control form-control-lg" type="password" name="pwd" placeholder="Enter your password" required />
                                            </div>
                                            <div>
                                                <!-- 
                                                    'Remember me' button isn't implemented. 
                                                    Keeping it here just in case someone else
                                                    decides to implement it in the future.

                                                    ¯\_(ツ)_/¯ @Profe
                                                    
                                                    <div class="form-check align-items-center">
                                                    <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
                                                    <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                                                </div> -->
                                            </div>
                                            <div class="d-grid gap-2 mt-3">
                                                <button type="submit" name="submit" class="btn btn-lg btn-primary">Log in</button>
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