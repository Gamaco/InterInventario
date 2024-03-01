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

                <li class="sidebar-item <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../components/dashboard.php">
                        <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'loans') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../loans/index.php">
                        <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Loans</span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'returns') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../returns/index.php">
                        <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Reviews</span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo ($activePage == 'inventory') ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="../inventory/index.php">
                        <i class="align-middle" data-feather="database"></i> <span class="align-middle">Inventory</span>
                    </a>
                </li>

                <li class="sidebar-header">
                    User
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="../user/login.php">
                        <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Sign out</span>
                    </a>
                </li>
        </div>
    </nav>