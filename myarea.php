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
        <title>Travel.me - MyArea</title>
    </head>

    <body>
        <?php include_once "assets/navbar.php" ?>
        
        <header class="py-5 bg-image-full header">
            <div class="text-center my-5">
                <h1 class="text-white ft-1 fw-bolder">My Area</h1>
                <img class="img-fluid img-user-logo rounded-circle mb-4 " src="https://static.vecteezy.com/system/resources/previews/008/442/086/original/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg">
                <p class="text-white mb-2">
                    <?php 
                    echo "User: " . $_SESSION['email'];
                    ?>
                </p>
            </div>
        </header> 

        <!-- Content section-->
        <section class="">

        </section>

        <!-- Content section-->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="panel panel-dark panel-colorful">
                                    <a class="link-dark" href="newtravel.php">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">New Travel</p>
                                            <i class="bi bi-airplane-fill display-1"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="panel panel-danger panel-colorful">
                                    <a class="link-dark" href="mytravel.php">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">My Travel</p>
                                            <i class="bi bi-journal-bookmark-fill display-1"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="panel panel-info panel-colorful">
                                    <a class="link-dark" href="userinfo.php">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">User info</p>
                                            <i class="bi bi-person-vcard-fill display-1"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>        
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <?php include_once "assets/footer.html" ?>
    </body>
</html>
