<?php
function is_authenticated() {
    if (!isset($_COOKIE["session_id"])) {
        return false;
    }
    $token = $_COOKIE["session_id"];
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    $stmt = $dbconn->prepare("SELECT user_email FROM session WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        return false;
    }
    $email = $result->fetch_column();
    $_SESSION["email"] = $email;
    $dbconn->close();
    return true;
}

function set_authenticated($email, $keepMeLoggedIn) {
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    $_SESSION["email"] = $email;
    $token = openssl_random_pseudo_bytes(16);
    $token = bin2hex($token);
    $stmt = $dbconn->prepare("UPDATE session SET token = ?, user_email = ?");
    $stmt->bind_param("ss", $token, $email);
    $stmt->execute();
    setcookie("session_id", $token, $keepMeLoggedIn ? time() + 30 * 86400 : 0);
    $dbconn->close();
}

function set_not_authenticated() {
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    $stmt = $dbconn->prepare("UPDATE session SET token = NULL WHERE email = ? AND token = ?");
    $stmt->bind_param("ss", $email, $_COOKIE["session_id"]);
    $stmt->execute();
    session_destroy();
    setcookie("session_id", null, time() - 3600);
    $dbconn->close();
}