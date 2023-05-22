<?php
function is_authenticated() {
    if (!isset($_COOKIE["session_id"])) {
        return false;
    }
    if (isset($_SESSION['email'])) {
        return true;
    }
    $token = null;
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    $stmt = $dbconn->prepare("SELECT user_email FROM session WHERE session_id = ? AND expiration < ?");
    $expiration = time() + 30 * 86400;
    $stmt->bind_param("bi", $token, $expiration);
    $token = hex2bin($_COOKIE["session_id"]);
    $stmt->send_long_data(0, $token);
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
    $_SESSION["email"] = $email;
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    $token = null;
    $stmt = $dbconn->prepare("INSERT INTO session (session_id, user_email, expiration) VALUES (?, ?, ?)");
    $expiration = time() + 30 * 86400;
    $stmt->bind_param("bsi", $token, $email, $expiration);
    $token = openssl_random_pseudo_bytes(32);
    setcookie("session_id", bin2hex($token), $keepMeLoggedIn ? time() + 30 * 86400 : 0);
    $stmt->send_long_data(0, $token);
    $stmt->execute();
    $dbconn->close();
}

function set_not_authenticated() {
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    $stmt = $dbconn->prepare("DELETE FROM session WHERE session_id = ?");
    $token = null;
    $stmt->bind_param("b", $token);
    $token = hex2bin($_COOKIE["session_id"]);
    $stmt->send_long_data(0, $token);
    $stmt->execute();
    session_destroy();
    setcookie("session_id", null, time() - 3600);
    $dbconn->close();
}