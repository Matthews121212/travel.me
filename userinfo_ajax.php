<?php
session_start();
require "includes/authentication.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    return;
}
if(!is_authenticated()) {
    return;
}
$email = $_SESSION["email"];
$password = $_POST["password"];
$dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
$stmt = $dbconn->prepare("SELECT password FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$correctPasswordHash = $result->fetch_column();
$passwordMatches = $correctPasswordHash && password_verify($password, $correctPasswordHash);
echo $passwordMatches;
$stmt->close();
$dbconn->close();