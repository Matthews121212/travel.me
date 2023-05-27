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
        $oldPassword = $_POST["oldPassword"];
        $newPassword = $_POST["newPassword"];
        $confirmPassword = $_POST["confirmPassword"];

        if ($oldPassword === "" || $newPassword === "") {
            $stmt = $dbconn->prepare("UPDATE user SET name = ?, surname = ?, email = ?, date = ?, gender = ?, number = ? WHERE email = ?");
            $stmt->bind_param("sssssss", $name, $surname, $newEmail, $birthday, $gender, $phoneNumber, $email);
            $_SESSION["email"] = $newEmail;
        }
        else {
            $stmt = $dbconn->prepare("SELECT password FROM user WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $correctPasswordHash = $result->fetch_column();
            $passwordMatches = $correctPasswordHash && password_verify($oldPassword, $correctPasswordHash);
            if ($passwordMatches) {
                $stmt->close();
                $stmt = $dbconn->prepare("UPDATE user SET password = ? WHERE email = ?");
                $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt->bind_param("ss", $passwordHash, $email);
            }
        }
        $stmt->execute();
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
                <form id="user-info-form" action="userinfo.php" method="POST" novalidate>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control needs-validation" readonly id="name" name="name" value="<?php echo $name ?>">
                        <label for="name">Name</label>
                        <div class="invalid-tooltip">Please provide a valid name</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control needs-validation" readonly id="surname" name="surname" value="<?php echo $surname ?>">
                        <label for="surname">Surname</label>
                        <div class="invalid-tooltip">Please provide a valid surname</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control needs-validation" readonly id="email" name="email" value="<?php echo $email ?>">
                        <label for="email">Email</label>
                        <div class="invalid-tooltip">Please provide a valid email</div>
                    </div>
                    
                    <div class="form-group mb-3" id="gender">
                        <label class="col-sm-2 col-form-label my-auto fw-bold">Gender</label>
                        <div class="form-check form-check-inline form-control-lg">
                            <input class="form-check-input" type="radio" id="femaleGender" name="gender" value="female" disabled <?php echo $gender === "female" ? "checked" : "" ?>>
                            <label class="form-check-label" for="femaleGender">Female</label>
                        </div>
                        <div class="form-check form-check-inline form-control-lg">
                            <input class="form-check-input" type="radio" id="maleGender" name="gender" value="male" disabled <?php echo $gender === "male" ? "checked" : "" ?>>
                            <label class="form-check-label" for="maleGender">Male</label>
                        </div>
                        <div class="form-check form-check-inline form-control-lg">
                            <input class="form-check-input" type="radio" id="otherGender" name="gender" value="other" disabled <?php echo $gender === "other" ? "checked" : "" ?>>
                            <label class="form-check-label" for="otherGender">Other</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control needs-validation" readonly id="birthday" name="birthday" value="<?php echo $birthday ?>">
                        <label for="birthday">Birthday date</label>
                        <div class="invalid-tooltip">Please provide a valid birthday day</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control needs-validation" readonly id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber ?>">
                        <label for="phoneNumber">Phone number</label>
                        <div class="invalid-tooltip">Please provide a valid phone number</div>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control needs-validation" id="oldPassword" name="oldPassword">
                        <label for="oldPassword">Old password</label>
                        <div class="invalid-tooltip">The password is incorrect</div>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control needs-validation" id="newPassword" name="newPassword">
                        <label for="newPassword">New password</label>
                        <div class="invalid-tooltip">Please provide a password</div>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control needs-validation" id="confirmPassword" name="confirmPassword">
                        <label for="confirmPassword">Confirm new password</label>
                        <div class="invalid-tooltip">The password doesn't match</div>
                    </div>
                </form>
                <span id="password-change-message">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($passwordMatches)) {
                        if ($passwordMatches)
                            echo "The password has been successfully changed";
                        else
                            echo "Incorrect password!";
                    }
                ?>
                </span>
                <div class="row mb-3">
                    <div class="col">
                        <button id="modify-button" class="btn btn-lg btn-primary mt-2" onclick="modifyUserInfo(false, false)">Modify</button>
                        <button id="change-password-button" class="btn btn-lg btn-primary mt-2" onclick="modifyUserInfo(false, true)">Change password</button>
                        <button id="cancel-button" class="btn btn-lg btn-primary mt-2" onclick="modifyUserInfo(true, false)" hidden>Cancel</button>
                        <button id="cancel-password-change-button" class="btn btn-lg btn-primary mt-2" onclick="modifyUserInfo(true, true)" hidden>Cancel</button>
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