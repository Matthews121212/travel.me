<?php
session_start();
require "includes/authentication.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    return;
}
$email = $_POST["email"];
$dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
$stmt = $dbconn->prepare("SELECT 1 FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$emailAvailable = $result->num_rows === 0;
echo $emailAvailable;
$stmt->close();
$dbconn->close();