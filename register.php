<?php
    session_start();
    require "includes/authentication.php";
    if(is_authenticated()) {
        header("Location: myarea.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $date = $_POST["date"];
        $gender = $_POST["gender"];
        $number = $_POST["number"];
        
        $stmt = $dbconn->prepare("SELECT 1 FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $alreadyRegistered = $result->num_rows > 0;
        $result->close();
        $stmt->close();
        if(!$alreadyRegistered) {
            $stmt = $dbconn->prepare("INSERT INTO user (name, surname, email, password, date, gender, number) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sssssss", $name, $surname, $email, $passwordHash, $date, $gender, $number);
            $stmt->execute();
            $stmt->close();
            $_SESSION["email"] = $email;
            header("Location: myarea.php");
        }
        $dbconn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me - Register</title>
</head>
<body>
    <?php include_once "assets/navbar.php" ?>
    <div class="container ">
        <div class="row align-items-center">
            <h2 class="text-center text-primary fw-bold fs-1 py-3">Create new account</h2>
            <div class="col ">
                <img src="https://static.vecteezy.com/ti/vettori-gratis/p3/5571540-itinerario-di-viaggio-in-aereo-perno-sulla-mappa-del-mondo-idea-di-viaggio-di-viaggio-vettoriale.jpg"
                class="img-fluid" alt="travel image">
            </div>
            <div class="col">
                <form action="register.php" method="POST">
                    <div class="row">
                        <div class="col"> 
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter name" required><br>
                        </div>
                        <div class="col"> 
                            <input type="text" name="surname" class="form-control form-control-lg" placeholder="Enter surname" required><br>
                        </div>
                    </div>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter Email" required><br>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password" required><br>
                    
                    <h6 class="form-check form-check-inline form-control-lg">Gender: </h6>

                    <div class="form-check form-check-inline form-control-lg">
                        <input class="form-check-input" type="radio" name="gender" value="female" required>
                        <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline form-control-lg">
                        <input class="form-check-input" type="radio" name="gender" value="male" required>
                        <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                    <div class="form-check form-check-inline form-control-lg">
                        <input class="form-check-input" type="radio" name="gender" value="other" required>
                        <label class="form-check-label" for="otherGender">Other</label>
                    </div>
                    
                    <div class="form-group">
                        <h6 class="form-check form-check-inline form-control-lg active" for="date">Birthday date: </h6>
                        <input type="date" id="date" name="date">
                    </div>

                    <input type="tel" name="number" class="form-control form-control-lg" placeholder="Enter phone number" required><br>

                    <div class="form-check d-flex justify-content-start mb-4 pb-3">
                    <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label text-secondary" for="form2Example3">
                    I do accept the <a href="#!" class="text-primary"><u>Terms and Conditions</u></a> of your
                    site.
                    </label>
                    </div>

                    <div class="row">
                        <div class="col-auto">
                        <button type="submit" class="btn btn-lg btn-primary">Register</button><br>
                        </div>
                        <div class="col-auto py-2">
                        <label class="text-primary">Already a member? </label> <a href="login.php">Sign here.</a>
                        </div>
                    </div>
                </form>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && $alreadyRegistered) {
                        echo "The email is already registered";
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include_once "assets/footer.html" ?>
</body>
</html>