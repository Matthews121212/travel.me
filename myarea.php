<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/head.html" ?>
        <title>Travel.me - MyArea</title>
    </head>

    <body>
        <?php include_once "assets/navbar.html" ?>
        
        <header class="py-5 bg-image-full header">
            <div class="text-center my-5">
                <!--<img class="img-fluid rounded-circle mb-4" src="https://dummyimage.com/150x150/6c757d/dee2e6.jpg" alt="..." />-->
                <h1 class="text-white ft-1 fw-bolder">My Area</h1>
                <img class="img-fluid img-user-logo rounded-circle mb-4 " src="https://static.vecteezy.com/system/resources/previews/008/442/086/original/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg">
                <p class="text-white-50 mb-2">Username</p>
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
                                    <a class="link" href="newtravel.php">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">New Travel</p>
                                            <i class="bi bi-airplane-fill display-1"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="panel panel-danger panel-colorful">
                                    <div class="panel-body text-center">
                                        <p class="text-uppercase mar-btm text-sm">My Travel</p>
                                        <i class="bi bi-journal-bookmark-fill display-1"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="panel panel-info panel-colorful">
                                    <div class="panel-body text-center">
                                        <p class="text-uppercase mar-btm text-sm">User info</p>
                                        <i class="bi bi-person-vcard-fill display-1"></i>
                                    </div>
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
