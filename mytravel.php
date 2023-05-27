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
            $resultquery = 1;

            foreach ($result as $record) {
                $travel = json_decode($record['travel']);

                
                $variabile = 1;
                echo '<hr class="hr" />';
                echo '<div class="row mx-5 d-flex justify-content-center py-3 ">';
                echo '<h3 class="text-center"></h3>';
                echo '<table class="table table-striped table-responsive. align-middle">';
                echo '<thead> <tr>';
                foreach ($travel as $daytravel) {
                    echo '<th>Day ' . $variabile . '</th>';
                    $variabile += 1;
                }
                
                echo '</tr></thead><tbody>';
                
                $numColumns = count($travel);
                
                for ($i = 0; $i < $numColumns; $i++) {
                    echo '<tr>';
                    foreach ($travel as $daytravel) {
                        if ($daytravel[$i] ?? null) {
                            $placetravel = $daytravel[$i];
                            echo '<td>' . explode("&", $placetravel)[0] . '</td>';
                        } else {
                            echo '<td></td>'; 
                        }
                    }
                    echo '</tr>';
                }
                
                echo '</tbody></table></div>';

                
            }
        } else {
            echo '<h3 class="text-center">No results found.</h3>';
        }
        $dbconn->close();
    ?>

    <?php include_once "assets/footer.html" ?>

</body>

</html>