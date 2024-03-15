<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <ul class="navbar-nav navbar-align">
        <a class="nav-link d-none d-sm-inline-block">
            <img src="../../img/icons/inter-logo2-48px.png" class="avatar img-fluid rounded me-1" alt="Admin" />
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

                echo "<span class='text-white'>" . $user_name . " | <b>" . $user_id . "</b> </span>";
            } else {
                echo "<span class='text-white'>User not found</span>";
            }

            // Close query
            $stmt->close();
            ?>
        </a>
    </ul>
</nav>