<?php
function is_authenticated() {
    if (!isset($_COOKIE["session_id"])) {
        return false;
    }
    $token = hex2bin($_COOKIE["session_id"]);
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    $stmt = $dbconn->prepare("SELECT user_email FROM session WHERE session_id = ?");
    $stmt->bind_param("b", $token);
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
    $token = null;
    $stmt = $dbconn->prepare("INSERT INTO session (session_id, user_email) VALUES (?, ?)");
    $stmt->bind_param("bs", $token, $email);
    $token = openssl_random_pseudo_bytes(32);
    $stmt->send_long_data(0, $token);
    $stmt->execute();
    setcookie("session_id", bin2hex($token), $keepMeLoggedIn ? time() + 30 * 86400 : 0);
    $dbconn->close();
}

function set_not_authenticated() {
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    $stmt = $dbconn->prepare("DELETE FROM session WHERE session_id = ?");
    $token = null;
    $stmt->bind_param("sb", $email, $token);
    $token = hex2bin($_COOKIE["session_id"]);
    $stmt->send_long_data(0, $token);
    $stmt->execute();
    session_destroy();
    setcookie("session_id", null, time() - 3600);
    $dbconn->close();
}