<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="../components/dashboards.php">
                <img src="../../img/icons/universidad-interamericana-pr-logo.png" alt="" class="img-fluid w-50 h-50">
                <br><span class="align-middle">Resource Loan System</span>
            </a>
            <hr class="mt-0 mb-0"/>
            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Menu
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../components/dashboards.php">
                        <span class="align-middle">
                            <i class="material-symbols-outlined" style="vertical-align: middle;">bar_chart</i>Dashboard
                        </span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'loans') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../loans/index.php">
                    <span class="align-middle">
                        <i class="material-symbols-outlined" style="vertical-align: middle;">calendar_clock</i>Loans
                    </span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'returns') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../returns/index.php">
                        <span class="align-middle">
                            <i class="material-symbols-outlined" style="vertical-align: middle;">reset_wrench</i>Reviews
                        </span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'inventory') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../inventory/available.php">
                        <span class="align-middle">
                        <i class="material-symbols-outlined" style="vertical-align: middle;">inventory</i>Inventory
                        </span>

                    </a>
                </li>

                <li class="sidebar-header">
                    User
                </li>
                <li class="sidebar-item">
                    <span class="align-middle">
                        <?php
                        include '../../db/config.php';

                        $userid = $_SESSION["username"];

                        // Prepare and execute query
                        $query = "CALL GetUserByUsername(?)";
                        $stmt = $connection->prepare($query);
                        $stmt->bind_param("s", $userid);
                        $stmt->execute();

                        // Get data
                        $result = $stmt->get_result();
                        $user = $result->fetch_assoc();

                        if ($user) {
                            $user_name = $user['name'];
                            $user_id = $user['username'];
                            $user_email = $user['email'];

                            echo "<div class='d-block d-sm-none mt-1 ms-4'><span class='text-white fs-6'>" . $user_name . " | <b>" . $user_id . "</b></span></div>";
                        } else {
                            echo "<div class='d-block d-sm-none mt-1 ms-4'><span class='text-white fs-6'>User not found</span></div>";
                        }

                        // Close query
                        $stmt->close();
                        ?>
                    </span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="../user/logout.php">
                        <span class="align-middle">
                            <i class="material-symbols-outlined" style="vertical-align: middle;">logout</i>Log out
                        </span>
                    </a>
                </li>
        </div>
    </nav>