<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me - Register</title>
</head>
<body>
    <?php include_once "assets/navbar.html" ?>
    <div class="container">
        <div class="row align-items-center ">
            <h2 class="text-center text-primary fw-bold fs-1 py-3">Create new account</h2>
            <div class="col">
                <img src="https://static.vecteezy.com/ti/vettori-gratis/p3/5571540-itinerario-di-viaggio-in-aereo-perno-sulla-mappa-del-mondo-idea-di-viaggio-di-viaggio-vettoriale.jpg"
                class="img-fluid" alt="travel image">
            </div>
            <div class="col">
                <form>
                    <input type="text" id="nome" class="form-control form-control-lg" placeholder="Enter name and surname"><br>
                    <input type="email" id="email" class="form-control form-control-lg" placeholder="Enter Email"><br>
                    <input type="password" id="pass" class="form-control form-control-lg" placeholder="Enter Password"><br>
                    <button type="submit" class="btn btn-lg btn-primary">Register</button><br>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="col">
        <p class="text-center text-primary">Have an account?</p>
        <button class="d-grid mx-auto btn btn-primary " onclick="location.href='login.php'">Log in here</button>
    </div>
    <hr>
    <?php include_once "assets/footer.html" ?>
</body>
</html>