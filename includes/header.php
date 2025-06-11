<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">Beckcare Aesthetic Lounge</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item ">
                    <a class="nav-link" href="facialsrv.php">
                        Services
                    </a>
                 
                </li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>

                <?php
                // Check if the user is logged in
                if (isset($_SESSION['user_name'])) {
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    echo 'Welcome, ' . $_SESSION['user_name'];
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    echo '<a class="dropdown-item" href="prof.php">Profile</a>';
                    echo '<a class="dropdown-item" href="AppointmentHistory.php">Appointment History</a>';
                    echo '<a class="dropdown-item" href="logout.php">Logout</a>';
                    echo '</div>';
                    echo '</li>';
                } else {
                    echo '<li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>';
                    // echo '<li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
