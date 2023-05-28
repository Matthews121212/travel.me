<?php
$itinerary = array();
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
        $stmt = $dbconn->prepare("SELECT travel FROM itinerary WHERE travel_id = ?");
        $stmt->bind_param("s", $_GET["travel_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        echo json_encode(mysqli_fetch_array($result));
    }
?> 