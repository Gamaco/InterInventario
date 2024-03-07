<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="../components/dashboard.php">
                <img src="../../img/icons/universidad-interamericana-pr-logo.png" alt="" class="img-fluid w-50 h-50">
                <br><span class="align-middle">Equipment Loan System</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Menu
                </li>

                <!--  -->

                <li class="sidebar-item <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../components/dashboard.php">
                         <span class="align-middle"><i class="fa fa-th-large" aria-hidden="true"></i> Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'loans') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../loans/index.php">
                        <span class="align-middle"><i class="fa fa-file-text-o" aria-hidden="true"></i> Loans</span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'returns') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../returns/index.php">
                        <span class="align-middle"><i class="fa fa-check-square-o" aria-hidden="true"></i> Reviews</span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'inventory') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../inventory/index.php">
                        <span class="align-middle"><i class="fa fa-database" aria-hidden="true"></i> Inventory</span>
                    </a>
                </li>

                <li class="sidebar-header">
                    User
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="../user/login.php">
                        <span class="align-middle"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</span>
                    </a>
                </li>
        </div>
    </nav>