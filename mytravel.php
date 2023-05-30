<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me</title>
</head>

<body>
    <?php include_once "assets/navbar.php" ?>

    <?php
        $email_travel = $_SESSION['email'];
        $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
        $stmt = $dbconn->prepare("SELECT user_id, travel_id, travel FROM itinerary WHERE user_id = ?");
        $stmt->bind_param("s", $email_travel);
        $stmt->execute();
        $result = $stmt->get_result();
        echo '<h2 class="text-center text-primary fw-bold fs-1 py-3">' . $email_travel . ' travel results: </h2>';
        if ($result->num_rows > 0) {
            foreach ($result as $record) {
                $travel = json_decode($record['travel']);
                echo '<hr class="hr" />';
                $variabile = 1;
                echo '<div class="container py-3"><div class="row d-flex rounded bg-dark bg-opacity-10 pb-4">';
                foreach ($travel as $daytravel) {
                    echo '<div class="col">';
                    echo '<label class="ft-2 fw-bolder py-3">Day '. $variabile . '</label><ul class="list-group">';
                    foreach ($daytravel as $placetravel) {
                        echo '<li class="list-group-item">' . explode("&", $placetravel)[0] . '</li>';
                    }
                    echo '</ul></div>';
                    $variabile += 1;
                }
                echo '</div></div>';
                
            }
        } else {
            echo '<h3 class="text-center">No results found.</h3>';
        }
        $dbconn->close();
    ?>

    <?php include_once "assets/footer.html" ?>

</body>

</html>