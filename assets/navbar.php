<?php
    $authenticated = isset($_SESSION["email"]);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/"><span class="material-symbols-outlined">travel_explore</span> Travel.me</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                
                <?php if($authenticated): ?>
                    <li class="nav-item"><a class="nav-link" href="myarea.php">My Area</a></li>
                <?php endif; ?>

                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>

                <?php if($authenticated): ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login/Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>