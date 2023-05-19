<?php
session_start();
require "includes/authentication.php";
if (is_authenticated()) {
    session_destroy();
    setcookie("session_id", null, time() - 3600);
    $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
    $stmt = $dbconn->prepare("UPDATE user SET token = NULL WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $dbconn->close();
    header('Location: index.php');
}
