<?php
    session_start();
    require "includes/authentication.php";
    if(!is_authenticated()) {
        header("Location: login.php");
        return;
    }
    $email = $_SESSION["email"];
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $newEmail = $_POST["email"];
        $birthday = $_POST["birthday"];
        $gender = $_POST["gender"];
        $phoneNumber = $_POST["phoneNumber"];
        
        $stmt = $dbconn->prepare("UPDATE user SET name = ?, surname = ?, email = ?, date = ?, gender = ?, number = ? WHERE email = ?");
        $stmt->bind_param("sssssss", $name, $surname, $newEmail, $birthday, $gender, $phoneNumber, $email);
        $stmt->execute();
        $_SESSION["email"] = $newEmail;
        $stmt->close();
    }
    else {
        $stmt = $dbconn->prepare("SELECT name, surname, date, gender, number FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $info = $result->fetch_assoc();
        $name = $info["name"];
        $surname = $info["surname"];
        $birthday = $info["date"];
        $gender = $info["gender"];
        $phoneNumber = $info["number"];
        $result->close();
        $stmt->close();
    }
    $dbconn->close();
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
        <h2 class="text-center text-primary fw-bold fs-1 py-3">User Info</h2>
        <div class="row">
            <div class="col">
                <img src="https://static.vecteezy.com/ti/vettori-gratis/p3/5571540-itinerario-di-viaggio-in-aereo-perno-sulla-mappa-del-mondo-idea-di-viaggio-di-viaggio-vettoriale.jpg"
                    class="img-fluid" alt="travel image">
            </div>
            <div class="col">
                <form id="modify-form" action="userinfo.php" method="POST">
                    <div class="form-group row mb-2">
                        <label for="email" class="col-sm-2 col-form-label my-auto fw-bold">Name</label>
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext form-control-lg user-info" id="name" name="name" value="<?php echo $name ?>"></div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="email" class="col-sm-2 col-form-label my-auto fw-bold">Surname</label>
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext form-control-lg user-info" id="surname" name="surname" value="<?php echo $surname ?>"></div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="email" class="col-sm-2 col-form-label my-auto fw-bold">Email</label>
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext form-control-lg user-info" id="email" name="email" value="<?php echo $email ?>"></div>
                    </div>

                    <div class="form-group row mb-2" id="genderDiv">
                        <label class="col-sm-2 col-form-label my-auto fw-bold">Gender</label>
                        <div class="form-check form-check-inline form-control-lg gender" hidden>
                            <input class="form-check-input" type="radio" id="femaleGender" name="gender" value="female">
                            <label class="form-check-label" for="femaleGender">Female</label>
                        </div>
                        <div class="form-check form-check-inline form-control-lg gender" hidden>
                            <input class="form-check-input" type="radio" id="maleGender" name="gender" value="male">
                            <label class="form-check-label" for="maleGender">Male</label>
                        </div>
                        <div class="form-check form-check-inline form-control-lg gender" hidden>
                            <input class="form-check-input" type="radio" id="otherGender" name="gender" value="other">
                            <label class="form-check-label" for="otherGender">Other</label>
                        </div>
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext form-control-lg user-info" id="genderReadOnly" value="<?php echo $gender ?>"></div>
                    </div>
                    
                    <div class="form-group row mb-2">
                        <label for="email" class="col-sm-2 col-form-label my-auto fw-bold">Birthday date</label>
                        <div class="col-sm-10"><input type="date" readonly class="form-control-plaintext form-control-lg user-info" id="birthday" name="birthday" value="<?php echo $birthday ?>"></div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="email" class="col-sm-2 col-form-label my-auto fw-bold">Phone number</label>
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext form-control-lg user-info" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber ?>"></div>
                    </div>
                </form>
                <div class="row">
                    <div class="col">
                        <button id="modify-button" class="btn btn-lg btn-primary mt-2" onclick="modifyUserInfo()">Modify</button>
                        <button id="cancel-button" class="btn btn-lg btn-primary mt-2" onclick="cancelModify()" hidden>Cancel</button>
                        <button id="save-button" class="btn btn-lg btn-primary mt-2" onclick="saveModify()" hidden>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "assets/footer.html" ?>
    <script src="js/userinfo.js"></script>
</body>
</html>