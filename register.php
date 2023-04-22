<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me - Register</title>
</head>
<body>
    <?php include_once "assets/navbar.html" ?>
    <div class="container ">
        <div class="row align-items-center ">
            <h2 class="text-center text-primary fw-bold fs-1 py-3">Create new account</h2>
            <div class="col ">
                <img src="https://static.vecteezy.com/ti/vettori-gratis/p3/5571540-itinerario-di-viaggio-in-aereo-perno-sulla-mappa-del-mondo-idea-di-viaggio-di-viaggio-vettoriale.jpg"
                class="img-fluid" alt="travel image">
            </div>
            <div class="col">
                <form>
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter name and surname" required><br>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter Email" required><br>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password" required><br>
                    <div class="row">
                        <div class="col-auto">
                        <button type="submit" class="btn btn-lg btn-primary">Register</button><br>
                        </div>
                        <div class="col-auto py-2">
                        <label class="text-primary">Already a member? </label> <a href="login.php">Sign here.</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once "assets/footer.html" ?>
</body>
</html>