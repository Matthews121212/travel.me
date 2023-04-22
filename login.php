<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me - Login</title>

    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <?php include_once "assets/navbar.html" ?>
    <div class="container">
        <div class="row align-items-center ">
            <h2 class="text-center text-primary fw-bold fs-1 py-3">Log in page</h2>
            <div class="col">
                <img src="https://static.vecteezy.com/ti/vettori-gratis/p3/5571540-itinerario-di-viaggio-in-aereo-perno-sulla-mappa-del-mondo-idea-di-viaggio-di-viaggio-vettoriale.jpg"
                class="img-fluid" alt="travel image">
            </div>
            <div class="col">
                
                <form action="login.php">
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter Email" required><br>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password" required><br>
                    <div class="row">
                        <div class="col-auto">
                        <button type="submit" class="btn btn-lg btn-primary">Sign in</button><br>
                        </div>
                        <div class="col-auto py-2">
                        <label class="text-primary">Not a member yet? </label> <a href="register.php">register here </a>
                        </div>
                    </div>
                </form>
                
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $dbconn = new mysqli("localhost", "root", "", "bob", 3306) or die("Could not connect: " . mysqli_connect_error());
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $stmt = $dbconn->prepare("SELECT password FROM test WHERE email = ?");
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result) {
                            $correctPassword = $result->fetch_field();
                            $passwordMatches = password_verify($password, $correctPassword);
                            if ($passwordMatches) {
                                header("Location: myarea.php");
                            }
                        }
                        echo "Incorrect email or password";
                        return;
                    }
                ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="col">
        
        
    </div>
    <hr>

    
    <?php include_once "assets/footer.html" ?>
</body>
</html>