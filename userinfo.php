<?php
    session_start();
    require "includes/authentication.php";
    if(!is_authenticated()) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me - User Info</title>
</head>
<body>
    <?php include_once "assets/navbar.php" ?>

    <div class="container">

    </div>
    <?php include_once "assets/footer.html" ?>
</body>
</html>