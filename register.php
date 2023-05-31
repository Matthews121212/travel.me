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
        $birthday = $_POST["birthday"];
        $gender = $_POST["gender"];
        $phoneNumber = $_POST["phoneNumber"];
        
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
            $stmt->bind_param("sssssss", $name, $surname, $email, $passwordHash, $birthday, $gender, $phoneNumber);
            $stmt->execute();
            $stmt->close();
            set_authenticated($email, false);
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
    <div class="container">
        <div class="row align-items-center">
            <h2 class="text-center text-primary fw-bold fs-1 py-3">Create new account</h2>
            <div class="col">
                <img src="https://static.vecteezy.com/ti/vettori-gratis/p3/5571540-itinerario-di-viaggio-in-aereo-perno-sulla-mappa-del-mondo-idea-di-viaggio-di-viaggio-vettoriale.jpg"
                class="img-fluid" alt="travel image">
            </div>
            <div class="col">
                <form action="register.php" method="POST" id="register-form" novalidate>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control needs-validation" id="name" name="name">
                        <label for="name">Name</label>
                        <div class="invalid-feedback">Please provide a valid name</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control needs-validation" id="surname" name="surname">
                        <label for="surname">Surname</label>
                        <div class="invalid-feedback">Please provide a valid surname</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control needs-validation" id="email" name="email">
                        <label for="email">Email</label>
                        <div class="invalid-feedback">Please provide a valid email</div>
                    </div>
                    
                    <div class="form-floating mb-3 w-50">
                        <select class="form-select needs-validation" id="gender" name="gender">
                            <option selected></option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                            <option value="other">Other</option>
                        </select>
                        <label for="gender">Gender</label>
                        <div class="invalid-feedback">Please select a gender.</div>
                    </div>

                    <div class="form-floating mb-3 w-50">
                        <input type="date" class="form-control needs-validation" id="birthday" name="birthday">
                        <label for="birthday">Birthday date</label>
                        <div class="invalid-feedback">Please provide a valid birthday day</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control needs-validation" id="phoneNumber" name="phoneNumber">
                        <label for="phoneNumber">Phone number</label>
                        <div class="invalid-feedback">Please provide a valid phone number</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control needs-validation" id="password" name="password">
                        <label for="password">Password</label>
                        <div class="invalid-feedback">The password must be at least 8 characters long</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control needs-validation" id="confirmPassword" name="confirmPassword">
                        <label for="confirmPassword">Confirm new password</label>
                        <div class="invalid-feedback">The password doesn't match</div>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input needs-validation" id="termsAndConditions" required>
                        <label class="form-check-label" for="termsAndConditions">
                        I do accept the <a href="#!" class="text-primary"><u>Terms and Conditions</u></a> of your
                        site.
                        </label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                </form>
                <div class="row mb-3">
                    <div class="col-auto">
                        <button id="submit-button" class="btn btn-lg btn-primary" onclick="submitForm()">Register</button>
                    </div>
                    <div class="col-auto py-2">
                        <label class="text-primary">Already a member? </label> <a href="login.php">Sign here.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "assets/footer.html" ?>
    <script src="js/register.js"></script>
</body>
</html>